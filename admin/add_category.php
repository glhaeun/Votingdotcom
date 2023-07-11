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
<?php include '../admin_component/php/check.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php $counter=1; ?>


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
    <?php flash_alert('Message')?>

        <!-- Page Heading -->

        <!-- Content Row -->
        
        <div class="row justify-content-center">

        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h1 class="h3 mb-0 text-gray-800 ">Tambah Kategori</h1>
                        </div>
                        <div class="card-body">
                        <form action="" method="post">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="votetitle">Judul Pemungutan Suara:</label>
                                <input type="text" class="form-control" name="votetitle" required>
                                </div>
                                <div class="form-group col-md-6">
                                <label for="status">Status</label>
                                <select id="inputStatus" class="form-control" name="status" required>
                                    <option selected>Aktif</option>
                                    <option disabled>Tidak Aktif</option>
                                    <option disabled>Tutup</option>
                                </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="starttggl">Mulai:</label>
                                <input type="date" class="form-control" name="start_tggl" required >
                                </div>
                                <div class="form-group col-md-6">
                                <label for="endtggl">Berakhir:</label>
                                <input type="date" class="form-control" name="end_tggl" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="detail">Detail</label>
                                <input   name="detail" type="text" class="form-control" id="detail" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="jabatan">Nama Jabatan</label>
                                <input   name="jabatan" type="text" class="form-control" id="detail" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label for="candidate">Kandidat</label> 
                                <button type="button" class="btn btn-success btn-sm" onclick="addEntry();"><span class="glyphicon glyphicon-plus">Tambah Kandidat</span></button>
				                <div id="candidate">
                
                                    <div class="form-group">
                                    <select id="" class="form-control select" name="candidate[]"  required>
                                        <?php 
                                            $query ="SELECT nama_calon, nama_wakil FROM candidate WHERE voting_name =''";
                                            $show_candidate = $connect->prepare($query);
                                            $show_candidate -> execute();
                                            if ($show_candidate->rowCount()>0) {
                                                while($fetch_candidate = $show_candidate->fetch(PDO::FETCH_ASSOC)){
                                                ?>
                                                <option value="<?=$fetch_candidate['nama_calon']?>"><?=$fetch_candidate['nama_calon']?>(Calon) - <?=$fetch_candidate['nama_wakil']?>(Wakil)</option>
                                                <?php
                            
                                            } }
                                        ?>
                                    </select>
                                    <a style="cursor:pointer;"><i class='fa-solid fa-circle-xmark' style="color:red"></i></a>
                                    </div>
                                    <!-- <select name="candidate" id="type" onchange="" class="form-">
                                        
                                    </select> -->
                                    </div>
                            </div>
                            <input type="submit" class="btn btn-primary" value="Tambah" name="submit_category">
                            </form>
                        </div>
                    </div>

    </div>
        


    </div>
    <!-- /.container-fluid -->


</div>
<!-- End of Main Content -->

<?php include '../admin_component/php/footer.php' ?>

</div>
<!-- End of Content Wrapper -->

</div>
        <script>
var counter = 1;
function addEntry() {
    <?php
    $query = "SELECT COUNT(*) AS count FROM candidate WHERE voting_name = ''";
    $show_candidate = $connect->prepare($query);
    $show_candidate->execute();
    $rowCount = $show_candidate->fetchColumn();

    echo "var rowCount = $rowCount;";
    ?>

    if (counter < rowCount) {
        var entry = `
            <div class="select-group">
                <select id="" class="form-control select" name="candidate[]" onclick='checkID(this)'>
                    <?php
                    $query = "SELECT nama_calon, nama_wakil FROM candidate WHERE voting_name = ''";
                    $show_candidate = $connect->prepare($query);
                    $show_candidate->execute();
                    if ($show_candidate->rowCount() > 0) {
                        while ($fetch_candidate = $show_candidate->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                            <option value="<?= $fetch_candidate['nama_calon'] ?>">
                                <?= $fetch_candidate['nama_calon'] ?>(Calon) - <?= $fetch_candidate['nama_wakil'] ?>(Wakil)
                            </option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <span style='cursor:pointer;'>
                    <i onclick='deleteCandidate(this)' class='fa-solid fa-circle-xmark btn-delete' style='color:red;'></i>
                </span>
            </div>`;

        var element = document.createElement("div");
        element.innerHTML = entry;
        document.getElementById('candidate').appendChild(element);
        counter++;
    } else {
        alert("Jumlah kandidat tidak cukup untuk menambah entry.");
    }
}

            const list = document.getElementById("candidate");

                function deleteCandidate(element) {
                if (list.childElementCount > 1) {
                    $(element).parents(".select-group").remove();
                } 
            
            }


            
        </script>
<?php include '../admin_component/php/default.php' ?>

</body>

</html>