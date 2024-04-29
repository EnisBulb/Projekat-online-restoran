<?php 
    
    include('../config/konstante.php');

    session_destroy(); //ponistava sesiju korisnik

    header("location:".SITEURL. "admin/login.php");

?>