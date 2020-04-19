<?php
include "php/sqlConnection.php";


if( isset($_SESSION["snum"] ) )
{
$result = mysqli_query($con ,"select course.*  from course , enrolled where esnum = '". $_SESSION["snum"]. " ' and cname = ecname");
}else
{
    header("Location:index.php");
}

$rowcount = 0;

if($result == true)
    $rowcount=mysqli_num_rows($result);


 $courseList = '';


 $studentInfo = '';

 //fill student info

$studentInfo .= '<br>';
$studentInfo .= 'İsminiz:  '.$_SESSION["username"];
$studentInfo .= '<br><br>';
$studentInfo .= 'Numaranız: ' . $_SESSION["snum"];
$studentInfo .= '<br>';


if ($rowcount > 0) {

 
 
    while($row = mysqli_fetch_array($result , MYSQLI_ASSOC))
    {


      // begin new
      $courseList .= '<button class="collapsible">'  .$row["cname"].  '</button>';
      $courseList .= '<div class="content">';
      $courseList .= '<br>';
      $courseList .= '<h3>Ders Bigisi</h3>';
      $courseList .= '<p>'. $row["courseInfo"]   .'  </p>';


      $courseList .='<table>
     <tr>
     <th>Gün</th>
     <th>Başlangıç</th>
     <th>Bitiş</th>
     <th>Sınıf</th>
     </tr>';

      
      $courseList .= '<h4>Ders Saatleri</h4>';

      $schedules = mysqli_query($con ,"SELECT * FROM course_schedule WHERE scname = '". $row["cname"]."'");
      while($srow = mysqli_fetch_array($schedules  , MYSQLI_ASSOC))
      { 
        $courseList .='<tr>';
        $courseList .= '<td> '.  getDay($srow["meets_on"])   .'  </td>';
        $courseList .= '<td> '. $srow["meets_at"]   .'  </td>';
        $courseList .= '<td> '.   $srow["ends_at"]   .'  </td>';
        $courseList .= '<td> '.   $srow["room"]   .'  </td>';
        $courseList .='</tr>';
      
      }

      
      $courseList .= '</table>';
      $courseList .= '<br>';
      $courseList .= '</div>';




    }


}
?>

<?php include "pageHeader.php"; ?>


<div class="center" style="width:80%">

<table >
<tr>
<th width = "20%" valign="top">Oğrenci bilgisi</th>
<th width = "80%">Alınmış Dersler</th>
</tr>
<tr>
<td valign="top">
<p>  <?php echo $studentInfo; ?> </p>
</td>
<td>

 <?php echo $courseList; ?>
</td>
</tr>
</table>



</div>






<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.maxHeight){
      content.style.maxHeight = null;
    } else {
      content.style.maxHeight = content.scrollHeight + "px";
    } 
  });
}
</script>


<?php include "pageFooter.html"; ?>







