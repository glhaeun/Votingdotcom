
<style>
    .sidebar .nav-item .nav-link {
    padding: 1rem;
    padding-left: 2rem;
    padding-right: 2rem;

    display: flex;
    justify-content: space-between;
}

@import url('https://fonts.googleapis.com/css?family=Bangers|Cinzel:400,700,900|Lato:100,300,400,700,900|Lobster|Lora:400,700|Mansalva|Muli:200,300,400,600,700,800,900|Open+Sans:300,400,600,700,800|Oswald:200,300,400,500,600,700|Roboto:100,300,400,500,700,900&display=swap');


*, *::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Roboto';
}

.bg-red-voting {
    background: linear-gradient(107.2deg, rgb(187, 12, 12) 10.6%, rgb(247, 0, 0) 91.1%);
}

.logo  {
    margin-top:30px;
}

.border-left-red-voting {
    border-left: 0.25rem solid #BB0C0C!important;
}

</style>
        <ul class="navbar-nav bg-red-voting sidebar sidebar-dark accordion" id="accordionSidebar">


        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dash.php">
            <div class="sidebar-brand-text mx-3 logo" style="text-align: left ; font-size:25px; color:white; 
            font-weight: 300;
            line-height: 0.65;
            font-family: 'Lobster', cursive;">Voting
            <p style="font-size: 14px;
    margin-left: 50px;
    color: #545454;
    font-weight: 400;
    text-transform: capitalize;
    font-style: italic;
    font-family: 'Mansalva', cursive;">.com</p>
            </div></a>


        <li class="nav-item active">
            <a class="nav-link" href="dash.php">
            <i class="fas fa-columns"></i>
            <span>Dasbor</span></a>
        </li>

        <!--  -->

        <!-- Divider -->
        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Interface
        </div>

        <li class="nav-item">
                    <a class="nav-link collapsed" href="../admin/admin.php"
                        aria-expanded="true" >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Profil Admin</span>
                    </a>
                </li>
        <!-- <?php 
             if($_SESSION['admin_level'] == 'master_admin'){
                ?>
                
                <?php
             } else if ($_SESSION['admin_level'] == 'normal_admin') {
                ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="../admin/admin_normal.php"
                        aria-expanded="true" >
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Admin Profile</span>
                    </a>
                </li> 
                <?php
             }
        ?> -->
        

        <li class="nav-item">
            <a class="nav-link" href="../admin/user.php">
            <i class="fas fa-user"></i>
            <span>Daftar Pengguna</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Addons
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="../admin/prevoting.php" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Hasil Prediksi</span>
            </a>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="voting.php">
                <i class="fas fa-fw fa-chart-area"></i>
                <span>Hasil Pemilihan</span></a>
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="category.php">
                <i class="fas fa-list"></i>
                <span>Daftar Kategori</span></a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="candidate.php">
                <i class="fas fa-users"></i>
                <span>Daftar Kandidat</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

</ul>



