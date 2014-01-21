<?php
namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Neon\ExchangeBundle\Entity\Question;
use Neon\ExchangeBundle\Entity\Answer;

use Neon\ExchangeBundle\Form\Type\AnswerType;

/**
 * Description of AnswersController
 *
 * @author David Yell <dyell@ukwebmedia.com>
 */
class AnswersController extends Controller {

	/**
	 * Add an answer to a question
	 *
	 * @Route("/answer/add/{questionId}", name="add_answer")
	 * @Template()
	 *
	 * @return array
	 */
	public function addAction(Request $request, $questionId) {
		$question = $this->getDoctrine()
            ->getRepository('NeonExchangeBundle:Question')
            ->find($questionId);

		var_dump($question->getId());exit;

		$form = $this->createForm(new AnswerType());

        if ($request->isMethod('post')) {
            $form->submit($this->getRequest());

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($form->getData());
            $manager->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Answer saved');
            return $this->redirect($this->getRequest()->headers->get('referer'));
        }
	}

}