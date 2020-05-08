<?php
    function filter($str){
        $str=trim($str);
        $str=htmlspecialchars($str);
        $str=stripslashes($str);
    }
    $username=filter($_POST['user']);
    $password=filter($_POST['pass']);
?>