<?php

namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Neon\ExchangeBundle\Form\Type\QuestionType;

/**
 * Description of QuestionsController
 *
 * @author David Yell <neon1024@gmail.com>
 *
 * @Route("/")
 */
class QuestionsController extends Controller {

    /**
     * List the questions
     *
     * @Route("/", name="latest_questions")
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
        $questions = $this->getDoctrine()
            ->getRepository('NeonExchangeBundle:Question')
            ->findAll();

        return array('questions' => $questions);
    }

    /**
     * Add a new question
     *
     * @Route("/questions/add", name="add_question")
     * @Template()
     *
     * @return array
     */
    public function addAction(Request $request) {
        $form = $this->createForm(new QuestionType());

        if ($request->isMethod('post')) {
            $form->bind($this->getRequest());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Question saved');
            return $this->redirect($this->generateUrl('latest_questions'));
        }

        return array(
            'form' => $form->createView()
        );
    }

}