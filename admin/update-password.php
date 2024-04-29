<?php include("partials/meni.php");?>

<div class="glavni-dio">
    <div class="wrapper">
        <h1>Promijeni sifru</h1>
        <br>
        <br>

        <?php
            if(isset($_GET['id']))
            {
                $id=$_GET["id"];
            }
        ?>

        <form action="" method="POST">
            
            <table class="tbl-30">
                <tr>
                    <td>Trenutna sifra</td>
                    <td><input type="password" name="trenutna_sifra" placeholder="Trenutna Sifra">
                    </td>
                </tr>
                
                <tr>
                    <td>Nova sifra</td>
                    <td>
                        <input type="password" name="nova_sifra" placeholder="Nova sifra">
                    </td>
                </tr>

                <tr>
                    <td> Potvrdi sifru </td>
                   <td><input type="password" name="potvrdi_sifru" placeholder="Potvrdi sifru"></td> 
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="podnesi" value="Promijeni sifru" class="dugme-sec">
                    </td>
                </tr>
            </table> 

        </form>
    </div>
</div>

<?php

//provjeri je li submit kliknut ili ne
            if(isset($_POST['podnesi'])) {
                
                $id=$_POST['id']; 
                $trenutna_sifra=md5($_POST['trenutna_sifra']);
                $nova_sifra=md5($_POST['nova_sifra']);
                $potvrdi_sifru=md5($_POST['potvrdi_sifru']);


                $sql = "SELECT * FROM  tbl_admin WHERE id=$id AND sifra = '$trenutna_sifra'";

                $res =mysqli_query($conn, $sql);

                if($res==true){
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        if($nova_sifra==$potvrdi_sifru)
                        {
                            $sql2 =  "UPDATE tbl_admin SET sifra='$nova_sifra' WHERE id=$id";

                            $res2 = mysqli_query($conn, $sql2);
                            
                            if  ($res2 == true)
                            {
                                $_SESSION["promijeni sifru"]="Sifra uspjesno promijenjena!";
                                header("location:".SITEURL."admin/manage-admin.php");
                            
                            }
                            else
                            {
                                $_SESSION["promijeni sifru"]="Sifra nije promijenjena!";
                                header("location:".SITEURL."admin/manage-admin.php");
                            
                            }
                        }else
                        {
                            $_SESSION["sifra-se-ne-podudara"]="Sifra se ne podudara!";
                            header("location:".SITEURL."admin/manage-admin.php");
                        }
                    }
                    else
                    {
                        $_SESSION["korisnik-nije-pronadjen"]="Korisnik nije pronadjen";
                        header("location:".SITEURL."admin/manage-admin.php");
                    }
                }
            }

?>

<?php include("partials/footer.php");?>