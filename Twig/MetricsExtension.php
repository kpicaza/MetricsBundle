<?php

// src/AppBundle/Twig/AppExtension.php

namespace Kpicaza\Bundle\MetricsBundle\Twig;

use Doctrine\ORM\EntityManager;
use Kpicaza\Bundle\MetricsBundle\Model\GlobalVisitsManager;

/**
 * MetricsExtension
 */
class MetricsExtension extends \Twig_Extension
{

    /**
     *
     * @var VisitedPageManager
     */
    private $em;

    /**
     *
     * @var GlobalVisitsManager 
     */
    private $gvm;
    
    /**
     *
     * @var array 
     */
    private $params = array();

    /**
     * 
     * @param EntityManager $em
     * @param GlobalVisitsManager $gvm
     */
    public function __construct(EntityManager $em, GlobalVisitsManager $gvm, array $params = array())
    {
        $this->em = $em;
        $this->gvm = $gvm;
        $this->params = $params;
    }

    /**
     * 
     * @return type
     */
    public function getFunctions()
    {
        return array(
          'most_visited_entities' => new \Twig_SimpleFunction('most_visited_entities', array($this, 'getMostVisitedEntities'), array(
            'is_safe' => array('html'),
            'needs_environment' => true,
              )),
        );
    }

    /**
     * 
     * @param type $class
     * @return string
     */
    public function getMostVisitedEntities(\Twig_Environment $twig, $entity_name)
    {

        $class = $this->params[$entity_name]['class'];
        
        $globalVisits = $this->gvm->findByClass($class, array(
          'number_visits' => 'DESC'
            ), 5, 0
        );

        if (0 >= count($globalVisits)) {
            return '';
        }

        $entities = $this->gvm->findEntitiesByGlobalVisitsAndClass($globalVisits, $class);

        return $twig->render($this->params[$entity_name]['view'], array(
              'entities' => null === $entities ? array() : $entities
        ));
    }

    public function getName()
    {
        return 'metrics_extension';
    }

}
