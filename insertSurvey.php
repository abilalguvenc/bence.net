<?php include "php/sqlConnection.php"; 

if( isset($_SESSION['login']) )
{
    if(isset($_POST['createSurvey']))
    {
        if( isset($_POST['sid']) )
        {
            $result1 = mysqli_query($con, "SELECT * FROM vars WHERE type='sid'");
            
            if (mysqli_num_rows($result1) > 0)
                while($row = mysqli_fetch_array($result1 , MYSQLI_ASSOC))
                    $sid = $row["var"];
            $sid++;

            $creator          = $_SESSION['username']; 
            $cmail            = $_SESSION['email']; 
            $sname            = $_POST['sname'];
            $info             = $_POST['info'];  
        
            $sql = "INSERT INTO survey (sid, sname, creator, cmail, info) VALUES ('$sid', '$sname', '$creator', '$cmail', '$info')";
            $result2 = mysqli_query($con, $sql);
            $result3 = mysqli_query($con, "UPDATE vars SET var='$sid' WHERE type='sid'");

            echo "$sql";
        
            if($result2)
            {
                echo "başarılı";
                $_SESSION['sid'] = $sid;
                $_SESSION['sname'] = $sname;
                $_SESSION['question_number'] = "1";
                header("Location:soru_ekle.php");
            }else
            {
                echo "Anket oluşturulamadı.";
                header("Location:index.php");
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