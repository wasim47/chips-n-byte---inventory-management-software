
<div class="white_content" style="text-align:center">
      <table width="100%" border="0" cellspacing="2" cellpadding="3"  align="center">
          <tr>
            <td height="52" align="left" valign="top">
                <a href ="javascript:void(0)" title="Close" onclick ="closeButton()" id="popclose"><i class="fa fa-close"></i></a> </td>
                <td colspan="1" valign="bottom"><h2>Status:  <?php echo $ord_status;?></h2></td>
                <?php
                	if($returnorderpro->num_rows() > 0){
					//echo $returnorderpro->num_rows();
				?>
                <td colspan="1" valign="bottom">
                	<?php echo form_open('admin/new_return_invoice');?>
                         <input type="hidden" name="order_id" value="<?php echo $orderid;?>" />
                         <input type="hidden" name="old_quantity" value="<?php echo $old_qty;?>" />
                         <input type="hidden" name="new_quantity" value="<?php echo $new_qty;?>" />
                         <input type="hidden" name="ord_status" value="<?php echo $ord_status;?>" />
                         <input type="hidden" name="new_pro" value="<?php echo $new_pro;?>" />
                         <input type="hidden" name="old_pro" value="<?php echo $old_pro;?>" />
                         <input type="submit" name="invoiceCreate" value="Get Invoice"class="btn btn-primary" />
                    <?php echo form_close();?>
    			</td>
                <?php
                }
				?>
              </tr>
          
          <tr>
            <td height="15" colspan="3"></td>
          </tr>
          <tr>
            <td colspan="3">
            	<?php
                	if($returnorderpro->num_rows() > 0){
					//echo $returnorderpro->num_rows();
				?>
                 		<table width="100%" class="ordertable" border="1">
                            <tr bgcolor="#e5e5e5" class="trTitle">
                                  <td width="18%" align="center" valign="middle">Product Name</td>
                                  <td width="16%" align="center" valign="middle">Image</td>
                                  <td width="18%" align="center" valign="middle">Product Code</td>
                                  <td width="16%" align="center" valign="middle">Product Price</td>
                             </tr>
                              <tr>
                                  <td height="34" colspan="4" align="center" valign="middle"><strong><?php echo $ord_status;?> Product</strong></td>
                          </tr>
                            <tr>
                                  <td width="18%" align="center" valign="middle"><?php echo $productName;?></td>
                                  <td width="16%" align="center" valign="middle">
                                  	<img src="<?php echo base_url('uploads/images/product/main_img/'.$main_image);?>" style='width:100px; height:auto'/>
								  </td>
                                  <td width="18%" align="center" valign="middle"><?php echo $productCode;?></td>
                                  <td width="16%" align="center" valign="middle"><?php echo $pro_price;?></td>
                             </tr>
                             
                             
                             <tr>
                                  <td height="36" colspan="4"align="center" valign="middle"><strong>New Product</strong></td>
                             </tr>
                            <tr>
                                  <td width="18%" align="center" valign="middle"><?php echo $productNameN;?></td>
                                  <td width="16%" align="center" valign="middle">
                                  	<img src="<?php echo base_url('uploads/images/product/main_img/'.$main_imageN);?>" style='width:100px; height:auto'/>
								  </td>
                                  <td width="18%" align="center" valign="middle"><?php echo $productCodeN;?></td>
                                  <td width="16%" align="center" valign="middle"><?php echo $pro_priceN;?></td>
                             </tr>
                            	
                                 
                                
                                
                                
                                
                                
                                
                                                   
                        </table>
                <?php
                }
				else{
				?>
                <table width="100%">
                   <tr>
                    <td colspan="3" align="center">
                        <table width="50%" align="center">
                            <tr>
                                <td width="40%"><input type="button" value="Return Payment" class="btn btn-danger" name="retpay" id="retpay" 
                                onclick="orderListDispl('returnpay');"/></td>
                                <td width="10%"></td>
                                <td width="40%"><input type="button" value="Place Order" class="btn btn-info" name="orderplace" id="orderplace" 
                                onclick="orderListDispl('orderplace');"/></td>
                              </tr>
                        </table>
                    </td>
                  </tr>          
                   <tr>
                    <td colspan="3" align="center">
                        <div  id="productList" style="display:none; margin:10px auto;">
                             <table width="100%" class="ordertable" border="1">
                              <tr bgcolor="#e5e5e5" class="trTitle">
                                  <td width="18%" align="center" valign="middle">Product Name</td>
                                  <td width="16%" align="center" valign="middle">Image</td>
                                  <td width="18%" align="center" valign="middle">QTY</td>
                                  <td width="18%" align="center" valign="middle">Product Code</td>
                                  <td width="16%" align="center" valign="middle">Product Price</td>
                             </tr>
                            <tr>
                              <td width="18%" align="center" valign="middle">					  
                              
                              <select class="form-control" name="newproid" id="newproid" style="border:none; background:none; padding:0; margin:0; cursor:pointer"
                              onchange="changeproduct(this.value);">
                              <option value="">Select Product</option>
                              <?php 
                                 $sql = "SELECT * FROM product";
                                 $prodcutlist = $this->db->query($sql);
                                    foreach($prodcutlist->result() as $pro){	
                                ?>
                                <option value="<?php echo $pro->product_id;?>"><?php echo $pro->product_name;?></option>
                                <?php
                                 }
                                ?>
                              </select>
                              </td>
                              <td width="16%" align="center" valign="middle"><span id="proimg"></span></td>
                              <td width="18%" align="center" valign="middle"><input type="text" id="newqty"  
                              style="border:none; background:none; text-align:center; width:100%;"/></td>
                              <td width="18%" align="center" valign="middle"><input type="text" id="procode"  
                              style="border:none; background:none; text-align:center; width:100%;" readonly="readonly"/></td>
                              <td width="16%" align="center" valign="middle"><input type="text" id="proprice" 
                               style="border:none; background:none;text-align:center; width:100%;" readonly="readonly"/></td>
                          </tr>
                           
                        </table>
                      </div>
                        <div  id="retamount" style="display:none">
                            <input type="text" name="retamount" id="retamount" class="form-control" placeholder="Enter Amount" style="width:60%; text-align:center; margin:20px auto" />
                        </div>
                    </td>
                  </tr>          
                   <tr>
                    <td valign="top" colspan="3">
                        <input type="hidden" name="product_id" id="ordproid"  value="<?php echo $ord_product_id;?>"/>
                        <input type="hidden" name="oid" id="oid" value="<?php echo $orderid;?>" />
                        <input type="hidden" name="oldqty" id="oldqty" value="<?php echo $quantity;?>" />
                        <input type="hidden" name="orderdate" id="orderdate" value="<?php echo $orderdate;?>" />
                        <input type="hidden" name="ordstatus" id="ordstatus"  value="<?php echo $ord_status;?>"/>
                        <input type="hidden" name="back_type" id="back_type" />
        
                        <span id="loaderHide">
                        <button type="button" onclick="updateNewOrder();" class="btn btn-success btn-submit" id="submitbtn" style="display:none; margin-top:10px;">Submit</button></span>
                        <span id="LoadingImage" style="display:none;"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                        <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                        <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
                    </td>
                  </tr>
                </table>
                 <?php
                }
				?>
            </td>
          </tr>
          
          
          
          
          
        </table>
</div>


<div id="fade" class="black_overlay"></div>        
<div id="orderlight" class="historyContent"></div>
