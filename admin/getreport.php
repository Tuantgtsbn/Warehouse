<?php
include 'db.php';


    $filter=$_GET['filter']??7;
    $current_page=$_GET['page']??1;
    $json=new stdClass();
    $total=0;
    $sql='SELECT count(*) FROM inbounds where DATEDIFF(CURDATE(),created_at)<='.$filter;
    $total=mysqli_fetch_array(mysqli_query($con,$sql))[0];
    $limit=10;
    $total_page=ceil($total/$limit);
    if($current_page>$total_page){
        $current_page=$total_page;
    }else if($current_page<1){
        $current_page=1;
    }
    $json->total_page=$total_page;
    $json->current_page=$current_page;
    $start=($current_page-1)*$limit;
    $sql="SELECT product.name as name,inbounds.quantity,price_import as price, inbounds.created_at as created_at,supplier,warehouse.name as warehouse,staff,description FROM ((inbounds inner join product on inbounds.product_id=product.id) inner join warehouse on inbounds.warehouse_id=warehouse.id)  where DATEDIFF(CURDATE(),inbounds.created_at)<='$filter' LIMIT $start,$limit";
    $json->table=array();
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $tmp=new stdClass();
        $tmp->name=$row['name'];
        $tmp->quantity=$row['quantity'];
        $tmp->price=$row['price'];
        $tmp->created_at=$row['created_at'];
        $tmp->supplier=$row['supplier'];
        $tmp->warehouse=$row['warehouse'];
        $tmp->staff=$row['staff'];
        $tmp->description=$row['description'];
        $json->table[]=$tmp;


    }

    $json->pages=array();
    if ($current_page > 1 && $total_page > 1) {
        $json->pages[] = '<span class="page-link" onclick="showpage('.($current_page-1).')">Prev</span>';
    }
    if($total_page>=1){
        // Lặp khoảng giữa
        for ($i = 1; $i <= $total_page; $i++) { // Nếu là trang hiện tại thì hiển thị thẻ span
            // ngược lại hiển thị thẻ a
            if ($i == $current_page) {
                $json->pages[]= '<span class="page-link active" onclick="showpage('.($i).')">'.$i.'</span>';
            } else {
                $json->pages[]= '<span class="page-link" onclick="showpage('.($i).')">'.$i.'</span>';
            }
        }
    }
    // nếu current_page < $total_page và total_page > 1 mới hiển thị nút prev
    if ($current_page < $total_page && $total_page > 1) {
        $json->pages[]= '<span class="page-link" onclick="showpage('.($current_page+1).')">Next</span>';
    }
    echo json_encode($json);
    

    
?>