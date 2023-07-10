<?php
    include "../component/php/connect.php";

    if (isset($_GET['category'])){
        $category = $_GET['category'];
    } else {
        $category ='PILPRES2023';
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Voting.com</title>
    <?php include "../component/php/head.php";?>
    <link rel="stylesheet" href="../component/style/votingPage.css">
    <script src="../component/JS/votingPage.js" defer></script>
    <style>
        .dropdown{
            display: flex;
            justify-content: flex-end;
        }
        .dropdown{
            margin-top: 50px;
        }

        img {
            max-height: 130px;
        }
    </style>
</head>
<body>
<?php
if(isset($_POST['vote'])){

    
    $candidate_id = $_POST['candidate_id'];
    $user_id = $_SESSION['user_id'];

    $query = "SELECT voting_name, nama_calon FROM candidate WHERE id = $candidate_id ";
    $get_candidatename = $connect -> prepare($query);
    $get_candidatename -> execute ();
    $fetch_candidatename = $get_candidatename -> fetch(PDO::FETCH_ASSOC);

    $candidate_name = $fetch_candidatename['nama_calon'];
    $category_name = $fetch_candidatename['voting_name'];

    $query = "SELECT NIK, nama FROM users WHERE user_id = $user_id ";
    $get_user = $connect -> prepare($query);
    $get_user -> execute ();
    $fetch_user = $get_user -> fetch(PDO::FETCH_ASSOC);

    $NIK = $fetch_user['NIK'];
    $nama = $fetch_user['nama'];

    $date = date('Y-m-d');

    $query = "SELECT * FROM votes WHERE user_id = $user_id AND category_name = '$category_name'";
    $check_if_ever_vote = $connect -> prepare($query);
    $check_if_ever_vote -> execute ();



    $r = $check_if_ever_vote->rowCount();


    // echo "<div class='alert alert-danger' role='alert'>$user_id $category_name</div>";


    if($check_if_ever_vote->rowCount()>0){
        // echo "<div class='alert alert-danger' role='alert'>You have already voted</div>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon:'warning',
                title:'Anda sudah memilih sebelumnya. Anda tidak dapat melakukan pemilihan lagi!',
            }).then(function(){
                window.location = "landing.php";
            });
        </script>
        <?php
    } else {
        $query = "INSERT INTO votes (category_name, user_id, choose, NIK, user_nama, voting_time) VALUES ( ?, ?, ?, ?, ?, ?)";
        $check_if_ever_vote = $connect -> prepare($query);
        $check_if_ever_vote -> execute ([$category_name, $user_id, $candidate_name, $NIK, $nama, $date]);
        // echo "<div class='alert alert-danger' role='alert'>Successfully Voted</div>";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.20/dist/sweetalert2.all.min.js"></script>
        <script>
            Swal.fire({
                icon:'success',
                title:'Pilihan Anda sudah tercatat',
            }).then(function(){
                window.location = "landing.php";
            })
        </script>
        <?php
    }

}
?>
<?php
require_once("../component/php/navbar.php");
 ?>
    <div class="dropdown">
    <form method="get" id="form">
        <select id="" class="dropdown select" name="category"  onchange="this.form.submit()" required>
        <?php 
        date_default_timezone_set('Asia/Jakarta');

        $currentDate = date('Y-m-d');

        $query ="SELECT nama FROM category WHERE status ='Active' AND start_tggl <= '$currentDate' AND end_tggl >= '$currentDate'";
        $show_category = $connect->prepare($query);
        $show_category -> execute();
        if ($show_category->rowCount()>0) {
        while($fetch_category = $show_category->fetch(PDO::FETCH_ASSOC)){
        $fetch_category = implode($fetch_category);
        ?>
        <option <?php if (isset($category) && $category == "$fetch_category") echo "selected" ?> value="<?=$fetch_category?>"><?=$fetch_category?></option>
        <?php
        } 
        } 
        ?>
        </select>
    </form>
    </div>
    <main>
        
        <div class="main-container">
                <?php
                    if($category==''){
                        ?>
                        <div class="container-duplicate">
                        <form action="" method="post"> 
                        <div class="up">
                        <input type="hidden" name="candidate_id" value="<?= $fetch_candidates['id'];?>">
                        <img src="../img/candidate/baner111.png" alt="">
                        </div>
                        <div class="down">
                        </div>
                        </form></div>
                        <?php
                    } else {
                    $query ="SELECT * FROM candidate WHERE voting_name = '$category'";
                    $show_candidates = $connect->prepare($query);
                    $show_candidates -> execute();
                    
                    $index=1;
                    if($show_candidates->rowCount() > 0) {
                        while($fetch_candidates = $show_candidates->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <div class="container-duplicate">
                        <form action="" method="post"> 
                        <div class="up">
                        <div style="display:flex; justify-content:flex-start; padding-top:10px; width:90%; height:40px;">
                            <p style="font-size:1.5em; font-weight:800;">0<?=$index?></p>
                        </div>
                        <input type="hidden" name="candidate_id" value="<?= $fetch_candidates['id'];?>">
                        <img src="../img/candidate/<?=$fetch_candidates['foto_calon']?>" alt="">
                        <h4><?=$fetch_candidates['nama_calon']?></h4>
                        <h5>Calon <?=$fetch_candidates['nama_jabatan']?></h5>
                        </div>
                        <div class="down">
                        <img src="../img/candidate/<?=$fetch_candidates['foto_wakil']?>" alt="">
                        <h4><?=$fetch_candidates['nama_wakil']?></h4>
                        <h5>Wakil <?=$fetch_candidates['nama_jabatan']?></h5>
                        </div>
                        <div class="btn">
                        <input type="submit" value="Pilih" name="vote" onclick="return confirm('Are you sure?')">
                        </div>
                        </form></div>
                        <?php

                        $index++;
                        
                        } 
                    }
                }     
                    
                ?>
                
        
        </div>
    </main>
</body>
</html>

