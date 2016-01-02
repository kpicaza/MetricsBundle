<?php

namespace Kpicaza\Bundle\MetricsBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Kpicaza\Bundle\MetricsBundle\Entity\VisitedPage;

/**
 * VisitedPageEvent
 *
 */
class VisitedPageEvent extends Event
{

    protected $visited_page;

    public function __construct(VisitedPage $visited_page)
    {
        $this->visited_page = $visited_page;
    }

    public function getVisitedPage()
    {
        return $this->visited_page;
    }

}
