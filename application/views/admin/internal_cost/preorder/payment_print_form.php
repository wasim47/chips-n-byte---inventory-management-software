<!--<script>
window.onload=window.print();
</script>-->
<link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
   <div style="width:595px; height:auto; margin:0 auto;">
                                <div class="x_content" style="margin-bottom:0; float:left;">
                                 
                                   <div style="width:100%; float:left">	
                                   <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Customer Copy</h5>
                                  	  		<div style="text-align:left; padding:5px 0">
                                        	
                                            <img src="<?php echo base_url('asset/images/logo.png')?>" style="width:40%; height:auto" />
                                            <address style="font-size:11px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                                   
                                   <div style="width:100%"><?php echo 'Memo No. <strong>'.$serial_no.'</strong>';?></div>
                                   <div style="width:100%; float:left; ">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:35%; float:left; text-align:center"><h5>Particulars</h5></div>
                                        <div style="border:1px solid #ccc; border-right:none; width:35%; float:left; text-align:center"><h5>Cost By</h5></div>
                                        <div style="border:1px solid #ccc;  width:30%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                  	  	<div style="border:1px solid #ccc;min-height:100px; font-size:11px; width:35%; float:left">
                                        	<ul>
                                        	<?php
											 $query=$this->db->query("select * from asset_investment");
												  foreach($query->result() as $parrow){
													 $payid=$parrow->par_id;
													 if($paymentfor==$payid){
														 echo '<li style="padding:5px;"><strong><span style="text-align:left; float:left">'.$parrow->asset_investment_name.'</span>
														 <span class="glyphicon glyphicon-ok" style="text-align:right; float:right"></span></strong></li>';
													  }
													  /*else{
														echo '<li style="padding:5px;">'.$parrow->asset_investment_name.'</li>';  
														}*/
													  
													}
											?>
                                            </ul>
                                        </div>
                          <div style="border:1px solid #ccc; border-left:none;min-height:100px; font-size:12px; padding:5px; width:35%; float:left; text-align:center"><?php echo $cost_by;?></div>
                         
                          <div style="border:1px solid #ccc; border-left:none;min-height:100px;font-size:12px; padding:5px;	width:30%; float:left; text-align:center"><?php echo $amount;?></div>
                                   </div> 
                                   <div style="width:100%; float:left; border:1px solid #ccc; padding:10px; border-top:none">
                                   	Amount in Word :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $amount_in_word;?></strong>
                                   </div>
                                   
                                </div>
                               
                               <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0">Depositor's Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0">Recipient Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5></div>
                                   </div>
                                   
                                   
                                   
                               <div style="border-bottom:1px dashed #999; width:100%; float:left; height:30px; margin-bottom:40px;">&nbsp;</div>
                                
                                
                                
                                
                                
                              <div class="x_content" style="margin-bottom:0; float:left;">
                                 
                                   <div style="width:100%; float:left">	
                                   <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Office Copy</h5>
                                  	  		<div style="text-align:left; padding:5px 0">
                                        	
                                            <img src="<?php echo base_url('asset/images/logo.png')?>" style="width:40%; height:auto" />
                                            <address style="font-size:11px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                                   
                                   <div style="width:100%"><?php echo 'Memo No. <strong>'.$serial_no.'</strong>';?></div>
                                   <div style="width:100%; float:left; ">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:35%; float:left; text-align:center"><h5>Particulars</h5></div>
                                        <div style="border:1px solid #ccc; border-right:none; width:35%; float:left; text-align:center"><h5>Cost By</h5></div>
                                        <div style="border:1px solid #ccc;  width:30%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                  	  	<div style="border:1px solid #ccc;min-height:100px; font-size:11px; width:35%; float:left">
                                        	<ul>
                                        	<?php
											 $query=$this->db->query("select * from asset_investment");
												  foreach($query->result() as $parrow){
													 $payid=$parrow->par_id;
													 if($paymentfor==$payid){
														 echo '<li style="padding:5px;"><strong><span style="text-align:left; float:left">'.$parrow->asset_investment_name.'</span>
														 <span class="glyphicon glyphicon-ok" style="text-align:right; float:right"></span></strong></li>';
													  }
													  /*else{
														echo '<li style="padding:5px;">'.$parrow->asset_investment_name.'</li>';  
														}*/
													  
													}
											?>
                                            </ul>
                                        </div>
                          <div style="border:1px solid #ccc; border-left:none;min-height:100px; font-size:12px; padding:5px; width:35%; float:left; text-align:center"><?php echo $cost_by;?></div>
                         
                          <div style="border:1px solid #ccc; border-left:none;min-height:100px;font-size:12px; padding:5px;	width:30%; float:left; text-align:center"><?php echo $amount;?></div>
                                   </div> 
                                   <div style="width:100%; float:left; border:1px solid #ccc; padding:10px; border-top:none">
                                   	Amount in Word :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $amount_in_word;?></strong>
                                   </div>
                                   
                                </div>
                               
                               <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0">Depositor's Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0">Recipient Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5></div>
                                   </div>
                        </div>
