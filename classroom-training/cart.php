<!DOCTYPE html>
<?php session_start(); ?>
<?php include 'CT_Cart.php'; ?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Cart Knowledgepride</title>
<?php require('../common/headercss.php'); ?>
</head>
<body>
<!-- Pre Loader -->
<div id="loader"></div>
<!--Header-->
<?php require('../common/menu.php'); ?>
<!--START Content-->
<section class="works_area section-no-padding ">
			<div class="container">
				<div class="table-responsive sch_table">
            		<table class="table table-bordered text-center">
	                	<thead>
	                  		<tr>
			                    <th>Course name</th>
			                    <th>Participant</th>
			                    <th>Minus</th>
			                    <th>Add</th>
			                    <th>Unit-Price</th>
			                    <th>Total</th>
			                    <th>Discount (%)</th>
			                    <th>Total Amount</th>
			                    <th>Delete</th>
	                  		</tr>
	                	</thead>
	                	<?php cart(); ?>
              		</table>
       			</div>
			</div>
		</section>
<!--END Content-->
<!--footer start-->
<?php require('../common/footer.php'); ?>
<?php require('../common/footerjs.php'); ?>
</body>
</html>