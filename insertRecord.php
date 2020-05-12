<?php 
include "php/sqlConnection.php"; 

$sid = htmlspecialchars($_GET["id"], ENT_COMPAT);
$qid = htmlspecialchars($_GET["q"], ENT_COMPAT);
$sel = htmlspecialchars($_GET["sel"], ENT_COMPAT);
$nqid = $qid; $nqid++;

if ($sel == 0) 
{
    
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
    include "pageHeader.php";
    echo '
    <table style="width:80%; margin: auto; border: 3px solid rgb(200, 200, 200);">
        <tr>    
        <th>
            '.$sname.'(Anket No: '.$sid.')
        </th>
        </tr>

        <tr>
            <td>
                <br>
                <h2>Soruyu cevaplayabilmek için bir şık seçmeniz gerekmektedir.</h2>
                <br> <br>
            </td>
        </tr>

        <tr>
            <td>
            <button onclick="javascript:history.go(-1)">
                Soruya Dön
            </button>
            </td>
        </tr>
    </table> ';
    include "pageFooter.html";
} else
{ 
    $error = 0;
    if( isset($_SESSION['login']) )
    {
        $user = $_SESSION['email'];
        $result1 = mysqli_query($con, "SELECT * FROM answer_record WHERE uid='$user' AND sid='$sid' AND qnumber='$qid'");
        if (mysqli_num_rows($result1) > 0)
        {
            $error = 1;
        }
    }
    else 
    {
        $user = "anonim";
    }

    if($error == 1)
    {
        header("Location:error02.php");
    } else
    {
        $sql = "INSERT INTO answer_record (sid, uid, ip_address, qnumber, answer) VALUES ('$sid', '$user', 'ip', '$qid', '$sel')";
        $result = mysqli_query($con, $sql);
       
        $result2 = mysqli_query($con ,"SELECT * FROM question_selection WHERE sid='$sid' AND question_number='$qid'");
        $rowcount2 = 0;
        if($result == true)
            $rowcount2=mysqli_num_rows($result2);
        if ($rowcount2 > 0) {
            while($row2 = mysqli_fetch_array($result2 , MYSQLI_ASSOC))
            {
                $a1 = $row2["ans_1"];
                $a2 = $row2["ans_2"];
                $a3 = $row2["ans_3"];
                $a4 = $row2["ans_4"];
                $a5 = $row2["ans_5"];
            }
            $a1++; $a2++; $a3++; $a4++; $a5++;
        }

        if ($sel == 1)
            $result3 = mysqli_query($con ,"UPDATE question_selection SET ans_1='$a1' WHERE sid='$sid' AND question_number='$qid'");
        else if ($sel == 2)
            $result3 = mysqli_query($con ,"UPDATE question_selection SET ans_2='$a2' WHERE sid='$sid' AND question_number='$qid'");
        else if ($sel == 3)
            $result3 = mysqli_query($con ,"UPDATE question_selection SET ans_3='$a3' WHERE sid='$sid' AND question_number='$qid'");
        else if ($sel == 4)
            $result3 = mysqli_query($con ,"UPDATE question_selection SET ans_4='$a4' WHERE sid='$sid' AND question_number='$qid'");
        else if ($sel == 5)
            $result3 = mysqli_query($con ,"UPDATE question_selection SET ans_5='$a5' WHERE sid='$sid' AND question_number='$qid'");

        echo "$sql";
    
        if($result)
        {
            $qnumber++;
    
            echo " başarılı";
            $_SESSION['sid'] = $sid;
            $_SESSION['question_number'] = $qnumber;

            $result4 = mysqli_query($con, "SELECT * FROM question_selection WHERE sid='$sid' AND question_number='$nqid'");
            if (mysqli_num_rows($result4) > 0)
            {
                header("Location:anketa.php?id=$sid&q=$nqid&sel=0");
            } else
            {
                header("Location:anketz.php?id=$sid");
            }


        }else
        {
            header("Location:index.php");
        }
    }
    
}


?>