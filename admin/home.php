<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:index.php');
}
ob_start();
?>

<?php
include('db.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../style/home.css">

</head>

<body>
    <header>
        <div class="container-fluid p-0">
            <nav class="navbar navbar-expand-md fixed-top" style="background-color:rgb(9, 25, 42);">
                <div class="container-fluid">
                    <a class="navbar-brand btn btn-primary text-white" href="home.php">
                        <?php
                        echo $_SESSION['user'];
                        ?>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mynavbar">
                        <ul class="navbar-nav me-auto" style="display:none;">
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="me-2 fa-solid fa-gauge-high"></i>Tổng quan</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="#"><i class="me-2 fa-solid fa-shop">Bán hàng</i> </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"><i class="me-2 fa-solid fa-file-export"></i>Xuất kho</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#" data-bs-toggle="collapse" data-bs-target="#inbound"><i class="fa-solid fa-warehouse"></i>Nhập kho</a>
                            </li>
                            <ul id="inbound" class="collapse">
                                <li>
                                    <a class="nav-link" href="import.php"><i class="fa-solid fa-download"></i>Nhập hàng</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="report.php"><i class="fa-solid fa-table"></i>Xuất báo cáo</a>
                                </li>
                            </ul>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php"><i class="me-2 fa-solid fa-right-from-bracket"></i> Logout</a>
                            </li>

                        </ul>
                        <div class="dropdown ms-auto">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
                                <i class="me-2 fa-solid fa-user"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="#"><i class="me-2 fa-solid fa-user"></i> User Profile</a></li>
                                <li><a class="dropdown-item" href="#"><i class="me-2 fa-solid fa-gear"></i> Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                    </hr>
                                </li>
                                <li><a class="dropdown-item" href="#"><i class="me-2 fa-solid fa-right-from-bracket"></i> Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    
    <div class="sidebar">
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="#"><i class="me-2 fa-solid fa-gauge-high"></i>Tổng quan</a>
                </li>
                <li>
                    <a href="#" ><i class="me-2 fa-solid fa-shop"></i>Bán hàng</a>
                </li>
                <li>
                    <a href="#"><i class="me-2 fa-solid fa-file-export"></i>Xuất kho</a>
                </li>
                <li>
                    <a href="logout.php"><i class="me-2 fa-solid fa-right-from-bracket"></i> Logout</a>
                </li>
                <li>
                    <a class="active" data-bs-toggle="collapse" data-bs-target="#inbound"><i class="me-2 fa-solid fa-warehouse"></i>Nhập kho</a>
                </li>
                <ul id="inbound" class="collapse">
                    <li>
                        <a href="import.php"><i class="me-2 fa-solid fa-download"></i>Nhập hàng</a>
                    </li>
                    <li>
                        <a href="report.php"><i class="me-2 fa-solid fa-table"></i>Xuất báo cáo</a>
                    </li>
                </ul>

            </ul>
        </div>
    </div>

    <div id="content">
        <div class="container-fluid">
            <div class="row title-content">
                <div class="col-12">
                    <h1>Nhập kho</h1>
                </div>
            </div>
            
</body>

</html>