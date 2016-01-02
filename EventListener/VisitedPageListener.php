<?php
namespace Kpicaza\Bundle\MetricsBundle\EventListener;

use Kpicaza\Bundle\MetricsBundle\Event\VisitedPageEvent;

/**
 * VisitedPageListener
 *
 */
class VisitedPageListener
{
    public function onPresaveVisitedPage(VisitedPageEvent $event)
    {
        // something befor save VisitedPage
        $page_view = $event->getVisitedPage();
    }
}