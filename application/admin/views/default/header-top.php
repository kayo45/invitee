<?php $admin_url =  site_url();
	  $site_url = str_replace("/admin","",$admin_url);
	  $site_url = str_replace("/index.php","",$site_url);	

$user_id = $this->session->userdata('user_id');
$user_type = $this->session->userdata('user_type');
?>

<header class="main-header">
        <a href="<?php echo $admin_url;?>" class="logo">
          <span class="logo-mini"><?php echo mlx_get_lang('HW'); ?></span>
          <span class="logo-lg"><?php echo mlx_get_lang('Happy Wedding'); ?></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?php echo mlx_get_lang('Toggle Navigation'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
			  <?php $user_type = $this->session->userdata('user_type'); 
			  
			  if($user_type == 'wedding_user' && isset($_SESSION['wedding_site'] )){
				  if(isset($_SESSION['wedding_site_payment_status']) && $_SESSION['wedding_site_payment_status'] == 'complete')
				  {
			  ?>
			  <li class=" user user-menu">
                <a href="<?php echo $_SESSION['wedding_site'] ; ?>" class="btn btn-flat" target="_blank"><?php echo mlx_get_lang('View Site'); ?></a>
			  </li>
				  <?php }
				  else{
				  ?>
				   <li class=" user user-menu">
					<a href="<?php echo base_url(array('packages/my_payments')) ; ?>" class="btn btn-flat" ><?php echo mlx_get_lang('Complete Payment to View Site'); ?></a>
				  </li>
				  <?php
				  }
				  }else{ ?>
			  <li class=" user user-menu">
                <a href="<?php echo $site_url; ?>" class="btn btn-flat" target="_blank"><?php echo mlx_get_lang('View Site'); ?></a>
			  </li>
			  <?php } ?>
			  
			  <li class=" user user-menu">
                <a style="background:rgba(0,0,0,0.1);"><?php echo mlx_get_lang('Welcome'); ?> <strong><?php echo ucfirst($this->session->userdata('first_name')); ?></strong></a>
    		  </li>
              <li class=" user user-menu">
                <a href="<?php $segments = array('logins','logout'); echo base_url($segments);?>" class="btn btn-flat "><?php echo mlx_get_lang('Sign Out'); ?></a>
			  </li>
            </ul>
          </div>
        </nav>
      </header>