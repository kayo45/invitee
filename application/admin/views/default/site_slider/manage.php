
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-sliders"></i> <?php echo mlx_get_lang('Manage Site Slider'); ?>
	  <a href="<?php echo base_url().'site_slider/add_new'; ?>" class="btn btn-primary pull-right content-header-right-link">Add New Slider</a></h1>
	 <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
	</section>

	<section class="content">
						
	  <div class="box box-primary">
		
		 
			
		
		<div class="box-body content-box">
			
				
			  <table id="example2" class="table table-bordered table-hover datatable-element">
				<thead>
				  <tr>
					
					<th width="75px" class="pad-right-5" ><?php echo mlx_get_lang('S No.'); ?></th>
					
					<th class="pad-right-5"><?php echo mlx_get_lang('Photo'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Order'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Created On'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Updated On'); ?></th>
					<th width="150px" class="pad-right-5" ><?php echo mlx_get_lang('Action'); ?></th>
				  </tr>
				</thead>
				<tbody>
<?php  if ($query->num_rows() > 0)
   {		
	$n=1;
	foreach ($query->result() as $row)
	{ 	
?>						
				  <tr>
				   <td><?php echo  $n++; ?></td>
				  
					<td><img src="<?php echo base_url().'../uploads/site_slider/'.$row->slide_img; ?>" width="50px" height="50px"/></td>
					
					<td>
					
						<div class="input-group">
							<?php if($row->img_order != 0){?>
							<a href="<?php $segments = array('site_slider','minus',$myHelpers->global_lib->EncryptClientId($row->id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Decreament'); ?>" data-toggle="tooltip" onclick="return confirm('Do you realy want to perform this action?');" class=" input-group-addon bg-red">
								<i class="fa fa-minus"></i>
							</a>
						  <?php }?>
						  <input type="text" class="form-control text-center" style="width:50px;" value="<?php echo  $row->img_order;?>">
						  
						  <a href="<?php $segments = array('site_slider','plus',$myHelpers->global_lib->EncryptClientId($row->id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Increament'); ?>" 
								data-toggle="tooltip" class="input-group-addon bg-yellow" onclick="return confirm('Do you realy want to perform this action?');">	
								<i class="fa fa-plus"></i>
							</a>
						</div>
					
					</td>
					<td><?php echo  date('M d, Y',$row->created_at); ?></td>
					<td><?php echo  date('M d, Y',$row->updated_at); ?></td>
					
					<td class="action_block">
						
						<a href="<?php $segments = array('site_slider','edit',$myHelpers->global_lib->EncryptClientId($row->id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
						<a href="<?php $segments = array('site_slider','delete',$myHelpers->global_lib->EncryptClientId($row->id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" 
						class="btn btn-danger btn-xs" onclick="return confirm('Do you realy want to delete this slider?');"><i class="fa fa-trash fa-2x"></i></a>
					</td>
				  </tr>
<?php 	}
}	?>                      
				  
				 
				 
				 
				</tbody>
				
			  </table>
			</div>
	  </div>

	</section>
  </div>
