<?php
include "php/sqlConnection.php";

if( isset($_SESSION["login"] ) && $_SESSION["login"] == 2 )
{

$students = mysqli_query($con ,"select *  from student " );
}else
{
    header("Location:index.php");
}
/*
$studentList = "";
$studentList .='<table id="studentTable">
<tr>
<th></th>
<th>ID</th>
<th>isim</th>
</tr>';
while($row = mysqli_fetch_array($students , MYSQLI_ASSOC))
{
       $studentList .='<tr id="studentTable">';
       $studentList .= '<td id="studentTable"><input type="radio" checked="false" name="radio" class="snum_student" value="'. $row["snum"] .'" > </td>';
       $studentList .= '<td id="studentTable"> '. $row["snum"]  .'  </td>';
       $studentList .= '<td id="studentTable"> '. $row["sname"]   .'  </td>';
       $studentList .='</tr>';
}
$studentList .= '</table>';
*/
?>




<?php include "pageHeader.php"; ?>


<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
  <tr>
      <th>
          Yeni Anket
      </th>
  </tr>

  <tr>
      <td >
          <div style="width:80%; margin: auto;" class="vertical-menu">
            <br>
            Anket İsmi
            <br>
            <input type="text" id="newsnum" value="">
            <br> <br>

            Açıklama
            <br>
            <input type="text" id="newsname" value="">
            <br> <br>

            1. Soru
            <br>
            <input type="text" id="newpw" value="">
            <br> <br>
            
            <button onclick="addStudent()">
              Soru Ekle
            </button>
            <br> <br>
          </div>
      </td>
  </tr>
  <tr>
      <td>
          <button onclick="addStudent()">
              Anketi Oluştur
          </button>
      </td>
  </tr>
  <!-- 
  <tr>
      <th style="width:60%;">
          Bütün Öğrenciler
      </th>
      
      <th>
          Yeni Öğrenci
      </th>
  </tr>

  <tr>
      <td>
          <div class="vertical-menu">
              <?php echo $studentList; ?>
          </div>
      </td>

      <td >
          <div class="vertical-menu">
              Öğrenci Numarası:<br>
              <input type="text" id="newsnum" value="">
              <br>

              Öğrenci İsmi:<br>
              <input type="text" id="newsname" value="">
              <br>

              Hesap Şifresi:<br>
              <input type="text" id="newpw" value="">
              <br>
          </div>
      </td>
  </tr>

  <tr>
      <td>
          <button onclick="deleteSelectedStudent()">
              Öğrenciyi Sil
          </button>
      </td>

      <td>
          <button onclick="addStudent()">
              Öğrenci Ekle
          </button>
      </td>
  </tr>
  -->
</table>





<?php include "pageFooter.html"; ?>

<script>

var items = document.getElementsByClassName("cid");
var i;
for( i = 0 ; i < items.length; i++)
{
	items[i].innerHtml += 'x';
    items[i].checked = true;
}
var addCourseButton = document.getElementById("addCourseButton");


function addStudent()
{
    var sname = document.getElementById("newsname").value;
    var snum = document.getElementById("newsnum").value;
    var password = document.getElementById("newpw").value;


    post("selectStudentPost.php" , {addStudent:true, sname:sname,snum:snum,password:password });

}

function deleteSelectedStudent()
{
    var items = document.getElementsByClassName("snum_student");
    var deleteNum = null;
    for( i = 0 ; i < items.length; i++)
    {
        if(items[i].checked)
         deleteNum = items[i].value;
    }

    if(deleteNum != null)
    post("selectStudentPost.php" , {removeStudent:true, snum:deleteNum });

}




</script>




<style>


#studentTable table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#studentTable  td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

#studentTable  tr:nth-child(even) {
  background-color: #dddddd;
}

.vertical-menu {

  overflow-y: auto;
}

/* The container */
.chkcontainer {
  display: block;
  position: relative;
  padding-left: 35px;
  margin-bottom: 12px;
  cursor: pointer;
  font-size: 22px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.chkcontainer input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 25px;
  width: 25px;
  background-color: #eee;
  border-radius: 50%;
}

/* On mouse-over, add a grey background color */
.chkcontainer:hover input ~ .checkmark {
  background-color: #ccc;
}

/* When the radio button is checked, add a blue background */
.chkcontainer input:checked ~ .checkmark {
  background-color: #2196F3;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.chkcontainer input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.chkcontainer .checkmark:after {
 	top: 9px;
	left: 9px;
	width: 8px;
	height: 8px;
	border-radius: 50%;
	background: white;
}
</style>