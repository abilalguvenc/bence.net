<?php
include "php/sqlConnection.php";

if( isset($_SESSION["login"] ) && $_SESSION["login"] == 1 )
{
$enrolQuery = "select course.*  from course , enrolled where esnum = '". $_SESSION["snum"]. " ' and cname = ecname";
$enrolQueryOnlyCname = "(select course.cname  from course , enrolled where esnum = '{$_SESSION["snum"]} ' and cname = ecname)";
$enrolled = mysqli_query($con ,$enrolQuery);
$available = mysqli_query($con ,"select *  from course where cname not in " .$enrolQueryOnlyCname );
}else
{
    header("Location:index.php");
}

$listEnrolled = "";
$listAvailable= "";



while($row = mysqli_fetch_array($enrolled , MYSQLI_ASSOC))
{
  $listEnrolled .= '<label class="chkcontainer">';
  $listEnrolled .= $row["cname"];
  $listEnrolled .= '<input type="checkbox"  class="cid_enrolled" value="'. $row["cname"] .'" >';
  $listEnrolled .= '<span class="checkmark"></span>';
  $listEnrolled .= '</label>';
}

while($row = mysqli_fetch_array($available , MYSQLI_ASSOC))
{
  $listAvailable .= '<label class="chkcontainer">';
  $listAvailable .= $row["cname"];
  $listAvailable .= '<input type="checkbox"  class="cid_available" value="'. $row["cname"] .'" >';
  $listAvailable .= '<span class="checkmark"></span>';
  $listAvailable .= '</label>';
}


?>




<?php include "pageHeader.php"; ?>


<table class="center" style="width:80%;">
    <tr>    
        <th>
            Alınan Dersler
        </th>
        <th>
            Alınabilir Dersler
        </th>

    </tr>

    <tr>
        <td>
        <div class="vertical-menu">
        <?php echo $listEnrolled; ?>
        </div>
        </td>

        <td >
        <div class="vertical-menu">
        <?php echo $listAvailable; ?>
        </div>
        </td>
    </tr>

    <tr>
        <td>
            <button onclick="deleteSelectedCourses()">
                Ders Sil
            </button>

        </td>

        <td >
           <button onclick="addSelectedCourses()">
                Ders Ekle
            </button>
        </td>

    </tr>
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


function deleteSelectedCourses(args)
{
var items = document.getElementsByClassName("cid_enrolled");
var i;

var deleteList = [];
for( i = 0 ; i < items.length; i++)
{
    if(items[i].checked == true)
    {
        deleteList.push(items[i].value);
    }
}
console.log('deletelist :', deleteList);
if(deleteList.length > 0)
post("selectCoursePost.php" ,{deleteList: deleteList})
}

function addSelectedCourses(args)
{
    var items = document.getElementsByClassName("cid_available");
var i;

var addList = [];
for( i = 0 ; i < items.length; i++)
{
    if(items[i].checked == true)
    {
        addList.push(items[i].value);
    }
}
console.log('addList :', addList);    
if(addList.length > 0)
post("selectCoursePost.php" ,{addList: addList})
}


</script>


<style>

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