
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-gift"></i> <?php echo mlx_get_lang('Manage Received Gifts'); ?>
	  
	</section>

<section class="content">

  <div class="box box-<?php echo $myHelpers->global_lib->get_skin_class(); ?> gift-recieved">
	
	<div class="box-body content-box">
		  
			<div class="row">
<?php  if ($query->num_rows() > 0)
{				
	$i=0;   
foreach ($query->result() as $row)
{ 
	$i++;
?>		
<div class="col-md-4">
	<div class="gift_card">
		
		<div class="lead" style="margin-top:0px; margin-bottom:5px;">
			<?php if(isset($row->product_detail)){
					$product = json_decode($row->product_detail);
					echo ucfirst($product->title).' - ';
					echo $product->price.' ';
					$gift_img = $product->image;
				} ?>
		</div>
		<div class="head_date">
			<i class="fa fa-clock-o"></i> <?php echo date('d/m/Y',$row->transaction_date); ?> 
		</div>
		<div class="gift_image">
			<img src="<?php echo base_url().'../uploads/gifts/'.$gift_img; ?> " width="50px" height="50px"/>
		</div>
		<div class="gift_sender_info">
				<div class="gift_sender">
					<p><strong>Sent By</strong> :- <?php echo $row->name; ?></p>
					<p><strong>Email</strong> :- <?php echo $row->email; ?></p>
					<p><strong>Contact No</strong> :- <?php echo $row->contact_number; ?></p>
				</div>
		</div>
		<div class="gift_status">
			<?php if($row->status == 'Completed') echo '<span class="label label-success">'.ucfirst($row->status).'</span>'; 
					   else if($row->status == 'progress') echo '<span class="label label-danger">'.ucfirst($row->status).'</span>';
					   else echo '-';
				 ?>
		</div>
	</div>
</div>				
<?php 	}
}else{?>
	<div class="alert alert">No Gifts Received Yet !</div>
<?php }	?>                      
			</div>
		</div>
  </div>
</section>
</div>
