<?php
    require 'db_conn.php';

    if(isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        $product_image = $_POST['product_image'];
        $cart_product_name = $_POST['cart_product_name'];
        $order_price = $_POST['order_price'];
        $order_quantity = 1;

        $stmt = $conn->prepare("SELECT product_id FROM cart WHERE product_id=?");
        $stmt ->bind_param("s",$product_id);
        $stmt ->execute();
        $res = $stmt->get_result();
        $r = $res->fetch_assoc();
        $code = $r['product_id'];

        if(!$code){
            $query = $conn->prepare("INSERT INTO cart (product_id,cart_product_image,cart_product_name,order_price,order_quantity) VALUES (?,?,?,?,?,?) ");
            $query->bind_param("sssiss",$product_id,$product_image,$cart_product_name,$order_price,$order_quantity);
            $query->execute();

            echo  '<div class="alert alert-success alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Item added to your cart!</strong>
          </div>';
        }else{
            echo  '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong>Item already added to your cart!</strong>
          </div>';
        }
    }

    if(isset($_POST['action']) && isset($_POST['action'])== 'order'){
      $customer_id = $_POST['customer_id']; 
      $products = $_POST['products'];
      $grand_total = $_POST['grand_total'];

      $stmt = $conn->prepare("INSERT INTO ordered_product (customer_id,ordered_product,sub_total) VALUES(?,?,?)");
      $stmt ->bind_param("sss",$customer_id,$products,$grand_total);
      $stmt ->execute();
      $data .= '<div class="text-center">
      <h1 class="display-4 mt-2 text-danger">Thankyou</h1>
      </div>';
 echo $data;
    }
?>