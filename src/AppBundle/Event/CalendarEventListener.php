<?php
/**
 * User: Victor
 * Date: 2018-02-26
 * Time: 21:46
 */

namespace AppBundle\Event;


use ADesigns\CalendarBundle\Event\CalendarEvent;
use AppBundle\Entity\CustomEvent;
use Doctrine\ORM\EntityManagerInterface;

class CalendarEventListener
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
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

        $customEvents = $this->entityManager->getRepository(CustomEvent::class)
            ->createQueryBuilder('e')
            ->where('e.startDateTime BETWEEN :startDate and :endDate')
            ->where('e.endDateTime BETWEEN :startDate and :endDate')
            ->setParameter('startDate', $startDate->format('Y-m-d H:i:s'))
            ->setParameter('endDate', $endDate->format('Y-m-d H:i:s'))
            ->getQuery()->getResult();

        // $companyEvents and $companyEvent in this example
        // represent entities from your database, NOT instances of EventEntity
        // within this bundle.
        //
        // Create EventEntity instances and populate it's properties with data
        // from your own entities/database values.

        $calendarEvent->setEvents($customEvents);
    }
}