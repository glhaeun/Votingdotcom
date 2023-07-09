<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Voting.com</title>
    <?php require_once("../component/php/head.php"); ?>
    <link rel="stylesheet" href="../component/style/stylePrediction.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
</head>
<body>
    <?php 
    include "../component/php/connect.php";
    include "../component/php/navbar.php"; 
    include "../admin_component/php/naivebayes.php";
    include "../admin_component/php/script.php";
    
    if(isset($_POST['prevote'])){
        $tableName = $_POST['prevote'];
    
        if($tableName!=""){
            $kandidat = getCandidateNames($tableName);
            $hasil = posteriorProbability($tableName, $kandidat);
        
            $candidate = array();
            $prob = array();
        
            foreach($hasil as $key => $value){
        
                array_push($candidate, $key);
                array_push($prob, $value);
        
            }
        }
        
    }
    ?>


    <div class="section2" id="section2">
        <div class="container">
            <h2>Prediksi Voting</h2>
            <p class="subtitle">Lihat prediksi terbaru untuk pemilihan yang akan datang:</p>
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
            <div class="chart-container">
            <canvas id="predictionChart"></canvas>
            </div>
            <p class="caption">Sumber data: IMK Polling Agency</p>
        </div>
    </div>




    <?php require_once("../component/php/footer.php"); ?>
    
    <script> 
        console.log('ok');

        function gotoPrediction() {
            var elem = document.querySelector("#section2");
            window.scrollTo({
            top: elem.offsetTop,
            behavior: "smooth",
            });

        }


        // var all = <?php echo json_encode($hasil)?>;
        // var labels = <?php echo json_encode($candidate)?>;
        // var ctx = document.getElementById("predictionChart").getContext("2d");
        // var predictionChart = new Chart(ctx, {
        // type: "pie",
        // data: {
        //     labels: labelData,
        //     datasets: [
        //     {
        //         data: <?php echo json_encode($prob)?>,
        //         backgroundColor: ["#bb0c0c", "#f05a5a", "#9c0202", "#ffd700"],
        //         borderWidth: 3,
        //     },
        //     ],
            
        // },
        // options: {
        //     responsive: true,
        //     legend: {
        //     position: "bottom",
        //     },
        //     tooltips: {
        //          enabled: false
        //     },
        //     plugins: {
        //         datalabels: {
        //             formatter: (value, ctx) => {

        //             let sum = ctx.dataset._meta[0].total;
        //             let percentage = (value * 100 / sum).toFixed(2) + "%";
        //             return percentage;


        //             },
        //             color: '#fff',
        //         }
        //     }
        // },
        // });

        var all = <?php echo json_encode($hasil)?>;
        var labels = <?php echo json_encode($candidate)?>;
    

        
        var ctx = document.getElementById('predictionChart').getContext('2d');
        var myChart = new Chart (ctx,{
            type: 'pie',
            data: {
            labels,
            datasets: [{
                label: 'Probabilitas',
                data: <?php echo json_encode($prob)?>,
                backgroundColor: ["#bb0c0c", "#f05a5a", "#9c0202", "#ff1c8e"],
                hoverOffset: 4
            }]
            }
        }
        );

    </script>
</body>

</html>
