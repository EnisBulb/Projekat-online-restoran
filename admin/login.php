<?php /*include('../config/konstante.php');?>

<html>
    <head>
        <title> Login - Foor odrder system </title>
        <link rel="stylesheet"  href="../css/stajl.css">
    </head>

    <body>
        <div class="login">
            <h1 class="text-center"> Login </h1>
            <br> <br>
            
            <?php
            
            if(isset($_SESSION['login'])){
                echo  $_SESSION['login'];
                unset($_SESSION['login']);
            }
            
            if(isset($_SESSION['bez-login-poruke'])){
                echo  $_SESSION['bez-login-poruke'];
                unset($_SESSION['bez-login-poruke']);
            }
           
            ?>
            <br> <br>

            <form action="" method="POST" class="text-center">
                Korisnicko ime: <br> <br>
                <input type="text" name="korisnicko_ime" placeholder="Unesite Korisnicko ime"> <br> <br>
            
                Sifra: <br> <br>
                <input type="password" name="sifra" placeholder="Unesite sifru"> <br> <br>
                
                <input type="submit" name="submit" value="Login" class="dugme-prim">
                <br> <br>
            </form>

            <p class="text-center">Napravio- <a href="enzy"> Enis Bulbulusic</a></p>
        </div>
    </body>
</html>

<?php

    if(isset($_POST['submit']))
    {
        $korisnicko_ime = $_POST['korisnicko_ime'];
        $sifra = md5($_POST['sifra']);

        $sql = "SELECT * FROM tbl_admin WHERE korisnicko_ime = '$korisnicko_ime' AND  sifra = '$sifra'";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $_SESSION['login'] = "Uspjesno ste se prijavili!";
            $_SESSION['korisnik'] = $korisnicko_ime;
            header( "location:".SITEURL."admin/" );
        }
        else
        {
            $_SESSION['login'] = "Prijava nije uspjela!";
            header( "location:".SITEURL."admin/login.php" );
        }
        
    }

*/


include('../config/konstante.php');?>

<html>
    <head>
        <title> Prijava </title>
        <link rel="stylesheet"  href="../css/stajl.css">
    </head>

    <body class="login-body">
        <div class="login">
            <h1 class="text-center"> Prijava </h1>
            <br> <br>
            
            <?php
            
            if(isset($_SESSION['login'])){
                echo  $_SESSION['login'];
                unset($_SESSION['login']);
            }
            
            if(isset($_SESSION['bez-login-poruke'])){
                echo  $_SESSION['bez-login-poruke'];
                unset($_SESSION['bez-login-poruke']);
            }
           
            ?>
            <br> <br>

            <form action="" method="POST" class="text-center">
                Korisnicko ime: <br> <br>
                <input type="text" name="korisnicko_ime" placeholder="Unesite Korisnicko ime"> <br> <br>
            
                Sifra: <br> <br>
                <input type="password" name="sifra" placeholder="Unesite sifru"> <br> <br>
                
                <input type="submit" name="submit" value="Login" class="dugme-prim">
                <br> <br>
            </form>

            <p class="text-center"> Napravio - <a href="https://www.instagram.com/enzyy_b_/?hl=hr"> Enis Bulbulusic </a></p>
        </div>
    </body>
</html>

<?php if(isset($_POST['submit'])) {
    // Priprema korisničkih unosa
    $korisnicko_ime = $_POST['korisnicko_ime'];
    $sifra = md5($_POST['sifra']);

    // Priprema SQL upita s placeholderima
    $sql = "SELECT * FROM tbl_admin WHERE korisnicko_ime = ? AND sifra = ?";

    // Priprema upita s bazom podataka
    $stmt = mysqli_prepare($conn, $sql);

    if($stmt) {
        // Povezivanje parametara s placeholderima
        mysqli_stmt_bind_param($stmt, "ss", $korisnicko_ime, $sifra);

        // Izvršavanje upita
        mysqli_stmt_execute($stmt);

        // Dobivanje rezultata
        $result = mysqli_stmt_get_result($stmt);

        // Provjera rezultata
        if($row = mysqli_fetch_assoc($result)) {
            $_SESSION['login'] = "Uspješno ste se prijavili!";
            $_SESSION['korisnik'] = $korisnicko_ime;
            header("location:".SITEURL."admin/");
            exit();
        } else {
            $_SESSION['login'] = "Prijava nije uspjela!";
            header("location:".SITEURL."admin/login.php");
            exit();
        }
    } else {
        // Greška u pripremi upita
        $_SESSION['greska'] = "Došlo je do greške. Molimo pokušajte ponovo.";
        header("location:".SITEURL."admin/login.php");
        exit();
    }
}
?>

