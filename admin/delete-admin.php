
<?php

    include("../config/konstante.php");
    //uzmi id admina koji treba bit izbrisan
    $id = $_GET[ 'id' ];

    //napravi sql querry za brisanje admina
    $sql = "DELETE from tbl_admin WHERE id=$id";

    //izvrsi querry
    $res = mysqli_query($conn, $sql); 

    //provjera da li je qveri ispravno pokrenut ili ne 

    if($res == true){
        //echo "Admin izbrisan";
        //napravi sesiju varijable da prikaze poruku
        $_SESSION['obrisi']="Admin izbrisan uspjsno!";
        //redirect da manage admin
        header("location:".SITEURL."admin/manage-admin.php");
    }else {
        //echo "Admin nije izbrisan";
        $_SESSION['obrisi']="Admin nije obrisan! Pokusajte ponovo.";
        header("location:".SITEURL."admin/manage-admin.php");

    }
    //preusmjeri na magage admin sa porukom uspjesno ili neuspjesno


?>