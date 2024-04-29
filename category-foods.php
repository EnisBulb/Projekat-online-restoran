<?php include('partials-front/meni.php');?>

<?php 

    if(isset($_GET['kategorija_id']))
    {
        $kategorija_id = $_GET[ 'kategorija_id' ];

        $sql = "SELECT naslov FROM tbl_category WHERE id=$kategorija_id";
        
        $res = mysqli_query($conn, $sql);

        $row = mysqli_fetch_assoc( $res );

        $naslov_kategorije = $row['naslov'];
    }
    else
    {
        header('location:'.SITEURL);
    }
?>
    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Hrana <a href="#" class="text-white">"<?php echo $naslov_kategorije;?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php 
            
                $sql2 = "SELECT * FROM tbl_food WHERE kategorija_id=$kategorija_id";
            
                $res2 = mysqli_query($conn, $sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2>0)
                {
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id  = $row2["id"];
                        $naslov = $row2[ 'naslov' ];
                        $cijena =  $row2[ 'cijena' ];
                        $opis =   $row2[ 'opis' ];
                        $ime_slike =  $row2[ 'ime_slike' ];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php
                                        if($ime_slike=="")
                                        {
                                            echo "Slika nije dostupna.";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL;?>images/food/<?php echo $ime_slike;?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                
                                            <?php
                                        }
                                    ?>
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $naslov; ?></h4>
                                    <p class="food-price"><?php echo $cijena; ?></p>
                                    <p class="food-detail">
                                        <?php echo $opis; ?>
                                    </p>
                                    <br>

                                    <a href="order.php?id_hrane=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                        <?php
                    }
                }
                else
                {
                    echo "Hrana nije dostupna.";
                }
            ?>

        


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->


    <?php include('partials-front/footer.php');?>
