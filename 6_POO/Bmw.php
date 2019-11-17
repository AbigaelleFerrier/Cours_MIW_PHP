<?php

class Bmw extends Vehicule
{
    public function reculer(){
		if($this->jauge>0){
			$this->kmParcouru += 3;
			$this->jauge -= 2;
			return true;
		}else{
			$this->erreur .= 'Panne d\'essence!';
			return false;
		}
    }
    
    public function avancer(){
		if($this->jauge>0){
			$this->kmParcouru += 3;
			$this->jauge -= 2;
			if(rand(0,100)<5){
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
