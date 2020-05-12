<?php
include "php/sqlConnection.php";

$result = mysqli_query($con ,"SELECT * FROM survey");

$rowcount = 0;

if($result == true)
    $rowcount=mysqli_num_rows($result);

 $surveyList = '';

if ($rowcount > 0) {

    while($row = mysqli_fetch_array($result , MYSQLI_ASSOC))
    {
      // begin new
      $surveyList .= '<button class="collapsible">'  .$row["sname"].  '</button>';
      $surveyList .= '<div class="content">';
      $surveyList .= '<br>';
      $surveyList .= '<h2>'. $row["sname"]   .'  </h2>';
      $surveyList .= '<h3>Anketi Oluşturan</h3>';
      $surveyList .= '<p>'. $row["creator"]   .'  </p>';
      $surveyList .= '<h3>Açıklama</h3>';
      $surveyList .= '<p>'. $row["info"]   .'  </p>';

      $schedules = mysqli_query($con ,"SELECT * FROM question_selection WHERE sid = '". $row["sid"]."'");
      if(!!$schedules)
      {
        $surveyList .= '<h4>Sorular</h4>';
        $surveyList .='<table>
        <tr>
        <th>Soru Metni</th>
        <th>A</th>
        <th>B</th>
        <th>C</th>
        <th>D</th>
        <th>E</th>
        </tr>';
       
        while($srow = mysqli_fetch_array($schedules  , MYSQLI_ASSOC))
        { 
          $surveyList .='<tr>';
          // $surveyList .= '<td> '.  getDay($srow["question"])   .'  </td>';
          $surveyList .= '<td> '. $srow["question"] .'  </td>';
          $surveyList .= '<td> '. $srow["sel_1"]    .'  </td>';
          $surveyList .= '<td> '. $srow["sel_2"]    .'  </td>';
          $surveyList .= '<td> '. $srow["sel_3"]    .'  </td>';
          $surveyList .= '<td> '. $srow["sel_4"]    .'  </td>';
          $surveyList .= '<td> '. $srow["sel_5"]    .'  </td>';
          $surveyList .='</tr>';
        }  
        
        $surveyList .= '</table>';
        $surveyList .= '<br>';
      }
      else
        $surveyList .= '<h4>Henüz anket sorusu eklenmemiştir.</h4>';
      $iddd = '$row["sid"]';
      $linkurl = 'location.href="anketa.php?id='.$iddd.'&q=1&sel=0"';
      $surveyList .= '<button onclick=\'location.href="anketa.php?id='.$iddd.'"\'>
                          Ankete Katıl
                      </button>';

      $surveyList .= '</div>';
    }


} else 
  $surveyList .= 'Sistemde kayıtlı anket bulunamadı.'


?>

<?php include "pageHeader.php"; ?>


<div style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">

<table >
<tr>
  <th width = "80%">Bütün Anketler</th>
</tr>
<tr>
  <td>
    <?php echo $surveyList; ?>
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







