<?php require_once('./config.php'); ?>
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
		<input type="text" name="fname" placeholder="enter first name">
		<input type="text" name="lname" placeholder="enter last name">
		<input type="text" name="username" placeholder="enter username">
		<input type="password" name="pass" placeholder="enter password">
		<input type="password" name="cpass" placeholder="confirm password">
		<input type="hidden" name="type" value="2">
		<div id="registerResponse"></div>
		<button type="submit">create account</button>
	</form>

	<script src="./assets/js/jquery.js"></script>
	<script>
		$("#registerForm").submit(function(event) {
			event.preventDefault();
			$.ajax({
				url: 'server/classes/handleRequest.php?_mode=user-register',
				type: 'POST',
				dataType: 'json',
				data: $(this).serialize(),
			})
			.done(function(response) {
				// console.log(resp)
				alert(response.message);

				if(response.input == "name" && response.status == 0){
					$("#registerResponse").addClass('alert alert-danger');
					$("#registerResponse").html(response.message);
				}else if ( response.status == 1) {
					$("#registerResponse").removeClass('alert alert-danger');
					$("#registerResponse").addClass('alert alert-success');
					$("#registerResponse").html(response.message);
				}else{
					$("#registerResponse").addClass('alert alert-danger');
					$("#registerResponse").html("Please Check What You Are Doing Or Contact Site Admin");
				}
			}).fail(function(error) {
				console.log(error)
			});
		});
	</script>
</body>
</html>