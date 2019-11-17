<?php

class Renault extends Vehicule
{
    public function reculer(){
		if($this->jauge>0){
			$this->kmParcouru++;
			$this->jauge -= 0.5;
			return true;
		}else{
			$this->erreur .= 'Panne d\'essence!';
			return false;
		}
    }
    
    public function avancer(){
		if($this->jauge>0){
			$this->kmParcouru += 2;
			$this->jauge -- ;
			if(rand(0,100)<3){
				$this->erreur .= 'Accident!';
				return false;
			}
			return true;
		}else{
			$this->erreur .= 'Panne d\'essence!';
			return false;
		}
	}
}
