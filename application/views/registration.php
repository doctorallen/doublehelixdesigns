<?php include('header.php'); ?>
<script>
$(document).ready(function(){
	/* Email validation */
	$('#email_address').blur(function(){
		var email_address = $('#email_address').val();

		$.post('/doublehelixdesigns/index.php/ajax/email_taken',
			{ 'email_address':email_address },
			function(result){
				$('#bad_email').replaceWith('');

				if(result){
					$('#email_address').after(
						'<div id = "bad_email" style="color:red;">' + '<p>(That Email Address is already taken. Please choose another.)</p></div>');
				}
			}
		);
	});
	$('#reconfirm_password').blur(function(){
		var password = $('#password').val();
		var reconfirm_password = $('#reconfirm_password').val();

		$('#bad_password').replaceWith('');
		if( password != reconfirm_password ){
			$('#reconfirm_password').after(
				'<div id = "bad_password" style="color:red;">' + '<p>(The password fields do not match.)</p></div>');
		}
	});


		$('#submit').click(function(){
			var form_data= {
				email_address : $('#email_address').val(),
					password: $('#password').val(),
					reconfirm_password: $('#reconfirm_password').val(),
					first_name: $('#first_name').val(),
					last_name: $('#last_name').val(),
					ajax: '1'
			};

			$.ajax({
				url : "<?php echo site_url('admin/register'); ?>",
				type : 'POST',
				async : false,
				data: form_data,
				success: function(){
					window.location.replace("<?php echo site_url(); ?>");
				}
			});
			return false;
		});
});
</script>

<h1>Registration Page</h1>

<?php
	echo form_open('admin/register');

	echo form_label('Email Address:', 'email_address');
	echo form_input('email_address', set_value('email_address'), 'id="email_address"');


	echo form_label('Password:', 'password');
	echo form_password('password', '', 'id="password"');
	
	echo form_label('Reconfirm Password:', 'reconfirm_password');
	echo form_password('reconfirm_password', '', 'id="reconfirm_password"');


	echo form_label('First Name:', 'first_name');
	echo form_input('first_name', set_value('first_name'), 'id="first_name"');

	echo form_label('Last Name:', 'last_name');
	echo form_input('last_name', set_value('last_name'), 'id="last_name"');

	echo form_submit('submit', 'Register', 'id="submit"');
	echo form_close();

	echo validation_errors();
?>

<?php include('footer.php'); ?>
