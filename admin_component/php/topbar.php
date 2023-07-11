<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

        <!-- Sidebar Toggle (Topbar) -->

        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fas fa-bars" style="color: red;"></i></button>

        <!-- <div >
            <button style="border:0; background-color: transparent;" id="sidebarToggle"></button>
        </div> -->

    

        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="dash.php?logout=<?=$_SESSION['admin_id']?>" id="userDropdown" role="button" style="gap: 10px;">
                    <span style="cursor: context-menu;" class="mr-2 d-none d-lg-inline text-gray-600 small">Hi <?=$_SESSION['nama_admin']?></span>
                    <i class="fas fa-sign-out-alt text-gray-600" ></i>
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">Logout</span>
                
                </a>
            </li>

        </ul>

    </nav>

    



