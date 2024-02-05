<!DOCTYPE html>
<html>
<?php require './database/db.php'; ?>

<?php session_start(); ?>



<?php

if ($_SESSION['email']) {
  
}else{
  header("location:login.php");
}
?>

<?php  include('./process.php'); ?>
<?php 
  if (isset($_GET['edit_product'])) {
    $id = $_GET['edit_product'];
    $update = true;
    $record = mysqli_query($connect, "SELECT * FROM `product` WHERE pid=$id ");

    if (mysqli_num_rows($record) > 0 ) {
      $n= mysqli_fetch_array($record);
      $category_name = $n['category_name'];
      $brand_name = $n['brand_name'];
      $product_name = $n['product_name'];
      $product_price = $n['product_price'];
      $product_qty = $n['product_qty'];
      $added_date = $n['added_date'];
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
      <th colspan="2">Action</th>
      
    </tr>
  </thead>
  <?php $results = mysqli_query($connect,"SELECT * FROM `product` ORDER BY pid DESC"); ?>
  <?php while ($row = mysqli_fetch_array($results)) { ?>
  <tbody id="myTable">
    <tr>
      <td><?php echo $row['category_name']; ?></td>
      <td><?php echo $row['brand_name']; ?></td>
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_price']; ?></td>
      <td><?php echo $row['product_qty']; ?></td>
      <td><?php echo $row['added_date']; ?></td>
      <td>
        <a name="edit_product" href="show_product.php?edit_product=<?php echo $row['pid']; ?>"  class="btn btn-info" ><i class="fa fa-pencil fa-lg" aria-hidden="true">&nbsp;</i>Edit</a>
      </td>
      <td>
        <a onClick="return confirm('Are you sure you want to delete?')" name="del_product" href="process.php?del_product=<?php echo $row['pid']; ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-lg">&nbsp;</i> Delete</a>
      </td>
    </tr>
  <?php } ?>
</tbody>
</table>
</div>

<div class="col-md-4">
  <form class="form form-inline bg-secondary " method="post" action="process.php" >
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="input-group">
        <label>Date</label>
       <input type="text" name="added_date" value="<?php echo date("Y-m-d") ?>" required>
    </div>
    <div class="input-group">
            <label>Category</label>
            <select class="form-control" id="select_cat" name="category_name" required>
                <?php 

                  require './database/db.php';
                  $query = "SELECT * FROM `categories`";
                  $result = mysqli_query ($connect, $query);
                  while ($row=mysqli_fetch_array($result)) { 
                   $cat_name = $row['category_name'];
                   echo "<option value='".$cat_name."' ".((isset($category_name) and $category_name == $cat_name)?"selected":"").">".ucfirst($cat_name)."</option>";

                  } ?>
            </select>
          </div>
    <div class="input-group">
            <label>Brand</label>
            <select class="form-control" id="select_brand" name="brand_name"  required>
              
               <?php 

                  $brand_query = "SELECT * FROM `brands`";
                  $brand_result = mysqli_query ($connect, $brand_query);
                  while ($brand_row=mysqli_fetch_array($brand_result)) {
                  $b_name = $brand_row['brand_name'];
                  echo "<option value='".$b_name."' ".((isset($brand_name) and $brand_name == $b_name)?"selected":"").">".ucfirst($b_name)."</option>";
                 }?>
              
            </select>
          </div>
    <div class="input-group">
        <label>Product Name</label>
       <input type="text" name="product_name" value="<?php echo $product_name; ?>" required>
    </div>
    <div class="input-group">
        <label>Product Quantity</label>
       <input type="text" name="product_qty" value="<?php echo $product_qty; ?>" required>
    </div>
    <div class="input-group">
        <label>Product price</label>
       <input type="text" name="product_price" value="<?php echo $product_price; ?>" required>
    </div>

    <!--product price start-->

<!--product price end-->


    <div class="input-group">
      <?php if ($update == true): ?>
  <button class="btn btn-lg btn-success" type="submit" name="update_product" ><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true">&nbsp;</i>
update</button>
<?php else: ?>
  <button class="btn btn-lg btn-success" type="submit" name="submit_product" ><i class="fa fa-plus fa-lg" aria-hidden="true">&nbsp;</i>
Add</button>
<?php endif ?>
    </div>
  </form>
</div>


</div>



  <script type="text/javascript">
      function ConfirmDelete()
      {
            if (confirm("Delete Account?"))
                 location.href='linktoaccountdeletion';
      }
  </script>
</body>
</html>
