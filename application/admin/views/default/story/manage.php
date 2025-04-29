
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-book"></i> <?php echo mlx_get_lang('Manage Story'); ?>
	  <a href="<?php echo base_url().'story/add_new'; ?>" class="btn btn-primary pull-right content-header-right-link">Add New Story</a></h1>
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
					<th class="pad-right-5"><?php echo mlx_get_lang('Manage Order'); ?></th>
				
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
						$thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/story/',$row->image,'thumb');
						if(isset($thumb_photo) && !empty($thumb_photo))
						{
						?>
						<img src="<?php echo base_url().'../uploads/story/'.$thumb_photo; ?>" width="50px" height="50px"/>
						<?php } ?>
					</td>
					<td><?php echo  $row->title;?></td>
					<td><?php echo  date('M-d-Y',$row->date);?></td>
					<td>
					<div class="input-group">
						<?php if($row->story_order != 0){?>
					    <a href="<?php $segments = array('story','minus',$myHelpers->global_lib->EncryptClientId($row->id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Decreament'); ?>" data-toggle="tooltip" onclick="return confirm('Do you realy want to perform this action?');" class=" input-group-addon bg-red">
							<i class="fa fa-minus"></i>
						</a>
                      <?php }?>
                      <input type="text" class="form-control text-center" style="width:50px;" value="<?php echo  $row->story_order;?>">
					  
					  <a href="<?php $segments = array('story','plus',$myHelpers->global_lib->EncryptClientId($row->id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Increament'); ?>" 
							data-toggle="tooltip" class="input-group-addon bg-yellow" onclick="return confirm('Do you realy want to perform this action?');">	
							<i class="fa fa-plus"></i>
						</a>
                    </div>
						
					</td>
					
					<td><?php echo  date('M-d-yy',$row->created_at); ?></td>
					<td><?php echo  date('M-d-yy',$row->updated_at); ?></td>
					
					<td class="action_block">
						
						<a href="<?php $segments = array('story','edit',$myHelpers->global_lib->EncryptClientId($row->id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
						<a onclick="return confirm('Do you realy want to delete this story?');" href="<?php $segments = array('story','delete',$myHelpers->global_lib->EncryptClientId($row->id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" class="btn btn-danger btn-xs confirmation"><i class="fa fa-trash fa-2x"></i></a>
					
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
