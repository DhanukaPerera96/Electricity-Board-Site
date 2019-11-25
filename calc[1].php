<?php
	include("config.php");
	if(isset($_POST['btncal']))
	{
		$nicno = trim(addslashes($_POST['nic']));
		$crunits = trim(addslashes($_POST['uni']));
		$today = addslashes($_POST['to']);
		
		$errors = "";
		if(empty($nicno))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							NIC Must be Entered!</div>';
		}
		if(empty($crunits))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							Number of units Must be Entered!</div>';
		}
		if(empty($today))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							The date must be entered!</div>';
		}
		
		if($errors == "")
		{
			$con = mysqli_connect($host,$uname,$pswrd,$dbname);
			$query = "SELECT `units`,`date`,nic FROM `usertbl` WHERE nic LIKE '$nicno'";
			$results = mysqli_query($con,$query);
			
			$numofres = mysqli_num_rows($results);
			
			while($row = mysqli_fetch_array($results))
			{
				$olduni = $row['units'];
				$lastbd = $row['date'];
				$nicnumber = $row['nic'];
				
				$diff = (strtotime($today) - strtotime($lastbd))/(60*60*24);
				
			}
			$totuni = $crunits - $olduni;
			
			if($totuni<=60)
			{	
				
				if($totuni<=$diff)
				{
					$totfixed = 30;
					$totkwh = ($totuni * 2.50);
					$totalamt = $totkwh+$totfixed;
				}
				else
				{
					$totfixed = 60;
					$totkwh = ($diff * 2.50) + (($totuni-$diff)*4.85);
					$totalamt = $totkwh+$totfixed;
				}
			}
			else
			{
				if($totuni<=($diff*3))
				{
					$totfixed = 90;
					$totkwh =  (($diff*2)*7.85) +(($totuni-($diff*2))*10);
					$totalamt = $totkwh+$totfixed;
				}
				if($totuni >($diff*3) and $totuni<=($diff*4))
				{
					$totfixed = 480;
					$totkwh =  (($diff*2)*7.85) +($diff*10)+(($totuni-($diff*3))*27.75);
					$totalamt = $totkwh+$totfixed;
				}
				if($totuni>($diff*4) and $totuni<=($diff*6))
				{
					$totfixed = 480;
					$totkwh = (($diff*2)*7.85) + ($diff*10) +($diff*27.75)+(($totuni-($diff*4))*32);
					$totalamt = $totkwh+$totfixed;
				}
				if($totuni>($diff*6))
				{
					$totfixed = 540;
					$totkwh = (($diff*2)*7.85) + ($diff*10) +($diff*27.75)+(($diff*2)*32)+(($totuni-($diff*6))*45);
					$totalamt = $totkwh+$totfixed;
				}
			}
			
			$query = "UPDATE `usertbl` SET `date` = '$today', `units` = '$crunits' WHERE `usertbl`.`nic` = '$nicno'";
			
			if(mysqli_query($con,$query))
			{
				$results = '<div class="alert alert-success" role="alert">
							Update Successful</div>';
			}
			else{
				$results = '<div class="alert alert-danger" role="alert">
						Registration Unsuccessful</div>';
			}
		}
		
	}
	
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Untitled Document</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style/stylecss.css">

	
	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> 
	
	<!-- Jquery form validator plugin-->
	 <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> 
	
	
</head>

<body class="container-fluid">
	<div class="panel-heading">
		<div id="coverwall">
			<div id="navcont">
				<div id="navi">
			  		<a href="calc.php">Calculate</a>
			  		<a href="reg.php" >Register</a>
			  		<a href="Elec.php">Home</a>
				</div>
			</div>
		    <img src="images/logo.png" style="width: 180px; height: 180px; float: left; margin-left: 200px;" ><h1><center>Online Services</center></h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="col-sm-12">
            <?php
            	if(isset($_POST['btncal']))
				{
					echo $errors; 
				}
				?>    
      	</div>
      	<div class="row">
      		<div class="col-sm-6" >
      			<h2>Enter Details to calculate the Charge</h2>
				<form role="form" class="form-horizontal" action="calc.php" method="post">
					<br>
					<div class="row form group">
						<br>
						<label class="col-sm-3" >Enter NIC number : </label>
						<div class="col-sm-7">
							<input type="text" class="form-control" name="nic" required pattern="[0-9]{9}[V,X]{1}|[0-9]{12}" placeholder="123456789V or 123456789123" data-validation-error-msg="Please enter a valid NIC number!">
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Enter Current Units : </label>
						<div class="col-sm-7">
							<input type="number" class="form-control" name="uni" min="0" data-validation="required" data-validation-error-msg="Please enter the number of units!">
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Date : </label>
						<div class="col-sm-7">
							<input type="date" class="form-control" name="to" max="<?php echo date('Y-m-d'); ?>">
						</div>
					</div>

					<br>
					<button type="submit" class="btn-primary" name="btncal"><span class="glyphicon glyphicon-th"></span> Calculate </button>

				</form>

				<form role="form" method="post">
					<div class="row form group">
						<br>
						<label class="col-sm-3" >KWH Charge (LKR): </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="kwh" readonly placeholder="KWH charge" 
									value="<?php if(isset($_POST['btncal']))
										{
											echo $totkwh;
										} ?>">
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Fixed Charge (LKR): </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="fix" readonly placeholder="Fixed charge" 
									value="<?php if(isset($_POST['btncal']))
										{
											echo $totfixed;
										} ?>" >
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Total Amount (LKR): </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="tot" readonly placeholder="Total Amount" 
									value="<?php if(isset($_POST['btncal']))
										{
											echo $totalamt;
										} ?>" >
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >From : </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="lastday" readonly 
									value="<?php if(isset($_POST['btncal']))
										{
											echo $lastbd;
										} ?>" >
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >To : </label>
						<div class="col-sm-5">
							<input type="text" class="form-control" name="today" readonly 
									value="<?php if(isset($_POST['btncal']))
										{
											echo $today;
										} ?>" >
						</div>
					</div>
				</form>
     			<h3>How to Pay the Bill?</h3>
     			<p>Now you can pay your electricity bill easily online, through the mobile application, mCash or via supermarkets, post offices, banks and CEB Bill Collection Centers. To pay your bill via the website, visit Instant Bill Pay in Home Page.</p>
      		</div>
      		<div class="col-sm-6" >
      			<img src="images/mobileapp.png" style="width: 100%; height: 800px;">
      			
      		</div>
      	</div>
		
	</div>
	<div class="panel-footer">
		<p style="font-family: Constantia, 'Lucida Bright', 'DejaVu Serif', Georgia, 'serif'; color: white; text-align: center;" >&copy;- Ceylon Electricity Board - 2019</p>
	</div>
	
	<script>
		$.validate({
			modules: 'html5'
		});
			
	</script>
	
</body>
</html>
