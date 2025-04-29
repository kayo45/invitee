<?php
	
	global $single_field,$meta_content,$content_type;
	$required = ( isset($single_field['required']) && $single_field['required'] == 'required') ? true : false;
	
	
	$field_name = $single_field['name'];
	if(is_array($meta_content) && array_key_exists($field_name,$meta_content))
		$value = $meta_content[$field_name];
		
	if(empty($content_type))	
		$content_type = "content";
	
	$field_class = '';
	if(isset($single_field['class']))
	{
		$field_class = $single_field['class'];
	}
	
	$field_attributes = '';
	if(isset($single_field['attributes']) && !empty($single_field['attributes']))
	{
		foreach($single_field['attributes'] as $fak=>$fav)
		{
			$field_attributes .= $fak.'="'.$fav.'" ';
		}
	}
	
	$field_parent_class = '';
	if(isset($single_field['parent_class']))
	{
		$field_parent_class = $single_field['parent_class'];
	}
	
	if(isset($value) && !empty($value) && !file_exists('../uploads/'.$value)) {
		$value = '';
	}
?>
<div class="form-group <?php echo $field_parent_class; ?> ajax-img-upload-section" >
	<label for="<?php echo $single_field['id'];?>"><?php echo $single_field['title'];?> 
		<?php if($required ){ ?>
		<span class="text-red">*</span>
		<?php } ?>
	</label>
	<div>
		<label class="custom-file-upload" <?php if(isset($value) && !empty($value)) { echo 'style="display:none;"';}?>>
			<input type="file" name="<?php echo $single_field['name'].'_file'; ?>" class=" img_upload_btn <?php echo $field_class; ?>"  <?php echo $field_attributes; ?>
				<?php if($required ){ ?>
				required="required" 
				<?php } ?>
				name="" id="<?php echo $single_field['id'];?>"
				value="" >
			<i class="fa fa-cloud-upload"></i> <?php echo mlx_get_lang('Upload Image'); ?>
		</label>
		<progress id="<?php echo $single_field['id'];?>_photo_progress" value="0" max="100" style="display:none;"></progress>
		<?php if(isset($value) && !empty($value)) { ?>
			<a id="<?php echo $single_field['id'];?>_link" href="<?php echo base_url().'../uploads/'.$value; ?>" download="<?php echo $value; ?>" style="">
				<img src="<?php echo base_url().'../uploads/'.$value; ?>" >
			</a>
			<a class="remove_uploaded_img" id="<?php echo $single_field['id'];?>_remove_img" data-name="<?php echo $single_field['id'];?>" title="Remove Image" href="#"><i class="fa fa-remove"></i></a>
		<?php }else{ ?>
			<a id="<?php echo $single_field['id'];?>_link" href="" download="" style="display:none;">
				<img src="">
			</a>
			<a class="remove_uploaded_img" id="<?php echo $single_field['id'];?>_remove_img" data-name="<?php echo $single_field['id'];?>" title="Remove Image" href="#" style="display:none;"><i class="fa fa-remove"></i></a>
		<?php } ?>
		<input type="hidden" name="<?php echo $content_type; ?>[<?php echo $single_field['name'];?>]" 
		value="<?php if(isset($value) && !empty($value)) echo $value; ?>" id="<?php echo $single_field['id'];?>_hidden">
	</div>
</div>
