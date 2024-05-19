<?php
include 'db.php';
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $data = json_decode($_POST['data']);
    
    $nums = count($data);
    $correct = 0;
    $arr = array();
    for ($i = 0; $i < $nums; $i++){
        $obj = new stdClass();
        $product_name = $data[$i]->product_name;
        $quantity = $data[$i]->quantity;
        $price = $data[$i]->price;
        $supplier =$data[$i]->supplier;
        $warehouse = $data[$i]->warehouse;
        $receipt_date = (string)$data[$i]->receipt_date;
        $staff =$data[$i]->staff;
        $description = $data[$i]->description;
        $obj->product_name = $product_name;
        $obj->quantity = $quantity;
        $obj->price = $price;
        $obj->supplier = $supplier;
        $obj->warehouse = $warehouse;
        $obj->receipt_date = $receipt_date;
        $obj->staff = $staff;
        $obj->description = $description;
        $arr[] = $obj;
        $sql = "SELECT * FROM product WHERE name = '$product_name'";
        try{
            $result = mysqli_query($con, $sql);
            if (mysqli_num_rows($result) > 0){
                $product_id = mysqli_fetch_assoc($result)['id'];
                $sql = "INSERT INTO inbounds(product_id, warehouse_id, quantity, supplier,staff) VALUES ('$product_id', '$warehouse', '$quantity', '$supplier', '$staff')";
                if (mysqli_query($con, $sql)){
                    $sql = "UPDATE product SET quantity = quantity + $quantity WHERE id = '$product_id'";
                    if (mysqli_query($con, $sql)){
                        $correct++;
                    }
                }
            }else{
                $sql = "INSERT INTO product(name, price_import, warehouse_id, description, quantity) VALUES ('$product_name', '$price', '$warehouse', '$description', '$quantity')";
                mysqli_query($con, $sql);
                $product_id = mysqli_insert_id($con);
                $sql = "INSERT INTO inbounds(product_id, warehouse_id, quantity, supplier, staff) VALUES ('$product_id', '$warehouse', '$quantity', '$supplier', '$staff')";
                if (mysqli_query($con, $sql)){
                    $correct++;
                }
            }
        }catch(Exception $e){
            
        }
    }
    
    echo json_encode(array('correct' => $correct, 'total' => $nums));

}


?>