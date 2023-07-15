<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting.com</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

    <link rel="stylesheet" href="../admin_component/css/custom/login.css">
    <!-- <link rel="stylesheet" href="../admin_component/css/adminboots.css"> -->

</head>

<style>

</style>

<?php include '../admin_component/php/connect.php' ?>
<?php include '../admin_component/php/flash.php' ?>

<body>
<?php include '../admin_component/php/login_verifikasi.php' ?>

    <div class="section1">
    <img class="backgroundSection1" src="../img/web/background.png">
    <div class="container">
    <?php flash('Logout'); ?>
        <h1>MASUK</h1>
        <?php if (isset($errorMessage)): ?>
            <p><?php echo $errorMessage; ?></p>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Kata Sandi:</label>
                <input type="password" id="password" name="password" required>
                <div class="checkbox-label">
                    <input type="checkbox" id="show-password" onchange="showPassword()">
                    <div class="passw">
                    <label for="show-password">Tunjukkan Kata Kunci</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="btn-container">
                    <button class="btn" type="submit">Masuk</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showPassword() {
            var show = document.getElementById("password");
            if (show.type == 'password') {
                show.type='text';
            } else{
                show.type='password';
            }
        }
    </script>

</body>
</html>