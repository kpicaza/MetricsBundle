<?php

namespace Kpicaza\Bundle\MetricsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request, $name)
    {
        $visited_page = $this->get('kpicaza_metrics.visited_page_manager')->createVisitedPage($request->getRequestUri());
        
        return $this->render('KpicazaMetricsBundle:Default:index.html.twig', array('name' => $name, 'page_info' => $visited_page));
    }
}
