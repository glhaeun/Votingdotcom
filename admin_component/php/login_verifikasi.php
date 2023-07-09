<?php
// Function to retrieve user by username
function getUserByUsername($username) {
    global $connect;
    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = $connect->prepare($query);
    $result -> execute();

    if ($result ->rowCount()>0) {
        $fetch = $result -> fetch(PDO::FETCH_ASSOC);
        $user = $fetch;
        return $user;
    }

    return false;
}


// Check if the login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Authenticate the user against the database
    $user = getUserByUsername($username);

    if ($user && ($password === $user['password'])) {

        $_SESSION['admin_username'] = $user['username'];
        $_SESSION['admin_id'] = $user['admin_id'];
        $_SESSION['nama_admin'] = $user['nama_admin'];
        $_SESSION['admin_level'] = $user['level'];

        flash('Success', 'Anda berhasil Login', FLASH_SUCCESS);
        header("location:dash.php");
        exit();
        // Redirect to the admin page or any desired page
    } else {
        // Authentication failed, show an error message
        $errorMessage = '
        <script>
        Swal.fire(
            "Error!",
            "Username atau Kata Sandi tidak valid!",
            "error"
        );
        </script>
        ';

    }
}
?>