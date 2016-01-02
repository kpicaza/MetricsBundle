<?php

namespace Kpicaza\Bundle\MetricsBundle\Model;

use Doctrine\ORM\EntityManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Kpicaza\Bundle\MetricsBundle\Entity\VisitedPage;
use Kpicaza\Bundle\MetricsBundle\Event\VisitedPageEvent;
use Kpicaza\Bundle\MetricsBundle\Event\MetricsEvents;
use Kpicaza\Bundle\MetricsBundle\Model\GlobalVisitsManager;

/**
 * UserManager Model
 */
class VisitedPageManager
{

    /**
     *
     * @var EntityManager 
     */
    protected $em;
    
    /**
     *
     * @var EventDispatcherInterface 
     */
    protected $dispatcher;

    /**
     *
     * @var GlobalVisitsManager 
     */
    private $gvm;


    public function __construct(EntityManager $em, EventDispatcherInterface $dispatcher, GlobalVisitsManager $gvm)
    {
        $this->em = $em;
        $this->dispatcher = $dispatcher;
        $this->gvm = $gvm;
    }

    /**
     * 
     * @param type $uri
     * @param type $entity
     * @return VisitedPage
     */
    public function createVisitedPage($uri, $entity = null)
    {
        $visited_page = new VisitedPage();

        $event = new VisitedPageEvent($visited_page);
        $this->dispatcher->dispatch(MetricsEvents::PRE_SAVE_VISITED, $event);

        $visited_page->setUri($uri);

        $this->em->persist($visited_page);
        
        $globalVisits = $this->gvm->findOneGlobalVisitByUri($uri);
        if (null === $globalVisits) {
            $globalVisits = $this->gvm->createGlobalVisit($uri, $entity);
        }
        else {
            $globalVisits = $this->gvm->updateGlobalVisit($uri);
        }
        
        $this->em->flush();

        return $visited_page;
    }

    /**
     * 
     * @return type
     */
    public function findAllVisitedPages()
    {
        return $this->em->getRepository('KpicazaMetricsBundle:VisitedPage')->findAll();
    }

}
