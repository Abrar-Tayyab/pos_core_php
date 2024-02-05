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
<?php 
  if (isset($_GET['edit_b'])) {
    $id = $_GET['edit_b'];
    $update = true;
    $record = mysqli_query($connect, "SELECT * FROM brands WHERE bid=$id");

    if (mysqli_num_rows($record) == 1 ) {
      $n= mysqli_fetch_array($record);
      $b_name = $n['brand_name'];
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
      <th>Brand</th>
      
      <th colspan="2">Action</th>
    </tr>
  </thead>
  <?php $results = mysqli_query($connect,"SELECT * FROM `brands` ORDER BY bid DESC"); ?>
  <?php while ($row = mysqli_fetch_array($results)) { ?>
  <tbody id="myTable">
    <tr>
      <td><?php echo $row['brand_name']; ?></td>
      <td>
        <a name="edit_b" href="show_brand.php?edit_b=<?php echo $row['bid']; ?>"  class="btn btn-info" ><i class="fa fa-pencil fa-lg" aria-hidden="true">&nbsp;</i>Edit</a>
      </td>
      <td>
        <a onClick="return confirm('Are you sure you want to delete?')" name="del_b" href="process.php?del_b=<?php echo $row['bid']; ?>" class="btn btn-danger"><i class="fa fa-trash-o fa-lg">&nbsp;</i> Delete</a>
      </td>
    </tr>
  <?php } ?>
</tbody>
</table>
</div>


           <div class="col-md-4 ">
  <form class="form form-inline bg-secondary" method="post" action="process.php" >
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="input-group">
        <label>Name</label>
       <input type="text" name="brand_name" value="<?php echo $b_name; ?>" required>
    </div>
   
    <div class="input-group">
      <?php if ($update == true): ?>
  <button class="btn btn-success" type="submit" name="update_brand" ><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true">&nbsp;</i>update</button>
<?php else: ?>
  <button class="btn btn-success" type="submit" name="submit_brand" ><i class="fa fa-plus fa-lg" aria-hidden="true">&nbsp;</i>Add</button>
<?php endif ?>
    </div>
  </form>
</div>
</div>

</body>
</html>
