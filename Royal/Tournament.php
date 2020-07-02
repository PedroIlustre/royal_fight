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
            $obj_knight->setName('Pedro'.'_'.($i+1));
            //$obj_knight->setName($this->randomName().'_'.$i);
            $obj_knight->setKnightsAlreadyDueled(null);
            $arr_obj_knights[] = $obj_knight;
        }
        $this->setWinner($this->death_match($arr_obj_knights));
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

    private function randomName() : array {
        $names = array(
            'Sebastian',
            'Napoleon',
            'Augustus',
            'Pedro',
            'Aquila',
        );
        return $names[rand ( 0 , count($names) -1)];
    }

    private function death_match(array $arr_obj_knights) : array{
        foreach($arr_obj_knights as $knight){
            $this->duel($knight, $arr_obj_knights);
        }
        return $arr_obj_knights;
    }

    private function duel (object $knight, $arr_obj_knights) : void{
        $num_knights = count($arr_obj_knights);
        for($i=0;$i < $num_knights-1;$i++){
            if($num_knights >= ($i+1)){
                if(!in_array($arr_obj_knights[$i+1]->getId(),$knight->getKnightsAlreadyDueled()) && 
                $arr_obj_knights[$i+1]->getId() != $knight->getId()){    
                    $adversary = $arr_obj_knights[$i+1];
                    
                    $adversary->receive_attack($knight->sword_attack());
                    $knight->setKnightsAlreadyDueled($adversary->getId());

                    $knight->receive_attack($adversary->sword_attack());
                    $adversary->setKnightsAlreadyDueled($knight->getId());
                }
            }
        }
        
    }
}