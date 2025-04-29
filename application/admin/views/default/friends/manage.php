
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-calendar"></i> <?php echo mlx_get_lang('Manage Freinds List'); ?>
	 	 	  
	  <a href="<?php echo base_url().'friendslist/add_new'; ?>" 
	  class="btn btn-primary pull-right content-header-right-link">Add Friends</a>
	  
	  </h1>
	 <?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
	</section>

	<section class="content">
						
	  <div class="box box-primary">
			<div class="box-header with-border">
			<a href="#" id="select_all" class="btn btn-sm btn-primary">Send Bulk Mails</a>
			<a href="#" 
				class="btn btn-primary btn-sm pull-right" id="sendMail" >Individual Mail</a> 
			
			</div>
			
		
		<div class="box-body content-box">
			
				
			  <table id="friends_table" class="table table-bordered table-hover datatable-element">
				<thead>
				  <tr>
					
					<th class="pad-right-5"><?php echo mlx_get_lang('Pick'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('First Name'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Last Name'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Eamil Address'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('City'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('State'); ?></th>
					<th class="pad-right-5"><?php echo mlx_get_lang('Country'); ?></th>
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
				  <td><input type="checkbox" id="friends" class="friends" 
					data-email="<?php echo  $row->email;?>"
					value="<?php echo $myHelpers->global_lib->EncryptClientId($row->friend_id) ?>"/></td>
				   
				  
					<td><?php echo  $row->first_name;?></td>
					<td><?php echo  $row->last_name;?></td>
					<td><?php echo  $row->email;?></td>
					<td><?php echo  $row->city;?></td>
					<td><?php echo  $row->state;?></td>
					<td><?php echo  $row->country;?></td>
					
					<td><?php echo  date('M d, Y',$row->created_at); ?></td>
					<td><?php echo  date('M d, Y',$row->updated_at); ?></td>
					
					<td class="action_block">
						
						<a href="<?php $segments = array('friendslist','edit',$myHelpers->global_lib->EncryptClientId($row->friend_id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Edit'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-edit fa-2x"></i></a>
							
						<a href="<?php $segments = array('friendslist','delete',$myHelpers->global_lib->EncryptClientId($row->friend_id)); 
						echo site_url($segments);?>" title="<?php echo mlx_get_lang('Delete'); ?>" data-toggle="tooltip" 
						class="btn btn-danger btn-xs" 
						onclick="return confirm('Do you realy want to delete this event?');"><i class="fa fa-trash fa-2x"></i></a>
						
						<a href="<?php $segments = array('friendslist','sendInvitation',$myHelpers->global_lib->EncryptClientId($row->friend_id)); 
							echo site_url($segments);?>" title="<?php echo mlx_get_lang('Send Invitations'); ?>" data-toggle="tooltip" class="btn btn-warning btn-xs"><i class="fa fa-envelope fa-2x"></i></a>
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
  
  
<div  id="sendMailBox"class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Invitations</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <label for="recipient-name" class="col-form-label">Recipient:</label>
			<select class="form-control " id="recipient-name" name="menu_locations" multiple="multiple">
			</select>
          </div>
		
          <div class="form-group">
            <label for="message-text ckeditor-element" class="col-form-label">Message:</label>
            <textarea class="form-control " id="message"></textarea>
          </div>
        </form>
		<div class="" id="error"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send">Send message</button>
		
      </div>
    </div>
  </div>
</div>

