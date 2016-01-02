<?php

namespace Kpicaza\Bundle\MetricsBundle\Event;

/*
 * MetricsEvents
 */

final class MetricsEvents
{

    /**
     * El evento desymfony.pre_user_save se lanza antes de crearse un usuario
     * en el sistema.
     *
     * El listener recibirá una instancia de DeSymfony\UserBundle\Event\GetUserEvent
     *
     */
    const PRE_SAVE_VISITED = 'kpicaza_metrics.pre_save_visited_page';

}
