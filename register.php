<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Register</title>
</head>
<body>
	<form id="registerForm">
		<div style="margin-bottom: 30px;">
			<input type="text" name="fname" placeholder="enter first name">
		</div>	
		<div style="margin-bottom: 30px;">
			<input type="text" name="lname" placeholder="enter last name">
		</div>	
		<div style="margin-bottom: 30px;">
			<input type="text" name="username" placeholder="enter username">
		</div>	
		<div style="margin-bottom: 30px;">
			<input type="password" name="pass" placeholder="enter password" class="password">
		</div>	
		<div style="margin-bottom: 30px;">
			<input type="password" name="cpass" placeholder="confirm password" class="cpassword" readonly>
		</div>	
		<div style="margin-bottom: 30px;">
			<input type="hidden" name="type" value="2">
		</div>	
		<div id="registerResponse"></div>
		<button type="submit">create account</button>
	</form>

	<script src="./assets/js/jquery.js"></script>
	<script>
		$("#registerForm").submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: './server/classes/handleRequest.php?_mode=user-register',
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),
			})
			.done(function(response) {
				if(response.status = 0){
					alert(response.message);
				}else{
					location.replace("/event/portal.php")
				}
			}).fail(function(error) {
				console.log(error)
			});
		});
		$(".password").on('keyup', function(){
			$('.cpassword').val($('.password').val());
		});
	</script>
</body>
</html>