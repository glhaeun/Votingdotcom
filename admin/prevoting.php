<!DOCTYPE html>
<html lang="en">

<head>
<?php require_once("../admin_component/php/check.php");?>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Hasil Prediksi</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../admin_component/css/adminboots.css" rel="stylesheet">
    <link href="../admin_component/css/custom/prevote.css" rel="stylesheet">


</head>
<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php include '../admin_component/php/logout.php';
include '../admin_component/php/naivebayes.php';

?>

 
<body id="page-top">
<?php include '../admin_component/php/script.php';?>

    <!-- Page Wrapper -->
    <div id="wrapper">
    <?php include '../admin_component/php/sidenav.php';    ?>

<div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">

<?php include '../admin_component/php/topbar.php';?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
    <?php flash_alert('Message') ?>
    
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Hasil Prediksi dari Survei</h1>
        </div>

        <!-- Content Row -->
        <div class="row category-row">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h5 class="h5 mb-0 text-gray-800">Unggah Survei - File CSV</h5>
                        <form action="" method="post" enctype="multipart/form-data" id="import-form">
        <input type="file" class="form-control" id="csvfile" name="csvfile" placeholder="Select CSV file" />
        <input type="submit" value="Unduh" class="btn btn-primary" id="importcsv" name="import">
        </div>
        </div>
        <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h5 class="h5 mb-0 text-gray-800">Nama Survei</h5>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">
                                <a href="addcandidate.php"><input type="button" value="Add Candidate"></a>
                            </h6> -->
                            <form action="" method="post">
                            <select id="prevote" class="form-control" name="prevote" onchange="this.form.submit()">
                                    <option value="" selected>--</option>
                                    <?php 
                                            $query ="SELECT table_name FROM prevoting";
                                            $show_category = $connect->prepare($query);
                                            $show_category -> execute();
                                            if ($show_category->rowCount()>0) {
                                                while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
                                                    $fetch_category = implode($fetch_category);
                                                ?>
                                                <option <?php if (isset($tableName) && $tableName == "$fetch_category") echo "selected" ?> value="<?=$fetch_category?>"><?=$fetch_category?></option>
                                                <?php
                                            } 
                                            } 
                                        ?>
                            </select>
                            </form>
                        </div>
                        </div>

                    <div class="col-xl col-lg">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Prediksi Survei</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body" style='display:flex; align-items: center; flex-flow: column;'>
                                    <div class="chart-pie pt-4 pb-2 chart-box" style='width: 40%; display: flex; justify-content: center' id="printable">
                                        <canvas style="height:300px; width:300px;" id="pieChart"></canvas>
                                    </div>
                                    <?php
                                        if(isset($_POST['prevote']) && $_POST['prevote']!=""){
                                            $maxs = array_keys($hasil, max($hasil));
                                            ?>
                                            <div id="tableDiv">
                                                <table>
                                            <thead>
                                            <tr>
                                                <td>Candidate</td>
                                                <td>Probabilitas</td>
                                            </tr>
                                            </thead>
                                        <tbody>
                                            <?php
                                            foreach($hasil as $key => $value){

                                            ?>
                                                <tr>
                                                    <td><?=$key?></td>
                                                    <td><?=$value?></td>
                                                </tr>
                                            <?php
                                        
                                            }
                                            ?>
                                            <tr>
                                                <td>Akan Menang</td>
                                                <td>Candidate <?=implode($maxs)?></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            
                                        </tbody>
                                        </table>

                                    </div>
                                        <?php }
                                    ?>
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

        <script>

            $(document).ready(function(){

                jQuery('#importcsv').on("click", function(e) {
                    var formdata = new FormData();
                    var files = $('#csvfile')[0].files;
                    formdata.append('file',files[0]);

                    $.ajax({
                        url: importcsv.php,
                        type: 'POST',
                        data: formdata,
                        contentType:false,
                        processData: false,
                        success:function(response){
                            if(response !=0) {
                                $('#file').val("");
                            } else {
                               console.log("ERROR");                            }
                        }
                    });
                });
            });
        </script>

        <script src="../admin_component/script_admin.php"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>

            //Setup
            
            //options block
       

            //config block
          
            //render block

            var all = <?php echo json_encode($hasil)?>;
            var labels = <?php echo json_encode($candidate)?>;
        

            
            var ctx = document.getElementById('pieChart').getContext('2d');
            var myChart = new Chart (ctx,{
                type: 'pie',
                data: {
                labels,
                datasets: [{
                    label: 'Probabilitas',
                    data: <?php echo json_encode($prob)?>,
                    backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4
                }]
                }
        }
            );

  
        </script>

<?php include '../admin_component/php/default.php'; ?>
</body>




</html>
