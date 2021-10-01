    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet" />
    <link href="<?= project_url('/assets/css/main.css') ?>" rel="stylesheet" />
    <script>
		$('#load-web-btn').click(function() {

			var csrf_token = '<?= $_SESSION['csrf_token']; ?>';

			$.ajax({
				type: "POST",
				url: 'load_more_web.php',
				data: {
					csrf_token: csrf_token
				},
				success: function(data, status) {
					$(".result-showing-div").append(data);
					// alert(data);
				}

			});
		});



		$('#load-image-btn').click(function() {

			var csrf_token = '<?= $_SESSION['csrf_token']; ?>';

			$.ajax({
				type: "POST",
				url: 'load_more_images.php',
				data: {
					csrf_token: csrf_token
				},
				success: function(data, status) {
					$(".result-showing-div").append(data);
					// alert(data);
				}

			});
		});
	</script>
	<script type="text/javascript">
		$("[data-fancybox]").fancybox({

			caption: function(instance, item) {
				var caption = $(this).data('caption') || '';
				var siteUrl = $(this).data('siteurl') || '';

				if (item.type == 'image') {
					caption = (caption.length ? caption + '<br><br>' : '') + '<a href="' + item.src + '"> View Image </a><br>' +
						'<a href="' + siteUrl + '"> Visit This Website </a>';
				}

				return caption;
			},

			afterShow: function(instance, item) {
				var csrf_token = '<?= $_SESSION['csrf_token']; ?>';
				var src = item.src;

				$.ajax({
					type: "POST",
					url: 'update-image-clicks.php',
					data: {
						csrf_token: csrf_token,
						src: src
					},
					success: function(data, status) {

					}
				});
			}
		});
	</script>
	<script type="text/javascript">
		$("img").on("error", function() {
			// $(this).attr("src", "broken.gif");
			var parent1 = $(this).parent();
			var parent2 = parent1.parent();
			parent2.parent().css({
				"display": "none"
			});

			var csrf_token = '<?= $_SESSION['csrf_token']; ?>';
			var src = $(this).attr("src");

			$.ajax({
				type: "POST",
				url: 'delete-broken-images.php',
				data: {
					csrf_token: csrf_token,
					src: src
				},
				success: function(data, status) {

				}
			});
			// parent2.parent().css({"border": "1px solid red"})
		});

		$('.input-box').focusin(function() {
			$('.search-bar-div').css({
				'box-shadow': '0px 1px 4px 1px #888888',
				'border': 'none'
			});
		});

		$('.input-box').focusout(function() {
			$('.search-bar-div').css({
				'box-shadow': '0px 0px 2px 1px lightgrey',
			});
		});
	</script>
  </body>
</html>