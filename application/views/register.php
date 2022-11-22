<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Begin page content -->
<main class="flex-shrink-0 mt-5">
	<div class="container mt-2">
		<h2>Registration</h2>
		<hr>
		<form method="post" action="./register">
			<div class="mb-3">
				<label for="name" class="form-label">Full Name *</label>
				<input type="text" class="form-control" name="name" id="name" aria-describedby="name" required>
			</div>
			<div class="mb-3">
				<label for="username" class="form-label">Username *</label>
				<input type="username" class="form-control" name="username" id="username" aria-describedby="username" required>
			</div>
			<div class="mb-3">
				<label for="email" class="form-label">Email *</label>
				<input type="emai" name="email" class="form-control" id="email" aria-describedby="email">
			</div>
			<div class="mb-3">
				<label for="password" class="form-label">Password *</label>
				<input type="password" name="password" class="form-control" id="password" required>
			</div>
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</main>