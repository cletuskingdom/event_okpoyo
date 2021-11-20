<?php require_once('config.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
	<link rel="stylesheet" href="<?php echo base_url ?>plugins/fontawesome-free/css/all.min.css">
	<style>
		body > div{
			display: flex;
			justify-content: center;
			padding: 50px 0;
		}
		#registerForm div{
			margin-bottom: 20px;
		}
		#registerForm div input{
			width: 300px;
			padding: 5px;
		}
		#registerForm button{
			/* padding: 5px;
			padding: 5px 30px;
			background-color: lightblue;
			outline-style: none; */
		}
	</style>
</head>
<body>
	<div>
		<form id="registerForm">
			<h1>REGISTER</h1>
			<div>
				<input type="text" name="fname" placeholder="Enter first name">
			</div>	
			<div>
				<input type="text" name="lname" placeholder="Enter last name">
			</div>	
			<div>
				<input type="text" name="username" placeholder="Enter username">
			</div>	
			<div>
				<input type="password" name="pass" placeholder="Enter password" class="password">
			</div>	
			<div>
				<input type="password" name="cpass" placeholder="confirm password" class="cpassword" readonly>
			</div>	
			<div>
				<input type="hidden" name="type" value="2">
			</div>
			<button type="submit">Submit</button> |
			<a href="<?php echo base_url ?>portal.php">Back to Portal</a>
		</form>
	</div>

	<script src="./assets/js/jquery.js"></script>
	<script>
		$(".password").on('keyup', function(){
			$('.cpassword').val($('.password').val());
		});
		$("#registerForm").submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: './server/classes/handleRequest.php?_mode=user-register',
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),
			})
			.done(function(response) {
				if(response.status == 0){
					alert(response.message);
				}else{
					location.replace("/event/portal.php")
				}
			}).fail(function(error) {
				console.log(error)
			});
		});
		
	</script>
</body>
</html>