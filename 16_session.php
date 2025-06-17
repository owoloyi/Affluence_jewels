<?php
    //session_start();

    session_start();
    $_SESSION['username']='Debby';
    $_SESSION['password']='jewelry';
    $_SESSION['email']='owoloyi8080@gmail.com';
    echo'Session started successfully';
    echo '<br>Welcome '.$_SESSION['username'];
    
?>