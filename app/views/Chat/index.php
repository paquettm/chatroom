<?php $this->view('shared/header','Choose your username'); ?>

<h1>Chatroom</h1>
<p>Before you can start chatting, select a username that will be showed in the chatroom</p>
<form method="post" action="">
	<label>Username:</label><input type="text" name="username">
	<input type="submit" name="action" value='Start chatting'>
</form>

<?php $this->view('shared/footer'); ?>