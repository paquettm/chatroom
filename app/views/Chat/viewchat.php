<?php $this->view('shared/header','Register your account'); ?>

<h1>Chatroom</h1>
<a href='/Chat/index'>Change your username</a> |
<a href='/Chat/logout'>Destroy your username</a>

<section style='overflow-y: auto; height: 400px'>
<?php
//display all messages
foreach ($data as $chat) {
	echo "<p><small>$chat->timestamp</small>, <strong>$chat->author</strong> said: <em>$chat->message</em><br></p>\n";
}
?>
</section>
<section>
	<h2>Send a message</h2>
<form action='/Chat/speak' method='post' enctype='multipart/form-data'>
	<span class='input-group'><label>Message:<input name="message"></label>
	</span><span class='input-group'>
	<label>Picture:	<input type="file" name="picture"></label></span><span class='input-group'> 
	<input type="submit" name="action" value="Send"></span></section>
</form>
</section>

<?php $this->view('shared/footer'); ?>