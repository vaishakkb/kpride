<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<?php include('../connection.php'); 
require('CurrencyConverter.php');
$x = new CurrencyConverter($dbhost,$dbuser,$dbpwd,$dbschema,'tbl_currency');
?>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>PMP Project Management Professional Training | Knowledgepride</title>
<?php require('../common/headercss.php'); ?>
<link href="<?php echo $myDomainUrl; ?>plugins/tinybox/tinybox.css" rel="stylesheet">
<script src="<?php echo $myDomainUrl; ?>plugins/tinybox/tinybox.js"></script>

<script language="javascript" type="text/javascript">

function getXMLHTTP() { //fuction to return the xml http object
        var xmlhttp=false;	
        try{
            xmlhttp=new XMLHttpRequest();
        }
        catch(e)	{
            try{			
                xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
            }
            catch(e){
                try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }
                catch(e1){
                    xmlhttp=false;
                }
            }
        }
        return xmlhttp;
    }
    
    function searchEvents() {
        document.getElementById("mySearch").submit();
    }
    
    function checkCity() {
        var country_id = document.getElementById("country").value;
        if(country_id!='select')
        {
            getCity(country_id);
        }
    }
    
    function getCity(countryId) {	
        var city_param = "";
        var city_param = setCityName('city');
        if(city_param == "")
        {
            var strURL='project-management-professional-training/'+countryId;
        }
        else 
        {
            var strURL='project-management-professional-training/'+countryId+'/'+city_param+'/';
        }
        var req = getXMLHTTP();
        
        if (req) {
            req.onreadystatechange = function() {
                if (req.readyState == 4) {
                    // only if "OK"
                    if (req.status == 200) {							
                        document.getElementById('citydiv').innerHTML=req.responseText;
                        } else {
                        //alert("There was a problem while using XMLHTTP:\n" + req.statusText);
                    }
                }				
            }			
            req.open("GET", strURL, true);
            req.send(null);
        }
    }
    
    /*** Get the city name from url ***/
    function setCityName(name)
    {
      name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
      var regexS = "[\\?&]"+name+"=([^&#]*)";
      var regex = new RegExp( regexS );
      var results = regex.exec( window.location.href );
      if( results == null )
        return "";
      else
        return results[1];
    }
</script>

</head>
<body>
<!-- Pre Loader -->
<div id="loader"></div>
<!--Header-->
<?php require('../common/menu.php'); ?>
<!-- START Banner -->
<section class="mainBanner">
  <div class="container">
    <div class="banCont">
      <h3>Pride Knowledge from</h3>
      <h1>KnowledgePride</h1>
    </div>
  </div>
</section>

<!-- END Banner -->

<!--START Course Schedule Section-->
<section class="scheduleSection">
	<div class="selectCountry">
		<div class="container">
			<div class="row text-center">
					<form name="mySearch" id="mySearch" action="" method="get">
     					<div class="col-lg-6">
            	    		<label>Select Country</label>
	            			<select name="country" id="country" onchange="searchEvents();getCity(this.value);" class="search-select-box form-control">
								<?php
								if(isset($_REQUEST['country'])){
								$country = $_REQUEST['country'];
								echo "<option selected value='$country'>-$country-</option>";
								}else{
								?>
								<option value="select">Select Country</option>
								<?php
								}
								$check2 = mysql_query("SELECT DISTINCT(Country) FROM country_city ORDER BY Country ASC");
								while($row2=mysql_fetch_array($check2)){
								?>
								<option value="<?php echo $row2['Country'] ?>"><?php echo $row2['Country'] ?></option>
								<?php
								}
								?>
							</select>
        				</div>
        				<div class="col-lg-6">
          					<label>Select City:</label>
				        	<select name="city" id="city" onchange="searchEvents();" class="search-select-box form-control">
								<?php
								if(isset($_REQUEST['city'])){
								$cityname = $_REQUEST['city'];
								echo "<option selected value='All'>-$cityname-</option>";
								}else{
								?>
								<option value="All">Select City</option>
								<?php
								}
								if(isset($_REQUEST['country'])){
								$c = $_REQUEST['country'];
								$check3 = mysql_query("SELECT City FROM country_city WHERE Country='$c'  ORDER BY City ASC");
								while($row3=mysql_fetch_array($check3)){
								?>
								<option value="<?php echo $row3['City'] ?>"><?php echo $row3['City'] ?></option>
								<?php
								}}
								?>
							</select>
        				</div>
   					</form>
			</div>
		</div>
	</div>
