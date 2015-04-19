<?php

namespace MMI\MMIBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * agenda
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="MMI\MMIBundle\Entity\agendaRepository")
 */
class agenda
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="groupe", type="string", length=255)
     */
    private $groupe;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion", type="string", length=255)
     */
    private $promotion;

    /**
    * @var string
    *
    * @ORM\Column(name="description", type="string", length=255)
    */
    private $description;

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
     * Set groupe
     *
     * @param string $groupe
     * @return agenda
     */
    public function setGroupe($groupe)
    {
        $this->groupe = $groupe;

        return $this;
    }

    /**
     * Get groupe
     *
     * @return string 
     */
    public function getGroupe()
    {
        return $this->groupe;
    }

    /**
     * Set promotion
     *
     * @param string $promotion
     * @return agenda
     */
    public function setPromotion($promotion)
    {
        $this->promotion = $promotion;

        return $this;
    }

    /**
     * Get promotion
     *
     * @return string 
     */
    public function getPromotion()
    {
        return $this->promotion;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return agenda
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
}
