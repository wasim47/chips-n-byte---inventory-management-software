<?php
if($customerDetails->num_rows()>0){
	foreach($customerDetails->result() as $customer);
	$id=$customer->customer_id;
	$memId=$customer->reg_no;
	$companyName=$customer->company_name;
	$head=$customer->head_organization;
	$contact_person=$customer->contact_person;
	$position=$customer->position;
	$contact=$customer->contact;
	$email=$customer->email;
	$web=$customer->web;
	$fax=$customer->fax;
	$address=$customer->address;
	$year=$customer->year_of_inception;
	$otherInfo=$customer->others_information;
	$logo=$customer->logo;
	$file1=$customer->firstfile;
	$file2=$customer->secondfile;
	$file3=$customer->thirdfile;
	$file4=$customer->fourthfile;
}

?>
<div class="right_col" role="main">
                <div class="">

                    
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>customer details</h2>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><h4 class="panel-title">
                                                   customer details</h4></a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                      			  <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Company name</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;"><?php echo $companyName; ?></div>
                                        </div>
                                                  <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">customership ID No</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;"><?php echo $memId; ?></div>
                                                        </div>
                                          <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Head Organization</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;"><?php echo $head;?>
                                            </div>
                                        </div>
                                                        <div class="form-group">
                                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Contact Person</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;">
                                               <?php echo $contact_person; ?>
                                            </div>
                                        </div>
                                     	             <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Contact No</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;">
                                                               <?php echo $contact; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Email</label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;">
                                                               <?php echo $email; ?>
                                                            </div>
                                                        </div>
                                                                     
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Address
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;">
                                                                <?php echo $address; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Year of inception<span class="required">*</span>
                                                            </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                                <?php echo $year; ?>
                                                            </div>
                                                        </div>
                                                       
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Photo </label>
                                                            <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px; font-size:15px;">
                                                                <img src="<?php echo base_url('asset/uploads/customer/logo/'.$logo);?>" style="width:25%; height:auto" />
                                                            </div>
                                                        </div>
                                                      
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                                   </div> 
                                  
                                    <div class="ln_solid"></div>
                                    
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               