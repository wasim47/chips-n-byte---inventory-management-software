<script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
<script type="text/JavaScript">
function reportsPrintAjax()
{

	var fromdate=document.getElementById('from_date').value;
	var todate=document.getElementById('to_date').value;
	var printd = "print";
	//alert(fromdate);
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url('admin/datewise_sale_reports_ajax')?>',
			   data: {fdate:fromdate,tdate:todate,printdata:printd},
			   success: function(data) {
				 // alert("Successfully saved");
				 $("#reportPrintDisplay").html(data);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
}
window.onload=reportsPrintAjax;
</script>

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
<style>
.summTable{
	border-collapse:collapse;
}
.summTable td, th{
	padding:0px;
	color:#000;
}
.summTable .theadline td, th{
	padding:0;
	color:#fff;
	background:#666;
}
</style>
<page size="A4" layout="portrait">
<div style="padding:0.5cm;">
    <div style="width:100%; float:left">	
        <div style="text-align:center; padding:5px 0; width:20%; float:left">&nbsp;</div>
         <div style="text-align:center; padding:5px 0; width:60%; float:left">
                            <!--<img src="<?php echo base_url('assets/images/logo.png')?>" style="width:100px; height:auto" />-->
                            <div style="font-size:13px; text-align:center; margin-bottom:10px;">
                                <h1 style="margin:0; padding:0">KRC International</h1>
                                Imamgonj, Dhaka<br />
                                <h2 style="font-size:22px;margin:0; padding:0; text-decoration:underline">Product Stock Reports</h2>
                                <?php  
									if($fromdate!="" && $todate!=""){
										echo '<h3 style="font-size:18px;">'.$fromdate.' To '.$todate.'</h3>';
									}
									elseif($fromdate!=""){
										echo '<h3 style="font-size:18px;">'.$fromdate.'</h3>';
									}
									elseif($todate!=""){
										echo '<h3 style="font-size:18px;">'.$todate.'</h3>';
									}
									else{
										echo '<h3 style="font-size:18px;"> </h3>';
									}
								?>
                            </div>
      </div>
         <div style="text-align:center; padding:5px 0; width:20%; float:left">
            <table align="right">
                <tr>
                    <td>Printing Date</td>
                    <td>:</td>
                    <td><?php echo date('d-m-Y');?></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td>:</td>
                    <td><?php echo date('H:i:s A');?></td>
                </tr>
                
            </table>
         </div>         	  		
    </div>
    <div style="width:100%; float:left">	
      <div style="text-align:left; padding:5px 0; width:50%; float:left"></div>
                            
    </div>
  <div style="width:100%; height:auto;" class="printfontsize">
  		<table width="100%"border="0">
        </table>
<table width="100%" class="summTable" border="1">
                                        <tr style="font-weight:bold;">
                                              <td width="45" rowspan="2" align="center">S.L</td>
                                          <td width="119" rowspan="2"  align="center">Stock Name</td>
                                          <td width="124" rowspan="2" align="center">Product </td>
                                          <td width="64" rowspan="2" align="center">Code </td>
                                          <td width="49" rowspan="2" align="center">Size</td>
                                          <td width="69" rowspan="2" align="center">Group</td>
                                          <td width="52" rowspan="2" align="center">Unit</td>
                                          <td colspan="3" align="center">Additional </td>
                                              
                                               <td colspan="2" align="center">Deduction </td>
                                               <td width="79" height="33" rowspan="2" align="center">Total Qty</td>                                          
                                          <td width="99" rowspan="2" align="center">Avt.  Price</td>
                                          <td width="106" rowspan="2"  align="center">Stock  Price</td>
                                          </tr>
                                        <tr style="font-weight:bold;">
                                          <td width="84" align="center">Ini. Q</td>
                                          <td width="64" align="center">Pur. Q</td>
                                          <td width="61" align="center">St. in</td>
                                          <td width="60" align="center">St. Out</td>
                                          <td width="93" align="center">Sale. Q</td>
                                        </tr>
                                       
                                        
                                        <?php
                                            $i=0;
                                            $tbank = 0;
                                            $tcash = 0;
                                           foreach($party_pay_list->result() as $rowcash){													  
											   $cpid=$rowcash->s_id;
											   $stock_id=$rowcash->stock_id;												   
											   $product_id=$rowcash->product_id;	
											   $init_qty=$rowcash->init_qty;
											  // $init_date=$rowcash->init_date;
											   $pur_qty=$rowcash->pur_qty;
											  // $pur_date=$rowcash->pur_date;
											   $sale_qty=$rowcash->sale_qty;
											   //$sale_date=$rowcash->sale_date;
											   $stk_in=$rowcash->stk_in;
											   //$stk_in_date=$rowcash->stk_in_date;
											   $stk_out=$rowcash->stk_out;
											   $unit_price=$rowcash->unit_price;
											   //$stk_out_date=$rowcash->stk_out_date;
											   
											   $additionQty = 	$init_qty + $pur_qty +	$stk_in;
											   $deducitonQty = 	$stk_out + $sale_qty;	
											   $totalQty = 	$additionQty - $deducitonQty;
											   $totalPrice = 	$unit_price	 * $totalQty;
											   
											   $productInfo = $this->Index_model->getAllItemTable('product','product_id',$product_id,'','','product_name','asc');
											   $pRow = $productInfo->row_array();
											   $proname = $pRow['product_name'];
											   $pSize = $pRow['size'];
											   $pro_code = $pRow['pro_code'];
											   $cat_id = $pRow['cat_id'];
											   $unit_id = $pRow['unit_id'];
											   
											   $catInfo = $this->Index_model->getAllItemTable('category','cid',$cat_id,'','','cid','asc');
											   $cRow = $catInfo->row_array();
											   $cat_name = $cRow['cat_name'];
											   
											   $unitInfo = $this->Index_model->getAllItemTable('units','unit_id',$unit_id,'','','unit_id','asc');
											   $uRow = $unitInfo->row_array();
											   $unit_name = $uRow['unit_name'];
											   
											   $stockInfo = $this->Index_model->getAllItemTable('stock_manage','id',$stock_id,'','','stock_name','asc');
											   $sRow = $stockInfo->row_array();
											   $stock_name = $sRow['stock_name'];
											$i++;
                                        ?>
                                        <tr>
                                          <td width="45" align="center"><?php echo $i;?></td>
                                          <td width="119" align="center"><?php echo $stock_name;?></td>
                                          <td width="124" align="center"><?php echo $proname;?> </td>
                                          <td width="64" align="center"><?php echo $pro_code;?> </td>
                                          <td width="49"align="center"><?php echo $pSize;?></td>
                                          <td width="69" align="center"><?php echo $cat_name;?></td>
                                          <td width="52" align="center"><?php echo $unit_name;?></td>
                                          <td align="center"><?php echo $init_qty;?></td>
                                          <td align="center"><?php echo $pur_qty;?></td>
                                          <td align="center"><?php echo $stk_in;?></td>
                                          <td align="center"><?php echo $stk_out;?></td>
                                          <td align="center"><?php echo $sale_qty;?></td>
                                          <td width="79" height="33" align="center"><?php echo $totalQty;?></td>                                          
                                          <td width="99" align="center"><?php echo $unit_price;?></td>
                                          <td width="106" align="center"><?php echo $totalPrice;?></td>
                                          </tr>
                                        
      									<?php
                                    
                                    //$tcash = $tcash + $totalcash;
                                    //$tbank = $tbank + $totalbank;
                                   // $tdue = $tdue + $due_amount;
                                   // $tqty = $tqty + $qty;											
                                    }
                                    ?>
                                    </table>                                   
  </div>
    
    <div style="width:100%; height:auto; float:left; margin-top:2cm;">	
    		<div style="width:44%; float:left">
           		 <div style="width:30%; text-align:center; float:left; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Account Officer</div>
            </div>
            <div style="width:28%; float:left">
            		<div style="width:50%; text-align:center; float:left; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Operator</div>  
            </div>
            <div style="width:28%; float:left">      	
            	<div style="width:50%; text-align:center; float:right; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Owner</div>
            </div>
        	
    </div>
</div>      
 </page>        