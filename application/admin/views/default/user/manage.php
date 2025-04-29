
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-users"></i> <?php echo mlx_get_lang('Manage Users'); ?> </h1>
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
				
			  <table id="example2" class="table table-bordered table-hover datatable-element-scrollx">
				<thead>
				  <tr>
					
					<th width="75px" class="pad-right-5" ><?php echo mlx_get_lang('S No.'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Full Name'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Username'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('User Type'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Mobile No.'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Email'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Wedding Site'); ?></th>
					<th class="pad-right-5" ><?php echo mlx_get_lang('Payment Status'); ?></th>
					<th><?php echo mlx_get_lang('Status'); ?></th>
					<th width="150px" class="pad-right-5" ><?php echo mlx_get_lang('Action'); ?></th>
				  </tr>
				</thead>
				<tbody>
<?php  if ($query->num_rows() > 0)
   {		
	$n=1;
	$site_users = $myHelpers->config->item("site_users");
	
	foreach ($query->result() as $row)
	{ 
	
		
?>						
				  <tr>
				   <td><?php echo  $n++; ?></td>
					<td><?php echo  $myHelpers->global_lib->get_user_meta($row->user_id,'first_name').' '.
									$myHelpers->global_lib->get_user_meta($row->user_id,'last_name'); ?></td>
					<td><?php echo  $row->user_name; ?></td>
					<td> <?php 
						if(array_key_exists($row->user_type,$site_users))	
						{	$user = $site_users[$row->user_type];
							echo $user['title'];
						}else
							echo ucfirst($row->user_type); ?></td>
					<td><?php echo  $myHelpers->global_lib->get_user_meta($row->user_id,'mobile_no'); ?></td>
					<td><?php echo  $row->user_email; ?></td>
					<td>
						<?php 
							
							if(isset($row->site_status) && !empty($row->site_status))
							{
								if($row->site_status == 'all-set-go')
								{
									$wedbsite_link = str_replace('admin/','',base_url());
									$wedbsite_link .= $row->site_name;
									echo '<a target="_blank" href="'.$wedbsite_link.'" class="btn btn-primary btn-xs">View Site</a>';
								}
								else
								{
									echo '<span class="label label-info">Incomplete Wedding Details</span>';
								}
							}
							else
							{
								echo '<a href="'.base_url().'user/create_site/'.$myHelpers->global_lib->EncryptClientId($row->user_id).'" class="btn btn-default btn-xs">Create Site</a>';
							}
						?>
					</td>
					<td><?php 
						if($row->payment_status == 'complete')
							echo '<span class="label label-success">'.ucfirst($row->payment_status).'</span>';
						else if($row->payment_status == 'pending')
							echo '<span class="label label-info">'.ucfirst($row->payment_status).'</span>';
						else
							echo '-';
						?></td>
					<td> 
						<?php 
						   if($row->user_verified == 'N') echo '<span class="label label-info">'.mlx_get_lang("UnVerified").'</span>';
						   else if($row->user_status == 'Y') echo '<span class="label label-success">'.mlx_get_lang("Active").'</span>'; 
						   else if($row->user_status == 'N') echo '<span class="label label-danger">'.mlx_get_lang("InActive").'</span>';
						   else echo '-';
						?>
					 </td>
					<td class="action_block">
						
						<a href="<?php $segments = array('user','edit',$myHelpers->global_lib->EncryptClientId($row->user_id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
						<a href="<?php $segments = array('user','delete',$myHelpers->global_lib->EncryptClientId($row->user_id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" class="btn btn-danger btn-xs"><i class="fa fa-trash fa-2x"></i></a>
					</td>
				  </tr>
<?php 	}
}	?>                      
				  
				 
				 
				 
				</tbody>
				
			  </table>
			</div>
	  </div><!-- /.box -->

	  <!-- /.row -->

	</section>
  </div>