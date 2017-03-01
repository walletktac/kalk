<?php
    session_start();
   require_once 'db.php';
   
   
   
    $sql = "SELECT * FROM stopy ORDER BY id ASC";
		
    $result = mysqli_query($db, $sql) or die(mysqli_error());
    
    
    
    mysqli_query($db, $sql);
   
    
    if(isset($_POST['post'])){
    $kwota = strip_tags($_POST['kwota']);
//   $ileDni = strip_tags($_POST['ileDni']);
    
    $terminPlatnosci = new DateTime($_POST['terminPlatnosci']);
    $dataZaplaty = new DateTime($_POST['dataZaplaty']);
    
    }
    $iloscDni = $dataZaplaty->diff($terminPlatnosci);
    
    $stopaProcentowa = 0.07;
    $dniRoku = 365;

    $wyn = ($kwota * ($iloscDni->format('%a')) * $stopaProcentowa)/$dniRoku;
    $wynik = round($wyn, 2);
    
    

    
    
    echo $iloscDni->format('Ilosc dni zwloki: %a ')."<br>";
    echo "Stopa procentowa: ".$stopaProcentowa."<br>";
    echo "<h2>Odsetki wynosza: ".$wynik." zl</h2>";
   
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
                $id = $row['id'];
                $poczatek = $row['poczatek'];
                $koniec = $row['koniec'];
                $wartosc = $row['wartosc'];
                
              echo "<div><h5>$id</h5><p>$poczatek</p><p>$koniec</p><p style='color:red;'>$wartosc</p><hr></div>";  

        }
    }else {
        echo "lipa";
        
    }
    
?>