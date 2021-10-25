<style>
.black_overlay{
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: #FFFFFF;
        z-index:10001;
        -moz-opacity: 0.8;
        opacity:.80;
        filter: alpha(opacity=80);
    }
    .white_content {
        display: none;
        position: fixed;
        top: 20%;
        left: 25%;
        width: 60%;
        height: 60%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }
	/*.returnContent {
        display: none;
        position: fixed;
        top: 20%;
        left: 20%;
        width: 66%;
        height: 33%;
        padding: 10px;
        border: 3px solid #FFFFFF;
        background-color: white;
		box-shadow:0px 0px 15px #999999;
        z-index:10002;
        overflow: auto;
		-moz-border-radius:5px;
		border-radius:5px;
    }*/
</style>
<script type="text/javascript">

function loadContent(pid)
{
	document.getElementById('prodcut_id').value=pid;
	$("#light1").show('slow');
	$("#fade").show('slow');
}

function closeButton()
{
	$("#light1").hide('medium');
	$("#fade").hide('medium');
}
function loadContentMinus(pid,proname)
{
	document.getElementById('prodcutId').value=pid;
	document.getElementById('proname').innerHTML=proname;
	$("#light2").show('slow');
	$("#fade").show('slow');
}

function closeButtonMinus()
{
	$("#light2").hide('medium');
	$("#fade").hide('medium');
}

function returnArea(pid,proname)
{
	//alert(pid);
	document.getElementById('returnProduct').value=pid;
	document.getElementById('retproname').innerHTML=proname;
	$("#returnArea").show('slow');
	$("#fade").show('slow');
}

function closereturnArea()
{
	$("#returnArea").hide('medium');
	$("#fade").hide('medium');
}
function loadContentHistory(pid)
{
	$.ajax({
            type: "POST",
            url: "<?php echo base_url();?>admin/inventory_history",
            data: ({'pro_id' : pid}),
            success: function(response){
               if(response=='success')
                {   
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                }
                else
                {
                    document.getElementById("light3").innerHTML=response;
					$("#light3").show('slow');
					$("#fade").show('slow');
                   
                }
            }          
        });
}

function closeButtonHistory()
{
	$("#light3").hide('medium');
	$("#fade").hide('medium');
}




function prodSaleType()
{
	var thispro = document.getElementById('sell_type').value;
	if(thispro=="Whole Sale"){
		document.getElementById('selltypedata').style.display='inline';
	}
	else if(thispro=="Retailer"){
		document.getElementById('selltypedata').style.display='none';
	}
}
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Main Stock</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2 style="float:left; width:20%">Total product (<?php echo $product_list->num_rows();?>)</h2>
                                    <!--<h2 style="float:left; width:70%">
                               			 <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search for...">
                                    <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                                </div>
                                    </h2>-->
                                    <div class="clearfix"></div>
                                   
                                </div>
                                <div class="x_content">
                                <div style="width:100%"><?php echo $this->session->flashdata('successMsg');?></div>
                                <div class="container">
                                  <table class="table table-striped" width="100%">
                                    <thead>
                                      <tr>
                                        <th width="2%" align="center">SI</th>
                                        <th width="34%" align="center">Product Name</th>
                                        <th width="15%" align="center">Product Category</th>
                                        <th width="13%" align="center">Stock</th>
                                        <th width="19%" align="center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
									$i=0;
									$total =0;
                                    foreach($product_list->result() as $productData):
									$product_id=$productData->product_id;
									$productTitle=$productData->product_name;
									$cat_id=$productData->cat_id;
									
									/*$catquery=$this->Index_model->getAllItemTable('category','caegory_title',$cat_id,'','','cid','desc');
									if($catquery->num_rows() > 0){
										foreach($catquery->result() as $cat_row);
										$cateName=$cat_row->cat_name;
									}
									else{
										$cateName='NULL';
										}*/
									
									
									
									$i++;
									?>
                                      <tr>
                                        <td align="left"><?php echo $i;?></td>
                                        <td align="left"><?php echo $productTitle; ?></td>
                                        <td align="left"><?php //echo $cateName; ?></td>
                                      <td align="left"> 
                                         	<?php 
											$stock=$this->db->query("SELECT SUM(init_qty)+SUM(pur_qty) AS qty FROM stock WHERE product_id='$product_id'");
											if($stock->num_rows() > 0){
												$drwos = $stock->row_array();
												$stockQty = $drwos['qty'];
												$total = $total + $stockQty;
											}
											else{
												$total=0;
												$stockQty=0;
											}
											echo $stockQty;
											
											if($stockQty!='' || $stockQty!=0){
												$cls='inline';
											}
											else{
												$cls='none';
											}
											
											$returnpro=$this->db->query("SELECT sum(pro_qty) as qty FROM return_product WHERE pro_id='".$product_id."'");
											if($returnpro->num_rows() > 0){
												$rrow = $returnpro->row();
												$retQty = ' ( '.$rrow->qty.' Qty)';
											}
											else{
												$retQty=0;
											}
											?>                                         </td>
                                         <td align="left" class="section">
                                        
                                         <div style="display:<?php echo $cls;?>">
                                        <a  href="javascript:void()" onclick ="loadContent(<?php echo $product_id;?>)" style="text-decoration:none;">
                                                <i class="fa fa-plus"></i></a>&nbsp;&nbsp;
                                    <a  href="javascript:void()" onclick ="loadContentMinus(<?php echo $product_id;?>,'<?php echo $productTitle;?>')" style="text-decoration:none;">
                                    <i class="fa fa-minus"></i></a>&nbsp;&nbsp;
                                    <!--<a  href="<?php echo base_url('admin/inventory_history/'.$product_id);?>" style="text-decoration:none;">
                                    <i class="fa fa-history"></i></a>&nbsp;&nbsp;-->
                                    <a  href="javascript:void()" onclick ="returnArea(<?php echo $product_id;?>,'<?php echo $productTitle;?>')" style="text-decoration:none;">
                                    Return <?php echo $retQty;?></a></div>
                                                    
                                    </td>
                                      </tr>
                                    <?php
                                    endforeach;
									?>  
                                      
                                      <tr>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                        
                                         <td align="center"> 
                                         	<?php echo 'Total Qty : '.$total;?>
                                         </td>
                                         <td>&nbsp;</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
               
  
  
