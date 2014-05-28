<?php
function hlavicka($title){
echo "<!DOCTYPE html>
<html>
<head>
  <meta charset='utf8'>
  <title>$title</title>
  <link rel='stylesheet' type='text/css' href='style.css' />
</head>";

}
function menu1() {             

   echo    '<div id="menu_tab">                                     
                    <ul class="menu">                                                                               
                         <li><a href="index.php" class="nav_selected">Domů</a></li>
                         <li><a href="nic.php" class="nav">nic</a></li>
                         <li><a href="tabulka.php" class="nav">tabulka</a></li>
                         <li><a href="data.php" class="nav">Databáze</a></li>
                         

                    </ul>
            </div>' ;
}

function menu2() {             

   echo    '<div id="menu_tab">                                     
                    <ul class="menu">                                                                               
                         <li><a href="index.php" class="nav">Domů</a></li>
                         <li><a href="nic.php" class="nav_selected">nic</a></li>
                         <li><a href="tabulka.php" class="nav">tabulka</a></li>
                         <li><a href="data.php" class="nav">Databáze</a></li>

                    </ul>
            </div> ' ;
                        }
            
function menu3(){ echo '<div id="menu_tab">                                     
                    <ul class="menu">                                                                               
                         <li><a href="index.php" class="nav">Domů</a></li>
                         <li><a href="nic.php" class="nav">nic</a></li>
                         <li><a href="tabulka.php" class="nav_selected">tabulka</a></li>
                         <li><a href="data.php" class="nav">Databáze</a></li>
                    </ul>
            </div>' ;
            }   
            
            
function menu4(){  echo  '<div id="menu_tab">                                     
                    <ul class="menu">                                                                               
                         <li><a href="index.php" class="nav">Domů</a></li>
                         <li><a href="nic.php" class="nav">nic</a></li>
                         <li><a href="tabulka.php" class="nav">tabulka</a></li>
                         <li><a href="data.php" class="nav_selected">Databáze</a></li>
                         

                    </ul>
            </div>  ';

}            
                     
function paticka(){
echo "</html> ";


}

?>