<?php 
echo script_tag("themes/$theme/bootstrap/js/bootstrap.min.js");
echo script_tag("themes/$theme/plugins/datatables/jquery.dataTables.min.js");
echo script_tag("themes/$theme/plugins/datatables/dataTables.bootstrap.min.js");
echo script_tag("themes/$theme/plugins/select2/select2.full.min.js");
echo script_tag("themes/$theme/plugins/moment/moment.js");
echo script_tag("themes/$theme/plugins/datepicker/bootstrap-datepicker.js");
echo script_tag("themes/$theme/plugins/iCheck/icheck.min.js");
echo script_tag("themes/$theme/plugins/slimScroll/jquery.slimscroll.min.js");
echo script_tag("themes/$theme/js/jquery.magnific-popup.min.js");
echo script_tag("themes/$theme/plugins/ckeditor/ckeditor.js");
echo script_tag("themes/$theme/plugins/timepicker/bootstrap-timepicker.min.js");
echo script_tag("themes/$theme/plugins/datatables/dataTables.bootstrap.min.js");

echo script_tag("themes/$theme/plugins/plupload/plupload.full.min.js");
echo script_tag("themes/$theme/plugins/plupload/gallery-uploader.js");
echo script_tag("themes/$theme/plugins/plupload/image-uploader.js");
echo script_tag("themes/$theme/js/app.min.js");
echo script_tag("themes/$theme/custom.js");
?>


<footer class="main-footer no-print">
<div class="pull-right hidden-xs">
	<?php if(isset($this->cms_version)){?>
  <b><?php echo mlx_get_lang('Version') . " " . $this->cms_version; ?></b>
  <?php } ?>
</div>
&nbsp;&nbsp;&nbsp;&nbsp;
</footer>


<div class="full_sreeen_overlay">
	<span><?php echo mlx_get_lang('Please Wait'); ?> ...</span>
</div>

