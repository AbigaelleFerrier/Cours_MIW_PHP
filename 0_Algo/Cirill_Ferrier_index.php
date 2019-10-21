<?php 
    $nom = 'Ferrier';
    $prenom = 'Cirill';
    define('age','21'); 

    echo "Je m'appelle $prenom $nom <br>";
    echo 'Age : ' .age;

    echo "<br>------------------------<br>"; // -------------------

    
    echo (($nb = rand(0, 100)) < age) ? $nb .' < à AGE' : $nb .' > à AGE';
   
    
    echo "<br>------------------------<br>"; // -------------------

    $str = true; //sortie de boucle
    while ($str) {
        (($nb = rand(0, 100)) < age) ? $str =  false : '';
    }

    echo '4)'. $nb;


    echo "<br>------------------------<br>"; // -------------------


    function exo5() {
        return (($nb = rand(0, 100)) < age) ? $nb : exo5();
    }

    echo '5) '. exo5();


    echo "<br>------------------------<br>"; // -------------------

    $tab = [
        -125    => 60,
        1       => 5,
        555     => -99,
        0       => 99,
        50      => 1,
    ];

    function somme($tab) {
        $tt = 0;
        foreach ($tab as $value) {
            $tt += $value;
        }
        return $tt;
    }

    echo somme($tab);

    echo "<br>------------------------<br>"; // -------------------
    


    function maxValueValue($tab) {
        foreach ($tab as $value) {
            $max =  (!isset($max))  ? $value 
                                    : ($max < $value) ? $value 
                                                      : $max ;
        }
        return $max;
    }

    echo 'maxValueValue -->' . maxValueValue($tab);

    echo "<br>------------------------<br>"; // -------------------


    function minValueValue($tab) {
        foreach ($tab as $value) {
            $min =  (!isset($min))  ? $value 
                                    : ($min > $value) ? $value 
                                                      : $min ;
        }
        return $min;
    }

    echo 'minValueValue -->' . minValueValue($tab);

    echo "<br>------------------------<br>"; // -------------------


    function maxValueIndex($tab) {
        foreach ($tab as $key => $value) {
            $max =  (!isset($max)) ? $key 
                                   : ($max < $key) ? $key 
                                                   : $max ;
        }
        return $max;
    }

    echo 'maxValueIndex -->' . maxValueIndex($tab);

    echo "<br>------------------------<br>"; // -------------------


    function minValueIndex($tab) {
        foreach ($tab as $key => $value) {
            $min =  (!isset($min))  ? $key 
                                    : ($min > $key) ? $key 
                                                    : $min ;
        }
        return $min;
    }

    echo 'minValueIndex -->' . minValueIndex($tab);
