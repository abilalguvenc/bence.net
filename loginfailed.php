<?php session_start();?>
<?php include 'pageHeader.php'?>

 
<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
    <tr>
        <th>
            Giriş işlemi başarısız.
        </th>
    </tr>
    <tr>
        <td>
        <table>
            <td>
                <p id="SideInfo">   </p>
            </td>
            <td>
                <h1 id="homeBanner"> 
                Girdiğiniz eposta adresi veya <br>
                şifre hatalı olduğu için giriş <br>
                işlemi gerçekleştirilemedi! </h1>
            </td>
            <td>
                <p id="SideInfo">   </p>
            </td>
        </table>
        </td>
    </tr>
</table>

<script src="js/modal.js">
</script>

<?php include "pageFooter.html" ?>
