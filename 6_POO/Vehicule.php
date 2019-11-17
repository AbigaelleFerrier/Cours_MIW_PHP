<?php
/**
 * Created by PhpStorm.
 * User: Romain
 * Date: 01/10/2016
 * Time: 10:57
 */

class Vehicule implements iVehicule { //une classe peut implémenter plusieurs interfaces mais ne peut étendre qu'une classe
	protected $marque;
	/** @var  int $jauge  */
	protected $jauge;
	protected $kmParcouru;
	/** @var string $erreur */
	protected $erreur='';

	protected $avanceEncore = true;

	/**
	 * 1km parcouru consomme 1% d'essence. Pas d'accident quand on recule
	 * @return bool
	 */
	public function reculer(){
		if($this->jauge>0){
			$this->kmParcouru++;
			$this->jauge--;
			return true;
		}else{
			$this->erreur .= 'Panne d\'essence!';
			return false;
		}
	}

	/**
	 * 1km parcouru consomme 1% d'essence. Un véhicule standard à une chance sur 100 d'avoir un accident
	 * @return bool
	 */
	public function avancer(){
		if($this->jauge>0){
			$this->kmParcouru++;
			$this->jauge--;
			if(rand(0,100)==0){
				$this->erreur .= 'Accident!';
				return false;
			}
			return true;
		}else{
			$this->erreur .= 'Panne d\'essence!';
			return false;
		}
	}


	public function faireLePlein(){
		$this->jauge = 100;
	}

	//GETTER SETTER
	public function setMarque($marque){
		$this->marque = $marque;
	}

	public function getMarque(){
		return $this->marque;
	}

	public function setJauge($jauge){
		$this->jauge = $jauge;
	}

	public function getJauge(){
		return $this->jauge;
	}

	public function setKmParcouru($kmParcouru){
		$this->kmParcouru = $kmParcouru;
	}

	public function getKmParcouru(){
		return $this->kmParcouru;
	}

	public function setErreur($eerur){
		$this->erreur = $eerur;
	}

	public function getErreur(){
		return $this->erreur;
	}
}