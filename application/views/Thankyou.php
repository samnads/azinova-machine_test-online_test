<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Begin page content -->
<main class="flex-shrink-0 mt-5">
	<div class="container mt-2">
		<h2>Thank you !</h2>
		<h4>Your online exam is complete !</h4>
		<h1>Your Score : <span class="text-success"><?php echo $this->session->score; ?></span></h1>
	</div>
</main>