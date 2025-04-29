<?php 
$user_type = $this->session->userdata('user_type');
?>

  <aside class="main-sidebar">
	<section class="sidebar">
	  <ul class="sidebar-menu">
		<?php
			$menu_items =  $myHelpers->config->item('sidebar_left');  
			$content_fields =  $myHelpers->config->item('content_setting_fields');  
			$sticky_contents =  $myHelpers->config->item('content_fix_fields');  
			
			
			
			foreach($menu_items as $k => $menu_item)
			{	
				
				$item = $menu_item['class'] ;
				
				if(!$myHelpers->has_menu_access($menu_item['class'] , $user_type))
				{
					continue;
				}
				
				if(isset($menu_item['item'])) 
				{	$nav_items = $menu_item['item'];	
					$mi_class = "treeview ";
				}else {
					$mi_class = "";
				}
				
				if($class == 'main')
				{
					if( $class == $menu_item['class'] && $func == $menu_item['method'] ) 	
						$mi_class = " class='$mi_class active' ";
					else 			
						$mi_class = " class='$mi_class ' ";
				}
				else
				{
					if( $class == $menu_item['class'] ) 	
						$mi_class = " class='$mi_class active' ";
					else 			
						$mi_class = " class='$mi_class ' ";
				}
				
				if(isset($_SESSION['wedding_id'])) $wedding_id = $_SESSION['wedding_id'];
				else $wedding_id = 0;
				
				if(isset($_SESSION['site_status'])) $site_status = $_SESSION['site_status'];
				else $site_status = 'incomplete';
				
				
				
				
				
				if( $user_type == 'wedding_user'  ){
					
					if( in_array($site_status, array("incomplete","under-construction",)) &&   !in_array($menu_item['class'], array("main","settings","packages")))
						continue;
					
					if( in_array($site_status, array("incomplete","under-construction",)) &&  in_array($menu_item['link'], array("main/home_page")))
						continue;
					
					
				}
				
				if($menu_item['link'] != '#') 			$link = base_url(explode("/",$menu_item['link']));
				else			$link = $menu_item['link'];
				
				if(!empty($menu_item['icon_class']))	$icon_text = "<i class='".$menu_item['icon_class']."'></i> ";
				else			$icon_text = "";
					
				if(!empty($menu_item['collapse_class']))	$collapse_text = "<i class='".$menu_item['collapse_class']."'></i> ";
				else			$collapse_text = "";
						
				?>
				<li <?php  echo $mi_class; ?>>
				  <a href="<?php echo $link; ?>"> 	<?php echo $icon_text; ?>
					<span><?php echo mlx_get_lang($menu_item['text']); ?></span> 	<?php echo $collapse_text; ?>   </a>
				<?php	
				if(isset($menu_item['item'])) {
					$nav_items = $menu_item['item'];	
					
				?>
			  <ul class="treeview-menu">
			  <?php 	
				foreach($nav_items as  $k_inner => $item)
				{	
					$mit_class = ""; 
					
					
					if(!$myHelpers->has_menu_access($item['class']."||".$item['method'] , $user_type))
					{
						continue;
					}

					if( $class == $item['class'] && $func == $item['method'])		$mit_class = " class='active' ";
					else				$mit_class = " class='' ";
					
					if($item['link'] != '#')				$link = base_url(explode("/",$item['link']));
					else				$link = $item['link'];
					
					if(!empty($item['icon_class']))			$icon_text = "<i class='".$item['icon_class']."'></i> ";
					else				$icon_text = "";
						
					if(!empty($item['collapse_class']))		$collapse_text = "<i class='".$item['collapse_class']."'></i> ";
					else				$collapse_text = "";
					
					?>
					<li <?php  echo $mit_class; ?>>
					<a href="<?php echo $link; ?>">
					<?php echo $icon_text; ?>
					<span><?php echo mlx_get_lang($item['text']); ?></span>
					<?php echo $collapse_text; ?>
					</a></li>
					<?php	}
						echo "</ul>";
					?>	</li>		<?php
				}	
			}
		?>	
	  </ul>
	</section>
  </aside>