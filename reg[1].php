<?php
	include("config.php");
	if(isset($_POST['btnreg']))
	{
		$flname = $_POST['fullname'];
		$nicno = trim(addslashes($_POST['nic']));
		$addr = $_POST['address'];
		$date = addslashes($_POST['regdate']);
		
		$errors = "";
		if(empty($flname))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							Fullname Must be Entered!</div>';
		}

		if(empty($nicno))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							NIC Must be Entered!</div>';;
		}

		if(empty($addr))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							Address Must be Entered!</div>';;
		}
		if(empty($date))
		{
			$errors.= '<div class="alert alert-danger" role="alert">
							Date Must be Entered!</div>';;
		}
		
		
		if($errors == "")
		{
			$con = mysqli_connect($host,$uname,$pswrd,$dbname);
			$query = "INSERT INTO usertbl(`fullname`, `nic`, `address`, `date`) VALUES('$flname','$nicno','$addr','$date')";
			
			if(mysqli_query($con,$query))
			{
				$results = '<div class="alert alert-success" role="alert">
							Registration Successful</div>';
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
		    <img src="images/logo.png" style="width: 180px; height: 180px; float: left; margin-left: 200px;" ><h1><center>Customer Registration</center></h1>
		</div>
	</div>
	<div class="panel-body">
		<div class="form-group">
        	<div class="col-sm-12">
            	<?php
            		if(isset($_POST['btnreg']))
					{
						echo $errors; 
						echo $results;
					}
				?>    
      		</div>
      	
    	</div>
    	<div class="row">
      		<div class="col-sm-8" >
      			<h2>Enter details to complete your registration</h2>
				<form role="form" class="form-horizontal" action="reg.php" method="post">
					<div class="row form group">
						<br>
						<label class="col-sm-3" >Full Name : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="fullname" placeholder="Enter full name" data-validation="required" data-validation-error-msg="Full name must be entered!">
						</div>
					</div>
					<div class="row form group">
						<br>
						<label class="col-sm-3" >NIC Number : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="nic" required pattern="[0-9]{9}[V,X]{1}|[0-9]{12}" placeholder="123456789V or 123456789123" data-validation-error-msg="Please enter a proper NIC number!">
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Address : </label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="address" placeholder="Enter your address" data-validation="required" data-validation-error-msg="Address is Required!">
						</div>
					</div>

					<div class="row form group">
						<br>
						<label class="col-sm-3" >Date : </label>
						<div class="col-sm-4">
							<input type="date" class="form-control" name="regdate" readonly value="<?php echo date('Y-m-d')?>">
						</div>
					</div>

					<br>
					<button type="submit" class="btn-primary" name="btnreg"><span class="glyphicon glyphicon-upload"></span> Submit </button>

				</form>
      		
			</div>
			<div class="col-sm-4">
				<h3>How to <b>Avoid</b> getting struck by lightning!</h3>
				<div id="slidecaution" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				<ol class="carousel-indicators">
					<li data-target="#slidecaution" data-slide-to="0" class="active"></li>
					<li data-target="#slidecaution" data-slide-to="1"></li>
					<li data-target="#slidecaution" data-slide-to="2"></li>
					<li data-target="#slidecaution" data-slide-to="3"></li>
					<li data-target="#slidecaution" data-slide-to="4"></li>
					<li data-target="#slidecaution" data-slide-to="5"></li>
				</ol>

				  <!-- Wrapper for slides -->
				<div class="carousel-inner">
					<div class="item active">
					  <img src="images/caution6.png" alt="caution6">
					</div>

					<div class="item">
					  <img src="images/caution5.png" alt="caution5">
					</div>
					
					<div class="item">
					  <img src="images/caution4.png" alt="caution4">
					</div>
					
					<div class="item">
					  <img src="images/caution3.png" alt="caution3">
					</div>
					
					<div class="item">
					  <img src="images/caution2.png" alt="caution2">
					</div>
					
					<div class="item">
					  <img src="images/caution1.png" alt="caution1">
					</div>
				</div>

				  <!-- Left and right controls -->
				  <a class="left carousel-control" href="#slidecaution" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
					<span class="sr-only">Previous</span>
				  </a>
				  <a class="right carousel-control" href="#slidecaution" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
					<span class="sr-only">Next</span>
				  </a>
				</div>
				
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
