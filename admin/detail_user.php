
<!DOCTYPE html>
<html lang="en">

<head>
<?php require_once("../admin_component/php/check.php");?>

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
<?php include '../admin_component/php/flash_alert.php' ?>
<?php include '../admin_component/php/sendEmail.php';

$uid = $_GET['detail_user'];
$query = "SELECT * FROM users WHERE user_id = $uid";
$show_user= $connect->prepare($query);
$show_user -> execute([]);
$fetch_user = $show_user->fetch(PDO::FETCH_ASSOC);

?>


<body id="page-top">
<?php include '../admin_component/php/script.php';?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php';?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
<?php include '../admin_component/php/topbar.php';?>

    <div class="container-fluid">


    <!-- Begin Page Content -->
    <div class="row justify-content-center">
        
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Data User - <?=$fetch_user['status']?></h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="nama">Nama</label>
                                <input   name="nama" type="text" class="form-control" id="nama" value="<?=$fetch_user['nama']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="nomor">Nomor Hp</label>
                                <input   name="nomor" type="text" class="form-control" id="nomor" value="<?=$fetch_user['nomor']?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input   name="email" type="text" class="form-control" id="email" value="<?=$fetch_user['email']?>" disabled>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="NIK">NIK</label>
                                <input   name="NIK" type="text" class="form-control" id="NIK" value="<?=$fetch_user['NIK']?>" disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12" style="display: grid;">
                                <label for="fotowakil">Foto KTP:</label>
                                <img src="../img/user/<?=$fetch_user['foto_KTP']?>" alt="" class="rounded">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12" style="display: grid;">
                                <label for="fotowakil">Foto Wajah:</label>
                                <img src="../img/user/<?=$fetch_user['foto_wajah']?>" class="rounded">
                                </div>
                            </div>
                            
                            
                            <?php
                                if($fetch_user['status'] == "verified"){
                                    ?>
                            <input type="submit" class="btn btn-danger" value="Hapus" name="delete" onclick="return confirm('Are you sure to delete this user?');">
                            <input type="submit" class="btn btn-secondary" value="Batal" name="cancel">
                                    <?php
                                } else {
                                    ?>
                            <input type="submit" class="btn btn-primary" value="Terima" name="verify">
                            <input type="submit" class="btn btn-danger" value="Tolak" name="reject">
                            <input type="submit" class="btn btn-secondary" value="Batal" name="cancel">

                                    <?php
                                }
                            ?>
                            
                        </form>
                        </div>
                    </div>

    </div>
    </div>
        


    <!-- container-fluid -->


</div>
<!-- End of Main Content -->

<?php include '../admin_component/php/footer.php';?>

</div>
<!-- End of Content Wrapper -->

</div>
<?php include '../admin_component/php/default.php';?>


        
</body>

<style>
    img{
        max-width: 450px;
    }
</style>


</html>