<!DOCTYPE html>
<html>
<?php require './database/db.php'; ?>

<?php session_start();
?>

<?php

if ($_SESSION['email']) {
  
}else{
  header("location:login.php");
}
?>
      <!--Order-->

<?php  include('./process.php'); ?>
<?php 

    //add order
  $added_date = "";
  $brand_name = "";
  $category_name="";
  $product_name = "";
  $product_price = "";
  $product_qty = "";
  $id = 0;
  $order = false;

  if (isset($_POST['submit_order'])) {
    $id = $_POST['id'];
    $added_date = $_POST['added_date'];
    $brand_name = $_POST['brand_name'];
    $category_name=$_POST['category_name'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_qty = $_POST['product_qty'];

    $check_qty_query = "SELECT * FROM product WHERE pid = $id";
    $check_qty_result = mysqli_query($connect, $check_qty_query);
    while($check_qty_row = mysqli_fetch_array($check_qty_result)){
    $check_product_qty = $check_qty_row['product_qty'];
    }

    if ($product_qty <= $check_product_qty) {
      $query = "INSERT INTO `order`(category_name,brand_name,product_name,product_price,product_qty,added_date , total_amount) VALUES ('$category_name', '$brand_name' , '$product_name' , '$product_price' , '$product_qty' , '$added_date' , '$product_price' *'$product_qty')";
        
           $result = mysqli_query($connect, $query);

       if ($result) {

            $update_product_query = "UPDATE `product` SET `product_qty` = product_qty - $product_qty WHERE pid = $id";
            mysqli_query($connect, $update_product_query );
        header("location:create_order.php");
       }
    }else{
      $error = "No More Item";
    }
    
  }



  if (isset($_GET['order_product'])) {
    $id = $_GET['order_product'];
    $order = true;
    $record = mysqli_query($connect, "SELECT * FROM `product` WHERE pid=$id ");

    if (mysqli_num_rows($record) == 1 ) {
      $n= mysqli_fetch_array($record);
      $category_name = $n['category_name'];
      $brand_name = $n['brand_name'];
      $product_name = $n['product_name'];
      $product_price = $n['product_price'];
      $product_qty = $n['product_qty'];
    }
  }
?>

<head>

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

</head>
<body>



<?php include_once("./templates/header.php"); ?>

<div class="row">

<div class="col-md-8">

   <?php include_once("./templates/search.php"); ?>

    <hr class="container-hr">
    
<table>
  <thead>
    <tr>
      <th>Category</th>
      <th>Brand</th>
      <th>Product</th>
      <th>Price</th>
      <th>Quantity</th>
      <th>Date</th>
      <th colspan="1">Action</th>
      
    </tr>
  </thead>
  <?php $results = mysqli_query($connect,"SELECT * FROM `product` ORDER BY pid DESC"); ?>
  <?php while ($row = mysqli_fetch_array($results)) { 
    $quantity = $row['product_qty'];
    ?>

  <tbody id="myTable">
    <tr>
      <td><?php echo $row['category_name']; ?></td>
      <td><?php echo $row['brand_name']; ?></td>
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_price']; ?></td>
      <td><?php echo $row['product_qty']; ?></td>
      <td><?php echo $row['added_date']; ?></td>
     
      <td>
        <?php if ($quantity == 0): ?>
          <a name="order_product" href="create_order.php?order_product=<?php echo $row['pid']; ?>" class="btn btn-danger disabled"><i class="fa fa-shopping-cart fa-lg">&nbsp;</i>Unavailable</a>
        <?php else: ?>
          <a name="order_product" href="create_order.php?order_product=<?php echo $row['pid']; ?>" class="btn btn-success "><i class="fa fa-shopping-cart fa-lg">&nbsp;</i> Order</a>
        
        <?php endif ?>
        
      </td>
    </tr>
  <?php } ?>
  <tbody id="myTable">
</table>
</div>

<div class="col-md-4">
  <form class="form form-inline bg-secondary " method="post" action="" >
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <?php
     if (isset($error)) {
      echo $error;
      }?>

    <div class="input-group">
        <label>Date</label>
       <input type="text" name="added_date" value="<?php echo date("Y-m-d"); ?>" readonly>
    </div>
    <div class="input-group">
            <label>Category</label>
            <input type="text" name="category_name" value="<?php echo $category_name; ?>" readonly>
            
          </div>
    <div class="input-group">
            <label>Brand</label>
            <input type="text" name="brand_name"  value="<?php echo $brand_name; ?>" readonly>
            
          </div>
    <div class="input-group">
        <label>Product Name</label>
       <input type="text" name="product_name" value="<?php echo $product_name; ?>" readonly>
    </div>
    <div class="input-group">
        <label>Product Quantity</label>
       <input type="text" name="product_qty" value="<?php echo $product_qty; ?>" required>
    </div>
    <div class="input-group">
        <label>Product price</label>
       <input type="text" name="product_price" value="<?php echo $product_price; ?>" readonly>
    </div>

    <!--product price start-->

<!--product price end-->

<div class="input-group">
      <?php if ($order == true): ?>
  <button class="btn btn-lg btn-success" type="submit" name="submit_order" ><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true">&nbsp;</i>
order</button>
<?php else: ?>
  <button disabled class="btn btn-lg btn-success" type="submit" name="submit_product" ><i class="fa fa-plus fa-lg" aria-hidden="true">&nbsp;</i>
Add</button>
<?php endif ?>
    </div>

<!--
    <div class="input-group">
      <?php //if ($update == true): ?>
  <button class="btn btn-lg btn-success" type="submit" name="update_product" ><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true">&nbsp;</i>
update</button>
<?php //else: ?>
  <button class="btn btn-lg btn-success" type="submit" name="submit_product" ><i class="fa fa-plus fa-lg" aria-hidden="true">&nbsp;</i>
Add</button>
<?php //endif ?>
    </div>  -->
  </form>
</div>


</div>

</body>
</html>
