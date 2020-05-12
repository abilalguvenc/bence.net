<?php
include "php/sqlConnection.php";

$sid = htmlspecialchars($_GET["id"], ENT_COMPAT);
$qid = htmlspecialchars($_GET["q"], ENT_COMPAT);
$sel = htmlspecialchars($_GET["sel"], ENT_COMPAT);

$sname = null;
$creator = null;
$info = null;

$result = mysqli_query($con ,"SELECT * FROM survey WHERE sid='$sid'");
$rowcount = 0;
if($result == true)
  $rowcount=mysqli_num_rows($result);
if ($rowcount > 0) {
  while($row = mysqli_fetch_array($result , MYSQLI_ASSOC))
  {
    $sname = $row["sname"];
    $creator = $row["creator"];
    $info = $row["info"];
  }
}

$listAvailable = '';

$result = mysqli_query($con ,"SELECT * FROM question_selection WHERE sid='$sid' AND question_number='$qid' ");
$rowcount = 0;
if($result == true)
  $rowcount=mysqli_num_rows($result);
if ($rowcount > 0) {
  while($row = mysqli_fetch_array($result , MYSQLI_ASSOC))
  {
    $question = $row["question"];
    $s1 = $row["sel_1"];
    $s2 = $row["sel_2"];
    $s3 = $row["sel_3"];
    $s4 = $row["sel_4"];
    $s5 = $row["sel_5"];
  }
  // Soru ekranı
  $listAvailable .= '<h3><strong>'.$qid.'. Soru: </strong> '.$question.'</h3> ';

  if($s1 != null)
  {
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $s1;
    if ($sel == 1) $listAvailable .= '<input type="radio" checked="true" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=1"\' >';
    else $listAvailable .= '<input type="radio" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=1"\' >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
  }
  if($s2 != null)
  {
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $s2;
    if ($sel == 2) $listAvailable .= '<input type="radio" checked="true" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=2"\' >';
    else $listAvailable .= '<input type="radio" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=2"\' >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
  }
  if($s3 != null)
  {
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $s3;
    if ($sel == 3) $listAvailable .= '<input type="radio" checked="true" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=3"\' >';
    else $listAvailable .= '<input type="radio" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=3"\' >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
  }
  if($s4 != null)
  {
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $s4;
    if ($sel == 4) $listAvailable .= '<input type="radio" checked="true" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=4"\' >';
    else $listAvailable .= '<input type="radio" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=4"\' >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
  }
  if($s5 != null)
  {
    $listAvailable .= '<label class="chkcontainer">';
    $listAvailable .= $s5;
    if ($sel == 5) $listAvailable .= '<input type="radio" checked="true" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=5"\' >';
    else $listAvailable .= '<input type="radio" name="radio" class="selections" onclick=\'location.href="anketa.php?id='.$sid.'&q='.$qid.'&sel=5"\' >';
    $listAvailable .= '<span class="checkmark"></span>';
    $listAvailable .= '</label>';
  }

} else
{
  $listAvailable .= "Hata! Soru bulunamadı.";
}

$buttonurl = 'location.href="insertRecord.php?id='.$sid.'&q='.$qid.'&sel='.$sel.'"';
?>

<?php include "pageHeader.php"; ?>


<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
    <tr>    
      <th>
        <?php echo "$sname" ?>
        <?php echo "(Anket No: $sid)" ?>
      </th>
    </tr>

    <tr>
        <td>
            <div class="vertical-menu">
                <?php echo $listAvailable; ?>
            </div>
        </td>
    </tr>

    <tr>
        <td>
          <button onclick=<?php echo"$buttonurl" ?>>
              Cevabı Kaydet
          </button>
        </td>
    </tr>
</table>





<?php include "pageFooter.html"; ?>

<script>
function createSurvey()
{  
  post("insertSurvey.php" , {createSurvey:true});
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