<?php
if($supplierUpdate->num_rows()>0){
	foreach($supplierUpdate->result() as $supplier);
		$supplier_id=$supplier->user_id;
		$image=$supplier->photo;
		$supplier_name=$supplier->username;
		$mobile=$supplier->mobile;
		$ownername=$supplier->ownername;
		$address=$supplier->address;
		$telephone=$supplier->telephone;
		$mobile=$supplier->mobile;
		$email=$supplier->email;
		$website=$supplier->website;
		$code=$supplier->code;
}
else{
		$supplier_id='';
		$image='';
		$supplier_name='';
		$mobile='';
		$ownername='';
		$address='';
		$telephone='';
		$mobile='';
		$email='';
		$website='';
		$code=$lastCode;
}
?>
<script type="text/javascript">
   function checkUsername(){
		var email_val = $("#username").val();
		//alert(email_val);
		if(email_val.length>0){
		var filter = /^[a-zA-Z0-9-_]+$/;
		if(filter.test(email_val)){
				$('#loading').show();
				var jsonurl = "<?php echo base_url('registration/email_check')?>?username="+email_val;
				$.ajaxSetup({
					cache: false
				});
				$.ajax({
					   type: "GET",
					   url: jsonurl,
					   dataType: 'json',
					   data: {},
					   success: function(data) {
						  $('#loading').hide();
						  $('#message').html(data.message).show().delay(10000).fadeOut();
						  $('.errorColor').css({ 'color':  data.color});
					   }
				});
		}
		else{
		 alert('\t\t আপনার URL সঠিক নই। আপনার URL নির্বাচনে নিম্নোক্ত নীতিমালা অনুসরণ করুন');	
		 document.getElementById('username').value="";
		 document.getElementById('username').select();
		}
		}
		else{
		 alert('\tআপনার URL খালি রাখতে পারবেন না \n অনুগ্রহ করে আপনার শপ URL টাইপ করুন।');	
			}
			return false;
   }
</script>
<script type="text/javascript">
function paymentImage(val){
	if(val=='bKash'){
		document.getElementById('bkashCon').style.display='block';
		document.getElementById('freetrial').style.display='none';
	}
	else if(val=='Free trial'){
		document.getElementById('bkashCon').style.display='none';
		document.getElementById('freetrial').style.display='block';
	}
}

</script>	
<div class="right_col" role="main">
  <div>
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
                                                   Supplier  Information </h4>
                                              </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Supplier Name: <font color="#FF0000">&nbsp;*</font></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="supplier_name" id="supplier_name" value="<?php echo $supplier_name;?>" class="form-control col-md-7 col-xs-12" type="text"  required="required"/>
                                    </div>
                              </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Code<span class="required">*</span></label>
                                    <div class="col-md-5 col-sm-5 col-xs-12">
                                        <input type="text" name="code" required class="form-control col-md-7 col-xs-12" value="<?php echo $code; ?>">
                                     <?php echo form_error('code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                    </div>
                                </div>
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">  Address : </label>
                                    <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea name="address" class="form-control ckeditor" rows="6" cols="40"  required="required"><?php echo $address;?></textarea>
                                    </div>
                                </div>
                              
                              
                              
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12"> Logo:  </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="file" class="form-control col-md-7 col-xs-12" name="companyLogo" id="file"/>
                                    <img src="<?php echo base_url('uploads/images/supplier/'.$image);?>" style="width:150px; height:auto" />
                                   </div>
                                </div>
                                  
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Telephone: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="telephone" id="telephone" value="<?php echo $telephone;?>" class="form-control col-md-7 col-xs-12"  type="text"/>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Mobile: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="mobile" id="mobile" type="number" maxlength="15" value="<?php echo $mobile;?>" class="form-control col-md-7 col-xs-12" />
                                        </div>
                                  </div>
                                   
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Web Address: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="website" id="website" class="form-control col-md-7 col-xs-12" value="<?php echo $website;?>" type="text"/>
                                        </div>
                                  </div>
                                  <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Owner Name: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="owner" class="form-control col-md-7 col-xs-12" type="text" value="<?php echo $ownername;?>"/>
                                        </div>
                                  </div>
                                  
                                   <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12"> Email: </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="email" id="email" class="form-control col-md-7 col-xs-12"  value="<?php echo $email;?>" type="email"/>
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
                                       <input type="hidden" name="supplier_id" value="<?php echo $supplier_id;?>" />
                                        <input type="hidden" name="stillImg" value="<?php echo $image;?>" />

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
               