<?php include('partials/meni.php')?>
        <!-- Glavni dio pocinje -->
        <div class="glavni-dio">
            <div class="wrapper">
                <h1>Upravljaj kategorijama</h1>
                <br> <br>
                
                <?php
                    
                    if(isset($_SESSION['dodaj'])){
                        echo  $_SESSION['dodaj'];
                        unset($_SESSION['dodaj']);
                    }

                    if(isset($_SESSION['ukloni'])){
                        echo  $_SESSION['ukloni'];
                        unset($_SESSION['ukloni']);
                    }

                    if(isset($_SESSION['obrisi'])){
                        echo  $_SESSION['obrisi'];
                        unset($_SESSION['obrisi']);
                    }

                    if(isset($_SESSION['ne-kategorija'])){
                        echo  $_SESSION['ne-kategorija'];
                        unset($_SESSION['ne-kategorija']);
                    }

                    if(isset($_SESSION['uspjesno'])){
                        echo  $_SESSION['uspjesno'];
                        unset($_SESSION['uspjesno']);
                    }

                    if(isset($_SESSION['upload'])){
                        echo  $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['neuspjesno'])){
                        echo  $_SESSION['neuspjesno'];
                        unset($_SESSION['neuspjesno']);
                    }

                ?>

                <br> <br>

                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="dugme-prim"> Dodaj Kategoriju </a>
                <br>
                <br>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th> ID </th>
                        <th> Naslov </th>
                        <th> Slika </th>
                        <th> Istaknuto </th>
                        <th> Aktivno </th>
                        <th> Akcije </th>
                    </tr>

                    <?php
                    
                    $sql = "SELECT * FROM tbl_category";
                    
                    $res = mysqli_query($conn, $sql);
                    
                    $count = mysqli_num_rows($res);
                    
                    $sn=1;

                    if($count>0){
                        while( $row=mysqli_fetch_assoc($res) ){
                            $id = $row['id'];
                            $naslov=$row['naslov'];
                            $ime_slike=$row['ime_slike'];
                            $istaknuto = $row['istaknuto'];
                            $aktivno = $row['aktivno'];

                            ?>

                        <tr>
                            <td> <?php echo $sn++ ?></td>
                            <td> <?php echo $naslov; ?></td>
                            
                            <td> 
                            
                                <?php
                                    if($ime_slike!=""){
                                        ?>

                                            <img src="<?php echo SITEURL;?>images/category/<?php echo $ime_slike ?>" width="100px" >

                                        <?php
                                    }else{
                                        echo "Slika nije dodana!";
                                    }
                                
                                ?>
                            
                            </td>
                            
                            <td> <?php echo $istaknuto; ?></td>
                            <td> <?php echo $aktivno; ?></td>
                            <td> 
                                <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id ?>" class="dugme-sec"> Azuriraj Kategoriju </a>
                                <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id ?>&ime_slike=<?php echo $ime_slike?>" class="dugme-thi"> Izbrisi Kategoriju </a>
                            </td>
                        </tr>

                            <?php
                        }


                    }else{
                        ?>

                        <tr>
                            <td colspan="6"> <div>Nema dodanih kategorija.</div> </td>
                        </tr>
                        
                        <?php
                    }



                    ?>

                    

                 
                </table>
               

            </div>
        </div>
        <!-- Glavni dio zavrsava -->

<?php include('partials/footer.php')?>