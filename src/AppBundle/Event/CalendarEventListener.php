<?php
/**
 * User: vtoulouse
 * Date: 22/02/2018
 * Time: 11:32
 */

namespace AppBundle\Event;

use AppBundle\Entity\Event;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        // The original request so you can get filters from the calendar
        // Use the filter in your query for example

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');


        // load events using your custom logic here,
        // for instance, retrieving events from a repository

        /** @var Event[] $events */
        $events = $this->entityManager->getRepository(Event::class)
            ->createQueryBuilder('e')
            ->where('e.startDatetime BETWEEN :startDate and :endDate')
            ->orWhere('e.endDatetime BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of Event
        // within this bundle.
        //
        // Create Event instances and populate it's properties with data
        // from your own entities/database values.

        foreach($events as $event) {

            // create an event with a start/end time, or an all day event
            if (!$event->isAllDay()) {
                $Event = new Event($event->getTitle(), $event->getStartDatetime(), $event->getEndDatetime());
            } else {
                $Event = new Event($event->getTitle(), $event->getStartDatetime(), null, true);
            }

            //optional calendar event settings
            $Event->setAllDay(true); // default is false, set to true if this is an all day event
            $Event->setBgColor('#FF0000'); //set the background color of the event's label
            $Event->setFgColor('#FFFFFF'); //set the foreground color of the event's label
            $Event->setUrl('http://www.google.com'); // url to send user to when event label is clicked
            $Event->setCssClass('my-custom-class'); // a custom class you may want to apply to event labels

            //finally, add the event to the CalendarEvent for displaying on the calendar
            $calendarEvent->addEvent($Event);
        }
    }
}