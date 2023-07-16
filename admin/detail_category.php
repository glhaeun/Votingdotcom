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
    <link href="../admin_component/css/detail.css" rel="stylesheet">
    <!-- <link href="../admin_component/css/custom/style.css" rel="stylesheet"> -->


</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/check.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php
$detail = $_GET['detail_category'];
$query="SELECT * FROM category WHERE category_id = ?";
$get_candidate = $connect->prepare($query);
$get_candidate -> execute([$detail]);
$row=$get_candidate->fetch(PDO::FETCH_ASSOC);

$nama_category = $row['nama'];
$jumlah_calon = $row['jml_calon'];
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
    <?php flash_alert('Message') ;?>

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Daftar Kategori</h1>
        </div>


                    <div class="container mt-3 mb-4">
    <div class="row">
      <div class="col-md-12">
      <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">
                            <?=$nama_category?></h6>
                        </div>
        <div class="user-dashboard-info-box table-responsive mb-0 bg-white p-4 shadow-sm">
          <table class="table manage-candidates-top mb-0">
            <thead>
              <tr>
                <th>Calon</th>
                <th class="text-center">Partai</th>
                <th class=" text-right">Aksi</th>
              </tr>
            </thead>
            <tbody>

            <?php 
             $query ="SELECT * FROM candidate WHERE voting_name ='$nama_category'";
             $select_candidate =  $connect->prepare($query);
             $select_candidate -> execute();
             if($select_candidate->rowCount()>0){
                while ($fetch_candidate = $select_candidate ->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr class="candidates-list">
                <td class="title">
                  <div class="thumb">
                    <img class="img-fluid" src="../img/candidate/<?=$fetch_candidate['foto_calon']?>" alt="">
                  </div>
                  <div class="candidate-list-details">
                    <div class="candidate-list-info">
                      <div class="candidate-list-title">
                        <h5 class="mb-0"><a href="#"><?=$fetch_candidate['nama_calon']?></a></h5>
                      </div>
                      <div class="candidate-list-option">
                        <ul class="list-unstyled">
                          <li>Calon <?=$fetch_candidate['nama_jabatan']?></li>
                          <li><i class="fas fa-map-marker-alt pr-1"></i>Partai <?=$fetch_candidate['partai']?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                  <div class="thumb">
                    <img class="img-fluid" src="../img/candidate/<?=$fetch_candidate['foto_wakil']?>" alt="">
                  </div>
                  <div class="candidate-list-details">
                    <div class="candidate-list-info">
                      <div class="candidate-list-title">
                        <h5 class="mb-0"><a href="#"><?=$fetch_candidate['nama_wakil']?></a></h5>
                      </div>
                      <div class="candidate-list-option">
                        <ul class="list-unstyled">
                          <li>Wakil <?=$fetch_candidate['nama_jabatan']?></li>
                          <li><i class="fas fa-map-marker-alt pr-1"></i>Partai <?=$fetch_candidate['partai']?></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </td>
                <td class="title">
                  <a class="candidate-list-favourite order-2 text-danger" href="#"></a>
                  <span class="candidate-list-time order-1">Visi:<br><?=$fetch_candidate['visi']?><br>Misi:<br><?=$fetch_candidate['misi']?></span>
                </td>
                <td>
                <i class="fas fa-map-marker-alt pr-1"></i><?=$fetch_candidate['partai']?></li>
                </td>
                <td>
                  <ul class="list-unstyled mb-0 d-flex justify-content-end">
                    <li><a href="update_candidate.php?update_candidate=<?=$fetch_candidate['id']?>" class="text-info" data-toggle="tooltip" title="" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a></li>
                    <li><a href="detail_category.php?detail_category=<?=$detail?>&delete_detail=<?=$fetch_candidate['id']?>" class="text-danger" data-toggle="tooltip" title="" data-original-title="Delete"><i class="far fa-trash-alt"></i></a></li>
                  </ul>
                </td>
              </tr>
                    <?php
                }} else {
                    ?>
                    <p>Sedang Tidak Aktif</p>
                    <?php
                }?>
              
            </tbody>
          </table>
          <div class="text-center mt-3 mt-sm-3">
            <ul class="pagination justify-content-center mb-0">
              <li class="page-item disabled"> <span class="page-link">Previous</span> </li>
              <li class="page-item active" aria-current="page"><span class="page-link">1 </span> <span class="sr-only">(current)</span></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item"><a class="page-link" href="#">...</a></li>
              <li class="page-item"><a class="page-link" href="#">25</a></li>
              <li class="page-item"> <a class="page-link" href="#">Next</a> </li>
            </ul>
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



        <?php 
            include '../admin_component/php/default.php';
        ?>

        
</body>




</html>