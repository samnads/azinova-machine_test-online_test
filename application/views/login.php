<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Begin page content -->
<main class="flex-shrink-0 mt-5">
	<div class="container mt-2">
		<h2>Login</h2>
		<hr>
		<form method="post" action="./login">
			<div class="mb-3">
				<label for="username" class="form-label">Username</label>
				<input type="username" class="form-control" name="username" aria-describedby="username">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password</label>
				<input type="password" class="form-control" name="password">
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</main>