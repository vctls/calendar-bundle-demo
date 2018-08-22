<?php
/**
 * User: Victor
 * Date: 2018-02-26
 * Time: 21:46
 */

namespace AppBundle\Event;


use ADesigns\CalendarBundle\Entity\FullCalendarEvent;
use ADesigns\CalendarBundle\Event\CalendarEvent;
use AppBundle\Entity\CustomEvent;
use Doctrine\ORM\EntityManager;

class CalendarEventListener
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function loadEvents(CalendarEvent $calendarEvent)
    {
        $startDate = $calendarEvent->getStartDatetime();
        $endDate = $calendarEvent->getEndDatetime();

        $request = $calendarEvent->getRequest();
        $filter = $request->get('filter');

        // TODO Allow fetching any compatible events. Using tagged services, maybe?
        $customEvents = $this->entityManager->getRepository(FullCalendarEvent::class)
            ->createQueryBuilder('e')
            ->where('e.startDatetime BETWEEN :startDate and :endDate')
            ->where('e.endDatetime BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        $calendarEvent->setEvents($customEvents);
    }
}