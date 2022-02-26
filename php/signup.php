<?php
    require_once("./db_con.php"); 
    $userid=$_POST["id"];
    $userpw=$_POST["pw"];
    $userpw2=$_POST["pw2"];
    $username=$_POST["name"];
   

    if ( $userpw != $userpw2 ){
        echo "<script>alert(\"Password Different.\");</script>";
	    echo "<script>window.history.back();</script>";
        exit;
    }
    
    $id_check_sql = "SELECT * FROM 'login' WHERE id='$userid'";
    $result = $conn->query($id_check_sql);

   if($result->num_rows==1)
    {
        echo "<script>alert(\"already used.\");</script>";
	    echo "<script>window.history.back();</script>";
        exit;
    }

    $insert_sql = "INSERT INTO 'login' ('ID','PW','NAME') VALUES ('$userid',password('$userpw'),'$username')";

    if (mysqli_query($conn,$insert_sql)){
        $CNT = "SET @CNT=0";
        mysqli_query($conn,$CNT);
        $Auto_Increment = "UPDATE 'login' SET No = @CNT:=@CNT+1";
        mysqli_query($conn,$Auto_Increment);
        echo "<script>alert(\"Complete.\");</script>";
	    echo "<script>location.replace('../index.html');</script>";
        exit;

    } else { 
	    echo "<script>alert(\"Error Occur, Try Again.\");</script>";
        echo "<script>location.replace('../index.html');</script>";
        exit;
    }
?>
