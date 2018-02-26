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
    private $startDateTime;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $endDateTime;

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
     * @ORM\Column(type="boolean", nullable=true)
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
    public function setTitle($title)
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
    public function getStartDateTime()
    {
        return $this->startDateTime;
    }

    /**
     * @param \DateTime $startDateTime
     */
    public function setStartDateTime(\DateTime $startDateTime)
    {
        $this->startDateTime = $startDateTime;
    }

    /**
     * @return \DateTime
     */
    public function getEndDateTime()
    {
        return $this->endDateTime;
    }

    /**
     * @param \DateTime $endDateTime
     */
    public function setEndDateTime(\DateTime $endDateTime)
    {
        $this->endDateTime = $endDateTime;
    }

    /**
     * @return boolean
     */
    public function isAllDay()
    {
        return $this->allDay;
    }

    /**
     * @param $allDay
     */
    public function setAllDay($allDay)
    {
        $this->allDay = $allDay;
    }

    /**
     * Get allDay
     *
     * @return boolean
     */
    public function getAllDay()
    {
        return $this->allDay;
    }
}
