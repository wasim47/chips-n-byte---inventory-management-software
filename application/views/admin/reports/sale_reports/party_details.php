<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3><?php echo $customername;?> Order Details</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/datewise_sale_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/datewise_sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                        	<div class="container">
                                               <table width="100%" class="ordertable">
                                                <tr bgcolor="#e5e5e5" class="trTitle">
                                                  <td width="51" height="33" align="center">SI</td>
                                                  <td width="57" align="center">Order </td>
                                                  <td width="137" align="center">Order On</td>
                                                  <td width="86" align="center">Invoice No</td>
                                                  <td width="320" align="center">Product Name </td>
                                                  <td width="82" align="center">Code </td>
                                                  <td width="96" align="center">Price </td>
                                                  <td width="86" align="center">Size </td>
                                                  <td width="99" align="center">Qty </td>
                                                  <td width="83" align="center">Total Price </td>
                                                  <td width="91" align="center">Paid </td>
                                                   <td width="77" align="center">Due </td>
                                             </tr>
                                                <?php
                                                    $i=0;
                                                    $tqty = 0;
                                                    $tprice = 0;
                                                    $tpaid = 0;
                                                    $tdue = 0;
												// echo $datewisOrder->num_rows();
                                                  foreach($datewisOrder->result() as $rowq){
                                                  $order_id=$rowq->order_id;
                                                  $order_number=$rowq->order_number;
                                                  $order_time=$rowq->order_time;
                                                  $closingDate=$rowq->date;
                                                  $total_price = $rowq->total_price;
                                                  $paid_amount = $rowq->paid_amount;
                                                  $due_amount = $total_price - $paid_amount;
                                                  
                                                  $invoicequery=$this->Index_model->getItemBetween('invoice','order_id',$order_id,'date',$fromdate,$todate,'order_id','desc');
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
                                              <td colspan="5">
                                                <table width="100%" align="center" border="1" bordercolor="#CCCCCC" style="border-collapse:collapse">
                                                        <?php 
                                                        $orderProducts = $this->Index_model->getAllItemTable('orders_products','order_id',$order_id,'','','id','desc');
                                                        foreach($orderProducts->result() as $ordPro){
                                                            $ordproid = $ordPro->product_id;
                                                            $ordQty = $ordPro->qty;
                                                            
                                                            
                                                            $sql = "SELECT * FROM product WHERE product_id = ?";
                                                            $prodcutlist = $this->db->query($sql,$ordproid);
                                                            foreach($prodcutlist->result() as $pro);														
                                                        ?>
                                                        <tr>
                                                           <td width="46%" align="center" style="padding:5px"><?php echo $pro->product_name;?></td>
                                                          <td width="13%" align="center" style="padding:5px"><?php echo $pro->pro_code;?></td>
                                                          <td width="14%" align="center" style="padding:5px"><?php echo $pro->price;?></td>
                                                          <td width="13%" align="center" style="padding:5px"><?php echo $pro->size;?></td>
                                                          <td width="14%" align="center" style="padding:5px"><?php echo $ordQty;?></td>
                                                    </tr>
                                                        <?php
                                                            $tqty = $tqty + $ordQty;
                                                         }
                                                        ?>	
                                                </table>
                                            </td>
                                            <td width="83" align="center" style="padding:5px"><?php echo $total_price;?></td>
                                            <td width="91" align="center" style="padding:5px"><?php echo $paid_amount;?></td>
                                            <td width="77" align="center" style="padding:5px"><?php echo $due_amount;?></td>
                                            </tr>
                                            <?php
                                            
                                            $tprice = $tprice + $total_price;
                                            $tpaid = $tpaid + $paid_amount;
                                            $tdue = $tdue + $due_amount;
                                            
                                            }
                                            ?>
                                            <tr>
                                                <td height="50" colspan="8">&nbsp;</td>
                                                <td align="center"><strong><?php echo $tqty;?></strong></td>
                                                <td align="center"><strong><?php echo $tprice;?></strong></td>
                                                <td align="center"><strong><?php echo $tpaid;?></strong></td>
                                                <td align="center"><strong><?php echo $tdue;?></strong></td>
                                            </tr>
                                            
                                            <tr>
                                                 <td height="39" colspan="2">&nbsp;</td>
                                                <td align="center" colspan="1"><h4 style="color:#000066;"><?php echo 'Total Qty: <strong>'.$tqty.'</strong>';?></h4></td>
                                                <td align="center" colspan="3"><h4 style="color:#999900;"><?php echo 'Total Price: BDT <strong>'.$tprice.'</strong> /= TK';?></h4></td>
                                                <td align="center" colspan="3"><h4 style="color:#009900;"><?php echo 'Total Paid: BDT <strong>'.$tpaid.'</strong> /= TK';?></h4></td>
                                                <td align="center" colspan="3"><h4 style="color:#FF0000;"><?php echo 'Total Due: BDT <strong>'.$tdue.'</strong> /= TK';?></h4></td>
                                            </tr>
                                            
                                            </table>                          
											</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
