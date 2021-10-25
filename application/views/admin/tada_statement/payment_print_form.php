<script>
window.onload=window.print();
</script>
<link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
<style>
	body {
	  background: rgb(204,204,204); 
	}
	page {
	  background: white;
	  display: block;
	  margin: 0 auto;
	  margin-bottom: 0.5cm;
	  box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
	}
	page[size="A4"] {  
	  width: 21cm;
	  min-height: 29.7cm; 
	  height: auto;
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	   min-height: 29.7cm; 
	   height: auto; 
	}
	page[size="A3"] {
	  width: 29.7cm;
	  height: 42cm;
	}
	page[size="A3"][layout="portrait"] {
	  width: 42cm;
	  height: 29.7cm;  
	}
	page[size="A5"] {
	  width: 14.8cm;
	  height: 21cm;
	}
	page[size="A5"][layout="portrait"] {
	  width: 21cm;
	  height: 14.8cm;  
	}
	@media print {
	  body, page {
		margin: 0;
		box-shadow: 0;
	  }
	}
	
	
	.printfontsize{
		font-size:18px;
		border-color:#000;
	}
</style>


<page size="A4" layout="portrait">
<div style="padding:1cm;">
   <div style="width:595px; height:auto; margin:0 auto; font-size:18px">
                                 
                                 <div style="width:100%; float:left;margin-bottom:40px; font-size:18px">
                                   <div style="width:100%; float:left">	
                                    <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Customer Copy</h5>
                                    <div style="text-align:left; padding:5px 0">
                                        	
                                            <h2 style="text-align:center; font-size:18px; font-weight:bold">K.R.C. International Co.</h2>
                                            <address style="text-align:center; font-size:16px">
                                               Shop No- 25/26 Chan Shordar Hardwar Market, Imamgonj, <br />
                                                Dhaka-1211. Please send your resume at <br />
                                                krcinternational3@gmail.com<br />
                                            </address>
                                            </div>  		
                                   </div>
                                   <div style="width:100%;  float:left">	
                                   <div style="width:50%; float:left; font-size:14px;padding:5px 0;">
                                   	Voucher No :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $voucher;?></strong>
                                   </div>
                                  	  	<div style="text-align:right; padding:5px 0; width:50%; float:right; font-weight:bold; font-size:14px">
                                        Salse Representative: <?php echo $salsename;?></div>
                                        
                                   </div>
                                   <div style="width:100%; float:left;; font-size:14px">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center"><h5>Description of Expense</h5></div>
                                        <div style="border:1px solid #ccc; width:49%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                    <div style="border:1px solid #ccc; border-right:none; width:49.9%; float:left; text-align:center; height:100px; padding:10px">
                                        <?php echo $particulars;?>
                                    </div>
                                    <div style="border:1px solid #ccc; width:49.2%; float:left; text-align:center; height:100px; padding:10px">
                                      <?php echo 'BDT '.$totalamouont.'/= Tk';?></div>
                          			
                                   </div> 
                                   <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:13px; padding:3px; margin:0; text-align:center">
                                        Depositor's Signature<br /><br /><strong><?php echo date('l, d F, Y',strtotime($subimition_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:13px; padding:3px; margin:0; text-align:center">
                                        Recipient Signature<br /><br /><strong><?php echo date('l, d F, Y',strtotime($subimition_date));?></strong></h5></div>
                                   </div>
                                   <div style="border-bottom:1px dashed #999; width:100%; float:left; height:40px;">&nbsp;</div>
                                </div>
                                
                                
                                
                                
                              <div style="width:100%; float:left;margin-bottom:40px; font-size:18px">
                                   <div style="width:100%; float:left">	
                                    <h5 style="width:26%; float:left; font-size:11px; padding:0; margin:0">Office Copy</h5>
                                    <div style="text-align:left; padding:5px 0">
                                        	
                                            <h2 style="text-align:center; font-size:18px; font-weight:bold">K.R.C. International Co.</h2>
                                            <address style="text-align:center; font-size:16px">
                                               Shop No- 25/26 Chan Shordar Hardwar Market, Imamgonj, <br />
                                                Dhaka-1211. Please send your resume at <br />
                                                krcinternational3@gmail.com<br />
                                            </address>
                                            </div>  		
                                   </div>
                                   <div style="width:100%;  float:left">	
                                   <div style="width:50%; float:left; font-size:14px;padding:5px 0;">
                                   	Voucher No :  <strong style="text-transform:capitalize; margin-left:10px;"><?php echo $voucher;?></strong>
                                   </div>
                                  	  	<div style="text-align:right; padding:5px 0; width:50%; float:right; font-weight:bold; font-size:14px">
                                        Salse Representative: <?php echo $salsename;?></div>
                                        
                                   </div>
                                   <div style="width:100%; float:left;; font-size:14px">	
                                  	  	<div style="border:1px solid #ccc; border-right:none; width:50%; float:left; text-align:center"><h5>Description of Expense</h5></div>
                                        <div style="border:1px solid #ccc; width:49%; float:left; text-align:center"><h5>Total Amount (BDT)</h5></div>
                                   </div>
                                   <div style="width:100%; float:left;">
                                    <div style="border:1px solid #ccc; border-right:none; width:49.9%; float:left; text-align:center; height:100px; padding:10px">
                                        <?php echo $particulars;?>
                                    </div>
                                    <div style="border:1px solid #ccc; width:49.2%; float:left; text-align:center; height:100px; padding:10px">
                                      <?php echo 'BDT '.$totalamouont.'/= Tk';?></div>
                          			
                                   </div> 
                                   <div style="width:100%; float:left; margin-top:50px;">	
                                  	  	<div style="border-top:1px solid #ccc; border-right:none; width:35%; float:left; text-align:left">
                                        <h5 style="font-size:13px; padding:3px; margin:0; text-align:center">
                                        Depositor's Signature<br /><br /><strong><?php echo date('l, d F, Y',strtotime($subimition_date));?></strong></h5>
                                        </div>
                                        <div style="border-top:1px solid #ccc; width:35%; float:right; text-align:left">
                                        <h5 style="font-size:13px; padding:3px; margin:0; text-align:center">
                                        Recipient Signature<br /><br /><strong><?php echo date('l, d F, Y',strtotime($subimition_date));?></strong></h5></div>
                                   </div>
                                   <div style="border-bottom:1px dashed #999; width:100%; float:left; height:40px;">&nbsp;</div>
                                </div>
                        </div>
</div>
</page>