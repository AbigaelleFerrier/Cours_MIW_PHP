<?php
error_reporting(E_ALL);

include 'fonctions.php';
include 'iVehicule.php';
include 'Vehicule.php';
include 'Renault.php';
include 'Bmw.php';


$voiture = new Vehicule();
$voiture->faireLePlein();

$oRenault = new Renault();
$oRenault->faireLePlein();

$oBmw = new Bmw();
$oBmw->faireLePlein();

echo '<table style="text-align:center">';
	echo '<thead>
			<tr>
				<th style = "padding: 0 2em"></th>
				<th style = "padding: 0 2em">Voiture</th>
				<th style = "padding: 0 2em">Renault</th>
				<th style = "padding: 0 2em">Bmw</th>
			</tr>
		</thead>
		<tbody>';

	for($i=0; $i<100; $i++){
		echo "<tr>";
			
			echo '<td>'. ($i+1) .' km</td>';
			echo '<td>';
				if($voiture->getErreur() == '') {
					if($voiture->avancer()){
					echo 'J\'avance !';
					}else{
						echo $voiture->getErreur();
					}
				}
				else {
					echo '---';
				}
			echo '</td>';


			echo '<td>';
				if($oRenault->getErreur() == '') {
					if($i%2==0) {
						if($oRenault->avancer()){
							echo 'J\'avance !';
						}else{
							echo $oRenault->getErreur();
						}	
					}
					else {
						echo '<img width="50" src="https://media.giphy.com/media/7T2OKoNuL6wspqIXmm/giphy.gif">';
					}
				}
				else {
					echo '---';
				}
			echo '</td>';


			echo '<td>';
				if($oBmw->getErreur() == '') {
					if($i%3==0) {
						if($oBmw->avancer()){
							echo 'J\'avance !';
						}else{
							echo $oBmw->getErreur();
						}
					}
					else {
						echo '<img width="40" src="https://media.giphy.com/media/7T2OKoNuL6wspqIXmm/giphy.gif">';
					}
				}
				else {
					echo '---';
				}
			echo '</td>';

		echo '</tr>';
	}
echo '</tbody></table>';

/*
 * TP       : Créer 3 classes                                                   : 
 * - Renault: consomme deux fois moins que Véhicule,                              a 3% de chance de tomber en panne mécanique en avançant
 * - Bmw    : consomme deux fois plus et roule trois fois plus vite que Véhicule, a 5% de chance d'avoir un accident de la route ( http://s2.quickmeme.com/img/cb/cbb19102f4ada827be3c87b54b169e1eb8b50e69631e456600fc8fd2959c3766.jpg )
 */


