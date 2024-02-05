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

<?php 			$results = mysqli_query($connect,"SELECT SUM(total_amount) AS totalsum FROM `order`;"); 
					while ($row = mysqli_fetch_array($results)) {
						$totalsum=$row['totalsum'];
            } 
 ?>

<?php       $results_today = mysqli_query($connect,"SELECT SUM(total_amount) AS totalsum FROM `order` WHERE added_date=DATE(NOW()) "); 
          while ($row_today = mysqli_fetch_array($results_today)) {
            $totalsumtoday=$row_today['totalsum'];
            } 
 ?>

<?php
        $get_product_qty = "SELECT * FROM `order` WHERE added_date = DATE(NOW()) ";
        $get_product_qty_run = mysqli_query($connect,$get_product_qty);
        $qty = mysqli_num_rows($get_product_qty_run);
?>

<?php
				$get_product_qty = "SELECT * FROM product WHERE product_qty != 0";
        $get_product_qty_run = mysqli_query($connect,$get_product_qty);
        $product_qty = mysqli_num_rows($get_product_qty_run);
?>

<?php
        $get_categories = "SELECT * FROM categories";
        $get_categories_run = mysqli_query($connect,$get_categories);
        $categories_qty = mysqli_num_rows($get_categories_run);
?>

<?php
        $get_brand = "SELECT * FROM brands";
        $get_brand_run = mysqli_query($connect,$get_brand);
        $brand_qty = mysqli_num_rows($get_brand_run);
?>

<head>
	<title> Inventory System </title>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" type="text/css" href="./include/style.css">
    <link href="./include/bootstrap.min.css" rel="stylesheet">
  
    <script type="text/javascript" src="./js/main.js"></script>
</head>
<body>
<!-- navbar -->
<?php 

include_once("./templates/header.php"); ?>

		<br/><br/>

	<div class="container">
		
			<div class="row tag-boxes">
                            <div class="col-md-6 col-lg-4">
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge"><?php echo $totalsum;?></div>
                                    <div class="text-right"><h5>Order Amount</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="show_order.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Orders</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                              <div class="panel panel-primary">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-pencil-square fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge">
                                      <?php
                                      if ($totalsumtoday > 0) {
                                        echo $totalsumtoday;
                                      }
                                      ?>
                                    </div>
                                    <div class="text-right"><h5>Today Order Amount</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="today_order.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Order</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>

                             <div class="col-md-6 col-lg-4">
                              <div class="panel panel-red">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-pencil-square-o fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge">
                                      <?php
                                      if ($qty > 0) {
                                        echo $qty;
                                      }
                                      ?>
                                    </div>
                                    <div class="text-right"><h5>Today Order</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="today_order.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Order</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>
                            
</div>
      <div class="row tag-boxes">

                            <div class="col-md-6 col-lg-4">
                              <div class="panel panel-red">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-tags fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge">
                                      <?php
                                      if ($product_qty > 0) {
                                        echo $product_qty;
                                      }
                                      ?>
                                    </div>
                                    <div class="text-right"><h5>Products Available</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="show_product.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Products</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>

                            <div class="col-md-6 col-lg-4">
                              <div class="panel panel-yellow">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge">
                                      <?php
                                      if ($categories_qty > 0) {
                                        echo $categories_qty;
                                      }
                                      ?>
                                      </div>
                                    <div class="text-right"><h5>Categories Available</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="show_category.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Categories</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4">
                              <div class="panel panel-green">
                                <div class="panel-heading">
                                  <div class="row">
                                  <div class="col-xs-3">
                                    <i class="fa fa-th-large fa-5x"></i>
                                  </div>
                                  <div class="col-xs-9">
                                    <div class="text-right huge">
                                      <?php
                                      if ($brand_qty > 0) {
                                        echo $brand_qty;
                                      }
                                      ?>
                                    </div>
                                    <div class="text-right"><h5>Brand Available</h5></div>
                                  </div>
                                </div>

                                </div>
                                <a href="show_brand.php">
                                  <div class="panel-footer">
                                    <span class="pull-left"><h5>View All Brands</h5></span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                  </div>
                                </a>
                              </div>
                            </div>

                            

	</div>
	


</body>
</html>
