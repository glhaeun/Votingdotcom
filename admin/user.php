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
include '../admin_component/php/sendemail.php';
if(isset($_GET['type_of_users'])) {
    $status = $_GET['type_of_users'];
} else {
    $status = "All";
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
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Daftar Pengguna</h1>
        </div>

        <!-- Tabs navs -->
        <div id="container">
        <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
        <li class="nav-item active" role="presentation">
            <a
            class="nav-link <?php if ($status=="All") {echo "active";}?>"
            id="ex1-tab-1"
            data-mdb-toggle="tab"
            href="user.php?type_of_users=All"
            role="tab"
            aria-controls="ex1-tabs-1"
            aria-selected="true"
            >SEMUA PENGGUNA</a
            >
        </li>
        <li class="nav-item" role="presentation">
            <a
            class="nav-link <?php if ($status=="verified") {echo "active";}?>"
            id="ex1-tab-2"
            data-mdb-toggle="tab"
            href="user.php?type_of_users=verified"
            role="tab"
            aria-controls="ex1-tabs-2"
            aria-selected="false"
            >SUDAH VERIFIKASI</a
            >
        </li>
        <li class="nav-item" role="presentation">
            <a
            class="nav-link <?php if ($status=="pending") {echo "active";}?>"
            id="ex1-tab-3"
            data-mdb-toggle="tab"
            href="user.php?type_of_users=pending"
            role="tab"
            aria-controls="ex1-tabs-3"
            aria-selected="false"
            >BELUM VERIFIKASI</a
            >
        </li>
        </ul>
        </div>
        
        <!-- Tabs navs -->

        <!-- Content Row -->
        <div class="row justify-content-center">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Nomor</th>
                                            <th>Email</th>
                                            <th>NIK</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>


<?php 

    if($status == "All") {
        $query ="SELECT * FROM users";
        $select_users =  $connect->prepare($query);
        $select_users -> execute();
    } else if ($status != "All") {
        $query ="SELECT * FROM users WHERE status = '$status'";
        $select_users =  $connect->prepare($query);
        $select_users -> execute();
    }
    

    if($select_users->rowCount()>0){
        while ($fetch_users = $select_users ->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <tr>
                            <td><?=$fetch_users['user_id']?></td>
                            <td><?=$fetch_users['nama']?></td>
                            <td><?=$fetch_users['nomor']?></td>
                            <td><?=$fetch_users['email']?></td>
                            <td><?=$fetch_users['NIK']?></td>
                            <td class><?=$fetch_users['status']?> 
                            <?php if($fetch_users['status'] != "verified"){?>
                                <div class ="action">
                                <a href="user.php?update_status=verified&uid=<?=$fetch_users['user_id']?>" class=""><i class="fa-solid fa-circle-check"></i></a><a href="user.php?update_status=rejected&uid=<?=$fetch_users['user_id']?>" class="" onclick="return confirm('Are you sure to reject this user?');"><i class="fa-solid fa-circle-xmark"></i></a>
                                </div>
                            <?php } ?>
                        </td>
                            <td><div class="action">
                                <a href="detail_user.php?detail_user=<?=$fetch_users['user_id']?>" class=""><i class="fa-solid fa-magnifying-glass"></i></a><a href="user.php?delete=<?=$fetch_users['user_id']?>" class="" onclick="return confirm('Are you sure to delete this user?');"><i class="fa-solid fa-trash"></i></a>
                            </div></td>


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

<?php include '../admin_component/php/footer.php' ?>
hp';?>

</div>
<!-- End of Content Wrapper -->

</div>

<?php include '../admin_component/php/default.php' ?>


        
</body>




</html>