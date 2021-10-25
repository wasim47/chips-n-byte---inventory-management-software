<?php
if($expenseUpdate->num_rows()>0){
	foreach($expenseUpdate->result() as $expenseData);
	$par_id=$expenseData->par_id;
	$expenseTitle=$expenseData->expense_name;
	$code=$expenseData->code;
}
else{
	$par_id='';
	$expenseTitle=set_value('expense_name');
	$code=$lastCode;
}
?>

<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Asset Registration Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Asset & Investment Registraion Form</h2>
                                    
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
                                                   Asset & Investment Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Particulars Name<span class="required">*</span></label>
                                                        <div class="col-md-5 col-sm-5 col-xs-12">
                                                            <input type="text" name="expense_name" required class="form-control col-md-7 col-xs-12" 
                                                            placeholder='Particulars Name' value="<?php echo $expenseTitle; ?>"  onFocus="this.placeholder=''" 
                                                            onBlur="this.placeholder='Particulars Name'">
                                                         <?php echo form_error('expense_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Code<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" name="code" required class="form-control col-md-7 col-xs-12" value="<?php echo $code; ?>">
                                                     <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
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
                                        <input type="hidden" name="par_id" value="<?php echo $par_id; ?>">
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
               