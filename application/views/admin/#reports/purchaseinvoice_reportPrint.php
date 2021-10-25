<?php 
$fromdate=$this->session->userdata('toDate');
$todate=$this->session->userdata('fromDate');
$supplier=$this->session->userdata('supplier');
?>
<div class="right_col" role="main">
                <div class="">

                    <div style="width:100%; float:left">	
                                  	  		<div style="text-align:center; padding:5px 0">
                                        	
                                            <img src="<?php echo base_url('assets/images/logo.png')?>" style="width:15%; height:auto" />
                                            <address style="font-size:13px; text-align:center">
                                                B-34/Ka (1st Floor), Shop No. 28  Khilkhet Super Market, Khilkhet, Dhaka-1229<br />
                                                Cell: +8801673628242, +8801941709999<br />
                                                E-mail: halim.helal@gmail.com, mhistudybd@gmail.com<br />
                                                Web: www.mhinternationalstudy.com
                                            </address>
                                            </div>
                                   </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                        <div class="container"></div>
                           <div class="container">
                             <table class="table table-striped" width="100%">
    <tr bgcolor="#ccc">
         <th width="16%" height="33" align="left">Invoice No</th>
         <th width="21%" align="left">Manual Invoice No</th>
         <th width="25%" align="left">Supplier</th>
         <th width="19%" colspan="2" align="right">Invoice Total</th>
         <th width="19%" align="right">&nbsp;</th>
      </tr>
    <?php
    $i=0;
    $costCount = 0;
    
	if($supplier=='')
	{
		$queryCost=$this->db->query("SELECT purchase_invoice.*,supplier.user_id,supplier.username 
		FROM
		purchase_invoice 
		LEFT JOIN supplier ON purchase_invoice.bi_cname=supplier.user_id
		WHERE purchase_invoice.bi_date between '$fromdate' and '$todate'");
	}
	else
	{
		$queryCost=$this->db->query("SELECT purchase_invoice.*,supplier.user_id,supplier.username 
		FROM
		purchase_invoice 
		LEFT JOIN supplier ON purchase_invoice.bi_cname=supplier.user_id
		WHERE purchase_invoice.bi_cname='$supplier' AND purchase_invoice.bi_date between '$fromdate' and '$todate'");
	}	
	
	
    foreach($queryCost->result() as $payrow){
                                      
    if($i%2==0){
        $clr='#fff';
    }
    else{
        $clr='#eaeaea';
    }
    $i++;
    
    ?>
    
    
    <tr bgcolor="<?php echo $clr;?>">
        <td align="left"><?php echo $payrow->bi_id;?></td>
        <td align="left"><?php echo $payrow->minvoice; ?></td>
        <td align="left"><?php echo $payrow->username; ?></td>
        <td colspan="2" align="center"><?php echo $payrow->bi_totalnet; ?></td>
        <td align="right">&nbsp;</td>
    </tr>
    
    <?php
    $costCount = $costCount + $payrow->bi_totalnet;
    }	
    
    ?>
    
     <tr>
         <th align="right" colspan="6">
         Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></th>
      </tr>
    </table>
                            </div>
                                        
                                        <div class="container"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               