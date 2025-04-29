<?php
	
	global $single_field,$meta_content,$content_type;
	$required = ( isset($single_field['required']) && $single_field['required'] == 'required') ? true : false;
	
	$field_name = $single_field['name'];
	if(is_array($meta_content) && array_key_exists($field_name,$meta_content))
		$value_existing = $meta_content[$field_name];
	else	
		$value_existing = $single_field['default'];
		
	if(empty($content_type))	
		$content_type = "content";	
		
	$options = array();
	if(isset($single_field['options']))
	{
		if(!is_array($single_field['options']))
			$options = $myHelpers->config->item($single_field['options']) ;
		else
			$options = $single_field['options'] ;
	}
		
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
<div class="form-group row <?php echo $field_parent_class; ?>">
	<label for="<?php echo $single_field['id'];?>" class="col-md-2"><?php echo $single_field['title'];?> 
		<?php if($required ){ ?>
		<span class="text-red">*</span>
		<?php } ?>
	</label>
	
	<?php if(count($options) > 0 ){?>
		<div class="col-md-10">
		<?php foreach($options as $k=>$v){?>
			<div class="radio">
				<label>
				  <input type="radio" class="<?php echo $field_class; ?>" <?php echo $field_attributes; ?>
					name="<?php echo $content_type; ?>[<?php echo $single_field['name'];?>]" 
					id="<?php echo $single_field['id'].'_'.$k;?>" 
					value="<?php echo $k; ?>"
					<?php if(!empty($value_existing) && $k ==$value_existing){?>
						checked="checked"
					<?php } ?>	
					>
					<?php echo $v; ?>
				</label>
	  		</div>
		<?php } ?>	
		</div>
	<?php } ?>  
</div>
