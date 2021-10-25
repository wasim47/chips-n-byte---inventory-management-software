<?php
if($bankUpdate->num_rows()>0){
	foreach($bankUpdate->result() as $bankData);
	$b_id=$bankData->b_id;
	$bank_name=$bankData->bank_name;
	$account_name=$bankData->account_name;
	$account_no=$bankData->account_no;
	$branch=$bankData->branch;
	$details=$bankData->details;
}
else{
	$b_id='';
	$bank_name=set_value('bank_name');
	$account_name=set_value('account_name');
	$account_no=set_value('account_no');
	$branch=set_value('branch');
	$details=set_value('details');
}
?>

<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Bank Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Bank Registraion Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Bank Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Name<span class="required">*</span></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <input type="text" name="bank_name" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Bank Name' value="<?php echo $bank_name; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Bank Name'">
                                                         <?php echo form_error('bank_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account Name<span class="required">*</span></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <input type="text" name="account_name" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Account Name' value="<?php echo $account_name; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Account Name'">
                                                         <?php echo form_error('account_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                     </div>
                                        			<div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Account No<span class="required">*</span></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <input type="text" name="account_no" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Account No' value="<?php echo $account_no; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Account No'">
                                                         <?php echo form_error('account_no', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Branch Name<span class="required">*</span></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <input type="text" name="branch" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Branch Name' value="<?php echo $branch; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Branch Name'">
                                                         <?php echo form_error('branch', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                     </div>
                                                     <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Bank Details/Address</label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                           <textarea name="details" class="form-control"><?php echo $details;?></textarea>
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
                                        <input type="hidden" name="b_id" value="<?php echo $b_id; ?>">
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
               