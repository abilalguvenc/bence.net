<?php
include "php/sqlConnection.php";

if( isset($_SESSION["login"]) )
{
  $email = $_SESSION["email"];
  $available = mysqli_query($con ,"select * from survey where cmail = '$email'" );

}else
{
    header("Location:index.php");
}

$listAvailable= "";


while($row = mysqli_fetch_array($available , MYSQLI_ASSOC))
{
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $row["sname"];
    if(isset($_POST["selectedCourse"]) && $_POST["selectedCourse"] ==$row["cname"]   )
    {
    $listAvailable .= '<input type="radio" checked="true" name="radio" class="cid_allCourses" onclick="handleCheck(this);" value="'. $row["cname"] .'" >';
    }else
    //$rowcname = $row["cname"];
    $listAvailable .= '<input type="radio" name="radio" class="cid_allCourses" onclick="handleCheck(this);" value="'. $rowcname.'" >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
}

$courseSessions = '';



if(isset($_POST["selectedCourse"]))
{

    $courseSessions .='<table id="innerTable">
                      <tr>
                      <th>Soru Metni</th>
                      <th>A Sayısı</th>
                      <th>B Sayısı</th>
                      <th>C Sayısı</th>
                      <th>D Sayısı</th>
                      <th>E Sayısı</th>
                      </tr>';


    $selectedCourse = $_POST["selectedCourse"];

    $_SESSION["selectedCourseName"] = $selectedCourse ;


     $courseSessions .= '<h4>Anket İsmi Buraya Gelicek</h4>';
     $schedules = mysqli_query($con ,"SELECT * FROM course_schedule WHERE scname = '$selectedCourse'");
     while($srow = mysqli_fetch_array($schedules  , MYSQLI_ASSOC))
     { 
       $value = "'". $selectedCourse ."," . $srow["meets_at"] ."'";

       $courseSessions .='<tr>';// value="'.$value.'
       $courseSessions .= '<td> '.  getDay($srow["meets_on"])   .'  </td>';
       $courseSessions .= '<td> '. $srow["meets_at"]   .'  </td>';
       $courseSessions .= '<td> '.   $srow["ends_at"]   .'  </td>';
       $courseSessions .= '<td> '.   $srow["room"]   .'  </td>';
       $courseSessions .= '<td> <button class="rowInput" onclick="deleteSession('.$value.')">Sil</button>  </td>';
       $courseSessions .='</tr>';
     
     }


     $courseSessions .='<tr>

<td><select  class="rowInput" id="s_meets_on" >
<option value="0">Pazartesi</option>
<option value="1">Salı</option>
<option value="2">Çarsamba</option>
<option value="3">Perşembe</option>
<option value="4">Cuma</option>
<option value="5">Cumartesi</option>
<option value="6">Pazar</option>
</select>
</td>
<td> 0
</td>
<td> 1
</td>
<td>
 2
</td>
<td> 3  </td>
<td> 3  </td>
</tr>';

$courseSessions .= '</table>';
$courseSessions .= '<br>';
$courseSessions .= '</div>';

}


?>

<?php include "pageHeader.php"; ?>


<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
    <tr>    
        <th>
            Anketlerim
        </th>

        <th>
            Seçili Anketin Bilgileri
        </th>
    </tr>

    <tr>
        <td>
            <div class="vertical-menu">
                <?php echo $listAvailable; ?>
            </div>
        </td>

        <td>
        <?php echo $courseSessions; ?>
        </td>
    </tr>

    <tr>
        <td>
        </td>

        <td>
            <button onclick="deleteSelectedCourseAdmin()">
                Seçili Anketi Sil
            </button>
        </td>
    </tr>
</table>





<?php include "pageFooter.html"; ?>

<script>


function handleCheck(args)
{
    console.log('args :', args);

    post("anketlerim.php" ,{selectedCourse: args.value})
}

function addSession(args)
{
var meets_on = document.getElementById("s_meets_on").value;
var meets_at = document.getElementById("s_meets_at").value;
var ends_at  = document.getElementById("s_ends_at").value;
var className = document.getElementById("s_class").value;

console.log("meets_on " , meets_on )
console.log("meets_at " , meets_at )
console.log("ends_at  " , ends_at  )
console.log("className" , className)


post("selectCoursePost.php" ,{addSession: true , 
    meets_on:meets_on,
    meets_at:meets_at,
    ends_at:ends_at,
    className:className
})
}



function deleteSession(args)
{
    
console.log('deleteItem :', args);
var deleteItem =args;

console.log('deleteItem :', deleteItem);

if(deleteItem != null)
post("selectCoursePost.php" ,{removeSession: true , sessionValues:deleteItem })
}


function deleteSelectedCourseAdmin(args)
{
var items = document.getElementsByClassName("cid_allCourses");
var i;
var deleteItem = null;
for( i = 0 ; i < items.length; i++)
{
    if(items[i].checked == true)
         deleteItem =   items[i].value;
}

if(deleteItem != null)
post("selectCoursePost.php" ,{removeCourse: true , cname:deleteItem })
}

function addCourseAdmin(args)
{

var cname = document.getElementById("cname").value;
var info = document.getElementById("info").value;

post("selectCoursePost.php" ,{addCourse: true ,cname:cname, info:info })


}



</script>


<style>

.rowInput {
    padding:0px;
    margin:0px;
}

.cid_sessions
{
    background-color:rgb(210, 0, 0);
	color: white;
	border: none;
    width: 100%;
}
.horizontal input {
    float:left;
    margin:5px;
    width:60px;
}
.horizontal button {
    float:left;
    margin:5px;
    width:30%;
}
.horizontal select {
    float:left;
    margin:5px;
    width:30%;
}
#innerTable  {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  background-color: #ffffff;
  width: 100%;
}
#innerTable td, th {
  border: 1px solid #00004d;
  text-align: left;
  padding: 8px;
}
#innerTable tr:nth-child(even) {
  background-color: #9999ff;
}

#innerTable tr:nth-child(odd) {
  background-color: #809fff;
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