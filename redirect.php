<?php

$h0 = '';
$h1 = '';
$hImage = '';
if(isset( $_SESSION['succes']) &&  $_SESSION['succes'] == true )
{
    $h0 = ' işlem başarıyla gerçekleşti! ';
    $h1 = ' anasayfaya yönlendiriliyorsunuz :';
    $hImage =  '<img style="width:250px;height:250px" src="' . './images/siteImages/succes.png' .'">';
}else
{
    $h0 = ' işlem gerçekleştirilemedi! ';
    if(isset($_SESSION['lastErrorMessage'])){
        $h0 .= $_SESSION['lastErrorMessage'];
         unset($_SESSION['lastErrorMessage']);
    }
    $h1 = ' anasayfaya yönlendiriliyorsunuz :';
     $hImage =  '<img style="width:250px;height:250px;" src="' . './images/siteImages/fail.png' .'">';
}

?>






<?php include "pageHeader.php" ?>




<table>
     <tr>
        <center> <?php echo $hImage ?> </center>

    </tr>
    <tr>
        <center> <p><?php echo $h0 ?> </p></center>
    </tr>
    <tr>
        
        <center> <p><?php echo $h1; ?>  </p></center>   

    </tr>


</table>




<?php include "pageFooter.html" ?>

<?php sleep(5);

header("Location:index.php");

//$_SESSION['succes'] = false
//header("Location:redirect.php");

?>