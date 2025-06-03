<?php
if (isset($_POST['login'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    include 'connection.php';
    $result = mysqli_query($con, "SELECT * FROM user WHERE username = '$user'");
    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        session_start();
        // echo '<script>alert("oke")</script>';
        $row = mysqli_fetch_assoc($result);
        $_SESSION['username'] = $row['username'];
        if (password_verify($pass, $row["password"])) {
            header('Location:admin/index.php');
            exit;
        }
    }
    $error = true;
}
?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <?php if (isset($error)) : ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Login gagal</strong> Periksa kembali Username dan Password
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>
            <div class="card">
                <div class="card-header bg-transparent mb-0">
                    <h5 class="text-center">Login <span class="fw-bold text-primary">User</span></h5>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Username">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Password">
                        </div>
                        <input type="submit" name="login" value="Login" class="btn btn-primary w-100">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>