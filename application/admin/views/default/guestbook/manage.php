
  <?php $this->load->view("default/header-top");?>
  
  <?php $this->load->view("default/sidebar-left");?>
  
<div class="content-wrapper">
	<section class="content-header">
	  <h1 class="page-title"><i class="fa fa-users"></i> <?php echo mlx_get_lang('Manage Guestbook'); ?>
	  
	</section>

	<section class="content">
						
	  <div class="box box-primary">
		
		 
			
		
		<div class="box-body content-box guestbook">
			<?php if(isset($_SESSION['msg']) && !empty($_SESSION['msg']))
				{
					echo $_SESSION['msg'];
					unset($_SESSION['msg']);
				}
			?>
				
		<div class="row">	  
				
<?php  

$evt_arr = array();
foreach($events as $r){
	$evt_arr[$r->event_id] = array( 'title' => $r->event_title,
									'event_date' => $r->event_date,
									'event_time' => $r->event_time);
}
if ($query->num_rows() > 0)
   {		
	$n=1;

	foreach ($query->result() as $row)
	{ 	

?>		
	  
<div class="col-md-6">
	<div class="gift_card">
		<h2 class="page-header">
			Requests for Number of Guests:- <span class=""><?php echo $row->number_of_guest; ?></span>
			<small class="pull-right">
				 <i class="fa  fa-clock-o"></i> <?php echo  date('M d, Y',$row->created_at); ?>
			</small>
		</h2>
		
		
		<div class="gift_sender_info">
				<p class="lead">-: ATTENDING :- </p> 
				<strong>
					<?php $d = explode(",",$row->event_title);
						$event_lists = array();
						foreach($d  as $rw){
							
							if (array_key_exists($rw,$evt_arr))
							{
									
								$event_lists [] = $evt_arr[$rw]['title'].' - <span>'. date('M d, Y',$evt_arr[$rw]['event_date']).' '.$evt_arr[$rw]['event_time'].'</span>' ;
							}
						}
						echo implode("<br>",$event_lists);
					?>
				</strong>
				<div class="gift_sender">
					
					<p class=" well well-sm no-shadow"><span><i class="fa fa-quote-left"></i> </span><?php echo  ucfirst($row->messages);?></p>
				</div>
		</div>
		<div class="user_name">
			<i class="fa  fa-user"></i> <?php echo  $row->guest_names;?>
		</div>
		<div class="user_email">
			<i class="fa fa-envelope-o"></i> <a href="mailto:<?php echo  $row->email;?>"><?php echo  $row->email;?></a>
		</div>
	</div>
</div>	  
	  
	  
<?php 	}
}	?>                      
				  
				
			</div>
	  </div>
	</section>
  </div>

 
