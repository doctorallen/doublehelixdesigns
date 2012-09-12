<?php include('header.php'); ?>
<script>
	$(document).ready(function(){
		$('#submit').click(function(){
			var form_data= {
				email_address : $('#email_address').val(),
				password: $('#password').val(),
			ajax: '1'
			};

			$.ajax({
				url : "<?php echo site_url('admin/login'); ?>",
				type : 'POST',
				async : false,
				data: form_data,
				success: function(){
					window.location.replace("<?php echo site_url(); ?>/welcome");
				}
			});
			return false;
		});
	});
</script>
<h1>Login</h1>
<?php
	echo form_open('admin'); 

	echo form_label('Email Address:', 'email_address');
	echo form_input('email_address', set_value('email_address'), 'id="email_address"');

	echo form_label('Password:', 'password');
	echo form_password('password', '', 'id="password"');

	echo form_submit('submit', 'Login', 'id="submit"');
	echo form_close();

	echo validation_errors();
?>
<a href="registration">Register!</a>
<?php include('footer.php'); ?>
