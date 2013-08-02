<h1>Create an Account</h1>
<fieldset>
	<legend>Login Info</legend>

	<?php
	echo form_open('login/create_member');
	echo form_input('username',set_value('username','Username'));
	echo form_input('email',set_value('email','Email'));
	echo form_input('password',set_value('password','Password'));
	echo form_input('password2',set_value('password2','Password Confirmtion'));

	echo form_submit('submit','Create Account');
	?>

	<?php echo validation_errors('<p class="erorr">'); ?>

</fieldset>	
