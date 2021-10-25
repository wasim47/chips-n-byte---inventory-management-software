<?php
if($brandUpdate->num_rows()>0){
	 foreach($brandUpdate->result() as $brandData);
		 $cid=$brandData->cid;
		 $cat_name=$brandData->cat_name;
		 $catImage=$brandData->image;
		 $short_desc=$brandData->short_desc;
}
else{
	$cid='';
	$cat_name=set_value('menu_name');
	$catImage='';
	$short_desc='';
	}
?>

<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Brand Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                         
                                         
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Brand Name<span class="required">*</span>                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="text" name="brand_name" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Brand Name' value="<?php echo $cat_name; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Brand Name'">
                                             <?php echo form_error('brand_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                                        
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Brand Image<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input type="file" name="catImage" class="form-control col-md-7 col-xs-12">
                                                <?php
                                                if($catImage!=""){
												?>
                                                <img src="<?php echo base_url('uploads/images/product_brand/brand/'.$catImage);?>" style="width:100px; height:auto" />
                                                <?php
												}
												?>
                                            </div>
                                        </div>
                                           
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Details<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-3 col-xs-12">
                                               <textarea name="short_desc" class="form-control"><?php echo $short_desc;?></textarea>
                                            </div>
                                        </div>
                                           <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                            </label>
                                            <div class="col-md-5 col-sm-3 col-xs-12">
                                                <select name="status" class="form-control  col-md-7 col-xs-12">
                                                    <option value="1">Enable</option>
                                                    <option value="0">Disable</option>
                                                </select>
                                            </div>
                                        </div>            
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <input type="hidden" name="cid" value="<?php echo $cid; ?>">
                                        <input type="hidden" name="stillimage" value="<?php echo $catImage; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               