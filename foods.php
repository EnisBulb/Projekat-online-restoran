<?php include('partials-front/meni.php');?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Pretražite.." required>
                <input type="submit" name="submit" value="Pretraži" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
       
            <?php 
                $sql="SELECT * FROM tbl_food WHERE aktivno='Da'";

                $res=mysqli_query($conn,$sql);

                $count =  mysqli_num_rows($res);

                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id=$row['id'];
                        $naslov = $row['naslov'];
                        $opis = $row['opis'];
                        $cijena = $row['cijena'];
                        $ime_slike = $row['ime_slike'];
                        ?>
                            <div class="food-menu-box">
                                <div class="food-menu-img">
                                    <?php 
                                         if($ime_slike=="")
                                         {
                                             echo "Slika nije dostupna";
                                         }
                                         else
                                         {
                                             ?>
                                                 <img src="<?php echo SITEURL; ?>images/food/<?php echo $ime_slike;?>" alt="Chicke Hawain Momo" class="img-responsive img-curve">
                                             <?php
                                         }
                                         //KADA je aktivno samo ce biti ispisano u kategoriji 
                                         //kada je i aktivno i  istaknuto bit ce prikazano na pocetnoj stranici
                                    ?>
                                    
                                </div>

                                <div class="food-menu-desc">
                                    <h4><?php echo $naslov;?></h4>
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
                    echo "Hrana nije pronađena";
                }
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php');?>
