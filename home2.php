<?php 
session_start();

if (!isset($_SESSION['cmuitaccount'])) {
	header('Location: index');
	exit();
}

require "assets/php/connect.php"; ?>


<?php include 'head.php' ?>

<style>
	body{
		background-color: gray;
	}
	.card {
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		transition: 0.3s;
	}

	.card:hover {
		box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
	}

	.loader {
		border: 8px solid #f3f3f3;
		border-top: 8px solid #3498db;
		border-radius: 50%;
		width: 50px;
		height: 50px;
		animation: spin 1s linear infinite;
		display: none; /* Initially hide the loader */
		margin-left: 20%;
		position: absolute;
	}

	@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
	}

	.pointer {
		cursor: pointer;
	}

</style>

</head>

<body>
	<div class="content-wrapper">
		<?php include 'header.php' ?>



		<section class="wrapper bg-light">
			<div class="container">


				<div class="col-md-12 col-12 mb-3">
					<div class="card text-white bg-secondary">
						<div class="card-header">Enrichment-program</div>
						<div class="card-body">
							<h4 class="card-title">elearning</h4>
							<p class="card-text">Faculty of Education, Chiang Mai University</p>
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-md-4 col-12">

						<div class="card">
							<ul class="list-group list-group-flush">
								<li class="list-group-item pointer click-year list-group-item-primary fw-bold" id="my_course" data-year="0"><i class="bi bi-cart-check"></i> คอร์สเรียนของฉัน</li>
								<li class="list-group-item pointer click-year" data-year="1"><i class="bi bi-cart4"></i> คอร์สเรียน ชั้นปีที่ 1</li>
								<li class="list-group-item pointer click-year" data-year="2"><i class="bi bi-cart4"></i> คอร์สเรียน ชั้นปีที่ 2</li>
								<li class="list-group-item pointer click-year" data-year="3"><i class="bi bi-cart4"></i> คอร์สเรียน ชั้นปีที่ 3</li>
								<li class="list-group-item pointer click-year" data-year="4"><i class="bi bi-cart4"></i> คอร์สเรียน ชั้นปีที่ 4</li>
							</ul>
						</div>
						
					</div>
					<div class="col-md-8 col-12">
						<div id="loader1" class="loader"></div>
						<div id="course"></div>
					</div>
				</div>

				







			</div>
		</section>




	</div>
	<?php include 'footer.php' ?>



	<script src="./assets/js/plugins.js"></script>
	<script src="./assets/js/theme.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




	<script>
		$(document).ready(function () {


			$('.click-year').click(function () {
				var year = $(this).data('year');
				loadTable2('get_course', '#course', '#loader1', year);
			});


			function showLoader(loader) {
				$(loader).show();
			}

			function hideLoader(loader) {
        // Hide the specified loader
				$(loader).hide();
			}

			function loadTable2(action, targetElement, loader, year) {
				showLoader(loader);

				$.ajax({
					url: 'assets/php/action_home.php',
					type: 'POST',
					data: {
						[action]: true,
						year: year
					},
					success: function (data) {
						hideLoader(loader);
						$(targetElement).html(data);
					},
					error: function (xhr, status, error) {
						console.error(xhr.responseText);
						hideLoader(loader);
					}
				});
			}









		});
	</script>




</body>

</html>