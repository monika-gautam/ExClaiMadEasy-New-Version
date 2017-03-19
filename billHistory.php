<? session_start(); ?>
<html>
<head>
	<title> Bill Claims Management Application</title>
	<link rel="stylesheet" type="text/css" media="all" href="/jsdate/jsDatePick_ltr.min.css" />
	<link rel="stylesheet" href="https://unpkg.com/purecss@0.6.2/build/pure-min.css">
	<script type="text/javascript" src="/jsdate/jsDatePick.min.1.3.js"></script>
	<script language="javascript">
	function show_date(){
		document.myForm.action="show_date.php";
		document.myForm.submit();
	} 
	function home(){
		document.myForm.action="home.php";
		document.myForm.submit();
	}
	</script>
</head>
<body>
	<form class="pure-form pure-form-stacked" name="myForm" method="post">
		<center>
			<br>
			<h2><legend>Enter details to see historical data</legend></h2>
			<?php
			$dbhandle = mysqli_connect("localhost", "root", "123456","cabBills")
			or die("Unable to connect to MySQL");
			$id=$_SESSION['id'];
	        $name=$_SESSION['name'];
	        $emailid=$_SESSION['emailid'];
			$s1="select distinct id from employee";
			$r1= mysqli_query($dbhandle,$s1);
			
			?>
			<input type="hidden" name="screen" value="0">
			<br>
			<br>
			<div id="mydiv">
				<table class="pure-table pure-table-bordered">
				<thead>
						<tr>
							<th>Bill Type:</th>
								<td>
									<select name="bill_type">
				                       <option selected value="CAB">CAB
					                   <option value="MEAL"> MEAL
					                </select>
								</tr>
</thead>
					<tbody>
						<tr>
							<th>Employee ID:</th>
								<td>
									<input id="id" type="text" name="id" value="<?= $id ?>" readonly>
								</tr>
</tbody>

								</table>
								<br>
								<center>
								     <input type="button" class="pure-button pure-button-primary" value="Submit" onClick="show_date()">
									<input type="button" class="pure-button pure-button-primary" value="Back" onClick="home()"/>
								</div>
							</form>
						</body>
						</html>
