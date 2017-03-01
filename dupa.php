
<?php
$poczatkowa = new DateTime($_POST['poczatkowa']);
$koncowa = new DateTime($_POST['koncowa']);
$zaleglosc = $_POST['zaleglosc'];
if ($poczatkowa != "") {
    $db_data = array();

    $db_stopa = array();
    
    $db_data[0]  = "1990-07-01";
    $db_data[1]  = "1990-12-01";
    $db_data[2]  = "1991-03-01";
    $db_data[3]  = "1991-09-15";
    $db_data[4]  = "1992-08-15";
    $db_data[5]  = "1993-05-01";
    $db_data[6]  = "1995-12-15";
    $db_data[7]  = "1997-01-01";
    $db_data[8]  = "1998-04-15";
    $db_data[9]  = "1999-02-01";
    $db_data[10] = "1999-05-15";
    $db_data[11] = "2000-11-01";
    $db_data[12] = "2001-12-15";
    $db_data[13] = "2002-07-25";
    $db_data[14] = "2003-02-01";
    $db_data[15] = "2003-09-25";
    $db_data[16] = "2005-01-10";
    $db_data[17] = "2005-10-15";
    $db_data[18] = "2008-12-15";
    $db_data[19] = "2014-12-23";
    $db_data[20] = "2016-01-01";
    $db_stopa[0] = "0.6";
    $db_stopa[1] = "0.9";
    $db_stopa[2] = "1.4";
    $db_stopa[3] = "0.8";
    $db_stopa[4] = "0.6";
    $db_stopa[5] = "0.54";
    $db_stopa[6] = "0.46";
    $db_stopa[7] = "0.35";
    $db_stopa[8] = "0.33";
    $db_stopa[9] = "0.24";
    $db_stopa[10] = "0.21";
    $db_stopa[11] = "0.3";
    $db_stopa[12] = "0.2";
    $db_stopa[13] = "0.16";
    $db_stopa[14] = "0.13";
    $db_stopa[15] = "0.1225";
    $db_stopa[16] = "0.135";
    $db_stopa[17] = "0.115";
    $db_stopa[18] = "0.13";
    $db_stopa[19] = "0.08";
    $db_stopa[20] = "0.05";




  //  $poczatkowa = explode("/", chop($poczatkowa)); //wyciagamy z stringa date dzien i miesiac


    //$poczatkowa = strtotime($poczatkowa[2] . '-' . $poczatkowa[1] . '-' . $poczatkowa[0]); //ustalamy stempel czasu dla poczatku---/



   // $koncowa = explode("/", chop($koncowa)); //wyciagamy z stringa date dzien i miesiac

   // $koncowa = strtotime($koncowa[2] . '-' . $koncowa[1] . '-' . $koncowa[0]); //---a tu stempel czasu dla konca

  //  $zaleglosc = chop($zaleglosc); //usuwamy rn
    //--ta petla rozwala nam string na daty i zamienia je na stempel czasu

 //   for ($i = 0; $i < count($db_data); $i++) {
 //       $ex = explode("/", $db_data[$i]);

//        $tim = strtotime($ex[2] . '-' . $ex[1] . '-' . $ex[0]);

//        $db_data[$i] = $tim;
 //   }





    //ustalam index ostatniej daty

    $lastID = count($db_data) - 1;



    // wykonuje obliczenia dla daty spoza zakresu

    if ($db_data[$lastID] < $poczatkowa) {
        $roznica_dni = ($koncowa->diff($poczatkowa));
        $odsetki = ($zaleglosc * ($roznica_dni->format('%a')) * $db_stopa[$lastID]) / 365; // wyliczymy odsetki
       echo $roznica_dni->format('%a')."<br>";
       
    } elseif ($db_data[0] > $poczatkowa) {
        echo "nima";
    } else {
        $odsetki = array();

        // szukam pierwszegp progu
        $p = 0;
        for ($i = 0; $i < $lastID; $i++) {
            $p = $i;
            if ($db_data[$i] < $poczatkowa && $db_data[$i + 1] > $poczatkowa) {
                break;
            }
        }
        //szukam ostatniego progu

        $k = 0;
        for ($i = $p; $i < $lastID; $i++) {
            $k = $i;
            if ($db_data[$i - 1] < $koncowa && ($i + 1 == $lastID || $db_data[$i + 1] > $koncowa)) {
                break;
            }
        }


        // licze odsetki na pierwszym progu

        $roznica_dni = $db_data[$p + 1]->diff($poczatkowa);
        $odsetki[] = (($zaleglosc * ($roznica_dni->format('%a')) * $db_stopa[$p]) / 365); // wyliczymy odsetki
      
        //licze odsetki miedzy programi

        if ($koncowa > $db_data[$p + 2]) {
            $n = 1;
            for ($i = $p + 1; $i <= $k; $i++) {
                $roznica_dni =$db_data[$i + 1]->diff($db_data[$i]);
                $odsetki[] = (($zaleglosc * ($roznica_dni->format('%a')) * $db_stopa[$p + $n]) / 365); // wyliczymy odsetki
                $n++;
         
            }
        }


        //wyliczamy koncowy prog

        if ($koncowa > $db_data[$lastID]) {
            $roznica_dni =$koncowa->diff($db_data[$lastID]);
            $odsetki[] = (($zaleglosc * ($roznica_dni->format('%a')) * $db_stopa[$lastID]) / 365); // wyliczymy odsetki
          
            
        } else {
            if ($koncowa > $db_data[$p + 1]) {
                $roznica_dni = $koncowa->diff($db_data[$k]);
                $odsetki[] = (($zaleglosc * ($roznica_dni->format('%a')) * $db_stopa[$k]) / 365); // wyliczymy odsetki
               
            }
        }

        $ods = $odsetki;
        $odsetki = 0;
        foreach ($ods as $val) {
            $odsetki += $val;
        }
    }

   
    echo $odsetki = round($odsetki, 2);
}
?>
