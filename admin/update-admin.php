
<?php include("partials/meni.php"); ?>
<div class="glavni-dio">
    <div class="wrapper">
        <h1>Izmijeni admina</h1>

        <br>
        <br>

        <?php 
            //uzmi id selektovanog admina
            $id = $_GET['id']; 
            //napravi qveri za 
            $sql = "SELECT * from tbl_admin WHERE id=$id";
            
            $res = mysqli_query($conn, $sql);
            //provjera je li izvrseno ili ne

            //provjera da se ne unese preko  urla niska bez id-ja
            //VAZNOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOOO
            if($res==true) {
                $count = mysqli_num_rows($res);
                if($count == 1){
                    $row = mysqli_fetch_assoc($res);

                    $puno_ime = $row['puno_ime'];
                    $korisnicko_ime = $row['korisnicko_ime'];
                }
                else{
                    header("location:".SITEURL."admin/manage-admin.php");
                }
            }
        ?>
        
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td> Puno ime: </td>
                    <td>
                        <input type="text" name="puno_ime" value="<?php echo $puno_ime?>">
                    </td>
                </tr>

                <tr>
                    <td> Korisnicko ime:</td>
                    <td>
                        <input type="text" name="korisnicko_ime" value="<?php echo $korisnicko_ime?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="update admin" class="dugme-sec">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php 
    if(isset($_POST[ 'submit' ])){
        $id = $_POST['id'];
        $puno_ime= $_POST['puno_ime'];
        $korisnicko_ime = $_POST['korisnicko_ime'];
        
        $sql = "UPDATE tbl_admin SET
        puno_ime = '$puno_ime',
        korisnicko_ime = '$korisnicko_ime'
        WHERE id= '$id'
        ";

        $res = mysqli_query(  $conn, $sql );

        if($res==true){
            $_SESSION['update'] = "Admin azuriran!";
            //redirect page
            header( "location:".SITEURL."admin/manage-admin.php" );
    }else{
        $_SESSION['update'] = "Admin  nije azuriran!";
            //redirect page
            header( "location:".SITEURL."admin/manage-admin.php" );
    }
    }
?>
<?php include("partials/footer.php"); ?>
