<!DOCTYPE html>
<html lang="en">

<head>
	<title>Encore Education | 404 - Not Found</title>

	<?php

	//Including global Header Menu
	include 'includes/header_meta.php';

	?>

	<body>

		<?php

		//Including global Header Menu
		include 'includes/header_nav.php';

		?>

		</header>

		<!-- Content -->
		<main class="content-row">
			<div class="content-box-01 page404">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">

							<h3 class="page404-title">404</h3>
							<p class="page404-subtitle">Oops! Page Not Found!</p>
							<p class="page404-text">Either Something Get Wrong or the Page Doesn't Exist Anymore.</p>
							<form action="./" class="page404-form">
								<div class="page404-form__box">
									<input class="page404-form__inp-text" placeholder="Search..." type="text" name="inp-text">
									<button class="page404-form__inp-btn" type="button">Search</button>
								</div>
							</form>
							<a class="btn-01" href="./">Take me home</a>
						</div>
					</div>
				</div>
			</div>
		</main>

		<!--Including Footer Contents and Scripts-->
		<?php

			//Footer part with Scripts
			include 'includes/footer_info.php';
		 ?>
