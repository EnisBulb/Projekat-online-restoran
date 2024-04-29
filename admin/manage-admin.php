<?php include('partials/meni.php')?>
        <!-- Glavni dio pocinje -->
        <div class="glavni-dio">
            <div class="wrapper">
                <h1>Upravljaj Adminima </h1>
                <br>

                <?php
                    if(isset($_SESSION['dodaj'])){
                        echo $_SESSION['dodaj'];//prikazivanje poruke
                        echo "</br> ";
                        unset($_SESSION['dodaj']);//uklanjanje poruke
                    }
                    
                    //NE RADI MI ISPIS ZA BRISANJE ADMINA
                    if(isset($_SESSION['obrisi'])){
                        echo  $_SESSION['obrisi'];
                        unset($_SESSION['obrisi']);
                    }

                    if(isset($_SESSION['update'])){
                        echo  $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['korisnik-nije-pronadjen'])){
                        echo  $_SESSION['korisnik-nije-pronadjen'];
                        unset($_SESSION['korisnik-nije-pronadjen']);
                    }

                    if(isset($_SESSION['sifra-se-ne-podudara'])){
                        echo  $_SESSION['sifra-se-ne-podudara'];
                        unset($_SESSION['sifra-se-ne-podudara']);
                    }

                    if(isset($_SESSION['promijeni sifru'])){
                        echo  $_SESSION['promijeni sifru'];
                        unset($_SESSION['promijeni sifru']);
                    }
                ?>
                <br> <br> 

                <a href="add-admin.php" class="dugme-prim"> Dodaj Admin-a </a>
                <br>
                <br>
                <br>

                <table class="tbl-full">
                    <tr>
                        <th> Serijski broj </th>
                        <th> Puno ime </th>
                        <th> Korisnicko ime </th>
                        <th> Akcije </th>
                    </tr>

                    <?php
                    //queary za pozivanje admina
                        $sql = "SELECT * from tbl_admin";
                        $res = mysqli_query($conn, $sql);
                        //provjera da li je query izvrsen ili ne

                        if($res == true){
                            //izbroji redove da vidimo da li imamo podatke u bazi
                            $count = mysqli_num_rows($res); //uzmi sve redove

                            $sn = 1; //napravi varijablu i pridruzi vrijednost
                            //provjeri broj redova
                            if($count>0){
                                //imaamoi podatke u bazi
                                while($rows = mysqli_fetch_assoc($res)){
                                    //koristeci while dobijamo podatke iz baze
                                    //while traje dok imamo podatke u bazi

                                    //get individual data

                                    $id = $rows['id'];
                                    $puno_ime = $rows['puno_ime'];
                                    $korisnicko_ime = $rows['korisnicko_ime'] ;

                                    // prikazi vrijednosti u nasoj tabeli 
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++ ?></td>
                                        <td><?php echo $puno_ime ?></td>
                                        <td> <?php echo $korisnicko_ime ?></td>
                                        <td> 
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="dugme-prim">Promijeni sifru</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="dugme-sec"> Azuriraj Admin-a </a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>" class="dugme-thi"> Izbrisi Admin-a </a>
                                        </td>
                                    </tr>

                                    <?php 
                                }
                            } else{
                                //nemamo podataka u bazi
                            }
                        }
                    ?>
                    
                </table>

            </div>
        </div>
        <!-- Glavni dio zavrsava -->

<?php include('partials/footer.php')?>