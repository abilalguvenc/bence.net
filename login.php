<?php session_start();
include "php/sqlConnection.php"; 

if( isset($_SESSION['login'] ))
{
    echo "log out suff...";
    session_destroy();
    session_start();
}

if(isset($_REQUEST ["uname"]) )
{
    if(isset($_REQUEST ["psw"]) )
    {
        $uname = $_REQUEST ["uname"];
        $password = $_REQUEST ["psw"];
        
        $result = mysqli_query($con ,"SELECT * FROM user where email_address='$uname' and password='$password'");
        $rowcount = 0;
        if($result == true)
            $rowcount=mysqli_num_rows($result);
        if($rowcount > 0)
        {
            $_SESSION['login'] = 1; // user logged in

            $info = mysqli_fetch_array($result , MYSQLI_ASSOC);

            $_SESSION['email'] =  $info["email_address"];
            $_SESSION['username'] =  $info["name"];

            echo "succes";
            header("Location:index.php");
            exit();

        } else {
            $result = mysqli_query($con ,"SELECT * FROM company where email_address='$uname' and password='$password'");
            $rowcount = 0;
            if($result == true)
                $rowcount=mysqli_num_rows($result);
            if($rowcount > 0)
            {
                $_SESSION['login'] = 2; // company logged in
    
                $info = mysqli_fetch_array($result , MYSQLI_ASSOC);
    
                $_SESSION['email'] =  $info["email_address"];
                $_SESSION['username'] =  $info["name"];

                echo "succes";
                header("Location:index.php");
                exit();
            }
        }
        session_destroy();
        echo "Giriş işlemi başarısız.";
        header("Location:loginfailed.php");
        exit();
    }
}
?>

