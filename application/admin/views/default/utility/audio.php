<?php $this->load->view("default/header-top");?>
<?php $this->load->view("default/sidebar-left");?>


<style>
#sng {
  padding: 0;
}
.error{color:#f00;}
</style>
 <script>
	$(document).ready(function() {
		$(".hidediv").show().delay(5000).fadeOut();
	});
</script> 


<?php 
$row = $query->row();
?>	  
	  
    <div class="content-wrapper">

        <section class="content">

            <div class="col-md-12">
               
            </div>
            
            <div class="row">

                <div class="col-md-8">   
                
                    <div class="box box-primary">
                        
                        <div class="box-header with-border">
                            <h3 class="box-title"><?php echo mlx_get_lang('Utility Audio'); ?></h3>
                            <div class="box-tools pull-right">
                                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            </div>
                        </div>
                        
                        <div class="box-body">
                            
                            
                            
                        
                            
                            <div class="row">
                                        
                                        

                                <div class="col-md-12">
                                    <!-- <div class="form-group">
                                        <label for="place">Nama Utility <span class="required">*</span></label>
                                        <input type="text" class="form-control" placeholder="<?php echo $row->nama; ?>">
                                    </div> -->
                                    
                                    <div class="form-group">

                                        <audio controls autoplay>
                                            <source src="<?php echo base_url('../uploads/audio/').$row->konten; ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>

                                    <hr>
                                    
                                    
                                    <div class="form-group">
                                            <?php echo form_open('',array('method'=>"post",'enctype'=>"multipart/form-data")); ?>
                                            <input type="hidden" name="Id" value="<?php if(isset($id) && !empty($id)) echo $id; ?>">
                                            <?php if(!empty($error)){ echo "<div class='hidediv error'>$error</div>";   } ?> 
                                            <?php if(!empty($success)){ echo "<div class='alert alert-success'>$success</div>";   } ?>
                                            
                                            <div class="form-group">
                                            <label for="sng">Mp3 Song:</label>
                                            <input type="file" class="form-control" id="sng" name="uploadSong">
                                            
                                            <br><br>
                                            <button type="submit" name='save' class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                    
                                </div>

                            
                            </div>

                        </div>

                    <div>
                
                </div>
                

            </div>  
			  
			  
        </section>
    </div>
     