<!DOCTYPE html>
<html lang="en">
<?php
    $social_media 		= $myHelpers->global_lib->get_option('social_media');
    $company_tel 		= $myHelpers->global_lib->get_option('company_tel');
    $company_email 		= $myHelpers->global_lib->get_option('company_email');
    $site_language 		= $myHelpers->global_lib->get_option('site_language');
    $default_language 	= $myHelpers->global_lib->get_option('default_language');
?>

<?php $this->load->view("$theme/header"); ?>
<body>
	<div class="main-page-wrapper">

		<!-- ===================================================
			Loading Transition
		==================================================== -->
		<div id="preloader">
			<div id="ctn-preloader" class="ctn-preloader">
				<div class="icon"><img src="<?= base_url('template/babun/') ?>images/loader.svg" alt="" class="m-auto d-block" width="60"></div>
				<div class="txt-loading">
					<span data-text-preloader="B" class="letters-loading">
						B
					</span>
					<span data-text-preloader="a" class="letters-loading">
						a
					</span>
					<span data-text-preloader="b" class="letters-loading">
						b
					</span>
					<span data-text-preloader="u" class="letters-loading">
						u
					</span>
					<span data-text-preloader="n" class="letters-loading">
						n
					</span>
				</div>
			</div>
		</div>

		<?php $this->load->view("$theme/navigasi"); ?>
		<?php $this->load->view($content); ?>
		<?php $this->load->view("$theme/footer"); ?>

	</div> <!-- /.main-page-wrapper -->
</body>

</html>