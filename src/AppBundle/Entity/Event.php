<?php
/**
 * User: vtoulouse
 * Date: 22/02/2018
 * Time: 11:08
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Event
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Event
{
    /**
     * @var mixed Unique identifier of this event (optional).
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string Title/label of the calendar event.
     * @ORM\Column(nullable=true)
     */
    protected $title;

    /**
     * @var string URL Relative to current path.
     * @ORM\Column(nullable=true)
     */
    protected $url;

    /**
     * @var string HTML color code for the bg color of the event label.
     * @ORM\Column(nullable=true)
     */
    protected $bgColor;

    /**
     * @var string HTML color code for the foregorund color of the event label.
     * @ORM\Column(nullable=true)
     */
    protected $fgColor;

    /**
     * @var string css class for the event label
     * @ORM\Column(nullable=true)
     */
    protected $cssClass;

    /**
     * @var \DateTime DateTime object of the event start date/time.
     * @ORM\Column(type="datetime")
     */
    protected $startDatetime;

    /**
     * @var \DateTime DateTime object of the event end date/time.
     * @ORM\Column(type="datetime")
     */
    protected $endDatetime;

    /**
     * @var boolean Is this an all day event?
     * @ORM\Column(type="boolean")
     */
    protected $allDay = false;

    /**
     * @var array Non-standard fields
     * @ORM\Column(type="array")
     */
    protected $otherFields = [];

    /**
     * Event constructor.
     * @param $title
     * @param \DateTime $startDatetime
     * @param \DateTime $endDatetime
     * @param bool $allDay
     */
    public function __construct($title = '', \DateTime $startDatetime = null, \DateTime $endDatetime = null, $allDay = false)
    {
        $this->title = $title;
        $this->startDatetime = $startDatetime;
        $this->allDay = $allDay;

//        if ($endDatetime === null && $this->allDay === false) {
//            throw new \InvalidArgumentException("Must specify an event End DateTime if not an all day event.");
//        }

        $this->endDatetime = $endDatetime;
    }

    /**
     * Convert calendar event details to an array
     *
     * @return array $event
     */
    public function toArray()
    {
        $event = array();

        if ($this->id !== null) {
            $event['id'] = $this->id;
        }

        $event['title'] = $this->title;
        $event['start'] = $this->startDatetime->format("Y-m-d\TH:i:sP");

        if ($this->url !== null) {
            $event['url'] = $this->url;
        }

        if ($this->bgColor !== null) {
            $event['backgroundColor'] = $this->bgColor;
            $event['borderColor'] = $this->bgColor;
        }

        if ($this->fgColor !== null) {
            $event['textColor'] = $this->fgColor;
        }

        if ($this->cssClass !== null) {
            $event['className'] = $this->cssClass;
        }
        if ($this->endDatetime !== null) {
            $event['end'] = $this->endDatetime->format("Y-m-d\TH:i:sP");
        }

        $event['allDay'] = $this->allDay;
        foreach ($this->otherFields as $field => $value) {
            $event[$field] = $value;
        }

        return $event;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getBgColor()
    {
        return $this->bgColor;
    }

    public function setBgColor($color)
    {
        $this->bgColor = $color;
    }

    /**
     * @return string
     */
    public function getFgColor()
    {
        return $this->fgColor;
    }

    /**
     * @param $color
     */
    public function setFgColor($color)
    {
        $this->fgColor = $color;
    }

    /**
     * @return string
     */
    public function getCssClass()
    {
        return $this->cssClass;
    }

    /**
     * @param $class
     */
    public function setCssClass($class)
    {
        $this->cssClass = $class;
    }

    /**
     * @return \DateTime
     */
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    /**
     * @param \DateTime $start
     */
    public function setStartDatetime(\DateTime $start)
    {
        $this->startDatetime = $start;
    }

    /**
     * @return \DateTime
     */
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    /**
     * @param \DateTime $end
     */
    public function setEndDatetime(\DateTime $end)
    {
        $this->endDatetime = $end;
    }

    /**
     * @return bool
     */
    public function isAllDay()
    {
        return $this->allDay;
    }

    /**
     * @param bool $allDay
     */
    public function setAllDay($allDay = false)
    {
        $this->allDay = (boolean) $allDay;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addField($name, $value)
    {
        $this->otherFields[$name] = $value;
    }
    /**
     * @param string $name
     */
    public function removeField($name)
    {
        if (!array_key_exists($name, $this->otherFields)) {
            return;
        }
        unset($this->otherFields[$name]);
    }

    /**
     * Get otherFields
     *
     * @return array
     */
    public function getOtherFields()
    {
        return $this->otherFields;
    }

    /**
     * Set otherFields
     *
     * @param array $otherFields
     * @return Event
     */
    public function setOtherFields($otherFields)
    {
        $this->otherFields = $otherFields;

        return $this;
    }
}
