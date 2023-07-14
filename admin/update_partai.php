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
<?php include '../admin_component/php/sendEmail.php';

$id = $_GET['update_partai'];
$query = "SELECT * FROM partai WHERE id = $id";
$show_user= $connect->prepare($query);
$show_user -> execute([]);
$fetch_partai = $show_user->fetch(PDO::FETCH_ASSOC);

?>

<?php
    if(isset($_POST['cancel_partai'])){
        header("location:partai.php");
    } else if (isset($_POST['update_partai'])){
        $nama_partai = $_POST['nama'];
        $pemimpin = $_POST['pemimpin'];
        $ideologi = $_POST['ideologi'];
        $id = $_GET['update_partai'];

        $query = "SELECT * FROM partai WHERE nama = ? AND id <> ?";
        $get = $connect->prepare($query);
        $get -> execute([$nama_partai,$_GET['update_partai']]);

        if($get->rowCount()>0){
            flash_alert('Message','Nama Partai Sudah Ada!', FLASH_DANGER);
        } else {
            $query = "SELECT * FROM partai WHERE id = :id";
            $show_user = $connect->prepare($query);
            $show_user->execute(['id' => $id]);
            $fetch_partai = $show_user->fetch(PDO::FETCH_ASSOC);

            $changes = 0;
            if ($nama_partai !== $fetch_partai['nama']) {
                $update_query = "UPDATE candidate SET partai = :nama_partai WHERE partai = :current_nama";
                $update_statement = $connect->prepare($update_query);
                $update_statement->execute([
                    'nama_partai' => $nama_partai,
                    'current_nama' => $fetch_partai['nama']
                ]);

                $update_query = "UPDATE partai SET nama = :nama_partai WHERE nama = :current_nama";
                $update_statement = $connect->prepare($update_query);
                $update_statement->execute([
                    'nama_partai' => $nama_partai,
                    'current_nama' => $fetch_partai['nama']
                ]);
                $changes++;
                }            

            if (!empty($ideologi)){
                $query = "UPDATE partai SET ideologi = ? WHERE id = ?";
                $updatedb = $connect->prepare($query);
                $updatedb->execute([$ideologi, $id]);
                $changes++;

            }

            if (!empty($pemimpin)){
                $query = "UPDATE partai SET pemimpin = ? WHERE id = ?";
                $updatedb = $connect->prepare($query);
                $updatedb->execute([$pemimpin, $id]);
                $changes++;
            }

            flash_alert('Message','Berhasil menggubah data partai', FLASH_SUCCESS);
        }

        header("location:partai.php");

    }

    
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
                        <h1 class="h3 mb-0 text-gray-800 ">Data </h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="nama">Nama</label>
                                <input  name="nama" type="text" class="form-control" id="nama" value="<?=$fetch_partai['nama']?>">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="pemimpin">Pemimpin</label>
                                <input   name="pemimpin" type="text" class="form-control" id="pemimpin" value="<?=$fetch_partai['pemimpin']?>">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12" style="display: grid;">
                                <label for="ideologi">Ideologi</label>
                                <input   name="ideologi" type="text" class="form-control" id="ideologi" value="<?=$fetch_partai['ideologi']?>">
                                </div>
                            </div>

                            <input type="submit" class="btn btn-danger" value="Ubah" name="update_partai">
                            <input type="submit" class="btn btn-secondary" value="Batal" name="cancel_partai">
        
                            
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