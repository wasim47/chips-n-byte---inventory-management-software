<style>
.noText {
	color: transparent;
	text-indent: -9999px;
	font-size: 0px;
    line-height: 16px; /* retains height */
	width:20px; height:20px; 
    border-radius:50%; border:none;
  }
.changeText {
	color: #fff;
	font-size: 12px;
    line-height: 16px;
	text-align:center;
	font-weight:bold;
	width:20px; 
	height:20px; 
    border-radius:50%; 
	border:none;
  }
  
.ordertable{
	width:100%;
	height:auto;
	border:1px solid #ccc;
	border-collapse:collapse;
}	
.ordertable .trTitle{
	background:#666;
	
	/*box-shadow:#666 0 0 1px 1px;*/
	
}
.ordertable .trTitle td{
	padding:5px 10px;
	color:#fff;
	overflow:hidden;
	border:none;
	text-align:center;
}

.ordertable .trCont{
	border-bottom:1px solid #ccc;
}
.ordertable .trCont td{
	padding:5px 10px;
	overflow:hidden;
	border:none;
}
	
	.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #333;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        position: fixed;
        top: 10%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: #ffffff;
		box-shadow:0px 0px 15px #999999;
        z-index:1000000;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
</style>
<?php $today=date('Y-m-d'); ?>
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
                             <table width="100%" class="ordertable">
                                            <tr bgcolor="#e5e5e5" class="trTitle">
                                              <td width="35" height="33" align="center">SI</td>
                                              <td width="90" align="center">Order </td>
                                              <td width="174" align="center">Order On</td>
                                              <td width="10%" align="center">Invoice No</td>
                                              <td width="157" align="center">Product Code </td>
                                    		  <td width="769" align="center">
                                              <?php
												$sql = 'SELECT * FROM order_status WHERE type = ?';
												$stmt = $this->db->query($sql, 'in_stock');
												foreach ($stmt->result() as $row) {												
											?>
                      								<div style="width:7.6%; float:left; text-align:left; font-weight:bold"><?php echo $row->short_name;?></div>
                                             <?php } ?>                       
                                     		 </td>
                                    </tr>
											<?php
                                                $i=0;
                                              foreach($todayOrder->result() as $rowq){
                                              $order_id=$rowq->order_id;
                                              $order_number=$rowq->order_number;
                                              $order_time=$rowq->order_time;
                                              
											  $invoicequery = $this->Index_model->getAllItemTable('invoice','order_id',$order_id,'date',$today,'inv_id','desc');
											  if($invoicequery->num_rows() > 0){
												  foreach($invoicequery->result() as $inv);
												  $inv_id=$inv->inv_id;
											  }
											  else{
											  	$inv_id=0;
											  }
											                                  
                                                if($i%2!=0)
                                                {
                                                $c="#f5f5f5";
                                                }
                                                else
                                                {
                                                $c="#FFFFFF";
                                                }
                                                $i++;
                                            ?>
                                  
                                      <tr class="trCont" bgcolor="<?php echo $c; ?>">
                                          <td height="44"><?php echo $i;?></td>
                                          <td align="left"><?php echo $order_number;?></td>
                                          <td align="left"><?php echo $order_time;?></td>
                                           <td align="left"><?php echo $inv_id;?></td>
                                    	  <td colspan="2">
                                        	<table width="100%" align="center">
													<?php 
													$orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                    foreach($orderProducts->result() as $ordPro){
														$ordproid = $ordPro->product_id;
														$ordQty = $ordPro->qty;
														
                                                        $sql = "SELECT * FROM product WHERE product_id = ?";
                                                        $prodcutlist = $this->db->query($sql,$ordproid);
                                                        foreach($prodcutlist->result() as $pro);
														
														$sqlu = "SELECT * FROM stock_order_product_status WHERE order_id = ? AND product_id = ?";
                                                        $orderstatusd = $this->db->query($sqlu,array($order_id,$ordproid));
														if($orderstatusd->num_rows() > 0){
                                                        	foreach($orderstatusd->result() as $ords);
															$status=$ords->status;
														}
														else{
															$status='Pending';
														}
                                                    ?>
                                                    <tr>
                                                    <td width="16%" align="center"><?php echo $pro->pro_code;?></td>
                                                    <td width="84%">  
                                                    <?php
														 $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
														
														$matcharray = array("return","miss_delivery","damage_delivery");
														$sql = 'SELECT * FROM order_status WHERE type = ?';
														$stmt = $this->db->query($sql, 'in_stock');
														foreach ($stmt->result() as $row) {
														
														$finalSt = explode(',',$status);
														if(in_array($row->name, $finalSt)){
															$bgcolor = $row->color;
															
															if(in_array($row->access_name, $matcharray)){
																$actionname = 'A';
																$titleval = 'Change action for '.$row->name;
																$cursor =  'cursor:default';
																$font =  'changeText';
															}
															else{
																$actionname = '';
																$titleval = $row->name;
																$cursor =  'cursor:default';
																$font =  'noText';
															}
															
															//$saction = 'onclick="loadContent('.$row->id.','.$ordproid.','.$order_time.','.$order_id.')"';	
															$ordt = "'".$order_time."'";
															$saction = '';															
														}
														else{
															$bgcolor = $row->default_color;
															$font =  'noText';
															$cursor =  'cursor:default';
															$actionname = $row->name;
															$titleval = $row->name;
															
															if(($this->session->userdata('AdminType')!="Precident") && ($this->session->userdata('AdminType')!="CEO") && 
															 ($this->session->userdata('AdminType')!="Country Manager")){
																
																if(in_array($row->access_name, $userAccess)){
																	$saction = '';
																}
																else{
																	$saction = '';
																}
															}
															else{
																$saction = '';
															}
														}
													?>
												<div style="width:7.6%; float:left; cursor:default">
                                                     <input type="button" class="<?php echo $font;?>" title="<?php echo $titleval;?>" 
                                                     style="background:<?php echo $bgcolor;?>; <?php echo $cursor;?>;" <?php echo $saction; ?> 
                                                     value="<?php echo $actionname;?>" name="status" id="status<?php echo $row->id;?>">
                                            	</div>
                                            <?php } ?> 
                                            </td>
                                              	</tr>
                                                    <?php
                                                     }
                                                    ?>
                                                    
                                                </table>
                                        </td>
                                    </tr>
                                    <?php
									  }
									  ?>
                                  </table>
                            </div>
                                        
                                        
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               