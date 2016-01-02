<?php

namespace Kpicaza\Bundle\MetricsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalVisits
 */
class GlobalVisits
{

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var int
     */
    private $number_visits;

    /**
     * @var string
     */
    private $view_type;

    /**
     * @var int
     */
    private $entity_id;

    /**
     * @var \DateTime
     */
    private $created_at;

    /**
     * @var \DateTime
     */
    private $updated_at;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set uri
     *
     * @param string $uri
     * @return GlobalVisits
     */
    public function setUri($uri)
    {
        $this->uri = $uri;

        return $this;
    }

    /**
     * Get uri
     *
     * @return string 
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * Set number_visits
     *
     * @param \int $numberVisits
     * @return GlobalVisits
     */
    public function setNumberVisits( $numberVisits)
    {
        $this->number_visits = $numberVisits;

        return $this;
    }

    /**
     * Get number_visits
     *
     * @return \int 
     */
    public function getNumberVisits()
    {
        return $this->number_visits;
    }

    /**
     * Set view_type
     *
     * @param string $viewType
     * @return GlobalVisits
     */
    public function setViewType($viewType)
    {
        $this->view_type = $viewType;

        return $this;
    }

    /**
     * Get view_type
     *
     * @return string 
     */
    public function getViewType()
    {
        return $this->view_type;
    }

    /**
     * Set entity_id
     *
     * @param \int $entityId
     * @return GlobalVisits
     */
    public function setEntityId( $entityId)
    {
        $this->entity_id = $entityId;

        return $this;
    }

    /**
     * Get entity_id
     *
     * @return \int 
     */
    public function getEntityId()
    {
        return $this->entity_id;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return GlobalVisits
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return GlobalVisits
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        if (!$this->getCreatedAt()) {
            $this->created_at = new \DateTime();
        }
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtValue()
    {
        $this->updated_at = new \DateTime();
    }

}
