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
                    <a href="#"><i class="me-2 fa-solid fa-shop"></i>Bán hàng</a>
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
                    <h1>Xuất báo cáo</h1>
                </div>
            </div>



            <div class="row">
                <div class="col-3">
                    <label for="filter" class="form-label">Bộ lọc</label>
                    <select name="" id="filter" class="form-control">
                        <option value="7">Chọn ngày</option>
                        <option value="1">Hôm nay</option>
                        <option value="7">Tuần vừa qua</option>
                        <option value="30">Tháng vừa qua</option>

                    </select>
                </div>
                <div class="col-3 downloadBtn ms-auto my-auto">
                    <button class="btn btn-success" onclick="exportTableToCSV('report.csv');">Download CSV</button>
                </div>
            </div>






            <div class="table-report mt-5">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên sản phẩm</th>
                            <th scope="col">Số lượng</th>
                            <th scope="col">Giá nhập</th>
                            <th scope="col">Ngày nhập</th>
                            <th scope="col">Nhà cung cấp</th>
                            <th scope="col">Kho</th>
                            <th scope="col">Nhân viên</th>
                            <th scope="col">Mô tả</th>
                        </tr>
                    </thead>
                    <tbody class="report" id="report">
                        <!-- Noi dung -->
                    </tbody>
                </table>
            </div>

            <div class="pagination mt-5 justify-content-center" id="pagination">
                <!-- Hiển thị các trang -->
            </div>

        </div>
    </div>
    <div class="modal" id="option" tabindex="-1" aria-labelledby="optionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="optionLabel">Tùy chọn báo cáo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="from" class="form-label">Từ ngày</label>
                            <input type="date" class="form-control" id="from" name="from">
                        </div>
                        <div class="mb-3">
                            <label for="to" class="form-label">Đến ngày</label>
                            <input type="date" class="form-control" id="to" name="to">
                        </div>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // function formatNumber(num) {
        //     let tmp = num
        //     return tmp.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
        // }
        var page = 1;
        var limit = 10;
        var total_page = 0;
        var pagination = document.getElementById('pagination');
        var report = document.getElementById('report');
        var filter = document.getElementById('filter');
        var url = 'getreport.php?filter=7' + '&page=1';
        var filtervalue = filter.value;
        // filter.addEventListener('change', function() {
        //     filter = this.value;
        //     page = 1;
        //     getReport();
        // });
        var xml = new XMLHttpRequest();
        xml.onreadystatechange = function() {

            if (xml.readyState == 4 && xml.status == 200) {
                var data = JSON.parse(xml.responseText);
                var html = '';
                data['table'].forEach(function(item, index) {
                    html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price}</td>
                            <td>${item.created_at}</td>
                            <td>${item.supplier}</td>
                            <td>${item.warehouse}</td>
                            <td>${item.staff}</td>
                            <td>${item.description}</td>
                        </tr>`;
                });
                report.innerHTML = html;
                html = '';
                data['pages'].forEach(function(item) {
                    html += item;
                });
                pagination.innerHTML = html;
            }
        }
        xml.open('GET', url, true);
        xml.send();

        filter.addEventListener('change', function() {
            filtervalue = this.value;
            let xml3 = new XMLHttpRequest();
            xml3.onreadystatechange = function() {
                if (xml3.readyState == 4 && xml3.status == 200) {
                    var data = JSON.parse(xml3.responseText);
                    var html = '';
                    data['table'].forEach(function(item, index) {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price }</td>
                            <td>${item.created_at}</td>
                            <td>${item.supplier}</td>
                            <td>${item.warehouse}</td>
                            <td>${item.staff}</td>
                            <td>${item.description}</td>
                        </tr>`;
                    });
                    report.innerHTML = html;
                    html = '';
                    data['pages'].forEach(function(item) {
                        html += item;
                    });
                    pagination.innerHTML = html;
                }
            }
            xml3.open('GET', `getreport.php?filter=${filtervalue}+&page=1`, true);
            xml3.send();
        });

        function showpage(page) {
            url = `getreport.php?filter=${filter.value}+&page=${page}`;
            let xml1 = new XMLHttpRequest();
            xml1.onreadystatechange = function() {
                if (xml1.readyState == 4 && xml1.status == 200) {
                    var data = JSON.parse(xml1.responseText);
                    var html = '';
                    data['table'].forEach(function(item, index) {
                        html += `<tr>
                            <td>${index+1}</td>
                            <td>${item.name}</td>
                            <td>${item.quantity}</td>
                            <td>${item.price}</td>
                            <td>${item.created_at.toString()}</td>
                            <td>${item.supplier}</td>
                            <td>${item.warehouse}</td>
                            <td>${item.staff}</td>
                            <td>${item.description}</td>
                        </tr>`;
                    });
                    report.innerHTML = html;
                    html = '';
                    data['pages'].forEach(function(item) {
                        html += item;
                    });
                    pagination.innerHTML = html;
                }
            }
            xml1.open('GET', url, true);
            xml1.send();
        }
        function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob(["\uFEFF"+csv], {type: 'text/csv;charset=utf-8;'});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanch the download
    downloadLink.click();
}

function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll("table tr");
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll("td, th");
        
        for (var j = 0; j < cols.length; j++) 
            row.push(cols[j].innerText);
        
        csv.push(row.join(","));        
    }

    // Download CSV
    downloadCSV(csv.join("\n"), filename);
}


        // function tableToCSV() {
        //     var table = document.querySelector('.table');
        //     var csv = [];
        //     var rows = table.querySelectorAll('tr');

        //     for (var i = 0; i < rows.length; i++) {
        //         var row = [],
        //             cols = rows[i].querySelectorAll('th, td');
        //         for (var j = 0; j < cols.length; j++) {
        //             row.push(cols[j].innerText);
        //         }
        //         csv.push(row.join(','));
        //     }
        //     alert(csv.join('\n'));

        //     // Tạo file CSV
        //     // var csvFile = new Blob([csv.join('\n')], {
        //     //     type: 'text/csv'
        //     // });
        //     // var downloadLink = document.createElement('a');

        //     // downloadLink.download = 'table_data.csv';
        //     // downloadLink.href = window.URL.createObjectURL(csvFile);
        //     // downloadLink.style.display = 'none';

        //     // document.body.appendChild(downloadLink);
        //     // downloadLink.click();
        //     // document.body.removeChild(downloadLink);
        // }

        
    </script>
</body>

</html>