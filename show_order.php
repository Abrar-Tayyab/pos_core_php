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

<?php  include('./process.php'); ?>


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

<div class="col-md-9">

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
      <th>Total Amount</th>
      <th>Date</th>
      <th colspan="2">Action</th>
      
    </tr>
  </thead>
  <?php $results = mysqli_query($connect,"SELECT * FROM `order` ORDER BY oid DESC"); ?>
  <?php while ($row = mysqli_fetch_array($results)) { ?>
  <tbody id="myTable">
    <tr>
      <td><?php echo $row['category_name']; ?></td>
      <td><?php echo $row['brand_name']; ?></td>
      <td><?php echo $row['product_name']; ?></td>
      <td><?php echo $row['product_price']; ?></td>
      <td><?php echo $row['product_qty']; ?></td>
      <td><?php echo $row['total_amount']; ?></td>
      <td><?php echo $row['added_date']; ?></td>

      <td>
        <a onClick="return confirm('Are you sure you want to delete?')" name="del_order" href="process.php?del_order=<?php echo $row['oid']; ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-lg">&nbsp;</i> Delete</a>
      </td>
      
    </tr>
  <?php } ?>
</tbody>
</table>
</div>




</div>

</body>
</html>
