<?php session_start();

if( isset($_SESSION['login'] ))
{
    echo "log out suff...";

    session_destroy();
    header("Location:index.php");

}else{
    echo "not  even logged !!!";

    session_destroy();
    header("Location:index.php");
}
?>