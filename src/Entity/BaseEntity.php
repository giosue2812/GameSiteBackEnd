<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntity
 * @package App\Entity
 * @ORM\MappedSuperclass()
 * @ORM\HasLifecycleCallbacks()
 */
class BaseEntity
{
    /**
     * @ORM\Column(type="date",nullable=false)
     */
    private $create_date;
    /**
     * @ORM\Column(type="date",nullable=true)
     */
    private $update_date;
    /**
     * @ORM\Column(type="boolean")
     */
    private $is_active;

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->create_date;
    }

    /**
     * @param mixed $create_date
     * @return BaseEntity
     */
    public function setCreateDate($create_date)
    {
        $this->create_date = $create_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUpdateDate()
    {
        return $this->update_date;
    }

    /**
     * @param mixed $update_date
     * @return BaseEntity
     */
    public function setUpdateDate($update_date)
    {
        $this->update_date = $update_date;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsActive()
    {
        return $this->is_active;
    }

    /**
     * @param mixed $is_active
     * @return BaseEntity
     */
    public function setIsActive($is_active)
    {
        $this->is_active = $is_active;
        return $this;
    }

    /**
     * @ORM\PrePersist()
     */
    public function createEvent()
    {
        $this->create_date = new \DateTime();
        $this->is_active = true;
    }
}