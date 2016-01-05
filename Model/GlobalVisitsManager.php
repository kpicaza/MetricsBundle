<?php

namespace Kpicaza\Bundle\MetricsBundle\Model;

use Doctrine\ORM\EntityManager;
use Kpicaza\Bundle\MetricsBundle\Entity\GlobalVisits;

/**
 * GlobalVisitsManager Model
 */
class GlobalVisitsManager
{
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    /**
     *
     * @var array 
     */
    protected $params;

    /**
     * 
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em, array $params = array())
    {
        $this->em = $em;
        $this->params = $params;
    }

    /**
     * 
     * @param type $uri
     * @param type $entity
     * @return type
     */
    public function createGlobalVisit($uri, $entity = null)
    {
        $globalVisit = new GlobalVisits();

        $viewType = null === $entity ? 'list' : $this->em->getClassMetadata(get_class($entity))->getName();

        $globalVisit
            ->setUri($uri)
            ->setViewType($viewType)
            ->setNumberVisits(1)
            ->setEntityId(null === $entity ? null : $entity->getId())
        ;

        $this->em->persist($globalVisit);
        $this->em->flush();

        return $globalVisit;
    }

    /**
     * 
     * @param type $uri
     * @param type $entity
     * @return type
     */
    public function updateGlobalVisit($uri)
    {
        $globalVisit = $this->findOneGlobalVisitByUri($uri);

        $globalVisit
            ->setNumberVisits(1 + $globalVisit->getNumberVisits())
        ;

        $this->em->flush();

        return $globalVisit;
    }

    /**
     * 
     * @return type
     */
    public function findAllGlobalVisit()
    {
        return $this->em->getRepository('KpicazaMetricsBundle:GlobalVisits')->findAll();
    }

    /**
     * 
     * @param type $uri
     * @return type
     */
    public function findOneGlobalVisitByUri($uri)
    {
        return $this->em->getRepository('KpicazaMetricsBundle:GlobalVisits')->findOneByUri($uri);
    }

    /**
     * 
     * @param type $class
     * @param array $orderBy
     * @param type $offset
     * @param type $limit
     * @return type
     */
    public function findByClass($class, array $orderBy = array(), $offset = null, $limit = null)
    {
        return $this->em->getRepository('KpicazaMetricsBundle:GlobalVisits')->findBy(array('view_type' => $class), $orderBy, $offset, $limit);
    }

    /**
     * 
     * @param array $globalVisits
     * @param type $class
     * @return type
     */
    public function findEntitiesByGlobalVisitsAndClass(array $globalVisits, $class)
    {
        if (0 >= count($globalVisits)) {
            return array();
        }

        $q = $this->em->getRepository($class)->createQueryBuilder('c');

        foreach ($globalVisits as $key => $value) {
            $q
                ->orWhere('c.id = :id' . $key)
                ->setParameter('id' . $key, $value->getEntityId())
            ;
        }

        return $this->orderEntitiesByGlobalVisits($q->getQuery()->getResult(), $globalVisits);
    }

    /**
     * 
     * @param array $entities
     * @param array $globalVisits
     * @return array
     */
    private function orderEntitiesByGlobalVisits(array $entities = array(), array $globalVisits = array())
    {
        $result = array();

        foreach ($globalVisits as $visit) {
            foreach ($entities as $entity) {
                if ($entity->getId() != $visit->getEntityId()) {
                    continue;
                }
                $result[] = $entity;
            }
        }

        return $result;
    }

}
