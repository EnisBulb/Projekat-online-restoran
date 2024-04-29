<?php include('partials/meni.php')?>
        <!-- Glavni dio pocinje -->
        <div class="glavni-dio">
            <div class="wrapper">
                <h1>Upravljaj hranom</h1>

                <br>
                <br>
                <br>
                <a href="<?php echo SITEURL;?>admin/add-food.php" class="dugme-prim"> Dodaj Hranu </a>
                <br>
                <br>
                <br>

                <?php 
                    

                    if(isset($_SESSION['obrisi'])){
                        echo  $_SESSION['obrisi'];
                        unset($_SESSION['obrisi']);
                    }

                    if(isset($_SESSION['uspjesno'])){
                        echo  $_SESSION['uspjesno'];
                        unset($_SESSION['uspjesno']);
                    }

                    if(isset($_SESSION['unauthorise'])){
                        echo  $_SESSION['unauthorise'];
                        unset($_SESSION['unauthorise']);
                    }
                    
                    if(isset($_SESSION['dodaj'])){
                        echo  $_SESSION['dodaj'];
                        unset($_SESSION['dodaj']);
                    }
                    
                ?>
                <table class="tbl-full">
                    <tr>
                        <th> Serijski broj </th>
                        <th> Naslov</th>
                        <th> Cijena </th>
                        <th> Slika </th>
                        <th> Istaknuto </th>
                        <th> Aktivno </th>
                        <th> Akcije </th>
                    </tr>

                    <?php 
                    
                        $sql = "SELECT * FROM tbl_food";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn=1;

                        if($count>0){
                            while($row=mysqli_fetch_assoc($res)){
                                $id = $row['id'];
                                $naslov=$row['naslov'];
                                $cijena = $row['cijena'];
                                $ime_slike=$row['ime_slike'];
                                $istaknuto = $row['istaknuto'];
                                $aktivno = $row['aktivno'];
                                ?>

                                    <tr>
                                        <td><?php echo $sn++ ?> </td>
                                        <td><?php echo $naslov;?></td>
                                        <td><?php echo $cijena;?> </td>
                                        <td>
                                            <?php 
                                                if($ime_slike==""){
                                                    echo "Slika nije dodana.";
                                                }else{
                                                    ?>
                                                        <img src="<?php echo SITEURL;?>images/food/<?php echo $ime_slike;?>" width="100px" >
                                                    <?php
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $istaknuto;?></td>
                                        <td><?php echo $aktivno;?></td>
                                        <td><a href="#" class="dugme-sec"> Azuriraj hranu </a></td>
                                        <td><a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&ime_slike=<?php echo $ime_slike;?>" class="dugme-thi"> Obrisi hranu </a></td>
                                    </tr>
                                <?php
                            }


                        }else{
                            echo "<tr> <td colspan ='7'> Hrana nije dodana! </td></tr>";
                        }
                    
                    ?>

                   
                </table>

            </div>
        </div>
        <!-- Glavni dio zavrsava -->

<?php include('partials/footer.php')?>