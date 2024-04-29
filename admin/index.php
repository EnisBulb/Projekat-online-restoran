
<?php include('partials/meni.php')?>
        <!-- Glavni dio pocinje -->
        <div class="glavni-dio">
            <div class="wrapper">
                <h1>Lista kategorija</h1>
               <br> <br>
               <?php
            
                    if(isset($_SESSION['login'])){
                         echo  $_SESSION['login'];
                         unset($_SESSION['login']);
                    }
            
               ?>

               <br> <br>
               <div class="col-4 text-center">
                    <?php 
                         $sql = "SELECT * FROM tbl_category";
                         $res = mysqli_query($conn, $sql);
                         $count = mysqli_num_rows($res);
                         
                    ?>
                    <h1> <?php echo $count;?> </h1> <br>
                    Kategorije
               </div>

               <div class="col-4 text-center">
                    <?php 
                         $sql2 = "SELECT * FROM tbl_food";
                         $res2 = mysqli_query($conn, $sql2);
                         $count2 = mysqli_num_rows($res2);
                         
                    ?>
                    <h1> <?php echo $count2;?> </h1> <br>
                    Jela
               </div>

               <div class="col-4 text-center">
                    <?php 
                         $sql3 = "SELECT * FROM tbl_order";
                         $res3 = mysqli_query($conn, $sql3);
                         $count3 = mysqli_num_rows($res3);
                         
                    ?>
                    <h1> <?php echo $count3 ?></h1> <br>
                    Ukupno narudžbi
               </div>

               <div class="col-4 text-center">
                    
                    <?php 
                         $sql4 = "SELECT SUM(ukupno) AS Ukupno FROM tbl_order";

                         $res4 = mysqli_query($conn, $sql4);

                         $row4=mysqli_fetch_assoc($res4);

                         $ukupni_prihodi = $row4['Ukupno'];

                    ?>
                    
                    <h1> <?php echo $ukupni_prihodi; ?> KM</h1> <br>
                    Ostvareni prihod
               </div>

               <div class="clearfix"></div>
            </div>
        </div>
        <!-- Glavni dio zavrsava -->

<?php include('partials/footer.php')?>