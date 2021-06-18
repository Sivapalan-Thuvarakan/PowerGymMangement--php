<?php
  include"database.php";
    //check availablity of user using jquery
    if(isset($_POST["name"]))
    {
        $name=$_POST["name"];
        if(strlen($name)>=6)//define username consits atleast 6 characters
        {
            $sql="select * from user where User_name='$name'";
            $res=$db->query($sql);
            if($res->num_rows>0)
            {
                echo '<p class="err">User name is unavailable,Try another one!!!</p> ';  
            }
            else
            {
                echo '<p class="crt">User name is available</p>';
            }
        }
        else
        {
            echo '<p class="err">Username should consits of 6 characters</p>'; 
        }
    }


     //check availablity of useremail using jquery
    elseif(isset($_POST["email"]))
    {
        $email=$_POST["email"];
            $sql="select * from user where Email='$email'";
            $res=$db->query($sql);
            if($res->num_rows>0)
            {
                echo '<p class="err">Email is unavailable,Try another one!!!</p>';
            }
            else
            {
                echo '<p class="crt">Email is available</p>';
            }
        
    }

    elseif(isset($_POST["cpass"]))
    {
        $cpass=$_POST["cpass"];
        $upass=$_POST["upass"];
            if($cpass!=$upass)
            {
                echo '<p class="err">password does not match</p>';
            }
               
    }   
    
?>