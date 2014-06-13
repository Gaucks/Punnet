<?php

namespace Punnet\SiteBundle\Entity\Region;

use Doctrine\ORM\EntityRepository;

/**
 * RegionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RegionRepository extends EntityRepository
{
	public function getAvailableDepartements()
	{
		$queryBuilder = $this->createQueryBuilder('a');

	    // Méthode équivalente, mais plus longue :
	    $queryBuilder = $this->_em->createQueryBuilder()
	                              ->select('a')
	                              ->Where('a.region = :id')
	                              ->setParameter('id', '175')
	                              ->from($this->_entityName, 'a');
	      // Dans un repository, $this->_entityName est le namespace de l'entité gérée
	      // Ici, il vaut donc Sdz\BlogBundle\Entity\Article
	
	    // On a fini de construire notre requête
	
	    // On récupère la Query à partir du QueryBuilder
	    $query = $queryBuilder->getQuery();
	
	    // On récupère les résultats à partir de la Query
	    $resultats = $query->getResult();
	
	    // On retourne ces résultats
	    return $resultats;
	}
}
