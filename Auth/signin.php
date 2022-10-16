<!DOCTYPE HTML>
<html lang="eng">
    <head>
		<title>Sign In</title>
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
                <p style="font-size: 100px;">Sign In</p>
<?php
session_start();
//if the user is already signed in, redirect them to the index.php page
if(isset($_SESSION['logged']) && isset($_SESSION['logged_user'])){
    header('location:../authors/index.php');
}
//use the following guidelines to create the function in auth.php
if(count($_POST)>0){
	// 1. check if email and password have been submitted
    if(!isset($_POST['email'][0]) || !isset($_POST['password'][0])){
        echo 'All fields are required';
        header('location:../Auth/signin.php');
        die();
    }
    $email = $_POST['email'];
    $password = $_POST['password'];
    //checks if email is a valid email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password)<8){
        echo 'Please provide a valid email address and password';
        header('location:../Auth/signin.php');
        die();
    }
            // 6. check if the file containing users exists
            if(file_exists('users.csv')){
                // 7. check if the email is registered
                $h = fopen('users.csv', 'r+');
                while(!feof($h)){
                    $line = fgets($h);
                    $data = explode(',', $line);
                    $data[1] = trim($data[1]);
                    print_r($data);
                    // 8. check if the password is correct
                    if($email == $data[0]){
                            if(password_verify($password, $data[1])){
                                echo 'valid email and password';
                                // 9. store session information
                                $_SESSION['logged_user']=$email;
                                $_SESSION['logged']=true;
                                header('location:../authors/index.php');
                                // 10. redirect the user to the members_page.php page
                                die();
                            } else {
                                break;
                            }
                        }
                }
                fclose($h);
                echo 'The email is not registered, please signup';
            }
}
?>
                <form class="createForm" method="POST">
                    <h2 style="margin-bottom: -10px;">Email</h2>
                    <br/>

                    <input style="margin-bottom: 15px;" type="email" name="email" />
                    <br />

                    <h2 style="margin-bottom: -10px;">Password</h2>
                    <br/>

                    <input type="password" name="password" />
                    <br/>

                    <!--Buttons Row-->
                    <div class="row" style="padding-top: 30px;">
                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div>
                                <input class="btn" style="border: 0px;" type="submit" value="Sign In">
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div>
                                <a class="btn" href="..\authors\index.php">Cancel</a>
                            </div>
                        </div>
                    </div>
                        <br>
                        <br>
                        <h2 style="margin-bottom: -10px;">Do you not have an account?</h2><br/>
                        <div class="col-md-2 col-sm-5 col-xs-12">
                            <div>
                                <a class="btn" href="signup.php">Create an Account</a>
                            </div>
                        </div>
                </form>
            </div>
            <!--Small Footer Bar-->
            <div class="lg" style="height: 5px;"></div>
			<!--Footer Bar-->
			<div class="lg" style="height: 30px;"></div>
        </div>
    </body>
</html>
