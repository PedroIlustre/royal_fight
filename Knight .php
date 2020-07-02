<?php
namespace knight;

use action;

class Knight implements action
{
    private $id;
    private $name;
    private $life_points;
    private $knights_already_dueled;

    /**
     * Knight constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
        $this->life_points = 100;

    }


    /**
     * @return mixed
     */
    public function getKnightsAlreadyDueled()
    {
        return $this->knights_already_dueled;
    }

    /**
     * @param mixed $knights_already_dueled
     */
    public function setKnightsAlreadyDueled($knights_already_dueled)
    {
        $this->knights_already_dueled[] = $knights_already_dueled;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLifePoints()
    {
        return $this->life_points;
    }

    /**
     * @param mixed $life_points
     */
    public function setLifePoints($life_points)
    {
        $this->life_points = $life_points;
    }


    public function sword_attack()
    {
       return(rand(0, 9));
    }

    public function spear_attack()
    {
        return(rand(0, 9));
    }

    public function receive_attack($attack){
        $this->setLifePoints($this->getLifePoints() - $attack);
    }
}