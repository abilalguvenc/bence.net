<?php
include "php/sqlConnection.php";

$result = mysqli_query($con ,"SELECT * FROM course");

$rowcount = 0;

if($result == true)
    $rowcount=mysqli_num_rows($result);


 $courseList = '';

 $studentInfo = '';

if ($rowcount > 0) {

 
 
    while($row = mysqli_fetch_array($result , MYSQLI_ASSOC))
    {


      // begin new
      $courseList .= '<button class="collapsible">'  .$row["cname"].  '</button>';
      $courseList .= '<div class="content">';
      $courseList .= '<br>';
      $courseList .= '<h3>Anket Bilgisi</h3>';
      $courseList .= '<p>'. $row["courseInfo"]   .'  </p>';

      $schedules = mysqli_query($con ,"SELECT * FROM course_schedule WHERE scname = '". $row["cname"]."'");
      if(!!$schedules)
      {
        $courseList .= '<h4>Sorular</h4>';
        $courseList .='<table>
        <tr>
        <th>Gün</th>
        <th>Başlangıç</th>
        <th>Bitiş</th>
        <th>Sınıf</th>
        </tr>';
       
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
      }
      else
        $courseList .= '<h4>Henüz anket sorusu eklenmemiştir.</h4>';

      $courseList .= '</div>';
    }


}
?>

<?php include "pageHeader.php"; ?>


<div style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">

<table >
<tr>
<th width = "80%">Bütün Anketler</th>
</tr>
<tr>
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







