<?php session_start();?>
<?php include 'pageHeader.php'?>

<body>
<div  id="mainWrapper">
 
     <div id="mainContent">
        <table border="0" cellspacing="0" cellpadding="0"
              id = "tableX"
               >
            <tr>
                <td width = "50%" valign="top" >
                <h1 id="homeBanner"> 
                    bence.net ile anketlere katılın <br>
                    ve fikrinizi beyan edin! </h1>

                <?php
                //include 'showCourse.php';
                // echo  $courseList;

                echo "Anket anket anket."
                ?>

                <td valign="top" width = "40%">
                <p id="SideInfo">  Çevrimiçi anketinizi hemen oluşturun ve sonuçları görmeye başlayın! </p>
            </tr>
        </table>
    </div>

</div>
<script src="js/modal.js"
></script>
</body>

<?php include "pageFooter.html" ?>
