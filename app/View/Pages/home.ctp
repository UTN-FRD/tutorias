<?php $this->layout='default'; ?>

<p>
	<?php if(!$loggedIn): ?>
		<a href="users/login">Login</a>
	<?php endif; ?>
</p>
