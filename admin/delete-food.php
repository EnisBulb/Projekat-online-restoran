<?php 
    include('../config/konstante.php');

    if(isset($_GET[ 'id' ]) && isset($_GET['ime_slike']))
    {
        $id=$_GET['id'];
        $ime_slike=$_GET['ime_slike'];

        if($ime_slike!=""){

            $path="../images/food/".$ime_slike;

            $ukloni = unlink( $path );

            if($ukloni==false){
                $_SESSION['upload'] = "Slika nije obrisana.";
                header("location:".SITEURL."admin/manage-food.php");
                die();
            }

        }

        $sql="DELETE FROM tbl_food WHERE id=$id";

        $res = mysqli_query($conn, $sql);
        
        if($res == true){
            $_SESSION['uspjesno']="Uspjesno ste obrisali hranu";
            header("location:".SITEURL."admin/manage-food.php");
        }
        else{
            $_SESSION['uspjesno']="Brisanje nije uspjelo.";
            header("location:".SITEURL."admin/manage-food.php");
        
        }

    }else
    {
        $_SESSION['unauthorise']="Neovlasten pristup.";
        header("location:".SITURL."admin/manage-food.php");
    }   


?>