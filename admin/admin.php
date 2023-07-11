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
<?php include '../admin_component/php/logout.php';
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
            <h1 class="h3 mb-0 text-gray-800">Profil Admin</h1>
            <h6 class="m-0 ml-2 font-weight-bold text-primary">
            <button onclick="hideShow_update()" class="btn btn-primary">Perbarui Profil</button>
            </h6>
            <?php 
            if($_SESSION['admin_level']=='master_admin'){
                ?>
            <h6 class="m-0 ml-2 font-weight-bold text-primary">
            <button onclick="hideShow_add()" class="btn btn-primary">Tambah Admin</button>
            </h6>
                <?php
            }
            ?>
            
        </div>

        <!-- Content Row -->
        <div class="row justify-content-center">
        <div class="card shadow mb-4" id="update-admin" style="display:none;">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Perbarui Admin</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="admin_nama">Nama Admin</label>
                                <input   name="admin_nama" type="text" class="form-control" id="admin_nama" placeholder="" value="<?=$_SESSION['nama_admin']?>">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="admin_username">Username Admin</label>
                                <input   name="admin_username" type="text" class="form-control" id="admin_username" value="<?=$_SESSION['admin_username']?>" >
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="admin_currentpassword">Kata Kunci Admin Sebelumnya</label>
                                <input   name="admin_currentpassword" type="password" class="form-control" id="admin_currentpassword" placeholder="" >
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="admin_password">Kata Kunci Admin yang Baru</label>
                                <input   name="admin_password" type="password" class="form-control" id="admin_password" placeholder="" >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="admin_cpassword">Konfirmasi Kata Kunci Baru</label>
                                <input   name="admin_cpassword" type="password" class="form-control" id="admin_cpassword" placeholder="" >
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Ubah" name="update-admin">
                            <input onclick="hideShow_update()" type="button" class="btn btn-primary" value="Batal" name="cancel">

                            </form>
                        </div>
                    </div>
                    <?php 
            if($_SESSION['admin_level']=='master_admin'){
                ?>
        <div class="card shadow mb-4" id="add-admin" style="display:none;">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Tambah Admin</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="admin_nama">Nama Admin</label>
                                <input   name="admin_nama" type="text" class="form-control" id="admin_nama" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="admin_username">Username Admin</label>
                                <input   name="admin_username" type="text" class="form-control" id="admin_username" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="admin_password">Kata Kunci Admin</label>
                                <input   name="admin_password" type="password" class="form-control" id="admin_password" placeholder="" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="admin_cpassword">Konfirmasi Kata Kunci</label>
                                <input   name="admin_cpassword" type="password" class="form-control" id="admin_cpassword" placeholder="" required>
                                </div>
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Tambah" name="add-admin">
                            <input type="button" class="btn btn-primary" value="Batal" name="cancel" onclick="hideShow_add()">

                            </form>
                        </div>
                    </div>
                    <?php
            }
            ?>

    
        <div class="card shadow mb-4 w-75">
                        
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Admin</th>
                                            <th>Username</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


<?php 

    $query ="SELECT * FROM admin";
    $select_admin =  $connect->prepare($query);
    $select_admin -> execute();

    if($select_admin->rowCount()>0){
        while ($fetch_admin = $select_admin ->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <tr>
                            <td><?=$fetch_admin['admin_id']?></td>
                            <td><?=$fetch_admin['nama_admin']?></td>
                            <td><?=$fetch_admin['username']?></td>
                    <?php if($fetch_admin['level']=='master_admin'){
                        ?>
                            <td>MASTER ADMIN</td>
                        <?php
                    } else {
                        if($_SESSION['admin_level']=='master_admin'){
                        ?>
                            <td><a href="admin.php?delete=<?=$fetch_admin['admin_id']?>" class="" onclick="return confirm('Are you sure to delete this admin?');"><i class="fa-solid fa-trash"></i></a></td>
                        <?php
                    } else {
                        ?><td>ADMIN NORMAL</td>
                        <?php
                        }
                    }?> </tr>       
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
            var add = document.getElementById('add-admin');
            var u_display = 'none';
            var a_display = 'none';

            function hideShow_update() {
                if(u_display == 'none') {
                    update.style.display = 'block';
                    add.style.display = 'none';
                    a_display = 'none';
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