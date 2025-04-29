<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left"); ?>
<?php $user_type = $this->session->userdata('user_type'); ?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-dashboard"></i> <?php echo mlx_get_lang('Dashboard'); ?></h1>
	  <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?> 
	</section>
	<section class="content admin-dashboard-section">
		
		<div class="row">
				<?php 
				if($wedding_sites->num_rows() > 0)
				{
					foreach($wedding_sites->result() as $row){
						
					$wedding_site_url = str_replace('admin/','',base_url()).$row->site_name;	
					
					
					$bride_photo = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->bride_photo,'thumb');
					$groom_photo = $myHelpers->global_lib->get_image_type('../uploads/weddings/',$row->groom_photo,'thumb');
				?>	
				<div class="col-md-4"  >
					  <div class="box box-widget widget-user-2">
						<div class="widget-user-header bg-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
						 
						  <h3 class="widget-wedding-title" style="text-align:center;"><?php echo $row->wedding_title;?></h3>
						</div>
						<div class="box-body ">
							<img class="img-circles" width="125px" src="<?php echo base_url().'../uploads/weddings/'.$bride_photo;?>" alt="User Avatar"> 
							<span class="pull-right">
							<img class="img-circles"  width="125px" src="<?php echo base_url().'../uploads/weddings/'.$groom_photo; ?>" alt="User Avatar"> 
							</span>
						</div>
						<div class="box-footer no-padding">
						  <ul class="nav nav-stacked">
							<li><a >Wedding Date <span class="pull-right badge bg-blue"><?php echo date("m/d/Y",$row->wedding_date);?></span></a></li>
							<li><a >Wedding Venue <span class="pull-right badge bg-aqua" title="<?php echo $row->wedding_venue ?>"><?php echo substr($row->wedding_venue,0,15).'...' ?></span></a></li>
							
							<li class="text-center bg-<?php echo $myHelpers->global_lib->get_skin_class(); ?>"><a href="<?php echo $wedding_site_url; ?>" target="_blank">View Site <!--<span class="pull-right badge bg-red">842</span>--> </a></li>
						  </ul>
						</div>
					  </div>
					</div>
					
				<?php 
					}
				} ?>	
					
				</div>

			
	</section>
</div>