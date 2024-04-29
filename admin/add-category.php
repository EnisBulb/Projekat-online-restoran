<?php include('partials/meni.php');?>

<div class="glavni-dio">
    <div class="wrapper">
        <h1> Dodaj kategoriju </h1>
        
        <br> <br>

         <?php
         
            if(isset($_SESSION['dodaj'])){
                echo  $_SESSION['dodaj'];
                unset($_SESSION['dodaj']);
            }

            if(isset($_SESSION['upload'])){
                echo  $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
         ?>
        
        <br> <br>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td> Naslov: </td>
                    <td>
                        <input type="text" name="naslov" placeholder="Unesite naslov kategorije">
                    </td>
                </tr>

                <tr>
                    <td>Odaberi sliku:</td>
                    <td>
                        <input type="file" name="slika" >
                    </td>
                </tr>

                <tr>
                    <td> Istaknuto: </td>
                    <td>
                        <input type="radio" name="istaknuto" value="Da"> Da
                        <input type="radio" name="istaknuto" value="Ne"> Ne
                    
                    </td>
                </tr>

                <tr>
                    <td> Aktivno: </td>
                    <td>
                        <input type="radio" name="aktivno" value="Da"> Da
                        <input type="radio" name="aktivno" value="Ne"> Ne
                   
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Dodaj Kategoriju" class="dugme-sec">
                    </td>
                </tr>
            </table>
        </form>

        <?php
        
            if(isset($_POST['submit']))
            {
                $naslov = $_POST['naslov'];

                if(isset($_POST['istaknuto']))
                {
                    $istaknuto = $_POST[ 'istaknuto' ];
                }
                else
                {
                    $istaknuto = "Ne";
                }

                if(isset($_POST['aktivno']))
                {
                    $aktivno = $_POST[ 'aktivno' ];
                }
                else
                {
                    $aktivno = "Ne";
                }


                if(isset($_FILES['slika']['name'])){
                    $ime_slike = $_FILES['slika']['name'];
                    
                    if($ime_slike!=""){

                    

                        $ext = end(explode('.', $ime_slike));

                        $ime_slike = "food_category_".rand(000, 999).'.'.$ext;
                    
                    
                        $source_path = $_FILES[ 'slika' ]['tmp_name'];
                        $destination_path = "../images/category/".$ime_slike;
                        
                        $upload = move_uploaded_file($source_path, $destination_path);
                        
                        if($upload==false){
                            $_SESSION['upload']="Slika nije prenesena!";
                            header("location:".SITEURL."admin/add-category.php");

                            //zaustavi proces

                            die();
                        }
                    }   
                
                }else{
                    $ime_slike="";
                }


                $sql = "INSERT INTO tbl_category SET
                ime_slike = '$ime_slike',
                naslov = '$naslov',
                istaknuto = '$istaknuto',
                aktivno = '$aktivno' ";

                $res = mysqli_query($conn, $sql);

                if($res==true){
                    $_SESSION['dodaj']="Uspjesno dodana kategorija!";
                    header("location:".SITEURL."admin/manage-category");
                }else{
                    $_SESSION['dodaj']="Kategorija nije dodana!";
                    header("location:".SITEURL."admin/add-category");
               
                }

            }

        ?>

    </div>
</div>


<?php include('partials/footer.php');?>