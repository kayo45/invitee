<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description"  content=""/>
<meta name="keywords" content=""/>
<meta name="robots" content="ALL,FOLLOW"/>
<meta name="Author" content="AIT"/>
<meta http-equiv="imagetoolbar" content="no"/>
<title><?php echo mlx_get_lang('Login'); ?> </title>



<?php
	/*css*/	
	echo link_tag("themes/$theme/bootstrap/css/bootstrap.min.css");
	echo link_tag("themes/$theme/css/font-awesome.min.css");
	echo link_tag("themes/$theme/css/AdminLTE.min.css");
	echo link_tag("themes/$theme/style.css");
?>
	<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body class="hold-transition login-page">
	<div class="login-box">
      <div class="login-logo">
        <a href="#"></a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg"><?php echo mlx_get_lang('Sign in to Start Your Session'); ?></p>
		<?php 
		if(isset($_SESSION['msg']) & !empty($_SESSION['msg'])) { 
			echo $_SESSION['msg'];
			unset($_SESSION['msg']);
		}
		?>
			<?php 	$attributes = array('name' => 'login_form');		 			
			echo form_open('logins/login',$attributes); ?>
			  <input type="hidden" name="redirect_to" value="<?php if(isset($_GET['redirect_to'])) echo $_GET['redirect_to']; ?>">
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" size="25" name="username" required>
				<span class="fa fa-envelope form-control-feedback"></span>
			  </div>
			  
			  <div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" size="25" name="userpass" required>
				<span class="fa fa-lock form-control-feedback"></span>
			  </div>
			  
			  <div class="row">
				<div class="col-xs-8">
				  &nbsp;
				</div>
				<div class="col-xs-4">
				  <button type="submit" name="submit" class="btn btn-primary btn-block btn-flat"><?php echo mlx_get_lang('Sign In'); ?></button>
				</div>
			  </div>
			</form>
		
      </div>
    </div>
	
	
<?php 

echo script_tag("themes/$theme/plugins/jQuery/jQuery-3.5.1.min.js");
echo script_tag("themes/$theme/bootstrap/js/bootstrap.min.js");
?>
</body>
</html>
