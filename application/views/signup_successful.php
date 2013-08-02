<div id="hello" align="center">
	<h1>Congrats!</h1>
	<p>You account has been created.</p>
</div>

<div id="login_form2">
	<h1>Login, Fool!</h1>
	<?php
	echo form_open('login/validate_credentials');
	echo form_input('username','Username');
	echo form_password('password','Password');
	echo form_submit('submit','Login');
	?>
</div>	
