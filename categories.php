
<?php include('partials-front/meni.php');?>

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Pretraži hranu</h2>

            <?php 
                $sql = "SELECT * FROM tbl_category WHERE aktivno='Da'";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count > 0)
                { 
                    while($row=mysqli_fetch_assoc($res))
                    {
                      $id=$row['id'];
                      $naslov = $row['naslov'];
                      $ime_slike = $row['ime_slike'];
                      ?>
                         <a href="category-foods.php?kategorija_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($ime_slike=="")
                                    {
                                        echo "Slika nije dostupna";
                                    }
                                    else
                                    {
                                        ?>
                                             <img src="<?php echo SITEURL;?>images/category/<?php echo $ime_slike?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                    //KADA je aktivno samo ce biti ispisano u kategoriji 
                                    //kada je i aktivno i  istaknuto bit ce prikazano na pocetnoj stranici
                                ?>
                               
                                
                                <h3 class="float-text text-white"><?php echo $naslov;?></h3>
                            </div>
                        </a>
                      <?php  
                    }
                }
                else 
                {
                    echo "Kategorija nije dostupna";
                }
            ?>

           

            
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>
