<?php
if($adminUpdate->num_rows()>0){
	foreach($adminUpdate->result() as $adminData);
	$id=$adminData->id;
	$stock_name=$adminData->stock_name;
	$stock_incharge=$adminData->stock_incharge;
	$address=$adminData->address;
	$mobile=$adminData->mobile;
	$email=$adminData->email;
}
else{
	$id='';
	$stock_name=set_value('stock_name');
	$stock_incharge=set_value('stock_incharge');
	$address=set_value('address');
	$mobile=set_value('mobile');
	$email=set_value('email');
	$style='style="display:none"';
	}
?>
<style>
.required{
	color:#f00;
}
</style>
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_content">
                                <?php echo $this->session->flashdata('successMsg');?>
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Stock Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        	<div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stock Name<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="stock_name" required class="form-control col-md-7 col-xs-12" 
                                                    placeholder='Stock Name' value="<?php echo $stock_name; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Stock Name'">
                                                 <?php echo form_error('stock_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                        </div>
                                        <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Stock In Charge<span class="required">*</span>
                                                </label>
                                                <div class="col-md-6 col-sm-6 col-xs-12">
                                                    <input type="text" name="stock_incharge" required class="form-control col-md-7 col-xs-12" 
                                                    placeholder='Stock In Charge' value="<?php echo $stock_incharge; ?>"  onFocus="this.placeholder=''" 
                                                    onBlur="this.placeholder='Stock In Charge'">
                                                 <?php echo form_error('stock_incharge', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                        </div>
                                     	<div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile No.<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="mobile" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Mobile No' value="<?php echo $mobile; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Mobile No'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Email<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email" name="email" required class="form-control col-md-7 col-xs-12"
                                                placeholder='Login Email' onFocus="this.placeholder=''" value="<?php echo $email; ?>" onBlur="this.placeholder='Login Email'">
                                                 <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>               
                                                        
                                         
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Address<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <textarea name="address" required class="form-control col-md-7 col-xs-12" 
                                                placeholder='Address' onFocus="this.placeholder=''" onBlur="this.placeholder='Address'"><?php echo $address; ?></textarea>
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
                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
               