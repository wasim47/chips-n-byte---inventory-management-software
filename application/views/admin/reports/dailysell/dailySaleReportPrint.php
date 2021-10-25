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
                                              <th width="23%" height="34" align="left">Product Name</th>
                                              <th width="13%" height="34" align="left">Product Code</th>
                                               <th width="13%" align="left">Quantity</th>
                                              <th width="10%" height="34" align="left">Order No</th>
                                              <th width="10%" height="34" align="left">Invoice No</th>
                                              <th width="15%" align="left">Supplier</th>
                                              <th width="16%" colspan="2" align="right">Invoice Total</th>
                                            </tr>
                                            <?php
                                            $i=0;
                                            $costCount = 0;
                                            foreach($todayOrder->result() as $payrow){
											 
											  $today=date('Y-m-d');
											  $invoicequery=$this->db->query("select * from invoice where order_id='".$payrow->order_id."' and date='".$today."' 
											  order by inv_id desc");
											  foreach($invoicequery->result() as $inv);
											  $inv_id=$inv->inv_id;
											 
											  $ordproductquery=$this->db->query("select * from orders_products where order_id='".$payrow->order_id."' order by id desc");
											  foreach($ordproductquery->result() as $ordpro){
												  $product_id[]=$ordpro->product_id;
												  $supplier_id[]=$ordpro->supplier;
												  $qty[]=$ordpro->qty;
											  }
											  $proArray = join(',',$product_id);
											  $suppArray = join(',',$supplier_id);
											  
											  $supplierquery=$this->db->query("select * from supplier where user_id IN($suppArray) order by user_id desc");
											  foreach($supplierquery->result() as $supp){
												$suppName[]=$supp->username;
											  }
											  
											  $suppExp = join(',',$suppName); 
											  $exp = explode(',',$suppExp);
											  $supplierNameDis = implode('<br>',$exp);
												  
											  $productquery=$this->db->query("select * from product where product_id IN($proArray) order by product_id asc");
											  foreach($productquery->result() as $pro){
											  	$proName[]=$pro->product_name;
											  	$proCode[]=$pro->pro_code;
											  }
											  
											$proNameExp = join(',',$proName);
											$expn = explode(',',$proNameExp);
											$productNameDis = implode('<br>',$expn);
											 
											$proCodeExp = join(',',$proCode);
											$expc = explode(',',$proCodeExp);
											$productCodeDis = implode('<br>',$expc);
											
											$proQtyExp = join(',',$qty);  
											$expq = explode(',',$proQtyExp);
											$productQtyDis = implode('<br>',$expq);
											
																											  
                                            if($i%2==0){
                                                $clr='#fff';
                                            }
                                            else{
                                                $clr='#eaeaea';
                                            }
                                            $i++;
                                            
                                            ?>
                                            
                                            
                                            <tr bgcolor="<?php echo $clr;?>">
                                                <td align="left"><?php echo $productNameDis;?></td>
                                                <td align="left"><?php echo $productCodeDis;?></td>
                                                <td align="left"><?php echo $productQtyDis;?></td>
                                                <td align="left"><?php echo $payrow->order_number;?></td>
                                                <td align="left"><?php echo $payrow->inv_id;?></td>
                                                <td align="left"><?php echo $supplierNameDis;?></td>
                                                <td colspan="2" align="center"><?php echo $payrow->total_price; ?></td>
                                            </tr>
                                            
                                            <?php
                                            $costCount = $costCount + $payrow->total_price;
                                            }	
                                            
                                            ?>
                                            
                                             <tr>
                                                 <th align="right" colspan="8">
                                                 <div style="float:right; font-size:18px">Total Amount = <?php echo 'TK '.number_format($costCount,2,'.',',').' /=';?></div></th>
                                              </tr>
                                            </table>
                            </div>
                                        
                                        <div class="container"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               