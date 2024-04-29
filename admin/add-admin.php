<?php include('partials/meni.php')?>


<div class="glavni-dio">
    <div class="wrapper">
        <h1>Dodaj Admina</h1>
        <br>
        <br>

        <?php 
            if(isset($_SESSION['dodaj'])){ //provjera da li je sesija postavljena ili ne
                echo $_SESSION['dodaj'];    //prikazi poruku ako je postavljena 
                unset($_SESSION['dodaj']); //ukloni session poruku
                
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Puno ime</td>
                    <td><input type="text" name="puno_ime" placeholder="Unesite ime"> </td>
                </tr>

                <tr>
                <td>Korisnicko ime</td>
                    <td><input type="text" name="korisnicko_ime" placeholder="Unesite korisnicko ime"> </td>
                </tr>

                <tr>
                <td> Sifra </td>
                    <td><input type="password" name="sifra" placeholder="Unesite sifru"> </td>
                </tr>

                <tr>
                    <td colspan="2"> 
                        <input type="submit" name="submit" value="Dodaj Admina" class="dugme-sec">
                    </td>
                </tr>
            </table>
        </form>
    </div>

</div>


<?php include('partials/footer.php')?>

<?php 
    //uzimanje podataka iz forme i pohranjivanje u bazu

    //provjera  da li je button kliknut ili ne

    if(isset($_POST[ 'submit' ]))
    {
        //echo("Dugme kliknuto");

        //uzimanje podataka iz forme

        $puno_ime = $_POST[ 'puno_ime' ];
        $korisnicko_ime =  $_POST['korisnicko_ime'];
        $sifra = md5($_POST['sifra']);

        //sql querry za ubacivanje u tabelu

        $sql = "INSERT INTO tbl_admin SET
            puno_ime='$puno_ime',
            korisnicko_ime = '$korisnicko_ime',
            sifra = '$sifra'
        ";

        //izvrsavanje querija i cuvanje podataka u bazu
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
       
        //provjeri da li su podaci ubaceni ili ne

        //U OVOM BLOKU KODA ISPOD POSTOJI NEDOSTATAK DA AKO SE UNESE PRAZNO
        //POLJE BIT CE USPJESNA POHRANA PODATKA  U TABELU, STO NE BI 
        //TREBALO DA SE DESAVA.

        if ($res == true){
            //napravi varijablu za prikaz  poruke
            $_SESSION['dodaj'] = "Novi admin dodan uspjesno!";
            //redirect page
            header( "location:".SITEURL."admin/manage-admin.php" );
        }else{
            $_SESSION['dodaj'] = "Admin nije dodan!!";
            //redirect page to add admin
            header( "location:".SITEURL."admin/add-admin.php" );
        
        }
    }
    
?>