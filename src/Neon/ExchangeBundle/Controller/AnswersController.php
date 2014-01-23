<?php
namespace Neon\ExchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
		$answer = new Answer;
		$form = $this->createForm(new AnswerType, $answer);

        if ($request->isMethod('post')) {
			$form->submit($this->getRequest());

			$question = $this->getDoctrine()
				->getRepository('NeonExchangeBundle:Question')
				->find($questionId);

			$answer->setQuestion($question);

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($answer);
            $manager->flush();

            $this->get('session')->getFlashBag()->add('notice', 'Answer saved');

            return $this->redirect($this->generateUrl('view_question', array('id' => $questionId)));
        }
	}

	/**
	 * Added a vote to an Answer
	 *
	 * @Route("/answer/vote/{id}/{dir}", name="vote_answer")
	 *
	 * @param int $id
	 * @param string $dir
	 * @return int
	 */
	public function voteAction($id, $dir) {
		$em = $this->getDoctrine()->getManager();
		$answer = $em->getRepository('NeonExchangeBundle:Answer')->find($id);

		$upvotes = $answer->getUpvotes();
		$downvotes = $answer->getDownvotes();

		if ($dir === 'up') {
			$answer->setUpvotes(++$upvotes);
		} else {
			$answer->setDownvotes(++$downvotes);
		}

		$em->flush();

		return new Response($answer->getUpvotes() - $answer->getDownvotes());
	}

}