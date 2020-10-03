<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href ="login.css">
</head>
<body>
	<?php
	   $attendemp=$startemp=$endemp=$totalemp="";
	   $b=0;
		  if($_SERVER["REQUEST_METHOD"]=="POST"){

		  	 $attend=$_POST["attend"];
		  	 $start=$_POST["start"];
		  	 $end=$_POST["end"];
		  	 $total=$_POST["total"];
		  	 if(isset($attend)){
		    	if($attend=='NULL'){
		    	  $attendemp="You forget to select your qualification";
		    	 }
		    	 else{
		  	    	$b+=1;
		  	    }
		    }
		    if(empty($start)){
		  	 	$startemp="Start time is required";
		  	 }
		  	 else{
		  	    $b+=1;
		  	 }
		  	 if(empty($end)){
		  	 	$endemp="End time is required";
		  	 }
		  	 elseif ($start>$end or $start==$end) {
		  	 	$endemp="End time must be greater than Start";
		  	 }
		  	 else{
		  	    $b+=1;
		  	 }
		  	 if($total<1 or $total>24){
		  	 	$totalemp="Total time is required";
		  	 }
		  	 else{
		  	    $b+=1;
		  	 }
		}
		if($b==4){
			header('Location:success.html');
		}
	   ?>

	 <h3 style="color: #676767" align="center">"Your Registration is Successful. Please Check Your email."</h3>
	<h2> Login Form</h2>
	<div class="form">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
			<label for="fullname" > Attendence marking :  <span id="error"> * <?php echo $attendemp; ?></span></label>
			<select name="attend">
				<option value="NULL">Select.......</option>
				<option value="yes">Yes</option>
				<option value="no">No</option>
			</select>

			<label for="time" > Start Time : <span id="error"> * <?php echo $startemp; ?></span></label>
			<input type="time" name="start" >

			<label for="time" > End Time : <span id="error"> * <?php echo $endemp; ?></span></label>
			<input type="time" name="end">

			<label for="time" > Total Time Devoted : <span id="error"> * <?php echo $totalemp; ?></span></label>
			<input type="number"  name="total"><br><br>
			<center><input type="submit" name="submit"></center>
		</form>

</body>
</html>