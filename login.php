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
        
        $result = mysqli_query($con ,"SELECT * FROM student where sname='$uname' and password='$password'");
        $rowcount = 0;
        if($result == true)
            $rowcount=mysqli_num_rows($result);
        if($rowcount > 0)
        {
         

            $_SESSION['login'] = 1; // student level

            $info = mysqli_fetch_array($result , MYSQLI_ASSOC);

            $_SESSION['snum'] =  $info["snum"];

            $_SESSION['username'] =  $info["sname"];


            echo "succes";

            header("Location:index.php");
            exit();


        }else{
            $result = mysqli_query($con ,"SELECT * FROM admin where aname='$uname' and password='$password'");
            $rowcount = 0;
            if($result == true)
                $rowcount=mysqli_num_rows($result);
            if($rowcount > 0)
            {
             
                $_SESSION['login'] = 2; // student level
    
                $info = mysqli_fetch_array($result , MYSQLI_ASSOC);
    
                $_SESSION['username'] =  $info["aname"];

                echo "succes";
                header("Location:index.php");
                exit();
    
    
            }

            


            echo "login failed...";
        }
  
    }
}


?>

