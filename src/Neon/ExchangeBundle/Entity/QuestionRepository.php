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
	 * Get a list of all the questions by date created
	 *
	 * @return
	 */
	public function findAllByCreated() {
		return $this->getEntityManager()
			->createQuery('SELECT p FROM NeonExchangeBundle:Question p ORDER BY p.created DESC')
			->getResult();
	}

}