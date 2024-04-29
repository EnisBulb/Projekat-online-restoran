<?php include('partials/meni.php');?>

<div class="glavni-dio">
    <div class="wrapper">
        <div>
            <h1>Dodaj hranu</h1>

            <br> <br>

            <?php 
                if(isset($_SESSION['upload'])){
                    echo  $_SESSION['upload'];
                    unset($_SESSION['upload']); 
                }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">

                <table class="tbl-30">
                    <tr>
                        <td> Naslov: </td>
                        <td> 
                            <input type="text" name="naslov" placeholder="Naslov hrane">
                        </td>
                    </tr>

                    <tr>
                        <td> Opis: </td>
                        <td>
                            <textarea name="opis" cols="30" rows="5" placeholder="Opis hrane"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td> Cijena: </td>
                        <td>
                            <input type="number" name="cijena" >
                        </td>
                    </tr>

                    <tr>
                        <td> Odaberi sliku: </td>
                        <td>
                            <input type="file" name="slika">
                        </td>
                    </tr>

                    <tr> 
                        <td> Kategorija: </td>
                        <td>
                            <select name="kategorija">

                                <?php 
                                    $sql="SELECT * FROM tbl_category WHERE aktivno='Da'"; 
                                    
                                    $res=mysqli_query($conn, $sql);  

                                    $count=mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        while ($row=mysqli_fetch_assoc($res)) {

                                            $id=$row['id'];
                                            $naslov = $row['naslov'];
                                            ?>
                                                <option value="<?php echo $id; ?>"><?php echo $naslov; ?> </option>
                                                
                                            <?php
                                        }
                                    } 
                                    else
                                    {
                                        ?>
                                        <option value="0"> Nije pronađena kategorija </option>
                                        <?php
                                    }
                               ?>

                              </select>
                        </td>
                    </tr>

                    <tr>
                        <td> Istaknuto: </td>
                        <td>
                            <input type="radio" name="istaknuto" value="Da">Da
                            <input type="radio" name="istaknuto" value="Ne">ne
                        </td>
                    </tr>
                    
                    <tr>
                        <td> Aktivno: </td>
                        <td>
                            <input type="radio" name="aktivno" value="Da">Da
                            <input type="radio" name="aktivno" value="Ne">ne
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Dodaj hranu" class="dugme-sec">
                        </td>
                    </tr>
                </table>
            
            </form>
            
            <?php 
            
                //provjera je li dugme pritisnuto 
                if(isset($_POST['submit'])){

                    //1 uzmi podatke iz forme 
                    $naslov = $_POST['naslov'];
                    $opis = $_POST['opis'];
                    $cijena = $_POST['cijena'];
                    $kategorija = $_POST['kategorija'];

                    if(isset($_POST['istaknuto'])){
                        $istaknuto = $_POST['istaknuto'];
                    } else {
                        $istaknuto = "Ne";
                    }

                    if(isset($_POST['aktivno'])){
                        $aktivno = $_POST['aktivno'];
                    } else {
                        $aktivno = "Ne";
                    }


                    //2 ubaci sliku ako je odabrana
                  
                    if(isset($_FILES['slika']['name'])){
                        $ime_slike = $_FILES['slika']['name'];
                        
                        if($ime_slike!=""){
    
                        
    
                            $splitted = explode('.', $ime_slike);
                            $ext = end($splitted);
    
                            $ime_slike = "ime_hrane".rand(000, 999).'.'.$ext;
                        
                        
                            $src= $_FILES[ 'slika' ]['tmp_name'];
                            $dst = "../images/food/".$ime_slike;
                            
                            $upload = move_uploaded_file($src, $dst);
                            
                            if($upload==false){
                                $_SESSION['upload']="Slika nije prenesena!";
                                header("location:".SITEURL."admin/add-food.php");
    
                                //zaustavi proces
    
                                die();
                            }
                        }   

                    }else{
                        $ime_slike="";
                    }
                    //3 ubaci u bazu

                    $sql2="INSERT INTO tbl_food SET
                        naslov = '$naslov',
                        opis = '$opis',
                        cijena = $cijena,
                        ime_slike='$ime_slike',
                        kategorija_id = $kategorija,
                        istaknuto  = '$istaknuto',
                        aktivno = '$aktivno'
                    ";

                    $res2 = mysqli_query($conn, $sql2);

                    if($res2==true){
                        $_SESSION['dodaj'] = "Kategorija uspjesno dodana!";
                        header("location:".SITEURL."admin/manage-food.php"); 
                           
                    // IMAM GRESGU OVDJE NE ISPISUJE FINO
                    }else{
                        $_SESSION['dodaj'] = "Kategorija nije dodana! ";
                        header("location:".SITEURL."admin/manage-food.php");
                    
                    }


                }
            
            ?>

        </div>
    </div>
</div>

<?php include('partials/footer.php');?>