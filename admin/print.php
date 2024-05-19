<?php
include 'db.php';


    $filter=$_GET['filter']??7;
    $json=new stdClass();
    $sql="SELECT product.name as name,inbounds.quantity,price_import as price, inbounds.created_at as created_at,supplier,warehouse.name as warehouse,staff,description FROM ((inbounds inner join product on inbounds.product_id=product.id) inner join warehouse on inbounds.warehouse_id=warehouse.id)  where DATEDIFF(CURDATE(),inbounds.created_at)<='$filter'";
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

    echo json_encode($json);
    

    
?>