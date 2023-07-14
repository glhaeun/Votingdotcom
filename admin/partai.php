<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Voting.com</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../admin_component/css/adminboots.css" rel="stylesheet">
</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/check.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>

<?php

if(isset($_POST['submit_partai'])){
    $nama = $_POST['nama'];
    $pemimpin = $_POST['pemimpin'];
    $ideologi = $_POST['ideologi'];

        $query = "SELECT * FROM partai WHERE nama = ? ";
        $get = $connect->prepare($query);
        $get -> execute([$nama]);

        if($get->rowCount()>0){
            flash_alert('Message','Nama Partai Sudah Terdaftar!', FLASH_DANGER);
        } else {
            $query = "SELECT * FROM partai WHERE pemimpin = ? ";
            $get = $connect->prepare($query);
            $get -> execute([$pemimpin]);
            if($get->rowCount()>0){
                flash_alert('Message','Pemimpin Partai Sudah Terdaftar!', FLASH_DANGER);
            } else {
                $query = "INSERT INTO partai (nama, pemimpin, ideologi) VALUES (?, ?, ?)";
                $get = $connect->prepare($query);
                $get -> execute([$nama, $pemimpin, $ideologi]);
                flash_alert('Message','Berhasil Menambah Partai!', FLASH_SUCCESS);
            }

        }
    } else if (isset($_GET['delete_partai'])){
        //
            $delete_id = $_GET['delete_partai'];
            $query = "SELECT * from partai WHERE id = ?";
            $get_partai = $connect->prepare($query);
            $get_partai -> execute([$delete_id]);
            $fetch = $get_partai -> fetch(PDO::FETCH_ASSOC);
            $nama = $fetch['nama'];
                
            $query="DELETE FROM candidate WHERE partai = ?";
            $delete_candidate = $connect->prepare($query);
            $delete_candidate -> execute([$nama]);

            
            $query="DELETE FROM partai WHERE id = ?";
            $delete_votes = $connect->prepare($query);
            $delete_votes -> execute([$delete_id]);

            flash_alert('Message','Berhasil Menghapus Partai!', FLASH_SUCCESS);

    }

?>
    

<body id="page-top">
<?php include '../admin_component/php/script.php' ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php' ?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
<?php include '../admin_component/php/topbar.php' ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">   
    <?php flash_alert('Message') ?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-start mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Daftar Partai</h1>
            <h6 class="m-0 ml-2 font-weight-bold text-primary">
            <button onclick="hideShow_update()" class="btn btn-primary">Tambah Partai</button>
            </h6>
        </div>

        <!-- Content Row -->
        <div class="row justify-content-center">
        <div class="card shadow mb-4" id="update-admin" style="display:none;">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Tambah Partai</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="nama">Nama Partai</label>
                                <input name="nama" type="text" class="form-control" id="nama" placeholder="" required >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="pemimpin">Pemimpin</label>
                                <input   name="pemimpin" type="text" class="form-control" id="pemimpin" required>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="ideologi">Ideologi</label>
                                <input   name="ideologi" type="text" class="form-control" id="ideologi" placeholder="" required>
                            </div>
                            </div>    


                            <input type="submit" class="btn btn-primary" value="Tambah" name="submit_partai">
                            <input onclick="hideShow_update()" type="button" class="btn btn-primary" value="Batal" name="cancel">
                            </form>     
                        </div>
                    </div>

        <div class="card shadow mb-4 w-75">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Partai</th>
                                            <th>Pemimpin Partai</th>
                                            <th>Ideologi</th>
                                                <th>Jumlah Kandidat</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


<?php 

    $query ="SELECT * FROM partai";
    $select_partai =  $connect->prepare($query);
    $select_partai -> execute();

    if($select_partai->rowCount()>0){
        while ($fetch_partai= $select_partai ->fetch(PDO::FETCH_ASSOC)){
            $find = $fetch_partai['nama'];
            $query ="SELECT * FROM candidate WHERE partai = '$find'";
            $get_partai = $connect->prepare($query);
            $get_partai -> execute();  
            $number_of_candidate = $get_partai ->rowCount();
            ?>
                        <tr>
                            <td><?=$fetch_partai['id']?></td>
                            <td><?=$fetch_partai['nama']?></td>
                            <td><?=$fetch_partai['pemimpin']?></td>
                            <td><?=$fetch_partai['ideologi']?></td>
                            <td><?=$number_of_candidate?></td>
                            <td><a href="update_partai.php?update_partai=<?=$fetch_partai['id']?>"><i class="fa-solid fa-pen-to-square"></i></a><a href="partai.php?delete_partai=<?=$fetch_partai['id']?>" class="" onclick="return confirm('Apakah anda yakin akan menghapus partai ini? Jika dihapus, kandidat dalam partai ini juga akan dihapus!');"><i class="fa-solid fa-trash"></i></a></td>
                         </tr>       
                    <?php
        }
    }
                                    
?>

                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

        


    </div>
    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->


<?php include '../admin_component/php/footer.php';?>

</div>
<!-- End of Content Wrapper -->

</div>

        <script>
            var update = document.getElementById('update-admin');
            var u_display = 'none';

            function hideShow_update() {
                if(u_display == 'none') {
                    update.style.display = 'block';
                    u_display = 'block';
            } else {
                update.style.display = 'none';
                u_display = 'none';
            }

           
        }
        function hideShow_add() {
                if(a_display == 'none') {
                    add.style.display = 'block';
                    update.style.display = 'none';
                    a_display = 'block';
                    u_display = 'none';
            } else {
                add.style.display = 'none';
                a_display = 'none';
            }
        }
        </script>

<?php include '../admin_component/php/default.php';?>

        
</body>




</html>