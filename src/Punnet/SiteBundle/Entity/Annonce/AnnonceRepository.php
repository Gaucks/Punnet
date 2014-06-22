<?php

namespace Punnet\SiteBundle\Entity\Annonce;

use Doctrine\ORM\EntityRepository;
use Punnet\SiteBundle\Entity\Abonnement\UserAbonnement;
/**
 * AnnonceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AnnonceRepository extends EntityRepository
{
	// Récupere toutes les annonces y compris celle des personnes ou l'ont est abonné. ( Style réseaux sociaux )
	public function getFollowed($followers_ann, $id, $followed_region)
	{	
		$query = $this->createQueryBuilder('a')
					  ->where('a.user = :user')
					  ->orWhere('a.user IN (:followed)')
					  ->orWhere('a.region IN (:followed_region)')
					  ->setParameters(array('user' => $id, 'followed' => $followers_ann, 'followed_region' => $followed_region))
					  ->orderBy('a.date','DESC')
					  ->setMaxResults(6)
					  ->getQuery()
					  ->getResult();
		return $query;
	}
	
	public function countSold($id)
	{
		$query = $this->createQueryBuilder('a')
					   ->select('count(a.id)')
					   ->where('a.status = 1')
					   ->AndWhere('a.user = :user')
					   ->setParameter('user', $id)
					   ->getQuery()
					   ->getSingleScalarResult();
					   
	    return $query;
	}
	
	public function getByPrice($region , $order)
	{
		$query = $this->createQueryBuilder('a')
				->where('a.price != :lol')
				->AndWhere('a.region = :region')
				->orderBy('a.price' , $order)
				->setParameters(array('region' => $region, 'lol' => 'NULL'))
				->getQuery()
				->getResult();
				
		return $query;
				
	}
	
}
