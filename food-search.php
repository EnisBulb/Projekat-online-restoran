<?php include('partials-front/meni.php');?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
                $search = $_POST['search'];

            
            ?>
            <h2>Hrana na vašu pretragu <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            
            <h2 class="text-center">Meni Hrane</h2>

            <?php 

                $sql = "SELECT * FROM tbl_food WHERE naslov LIKE '%$search%' OR opis LIKE  '%$search%'";

                $res = mysqli_query($conn, $sql);
                
                $count = mysqli_num_rows($res);

                if($count > 0)
                {
                    while($row =  mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $naslov = $row['naslov'];
                        $cijena = $row['cijena'];
                        $opis = $row['opis'];
                        $ime_slike =  $row['ime_slike'];
                        ?>

                        <div class="food-menu-box">
                            <div class="food-menu-img">
                                <?php
                                    if($ime_slike=="")
                                    {
                                        echo "Nema dostupne slike";
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
                                <h4><?php echo $naslov;?></h4>
                                <p class="food-price"><?php echo $cijena;?></p>
                                <p class="food-detail">
                                    <?php echo $opis;?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>


                        <?php
                    }
                }
                else 
                {
                    echo "Hrana nije pronađena.";
                }
            ?>

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
