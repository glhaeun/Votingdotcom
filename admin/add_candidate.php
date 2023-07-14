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

        <!-- Content Row -->
        
        <div class="row justify-content-center">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Tambah Kandidat</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="fotocalon">Foto Calon:</label>
                                <input type="file" name="fotocalon" class="" accept="image/jpg image/jpeg, image/png , image/webp" required >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="namacalon">Nama Calon</label>
                                <input   name="namacalon" type="text" class="form-control" id="detail" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="fotowakil">Foto Wakil:</label>
                                <input type="file" name="fotowakil" class="" accept="image/jpg image/jpeg, image/png , image/webp"  required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="namawakil">Nama Wakil</label>
                                <input   name="namawakil" type="text" class="form-control" id="detail" placeholder="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="visi">Visi</label>
                                <textarea name="visi" id="visi" cols="10" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="misi">Misi</label>
                                <textarea name="misi" id="misi" cols="10" rows="8"></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="votingtipe">Ikut pemilihan:</label>
                                <select id="votingtipe" class="form-control" name="votingtipe">
                                    <option selected></option>
                                    <?php 
                                            $query ="SELECT nama FROM category";
                                            $show_category = $connect->prepare($query);
                                            $show_category -> execute();
                                            if ($show_category->rowCount()>0) {
                                                while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
                                                    $fetch_category = implode($fetch_category);
                                                ?>
                                                <option value="<?=$fetch_category?>"><?=$fetch_category?></option>
                                                <?php
                                            } 
                                            } 
                                        ?>
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="parpol">Partai Politik:</label>
                                <select name="parpol" id=""  class="form-control">
                                        <?php 
                                            $query ="SELECT nama FROM partai";
                                            $show_partai = $connect->prepare($query);
                                            $show_partai -> execute();
                                            if ($show_partai->rowCount()>0) {
                                                while($fetch_partai = $show_partai->fetch(PDO::FETCH_ASSOC)){
                                                    $fetch_partai = implode($fetch_partai);
                                                ?><option value="<?=$fetch_partai?>"><?=$fetch_partai?></option>
                                                <?php
                                            } 
                                            } 
                                            ?>
                                </select>
                                </div>
                                
                            </div>
                            <input type="submit" class="btn btn-primary" value="Tambah" name="submit">
                            </form>
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