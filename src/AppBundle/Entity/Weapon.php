<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weapon
 *
 * @ORM\Table(name="weapon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\WeaponRepository")
 */
class Weapon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="integer")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="damage", type="integer")
     */
    private $damage;

    /**
     * @var int
     *
     * @ORM\Column(name="deviation", type="integer")
     */
    private $deviation;

    /**
     * @var int
     *
     * @ORM\Column(name="rarity", type="integer")
     */
    private $rarity;

    /**
     * @var WeaponClass
     *
     * @ORM\ManyToOne(targetEntity="WeaponClass", fetch="EXTRA_LAZY")
     */
    private $weaponClass;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Weapon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Weapon
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set damage
     *
     * @param integer $damage
     *
     * @return Weapon
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * Get damage
     *
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * Set deviation
     *
     * @param integer $deviation
     *
     * @return Weapon
     */
    public function setDeviation($deviation)
    {
        $this->deviation = $deviation;

        return $this;
    }

    /**
     * Get deviation
     *
     * @return int
     */
    public function getDeviation()
    {
        return $this->deviation;
    }

    /**
     * Set rarity
     *
     * @param integer $rarity
     *
     * @return Weapon
     */
    public function setRarity($rarity)
    {
        $this->rarity = $rarity;

        return $this;
    }

    /**
     * Get rarity
     *
     * @return int
     */
    public function getRarity()
    {
        return $this->rarity;
    }

    /**
     * Set weaponClass.
     *
     * @param WeaponClass $weaponClass
     *
     * @return Weapon
     */
    public function setWeaponClass(WeaponClass $weaponClass)
    {
        $this->weaponClass = $weaponClass;

        return $this;
    }

    /**
     * Get weaponClass.
     *
     * @return WeaponClass
     */
    public function getWeaponClass()
    {
        return $this->weaponClass;
    }

    public function __toString() {
        return $this->name;
    }
}

