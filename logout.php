<?php
    session_start();

    if(isset($_SESSION['id']))
    {
        unset($_SESSION['id']);
    }
    if(isset($_SESSION['username']))
    {
        unset($_SESSION['username']);
    }
    if(isset($_SESSION['role_id']))
    {
        unset($_SESSION['role_id']);
    }
    if(isset($_SESSION['is_logged']))
    {
        unset($_SESSION['is_logged']);
    }

    header("Location: index.php");
?>