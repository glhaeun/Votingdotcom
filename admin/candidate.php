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
    <!-- <link href="../admin_component/css/style.css" rel="stylesheet"> -->

    <link href="../admin_component/css/adminboots.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin_component/css/custom/add_candidate.css">

</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/check.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>


<body id="page-top">
<?php include '../admin_component/php/script.php';?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php';?>


<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">
<?php include '../admin_component/php/topbar.php';?>


    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php flash_alert('Message')?>



        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Daftar Kandidat</h1>
        </div>
        <!-- Content Row -->
        
        <div class="row justify-content-center">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <a href="add_candidate.php"><input type="button" value="Tambah Kandidat" class="btn btn-primary"></a>
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Foto</th>
                                            <th>Nama</th>
                                            <th>Foto Wakil</th>
                                            <th>Nama Wakil</th>
                                            <th>Visi</th>
                                            <th>Misi</th>
                                            <th>Nama Kategori</th>
                                            <th>Partai</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


<?php 

    $query ="SELECT * FROM candidate";
    $select_candidate =  $connect->prepare($query);
    $select_candidate -> execute();

    if($select_candidate->rowCount()>0){
        while ($fetch_candidate = $select_candidate ->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <tr>
                            <td><?=$fetch_candidate['id']?></td>
                            <td><img src="../img/candidate/<?=$fetch_candidate['foto_calon']?>" alt=""></td>
                            <td><?=$fetch_candidate['nama_calon']?></td>
                            <td><img src="../img/candidate/<?=$fetch_candidate['foto_wakil']?>" alt=""></td>
                            <td><?=$fetch_candidate['nama_wakil']?></td>
                            <td><?=$fetch_candidate['visi']?></td>                           
                            <td class="truncate"><?=$fetch_candidate['misi'];?></td>
                            <td><?=$fetch_candidate['voting_name']?></td>
                            <td><?=$fetch_candidate['partai']?></td>
                            <td class="action"><a href="update_candidate.php?update_candidate=<?=$fetch_candidate['id']?>"><i class="fa-solid fa-pen-to-square"></i></a><a href="candidate.php?delete_candidate=<?=$fetch_candidate['id']?>" class="" onclick="return confirm('Are you sure to delete this candidate?');"><i class="fa-solid fa-trash"></i></a></td>


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
<?php include '../admin_component/php/default.php';?>

</body>
</html>

<style>
    td img{
        max-width: 100px;
        max-height: 100px;
    }
</style>