<?php include "php/sqlConnection.php"; 

if( isset($_SESSION['login']) && $_SESSION['login'] == 2  )
{

if(isset($_POST['addStudent']))
{
    if(
        isset($_POST['sname']   )   &&
        isset($_POST['snum']    )   &&
        isset($_POST['password']) 
    )
    {
    
        $sname = $_POST['sname']  ; 
        $snum = $_POST['snum']    ;
        $password =$_POST['password'];
    

    
        $result = mysqli_query($con ,"insert into  student values('$snum' , '$sname' , '$password' ) ");
    
    
        if($result)
        {
            header("Location:selectStudents.php");
    
        }else
        {
            setError("Failed to insert student data");
            header("Location:redirect.php");
        }
    
    }else{
        echo 'failed';
        setError("Failed to get post values");
        header("Location:redirect.php");
    }

}else
if(isset($_POST['removeStudent']))
{

    $snum = $_POST['snum']    ;


    $result = mysqli_query($con ,"delete from student where snum ='$snum' ");

    if($result)
    {
            header("Location:selectStudents.php");
    }else
    {
            setError("Failed to remove student ");
            header("Location:redirect.php");
    }
    
}else
{
    echo 'failed';
    setError("Failed to get post values");
    header("Location:redirect.php");
}












}else
{
    header("Location:index.php");
}

?>