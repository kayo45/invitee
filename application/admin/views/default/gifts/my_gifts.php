
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1  class="page-title"><i class="fa fa-gift"></i> <?php echo mlx_get_lang('Choose Gifts'); ?></h1>
		<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
	</section>

	<section class="content">
						
	  <div class="box box-primary">
		
		<div class="box-body content-box my-gift-block">
		
    <ul class="users-list clearfix">	
			  
		<?php  if ($wedding_gifts->num_rows() > 0)
		   {		
			$n=1;
			
			//print_r($user_gifts);
			foreach ($wedding_gifts->result() as $row)
			{ 	
		?>					
		<li >
			<div class="prod-grid">
			<?php 
				$thumb_photo = $myHelpers->global_lib->get_image_type('../uploads/gifts/',$row->image,'thumb');
				if(isset($thumb_photo) && !empty($thumb_photo))
				{
					$img= base_url().'../uploads/gifts/'.$thumb_photo;
				}else{
					$img=base_url().'../uploads/'.'no-image.jpg';
				}
			?>
			<img src="<?php echo $img; ?>"/>
			
			<h3><?php echo $row->title; ?> </h3>    
            <p><?php echo $row->description; ?></p>
			<p><?php echo 'Rs '.$row->price; ?></p>
			<label>
			<input type="checkbox" id="gift-<?php echo $row->gift_id;?>" 
			<?php if( array_key_exists($row->gift_id,$user_gifts)) echo " checked ";?>
			class="gifts " data-id="<?php echo  $myHelpers->global_lib->EncryptClientId($row->gift_id);?>"/>
			&nbsp;&nbsp; Add To List
			</label>
			</div>	
		</li> 
<?php 	}
}	?>    
	</ul>		
	</section>
</div>
<script>
$(document).ready(function(){
	$(".prod-grid").on("change",".gifts",function () {
		
		var action = '';
		if($(this).is(":checked"))
			action = 'add';
		else
			action = 'remove';
		var id = $(this).data('id');
		$.ajax({						
			url: base_url+'ajax/manage_users_gifts',						
			type: 'POST',						
			success: function (res) 
			{							
				
			},						
			data: {id : id, action : action},						
			cache: false					
		});
	});	
});
</script>