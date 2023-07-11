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


<?php 
    $update = $_GET['update_category'];
    $query = "SELECT * FROM category WHERE category_id = '$update'";
    $show_category = $connect->prepare($query);
    $show_category -> execute([]);
    $fetch_category = $show_category->fetch(PDO::FETCH_ASSOC);

    $votingname = $fetch_category['nama'];
    $jumlah_calon = $fetch_category['jml_calon'];
?>

<body id="page-top">
<?php include '../admin_component/php/script.php' ;?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php' ;?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
<?php include '../admin_component/php/topbar.php' ;?>


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <?php flash_alert('Message')?>

        <!-- Content Row -->
        
        
        <div class="row category-row justify-content-center">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Mengubah Data Kategori</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="votetitle">Nama Kategori:</label>
                                <input type="text" class="form-control" name="votetitle" value="<?=$fetch_category['nama']?>" >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select id="inputStatus" class="form-control" name="status" value="<?=$fetch_category['nama']?>"  >
                                    <option >Active</option>
                                    <option >Inactive</option>
                                    <option >Tutup</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="starttggl">Mulai:</label>
                                <input type="date" class="form-control" name="start_tggl" value="<?= $fetch_category['start_tggl']?>"  >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="endtggl">Akhir:</label>
                                <input type="date" class="form-control" name="end_tggl" value="<?= $fetch_category['end_tggl']?>"  >
                                </div>  
                            </div>
                            <div class="form-group">
                                <label for="detail">Detail</label>
                                <input   name="detail" type="text" class="form-control" id="detail" value="<?=$fetch_category['details']?>" >
                            </div>
                            <div class="form-group">
                                <label for="nama_jabatan">Nama Jabatan</label>
                                <input   name="nama_jabatan" type="text" class="form-control" id="nama_jabatan" value="<?=$fetch_category['nama_jabatan']?>" >
                            </div>
                            
                            <input type="submit" class="btn btn-primary" value="Ubah" name="update_category">
                            <input type="submit" class="btn btn-secondary" value="Batal" name="cancel_category">

                            </form>
                        </div>
                    </div>

    </div>
        


    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include '../admin_component/php/footer.php' ;?>


</div>
<!-- End of Content Wrapper -->

</div>
<?php include '../admin_component/php/default.php' ;?>


        
</body>




</html>