<?php
session_start();
include('helpers/url_helpers.php');
include('layout/header.php');
include('config/config.php');
include('helpers/search_helpers.php');

if (!isset($_GET['search'])) $_GET['search'] = '';
if (!isset($_GET['q']) || $_GET['q'] == NULL) {
	header("location:" . project_url());
}
?>
<div class="s002">
	<form action="search" method="GET">
		<div class="inner-form">
			<div class="input-field first-wrap">
				<input autocomplete="off" id="search" type="text" name="q" placeholder="What are you looking for?" />
			</div>
			<div class="input-field fifth-wrap">
				<button class="btn-search" type="submit">SEARCH</button>
			</div>
		</div>
	</form>
	<!-- results -->
	<div class="search-results">
		<div class="left">
			<div class="result-showing-div">
				<?php
				$search_query = $_GET['q'];

				if ($_GET['search'] == 'images') {

					$resultsArray = getImageResults($search_query);

					if (isset($resultsArray)) {

						$counter = 0;

						foreach ($resultsArray as $result) {

							if ($counter < 50) {

								$host = parse_url($result['site_url'])['scheme'] . "://" . parse_url($result['site_url'])['host'];

								echo '
				 			<div class="image-card">
				 				<a href="' . $result['src'] . '" data-fancybox="gallery" data-caption="' . $result['title'] . '" data-siteurl="' . $result['site_url'] . '">
				 					<div class="image-div">
				 						<img src="' . $result['src']  . '">
				 					</div>
				 				</a>
				 				<a href="' . $result['site_url'] . '">
				 					<div class="img-title">' . $result['title'] . '</div>
				 				</a>
				 				<a href="' . $host . '">
				 					<div class="base-url">' . $host . '</div>
				 				</a>
				 			</div>
				 		';
							}

							$counter++;
						}

						$_SESSION['resultsArraySession'] = array_slice($resultsArray, 50);
					}
				} else {

					$resultsArray = getWebResults($search_query);

					if (isset($resultsArray)) {

						$_SESSION['token'] = md5(uniqid());
						$counter = 0;

						foreach ($resultsArray as $result) {

							if ($counter < 20) {

								$url = project_url('redirect.php?token=') .  $_SESSION['token'] . "&url=" . $result['url'];

								echo '
					 		<div class="results-div">
					 			<a href="' . $url . '" class="title-link">
					 				<div class="title">
					 				' .
									$result['title']
									. '
					 				</div>
					 			</a>
					 			<a href="' . $url . '">
					 				<div class="website">
					 					' .
									$result['url']
									. '
					 				</div>
					 			</a>

					 			<div class="web-description">
					 				 ' .
									$result['description']
									. '
					 			</div>
					 		</div>
					 	';
							}

							$counter++;
						}

						$_SESSION['resultsArraySession'] = array_slice($resultsArray, 20);
					}
				}
				?>
			</div>
			<?php if($_GET['search'] === 'image'): ?>
			<div class="load-more-div">
				<button class="load-more-btn" id="load-image-btn"> <i class="fas fa-angle-double-down"></i> Load More </button>
			</div>
			<?php else: ?>
			<div class="load-more-div">
				<button class="load-more-btn" id="load-web-btn"> <i class="fas fa-angle-double-down"></i> Load More </button>
			</div>
			<?php endif ?>
		</div>
		<div class="sidebar">
			b
		</div>
	</div>
</div>
<?php

$_SESSION['csrf_token'] = md5(uniqid());
?>
<?php include('layout/footer.php'); ?>