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
		$query = $db->select('q')
				->orderBy('q.modified', 'DESC')
				->getQuery();
		return $query;
	}
	
}