<?php

require './database/db.php';



	//add product

if (isset($_POST["submit_product"])) {
	$s_category = $_POST['category_name'];
	$s_brand = $_POST['brand_name'];
	$p_name = $_POST['product_name'];
	$p_price = $_POST['product_price'];
	$p_qty = $_POST['product_qty'];
	$a_date = $_POST['added_date'];

		 $query ="INSERT INTO `product` (category_name,brand_name,product_name,product_price,product_qty,added_date) VALUES ('$s_category', '$s_brand' , '$p_name' , '$p_price' , '$p_qty' , '$a_date')";

	 $result = mysqli_query($connect, $query) ;

	 if ($result) {
	 	header("location:show_product.php");
	 }else{
	 	echo "<script type='text/javascript'>alert(\"Product already added\")</script>";
        header("location:show_product.php");
	 }
}
	//add category

if (isset($_POST["submit_category"])) {


	$cat_name = $_POST['category_name'];

		 $query ="INSERT INTO `categories` (category_name) VALUES ('$cat_name')";

	 $result = mysqli_query($connect, $query);

	 if ($result) {
	 	header("location:show_category.php");
	 }
}
	//add brand

if (isset($_POST["submit_brand"])) {

	$b_name = $_POST['brand_name'];

		 $query ="INSERT INTO `brands` (brand_name) VALUES ('$b_name')";

	 $result = mysqli_query($connect, $query);

	 if ($result) {
	 	header("location:show_brand.php");
	 }
	}

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
			header("location:create_order.php");
			$error = "No More Item";
		}
		
	}


      							//Edit & Delete 
					
						//Edit & Delete category
		$cat_name = "";
		$id = 0;
		$update = false;

	if (isset($_POST['update_cat'])) {
		$id = $_POST['id'];
		$name = $_POST['category_name'];

		mysqli_query($connect, "UPDATE categories SET category_name='$name' WHERE cid=$id");
		header('location:show_category.php');
	}

	if (isset($_GET['del_c'])) {
		$id = $_GET['del_c'];
		mysqli_query($connect,"DELETE FROM categories WHERE cid=$id");
		header('location:show_category.php');
	}

							//Edit & Delete brand
	$b_name = "";
	$id = 0;
	$update = false;

	if (isset($_POST['update_brand'])) {
		$id = $_POST['id'];
		$b_name = $_POST['brand_name'];

		mysqli_query($connect, "UPDATE brands SET brand_name='$b_name' WHERE bid=$id");
		header('location:show_brand.php');
	}

	if (isset($_GET['del_b'])) {
		$id = $_GET['del_b'];
		mysqli_query($connect,"DELETE FROM brands WHERE bid=$id");
		header('location:show_brand.php');
	}




							//Edit & Delete product
	$added_date = "";
	$brand_name = "";
	$product_name = "";
	$category_name="";
	$product_price = "";
	$product_qty = "";
	$id = 0;
	$update = false;

	if (isset($_POST['update_product'])) {
		$id = $_POST['id'];
		$added_date = $_POST['added_date'];
		$brand_name = $_POST['brand_name'];
		$category_name=$_POST['category_name'];
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_qty = $_POST['product_qty'];

		mysqli_query($connect, "UPDATE `product` SET added_date='$added_date', brand_name='$brand_name', product_name='$product_name', category_name='$category_name', product_price='$product_price' , product_qty='$product_qty' WHERE pid=$id");
		header('location:show_product.php');
	}

	if (isset($_GET['del_product'])) {
		$id = $_GET['del_product'];
		mysqli_query($connect,"DELETE FROM `product` WHERE pid=$id");
		header('location:show_product.php');
	}

	// Delete order

	if (isset($_GET['del_order'])) {
		$id = $_GET['del_order'];
		mysqli_query($connect,"DELETE FROM `order` WHERE oid=$id");
		header('location:show_order.php');
	}

?>
