<!DOCTYPE HTML>
<html>
    <head>
		<title>Sign Up</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" charset="utf-8">
		<!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
	</head>
	<body>
		<!--Body Container-->
		<div style="height: 100%;">
			<!--Top Bar-->
			<div style="height: 60px;"></div>
			<!--Small Top Bar-->
			<div style="height: 5px;"></div>
            <!--Quote Column-->
			<div style="min-height: 100%;">
                <p style="font-size: 100px;">Sign Up</p>
<?php
	require('../csv_util.php');
	session_start();
	// if the user is alreay signed in, redirect them to the members_page.php page
	if(isset($_SESSION['logged']) && $_SESSION['logged'] == true) header('location: authors/index.php');
	// use the following guidelines to create the function in auth.php
	// instead of using "die", return a message that can be printed in the HTML page
	if(count($_POST)>0){
		// check if the fields are empty
		if(!isset($_POST['email'][0])){
			echo "Please enter your email";
		//checks if the email is a valid email
		} else if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
			echo "Please enter a valid email";
		//checks if information has been entered for password
		} else if(!isset($_POST['password'][0])){
			echo "Please enter your password";
		//checks for atleast 2 special characters in the password
		} else if(!preg_match('/([A-Za-z0-9]*[^A-Za-z0-9]+){2,}[A-Za-z0-9]*/', $_POST['password'])){
			echo "Please include at least 2 or more special characters in your password";
		//checks if password meets character requirement
		}else if(strlen($_POST['password']) < 8){
			echo "Your password must be atleast 8 characters";
		//checks if password has been confirmed accurately
		} else if($_POST['password'] != $_POST['confirm_password']){
			echo "Passwords do not match";
		}else {
			//missing logic to check if user exists
			$error = false;
			if(file_exists('users.csv')){
				$users = returnFile('users.csv');

				//This loop makes sure the user isn't already registered
				foreach($users as $user){
					if($user[0] == $_POST['email']){
						echo "Email already registered";
						$error = true;
						break;
					}
				}
				//Conditional statement that
				//will contain code to put the data in the database;
				$fh=fopen('users.csv', 'a+');
				fputs($fh,$_POST['email'].';'.password_hash($_POST['password'],PASSWORD_DEFAULT).PHP_EOL);
				fclose($fh);
			} 
		}
	};

			
			
?>
				<form class="createForm" method="POST">
					<h2 style="margin-bottom: -10px;">Email</h2>
                    <br/>

                    <input style="margin-bottom: 15px;" type="email" name="email" />
                    <br />

                    <h2 style="margin-bottom: -10px;">Password</h2>
                    <br>

                    <h5 style="margin-top: -10px; margin-bottom: 10px;">(Password must have at least 2 special characters and at least 8 characters.)</h5>

                    <input type="password" name="password" />
                    <br/>

					<h2 style="margin-top: 20px; margin-bottom: -10px;">Confirm Password</h2>
                    <br>

					<input type="password" name="confirm_password" required="true"/><br />
                    <br/>

					<!--Buttons Row-->
					<div class="row" style="padding-top: 30px;">
                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div class="butDiv">
                                <input class="but lb" style="border: 0px;" type="submit" value="Sign Up">
                            </div>
                        </div>

                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div>
                                <a class="btn" href="..\authors\index.php">Back to Sign In</a>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div>
                                <a class="btn" href="..\authors\index.php">Cancel</a>
                            </div>
                        </div>
                    </div>
				</form>
			</div>
            <!--Small Footer Bar-->
            <div class="lg" style="height: 5px;"></div>
			<!--Footer Bar-->
			<div style="height: 30px;"></div>
        </div>
    </body>
</html>