<div id="light1" class="white_content">
<?php echo form_open('admin/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Add Quantity</div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closeButton()">
            <i class="fa fa-close"></i></a></div>
      </div>
     <div class="col-sm-8 col-sm-offset-3" style="margin-top:10%;">
      
      
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="text" name="pluse_qty" required placeholder="QTY" class="form-control" style="width:60%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
     
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	<input type="hidden" name="product_id" id="prodcut_id" />
                                        <input type="submit" value="Add" name="add" class="btn btn-primary"/>
        </div>
      </div>
      </div>
</div>
<?php echo form_close();?>
</div>
<div id="light2" class="white_content">
<?php echo form_open('admin/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     
      <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Stock Out : <span id="proname"></span></div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closeButtonMinus()">
            <i class="fa fa-close"></i></a></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Buyer Name</label></div>
        <div class="col-sm-7"><input type="text" name="buyername" required placeholder="Full name" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Buyer Contact</label></div>
        <div class="col-sm-7"><input type="text" name="buyercontact" required placeholder="Contact Number" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Email Address</label></div>
        <div class="col-sm-7"><input type="text" name="buyeremail" required placeholder="Email Address" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
        onBlur="this.placeholder='Buyer Name'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="number" name="minus_qty" maxlength="11" required placeholder="QTY" class="form-control" style="width:20%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Details</label></div>
        <div class="col-sm-7"><textarea rows="2" cols="80" name="remarks" style="width:100%;margin-bottom:5px;" class="form-control"></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	<input type="hidden" name="product_id" id="prodcutId" />
                                        <input type="submit" value="Minus" name="minus"  class="btn btn-primary"/>
        </div>
      </div>
</div>
<?php echo form_close();?>

</div>
<div id="returnArea" class="white_content">
<?php echo form_open('admin/stock_update');?>
<div style="background:#f5f5f5; width:100%; height:100%;">
     
      <div class="form-group">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="font-size:18px; margin-bottom:10px;">Return : <span id="retproname"></span></div>
        <div class="col-sm-1"><a href ="javascript:void(0)" title="Close" onclick ="closereturnArea()">
            <i class="fa fa-close"></i></a></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Invoice Number</label></div>
        <div class="col-sm-7"><input type="text" name="invoiceno" required placeholder="Invoice Number" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''"  onBlur="this.placeholder='Invoice Number'"/></div>
      </div>
       <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Return Sale Type</label></div>
        <div class="col-sm-7">
        	<select name="sell_type" id="sell_type" class="form-control" style="width:70%;margin-bottom:5px;" onchange="prodSaleType();">
            	<option value="Retailer">Retailer</option>
                <option value="Whole Sale">Whole Sale</option>
            </select>
        </div>
      </div>
      <div id="selltypedata" style="display:none">
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Buyer Name</label></div>
            <div class="col-sm-7"><input type="text" name="buyername" placeholder="Full name" class="form-control" style="width:70%; margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Buyer Contact</label></div>
            <div class="col-sm-7"><input type="text" name="buyercontact" placeholder="Contact Number" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
          <div class="form-group">
            <div class="col-sm-3"><label class="control-label">Email Address</label></div>
            <div class="col-sm-7"><input type="text" name="buyeremail" placeholder="Email Address" class="form-control" style="width:70%;margin-bottom:5px;" onFocus="this.placeholder=''" 
            onBlur="this.placeholder='Buyer Name'"/></div>
          </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Product Qty</label></div>
        <div class="col-sm-7"><input type="number" name="return_qty" maxlength="11" required placeholder="QTY" class="form-control" style="width:20%;margin-bottom:5px;" onFocus="this.placeholder=''" onBlur="this.placeholder='QTY'"/></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3"><label class="control-label">Details</label></div>
        <div class="col-sm-7"><textarea rows="2" cols="80" name="remarks" style="width:100%;margin-bottom:5px;" class="form-control"></textarea></div>
      </div>
      <div class="form-group">
        <div class="col-sm-3">&nbsp;</div>
        <div class="col-sm-7">
        	 <input type="hidden" name="product_id" id="returnProduct" />
             <input type="submit" value="Return" name="return"  class="btn btn-primary"/>
        </div>
      </div>
</div>
<?php echo form_close();?>

</div>
<div id="light3" class="historyContent"></div>
<div id="fade" class="black_overlay"></div>