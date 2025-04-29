<?php $this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-newspaper-o"></i> <?php echo mlx_get_lang('Manage Blogs'); ?> 
  <a href="<?php echo base_url(array('blog','add_new')); ?>" class="btn btn-primary pull-right content-header-right-link">Add New Blog</a>
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
		  <table id="example2" class="table table-bordered table-hover datatable-element-scrollx">
			<thead>
			  <tr>
				
				<th width="30px"><?php echo mlx_get_lang('S.No.'); ?></th>
				<th width="80px"><?php echo mlx_get_lang('Image'); ?></th>
				<th><?php echo mlx_get_lang('Title'); ?></th>
				<th><?php echo mlx_get_lang('Category'); ?></th>
				<th><?php echo mlx_get_lang('Publish On'); ?></th>
				<th><?php echo mlx_get_lang('Created On'); ?></th>
				<th><?php echo mlx_get_lang('Status'); ?></th>
				<th><?php echo mlx_get_lang('Action'); ?></th>
			  </tr>
			</thead>
			<tbody>
<?php  if ($query->num_rows() > 0)
{				
	$i=0;   
foreach ($query->result() as $row)
{ 
	$i++;
	
?>						
			  <tr>
			   
				<td><?php echo  $i; ?></td>
				<td>
				<?php 
						$thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/blogs/',$row->image,'thumb');
						if(isset($thumb_photo) && !empty($thumb_photo))
						{
							$post_image_url = base_url().'../uploads/blogs/'.$thumb_photo;
						}else{
							$post_image_url = base_url().'../uploads/no-image-small.jpg';
								
						}
						echo '<img src="'.$post_image_url.'" width="100">';
						?>
					
				</td>
				<td> <?php echo ucfirst($row->title); ?></td>
				<td> <?php if(!empty($row->cat_title)) echo ucfirst($row->cat_title); else echo '-'; ?></td>
				<td>
					<?php 
						echo date('M d, Y h:i A',$row->publish_on); 
					?>
				</td>
				<td>
					<?php 
						echo date('M d, Y h:i A',$row->created_on); 
					?>
				</td>
				<td> <?php 
					   if($row->publish_on > $row->created_on) echo '<span class="label label-primary">'.mlx_get_lang('Future Publish').'</span>'; 
					   else if($row->status == 'draft') echo '<span class="label label-info">'.ucfirst($row->status).'</span>'; 
					   else if($row->status == 'pending') echo '<span class="label label-warning">'.ucfirst($row->status).'</span>';
					   else if($row->status == 'publish') echo '<span class="label label-success">'.ucfirst($row->status).'</span>';
					   else echo '-';
				 ?>
				 </td>
				<td class="action_block">
					
					<a href="<?php $segments = array('blogs',$row->slug); 
					echo str_replace('admin/','',base_url($segments)); ?>" title="View" target="_blank" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>
					
					<a href="<?php $segments = array('blog','edit',$myHelpers->EncryptClientId($row->b_id)); 
					echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a>
					
					<a href="<?php $segments = array('blog','delete',$myHelpers->EncryptClientId($row->b_id)); 
					 echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" 
					class="btn btn-danger btn-xs" 
					onclick="return confirm('Do you realy want to delete this blog?');"><i class="fa fa-remove"></i></a>
					
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