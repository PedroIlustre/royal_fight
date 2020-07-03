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
            $obj_knight->setName($this->randomName().'_'.$i);
            $obj_knight->setKnightsAlreadyDueled(null);
            $arr_obj_knights[] = $obj_knight;
        }
        $this->death_match($arr_obj_knights, false);

        $this->setWinner();
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

    private function death_match(array $arr_obj_knights) : array{
        //echo '<pre>'; print_r($arr_obj_knights);
        if(count($arr_obj_knights) == 1){
            return $arr_obj_knights;
        }

        foreach($arr_obj_knights as $knight){
            if($knight->getLifePoints() > 0){
                $this->round($knight, $arr_obj_knights);
            } else {
                unset($knight);
            }
            $this->clear_round($knight);
        }
        
        echo '<pre>'; print_r($arr_obj_knights);   die;   
        $this->death_match($arr_obj_knights);
        
    }
    private function round (object $knight, $arr_obj_knights) : void{
        $num_knights = count($arr_obj_knights);
        for($i=0;$i < $num_knights-1;$i++){
            if($num_knights >= ($i+1)){
                $adversary = $arr_obj_knights[$i+1];
                if(!in_array($adversary->getId(),$knight->getKnightsAlreadyDueled()) && 
                    $adversary->getId() != $knight->getId()){    
                    
                    $adversary->receive_attack($knight->sword_attack());
                    $knight->setKnightsAlreadyDueled($adversary->getId());

                    $knight->receive_attack($adversary->sword_attack());
                    $adversary->setKnightsAlreadyDueled($knight->getId());
                }
            }
        }
    }

    private function clear_round(object $already_dueled) : void{
        //echo '<pre>'; print_r($already_dueled);   die;   
        foreach($already_dueled->getKnightsAlreadyDueled() as $knight_id){
            $knight_id = null;
        }
        echo '<pre>'; print_r($already_dueled->getKnightsAlreadyDueled());   die;
    }
}