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
    <link href="../admin_component/css/custom/update_candidate.css" rel="stylesheet">



    <style>

    </style>

</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php include '../admin_component/php/logout.php' ?>

<?php
$update = $_GET['update_candidate'];
$query = "SELECT * FROM candidate WHERE id = '$update'";
$show_candidate = $connect->prepare($query);
$show_candidate -> execute([]);
$fetch_candidate = $show_candidate->fetch(PDO::FETCH_ASSOC);

?>

<body id="page-top">
<?php include '../admin_component/php/script.php';?>


    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php 
    include '../admin_component/php/sidenav.php';
    ?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<?php include '../admin_component/php/topbar.php';?>

    <!-- Begin Page Content -->
    <div class="container-fluid w-75">
        <!-- Page Heading -->
        <?php flash_alert('Message')?>

        <!-- Content Row -->
        
        <div class="row justify-content-center ">
            
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Mengubah Data Kandidat</h1>
                        </div>

                        <div class="card-body">

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-6 foto">
                                <label for="fotocalon">Foto Calon:</label>
                                <input type="file" name="fotocalon" id="foto_calon" accept="image/jpg image/jpeg, image/png , image/webp">
                                </div>
                                <div class="form-group col-md-6">
                                <label for="namacalon">Nama Calon</label>
                                <input   name="namacalon" type="text" class="form-control" id="detail" value="<?=$fetch_candidate['nama_calon']?>" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6 foto">
                                <label for="fotowakil">Foto Wakil:</label>
                                <input type="file" name="fotowakil" id="foto_wakil" accept="image/jpg image/jpeg, image/png , image/webp" >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="namawakil">Nama Wakil</label>
                                <input   name="namawakil" type="text" class="form-control" id="detail" value="<?=$fetch_candidate['nama_wakil']?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="visi">Visi</label>
                                <textarea name="visi" id="visi" cols="10" rows="3"><?=$fetch_candidate['visi']?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="misi">Misi</label>
                                <?php 
                                    $misi = str_replace("<br>", "\n", $fetch_candidate['misi']);
                                ?>
                                <textarea name="misi" id="misi" cols="10" rows="8"><?=$misi?></textarea>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="votingtipe">Ikut Voting:</label>
                                <select id="votingtipe" class="form-control" name="votingtipe" required>
                                    <option value="tidakikut">Tidak Ikut</option>
                                    <?php 
                                            $query ="SELECT nama FROM category";
                                            $show_category = $connect->prepare($query);
                                            $show_category -> execute();
                                            if ($show_category->rowCount()>0) {
                                                while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
                                                    $fetch_category = implode($fetch_category);
                                                ?>
                                                <option <?php if(trim($fetch_category) == trim($fetch_candidate['voting_name'])) echo "selected" ?>value="<?=$fetch_category?>"><?=$fetch_category?></option>
                                                <?php
                                            } 
                                            } 
                                        ?>
                                </select>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="parpol">Partai Politik:</label>
                                <select name="parpol" id=""  class="form-control">
                                    <option  <?php if("Mango" == trim($fetch_candidate['partai'])) echo "selected" ?> value="Mango">Apel</option>
                                    <option  <?php if("Kiwi" == trim($fetch_candidate['partai'])) echo "selected" ?> value="Kiwi">Kiwi</option>
                                    <option  <?php if("Jeruk" == trim($fetch_candidate['partai'])) echo "selected" ?> value="Jeruk">Jeruk</option>
                                    <option  <?php if("Durian" == trim($fetch_candidate['partai'])) echo "selected" ?> value="Durian">Durian</option>
                                    <option  <?php if("Nanas" == trim($fetch_candidate['partai'])) echo "selected" ?> value="Nanas">Nanas</option>
                                </select>
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Ubah" name="submit_candidate">
                            <input type="submit" class="btn btn-secondary" value="Batal" name="cancel_candidate">
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

<?php 
    include '../admin_component/php/default.php';
?>

        
</body>



</html>