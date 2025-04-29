
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-calendar"></i> <?php echo mlx_get_lang('Manage Event'); ?>
	  <a href="<?php echo base_url().'event/add_new'; ?>" 
	  class="btn btn-primary pull-right content-header-right-link">Add New Event</a></h1>
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
					
					
					<th class="pad-right-5"><?php echo mlx_get_lang('Image'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Title'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Date'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Time'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Venue'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Contact Number'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('By User'); ?></th>
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
					<td>
						<?php 
						$thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/event/',$row->event_image,'thumb');
						if(isset($thumb_photo) && !empty($thumb_photo))
						{
						?>
						<img src="<?php echo base_url().'../uploads/event/'.$thumb_photo; ?>" width="50px" height="50px"/>
						<?php } ?>
					</td>
				  
					<td><?php $place = str_replace('-',' ',$row->event_place); echo strtoupper($place);?></td>
					<td><?php echo  date('M d, Y',$row->event_date);?></td>
					<td><?php echo  $row->event_time;?></td>
					<td><?php echo  $row->event_venue;?></td>
					<td><?php echo  $row->contact_number;?></td>
					<td><?php echo $row->user_name; ?></td>
					<td><?php echo  date('M d, Y',$row->created_at); ?></td>
					<td><?php echo  date('M d, Y',$row->updated_at); ?></td>
					
					<td class="action_block">
						
						<a href="<?php $segments = array('event','edit',$myHelpers->global_lib->EncryptClientId($row->event_id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
							
						<a href="<?php $segments = array('event','delete',$myHelpers->global_lib->EncryptClientId($row->event_id)); 
						 echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" 
						class="btn btn-danger btn-xs" 
						onclick="return confirm('Do you realy want to delete this event?');"><i class="fa fa-trash fa-2x"></i></a>
					</td>
				  </tr>
				<?php 	
					}
				}	
				?>                      
				</tbody>
				
			  </table>
			</div>
	  </div>
	</section>
  </div>
