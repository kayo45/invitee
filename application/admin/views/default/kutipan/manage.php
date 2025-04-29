
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-book"></i> <?php echo mlx_get_lang('Manage Kutipan'); ?>
	  <a href="<?php echo base_url().'kutipan/add_new'; ?>" class="btn btn-primary pull-right content-header-right-link">Add Kutipan</a></h1>
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
					<th class="pad-right-5"><?php echo mlx_get_lang('Place'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Kutipan'); ?></th>
				
					<th width="150px" class="pad-right-5" ><?php echo mlx_get_lang('Action'); ?></th>
				  </tr>
				</thead>
				<tbody>
				<?php  if ($query->num_rows() > 0) { $n=1; 
					foreach ($query->result() as $row) { ?>						
					<tr>
						<td><?php echo  $n++; ?></td>
						<td><?php $place = str_replace('-',' ',$row->place); echo strtoupper($place);?></td>
						<td><?php echo  $row->kutipan;?></td>
							
						<td class="action_block">
							
							<a href="<?php $segments = array('kutipan','edit',$myHelpers->global_lib->EncryptClientId($row->id)); 
								echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
							<a onclick="return confirm('Do you realy want to delete this kutipan?');" href="<?php $segments = array('kutipan','delete',$myHelpers->global_lib->EncryptClientId($row->id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" class="btn btn-danger btn-xs confirmation"><i class="fa fa-trash fa-2x"></i></a>
						
						</td>
					</tr>
					<?php } }	?>                      
				 
				</tbody>
			  </table>
			</div>
		</div>
	</section>
</div>
