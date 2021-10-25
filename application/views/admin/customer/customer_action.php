<?php
if($customerUpdate->num_rows()>0){
	foreach($customerUpdate->result() as $customer);
			$customerId=$customer->customer_id;
			$customer_name=$customer->name;
			$contact=$customer->mobile;
			$salse_id=$customer->salse_id;
			$email=$customer->email;
			$address=$customer->address;
			$photo=$customer->photo;
			$password=$customer->password;
			$prev_balance=$customer->prev_balance;
			$code=$customer->cid;
}
else{
			$customerId='';
			$customer_name= set_value('customerName');
			$contact=set_value('mobile');
			$salse_id=set_value('salse_id');
			$email=set_value('email');
			$address=set_value('address');
			$prev_balance=set_value('prev_balance');
			$photo='';
			$password=set_value('password');
			$code=$lastCode;
	}
?>

<div class="right_col" role="main">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Customer Registration Details</h3>
                        </div>
                        
                    </div>
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
                                                   Customer Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                
                                                <?php /*?><div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Salse Represntative: </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <select name="salse_id" class="form-control" required>
                                                    	<option value="">Select User</option>
                                                        <?php foreach($salse_represntative->result() as $suser):?>
                                                        <option value="<?php echo $suser->user_id;?>"><?php echo $suser->username;?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                    <?php echo form_error('salse_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div><?php */?>
                                              
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Code<span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                        <input type="text" name="code" required class="form-control col-md-7 col-xs-12" value="<?php echo $code; ?>">
                                                     <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Customer Name: <span class="required">*</span></label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input name="customerName" id="customerName" class="form-control col-md-7 col-xs-12" type="text"  required="required" 
                                                    value="<?php echo $customer_name; ?>" placeholder="customer Name"/>
                                                    <?php echo form_error('customerName', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div>
                              
                              
                             
                                         		 <div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input name="mobile" id="mobile" type="text" class="form-control col-md-7 col-xs-12" required="required"
                                                     value="<?php echo $contact; ?>" placeholder="Mobile No."/>
                                                    <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mailing Address : </label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                <textarea name="address" class="form-control col-md-7 col-xs-12" placeholder="Mailing Address"><?php echo $address;?></textarea>
                                                </div>
                                          </div>
                                
                                  
                                  			<!--<div class="form-group">
                                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Previous Balance: </label>
                                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                                    <input name="prev_balance" id="prev_balance" type="text" class="form-control col-md-7 col-xs-12" required="required"
                                                     value="<?php echo $prev_balance; ?>" placeholder="Previous Balance"/>
                                                    <?php echo form_error('mobile', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                    </div>
                                              </div>-->
                                          <div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Email: </label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input name="email" id="email" class="form-control col-md-7 col-xs-12"  type="email"  required="required" 
                                                value="<?php echo $email; ?>" placeholder="Email Address"/>
                                                <?php echo form_error('email', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                          </div>
                                          <?php /*?><div class="form-group">
                                                <label class="control-label col-md-3 col-sm-3 col-xs-12"> Password: </label>
                                                <div class="col-md-5 col-sm-5 col-xs-12">
                                                <input name="password" id="password" class="form-control col-md-7 col-xs-12"  type="password"  required="required"
                                                 value="<?php echo $password; ?>" placeholder="Password : xxxxxxxx"/>
                                                <?php echo form_error('password', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                                </div>
                                          </div><?php */?>
                                
                          </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                           <input type="hidden" name="customer_id" value="<?php echo $customerId; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
               