<?php
	$id='';
	$userid='';
	$custname='';
	$amount='';
	$received_by='';
	$particulars='';
	$pay_method='';
	$paid_date='';
	$digits = 4;
	$voucher = rand(pow(10, $digits-1), pow(10, $digits)-1);
?>


<script>
function paymentMethodD(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('bankinfo').style.display="inline";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('tranid').style.display="inline";
		document.getElementById('bkash_no').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
	}
}
function paymentMethod(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('bankinfo').style.display="inline";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('tranid').style.display="inline";
		document.getElementById('bkash_no').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
	}
}
function checkPay(){
	var total_price = document.getElementById("total_price").value;
	var paid_amount = document.getElementById("paid_amount").value;
	var exspaid = document.getElementById("exspaid").value;
	
	var finalPaid = parseInt(exspaid) + parseInt(paid_amount);
	if(parseInt(finalPaid) > parseInt(total_price)){
		//alert("You can't pay more than Order Total price and not less than 10 Taka");
		document.getElementById("paid_amount").value='';
		document.getElementById("errormsg").innerHTML="You can't pay more than Order Total price and not less than 10 Taka";
		document.getElementById("errormsg").style.color="#dd5044";
		document.getElementById("paid_amount").focus();
		//return false;
	}
	else{
		document.getElementById("errormsg").innerHTML="Valid Data";
		document.getElementById("errormsg").style.color="#19a15f";
	}
}

function reportsAjax()
{
	  var userid = $("#supplier_id").val();
	  var voucher = $("#voucher").val();
	  var amount = $("#amount").val();
	  var pay_method = $("#pay_method").val();
	  var received_by = $("#received_by").val();
	  var particulars = $("#particulars").val();
	  var pay_date = $("#pay_date").val();
	  var bkash_no = $("#bkash_no").val();
	  var tranid = $("#tranid").val();
	  var bankinfo = $("#bankinfo").val();
	  //alert(jid);
   	  var surl = '<?php echo base_url('admin/debit_voucher_action');?>';
	
	if(amount!="" && pay_date!="" && particulars!=""){
	 var data = '?supp_id='+userid+'&voucher='+voucher+'&amount='+amount+'&pay_method='+pay_method+'&received_by='+received_by+'&particulars='+particulars+'&pay_date='+pay_date+'&submitbtn=creditvoucher';
	 window.open(surl+data, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=1200,height=1024");
	 }
	 else{
	 	alert("Empty Field");
	 }
}
</script>
<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:50%; float:left; padding:0; margin:10px 0 0 0">Debit Voucher Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                    <div class="row" style="padding:10px">
                                
                       <div class="col-sm-8" style="margin:0; padding:0">
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-2 col-sm-2">Supplier<span class="required">*</span></label>
                            <div class="col-md-8 col-sm-8 col-lg-8">
                               <input type="text" name="userid" id="supp_id" onkeyup="getSupplier('asset');" onchange="getSupplier('asset');" class="form-control" />
                                <input type="hidden" id="supplier_id"/>
                                 <div id="supplist"></div>
                                 
                            </div>
                        </div>
                       
                       
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-2 col-sm-2">Head<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="asset" id="asset" required onchange="disabledFunc('asset','supp_id');">
                                    <option value="">Select Expense Head</option>
									<?php
                                        $queryS=$this->db->query("SELECT * FROM expense");
                                        foreach($queryS->result() as $rowS){
                                        $par_id=$rowS->par_id;
                                        $name=$rowS->expense_name;
                                        ?>
                                     <option value="<?php echo $par_id;?>"><?php echo $name;?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                        	
                        	<div class="col-sm-6">
                            	<label class="control-label col-md-4 col-sm-4 col-xs-12">Voucher<span class="required">*</span></label>
                           		 <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="voucher" id="voucher" class="form-control date-picker" value="<?php echo $voucher; ?>" readonly="readonly">
                            </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom:10px;">
                            	<label class="control-label col-md-4 col-sm-4 col-xs-12">Date<span class="required">*</span></label>
                           		 <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="pay_date" id="pay_date" class="form-control col-md-7 col-xs-12 date-picker" value="<?php echo date('Y-m-d');?>">
                            </div>
                            </div>
                            
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Method<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="pay_method" id="pay_method" style="width:50%; float:left" onchange="paymentMethodD(this.value)">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="bKash">bKash</option>
                                    <option value="Others">Others</option>
                                </select>
                                <select class="form-control" name="bankinfo" id="bankinfo" style="width:50%; float:left; display:none">
                                    <?php foreach($bank_list->result() as $brow):?>
                                        <option value="<?php echo $brow->b_id;?>"><?php echo $brow->bank_name.' - '.$brow->account_no;?></option>
                                    <?php endforeach;?>
                                </select>
                              <input type="text" name="tranid" id="tranid" class="form-control" style="width:50%; float:left; display:none" 
                              placeholder="Transaction ID" />
                              <input type="text" name="othersval" id="othersval" class="form-control" style="width:50%; float:left; display:none"
                              placeholder="Others" />
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Debit Amount<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="amount"  id="amount" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Total Amount' value="<?php echo $amount; ?>"  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Total Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Cost By<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="cost_by" id="cost_by" required class="form-control" 
                                placeholder='Cost By' value="<?php //echo $received_by; ?>"  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Cost By">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Particular<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <textarea type="text" name="particulars" id="particulars" required class="form-control"><?php echo $particulars; ?></textarea>
                            </div>
                        </div>   
                       
                       
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-lg-12">
                               
                               <!-- <div id="successmsg"></div>
                                <span id="loaderHide">-->
                                 <button type="button" class="btn btn-success btn-sm" value="Submit" style="float:right" onclick="reportsAjax();" id="submitbtn">
                                    <i class="fa fa-save"></i> Save</button>
                                <!--</span>-->
                                
                                <?php /*?><span id="LoadingImage" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                    <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span><?php */?>
                                
                            </div>
                        </div>       
                      </div> 
                      <div class="col-sm-3 pull-right">
                      	<h3>Supplier/Marchendiser</h3>
                        <div class="leftContentClass">
                      	  <ul>
							 <?php
							 	$i=0;
                                $queryS=$this->db->query("SELECT * FROM supplier");
                                foreach($queryS->result() as $rowS){
                                $user_id=$rowS->user_id;
                                $name=$rowS->username;
								$i++;
                                ?>
                             <li><a href="javascript:void()" onclick="getLeftContent('<?php echo $name;?>','<?php echo $user_id;?>','supp_id','supplier_id');">
							 <?php echo $name;?></a></li>
                            <?php
                            }
                            ?>
                         </ul>
                         </div>
                      </div>
                      
                    </div>    
               <?php echo form_close();?>
                </div>
            </div>
        </div>
    </div>              
                
<script type="text/javascript">
$(document).ready(function () {
	$('.date-picker').daterangepicker({
		singleDatePicker: true,
		calender_style: "picker_4"
	}, function (start, end, label) {
		console.log(start.toISOString(), end.toISOString(), label);
	});
});
</script>