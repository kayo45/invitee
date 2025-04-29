<?php
	
	global $single_field,$meta_content,$content_type;
	$required = ( isset($single_field['required']) && $single_field['required'] == 'required') ? true : false;
	
	$field_name = $single_field['name'];
	if(is_array($meta_content) && array_key_exists($field_name,$meta_content) && !empty($meta_content[$field_name]))
		$value = $meta_content[$field_name];
	else	
		$value = $single_field['default'];
		
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
?>
<div class="form-group input-group-field <?php echo $field_parent_class; ?>">
	<label for="<?php echo $single_field['id'];?>"><?php echo $single_field['title'];?> 
		<?php if($required ){ ?>
		<span class="text-red">*</span>
		<?php } ?>
	</label>
		<input type="url" class="form-control <?php echo $field_class; ?>"  <?php echo $field_attributes; ?>
			<?php if($required ){ ?>
			required="required" 
			<?php } ?>
			name="<?php echo $content_type; ?>[<?php echo $single_field['name'];?>]" 
			id="<?php echo $single_field['id'];?>"
			value="<?php echo $value;?>" 
			>
	
</div>
