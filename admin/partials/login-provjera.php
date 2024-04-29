<?php

if(!isset($_SESSION['korisnik'])){
    $_SESSION['bez-login-poruke']="Molimo vas da se prijavite!";

    header("location:".SITEURL."admin/login.php");
}

?>