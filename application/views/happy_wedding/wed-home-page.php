<?php 

if(isset($homepage_section) && count($homepage_section) > 0 )
{
	$sections = $homepage_section; 
	global $settings;
	foreach($sections as $section_key => $section_settings)
	{
		
		if($section_settings['is_enable'] == 'Y')
		{
			$section_settings['section_id'] = $section_key;
			$settings = $section_settings;
			$this->load->view("$theme/wed-sections/$section_key");
		}
	
	}
}
?>
	
	



