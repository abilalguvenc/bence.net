<?php
include "php/sqlConnection.php";
?>

<?php include "pageHeader.php"; ?>

<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
    <tr>    
      <th>
        Hata Kodu: 02
      </th>
    </tr>

    <tr>
        <td>
        <br>
            <h3>Bu anketi daha önceden doldurduğunuz için tekrar dolduramazsınız.</h3>
        <br> <br>
        </td>
    </tr>

    <tr>
        <td>
          <button onclick='location.href="index.php"'>
              Anasayfaya Dön
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