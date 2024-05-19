<?php
session_start();
if (isset($_SESSION["user"])) {
    header("location:home.php");
}

?>
<?php
include('db.php');
$message="";

if(isset($_POST['sub'])){
    $user = test_data($_POST['user']);
    $pass = test_data($_POST['pass']);
    
    if($user == "admin" && $pass == "12345678"){
        $_SESSION["user"] = $user;
        header("location:home.php");
    }
    else{
        $message = "Đăng nhập lỗi. Vui lòng thử lại.";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>ADMIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            background-image: url('../images/login.jpg');
            background-size: cover;
        }
        form{
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px 0px #00000040;
        }
    </style>

</head>

<body>
    <div class="container-fluid d-flex align-items-center justify-content-center" style="height:100vh;">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="row w-50">
            <div class="col-12">
                <h3>Login Admin</h3>
            </div>
            <div class="col-12">
                <label for="user" class="form-label">Tài khoản</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>
            <div class="col-12">
                <label for="pass" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="pass" name="pass" required>
                <?php
                echo "<p style='color:red;'>$message</p>";
                ?>
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary" name="sub">Đăng nhập</button>
            </div>
            <div class="col-4 ms-auto d-flex justify-content-end">
                <a href="../index.php" class="ms-auto" style="display:inline-block;">Trang chủ</a>
            </div>
        </form>
        
    </div>

</body>

</html>

