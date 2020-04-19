<?php 
include "php/sqlConnection.php"; 

if( isset($_SESSION['login']) && $_SESSION['login'] == 1  )
{
    

    if(isset($_POST["addList"]))
    {
        $tok = strtok($_POST["addList"], ",");
        echo  "addlist <br>";
        while ($tok !== false) {
            echo "Word=$tok<br />";

            $num = $_SESSION["snum"];
            $courseName = $tok;
            $result = mysqli_query($con ,"insert into enrolled values ( '$num' ,  '$courseName ')");
        
            if($result)
            {
                echo "succes";
            }else
                echo "failed";

            $tok = strtok(",");
        }
    }

    if(isset($_POST["deleteList"]))
    {
        $tok = strtok($_POST["deleteList"], ",");
        echo  "deleteList <br>";
        while ($tok !== false) {
            echo "Word=$tok<br />";

            $num = $_SESSION["snum"];
            $courseName = $tok;
            $result = mysqli_query($con ,"delete from enrolled where esnum ='$num' and  ecname ='$courseName' ");
        
            if($result)
            {
                echo "succes";
            }else
                echo "failed";

            $tok = strtok(",");
        }
    }


    header("Location:selectCourse.php");



}else
if(isset($_SESSION['login']) && $_SESSION['login'] == 2 )
{
    if(isset($_POST["addCourse"]) )
    {
        if(isset($_POST["cname"]) )
        {
            $info = "";
            $cname = $_POST["cname"];

            if(isset($_POST["info"]))
            {
                $info =$_POST["info"];
            }

            $result = mysqli_query($con ,"insert into course values ( '$cname' ,  '$info ')");
            if($result)
            {
                echo "succes";
            }else
                echo "failed";
        }
    }else
    if(isset($_POST["removeCourse"]) )
    {
        if(isset($_POST["cname"]) )
        {
            $cname = $_POST["cname"];
            echo    $cname   ."<br>";
            $result = mysqli_query($con ,"delete from course where cname = '$cname' ");
            if($result)
            {
                echo "succes delete c";
            }else
                echo "failed delete c";
        }
    }else
    if(isset($_POST["addSession"]))
    {
            $cname = $_SESSION["selectedCourseName"];
            echo $cname;
            echo $_POST["meets_on"] ;
            echo $_POST["meets_at"] ;
            echo $_POST["ends_at"]  ;
            echo $_POST["meets_on"] ;
            echo $_POST["className"];


            if(
                isset($_POST["meets_on"] ) &&
                isset($_POST["meets_at"] ) &&
                isset($_POST["ends_at"]  ) &&
                isset($_POST["meets_on"] ) &&
                isset($_POST["className"]) 
            )
            {
                $meets_on  =$_POST["meets_on"] ;
                $meets_at  =$_POST["meets_at"] ;
                $ends_at   =$_POST["ends_at"]  ;
                $meets_on  =$_POST["meets_on"] ;
                $className =$_POST["className"];


                echo "name " . $cname  . "  at " . $meets_at;

                $result = mysqli_query($con ,"insert into  course_schedule values('$cname' , '$meets_on' , '$meets_at' , '$ends_at' , '$className' ) ");
                
                if($result)
                {
                    echo "succes";
                }else
                    echo "failed";

            }else
                echo "failed not set";
            



    }else
    if(isset($_POST["removeSession"]))
    {
            $cname = strtok($_POST["sessionValues"], ",");
            $meets_at = strtok(",");


            echo "anme " . $cname  . " dsa" . $meets_at;

            $result = mysqli_query($con ,"delete from course_schedule where scname ='$cname' and  meets_at ='$meets_at' ");
        
            if($result)
            {
                echo "succes";
            }else
                echo "failed";


    }   
    
    // buralara redirect ekranı gelmesi cok iyi olur
     header("Location:anketlerim.php");
}else{
    header("Location:index.php");
}



?>