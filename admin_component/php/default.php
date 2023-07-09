<!-- Bootstrap core JavaScript-->
<script src="../admin_component/vendor/jquery/jquery.min.js"></script>
    <script src="../admin_component/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../admin_component/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../admin_component/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../admin_component/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin_component/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!--  -->
    <script src="../admin_component/vendor/chart.js/Chart.min.js"></script>
    <script src="../admin_component/js/demo/chart-area-demo.js"></script>
    <script src="../admin_component/js/demo/chart-pie-demo.js"></script>
    <script src="../admin_component/js/demo/chart-bar-demo.js"></script>

    <script src="../admin_component/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin_component/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../admin_component/js/demo/datatables-demo.js"></script>

    
<?php
    if(isset($_GET['logout'])){
        session_destroy(); 
       ?>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script>
        swal({
            title: "Logout Successfully!",
            text: "",
            icon: "success",
            
        }).then(function() {
            window.location = "login.php";
        });      
        </script>
        <?php
        
        } 
?>