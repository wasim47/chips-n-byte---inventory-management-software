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
	  height: 29.7cm; 
	}
	page[size="A4"][layout="portrait"] {
	  width: 29.7cm;
	  height: 21cm;  
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
</style>
<page size="A4" layout="portrait">
<div style="padding:1cm;">
    <div style="width:100%; float:left">	
        <div style="text-align:center; padding:5px 0; width:33%; float:left">&nbsp;</div>
         <div style="text-align:center; padding:5px 0; width:30%; float:left">
                            <!--<img src="<?php echo base_url('assets/images/logo.png')?>" style="width:100px; height:auto" />-->
                            <div style="font-size:13px; text-align:center; margin-bottom:10px;">
                                <h1 style="margin:0; padding:0">K R International</h1>
                                Imamgonj, Dhaka<br />
                                <h2 style="font-size:22px;margin:0; padding:0">Party Ledger</h2>
                                <?php  if($fromdate!=""){?>
                                <h3 style="font-size:18px;"><?php echo $fromdate.' To '.$todate;?></h3>
                                <?php }?>
                            </div>
                            </div>
         <div style="text-align:center; padding:5px 0; width:30%; float:left">
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
         <div style="text-align:left; padding:5px 0; width:30%; float:left">
             <table align="left">
                <tr>
                    <td>Buyer Code</td>
                    <td>:</td>
                    <td><?php echo $custcode;?></td>
                </tr>
                <tr>
                    <td>Buyer Name</td>
                    <td>:</td>
                    <td><?php echo $customername;?></td>
                </tr>
                <tr>
                    <td>Buyer Address</td>
                    <td>:</td>
                    <td><?php echo $address;?></td>
                </tr>
                <tr>
                    <td>Phone</td>
                    <td>:</td>
                    <td><?php echo $custphone;?></td>
                </tr>
                
            </table>
        </div>
                            
    </div>
    <div style="width:100%; height:auto;">
       <table width="100%" border="1" style="border-collapse:collapse;">
            <tr bgcolor="#e5e5e5" class="trTitle">
              <td width="55" height="33" align="center">SI</td>
              <td width="189" align="center">Date </td>
              <td colspan="2" align="center">P.T</td>
              <td width="307" align="center">Particular</td>
              <td width="157" align="center">Sale /Charge (Dr)</td>
              <td width="156" align="center">Received (Cr)</td>
              <td width="191" align="center">Balance </td>
         </tr>
          <tr>
              <td height="31" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td colspan="2" align="center">&nbsp;</td>
              <td width="307" align="center"><strong>Previous Balance</strong></td>
              <td width="157" align="center">&nbsp;</td>
              <td width="156" align="center">&nbsp;</td>
              <td width="191" align="center"><strong><?php echo $prev_balance;?></strong></td>
         </tr>                   
                             
		<?php
            $i=0;
            $tqty = 0;
            $tprice = 0;
            $tpaid = 0;
            $tdue = 0;
            $dueamo = $prev_balance;
          foreach($datewisOrder->result() as $rowq){
              $id=$rowq->id;
              $customer_id=$rowq->customer_id;
              $invoice_type=$rowq->invoice_type;													  
              $sale_amount = $rowq->sale_amount;
              $paid_amount = $rowq->paid_amount;
             $total_invoice=$rowq->total_invoice;
             $total_db_invoice=$rowq->total_db_invoice;
             /* $tprice += $sale_amount;
              $tpaid += $paid_amount;
              
             $dueamo = $tprice + $prev_balance;
             $due_amount = $dueamo - $paid_amount;*/
              $dueamo += $sale_amount - $paid_amount;
              //$due_amount =  $dueamo;
              $due_amount = $dueamo;
              $date = $rowq->date;
              $payment_date = $rowq->payment_date;
              $order_id=$rowq->order_id;
          
                                                          
           $ordque = $this->db->query("SELECT SUM(qty) AS totalqty FROM orders_products WHERE order_id = '".$order_id."'");
           if($ordque->num_rows() > 0){
             $ordr = $ordque->row_array();
             $qty = $ordr['totalqty'];
          }
          else{
             $qty = 0;
          }
          
          if($invoice_type!=''){    
                if($invoice_type=='Invoice'){															
                     $particular = 'Sales '.$qty.' Piece';
                 }
                 elseif($invoice_type=='Voucher'){
                    $total_invoice='V - '.$rowq->voucher;
                    $total_db_invoice='';
                    $particular = 'Cash Recived';
                 }
            }
            else{
                $particular = 'Sales '.$qty.' Piece';
            }
           
            $i++;
        ?>
    
    <tr class="trCont">
      <td height="30" align="center"><?php echo $i;?></td>
      <td align="center"><?php echo $payment_date;?></td>
      <td width="99" align="center"><?php echo $total_db_invoice;?></td>
      <td width="111" align="center"><?php echo $total_invoice;?></td>
      <td width="307" align="center" style="padding:5px"><?php echo $particular;?></td>
      <td width="157" align="center" style="padding:5px"><?php echo $sale_amount;?></td>
      <td width="156" align="center" style="padding:5px"><?php echo $paid_amount;?></td>
      <td width="191" align="center" style="padding:5px"><?php echo $due_amount;?></td>
    </tr>
    <?php
    
    $tprice = $tprice + $sale_amount;
    $tpaid = $tpaid + $paid_amount;
   // $tdue = $tdue + $due_amount;
    $tqty = $tqty + $qty;											
    }
    ?>
    <tr>
        <td height="26" colspan="4">&nbsp;</td>
        <td align="center"><strong><?php echo $tqty.' Piece';?></strong></td>
        <td align="center"><strong><?php echo $tprice;?></strong></td>
        <td align="center"><strong><?php echo $tpaid;?></strong></td>
        <td align="center"><strong><?php //echo $tdue;?></strong></td>
    </tr>
    </table>                                   
    </div>
    
    <div style="width:100%; height:auto; float:left; margin-top:2cm;">	
            <div style="width:15%; text-align:left; float:left; border-top:2px solid #000; padding:5px 0; font-size:15px; font-weight:bold;">Account Officer</div>        	
            <div style="width:15%; text-align:left; float:right; border-top:2px solid #000; padding:5px 0; font-size:15px; font-weight:bold;">Owner</div>
        	
    </div>
 </div>      
 </page>        