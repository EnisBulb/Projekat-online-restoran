<?php include('partials-front/meni.php');?>

<?php 

    if(isset($_GET['id_hrane']))
    {
        $id_hrane = $_GET['id_hrane'];
        
        $sql = "SELECT * FROM tbl_food WHERE id=$id_hrane";

        $res = mysqli_query($conn,$sql);

        $count = mysqli_num_rows($res);

        if($count==1)
        {
            $row = mysqli_fetch_assoc( $res );
            $naslov = $row ['naslov'];
            $cijena = $row['cijena'];
            $ime_slike = $row['ime_slike'];
        }
        else
        {
            header("location:".SITEURL);
        }

    }
    else
    {
        header("location:".SITEURL);
    }

?>

        
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Popunite formu da nastavite narudžbu</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Odabrana hrana</legend>

                    <div class="food-menu-img">
                        <?php 
                            if($ime_slike=="")
                            {
                                echo "Slika nije dostupna";
                            }
                            else
                            {
                                ?>
                                    <img src="images/food/<?php echo $ime_slike; ?>" alt="Vaša hrana" class="img-responsive img-curve">
                                <?php
                            }
                        ?>

                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $naslov;?></h3>
                        <input type="hidden" name="hrana" value="<?php echo $naslov; ?>">
                        
                        <p class="food-price"><?php echo $cijena;?></p>
                        <input type="hidden" name="cijena" value="<?php echo $cijena?>">

                        <div class="order-label">Kolicina</div>
                        <input type="number" name="kolicina" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Fetalji dostave</legend>
                    <div class="order-label"> Ime i prezime </div>
                    <input type="text" name="ime_kupca" placeholder="Unesite ime i prezime..." class="input-responsive" required>

                    <div class="order-label">Broj telefona</div>
                    <input type="tel" name="kontakt_kupca" placeholder="Broj tel..." class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email_kupca" placeholder="E-mail adresa..." class="input-responsive" required>

                    <div class="order-label">Adresa </div>
                    <textarea name="adresa" rows="10" placeholder="Unesite vasu adresu..." class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Potvrdi narudžbu" class="btn btn-primary">
                </fieldset>

            </form>

            <?php 
            
                if(isset($_POST['submit']))
                {
                    $hrana = $_POST['hrana'];
                    $cijena = $_POST['cijena'];
                    $kolicina = $_POST['kolicina'];

                    $ukupno = $cijena * $kolicina;

                    $datum_narudzbe = date( "Y-m-d h:i:sa" );
                    
                    $status ="Naručeno";

                    $ime_kupca = $_POST['ime_kupca'];
                    $kontakt_kupca = $_POST['kontakt_kupca'];
                    $email_kupca = $_POST['email_kupca'];
                    $adresa = $_POST['adresa'];

                    $sql2 = "INSERT INTO tbl_order SET
                        hrana = '$hrana',
                        cijena = '$cijena',
                        kolicina = '$kolicina',
                        ukupno = '$ukupno',
                        datum_narudzbe = '$datum_narudzbe',
                        status = '$status',
                        ime_kupca= '$ime_kupca',
                        kontakt_kupca='$kontakt_kupca',
                        email_kupca = '$email_kupca',
                        adresa = '$adresa'
                    ";

                    $res2=mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        $_SESSION['narudzba']="<div class='text-center'> Narudžba uspjesno poslana! </div>";
                        header("location:".SITEURL);
                    }
                    else
                    {
                        $_SESSION['narudzba']="<div class='text-center'> Narudžba uspjesno poslana! </div>";
                        header("location:".SITEURL);
                    }
                }
            
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php');?>
