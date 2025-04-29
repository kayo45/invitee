<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=9" />
    <title><?php ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
<?php
echo link_tag("themes/$theme/bootstrap/css/bootstrap.min.css");
echo link_tag("themes/$theme/plugins/datatables/dataTables.bootstrap.css");
echo link_tag("themes/$theme/css/font-awesome.min.css");
echo link_tag("themes/$theme/plugins/datepicker/datepicker3-min.css");
echo link_tag("themes/$theme/plugins/iCheck/all.css");
echo link_tag("themes/$theme/plugins/select2/select2.min.css");
echo link_tag("themes/$theme/css/magnific-popup.min.css");
echo link_tag("themes/$theme/plugins/ckeditor/contents.css");
echo link_tag("themes/$theme/plugins/timepicker/bootstrap-timepicker.min.css");
echo link_tag("themes/$theme/plugins/datatables/dataTables.bootstrap.css");
echo link_tag("themes/$theme/plugins/nestable/style.css");
echo link_tag("themes/$theme/css/site.css");

if($this->site_direction == 'rtl')
{
	echo link_tag("themes/$theme/css/bootstrap-rtl.min.css");
	echo link_tag("themes/$theme/css/AdminLTE.min-rtl.css");
}
else 
{
	echo link_tag("themes/$theme/css/AdminLTE.min.css");
}

echo link_tag("themes/$theme/css/skins/_all-skins.min.css");
echo link_tag("themes/$theme/style.css");
echo link_tag("themes/$theme/custom.css");

echo script_tag("themes/$theme/plugins/jQuery/jQuery-3.5.1.min.js");
echo script_tag("themes/$theme/plugins/jQuery/jquery-ui.min.js");
echo script_tag("themes/$theme/js/jquery.magnific-popup.js");
echo script_tag("themes/$theme/plugins/ckeditor/ckeditor.js");
echo script_tag("themes/$theme/plugins/dompurify/0.8.4/purify.min.js");

echo script_tag("themes/$theme/plugins/nestable/jquery.nestable.js");
echo script_tag("themes/$theme/plugins/nestable/menu.js");

$def_skin = 'skin-blue';
$skin = $this->global_lib->get_option('skin');
if(!empty($skin))
{
	$def_skin = $skin;
}
?>
<script type="text/javascript">
	var base_url = '<?php echo site_url(); ?>';
</script>
</head>
<body class="<?php echo $def_skin; ?> fixed sidebar-mini">
<div class="wrapper">
<?php $this->load->view($content);?>
<?php $this->load->view("default/footer");?>
<div class="model_wrapper"></div>
</div>	


  </body>

</html>