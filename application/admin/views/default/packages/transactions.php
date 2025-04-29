<?php $this->load->view("default/header-top");?>

<?php $this->load->view("default/sidebar-left");?>


<div class="content-wrapper">
<section class="content-header">
  <h1 class="page-title"><i class="fa fa-list"></i> <?php echo mlx_get_lang('Manage Transactions'); ?>  </h1>
  

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
				<th><?php echo mlx_get_lang('transaction_Id'); ?></th>
				<th><?php echo mlx_get_lang('Payment Names'); ?></th>
				<th><?php echo mlx_get_lang('Payment Amounts'); ?></th>
                <th><?php echo mlx_get_lang('Users'); ?></th>
				<th><?php echo mlx_get_lang('Payment Mode'); ?></th>
				<th><?php echo mlx_get_lang('Status'); ?></th>
                
				<th><?php echo mlx_get_lang('Date'); ?></th>
				<th><?php echo mlx_get_lang('Update'); ?></th>
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
				
				<td> <?php echo ucfirst($row->transaction_key); ?></td>
                <td> <?php if(isset($row->product_detail) && gettype($row->product_detail) == 'string'){
					 echo $row->product_detail; 
				}else{
					$p_name = json_decode($row->product_detail); 
                    echo ucfirst($p_name->title);
				}
                ?></td>
				<td> <?php echo ucfirst($row->transaction_amount); ?></td>
				<td> <?php echo $row->user_id; //$this->global_lib->get_user_meta($row->user_id,'first_name'); ?></td>
				<td> <?php echo ucfirst($row->payment_mode); ?></td>
				<td> <?php echo ucfirst($row->status); ?> </td>
				<td> <?php echo date('M d, Y h:i A',$row->transaction_date); ?></td>
                <td> <a href="<?php $segments = array('packages','change',$myHelpers->EncryptClientId($row->transaction_id)); 
					echo site_url($segments);?>" title="<?php echo mlx_get_lang('Change'); ?>" class="btn btn-warning btn-xs"><i class="fa fa-edit"></i></a></td>
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