<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location:index.php');
}
ob_start();
?>

<?php
include('db.php');
$sql = "SELECT * FROM warehouse";
$result1 = mysqli_query($con, $sql);
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
                    <h1>Nhập hàng</h1>
                </div>
            </div>
           
                <button type="button" class="btn btn-primary addProduct mt-3"style="margin-right:10px;" data-bs-toggle="modal" data-bs-target="#ModalInbound">
                    Thêm hàng
                </button>
                <button type="button" class="btn btn-success submit mt-3">
                    Gửi
                </button>
            


            <div class="div mt-3">
                <table class="table table-responsive table-hover table-striped table-bordered" id="table-inbound">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên Sản Phẩm</th>
                            <th>Số Lượng</th>
                            <th>Giá Nhập</th>
                            <th>Nhà Cung Cấp</th>
                            <th>Kho Hàng</th>
                            <th>Ngày Nhập Kho</th>
                            <th>Người Nhập</th>
                            <th>Mô Tả</th>
                            <th>Sửa</th>
                            <th>Xóa</th>
                        </tr>
                    </thead>
                    <tbody id="content-table-inbound">
                        <!-- Noi dung table -->
                        <tr>
                            <td>1</td>
                            <td>San pham 1</td>
                            <td>10</td>
                            <td>10000</td>
                            <td>Nha cung cap 1</td>
                            <td>Kho 1</td>
                            <td>2021-12-12</td>
                            <td>Nguyen Van A</td>
                            <td>Mo ta</td>
                            <td><button class="btn btn-warning updateBtn" data-bs-toggle="modal" data-bs-target="#ModalInbound">Sửa</button></td>
                            <td><button class="btn btn-danger deleteBtn">Xóa</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>San pham 2</td>
                            <td>20</td>
                            <td>20000</td>
                            <td>Nha cung cap 2</td>
                            <td>Kho 2</td>
                            <td>2021-12-12</td>
                            <td>Nguyen Van B</td>
                            <td>Mo ta</td>
                            <td><button class="btn btn-warning updateBtn " data-bs-toggle="modal" data-bs-target="#ModalInbound">Sửa</button></td>
                            <td><button class="btn btn-danger deleteBtn">Xóa</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal nhap hang -->
    <div class="modal" id="ModalInbound">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Phiếu nhập hàng</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="" method="post" class="form-inbound row">
                        <div class="mb-3 col-12">
                            <label class="form-label" for="product_name">Tên Sản Phẩm:</label>
                            <input type="text" class="form-control invalue" name="product_name" id="product_name" required>
                        </div>



                        <div class="mb-3 col-6">
                            <label class="form-label" for="quantity">Số Lượng:</label>
                            <input type="number" class="form-control invalue" name="quantity" id="quantity" required>
                        </div>

                        <div class="mb-3 col-6">
                            <label class="form-label" for="price">Giá Nhập:</label>
                            <input type="number" class="form-control invalue" name="price" id="price" required>
                        </div>

                        <div class="mb-3 col-12">
                            <label class="form-label" for="supplier">Nhà Cung Cấp:</label>
                            <input type="text" class="form-control invalue" name="supplier" id="supplier" required>
                        </div>
                        <div class="mb-3 col-12">
                            <labelclass="form-label" for="warehouse">Kho Hàng:</labelclass=>
                                <select name="warehouse" id="warehouse" class="form-select invalue" required>
                                    <option value="">Chọn kho</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($result1)) {
                                        echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                    }
                                    ?>
                                </select>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label" for="receipt_date">Ngày Nhập Kho:</label>
                            <input type="date" class="form-control invalue" name="receipt_date" id="recript_date" required>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label" for="staff">Người Nhập:</label>
                            <input type="text" class="form-control invalue" name="staff" id="staff" value="<?php echo $_SESSION['user']; ?>" required>
                        </div>
                        <div class="mb-3 col-12">
                            <label class="form-label" for="description">Mô Tả:</label>
                            <input type="text" class="form-control invalue" name="description" id="description" required>
                        </div>

                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary addBtn" data-bs-dismiss="modal">Thêm mới</button>
                    <button type="button" class="btn btn-primary editBtn" data-bs-dismiss="modal">Cập nhật</button>

                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script>
        function campareDate(date){
            var today=new Date();
            var inputDate=new Date(date);
            if(inputDate>today){
                return false;
            }
            return true;
        }
        function validateForm() {
            var listInboundInput = document.querySelectorAll('.invalue');
            var check = true;
            listInboundInput.forEach(function(item) {
                if (item.value == '') {
                    check = false;
                    item.style.border = '1px solid red';
                } else {
                    item.style.border = '1px solid #ced4da';
                }
            });
            if(Number(listInboundInput[1].value)<=0||Number(listInboundInput[2].value)<=0){
                alert('Số lượng phải lớn hơn 0');
                check=false;
            }
            if(!campareDate(String(listInboundInput[5].value))){
                alert('Ngày nhập không hợp lệ');
                check=false;
            }
            return check;
        }
        function updateIndex() {
            var index = 0;
            var trs = document.querySelectorAll('#content-table-inbound tr');
            trs.forEach(function(tr) {
                var tds = tr.querySelectorAll('td');
                if (tds.length > 0) {
                    index++;
                    tds[0].textContent = index;
                }
            });

        }
        var row = "";
        var addBtn = document.querySelector('.addBtn');
        var confirm = document.querySelector('.editBtn');
        var listInboundInput = document.querySelectorAll('.invalue');
        var modalInbound = document.querySelector('#ModalInbound');
        var addProductBtn = document.querySelector('.addProduct');
        var contentTableInbound = document.querySelector('#content-table-inbound');
        addProductBtn.addEventListener('click', function() {
            listInboundInput.forEach(function(item) {
                item.value = '';
            });
            listInboundInput[6].value = '<?php echo $_SESSION['user']; ?>';
        });
        // confirmUpdateBtn.addEventListener('click',function(){
        //     console.log(1)
        // })
        confirm.addEventListener('click', function() {
            if(!validateForm()){
                return;
            }
            var tds = row.querySelectorAll('td');
            for (let i = 1; i <= 8; i++) {
                tds[i].textContent = listInboundInput[i - 1].value;
            }
        });
        addBtn.addEventListener('click', function() {
            if (!validateForm()) {
                return;
            }
            var tr = document.createElement('tr');
            var tdIndex = document.createElement('td');
            tdIndex.textContent = 1;
            tr.appendChild(tdIndex);
            listInboundInput.forEach(function(item) {
                var td = document.createElement('td');
                td.textContent = item.value;
                tr.appendChild(td);
            });
            var tdUpdate = document.createElement('td');
            var updateBtn = document.createElement('button');
            updateBtn.textContent = 'Sửa';
            updateBtn.classList.add('btn', 'btn-warning', 'updateBtn');
            updateBtn.setAttribute('data-bs-toggle', 'modal');
            updateBtn.setAttribute('data-bs-target', '#ModalInbound');
            tdUpdate.appendChild(updateBtn);
            tr.appendChild(tdUpdate);
            var tdDelete = document.createElement('td');
            var deleteBtn = document.createElement('button');
            deleteBtn.textContent = 'Xóa';
            deleteBtn.classList.add('btn', 'btn-danger', 'deleteBtn');
            tdDelete.appendChild(deleteBtn);
            tr.appendChild(tdDelete);
            contentTableInbound.appendChild(tr);
            updateIndex();


        });

        contentTableInbound.addEventListener('click', function(e) {
            if (e.target.classList.contains('updateBtn')) {
                var tr = e.target.parentElement.parentElement;
                var tds = tr.querySelectorAll('td');
                for (let i = 1; i <= 8; i++) {
                    listInboundInput[i - 1].value = tds[i].textContent;
                }
                row = tr;
                console.log(row);



            }
            if (e.target.classList.contains('deleteBtn')) {
                var tr = e.target.parentElement.parentElement;
                tr.remove();
                updateIndex();
            }
        });

        var submit = document.querySelector('.submit');
        submit.addEventListener('click', function() {
            var trs = document.querySelectorAll('#content-table-inbound tr');
            var data = [];
            trs.forEach(function(tr) {
                var tds = tr.querySelectorAll('td');
                if (tds.length > 0) {
                    var obj = {
                        product_name: tds[1].textContent,
                        quantity: tds[2].textContent,
                        price: tds[3].textContent,
                        supplier: tds[4].textContent,
                        warehouse: tds[5].textContent,
                        receipt_date: tds[6].textContent,
                        staff: tds[7].textContent,
                        description: tds[8].textContent
                    }
                    data.push(obj);
                }
            });
            if(data.length==0){
                alert('Không có dữ liệu');
                return;
            }
            var xml=new XMLHttpRequest();
            xml.onreadystatechange=function(){
                if(xml.readyState==4 && xml.status==200){
                    var result=xml.responseText;
                    alert(result);
                    contentTableInbound.innerHTML='';
                }
            }
            xml.open('POST','solveimport.php',true);
            xml.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            xml.send('data='+JSON.stringify(data));
            // alert('Gửi thành công');
        });
    </script>

</body>

</html>