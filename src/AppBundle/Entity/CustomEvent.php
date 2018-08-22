<?php
/**
 * User: Victor
 * Date: 2018-02-26
 * Time: 21:03
 */

namespace AppBundle\Entity;

use ADesigns\CalendarBundle\Entity\EditableInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class CustomEvent
 * @package AppBundle\Entity
 *
 * @ORM\Entity()
 */
class CustomEvent implements EditableInterface
{

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $startDatetime;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $endDatetime;

    /**
     * @var string
     * @ORM\Column()
     */
    private $title;

    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var boolean
     * @ORM\Column(type="boolean", nullable=true, options={"default" : false})
     */
    private $allDay = false;

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return CustomEvent
     */
    public function setTitle(string $title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return \DateTime
     */
    public function getStartDatetime()
    {
        return $this->startDatetime;
    }

    /**
     * @param \DateTime $startDatetime
     * @return CustomEvent
     */
    public function setStartDatetime(\DateTime $startDatetime)
    {
        $this->startDatetime = $startDatetime;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getEndDatetime()
    {
        return $this->endDatetime;
    }

    /**
     * @param \DateTime $endDatetime
     * @return CustomEvent
     */
    public function setEndDatetime(\DateTime $endDatetime)
    {
        $this->endDatetime = $endDatetime;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isAllDay(): bool
    {
        return $this->allDay;
    }

    /**
     * @param $allDay
     * @return CustomEvent
     */
    public function setAllDay(bool $allDay)
    {
        $this->allDay = $allDay;
        return $this;
    }

    /**
     * Get allDay
     *
     * @return boolean
     */
    public function getAllDay(): bool
    {
        return $this->allDay;
    }
}
