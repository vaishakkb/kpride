<?php
$TAD = "";
if(isset($_POST['smtCoupon'])){
$coupon= $_POST["coupon"];
$gtotal= $_POST["discount1"];
$sql=mysql_query("SELECT * from discount where c_generatecoupan='$coupon' AND c_member='$_SESSION[email]'");
$drow=mysql_fetch_array($sql);

$discoupon=$drow['c_generatecoupan'];
$dis=$drow['c_discount'];
//echo "discount".$dis;

$discount = $gtotal*$dis/100;
$total = $gtotal-$discount;


if($coupon=="" || $coupon!==$discoupon){
	echo "<div>you have entered wrong discount code for assistance please mail to <a href='mailto:support@bestcareerleap.com'>support@bestcareerleap.com</a></div>";
}
else{
$TAD = number_format($total);
echo "<div class='gen-discount'>Total after deducting discount $".$TAD.'</div>';
}

}
?>



	<td  colspan="4">
	<span>View Our Refund Policy!</span><br>
	<b><a href="http://localhost:8080/kp/terms-condition" target="blank">Click Here</a></b>
	</td>
	<td align="right" colspan="5">
	<?php
	if(isset($_SESSION['email'])){
	if($TAD=="" || $TAD=="0"){
			$GTA = $discount1;
		}else{
			$GTA = $TAD;
		}
	?>
	<form name="jayesh" method="post" action="payment-in">
	<input type="hidden" name="CourseTitle" value="<?php echo $get_row['CourseTitle'];?>"/>
	<input type="hidden" name="Quantity" value="<?php echo $value ?>"/>
	<input type="hidden" name="t" value="<?php echo $GTA ?>">
	<input type="hidden" name="v" value="<?php echo $value ?>">
	<button type="submit" name="bcl_payment" class="btn btn-primary btn-flat pull-right">Proceed to Checkout <i class="fa fa-chevron-right"></i></button>
	</form>

	<?php
	}else{
		//$c=$get_row['CourseTitle'];
		if($TAD=="" || $TAD=="0"){
			$GTA = $discount1;
		}else{
			$GTA = $TAD;
		}

	?>
	<form action="payment-in" method="post">
	<input type="hidden" name="t" value="<?php echo $GTA ?>">
	<input type="hidden" name="v" value="<?php echo $value ?>">
	<button type="submit" name="bcl_payment" class="btn btn-primary btn-flat">Proceed to Checkout <i class="fa fa-chevron-right"></i></button>
	</form>
	
	<!--<span style="float:right;"><a href="payment-in.php?t=<?php echo $GTA ?>&v=<?php echo $value ?>" class="iframe" style="text-decoration:none;color:#fff;"><img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" align="left" style="margin-right:7px;"></a><span>-->

	<?php
	}
	?>
	</td>
	