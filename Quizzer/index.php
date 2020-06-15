<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link
		rel="stylesheet"
		href="http://use.fontawesome.com/releases/v5.8.1/css/all.css"
		integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhnd0JK28anvf"
		crossorigin="anonymous"
		/>
			<link rel="stylesheet" href="css/style.css" />
			<title>Sign in/Sign up</title>
	</head>
	<body>
	<div class="container" id="container">
			<div class="form-container sign-up-container">
				<form action="includes/signup.inc.php" method="post" autocomplete="off">
					<h1>Create Account</h1>
					<span> or use your email for registration</span>
					<input type="text" placeholder="Username" name="usernamehtml"/>
					<input type="text" placeholder="Email" name="email"/>
					<input type="password" placeholder="Password" name="password">
					<input type="password" placeholder="Re-type Password" name="password-repeat">
					<button type="submit" name="register">Register</button>
				</form>
			</div>
		
			<div class="form-container sign-in-container">
				<form action="includes/login.inc.php" method="post" autocomplete="off">
					<h1>Sing in</h1>
					<span> or use your account</span>
					<input type="text" placeholder="Email" name="email"/>
					<input type="password" placeholder="Password" name="password"/>
					<a href="#">Forgot your password?</a>
					<button type="submit" name="login">Sign In</button>
				</form>
			</div>
			<div class="overlay-container">
				<div class="overlay">
					<div class="overlay-panel overlay-left">
						<h1>Welcome Back!</h1>
						<p>To keep connected with us please login with your personal info</p>
						<button class="ghost" id="signIn">Sign In</button>
					</div>
					<div class="overlay-panel overlay-right">
						<h1>Hello friend</h1>
						<p>Enter your personal details and start journey with us</p>
						<button class="ghost" id="signUp">Sign Up</button>
					</div>
				</div>
			</div>
		
	</div>
	<script src="js/main.js"></script>
	</body>
</html>

