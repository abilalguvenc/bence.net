<?php
include "php/sqlConnection.php";

if( isset($_SESSION["login"]) )
{
  
} else
{
  header("Location:index.php");
}

$sid = $_SESSION['sid'];
$sname = $_SESSION['sname'];
$qnumber = $_SESSION['question_number'];
?>

<?php include "pageHeader.php"; ?>

<table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
  <tr>
      <th>
          <?php echo "$sname (Anket No: $sid)"; ?>
      </th>
  </tr>

  <tr>
      <td >
          <div style="width:80%; margin: auto;" class="vertical-menu">
            <br>
              <?php echo "$qnumber. Soru"; ?>
            <br>
              <input type="text" id="question" value="">
            <br> <br>

            A)
            <br>
              <input type="text" id="s1" value="">
            <br> <br>

            B)
            <br>
              <input type="text" id="s2" value="">
            <br> <br>

            C)
            <br>
              <input type="text" id="s3" value="">
            <br> <br>
            
            D)
            <br>
              <input type="text" id="s4" value="">
            <br> <br>
            
            E)
            <br>
              <input type="text" id="s5" value="">
            <br> <br>
            
            <br> <br>
          </div>
      </td>
  </tr>
  <tr>
      <td>
          <button onclick="addQuestion()">
              Soruyu Ekle
          </button>
      </td>
  </tr>
</table>

<?php include "pageFooter.html"; ?>





<script>
  function addQuestion()
  {
    var question = document.getElementById("question").value;
    var s1 = document.getElementById("s1").value;
    var s2 = document.getElementById("s2").value;
    var s3 = document.getElementById("s3").value;
    var s4 = document.getElementById("s4").value;
    var s5 = document.getElementById("s5").value;
    
    post("insertQuestion.php" , {insertQuestion:true, question:question, s1:s1, s2:s2, s3:s3, s4:s4, s5:s5 });
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