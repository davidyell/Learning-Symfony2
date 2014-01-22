<?php
namespace Neon\ExchangeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Description of QuestionRepository
 *
 * @author David Yell <dyell@ukwebmedia.com>
 */
class QuestionRepository extends EntityRepository {

	/**
	 * Paginate a set of questions ordered by modified
	 *
	 * @return Query
	 */
	public function paginateByModified() {
		$db = $this->createQueryBuilder('q');
		$query = $db->orderBy('q.modified', 'DESC')->getQuery();
		return $query;
	}

	/**
	 * Find question with answers ordered by upvotes
	 *
	 * @param int $id
	 * @return Question
	 */
	public function findQuestionWithAnswersOrderedByVotes($id) {
		$db = $this->createQueryBuilder('q');
		$question = $db->select('q, a')
			->leftJoin('q.answers', 'a')
			->where('q.id = :id')
			->setParameter('id', $id)
			->orderBy('a.upvotes', 'DESC')
			->getQuery();

		return $question->getSingleResult();
	}
	
}