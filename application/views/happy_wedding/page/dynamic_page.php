<section class="faq-pg-section section-padding">
	<div class="container">
		<div class="row">
			<div class="col col-lg-10 col-lg-offset-1">
				<div class="section-title" style="padding-top:0px;">
					<h2><?php if(isset($page_row->page_title)) echo $page_row->page_title; ?></h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col col-lg-10 col-lg-offset-1">
				<?php if(isset($page_row->page_content)) echo $page_row->page_content; ?>
			</div>
		</div>
	</div>
</section>

