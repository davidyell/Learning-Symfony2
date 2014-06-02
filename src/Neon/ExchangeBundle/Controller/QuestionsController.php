<?php

namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Neon\ExchangeBundle\Form\Type\QuestionType;
use Neon\ExchangeBundle\Form\Type\AnswerType;

/**
 * Description of QuestionsController
 *
 * @author David Yell <neon1024@gmail.com>
 *
 */
class QuestionsController extends Controller {

    /**
     * List the questions
     *
     * @Route("/", name="latest_questions")
	 * @Method({"GET"})
     * @Template()
     *
     * @return array
     */
    public function indexAction() {
		$query = $this->getDoctrine()->getRepository('NeonExchangeBundle:Question')->paginateByModified();
		$paginator = $this->get('knp_paginator');
		$pagination = $paginator->paginate(
			$query,
			$this->get('request')->query->get('page', 1),
			5
		);

        return array('pagination' => $pagination);
    }

    /**
     * Add a new question
     *
     * @Route("/questions/add", name="add_question")
	 * @Method({"GET","POST"})
     * @Template()
     *
     * @return array
     */
    public function addAction(Request $request) {
        $form = $this->createForm(new QuestionType());

        if ($request->isMethod('post')) {
            $form->bind($this->getRequest());
			
			$form->getData()->setUser($this->getUser());

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

    /**
     * View a question and any answers
     *
     * @Route("/question/view/{id}", name="view_question")
	 * @Method({"GET"})
     * @Template()
     *
     * @param int $id
     * @return array
     */
    public function viewAction($id) {
		$question = $this->getDoctrine()
			->getRepository('NeonExchangeBundle:Question')
			->findQuestionWithAnswersOrderedByVotes($id);

        $form = $this->createForm(new AnswerType());

        return array(
            'question' => $question,
            'form' => $form->createView()
        );
    }

	/**
	 * Added a vote to a Question
	 *
	 * @Route("/question/vote/{id}/{dir}", name="vote_question")
	 * @Method({"GET"})
	 *
	 * @param int $id
	 * @param string $dir
	 * @return int
	 */
	public function voteAction($id, $dir) {
		$em = $this->getDoctrine()->getManager();
		$question = $em->getRepository('NeonExchangeBundle:Question')->find($id);

		$upvotes = $question->getUpvotes();
		$downvotes = $question->getDownvotes();

		if ($dir === 'up') {
			$question->setUpvotes(++$upvotes);
		} else {
			$question->setDownvotes(++$downvotes);
		}

		$em->flush();

		return new Response($question->getUpvotes() - $question->getDownvotes());
	}

}