<div class="container">
				
				<div class="table-responsive sch_table">
       	       		<?php if(isset($_REQUEST["country"] , $_REQUEST["city"])){ ?>
            		<table class="table table-bordered text-center">
	                	<thead>
	                		<tr>
		                    	<?php if(isset($_REQUEST["country"] , $_REQUEST["city"])){ 
		                    	$q=$_REQUEST["country"];
								$r=$_REQUEST["city"];
								$s="PMP";
		                    	?>
		                        <th colspan="1"></th>
		                        <th colspan="3" align="center">Country : <span style="font-weight:bold;color:green;"><em><?php echo $q; ?></em></span></th><th colspan="2" align="center">City: <em><span style="font-weight:bold;color:green;"><?php echo $r; ?></em></span></th><th colspan="5" align="center">Course: <em><span style="font-weight:bold;color:green;"><?php echo $s; ?></em></span></th>
		                        <?php } ?>
	                    	</tr>	
	                  		<tr>
			                    <th>Date</th>
			                    <th>City</th>
			                    <th>Course</th>
			                    <th>Venue</th>
			                    <th>Standard Price</th>
			                    <th>Early Bird Price</th>
			                    <th>Early Bird Date</th>
			                    <th>Status</th>
	                  		</tr>
	                	</thead>
	                	<tbody>
		                	<?php
		                	if($q != null && $r == "All")
							{
							   $sqlQ = "SELECT * FROM schedule WHERE schedule.Country = '$q' AND schedule.CourseTitle = '$s' ORDER BY FDate ASC";
							}elseif($q != null && $r != "All")
							{
							   $sqlQ = "SELECT * FROM schedule WHERE schedule.Country = '$q' AND schedule.City= '$r' AND schedule.CourseTitle = '$s' ORDER BY FDate ASC";
							}
							$check = mysql_query($sqlQ) or die (mysql_error());
							$count= mysql_num_rows($check);
							if($count>0){
							while($rows=mysql_fetch_array($check)){
							$uid = $rows['Trainer'];
							$StdPrice = $rows['StdPrice'];
							$EBPrice = $rows['EBPrice'];
							//	$id = $rows['id'];
							$crry = $rows['currency'];
							$fDate = date("d-M-Y",strtotime($rows['FDate']));
							$tDate = date("d-M-Y",strtotime($rows['TDate']));
							$EDate = date("d-M-Y",strtotime($rows['EBDate']));
							$q=$rows['Country'];
							?>
		          			<tr>
			                    <td><?php echo $fDate." - ".$tDate ?></td>
			                    <td><?php echo $rows['City'] ?></td>
			                    <td><?php echo $rows['CourseTitle'] ?></td>
			                    <td><?php $ven_id = $rows['id']?><a href="#" onclick="TINY.box.show({url:'../Venuedetails.php?jai=<?php echo $rows['id']?>' ,width:300,height:300})">click</a></td>
			                    <td>
			                    	<?php 
									if($q!="India" && $q!="Saudi Arabia" && $q!="United States"){
										echo $crry." ".$x->convert($StdPrice,'USD',$crry)." - USD ".$StdPrice;
									}elseif($q="India"){
										echo $crry." ".$x->convert($StdPrice,'USD',$crry);
									}elseif($q="United States"){
										echo "USD ".$StdPrice;
									}elseif($q="Saudi Arabia"){
										echo "USD ".$StdPrice;
									}else{
										echo "nothing";
									}
									?>
			                    </td>
			                    <td>
								<?php 
								if($q!="India" && $q!="Saudi Arabia" && $q!="United States"){
										echo $crry." ".$x->convert($EBPrice,'USD',$crry)." - USD ".$EBPrice;
									}elseif($q="India"){
										echo $crry." ".$x->convert($EBPrice,'USD',$crry);
									}elseif($q="Saudi Arabia"){
										echo "USD ".$EBPrice;
									}elseif($q="United States"){
										echo "USD ".$EBPrice;
									}else{
										echo "nothing";
									}
									?>
			                   	</td>
			                    <td><?php echo $EDate ?></td>
			                    <td>
									<?php 
									$now= date("m/d/Y");
									if(strtotime($tDate) < strtotime($now)){
									echo '<span class="btn warning">Closed</Span>';
									}else{
										echo '<a href="CT_Cart?add='.$rows['id'].'"><button class="btn btn-primary btn-sm">Register</button></a>';
									}
									?>
			                   	</td>
		                  	</tr>
	                  	  <?php 
						  }}
						  else
						  {
							 echo'<tr><td colspan="9" style="text-align:center;font-weight:bold;color:red;">No Workshop Scheduled!<br><br><span style="font-weight:bold;color:green;">Contact Us @ <a href="mailto:support@bestcareerleap.com">support@bestcareerleap.com</a> for Group Nomination</span></td></tr>';
						  }
						   ?>
                		</tbody>
              		</table>
              		<?php } ?>
       			</div>
			</div>
</section>
<!--END Course Schedule Section-->
<!--footer start-->
<?php require('../common/footer.php'); ?>
<?php require('../common/footerjs.php'); ?>
</body>
</html>
