<!--<script>
window.onload=window.print();
</script>-->
<?php
$query="SELECT * FROM customers WHERE customer_id = ?";
$custpayq = $this->db->query($query,array($custid));
$rowCust = $custpayq->row_array();
$custname = $rowCust['name'];
?>
<link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
   <div style="width:595px; height:auto; margin:0 auto;">
                                 
                                 <div style="width:100%; float:left;margin-bottom:40px;">
                                   <div style="width:100%; float:left">	
                                    <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Customer Copy</h5>
                                    <div style="text-align:left; padding:5px 0">
                                        	
                                            <h2 style="text-align:center">K.R. International Co.</h2>
                                            <address style="font-size:11px; text-align:center">
                                               Shop No- 25/26 Chan Shordar Hardwar Market, Imamgonj, <br />
                                                Dhaka-1211. Please send your resume at <br />
                                                krcinternational3@gmail.com<br />
                                            </address>
                                            </div>  		
                                   </div>
                                   <div style="width:100%;  float:left">	
                                   <div style="width:50%; float:left; font-size:12px;padding:5px 0;">
                                   	Memo No :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $serial_no;?></strong>
                                   </div>
                                  	  	<div style="text-align:right; padding:5px 0; width:50%; float:right; font-weight:bold; font-size:12px">
                                        Customer: <?php echo $custname;?></div>
                                        
                                   </div>
                                   <div style="width:100%; float:left;">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center"><h5>Particulars</h5></div>
                                        <div style="border:1px solid #ccc; width:49.9%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                    <div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center; height:100px; padding:10px">
                                        Payment for Products
                                    </div>
                                    <div style="border:1px solid #ccc; width:49.9%; float:left; text-align:center; height:100px; padding:10px">
                                      <?php echo $amount;?></div>
                          			<div style="width:100%; float:left; border:1px solid #ccc; padding:10px; border-top:none">
                                   		Amount in Word :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $amount_in_word;?></strong>
                                   </div>
                                   </div> 
                                   <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0; text-align:center">
                                        Depositor's Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0; text-align:center">
                                        Recipient Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5></div>
                                   </div>
                                   <div style="border-bottom:1px dashed #999; width:100%; float:left; height:40px;">&nbsp;</div>
                                </div>
                                
                                
                                
                                
                              <div style="width:100%; float:left;">
                                   <div style="width:100%; float:left">	
                                    <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Office Copy</h5>
                                    <div style="text-align:left; padding:5px 0">
                                        	
                                            <h2 style="text-align:center">K.R. International Co.</h2>
                                            <address style="font-size:11px; text-align:center">
                                               Shop No- 25/26 Chan Shordar Hardwar Market, Imamgonj, <br />
                                                Dhaka-1211. Please send your resume at <br />
                                                krcinternational3@gmail.com<br />
                                            </address>
                                            </div>  		
                                   </div>
                                   <div style="width:100%;  float:left">	
                                   <div style="width:50%; float:left; font-size:12px;padding:5px 0;">
                                   	Memo No :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $serial_no;?></strong>
                                   </div>
                                  	  	<div style="text-align:right; padding:5px 0; width:50%; float:right; font-weight:bold; font-size:12px">
                                        Customer: <?php echo $custname;?></div>
                                        
                                   </div>
                                   <div style="width:100%; float:left;">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center"><h5>Particulars</h5></div>
                                        <div style="border:1px solid #ccc; width:49.9%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                    <div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center; height:100px; padding:10px">
                                        Payment for Products
                                    </div>
                                    <div style="border:1px solid #ccc; width:49.9%; float:left; text-align:center; height:100px; padding:10px">
                                      <?php echo $amount;?></div>
                          			<div style="width:100%; float:left; border:1px solid #ccc; padding:10px; border-top:none">
                                   		Amount in Word :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $amount_in_word;?></strong>
                                   </div>
                                   </div> 
                                   <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0; text-align:center">
                                        Depositor's Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:11px; padding:3px; margin:0; text-align:center">
                                        Recipient Signature<br /><br />Date : <strong><?php echo date('l, d F, Y',strtotime($pay_date));?></strong></h5></div>
                                   </div>
                                </div>
                        </div>
