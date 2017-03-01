<?php


if(isset($_POST['post'])){
    $kwota = strip_tags($_POST['kwota']);
//   $ileDni = strip_tags($_POST['ileDni']);
    
    $terminPlatnosci = new DateTime($_POST['terminPlatnosci']);
    $dataZaplaty = new DateTime($_POST['dataZaplaty']);
    
    }
    $iloscDni = $dataZaplaty->diff($terminPlatnosci);
    
    //$stopaProcentowa = 0.07;
    //$dniRoku = 365;

    //$wyn = ($kwota * ($iloscDni->format('%a')) * $stopaProcentowa)/$dniRoku;
    //$wynik = round($wyn, 2);
    
    

    
    
    echo $iloscDni->format('Ilosc dni zwloki: %a ')."<br>";
    //echo "Stopa procentowa: ".$stopaProcentowa."<br>";
    //echo "<h2>Odsetki wynosza: ".$wynik." zl</h2>";
    
    
    if($terminPlatnosci<=date('2016-01-01')){
        echo 0.05;
    }else echo "dupa";


?>
