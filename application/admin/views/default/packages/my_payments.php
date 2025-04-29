<?php $this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-credit-card"></i> <?php echo mlx_get_lang('Manage Packages'); ?>  
  </h1>
  

  <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
			{
				echo $_SESSION['msg'];
				unset($_SESSION['msg']);
			}
	?> 
</section>

<section class="content">

  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?>">
	
	<div class="box-body content-box">
		
		<?php  
		$user_id = $this->session->userdata('user_id');

		$query = $myHelpers->Common_model->commonQuery("select * from wedding_details where wedding_user_id = $user_id order by id DESC");	
		if ($query->num_rows() > 0){				
					$i=0;   
					foreach ($query->result() as $row)
					{ 
						$i++;
			
		?>						
			  <div class="row">
            <div class="col-md-4">
              <!-- Widget: user widget style 1 -->
              <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                 <!--
                  <h3 class="widget-user-username">Nadia Carmichael</h3>
                  <h5 class="widget-user-desc">Lead Developer</h5>
				  -->
                </div>
                <div class="box-footer no-padding">
                  <ul class="nav nav-stacked">
				   
                    <li><a href="<?php if($row->payment_status == 'pending'){
						echo base_url().'packages/choose_package';
					}else{ echo '#';}?>">Payment Status <span class="pull-right badge bg-blue">
					<?php if($row->payment_status == 'complete'){
						echo 'Completed';
					}else{
						echo 'Complete Your Payment';
					}?></span></a></li>
                    <li><a href="<?php echo base_url();?>">Site Status <span class="pull-right badge bg-aqua">
					<?php if($row->site_status == 'complete'){
						echo 'Completed Your Wedding Details';
					}else{
						echo 'Edit Your Wedding Details';
					}?>
					</span> </a>
					</li>
                    <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                  </ul>
                </div>
              </div><!-- /.widget-user -->
            </div><!-- /.col -->
            
           
          </div><!-- /.row -->
		<?php 	}
		}else{
			echo 'You Did Not Create Your wedding site please Update data'.base_url();
		}	?>                      
		
		</div>
  </div>
</section>
</div>