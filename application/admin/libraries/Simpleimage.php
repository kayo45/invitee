<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Simpleimage {

		public function Index(){}
	
		var $image; 
        var $image_type;  	
        public function load($filename){   
            $image_info = getimagesize($filename); 
			
			$this->image_type = $image_info[2]; 
			
            if($this->image_type == IMAGETYPE_JPEG)
            {   
                $this->image = imagecreatefromjpeg($filename); 
            }
            elseif($this->image_type == IMAGETYPE_GIF) 
            {   
                $this->image = imagecreatefromgif($filename); 
            }
            elseif($this->image_type == IMAGETYPE_PNG)
            {   
                $this->image = imagecreatefrompng($filename); 
            }
        } 

        public function save($filename, $image_type = IMAGETYPE_JPEG, $compression=75, $permissions=0777){   
			
			$CI =& get_instance();
			$CI->load->library('Global_lib');
			
			
            if($this->image_type == IMAGETYPE_JPEG)
            { 
				$gelukt = imagejpeg($this->image,$filename,$compression); 
            }
            elseif($this->image_type == IMAGETYPE_GIF)
            {   
				$gelukt = imagegif($this->image,$filename); 
            }
            elseif($this->image_type == IMAGETYPE_PNG)
            {   
				$width_new = $this->getWidth();
				$height_new = $this->getHeight();
				$dimg = imagecreatetruecolor($width_new, $height_new);
				$background = imagecolorallocate($dimg , 0, 0, 0);
				imagecolortransparent($dimg, $background);
				imagealphablending($dimg, false);
				imagesavealpha($dimg, true);
				imagecopyresampled($dimg, $this->image, 0, 0, 0, 0, $width_new, $height_new, $width_new, $height_new); 
				$this->image = $dimg;   
				$gelukt = imagepng($this->image,$filename); 
            } 
			
			
            if($permissions != false)
            {   
                chmod($filename,$permissions); 
            }

            return $gelukt; 
        } 

        public function output($image_type=IMAGETYPE_JPEG) { 

            if($image_type == IMAGETYPE_JPEG)
            { 
                imagejpeg($this->image); 
            } 
            elseif($image_type == IMAGETYPE_GIF) 
            {   
                imagegif($this->image); 
            }
            elseif($image_type == IMAGETYPE_PNG)
            {   
                imagepng($this->image); 
            } 
        } 

        public function getWidth(){   

            return imagesx($this->image);

        } 

        public function getHeight(){   

            return imagesy($this->image); 

        } 

        public function maxSize($width = 1080, $height = 520){
            if(($this->getHeight() > $height) && ($this->getWidth() > $width)){
                $ratio = $height / $this->getHeight(); 
                $newwidth = $this->getWidth() * $ratio; 

                if($newwidth > $width){
                    $ratio = $width / $newwidth; 
                    $height = $height * $ratio;
                    $newwidth = $width;
                }

                $this->resize($newwidth,$height);
                return true;
            }
            elseif($this->getHeight() > $height){
                $ratio = $height / $this->getHeight(); 
                $width = $this->getWidth() * $ratio; 

                $this->resize($width,$height);
                return true;
            }
            elseif($this->getWidth() > $width){
                $ratio = $width / $this->getWidth(); 
                $height = $this->getheight() * $ratio;  

                $this->resize($width,$height);
                return true;
            }
            return false;
        }

        public function resizeToHeight($height){   
            $ratio = $height / $this->getHeight(); 
            $width = $this->getWidth() * $ratio; 
            $this->resize($width,$height); 
        }   

        public function resizeToWidth($width){ 
            $ratio = $width / $this->getWidth(); 
            $height = $this->getheight() * $ratio; 
            $this->resize($width,$height); 
        }   

        public function scale($scale){ 
            $width = $this->getWidth() * $scale/100; 
            $height = $this->getheight() * $scale/100; 
            $this->resize($width,$height); 
        }   
		
		public function resize($width,$height) { 
			
            $old_x = $this->getWidth();
			$old_y = $this->getHeight();
			
			$thumb_width = $width;
			$thumb_height = $height;
			
			if($old_x > $old_y) 
			{
				$width    =   $width;
				$height    =   $old_y*($height/$old_x);
				
				$y = ($thumb_height - $height) / 2;
				$x = 0;
				
			}
			else if($old_x < $old_y) 
			{
				
				$width    =   $old_x*($width/$old_y);
				$height    =   $height;
				$y = 0;
				$x = ($thumb_width - $width) / 2;
				
			}
			else if($old_x == $old_y) 
			{
				$width    =   $width;
				$height    =   $height;
				$x=0;
				$y=0;
			}
			
			$new_image = imagecreatetruecolor($width, $height); 
			if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG )
            { 
                $current_transparent = imagecolortransparent($this->image); 
				
                if($current_transparent != -1) {
					$transparent_color = imagecolorsforindex($this->image, $current_transparent); 
					
                    $current_transparent = imagecolorallocate($new_image, 255, 255, 255); 
                    imagefill($new_image, 0, 0, $current_transparent); 
                    imagecolortransparent($new_image, $current_transparent); 
                }
                elseif($this->image_type == IMAGETYPE_PNG)
                { 
					
                    imagealphablending($new_image, false); 
                    $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127); 
					imagefill($new_image, 0, 0, $color); 
                    imagesavealpha($new_image, true); 
					
				} 
			} 
			
			imagecopyresampled($new_image, $this->image, 0, 0, 0, 0, $width, $height, $old_x, $old_y); 
			$this->image = $new_image;   
		
		}
		
		public function crop($width,$height) 
		{ 
		
            $new_image = imagecreatetruecolor($width, $height); 
            if( $this->image_type == IMAGETYPE_GIF || $this->image_type == IMAGETYPE_PNG )
            { 
                $current_transparent = imagecolortransparent($this->image); 

                if($current_transparent != -1) {
                    $transparent_color = imagecolorsforindex($this->image, $current_transparent); 
                    $current_transparent = imagecolorallocate($new_image, $transparent_color['red'], $transparent_color['green'], $transparent_color['blue']); 
                    imagefill($new_image, 0, 0, $current_transparent); 
                    imagecolortransparent($new_image, $current_transparent); 
                }
                elseif($this->image_type == IMAGETYPE_PNG)
                { 
                    imagealphablending($new_image, false); 
                    $color = imagecolorallocatealpha($new_image, 0, 0, 0, 127); 
                    imagefill($new_image, 0, 0, $color); 
                    imagesavealpha($new_image, true); 


				} 
			} 
			
			
			$thumb_width=$width; 
			$thumb_height=$height; 
			$ratio_thumb=$thumb_width/$thumb_height; 

			$img_width = $this->getWidth(); 
			$img_height = $this->getHeight();
			$ratio_original=$img_width/$img_height; 

			if ($ratio_original>=$ratio_thumb) {
				$yo=$img_height; 
				$xo=ceil(($yo*$thumb_width)/$thumb_height);
				$xo_ini=ceil(($img_width-$xo)/2);
				$xy_ini=0;
			} else {
				$xo=$img_width; 
				$yo=ceil(($xo*$thumb_height)/$thumb_width);
				$xy_ini=ceil(($img_height-$yo)/2);
				$xo_ini=0;
			}
			
			
			imagecopyresampled($new_image, $this->image, 0, 0, $xo_ini, $xy_ini, $thumb_width, $thumb_height, $xo, $yo);
			
			$this->image = $new_image;   
		}
		
		
}

