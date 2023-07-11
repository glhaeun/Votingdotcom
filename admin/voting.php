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
    <link rel="stylesheet" href="../admin_component/css/custom/voting.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.min.js" integrity="sha512-qZvrmS2ekKPF2mSznTQsxqPgnpkI4DNTlrdUmTzrDgektczlKNRRhy5X5AAOnx5S09ydFYWWNSfcEqDTTHgtNA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="	https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" ></script>
</head>

<?php include '../admin_component/php/connect.php';?>
<?php include '../admin_component/php/flash_alert.php' ?>
<?php 
include '../admin_component/php/sendemail.php';



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


    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <!-- <div class="d-sm-flex align-items-center justify-content-between mb-4" style="display: grid;">
            <h1 class="h3 mb-0 text-gray-800">Voting Results</h1>
        </div> -->

        <!-- Content Row -->
        <div class="category-row">
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h5 class="h5 mb-0 text-gray-800">Nama Pemilihan</h5>
                            <!-- <h6 class="m-0 font-weight-bold text-primary">
                                <a href="addcandidate.php"><input type="button" value="Add Candidate"></a>
                            </h6> -->
                            <form action="" method="get">

                            <select id="daftarvote" class="form-control" name="daftarvote" onchange="this.form.submit()" required>
                                    <option value="--" selected>--</option>
                                    <?php 
                                            $query ="SELECT nama FROM category WHERE status = 'Active'";
                                            $show_category = $connect->prepare($query);
                                    
                                            $show_category -> execute();
                                            echo $show_category->rowCount();
                                            if ($show_category->rowCount()>0) {
                                                while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
                                                    $fetch_category = implode($fetch_category);
                                                ?>
                                                <option <?php if (isset($category_name) && $category_name == "$fetch_category") echo "selected" ?> value="<?=$fetch_category?>"><?=$fetch_category?></option>
                                                <?php
                                            } 
                                            } 
                                        ?>
                            </select>
                            </form>
                        </div>
                    </div>

                    <?php
                       
                       if($category_name != '--') {
                        $query = "SELECT * FROM votes WHERE category_name = '$category_name'";
                        $totalvotes = $connect->prepare($query);
                        $totalvotes -> execute();
                        $number_of_votes = $totalvotes -> rowCount();

                        $number_of_votes_per_candidate = array();
                        for($i=0; $i<sizeof($calon);$i++) {
                            $calon_name = $calon[$i];
                            $query = "SELECT * FROM votes WHERE choose = '$calon_name'";
                            $countingvotes = $connect->prepare($query);
                            $countingvotes -> execute([]);
                            if ($countingvotes -> rowCount()>0) {
                                $number_of_votes_per_candidate[] = $countingvotes -> rowCount();
                            } else {
                            $number_of_votes_per_candidate[] = 0;
                            }

                            // echo $calon[$i];
                            // echo $number_of_votes_per_candidate[$i]."<br>";
                            

                        }

                       } 

                        


                    ?>

                    <div class="col-xl col-lg">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Pie Chart</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Action:</div>
                                            <a class="dropdown-item" id="details">Data Perinci</a>

                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" id="png">Menunduh PNG</a>
                                            <a class="dropdown-item" id="jpeg">Menunduh JPG</a>
                                            <a class="dropdown-item" id="pdf">Menunduh PDF</a>

                                        </div>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body chart-pie-container">
                                    <div class="chart-pie pt-4 pb-2 chart-box" id="printable">
                                        <canvas id="pieChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl col-lg container-fluid">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Tabel Hasil Pemilihan</h6>
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
                                <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>NIK</th>
                                            <th>Nama</th>
                                            <th>Pilih</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    

<?php 

    $query ="SELECT * FROM votes WHERE category_name='$category_name'";
    $get_votes =  $connect->prepare($query);
    $get_votes -> execute();

    $counter = 1;
    if($get_votes->rowCount()>0){
        while ($fetch_votes = $get_votes ->fetch(PDO::FETCH_ASSOC)){
            ?>
                        <tr>
                            <td><?=$counter?></td>
                            <td><?=$fetch_votes['NIK']?></td>
                            <td><?=$fetch_votes['user_nama']?></td>
                            <td><?=$fetch_votes['choose']?></td>
                            <td><?=$fetch_votes['voting_time']?></td>                            

                    </tr>
            
            <?php
            $counter++;
        } ?>
        
    <?php
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
    <script>
        
var png = document.getElementById('png');
var jpeg = document.getElementById('jpeg');
var pdf = document.getElementById('pdf');

png.addEventListener("click", function(){ 

const imageLink =document.getElementById('png');
const canvas =document.getElementById('pieChart');
imageLink.download = 'canvas.png';
imageLink.href = canvas.toDataURL('image/png', 1);
imageLink.click();
});

jpeg.addEventListener("click", function(){ 

const imageLink =document.getElementById('jpeg');
const canvas =document.getElementById('pieChart');
imageLink.download = 'canvas.jpeg';
imageLink.href = canvas.toDataURL('image/jpeg', 1);
imageLink.click();
});

pdf.addEventListener("click", function(){ 

const canvas =document.getElementById('pieChart');
canvasImage = canvas.toDataURL('image/jpg', 1);

console.log(canvasImage);
let pdf = new jsPDF('landscape');
pdf.setFontSize(10);
pdf.addImage(canvasImage, 'JPEG', 15, 15, 280, 150);
pdf.save('chart.pdf');
imageLink.click();
});
</script>

<script src="../admin_component/script_admin.php"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
<script>
    //Setup
    var labels = <?php echo json_encode($calon)?>
    
    //options block


    //config block
  
    //render block
    var ctx = document.getElementById('pieChart').getContext('2d');
    var myChart = new Chart (ctx,{
        type: 'pie',
        data: {
        labels,
        datasets: [{
            label: 'Vote Count',
            data: <?php echo json_encode($number_of_votes_per_candidate)?>,
            backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
            ],
            hoverOffset: 4
        }],
        options: {
            responsive: true,
            legend: {
                position: "bottom",
            },
            tooltips: {
                callbacks: {
                    label: function (tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                        var total = dataset.data.reduce(function (
                            previousValue,
                            currentValue
                        ) {
                            return previousValue + currentValue;
                        });
                        var currentValue = dataset.data[tooltipItem.index];
                        var percentage = ((currentValue / total) * 100).toFixed(2);
                        return percentage + "%";
                    },
                },
            },
        },
        }
}
    );


    var details = document.getElementById('details');

details.addEventListener("click", function(){
    const chartBox =document.querySelector('.card-body');
    const tableDiv =document.createElement('DIV');
    tableDiv.setAttribute('id', 'tableDiv');

    const table = document.createElement('TABLE');
    table.classList.add('chartjs-table');

    const thead = table.createTHead();
    thead.classList.add('chartjs-thead');
    thead.insertRow(0);
    thead.rows[0].insertCell(0).innerText = 'Category';
    thead.rows[0].insertCell(1).innerText = 'Jumlah Vote';

    const tbody = table.createTBody();
    tbody.classList.add('chartjs-tbody');

    var data = <?php echo json_encode($number_of_votes_per_candidate)?>
    
    var calon = <?php echo json_encode($calon)?>

    for(let i = 0; i< data.length; i++) {
        tbody.insertRow(i);
        tbody.rows[i].insertCell(0).innerText = calon[i];
        tbody.rows[i].insertCell(1).innerText = data[i];
    };

    chartBox.appendChild(tableDiv);
    tableDiv.appendChild(table);

});



    </script>

</div>
<?php include '../admin_component/php/default.php';?>
</body>




</html>