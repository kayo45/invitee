
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-users"></i> <?php echo mlx_get_lang('Manage Tamu Undangan'); ?> </h1>
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
					
					<th width="75px" class="pad-right-5" >No.</th>
					<th class="pad-right-5">Tamu Undangan</th>
					<th class="pad-right-5">No HandPhone (Wa)</th>
					<th class="pad-right-5">View / Share</th>
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
					<td>
					    <?= $row->nama_undangan ?>
					</td>
					<td>
					    <?= $row->no_hp ?>
					</td>
					<td class="action_block">
					    <?php 
					            $nama = $row->nama_undangan;
								$new = str_replace('-', ' ', $nama);
								
					            $wedbsite_link = str_replace('admin/','',base_url());
					            $wedbsite_link .= $row->site_name.'?nama=';
								$wedbsite_link .= $nama;
								echo '<a target="_blank" href="'.$wedbsite_link.'" class="btn btn-primary btn-xs"><i class="fa fa-eye"></i> View Site</a>'; ?>
						
						<?php 
					            $nama = $row->nama_undangan;
								$new_nama = str_replace(' ', '-', $nama);
					            $wedbsite_link = str_replace('admin/','','https://wa.me/62');
					            
					            $web_link = str_replace('admin/','',base_url());
					            
					            $link = $web_link.$row->site_name.'?nama='.$new_nama;
					            
					            $wedbsite_link .= $row->no_hp.'?text='.$row->template.''.$link;
					            
					            
								echo '<a target="_blank" href="'.$wedbsite_link.'" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"></i> Share Wa</a>'; ?>
									
									
							
					</td>
					<td class="action_block">
						
						<a href="<?php $segments = array('guestbook','edit_tamu',$myHelpers->global_lib->EncryptClientId($row->id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
						<a href="<?php $segments = array('guestbook','delete_tamu',$myHelpers->global_lib->EncryptClientId($row->id)); 
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