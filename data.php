 <?php
 require ('./FunkceZobraz.php');
 hlavicka("Databaze");
 ?>
<body>

<div id="C1">

	<div id="C2">
 
    
    </div>
    
</div>
            
            
    <div id="S1">
    
    	<div class="center">
           <?php
            menu4();
            
             ?>
            
            <div class="welcome_block">
            	
            
                     <div class="hlavni">
                    
                      <div> <h1>Databáze</h1>
                <p>

<?php
error_reporting (E_ALL ^ E_NOTICE);
$con = mysql_connect("mysql.webzdarma.cz", "d12447", "michal1");
    if (!$con) {
$actualfile = $_SERVER['PHP_SELF'];
 die('Could not connect: ' . mysql_error());
    }
     mysql_select_db("d12447");
      $chyba = mysql_error();
  if ($chyba) {
    echo "chyba v mysql: $chyba\n<br>";
  } 
  

function overitDatum($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}

if ((!$_GET['over']) and (!$_GET['check']) and (!$_GET['vlozit_novy']) and (!$_GET['potvrdit']) and (!$_GET['porovnat']) and (!$_GET['zpet1']) and (!$_GET['zpet2']) and (!$_GET['smazat2']) or ($_GET['odborne_recenze']) or ($_GET['zpet'])){
$vysledek = mysql_query("SELECT * FROM odborne_recenze");
    if (!$vysledek) die("Chyba");
  echo  "<table border=1>
         <tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th><th>EDITACE</th></tr>" ; 
  while ($zaznam = mysql_fetch_array($vysledek)) {
  	echo "<tr>
          <td>".$zaznam['nazev_hry']."</td>
          <td>".$zaznam['nazev_magazinu']."</td>
          <td>".$zaznam['jazyk_recenze']."</td>
          <td>".$zaznam['datum_vydani_recenze']."</td>
          <td>".$zaznam['hodnoceni_recenze']."</td>
          <td>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='smazat' value='SMAZAT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='upravit' value='UPRAVIT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          </td>
          </tr>";
  }
     
  echo "</table><br />";
  
  echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='vlozit_novy' value='NOVÝ ZÁZNAM'>
        </form>";
        
  echo "<form action='".$actualfile."' metod='get'>
        Zadej nazev hry: <input type='text' name='porovnat' value='' size='50'>
        <input type='submit' name='vyhledat' value='VYHLEDAT'>        
        </form>";
          
  }
  
 
  if (($_GET['upravit']) or ($_GET['zpet1'])){ 
  $vysledek = mysql_query("SELECT * FROM odborne_recenze WHERE id_odbrec='".$_GET['over']."'");
  $zaznam = mysql_fetch_array ($vysledek, MYSQL_ASSOC);
  echo "<form action='".$actualfile."' metod= 'get'>
        nazev hry:<input type='text' name='nove_jmeno' value='".$zaznam['nazev_hry']."' size='50'><br />
        nazev magazinu:<input type='text' name='nova_trida' value='".$zaznam['nazev_magazinu']."' size='50'><br />
        jazyk recenze:<input type='text' name='nova_adresa' value='".$zaznam['jazyk_recenze']."' size='50'><br />
        datum vydani recenze:<input type='text' name='nove_dat' value='".$zaznam['datum_vydani_recenze']."' size='15'><br />
        hodnoceni recenze:<input type='text' name='nove_jm' value='".$zaznam['hodnoceni_recenze']."' size='50'><br /><br />
        <input type='submit' value='ULOŽ'>
        <input type ='hidden' name='uprava_res' value='1'>
        <input type='hidden' name='check' value='".$zaznam['id_odbrec']."'>
        </form>";
        
        echo "<br />
        <form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='ZPÌT'>        
        </form>"; 
  }
  
  if (($_GET['uprava_res']) and ($_GET['nove_jmeno']) and ($_GET['nova_trida']) and ($_GET['nova_adresa']) and(overitDatum($_GET['nove_dat'])==true)and ($GET_['nove_jm'])){
  $sql="UPDATE odborne_recenze SET  
        nazev_hry='".$_GET['nove_jmeno']."',
        nazev_magazinu='".$_GET['nova_trida']."',
        jazyk_recenze='".$_GET['nova_adresa']."',
        datum_vydani_recenze='".$_GET['nove_dat']."',
        hodnoceni_recenze=''".$_GET['nove_jm']."'
        WHERE id_odbrec='".$_GET['check']."'";
  if($res=mysql_query($sql)){
  echo "<b>UPOZORNÌNÍ:</b> Úprava probìhla úspìšnì.
  <br />";
  };
  if(!$res){
  echo "<b>UPOZORNÌNÍ:</b> Úprava neprobìhla úspìšnì. (". mysql_error().
  ")<br />";
  }
  
  $vysledek = mysql_query("SELECT * FROM odborne_recenze");
    if (!$vysledek) die("Chyba");
  echo  "<table border=1>
        <tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th><th>EDITACE</th></tr>" ; 
  while ($zaznam = mysql_fetch_array($vysledek)) {
  	echo "<tr>
         <td>".$zaznam['nazev_hry']."</td>
          <td>".$zaznam['nazev_magazinu']."</td>
          <td>".$zaznam['jazyk_recenze']."</td>
          <td>".$zaznam['datum_vydani_recenze']."</td>
          <td>".$zaznam['hodnoceni_recenze']."</td>
          <td>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='smazat' value='SMAZAT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='upravit' value='UPRAVIT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          </td>
          </tr>";
  }
     
  echo "</table><br />";
  
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='vlozit_novy' value='NOVÝ ZÁZNAM'>
        </form>";
        
      echo "<form action='".$actualfile."' metod='get'>
        Zadej nazev hry: <input type='text' name='porovnat' value='' size='50'>
        <input type='submit' name='vyhledat' value='VYHLEDAT'>        
        </form>";
  }
 if (($_GET['uprava_res']) and ((!$_GET['nove_jmeno']) or (!$_GET['nova_trida']) or (!$_GET['nove_dat']) or (overitDatum($_GET['nove_dat'])==false)or (!$_GET['nove_jm']))){
  echo "<b>UPOZORNÌNÍ:</b> Úprava neprobìhla úspìšnì.<br />";
  
      echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet1' value='Upravit znova'>
        <input type='hidden' name='over' value='".$_GET['check']."'>
        </form>";
        
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='Ukonèit upravování'>        
        </form>"; 
        
  }
   
  if ($_GET['smazat']){
   
  echo"VAROVÁNÍ
  <br />";
  
  echo"Opravdu si pøejete záznam smazat?";
  
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='smazat2' value='ANO'>
        <input type='hidden' name='over' value='".$_GET['over']."'>
        </form>";
        
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='NE'>        
        </form>"; 
  }
  
  if ($_GET['smazat2']){
  $sql="DELETE FROM odborne_recenze WHERE id_odbrec='".$_GET['over']."'";
  if($res=mysql_query($sql)){
  echo "<b>UPOZORNÌNÍ:</b> Smazání probìhlo úspìšnì.
  <br />";
  };
  if(!$res){
  echo "<b>UPOZORNÌNÍ:</b> Smazání neprobìhlo úspìšnì.(". mysql_error().
  ")<br />";
  }
  
  $vysledek = mysql_query("SELECT * FROM odborne_recenze");
    if (!$vysledek) die("Chyba");
  echo  "<table border=1>
          <tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th><th>EDITACE</th></tr>" ; 
  while ($zaznam = mysql_fetch_array($vysledek)) {
  	echo "<tr>
         <td>".$zaznam['nazev_hry']."</td>
          <td>".$zaznam['nazev_magazinu']."</td>
          <td>".$zaznam['jazyk_recenze']."</td>
          <td>".$zaznam['datum_vydani_recenze']."</td>
          <td>".$zaznam['hodnoceni_recenze']."</td>
          <td>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='smazat' value='SMAZAT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='upravit' value='UPRAVIT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          </td>
          </tr>";
  }
 
     
  echo "</table><br />";
  
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='vlozit_novy' value='NOVÝ ZÁZNAM'>
        </form>";
        
          echo "<form action='".$actualfile."' metod='get'>
        Zadej nazev hry: <input type='text' name='porovnat' value='' size='50'>
        <input type='submit' name='vyhledat' value='VYHLEDAT'>        
        </form>";
  }
  
  if (($_GET['vlozit_novy']) or ($_GET['zpet2'])){
  $x=-1;
  $p=0;      
  echo "<form action='".$actualfile."' metod='get'>";
        
        $vysledek = mysql_query("SELECT id_odbrec FROM odborne_recenze");
    if (!$vysledek) die("Chyba");
  $z = mysql_num_rows($vysledek);  
  while ($zaznam = mysql_fetch_array($vysledek)) {
  $p=$p+1;
  $x=$x +1;
  if (($zaznam['id_odbrec']) != $x){
  break;
  }
  }
  
  if ($z == $p){
  $x=$x+2;
  }

        echo"nazev_hry: <input type='text' name='nazev_hry' size='50'><br />
        nazev_magazinu: <input type='text' name='nazev_magazinu' size='50'><br />
        jazyk_recenze: <input type='text' name='jazyk_recenze' size='50'><br />
        datum_vydani_recenze: <input type='text' name='datum_vydani_recenze' size='15'><br />
        hodnoceni_recenze: <input type='text' name='hodnoceni_recenze' size='50'><br />
        <input type='submit' name='potvrdit' value='POTVRDIT'>
        <input type='hidden' name='nid' value='$x'>
        </form>
        ";
        
        echo "<br />
        <form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='ZPÌT'>        
        </form>"; 
        }
        
  if (($_GET['potvrdit']) and ($_GET['nazev_hry']) and ($_GET['nazev_magazinu']) and($_GET['jazyk_recenze']) and (overitDatum($_GET['datum_vydani_recenze'])==true) and ($_GET['hodnoceni_recenze'])){
  $c=$_GET['nid'];
  $sql="INSERT INTO odborne_recenze(id_odbrec, nazev_hry, nazev_magazinu, jazyk_recenze, datum_vydani_recenze, hodnoceni_recenze)
  VALUES($c,'".$_GET['nazev_hry']."','".$_GET['nazev_magazinu']."','".$_GET['jazyk_recenze']."','".$_GET['datum_vydani_recenze']."','".$_GET['hodnoceni_recenze']."')";
  if($res=mysql_query($sql)){
  echo "<b>UPOZORNÌNÍ:</b> Vložení nového záznamu probìhlo úspìšnì.
  <br />";
  };
  if(!$res){
  echo "<b>UPOZORNÌNÍ:</b> Vložení  nového záznamu neprobìhlo úspìšnì.(". mysql_error().
  ")<br />";
  }
  
  $vysledek = mysql_query("SELECT * FROM odborne_recenze");
    if (!$vysledek) die("Chyba");
  echo  "<table border=1>
         <<tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th><th>EDITACE</th></tr>" ; 
  while ($zaznam = mysql_fetch_array($vysledek)) {
  	echo "<tr>
         <td>".$zaznam['nazev_hry']."</td>
          <td>".$zaznam['nazev_magazinu']."</td>
          <td>".$zaznam['jazyk_recenze']."</td>
          <td>".$zaznam['datum_vydani_recenze']."</td>
          <td>".$zaznam['hodnoceni_recenze']."</td>
          <td>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='smazat' value='SMAZAT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          <form action='".$actualfile."' metod='get'>
          <input type='submit' name='upravit' value='UPRAVIT'>
          <input type='hidden' name='over' value='".$zaznam['id_odbrec']."'>
          </form>
          
          </td>
          </tr>";
  }
 
     
  echo "</table><br />";
  
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='vlozit_novy' value='NOVÝ ZÁZNAM'>
        </form>";
        
          echo "<form action='".$actualfile."' metod='get'>
        Zadej nazev hry: <input type='text' name='porovnat' value='' size='50'>
        <input type='submit' name='vyhledat' value='VYHLEDAT'>        
        </form>";
  }
  
  if (($_GET['potvrdit']) and ((!$_GET['nazev_hry']) or (!$_GET['nazev_magazinu']) or(!$_GET['jazyk_recenze']) or (overitDatum($_GET['datum_vydani_recenze'])==false) or (!$_GET['hodnoceni_recenze']))){
  echo "<b>UPOZORNÌNÍ:</b> Úprava neprobìhla úspìšnì.<br />";
  
      echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet2' value='Vložit znova'>
        </form>";
        
    echo "<form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='Ukonèit vkládání'>        
        </form>"; 
        
  }
          
  if ($_GET['porovnat']){
  
  $vysledek = mysql_query("SELECT * FROM odborne_recenze WHERE nazev_hry='".$_GET['porovnat']."'");
    if (!$vysledek) die("Chyba");
  echo  "<table border=1>
     <<tr><th>nazev hry</th><th>nazev magazinu</th><th>jazyk recenze</th><th>datum vydani recenze</th><th>hodnoceni recenze</th></tr>" ; 
  while ($zaznam = mysql_fetch_array($vysledek)) {
  	echo "<tr>
            <td>".$zaznam['nazev_hry']."</td>
          <td>".$zaznam['nazev_magazinu']."</td>
          <td>".$zaznam['jazyk_recenze']."</td>
          <td>".$zaznam['datum_vydani_recenze']."</td>
          <td>".$zaznam['hodnoceni_recenze']."</td>
          </tr>";
  }
 
     
  echo "</table><br />";
  
  echo "<br />
        <form action='".$actualfile."' metod='get'>
        <input type='submit' name='zpet' value='ZPÌT'>        
        </form>"; 
        
  }
?>
 
  
 
  
</p>        
        </div>                               
                    </div>  
		        
				
                <div class="clear"></div>
                  
            
        </div>
           
    </div>
    
    <div id="spodek">
       
    </div>

</div>
</body>
</html>
