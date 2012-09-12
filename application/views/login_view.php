<html>
<head></head>
<body>
<h1>Login</h1>
<?php
	echo form_open('admin'); 

	echo form_label('Email Address:', 'email_address');
	echo form_input('email_address', set_value('email_address'), 'id="email_address"');

	echo form_label('Password:', 'password');
	echo form_password('password', '', 'id="password"');

	echo form_submit('submit', 'Login');
	echo form_close();

	echo validation_errors();
?>
<a href="registration">Register!</a>
</body>
</html>
