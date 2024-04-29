<?php include('partials/meni.php'); ?>

<div class="glavni-dio">
    <div class="wrapper">
        <h1> Izmijeni kategoriju </h1>

        <br> <br> 

        <?php
        //OVO JE JAKO BITNO NE MOZES PRISTUPITI 
        //UPDATE KATEGORIJI BEZ ID-A TJ AKO PREKO LINKA
        //POKUSAMO PRISTUPITI NECEMO USPJETI BEZ DA KLIKNEMO 
        //NA AZURIRAJ KATEGORIJU

        if(isset($_GET['id'])){
            $id = $_GET['id'];

            $sql = "SELECT * FROM tbl_category WHERE id='$id'";
            $res = mysqli_query($conn,$sql);

            $count = mysqli_num_rows($res);

            if( $count == 1 ){
                $row = mysqli_fetch_assoc($res);

                $naslov = $row['naslov'];
                $trenutna_slika =  $row['ime_slike'];
                $istaknuto = $row['istaknuto'];
                $aktivno =  $row['aktivno'];

            }else{
                $_SESSION['ne-kategorija']="Kategorija nije pronadjena!";
                header("location:".SITEURL."admin/manage-category.php");
            }

        }else{
            header("location:".SITEURL."admin/manage-category.php");
        }
        
        ?>


    <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td> Naslov: </td>
                <td>
                    <input type="text" name="naslov" value="<?php echo $naslov;?>" >
                </td>
            </tr>

            <tr>
                <td> Trenutna slika: </td>
                <td>
                    <?php
                        if($trenutna_slika != ""){
                            ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $trenutna_slika;?>" width="100px">

                            <?php

                        }else{
                            echo "Nema prilozene slike!";

                        }

                    ?>
                </td>
            </tr>

            <tr>
                <td> Nova Slika: </td>
                <td>
                    <input type="file" name="slika" >
                </td>
            </tr>

            <tr>
                <td> Istaknuto: </td>
                <td>
                    <input <?php if($istaknuto=="Da"){echo "checked"; } ?> type="radio" name="istaknuto" value="Da">Da
                   
                    <input <?php if($istaknuto=="Ne"){echo "checked"; } ?> type="radio" name="istaknuto" value="Ne">Ne
                </td>
            </tr>

            <tr>
                <td> Aktivno: </td>
                <td>
                    <input <?php if($aktivno=="Da"){echo "checked"; } ?> type="radio" name="aktivno" value="Da">Da
                    
                    <input <?php if($aktivno=="Ne"){echo "checked"; } ?> type="radio" name="aktivno" value="Ne">Ne
                </td>
            </tr>
            
            <tr>
                <td>
                    <input type="hidden" name="trenutna_slika" value="<?php echo $trenutna_slika; ?>">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Izmijeni kategoriju" class="dugme-sec">
                </td>
            </tr>
        </table>

    </form>
 
    <?php 

        if(isset($_POST['submit'])){
            
            $id = $_POST['id'];
            $naslov = $_POST['naslov'];
            $trenutna_slika = $_POST['trenutna_slika'];
            $istaknuto = $_POST['istaknuto'];
            $aktivno = $_POST['aktivno'];


            if(isset($_FILES['slika']['ime'])){

                $ime_slike = $_FILES['slika']['ime'];
                // UBACIVANJE NOVE SLIKE
                if($ime_slike != "")
                {
                    $ext = end(explode('.', $ime_slike));

                    $ime_slike = "food_category_".rand(000, 999).'.'.$ext;
                
                    $source_path = $_FILES[ 'slika' ]['tmp_name'];
                    $destination_path = "../images/category/".$ime_slike;
                    
                    $upload = move_uploaded_file($source_path, $destination_path);
                    
                    if($upload==false){
                        $_SESSION['upload']="Slika nije prenesena!";
                        header("location:".SITEURL."admin/manage-category.php");

                        //zaustavi proces

                        die();
                    }

                    if($trenutna_slika!="")
                    {
                        //ukloni trenutnu sliku
                        $ukloni_putanju = "../images/category/".$trenutna_slika; 
                        
                        $ukloni = unlink($ukloni_putanju);

                        //provjeri je li slika uklonjena ili ne
                        //ako je failano prikazi poruku i zaustavi

                        if($ukloni=false)
                        {
                            $_SESSION['neuspjesno']="Nije moguce ukloniti trenutnu sliku!";
                            header("location:".SITEURL."admin/manage-category.php");
                            die();
                        }
                    } 
                    
                }else
                {
                    $ime_slike = $trenutna_slika;
                }

            }else
            {
                $ime_slike = $trenutna_slika;
            }

            
            $sql2 = "UPDATE tbl_category SET
            naslov='$naslov',
            ime_slike = '$ime_slike',
            istaknuto = '$istaknuto',
            aktivno = '$aktivno'
            WHERE id='$id'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2==true){
                $_SESSION['uspjesno'] = "Kategorija uspjesno azurirana!";
                header("location:".SITEURL."admin/manage-category.php");
            
            }else{
                $_SESSION['uspjesno'] = "Kategorija nije azurirana!";
                header("location:".SITEURL."admin/manage-category.php");
            }
        }
    ?>
    </div>
</div>

 <?php include('partials/footer.php'); ?>