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

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom styles for this template-->
    <link href="../admin_component/css/adminboots.css" rel="stylesheet">

</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/check.php';?>
<?php include '../admin_component/php/flash.php' ?>




<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php';?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<?php include '../admin_component/php/topbar.php';?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php flash('Success');?>   
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Dasbor</h1>
        </div>
        <div class="d-sm-flex align-items-center justify-content-center mb-4" style="display: grid;">
            <h1 class="h5 mb-0 text-gray-800">Halo, <?=$_SESSION['nama_admin']?>! <i class="fas fa-smile-wink"></i></h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-red-voting shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    <?php
                                    $query = "SELECT * FROM category";
                                    $get = $connect -> prepare($query);
                                    $get -> execute();
                                    ?>
                                    Total Kategori</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$get->rowCount()?></div>
                            </div>
                            <div class="col-auto">
                            <i class="fas fa-th-list fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-red-voting shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Kandidat</div>
                                    <?php
                                    $query = "SELECT * FROM candidate";
                                    $get = $connect -> prepare($query);
                                    $get -> execute();
                                    ?>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$get->rowCount()?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-red-voting shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengguna
                                </div>
                                <?php
                                    $query = "SELECT * FROM users";
                                    $get = $connect -> prepare($query);
                                    $get -> execute();
                                    ?>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?=$get->rowCount()?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-red-voting shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                    <?php
                                    $query = "SELECT * FROM votes";
                                    $get = $connect -> prepare($query);
                                    $get -> execute();
                                    ?>
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Jumlah Suara</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$get->rowCount()?></div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-poll-h fa-2x text-gray-300"></i>
                            </div>
                        </div>
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
    <?php include '../admin_component/php/default.php';?>
</body>




</html>