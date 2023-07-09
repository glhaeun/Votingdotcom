<!DOCTYPE html>
<html lang="en">
<head>
    <title>Welcome to Voting.com</title>
    <?php require_once("../component/php/head.php"); ?>
    <link rel="stylesheet" href="../component/style/styleLanding.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-element-bundle.min.js"></script>
</head>
<body>
    <?php 
    include "../component/php/connect.php";
    include "../component/php/navbar.php"; 

    function strCut($start, $end, $string) {
        $startPosition = strpos($string, $start);
        $endPosition = ($end == '0000') ? strlen($string) : strpos($string, $end);

        if ($startPosition !== false && $endPosition !== false) {
            $startPosition += strlen($start);
            return substr($string, $startPosition, $endPosition - $startPosition);
        } 
        return "Undefined";
    }

    ?>

    <div class="section1">
        <img class="backgroundSection1" src="../img/web/background.png">
        <div class="container1">
            <div class="subContainer1">
                <p class="tittleSection1">Vote for a<br>Better Indonesia</p>
                <p class="tittle2Section1">#noGolput</p>
            </div>
            <p class="text-center fs-1 subTittleSection1">Selamat datang di platform kami!</p>
            <div style="max-width: 500px; margin: 0 auto;">
                <div class="container text-center">
                    <form method="post">
                    <div class="row">                       
                        <div class="col">
                            <a id="voteBtn" class="btn fs-3 btn-1" href='vote.php'>Pilih</a>
                        </div>
                       
                        <div class="col">
                            <a class="btn fs-3 btn-2" href='prediction.php'>Prediksi</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
                           
        $calon = array();
        $wakil = array();
    
        if(!isset($_GET['daftarvote']) || $_GET['daftarvote'] == '--'){
            $category_name='--';
            $query ="SELECT nama FROM category WHERE status = 'Active'";
            $show_category = $connect->prepare($query);
            $show_category -> execute();
            if ($show_category->rowCount()>0) {
                if($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
                    $fetch_category = implode($fetch_category);
                    $category_name = $fetch_category;
                } 
            } 
        } else {
            $category_name = $_GET['daftarvote'];
        }
            
        $getting_candidate = $connect->prepare("SELECT nama_calon, nama_wakil FROM candidate WHERE voting_name = ?");
        $getting_candidate -> execute([$category_name]);
        $number_of_candidate = $getting_candidate -> rowCount();

        if ($getting_candidate->rowCount()) {
            while($fetch_category = $getting_candidate->fetch(PDO::FETCH_ASSOC)){
                $calon[] = $fetch_category['nama_calon'];
                $wakil[] = $fetch_category['nama_wakil'];
            }
        }
            
        
                                
    
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
            }

        } 
    ?>


    <div class="section2" id="section2">
        <div class="container">
            <h2>Hasil Voting</h2>
            <p class="subtitle">Lihat hasil voting terbaru:</p>
            <form action="" method="get">
            <select id="daftarvote" class="form-control" name="daftarvote" onchange='this.form.submit()' required>
                    <!-- <option value="--" selected>--</option> -->
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
                        else {
                            $noCategory = 1;
                            $calon = ['Tidak ada pemilihan'];
                            $number_of_votes_per_candidate = [1];
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

    
    <div class="sectionDivider">
        <div class="line"></div>
    </div>

    <div class="section1B">
        <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" loop="true" longSwipes='true'
        centered-slides="true" autoplay-delay="3500" autoplay-disable-on-interaction="true">
            <?php
                $query ="SELECT * FROM candidate WHERE voting_name='$category_name'";
                $rows =  $connect->prepare($query);
                $rows -> execute();
                if($rows->rowCount()>0){
                    while ($data = $rows ->fetch(PDO::FETCH_ASSOC)){?>
                        <swiper-slide>
                            <div class="swiper-container">
                            <div class='temp'>

                             <h2 class='nama'><?= $data['nama_calon'] ?> & <?= $data['nama_wakil'] ?></h2>
                             <h3 class='fs-3 partai'>Partai <?= $data['partai'] ?></h3>
                             <div class="containerFotoCalon">
                                <img class='img-fluid calon' src="../img/candidate/<?= $data['foto_calon'] ?>">
                                &nbsp &nbsp
                                <img class='img-fluid calon' src="../img/candidate/<?= $data['foto_wakil'] ?>">
                             </div>                        
                             
                            </div>
                            <div class='visiMisi'>
                                <?php
                                    $visi = $data['visi'];
                                    $misi = explode("<br>", $data['misi']);;
                                ?>
                                <h2 class='fs-3 visiTitle'>Visi:</h2>
                                <p class='fs-4 visiContent'><?= $visi ?></p>
                                <h2 class='fs-3 misiTitle'>Misi:</h2>
                                <ul class='fs-5 misiContent'>
                                    <?php
                                        foreach($misi as $data) {
                                            if($data != '') echo "<li>$data</li>";
                                        }
                                    ?>
                                </ul>
                            </div>  
                            </div>
                        </swiper-slide>
                <?php }
                } else {
                    ?>
                        <swiper-slide>
                            <h2 style='padding: 100px'><?php if(isset($noCategory)) echo "Sedang tidak ada pemilihan saat ini"; else echo "Kategori tidak memiliki kandidat"; ?></h2>
                        </swiper-slide>
                    <?php
                }
            ?>
            <div class="swiper-pagination"></div>
        </swiper-container>
    </div>


    <div class="subSection1">
        <div class="col subSectionItem">
            <img class="backgroundSection1" src="../img/web/background.png">
            <h2>Belum punya akun?</h2>
            <p class="fs-6">Daftarkan akunmu sekarang! Cukup menggunakan KTP dan Email</p>
            <a href="tutorial.php" class="btn btn-1">Tutorial</a>
        </div>
        <div class="col subSectionItem">
            <img class="backgroundSection1" src="../img/web/background.png">
            <h2>Cara memilih?</h2>
            <p class="fs-6">Lihat langkah-langkah yang harus dilakukan untuk melakukan pemilihan melalui website ini.</p>
            <a href="register.php" class="btn btn-1">Buat Akun</a>
        </div>
        <div class="col subSectionItem subSectionItem2">
            <img class="backgroundSection1" src="../img/web/background.png">
            <h2>Pilih sekarang?</h2>
            <p class="fs-6">Jangan lupa untuk memilih kandidat yang terbaik bagi Indonesia!</p>
            <a href="vote.php" class="btn btn-1">Vote</a>
        </div>
    </div>

    <div class="section3">
        <div class="container">
            <h2>Kenapa harus memilih?</h2>
            <div class="reasons">
            <div class="reason">
                <div class="divContainer">
                    <img src="../img/web/reason1.png" alt="Reason 1">
                </div>
                
                <div class="reason-content">
                <h3 class="fs-2">Gunakan Hak Anda</h3>
                <p class="fs-6">Memilih adalah hak fundamental dalam masyarakat demokratis. Ini memungkinkan Anda ikut serta dalam proses pengambilan keputusan dan membentuk masa depan negara Anda.</p>
                </div>
            </div>
            <div class="reason">
                <div class="divContainer">
                    <img src="../img/web/reason2.png" alt="Reason 2">
                </div>
                <div class="reason-content">
                <h3>Partisipasi</h3>
                <p>Suara Anda dapat memiliki dampak yang signifikan. Dengan berpartisipasi dalam pemilihan, Anda turut menentukan para wakil dan kebijakan yang sejalan dengan nilai dan aspirasi Anda.</p>
                </div>
            </div>
            <div class="reason">
                <div class="divContainer">
                    <img src="../img/web/reason3.png" alt="Reason 3">
                </div>
                <div class="reason-content">
                <h3>Menjamin Akuntabilitas</h3>
                <p>Menggunakan hak pilih membawa tanggung jawab bagi para politisi atas tindakan mereka. Ini membantu membentuk pemerintahan yang bertanggung jawab dan bekerja untuk kesejahteraan warganya.</p>
                </div>
            </div>
            </div>
        </div>
    </div>


    <div class="section4">
        <div class="container">
            <h2>Hubungi Kami</h2>
            <p>Apakah Anda memiliki pertanyaan atau umpan balik? Kami akan senang mendengarnya. Hubungi tim kami sekarang:</p>
            <div class="contact-info">
                <div class="contact-item">
                    <p>Email: evotingindonesia23@gmail.com</p>
                </div>
                <div class="contact-item">
                    <p>Telepon: +62 044132</p>
                </div>
                <div class="contact-item">
                    <p>Alamat: UPH Kampus Medan</p>
                </div>
                <a style='margin-top: 40px' href="contact_us.php" class="btn btn-1">Kontak Kami</a>
            </div>
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


        var labelData = <?php echo json_encode($calon) ?>;
        var ctx = document.getElementById("predictionChart").getContext("2d");
        var predictionChart = new Chart(ctx, {
        type: "pie",
        data: {
            labels: labelData,
            datasets: [
            {
                data: <?php echo json_encode($number_of_votes_per_candidate) ?> ,
                backgroundColor: ["#bb0c0c", "#f05a5a", "#9c0202", "#ffd700"],
                borderWidth: 3,
            },
            ],
            
        },
        options: {
            responsive: true,
            legend: {
            position: "bottom",
            },
            tooltips: {
                 enabled: false
            },
            plugins: {
                datalabels: {
                    formatter: (value, ctx) => {

                    let sum = ctx.dataset._meta[0].total;
                    let percentage = (value * 100 / sum).toFixed(2) + "%";
                    return percentage;


                    },
                    color: '#fff',
                }
            }
        },
        });
    </script>
</body>

</html>
