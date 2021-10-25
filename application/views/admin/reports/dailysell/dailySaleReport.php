<script type="text/JavaScript">
function openPage1(pid,tablename,colid)
{
	var b = window.confirm('Are you sure, you want to Delete This ?');
	if(b==true){
		$.ajax({
			   type: "GET",
			   url: '<?php echo base_url()?>admin/deleteData/'+tablename+'/'+colid,
			   data: "deleteId="+pid,
			   success: function() {
				  alert("Successfully saved");
				  window.location.reload(true);
				},
				error: function() {
				  alert("There was an error. Try again please!");
				}
		 });
	}
	else{
	 return;
	}
	 
}
</script>
<?php $today=date('Y-m-d'); ?>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Daily Sale Reports</h3>
                      </div>
                        <div class="title_right">
                            <h2 style="text-align:right; float:right"><a href="<?php echo base_url('admin/daily_sale_reports/print');?>" onclick="javascript:void window.open('<?php echo base_url('admin/daily_sale_reports/print');?>','','width=1100,height=400,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=200,top=30');return false;"><i class="fa fa-print"></i> Print</a></h2>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">

                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                        <div class="container">
                                          <div style="font-size:18px; border-bottom:1px solid #ccc; float:left; width:100%; margin-bottom:5px;"></div>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               