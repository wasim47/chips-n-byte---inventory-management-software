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
	padding:5px 10px;
	color:#000;
}
.summTable .theadline td, th{
	padding:2px;
	color:#fff;
	background:#666;
}
</style>
<page size="A4" layout="portrait">
<div style="padding:1cm;">
    <div style="width:100%; float:left">	
        <div style="text-align:center; padding:5px 0; width:20%; float:left">&nbsp;</div>
         <div style="text-align:center; padding:5px 0; width:60%; float:left">
                            <!--<img src="<?php echo base_url('assets/images/logo.png')?>" style="width:100px; height:auto" />-->
                            <div style="font-size:13px; text-align:center; margin-bottom:10px;">
                                <h2 style="padding:0; margin:0"><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100px; height:auto" 
                                        title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></h2>           
                                <p><?php echo $cadd;?></p>
                                <h2 style="font-size:22px;margin:0; padding:0; text-decoration:underline">Purchase Report (By Product)</h2>
                                <?php  if($fromdate!=""){?>
                                <h3 style="font-size:18px;"><?php echo $fromdate.' To '.$todate;?></h3>
                                <?php }?>
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
       <table width="100%" class="summTable" border="1">
                                                <tr class="theadline">
                                                  <td width="35" height="28" align="center">SI</td>
                                                  <td width="150" align="center">Date </td>
                                                  <td width="80" align="center">Code </td>
                                                  <td width="295" align="center">Product Name </td>
                                                  <td width="95" align="center">Size </td>
                                                  <td width="104" align="center">Quantity </td>
                                                  <td width="95" align="center">Unit Rate </td>
                                                  <td width="96" align="center">Commission </td>
                                                  <td width="143" align="center">Total Price </td>
         </tr>
                                                <?php
                                                    $i=0;
                                                    $tqty = 0;
                                                    $tprice = 0;
                                                    $tpaid = 0;
                                                    $tdue = 0;
													//echo $saleproductinfo->num_rows();
                                                  foreach($purproductinfo->result() as $rows){	
													  $product_id=$rows->bid_pid;
													  $total_amount=$rows->bid_netprise;
													  $total_qty=$rows->bid_qty;
													  $sale_price=$rows->bid_prise;
													  $commission=$rows->bid_discount;
													  $date=$rows->bid_todaydate;
                                                  
												  	  $productinfo = $this->Index_model->getAllItemTable('product','product_id',$product_id,'','','product_name','desc');
													  if($productinfo->num_rows() > 0){
													  foreach($productinfo->result() as $rowq);
														  $product_name=$rowq->product_name;
														  $pro_code=$rowq->pro_code;
														  $size=$rowq->size;
													  }
													  else{
													  	  $product_name='';
														  $pro_code='';
														  $size='';
													  }
													 
	                                                    $i++;
                                                ?>
                                            
                                            <tr class="trCont">
                                              <td height="26" align="center"><?php echo $i;?></td>
                                              <td width="150" align="center"><?php echo $date;?></td>
                                              <td width="80" align="center"><?php echo $pro_code;?></td>
                                              <td width="295" align="left"><?php echo $product_name;?></td>
                                              <td width="95" align="right"><?php echo $size;?></td>
                                              <td align="right"><?php echo $total_qty;?></td>
                                              <td width="95" align="right"><?php echo $sale_price;?></td>
                                              <td width="96" align="right"><?php echo $commission;?></td>
                                              <td width="143" align="right"><?php echo $total_amount;?></td>
         </tr>
                                            <?php
                                            /*$tqty = $tqty + $totalqty;
                                            $tprice = $tprice + $tsaleam;
                                            $tpaid = $tpaid + $tpaidam;
                                            $tdue = $tdue + $tdueam;*/
                                            
                                            }
                                            ?>
                                            <?php /*?><tr>
                                                <td height="31" colspan="4">&nbsp;</td>
                                              <td align="center"><h4 style="color:#000066; font-size:15px;"><?php echo 'Total Qty: <strong>'.$tqty.'</strong>';?></h4></td>
                                                <td align="center"><h4 style="color:#999900; font-size:15px;"><?php echo 'Total Price: BDT <strong>'.$tprice.'</strong>';?></h4></td>
                                                <td width="20" align="center"><h4 style="color:#009900; font-size:15px;"><?php echo 'Total Paid: BDT <strong>'.$tpaid.'</strong>';?></h4></td>
                                              <td width="22" align="center"><h4 style="color:#FF0000; font-size:15px;"><?php echo 'Total Due: BDT <strong>'.$tdue.'</strong>';?></h4></td>
                                            </tr><?php */?>
                                            
                                           
                                            </table>                                   
    </div>
    
    <div style="width:100%; height:auto; float:left; margin-top:2cm;">	
            <div style="width:15%; text-align:left; float:left; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Account Officer</div>        	
            <div style="width:15%; text-align:left; float:right; border-top:2px solid #000; padding:5px 0; font-weight:bold;" class="printfontsize">Owner</div>
        	
    </div>
</div>      
 </page>        