<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="modify.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<title>Registration Form</title>
</head>
<body>
	<?php
		  $nameemp=$dateemp=$qemp=$inemp=$internemp=$unemp=$pwdemp=$qualify="";
		  $a=0;
		  if($_SERVER["REQUEST_METHOD"]=="POST"){

		  	 $name=$_POST["name"];
		  	 $dob=$_POST["dob"];
		  	 $qualify=$_POST["qualify"];
		  	 $institute=$_POST["institute"];
		  	 $direction=$_POST["direction"];
		  	 $username=$_POST["username"];
		  	 $password=$_POST["password"];

		  	 $nameemp=empty_check($name,"Fullname");
		  	 $dateemp=empty_check($dob,"Date of Birth");
		  	 $inemp=empty_check($institute,"Institute name");
		  	 $unemp=empty_check($username,"Username");
		  	 $pwdemp=empty_check($password,"Password");

		  	 if(!empty($name)){
		  	 	$name=test_case($name);
		  	 	if(!preg_match("/^[a-zA-Z ]*$/", $name)){
		  	 		$nameemp="Only Characters and Space is allowed";
		  	    }
		  	    else{
		  	    	$a+=1;
		  	    }
		  	 }

		  	 if(!isset($_POST['intern'])){
		  	 	$internemp="Check atleast one interested field";
		  	 }
		  	 else{
		  	    	$a+=1;
		  	    }
		  	 if(!empty($dob)){
			  	 $today=date("Y-m-d");
			  	 $diff = date_diff(date_create($dob), date_create($today));
			  	 if($diff->format('%y%') < 15 or $diff->format('%y%') > 80){
				   $dateemp="you are too young or too old to register";
			     }
			     else{
		  	    	$a+=1;
		  	    }
		 	}
		    if(isset($qualify)){
		    	if($qualify=='NULL'){
		    	  $qemp="You forget to select your qualification";
		    	 }
		    	 else{
		  	    	$a+=1;
		  	    }
		    }
		  	 if(!empty($institute)){
		  	 	$institute=test_case($institute);
		  	 	if(!preg_match("/^[a-zA-Z ]*$/", $institute)){
		  	 		$inemp="Only characters and space is allowed";
		  	    }
		  	    else{
		  	    	$a+=1;
		  	    }
		  	 }
		  	 if(!empty($username)){
		  	 	$name=test_case($username);
		  	 	if(!filter_var($username,FILTER_VALIDATE_EMAIL)){
		  	 		$unemp="Invalid Email Format";
		  	    }
		  	    else{
		  	    	$a+=1;
		  	    }
		  	 }
		  	 if(!empty($password)){
		  	 	if(strlen($password)<8){
		  	 		$pwdemp="Your Password must conatain atleast 8 Characters";
		  	 	}
		  	 	elseif(!preg_match("/^[A-Z]+[a-z]+[0-9@!#$%^&*.]*$/", $password)){
		  	 		$pwdemp="Your password is too week";
		  	 	}
		  	 	else{
		  	    	$a+=1;
		  	    }
		  	 }
		  }
		  function test_case($data){
		  	$data=trim($data);
		  	$data=stripcslashes($data);
		  	$data=htmlspecialchars($data);
		  	return $data;
		  }
		  function empty_check($data,$value){
		  	if(empty($data)){
		  	 	return $value." is required";
		  	 }
		  	}
		 if($a==7){
	  	$headers="Response from Registration Form";
		$subject="Welcome mail";
		$to=$username;
		$body="Successfully Registered few more steps login here";

		if(mail($to,$subject,$body,$headers)){
			header('Location:login.php');
		}
		else{
			echo "<h3>Unable to send email. Please try again<h3>";
		}
	  }
    ?>
	<h2> Registration Form</h2>
	<div class="form">
		
		<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" >
			<label for="fullname" > Full Name :  <span id="error"> * <?php echo $nameemp; ?></span></label>
			<input type="text" name="name" placeholder="Enter Full Name" min="8" max="50"/>

			<label for="date" > Birth Date : <span id="error"> * <?php echo $dateemp; ?></span></label>
			<input type="date" name="dob"> 

			<label for="qualification" >Qualification :  <span id="error"> * <?php echo $qemp; ?></span></label>
			<select name="qualify" >
				    <option value="NULL">--------Select Qualification----------</option>
					<option value="B-Tech" >
							Bachelor of Technology (B-Tech)</options>
					<option value="B.Com">
							Bachelor of Commerce (B.Com)</options>
					<option value="M-Tech" >
							Master of Technology (M-Tech)</options>
					<option value="B.A" >
							Bachelor of Arts (B.A)</options>
				<optgroup label="Senior Secondary (Xll)">
					<option value="MPC" >(MPC)</option>
					<option value="BIPC">(BIPC)</option>
				</optgroup>
				<optgroup label="Secondary (X)">
					<option value="SSC">SSC</option>
					<option value="CBSE">CBSE</option>
				</optgroup>
			</select>

			<label for="institute" >Institute Name : <span id="error"> * <?php echo $inemp; ?></span></label>
			<input type="text" name="institute" placeholder="Enter Institute name">
			
			<fieldset align="center">
			  <legend >Internship for : </legend><span id="error"> * <?php echo $internemp; ?></span>
				<table cellspacing="5" cellpadding="5">
					<tr>
						<td><input type="checkbox" name="intern[]">Web Development
						</td>
						<td><input type="checkbox" name="intern[]">English
						</td>
						<td><input type="checkbox" name="intern[]">Communication Arts
						</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="intern[]">Editing/Publications
						</td>
						<td><input type="checkbox" name="intern[]">Marketing
						</td>
						<td><input type="checkbox" name="intern[]">Teaching
						</td>
					</tr>
					<tr>
						<td><input type="checkbox" name="intern[]">Social media
						</td>
						<td><input type="checkbox" name="intern[]">Graphic Design
						</td>
						<td><input type="checkbox" name="intern[]">Events Planning
						</td>
					</tr>
				</table>
			</fieldset>

			<label for="direction" >Direction : </label>
			<input type="text" name="direction" placeholder="Enter Direction" min="8" max="50">


			<label for="username" >Username : <span id="error"> * <?php echo $unemp; ?></span></label>
			<input type="text" name="username" placeholder="Enter valid Email Id" min="8" max="50" >

			<label for="pwd" >Password : <span id="error"> * <?php echo $pwdemp; ?></span></label>
			<input type="password" name="password" placeholder="Enter Password" ><br><br>
			<center>
				<input type="submit" name="submit">
			</center>
		</form>
	</div>

</body>
</html>