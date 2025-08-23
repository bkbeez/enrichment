		<!-- jQuery -->
		<script src="assets/js/jquery-3.6.0.min.js"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="assets/js/bootstrap.bundle.min.js"></script>

		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Feather Icon JS -->
		<script src="assets/js/feather.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="assets/plugins/select2/js/select2.min.js"></script>

		<!-- Datepicker Core JS -->
		<script src="assets/js/moment.min.js"></script>
		<script src="assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- Custom JS -->
		<script src="assets/js/script.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

		<script>
			$(document).ready(function() {

				$('.cmulogout').click(function() {
        // Use SweetAlert2 for a confirmation dialog
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
							window.location.href = '../cmu_oauth/logout.php';
						}
					});
				});

				setInterval(function(){
					$.post('<?= $subadmin ?>refresh_session.php');
				},300000); 
//refreshes the session every 5 minutes
			});
		</script>