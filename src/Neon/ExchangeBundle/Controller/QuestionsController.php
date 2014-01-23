<?php

namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Neon\ExchangeBundle\Form\Type\QuestionType;
use Neon\ExchangeBundle\Form\Type\AnswerType;

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

    /**
     * View a question and any answers
     *
     * @Route("/question/view/{id}", name="view_question")
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

	/**
	 * Mark a question as having a resolved answer
	 *
	 * @Route("/question/accept_answer/{questionId}/{answerId}", name="accept_answer")
	 *
	 * @param int $questionId
	 * @param int $answerId
	 * @return \Symfony\Component\HttpFoundation\Response
	 */
	public function acceptAnswerAction($questionId, $answerId) {
		$em = $this->getDoctrine()->getManager();
		$question = $em->getRepository('NeonExchangeBundle:Question')->find($questionId);

		if ($question->getAcceptedAnswer() !== 0) {
			return new JsonResponse(array('message' => 'You cannot accept this answer, an anwer has already been accepted'));
		} else {
			$question->setAcceptedAnswer($answerId);
			$em->flush();
		}

		return new JsonResponse(array('message' => 'Answer has been accepted'));
	}

}