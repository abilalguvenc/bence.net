<?php include "php/sqlConnection.php"; 

function clean($string) {
    return str_replace("'", "\'", $string);
 }

if( isset($_SESSION['login']) )
{
    if(isset($_POST['insertQuestion']))
    {
        if( isset($_POST['question']) )
        {
            $sid     = $_SESSION['sid'];
            $qnumber = $_SESSION['question_number'];
            
            $question = $_POST['question'];
            $s1       = $_POST['s1'];
            $s2       = $_POST['s2'];
            $s3       = $_POST['s3'];
            $s4       = $_POST['s4'];
            $s5       = $_POST['s5'];

            $question = clean($question);
            $s1 = clean($s1); 
            $s2 = clean($s2); 
            $s3 = clean($s3); 
            $s4 = clean($s4); 
            $s5 = clean($s5); 

            $sql = "INSERT INTO question_selection (sid, question_number, question, sel_1, sel_2, sel_3, sel_4, sel_5, ans_1, ans_2, ans_3, ans_4, ans_5) VALUES ('$sid', '$qnumber', '$question', '$s1', '$s2', '$s3', '$s4', '$s5', '0', '0', '0', '0', '0')";
            $result = mysqli_query($con, $sql);
        
            if($result)
            {
                $qnumber++;

                echo " başarılı";
                $_SESSION['sid'] = $sid;
                $_SESSION['question_number'] = $qnumber;
                header("Location:soru_ekle.php");
            }else
            {
                echo "Soru eklenemedi. \r\n";
                echo "SQL Komutu: $sql \r\n";
                echo "Hata Kodu: $result \r\n";
                echo "<a href=\"javascript:history.go(-1)\">Geri Dön</a>";
                header("Location:soru_ekle.php");
            }

        }else{
            echo 'failed';
            setError("Failed to get post values");
            Header("Location:index.php");
        }
    }
} else 
{
    echo 'Bu özelliği kullanabilmek için giriş yapmanız gerekmektedir.';
    Header("Location:index.php");
}

?>