<?php include('partials/meni.php')?>
        <!-- Glavni dio pocinje -->
        <div class="glavni-dio">
            <div class="wrapper">
                <h1>Upravljaj narudžbama</h1>


                <table class="tbl-full">
                    <tr>
                        <th> ID </th>
                        <th> Hrana </th>
                        <th> Cijena </th>
                        <th> Kolicina </th>
                        <th> Ukupno </th>
                        <th> Datum narudžbe </th>
                        <th> Status </th>
                        <th> Ime kupca </th>
                        <th> Kontakt kupca </th>
                        <th> Email </th>
                        <th> Adresa </th>
                        <th> Akcije </th>
                    </tr>

                    <?php 
                    
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC";

                        $res = mysqli_query($conn, $sql);

                        $count = mysqli_num_rows($res);

                        $sn = 1;
                        if($count>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $hrana = $row['hrana'];
                                $cijena = $row['cijena'];
                                $kolicina = $row['kolicina'];
                                $ukupno = $row ['ukupno'];
                                $datum_narudzbe = $row ['datum_narudzbe'];
                                $status = $row['status'];
                                $ime_kupca = $row['ime_kupca'];
                                $kontakt_kupca = $row['kontakt_kupca'];
                                $email_kupca = $row[ 'email_kupca'];
                                $adresa = $row['adresa'];

                                ?>
                                    <tr>
                                        <td> <?php echo $sn++; ?> </td>
                                        <td> <?php echo $hrana;?> </td>
                                        <td> <?php echo $cijena;?> </td>
                                        <td> <?php echo $kolicina;?> </td>
                                        <td> <?php echo $ukupno;?> </td>
                                        <td> <?php echo $datum_narudzbe;?> </td>
                                        <td> <?php echo $status;?> </td>
                                        <td> <?php echo $ime_kupca;?> </td>
                                        <td> <?php echo $kontakt_kupca;?> </td>
                                        <td> <?php echo $email_kupca;?> </td>
                                        <td> <?php echo $adresa;?> </td>
                                        <td> 
                                            <a href="#" class="dugme-sec"> Azuriraj Admin-a </a>
                                        </td>
                                    </tr>

                                <?php
                            }
                        }
                        else
                        {
                            echo "<tr> <td colspan='12'> Narudžbe nisu dostupne </td> </tr>";
                        }
                    ?>
                    
                    

                   
                </table>

            </div>
        </div>
        <!-- Glavni dio zavrsava -->

<?php include('partials/footer.php')?>