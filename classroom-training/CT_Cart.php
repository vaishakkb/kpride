<?php session_start(); ?>
<?php
include('../connection.php'); 
$page='cart';

if(isset($_GET['add'])){

$quantity=mysql_query("select * from schedule where id=".mysql_real_escape_string((int)$_GET['add'])) or die (mysql_error());

while($quantity_row=mysql_fetch_assoc($quantity)){

if($quantity_row['Duration']!=$_SESSION['cart_'.(int)$_GET['add']]){

$_SESSION['cart_'.(int)$_GET['add']]+='1';
}
}
header('location:'.$page);
}

if(isset($_GET['remove'])){
$_SESSION['cart_'.(int)$_GET['remove']]--;
header('location:'.$page);

}

if(isset($_GET['delete'])){
$_SESSION['cart_'.(int)$_GET['delete']]='0';

header('location:'.$page);
}

?>

		
<?php

function cart()
{
	foreach($_SESSION as $name=>$value)
	{
  		if($value>0)
  		{
  			if(substr($name,0,5)=='cart_')
  			{
				$id=substr($name,5,(strlen($name)-5));
				$get=mysql_query('select * from schedule WHERE id='.mysql_real_escape_string((int)$id)) or die (mysql_error());
				while($get_row=mysql_fetch_assoc($get)){
				$today = date("m/d/Y");
				$earlyday = $get_row['EBDate'];
				//$sub=$get_row['StdPrice']*$value;
?>
				<tr class="cart-item">
				<td><?php echo $get_row['CourseTitle']."-".$get_row['City']?></td>
				<td><?php echo $value; ?></td>
        		<?php 
        		if ($value=='1')
        		{?>
        			<td><?php echo '<i class="fa fa-minus-square" aria-hidden="true"></i>' ?></td>
        			<?php 
				}
				else
				{ ?>
        			<td><?php echo '<a href="CT_Cart?remove='.$id.'";><i class="fa fa-minus-square" aria-hidden="true"></i>' ?></td>
        			<?php 
				} ?>
				<td><?php echo '<a href="CT_Cart?add='.$id.'" ;><i class="fa fa-plus-square" aria-hidden="true"></i>' ?></td>
				<td><?php 
				if(strtotime($earlyday) >= strtotime($today))
				{
					echo "$".$get_row['EBPrice'];
					$sub=$get_row['EBPrice']*$value;
				}else
				{
					echo "$".$get_row['StdPrice'];
					$sub=$get_row['StdPrice']*$value;
				}
				//echo '$'.number_format($get_row['StdPrice']); 
				?></td>
				<td>
				<?php 
				$total='';
				$gtotal = isset($_POST['value']) ? $_POST['value'] : '';
		$total += $sub;
		if(!isset($total)){
		//	echo "Your card is empty";
		}
		else{
			echo "$".number_format($total,2);
			$gtotal += $total;
			
		?>
		</td>
		
		
		<td>
		<?php
		
		if($value<=2)
		 {
			echo "<span style='color: #178900;'><strong><em><b>3 %</b></em></strong></span>";
			$discount5 = (3/ 100)*$total;
			echo " ($ ".number_format($discount5,2).")";
		}	
		elseif($value >=3 && $value <=4)
		 
		 {
			echo "<span style='color: #178900;'><strong><em><b>5 %</b></em></strong></span>";
			$discount5 = (5/ 100)*$total;
			echo " ($ ".number_format($discount5,2).")";
		}	
		elseif($value >=5 && $value <=9)
		 
		 {
			echo "<span style='color: #178900;'><strong><em><b>10 %</b></em></strong></span>";
			$discount5 = (10/ 100)*$total;
			echo " ($ ".number_format($discount5,2).")";
		}	
		elseif($value>=10)
		 
		 {
			echo "<span style='color: #178900;'><strong><em><b>15 %</b></em></strong></span>";
			$discount5 = (15/ 100)*$total;
			echo " ($ ".number_format($discount5,2).")";
		}	
		?>
		</td>
		<td>
		<?php 
		$total='';
		$total += $sub;
		
		 if($value<=2)
		 {
		 	$discount4 = (97/ 100)*$total;
			
		}	
		elseif(($value >=3) && ($value <=4))
		 {			
		 	$discount4 = (95/ 100)*$total;
		}
		elseif(($value >=5) && ($value <=9))
		 {			
		 	$discount4 = (90/ 100)*$total;
		}
		 elseif($value >=10)
		 {			
		 	$discount4 = (85/ 100)*$total;
		}	
		
		?>
		<?php 
		$total='';
		$total += $sub;
		
		 if($value<=2)
		 {
		 	$discount = (97/ 100)*$total;
		 	echo "$ ".number_format($discount,2);
		}	
		elseif($value >=3 && $value <=4)
		 {			
		 	$discount = (95/ 100)*$total;
			echo "$ ".number_format($discount,2);
		}	
		elseif($value >=5 && $value <=9)
		 {			
		 	$discount = (90/ 100)*$total;
			echo "$ ".number_format($discount,2);
		}	
		 elseif($value >=10)
		 {			
		 	$discount = (85/ 100)*$total;
			echo "$ ".number_format($discount,2);
		}	
		
		$discount1 += $discount;
		?>
		
		</td>
        <td><?php echo '<a href="CT_Cart?delete='.$id.'" ;><i style="color:red;" class="fa fa-times" aria-hidden="true"></i>' ?></td>
		</tr>
		<?php
		}
	}
  }
}
}
?>
<tr class="total">
	<th colspan="6"></th>
	<th>Gross Pay</th>
	<td colspan="1">
	<?php
	if(!isset($discount1)){
		echo "";
	}
	else{
		echo "$ ".number_format($discount1,2);
		}
	?>
	</td><td></td>
</tr>
<tr>
<?php include 'cart_bottom_content.php' ?>
</tr>
<?php
}
?>