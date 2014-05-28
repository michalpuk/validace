<?php
function pripojeni_db()
{
 $con = mysql_connect("mysql.webzdarma.cz", "d12447", "michal1");
    if (!$con) {
      // jestliže se nepodaøí pøipojit, ukonèí program a vypíše chybu
     die('Could not connect: ' . mysql_error());
    }
     mysql_select_db('d12447');


  $chyba = mysql_error();
  if ($chyba) {
    echo "chyba v mysql: $chyba\n<br>";
  }
  
  

}

function dotaz_db($dotaz_db){

$chyba = mysql_error();
if($chyba)
{

echo $chyba;
}
else
{

return mysql_query($dotaz_db);

}

}

function editace($id_zaznamu,$nazev_tabulky){
  
 $dotaz=mysql_query("SELECT * FROM $nazev_tabulky where id_odbrec='$id_zaznamu'");
 $dotazq=mysql_fetch_array($dotaz);
 echo "<form action='./data.php' method='POST'>" ;
 echo "<table>";
 echo "<tr><td>nazev_hry:</td><td><input type='text' value='".$dotazq['nazev_hry']."' name='nazev_hry'></td></tr>";
 echo "<tr><td>nazev_magazinu:</td><td><input type='text' value='".$dotazq['nazev_magazinu']."' name='nazev_magazinu'></td></tr>";
  echo "<tr><td>jazyk_recenze:</td><td><input type='text' value='".$dotazq['jazyk_recenze']."' name='jazyk_recenze'></td></tr>"; 
 echo "<tr><td>datum_vydani_recenze:</td><td><input type='text' value='".$dotazq['datum_vydani_recenze']."' name='datum_vydani_recenze'></td></tr>";
 echo "<tr><td>hodnoceni_recenze:</td><td><input type='text' value='".$dotazq['hodnoceni_recenze']."' name='hodnoceni_recenze'></td></tr>";
 
   echo "<tr><td colspan='2'><input type='submit' name='editovat_zaznam' value='Editovat'></td></tr>";
   echo "<input type='hidden' name='id_odbrec' value='".$dotazq['id_odbrec']."'>";
 echo "</table>";
 echo "</form>";
}

function smazat_zaznam($id_zaznamu,$nazev_tabulky){
 $pom_id=mysql_query("SHOW COLUMNS FROM $nazev_tabulky");
 $jmeno_id=mysql_fetch_array($pom_id);
 mysql_query("DELETE FROM $nazev_tabulky where ".$jmeno_id['Field']."='$id_zaznamu'");

}


function novy(){
  
echo "<form action='./data.php' method='POST'>" ;
 echo "<table>";
 echo "<tr><td>nazev_hry:</td><td><input type='text' value='' name='nazev_hry'></td></tr>";
 echo "<tr><td>nazev_magazinu:</td><td><input type='text' value='' name='nazev_magazinu'></td></tr>";
  echo "<tr><td>jazyk_recenze:</td><td><input type='text' value='' name='jazyk_recenze'></td></tr>"; 
 echo "<tr><td>datum_vydani_recenze:</td><td><input type='text' value='' name='datum_vydani_recenze'></td></tr>";
 echo "<tr><td>hodnoceni_recenze:</td><td><input type='text' value='' name='hodnoceni_recenze'></td></tr>";
   echo "<tr><td colspan='2'><input type='submit' name='vlozit_zaznam' value='Vložit'></td></tr>";
   
   echo "<input type='hidden' name='id_odbrec' value=''>";
 echo "</table>";
 echo "</form>";
}



function tabulka_vypis($id_zobraz,$vysl_pom,$akce,$nazev_tabulky){
    $vysl_p=dotaz_db($vysl_pom);
    $vysl = mysql_fetch_assoc($vysl_p);  
    
    $pom_pocet=0;
    $pom_i =  $id_zobraz==1 ?  $pom_i=0 : $pom_i=1;
     if($akce==1){
  
  }
   echo "<h4><a href='data.php?akce=novy'>Nový záznam</a></h4>" ;
  echo "<table border='1'>";
  // hlavièka tabulky
  echo "<thead>";
  echo "<tr>";
  foreach(array_keys($vysl) as $klic){
    if ($id_zobraz==1){
     echo "<th>";
     echo $klic;
     echo "</th>";
    }
    else{
     $id_zobraz=1;
    }
    $pom_pocet++;
  } 
  if($akce==1){
  echo "<th colspan='2'>Akce</th>";
  }
  echo "</tr>";
  echo "</thead>";
  // øádky tabulky
  $vysl_pom=dotaz_db($vysl_pom);
  while($vypis = mysql_fetch_row($vysl_pom)){
    echo "<tr>";
    for ($i=$pom_i; $i<$pom_pocet; $i++){
      echo "<td>";
      echo $vypis[$i];
      echo "</td>";
    }
    if($akce==1){
      echo "<td>";
      echo "<a href='./data.php?akce=editovat&id=".$vypis[0]."'>Editovat</a>";
      echo "</td>";
      echo "<td>";
      echo "<a href='./data.php?akce=smazat&id=".$vypis[0]."' onclick=\"return(confirm('Opravdu chcete recenzi smazat?'));\">Smazat</a>";                     
      echo "</td>";
    }
    echo "</tr>";
  }
  
  echo "</table>";
  
  $akce=  !empty ($_GET['akce'])  ? $_GET['akce'] : '';
  if($akce=='smazat'){
    smazat_zaznam($_GET['id'],$nazev_tabulky);
  }
 
 if($akce=='editovat'){
    editace($_GET['id'],$nazev_tabulky);
  }
  if (isset($_POST['editovat_zaznam'])){
  mysql_query("UPDATE $nazev_tabulky SET nazev_hry='".$_POST['nazev_hry']."', nazev_magazinu='".$_POST['nazev_magazinu']."', jazyk_recenze='".$_POST['jazyk_recenze']."', datum_vydani_recenze='".$_POST['datum_vydani_recenze']."', hodnoceni_recenze='".$_POST['hodnoceni_recenze']."' where id_odbrec='".$_POST['id_odbrec']."'");
  
  }
  

  if($akce=='novy'){
    novy();
  }

  if (isset($_POST['vlozit_zaznam'])){
  mysql_query("INSERT INTO $nazev_tabulky SET nazev_hry='".$_POST['nazev_hry']."', nazev_magazinu='".$_POST['nazev_magazinu']."', jazyk_recenze='".$_POST['jazyk_recenze']."', datum_vydani_recenze='".$_POST['datum_vydani_recenze']."', hodnoceni_recenze='".$_POST['hodnoceni_recenze']."' where id_odbrec='".$_POST['id_odbrec']."'");
  
  }
  
  

}

function hledat($tabulka,$sloupec,$hodnota){
$q=mysql_query("SELECT * from $tabulka where $sloupec='".$hodnota."'");
 echo "<table border='1'>";
  echo "<thead>";
  echo " <<tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th></tr>" ; 
  echo "</thead>";
  while($radek=mysql_fetch_array($q)){
  echo "<tr>";
  
  echo "<td>";
  echo $radek['nazev_hry'];
  echo "</td>";
  
  echo "<td>";
  echo $radek['nazev_magazinu'];
  echo "</td>";
  
  echo "<td>";
  echo $radek['jazyk_recenze'];
  echo "</td>";
  
  echo "<td>";
  echo $radek['datum_vydani_recenze'];
  echo "</td>";
  
  echo "<td>";
  echo $radek['hodnoceni_recenze'];
  echo "</td>";
  
 
  
  
  echo "</tr>";
   }
  echo "</table>";
}




