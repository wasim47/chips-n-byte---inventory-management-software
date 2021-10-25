<div class="right_col" role="main">
                <div class="">
                  <div class="clearfix"></div>
                    <div class="row">


                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Payment Registraion Form</h2>
                                    <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/payment_print/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/payment_print/print');?>','','width=1200,height=900,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div class="col-sm-12">	
                                  	  	<div class="col-sm-4" style="border:1px solid #ccc; border-right:none;"><h4>Particulars</h4></div>
                                        <div class="col-sm-2" style="border:1px solid #ccc; border-right:none;"><h4>Currency Amount</h4></div>
                                        <div class="col-sm-3" style="border:1px solid #ccc; border-right:none;"><h4>Currency Rate</h4></div>
                                        <div class="col-sm-3" style="border:1px solid #ccc;"><h4>Total Amount(BDT)</h4></div>
                                   </div>
                                   <div class="col-sm-12" style="min-height:274px">	
                                  	  	<div class="col-sm-4" style="border:1px solid #ccc;min-height:274px">
                                        	<ul>
                                        	<?php
											 $query=$this->db->query("select * from particulars");
												  foreach($query->result() as $parrow){
													 $payid=$parrow->par_id;
													 if($pay_for==$payid){
														 echo '<li style="padding:5px;"><strong><span style="text-align:left; float:left">'.$parrow->particulars_name.'</span>
														 <span class="glyphicon glyphicon-ok" style="text-align:right; float:right"></span></strong></li>';
													  }
													  else{
														echo '<li style="padding:5px;">'.$parrow->particulars_name.'</li>';  
														}
													  
													}
											?>
                                            </ul>
                                        </div>
                          <div class="col-sm-2" style="border:1px solid #ccc; border-left:none;min-height:274px"><h4><?php echo $currency_amount;?></h4></div>
                          <div class="col-sm-3" style="border:1px solid #ccc; border-left:none;min-height:274px"><h4><?php echo $currency;?></h4></div>
                          <div class="col-sm-3" style="border:1px solid #ccc; border-left:none;min-height:274px"><h4><?php echo $amount;?></h4></div>
                                   </div> 
                               <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>

                   
                </div>
               