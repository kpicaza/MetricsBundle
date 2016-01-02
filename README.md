Metrics Bundle
==============

## Instalation:

    // App/AppKernel.php

    public function registerBundles()
    {
        $bundles = array(
          ...,
          new Kpicaza\Bundle\MetricsBundle\KpicazaMetricsBundle(),
          ...,
        );

## Confugutation:

    // App/config.yml
    kpicaza_metrics:
        enable_blocks: true # boolean, enables custom entity blocks.
        entities: # Entities to be mapped on blocks
            # Example data, this will be your own entity and you own view
            BlogPost:
                class: AppBundle\Entity\BlogPost
                view: KpicazaMetricsBundle:Twig:most_viewed_entities.html.twig

## Usage:

### Trafic tracking:

In your controller, you can use it to track an entity.

    public function showAction(Request $request, BlogPost $post)
    {
        $visited_page = $this->get('kpicaza_metrics.visited_page_manager')->createVisitedPage($request->getRequestUri(), $post);

        return $this->render('blogpost/show.html.twig', array(
              // Your view params.
              ...,
              // If you want to display visited page info in your template.
              'visited_page' => false === $this->get('security.context')->isGranted('ROLE_ADMIN') ? null : $visited_page,
        ));
    }

Or you can use to track list pages, for example:

    public function indexAction(Request $request)
    {
        $visited_page = $this->get('kpicaza_metrics.visited_page_manager')->createVisitedPage($request->getRequestUri());
        
        ...

        return $this->render('category/index.html.twig', array(
              ...,
              'visited_page' => false === $this->get('security.context')->isGranted('ROLE_ADMIN') ? null : $visited_page,
        ));
    }

### Blocks:

By default you have a "most viewed articles" block, you can use it with a twig function

    {# BlogPost is entity defined in config.yml, look at configuration section #}
    {{ most_visited_entities('BlogPost') }}

### Events:

You can add event listener before visited page insertion:

Create your own event listener

    // Acme\DemoBundle\EventListener\VisitedPageListener.php
    namespace Acme\DemoBundle\EventListener;

    use Kpicaza\Bundle\MetricsBundle\Event\VisitedPageEvent;
    use Kpicaza\Bundle\MetricsBundle\EventListener\VisitedPageListener as BaseListener;

    /**
     * VisitedPageListener
     *
     */
    class VisitedPageListener extends BaseListener
    {
        public function onPresaveVisitedPage(VisitedPageEvent $event)
        {
            $page_view = $event->getVisitedPage();
            // do something befor save VisitedPage
        }
    }

And enable it in your servicer.yml

    services:
        acme_metrics.event_listener:
            class: Acme\DemoBundle\EventListener\VisitedPageListener
            tags:
                - { name: "kpicaza_metrics.event_listener", event: "kpicaza_metrics.pre_save_visited_page", method: "onPresaveVisitedPage" }


### Usage with fos user bundle:

@todo

## @todos:

- #### Integration with fosUserBundle
- #### Create, more configurable blocks
- #### Only create one insert|update querys on page visit, now we add 2.
- #### Add integration with ObHighChartsBundle
- #### Create annotation to use as comment in controllers
- #### Make tests
