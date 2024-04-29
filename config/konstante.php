<?php 
    //pocetak sesije
    session_start();


    //naoraviti konstante za ne ponavljajuce varijable
    define('SITEURL', 'http://localhost/Maturski/'); //potrebno je izvrsiti ovdje izmjenu
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food-order');
    // posalji query u bazu
            
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error()); //konekcija
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());   

?>