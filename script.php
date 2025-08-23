
<!-- jQuery -->
<script src="<?= $subadmin ?>assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Core JS -->
<script src="<?= $subadmin ?>assets/js/bootstrap.bundle.min.js"></script>

<!-- counterup JS -->
<script src="<?= $subadmin ?>assets/js/jquery.waypoints.js"></script>
<script src="<?= $subadmin ?>assets/js/jquery.counterup.min.js"></script>

<!-- Owl Carousel -->
<script src="<?= $subadmin ?>assets/js/owl.carousel.min.js"></script>   

<!-- Slick Slider -->
<script src="<?= $subadmin ?>assets/plugins/slick/slick.js"></script>

<!-- Aos -->
<script src="<?= $subadmin ?>assets/plugins/aos/aos.js"></script>

<!-- Custom JS -->
<script src="<?= $subadmin ?>assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



<script>
	$(document).ready(function() {

		var subadmin = $('#subadmin').val();
		console.log(subadmin);
		function loadimgheader(targetElement, postData) {
			$.ajax({
				url: 'assets/php/action_header.php',
				type: 'POST',
				data: postData,
				success: function(response) {
					$(targetElement).html(response);
				}
			});
		}

		loadimgheader('#imgheader1', { 'imgheader1': true, subadmin:subadmin });
		loadimgheader('#imgheader2', { 'imgheader2': true, subadmin:subadmin });

		function loadimgfooter(targetElement, postData) {
			$.ajax({
				url: 'assets/php/action_footer.php',
				type: 'POST',
				data: postData,
				success: function(response) {
					$(targetElement).html(response);
				}
			});
		}

		loadimgfooter('#imgfooter1', { 'imgfooter1': true });
		loadimgfooter('#imgfooter2', { 'imgfooter2': true });




		$(document).on("click", ".cmulogout", function (e) {
			e.preventDefault()
        // Use SweetAlert2 for a confirmation dialog
			var basename_admin = $(this).data('basename_admin');
			console.log(basename_admin);

			Swal.fire({
				title: 'Logout',
				text: 'Are you sure you want to logout?',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Yes, logout!',
				cancelButtonText: 'Cancel'


			}).then((result) => {
            // If the user clicks 'Yes, logout!', redirect to 'cmu_oauth/logout.php'
				if (result.isConfirmed) {
					if (basename_admin != 'admin') {
						window.location.href = 'cmu_oauth/logout.php';
					}else{
						window.location.href = '../cmu_oauth/logout.php';
					}

				}
			});
		});

		setInterval(function(){
			$.post('<?= $subadmin ?>refresh_session.php');
		},300000); 
//refreshes the session every 5 minutes
	});
</script>