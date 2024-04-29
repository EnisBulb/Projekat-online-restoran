

<?php 
    include('../config/konstante.php');


    if(isset($_GET['id']) && isset($_GET['ime_slike'])) {

        $id = $_GET['id'];
        $ime_slike = $_GET['ime_slike'];

        if($ime_slike != ""){

            $path="../images/category/".$ime_slike;

            $ukloni = unlink($path);

            if($ukloni == false){
                $_SESSION['ukloni']="Slika nije uklonjena!";
                header("location:".SITEURL."admin/manage-category.php");
                die();
            }

        }

        $sql = "DELETE FROM tbl_category WHERE id='$id'";

        $res = mysqli_query($conn, $sql);

        if($res==true){

            $_SESSION['obrisi']="Uspjesno obrisana kategorija!";
            header("location:".SITEURL."admin/manage-category.php");

        }else{
            $_SESSION['obrisi']="Kategorija nije obrisana!";
            header("location:".SITEURL."admin/manage-category.php");

        }



    }else{
        header("location:".SITEURL."admin/manage-category.php");


    }

?>