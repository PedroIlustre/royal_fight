<?php

namespace Royal;

class Tournament
{
    private $winner;

    /**
     * Tournament constructor.
     * @param $number_of_competitors
     */
    public function __construct($number_of_competitors)
    {
        $arr_obj_knights =array();

        for($i=0;$i < $number_of_competitors;$i++){
            $obj_knight = new Knight($i+1);
            $obj_knight->setName($this->randomName());
            $arr_obj_knights[] = $obj_knight;
        }
        $winner = $this->death_match($arr_obj_knights, 0);
        $this->setWinner($winner);
    }


    /**
     * @return mixed
     */
    public function getWinner()
    {
        return $this->winner;
    }

    /**
     * @param mixed $winner
     */
    public function setWinner($winner)
    {
        $this->winner = $winner;
    }

    private function randomName() : string {
        $names = array(
            'Sebastian',
            'Napoleon',
            'Augustus',
            'Pedro',
            'Aquila',
        );
        return $names[rand ( 0 , count($names) -1)];
    }

    private function death_match(array $arr_obj_knights, $i){

        if(count($arr_obj_knights) == 1){
            return $arr_obj_knights;
        }

        #All survivor knights fight against each other
        foreach($arr_obj_knights as $k => $knight){
            if($knight->getLifePoints() > 0){
                $this->round($knight, $arr_obj_knights);
                $knight->setKnightsAlreadyDueled();
            } else {
                # Dead Night
                unset($arr_obj_knights[$k]);
            }
        }
        $i++;
        return $this->death_match($arr_obj_knights, $i);
        
    }
    private function round (object $knight, array $arr_obj_knights) : void{
        foreach($arr_obj_knights as $k => $adversary) {
            if($arr_obj_knights[$k]->getId() == $knight->getId()){
                continue;
            }

            $already_dueled = false;
            if($knight->getKnightsAlreadyDueled())
                $already_dueled = in_array($adversary->getId(),$knight->getKnightsAlreadyDueled());

            if($adversary->getId() != $knight->getId() && !($already_dueled))
            {    
                $adversary->receive_attack($knight->sword_attack());
                $knight->setKnightsAlreadyDueled($adversary->getId());

                if($adversary->getLifePoints() > 0){
                    $knight->receive_attack($adversary->sword_attack());
                    $adversary->setKnightsAlreadyDueled($knight->getId());
                }
            }
        }
    }
}