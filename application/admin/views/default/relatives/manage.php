
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-gratipay"></i> <?php echo mlx_get_lang('Manage Relatives'); ?>
	  <a href="<?php echo base_url().'relatives/add_new'; ?>" class="btn btn-primary pull-right content-header-right-link">Add New Relative</a></h1>
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
					<th class="pad-right-5"><?php echo mlx_get_lang('Name'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Type'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Relation'); ?></th>
					
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
				$thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/relatives/',$row->image,'thumb');
				if(isset($thumb_photo) && !empty($thumb_photo))
				{
				?>
					<img src="<?php echo base_url().'../uploads/relatives/'.$thumb_photo; ?>" width="50px" height="50px"/>
				<?php } ?>
				
			</td>
			
			<td><?php echo  ucwords($row->name);?></td>
			
			<td><?php echo  ucwords($row->type);?></td>
			
			<td><?php echo  ucwords($row->relation_title);?></td>
			
			<td class="action_block">
				<a href="<?php $segments = array('relatives','edit',$myHelpers->global_lib->EncryptClientId($row->r_id)); 
					echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
				
				<a href="<?php $segments = array('relatives','delete',$myHelpers->global_lib->EncryptClientId($row->r_id)); 
				 echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>"  data-toggle="tooltip" 
				class="btn btn-danger btn-xs" 
				onclick="return confirm('Do you realy want to delete this relative?');"><i class="fa fa-trash fa-2x"></i></a>
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
