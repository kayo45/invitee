<?php 
	$admin_url =  site_url();
	$site_url = str_replace("/admin","",$admin_url);	

	$user_id = $this->session->userdata('user_id');
	$user_type = $this->session->userdata('user_type');
?>
<style type="text/css">


.site-store { padding:10px;}
.site-store a.not-block {
    display: inline-block!important;
    padding: 2px !important;
	margin-bottom: 5px;
    margin-right: 5px;
}

</style>

	<li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--<i class="fa fa-flag-o"></i>
                  <span class="label label-danger">9</span>-->
				  Site Stores
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 3 Site Stores</li>
                  <?php  if ($this->site_stores->num_rows() > 0)
						 {		
					?>	
				  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <?php	foreach ($this->site_stores->result() as $site_store)
							{ 
						?>
					  <li><!-- Task item -->
					  	
							
					  
					  <div class="site-store">
					  	<h6> First vendor site </h6>
                        <a href="<?php $segments = array('site_store','dashboard',
										$myHelpers->global_lib->EncryptClientId($site_store->aff_site_id)); 
								echo site_url($segments);?>" title="<?php echo mlx_get_lang('Store Dashboard'); ?>" 
								data-toggle="tooltip" class="btn btn-warning btn-xs not-block"><i class="fa fa-edit fa-2x"></i></a>
						
						<a href="<?php $segments = array('site_store','manage_products',
										$myHelpers->global_lib->EncryptClientId($site_store->aff_site_id)); 
								echo site_url($segments);?>" title="<?php echo mlx_get_lang('Store Products'); ?>" 
								data-toggle="tooltip" class="btn btn-warning btn-xs not-block"><i class="fa fa-edit fa-2x"></i></a>
						
						<a href="<?php $segments = array('site_store','manage_product_cats',
										$myHelpers->global_lib->EncryptClientId($site_store->aff_site_id)); 
								echo site_url($segments);?>" title="<?php echo mlx_get_lang('Store Product Categories'); ?>" 
								data-toggle="tooltip" class="btn btn-warning btn-xs not-block"><i class="fa fa-edit fa-2x"></i></a>
						
						
						</div>
						
                      </li><!-- end task item -->
                      <?php }?>
                      
                    </ul>
                  </li>
                  <!--<li class="footer">
                    <a href="#">View all tasks</a>
                  </li>-->
				  <?php } ?>
                </ul>
              </li>