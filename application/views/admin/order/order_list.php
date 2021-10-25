<script type="text/javascript">
function update_status(id){
var status = document.getElementById("status"+id).value;
window.location.href='<?php echo base_url();?>admin/update_status?status='+status+"&&id="+id+"&&table="+'orders';
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Order List</h3>
                        </div>
                        
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left; width:50%;">Total Order (<?php echo $orderinfo->num_rows();?>)</h2>
                                    <h2 style="float:right; width:50%">
                                    	<?php echo form_open('');?>
		                                    <input type="text" name="keywords" class="form-control" style="width:80%; float:left" 
                                            placeholder="Search with Customer ID, Customer Name or Order Number" />
                                            <input type="submit" name="submit" value="Search" class="btn btn-success"  style="width:15%; float:left" />
                                        <?php echo form_close();?>
                                    </h2>
                                   
                                    <div class="clearfix"></div>
                                    
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table width="100%" cellpadding="2" cellspacing="1" class="table_round">
          
                                    <tr bgcolor="#666666" style="color:#fff; font-weight:bold; border:1px solid #999">
                                      <td width="30" height="36" align="center" class="table_header"><span class="style2">SI</span></td>
                                      <td width="86" align="center" class="table_header"><span class="style2">Order </span></td>
                                        <td width="187" align="center" class="table_header"><span class="style2">Order On</span></td>
                                      <td width="190" align="center" class="table_header"><span class="style2">Customer</span></td>
                                      <td width="239" align="center" class="table_header"><span class="style2">Salse Representative</span></td>
                                      <td width="314" align="center" class="table_header"><span class="style2">Status</span></td>
                                      <td width="165" align="center" class="table_header"><span class="style2">Total Price</span></td>
                                      <td width="63" align="center" class="table_header">&nbsp;</td>
                                    </tr>
									  <?php
                                      $i=0;
										  foreach($orderinfo->result() as $rowq){
										  $order_id=$rowq->order_id;
										  $order_number=$rowq->order_number;
										  $order_time=$rowq->order_time;
										  $customer_id=$rowq->customer_id;
										  $salse_id=$rowq->salse_id;
										  $status=$rowq->status;
										  $total_price=$rowq->total_price;
										  
										  if($salse_id!=0){
											  $srSql="SELECT * FROM sales_represntative WHERE user_id = ?";
											  $salseQ=$this->db->query($srSql,$salse_id);
											  if($salseQ->num_rows()>0){
												  $rowSalse=$salseQ->result();
												  foreach($rowSalse as $rows);
												  $salsename=$rows->username;
											  }
											  else{
												  $salsename='';
											  }
										  }
									   	  else{
											  $salsename='';
										  }
											  
										  $cSql="SELECT * FROM customers WHERE customer_id = ?";
										  $customerQ=$this->db->query($cSql,$customer_id);
										  if($customerQ->num_rows()>0){
											  $rowCCount=$customerQ->result();
											  foreach($rowCCount as $rowc);
											  $name=$rowc->name;
										  }
										  else{
											  $name='';
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
                                         <tr class="table_hover" bgcolor="<?php echo $c; ?>" style="border-bottom:1px solid #ccc;">
                                            <td height="44" align="center"><h6><?php echo $i;?></h6></td>
                                            <td align="center" class="section"><h6><?php echo $order_number;?></h6></td>                                            
                                            <td align="center" class="section"><h6><?php echo $order_time;?></h6></td>
                                            <td align="center" class="section"><h6><?php echo $name;?></h6></td>
                                            <td align="center" class="section"><h6><?php echo $salsename;?></h6></td>
                                            <td align="center" valign="middle" class="section">
                                          <select name="status" id="status<?php echo $order_id;?>" class="form-control" style="width:60%; float:left; margin:3px; font-size:12px; height:30px">
                                                    <option value="<?php echo $status;?>"><?php echo $status;?></option>
                                                    <option value="Processing">Processing</option>
                                                    <option value="Cancelled">Cancelled</option>
                                                    <option value="Delivered">Delivered</option>
                                                </select>
                                        <button type="button" onclick="update_status(<?php echo $order_id;?>);" class="btn btn-primary" style="padding:5px; font-size:12px;">Save</button>            </td>
                                            <td align="center" class="section"><h6>TK&nbsp;<?php echo $total_price;?></h6></td>
                                            <td align="center" class="section">
                                                <a href="<?php echo base_url();?>admin/view_order/<?php echo $order_id;?>" class="btn btn-primary btn-xs" style="padding:3px; font-size:10px;"><i class="fa fa-eye"></i> View</a>            </td>
                                            </tr>
									  <?php
                                      }
                                      ?>
                                    </table>
                                </div>
                                <div class="pagination-inner">
                                  <ul class="pagination">
                                    <?php echo "<li>". $pagination."</li>"; ?>
                                  </ul>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    

                </div>
               