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
    <link href="../admin_component/css/custom/style.css" rel="stylesheet">


</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php include '../admin_component/php/logout.php' ?>

<body id="page-top">
<?php  include '../admin_component/php/script.php'; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php  include '../admin_component/php/sidenav.php'; ?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<?php  include '../admin_component/php/topbar.php'; ?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php  flash_alert('Message'); ?>


        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Daftar Kategori</h1>
        </div>

        <!-- Content Row -->
        <div class="row justify-content-center">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <a href="add_category.php"><input type="button" value="Tambah Kategori" class="btn btn-primary"></a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kategori</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Berakhir</th>
                                            <th># Kandidat</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


<?php 

    $query ="SELECT * FROM category";
    $select_category =  $connect->prepare($query);
    $select_category -> execute();

    if($select_category->rowCount()>0){
        while ($fetch_category = $select_category ->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <tr>
                            <td><?=$fetch_category['category_id']?></td>
                            <td><?=$fetch_category['nama']?></td>
                            <td><?=$fetch_category['details']?></td>
                            <td><?=$fetch_category['start_tggl']?></td>
                            <td><?=$fetch_category['end_tggl']?></td>
                            <td><?=$fetch_category['jml_calon']?></td>
                            <td><?=$fetch_category['status']?></td>
                            <td><div class="action"><a href="update_category.php?update_category=<?=$fetch_category['category_id']?>"><i class="fa-solid fa-pen-to-square"></i></a><a href="category.php?delete_category=<?=$fetch_category['category_id']?>" class="" onclick="return confirm('Are you sure to delete this category?');"><i class="fa-solid fa-trash"></i></a>
                            <a href="detail_category.php?detail_category=<?=$fetch_category['category_id']?>" class=""><i class="fa-solid fa-magnifying-glass"></i></a></div></td>


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
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php  include '../admin_component/php/footer.php'; ?>

</div>
<!-- End of Content Wrapper -->

</div>
<?php  include '../admin_component/php/default.php'; ?>
</body>
</html>