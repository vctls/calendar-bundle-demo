<?php
/**
 * User: vtoulouse
 * Date: 22/02/2018
 * Time: 11:24
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Event\CalendarEvent;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends Controller
{
    /**
     * Dispatch a CalendarEvent and return a JSON Response of any events returned.
     *
     * @param Request $request
     * @return Response
     * @Route("/fc-load-events", name="fullcalendar_loader", options={"expose"=true})
     */
    public function loadCalendarAction(Request $request)
    {
        $startDatetime = new \DateTime($request->get('start'));

        $endDatetime = new \DateTime($request->get('end'));

        $events = $this->get('event_dispatcher')->dispatch(
            CalendarEvent::CONFIGURE, new CalendarEvent($startDatetime, $endDatetime, $request)
        )->getEvents();

        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');

        $return_events = array();

        foreach($events as $event) {
            $return_events[] = $event->toArray();
        }

        $response->setContent(json_encode($return_events));

        return $response;
    }
}