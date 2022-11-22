<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- Begin page content -->
<main class="flex-shrink-0 mt-5">
	<div class="container mt-2">
		<h2>Online Test !</h2>
		<hr>
		<?php
		if ($this->session->id) {
			echo 'Welcome ' . $this->session->name;
		?>
		<br>
		Start your online test NOW !
		<a href="./question" style="text-decoration:none;">Click here !</a>
		<?php
		} else {
			echo 'Popular Test Series for Banking, SSC, RRB & All other Govt. Exams !';
		}
		?>
	</div>
</main>