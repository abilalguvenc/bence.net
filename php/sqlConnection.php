<?php session_start();

$db_host = "localhost"; 
$db_username = "root";  
$db_pass = "";  
$db_name = "bence"; 

$con = mysqli_connect($db_host,$db_username,$db_pass) or die ("MySQL bağlantısı sağlanamadı.");

mysqli_set_charset($con ,'utf8');

mysqli_select_db($con,$db_name) or die ("Bence isminde veritabanı bulunamadı."); 


function setError($msg)
{
    $_SESSION['succes'] == false;
    $_SESSION['lastErrorMessage'] = $msg;
}


function getDay($dayNum)
{
    switch ($dayNum) {
        case 0:
            return "Pazartesi";
            break;
        case 1:
            return "Salı";
            break;
        case 2:
            return "Çarşamba";
            break;
        case 3:
            return "Perşembe";
            break;
        case 4:
            return "Cuma";
            break;
        case 5:
            return "Cumartesi";
            break;
        case 6:
            return "Pazar";
            break;            
        default:
            return "??";
            break;
    }
}


?>