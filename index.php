<?php include('partials-front/meni.php');?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Pretražite..." required>
                <input type="submit" name="submit" value="Pretraži" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php
        if(isset($_SESSION['narudzba'])){
            echo $_SESSION['narudzba'];
            unset($_SESSION['narudzba']);
        }
    ?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Pretražuj hranu</h2>

            <?php
            
            $sql = "SELECT * FROM tbl_category WHERE aktivno='DA' AND istaknuto='Da' LIMIT 3";

            $res = mysqli_query($conn, $sql);
            
            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while ($row=mysqli_fetch_assoc($res)) {
                    $id=$row['id'];
                    $naslov=$row['naslov'];
                    $ime_slike=$row['ime_slike'];
                    ?>
                        <a href="category-foods.php?kategorija_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($ime_slike==""){
                                        echo "Slika nije dostupna.";
                                    } 
                                    else
                                    {
                                        ?>
                                            <img src="<?php echo SITEURL; ?>/images/category/<?php echo $ime_slike;?>" alt="Pizza" class="img-responsive img-curve">

                                        <?php
                                    }
                                ?>
                                <h3 class="float-text text-white"><?php echo $naslov; ?></h3>
                            </div>
                        </a>
                    <?php 
                }
            }else
            {
                echo "Kategorija nije pronađena.";
            }
            ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Meni</h2>

            <?php 
                $sql2 = "SELECT * FROM tbl_food WHERE aktivno='Da' AND istaknuto='Da' LIMIT 6";

                $res2=mysqli_query($conn,$sql2);

                $count2 = mysqli_num_rows($res2);

                if($count2 > 0 )
                {
                    while ($row=mysqli_fetch_assoc($res2))  
                    {
                        $id=$row['id'];
                        $naslov=$row['naslov'];
                        $cijena = $row['cijena'];
                        $opis = $row[ 'opis'];
                        $ime_slike=$row['ime_slike'];
                        ?>
                          <div class="food-menu-box">
                                <div class="food-menu-img">

                                    <?php 
                                        if($ime_slike =="")
                                        {
                                            echo "Slika nije dostupna";
                                        }
                                        else
                                        {
                                            ?>
                                                <img src="<?php echo SITEURL ?>images/food/<?php echo $ime_slike; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                
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

                                    <a href="order.php?id_hrane=<?php echo $id;?>" class="btn btn-primary">Naruči sada</a>
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

        <p class="text-center">
            <a href="foods.php">Pogledaj svu hranu</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>