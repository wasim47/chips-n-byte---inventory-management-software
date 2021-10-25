
<?php
//if($paymentUpdate->num_rows()>0){
	//foreach($paymentUpdate->result() as $paymentData);
			/*$id=$paymentData->id;
			$userid=$paymentData->userid;
			$voucher=$paymentData->voucher;
			$amount=$paymentData->amount;
			$recevied_by=$paymentData->recevied_by;
			$pay_method=$paymentData->pay_method;
			$paid_date=$paymentData->payment_date;
			$particulars=$paymentData->particulars;
			
			$queryStd=$this->db->query("select * from customers where customer_id='".$customer_id."'");
			foreach($queryStd->result() as $rowSt);
			$custname=$rowSt->name;	*/		
//}
//else{
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
	//}
?>

<script>
 function creditEntry(){
 	//alert(si);
   $("#LoadingImage").show();
   $("#loaderHide").hide();

   	  var userid = $("#userid").val();
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
   	  var surl = '<?php echo base_url('admin/credit_voucher');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'userid':userid,'voucher':voucher,'amount':amount,'pay_method':pay_method,'received_by':received_by,'particulars':particulars,'pay_date':pay_date},
        cache : false, 
        success: function(response) { 
          $("#LoadingImage").hide();
		  $("#loaderHide").show();
		  
		   $("#successmsg").html(response.msg);
          // alert(response.cart_info); 
		  //console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          $("#LoadingImage").hide();
		  $("#loaderHide").show();
          alert('Unknown error ' + status); 
        }    
      });  
    }
	
	
	
	
	function debitEntry(){
 	//alert(si);
   $("#LoadingImage1").show();
   $("#loaderHide1").hide();
   
  
   	  var asset = $("#asset").val();
	  var voucher = $("#debit_voucher").val();
	  var amount = $("#debit_amount").val();
	  var pay_method = $("#debit_pay_method").val();
	  var cost_by = $("#cost_by").val();
	  var particulars = $("#debit_particulars").val();
	  var pay_date = $("#debit_pay_date").val();
	  //alert(jid);
   	  var surl = '<?php echo base_url('admin/debit_voucher');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'asset':asset,'voucher':voucher,'amount':amount,'pay_method':pay_method,'cost_by':cost_by,'particulars':particulars,'pay_date':pay_date},
        cache : false, 
		
        success: function(response) { 
          $("#LoadingImage1").hide();
		  $("#loaderHide1").show();
		  
		   $("#successmsg1").html(response.msg);
          // alert(response.cart_info); 
		  //console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          $("#LoadingImage1").hide();
		  $("#loaderHide1").show();
          alert('Unknown error ' + status); 
        }    
      });  
    }
</script>

<script>
function paymentMethodD(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('debit_bankinfo').style.display="inline";
		document.getElementById('debit_tranid').style.display="none";
		document.getElementById('debit_bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('debit_tranid').style.display="inline";
		document.getElementById('debit_bkash_no').style.display="inline";
		document.getElementById('debit_bankinfo').style.display="none";
		//document.getElementById('othersval').style.display="none";
	}
	else{
		document.getElementById('debit_bankinfo').style.display="none";
		document.getElementById('debit_tranid').style.display="none";
		document.getElementById('debit_bkash_no').style.display="none";
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

function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		return xmlhttp;
	}
	
	function getCategory(strURL) {	
			//alert(strURL);	
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('citydiv').innerHTML=req.responseText;
					} else {
						alert("There was a problem while using XMLHTTP:\n" + req.statusText);
					}
				}				
			}			
			req.open("GET", strURL, true);
			req.send(null);
		}
	}
	
</script>
<!--<script type="text/javascript">
	function totalprice(){
		//alert("In");
		var amount = document.getElementById('investamount').value;
		if(amount!=""){
		document.getElementById('number').value=amount;
		}
		else{
			amount=0;	
		}
		
		var bigNumArry = new Array('', ' thousand', ' million', ' billion', ' trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('number').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('container').value = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('container').value = 'messeg tell to enter numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
        if (finlOutPut[b] != "dontAddBigSufix") {
            finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr] + ' ';
            bigScalCntr++;
        }
        else {
            //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
            finlOutPut[b] = ' ';
            bigScalCntr++; //advance the counter  
        }
    }
        for(n = 0; n<finlOutPut.length; n++){
            output +=finlOutPut[n];
        }
    document.getElementById('container').value = output;//print the output
	}
	
</script>
<script type="text/javascript">
function triConvert(num){
    var ones = new Array('', ' one', ' two', ' three', ' four', ' five', ' six', ' seven', ' eight', ' nine', ' ten', ' eleven', ' twelve', ' thirteen', ' fourteen', ' fifteen', ' sixteen', ' seventeen', ' eighteen', ' nineteen');
    var tens = new Array('', '', ' twenty', ' thirty', ' forty', ' fifty', ' sixty', ' seventy', ' eighty', ' ninety');
    var hundred = ' hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += ones[parseInt(numString.charAt(1))];

    return output;
}   
</script>-->
<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:50%; float:left; padding:0; margin:10px 0 0 0">Payment Registraion Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                    <div class="row" style="background:#f5f5f5; padding:10px">
                                
                       <div class="col-sm-5" style="margin:0; padding:0">
                        <h2 style="text-align:center; background:#999; color:#fff; padding:10px;">Credit Voucher</h2>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-2 col-sm-2">Customer<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="userid" id="userid" required>
                                    <option value="<?php echo $userid;?>"><?php echo $custname;?></option>
                                    <?php
                                        $queryS=$this->db->query("SELECT * FROM customers");
                                        foreach($queryS->result() as $rowS){
                                        $custid=$rowS->customer_id;
                                        $name=$rowS->name;
                                        ?>
                                     <option value="<?php echo $custid;?>"><?php echo $name;?></option>
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
                                <input type="text" name="voucher" id="voucher" required class="form-control date-picker" value="<?php echo $voucher; ?>" readonly="readonly">
                            </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom:10px;">
                            	<label class="control-label col-md-4 col-sm-4 col-xs-12">Date<span class="required">*</span></label>
                           		 <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="pay_date" id="pay_date" required class="form-control col-md-7 col-xs-12 date-picker" 
                                placeholder='Date' value="<?php echo $paid_date; ?>"  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Date'">
                            </div>
                            </div>
                            
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Method<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="pay_method" style="width:50%; float:left" onchange="paymentMethod(this.value)">
                                                                	<option value="Cash">Cash</option>
                                                                    <option value="Bank">Bank</option>
                                                                    <option value="bKash">bKash</option>
                                                                   <!-- <option value="Others">Others</option>-->
                                                                </select>
                                <select class="form-control" name="bankinfo" id="bankinfo" style="width:50%; float:left; display:none">
                                    <?php foreach($bank_list->result() as $brow):?>
                                        <option value="<?php echo $brow->b_id;?>">
                                        <?php echo $brow->bank_name.' - '.$brow->account_no;?></option>
                                    <?php endforeach;?>
                                </select>
                                <div  style="width:50%; float:left;">
                              <input type="text" name="tranid" id="tranid" class="form-control" style="width:100%; float:left; display:none" 
                              placeholder="Transaction ID" />
                              <input type="text" name="bkash_no" id="bkash_no" class="form-control" style="width:100%; float:left; display:none" 
                              placeholder="bKash No." />
                              </div>
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Credit Amount<span class="required">*</span>
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
                                <input type="text" name="received_by" id="received_by" required class="form-control" 
                                placeholder='Received By' value="<?php //echo $received_by; ?>"  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Received By">
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
                               
                                <div id="successmsg"></div>
                                <span id="loaderHide">
                                 <button type="button" class="btn btn-success btn-sm" value="Submit" style="float:right" onclick="creditEntry();">
                                    <i class="fa fa-save"></i> Save</button>
                                </span>
                                
                                <span id="LoadingImage" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                    <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
                                
                            </div>
                        </div>       
                      </div> 
                      
                      
                      
                      
                      
                      
                      
                      
                       <div class="col-sm-2">&nbsp;</div>
                       <div class="col-sm-5" style="margin:0; padding:0">
                        <h2 style="text-align:center; background:#999; color:#fff; padding:10px;">Debit Voucher</h2>
                       
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-2 col-sm-2">Asset<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="asset" id="asset" required>
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
                                <input type="text" name="voucher" id="debit_voucher" required class="form-control date-picker" value="<?php echo $voucher; ?>" readonly="readonly">
                            </div>
                            </div>
                            <div class="col-sm-6" style="margin-bottom:10px;">
                            	<label class="control-label col-md-4 col-sm-4 col-xs-12">Date<span class="required">*</span></label>
                           		 <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="pay_date" id="debit_pay_date" required class="form-control col-md-7 col-xs-12 date-picker" 
                                placeholder='Date' value="<?php echo $paid_date; ?>"  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Date'">
                            </div>
                            </div>
                            
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Method<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select class="form-control" name="pay_method" id="debit_pay_method" style="width:50%; float:left" onchange="paymentMethodD(this.value)">
                                    <option value="Cash">Cash</option>
                                    <option value="Bank">Bank</option>
                                    <option value="bKash">bKash</option>
                                    <option value="Others">Others</option>
                                </select>
                                <select class="form-control" name="bankinfo" id="debit_bankinfo" style="width:50%; float:left; display:none">
                                    <?php foreach($bank_list->result() as $brow):?>
                                        <option value="<?php echo $brow->b_id;?>"><?php echo $brow->bank_name.' - '.$brow->account_no;?></option>
                                    <?php endforeach;?>
                                </select>
                              <input type="text" name="tranid" id="debit_tranid" class="form-control" style="width:50%; float:left; display:none" 
                              placeholder="Transaction ID" />
                              <input type="text" name="othersval" id="debit_othersval" class="form-control" style="width:50%; float:left; display:none"
                              placeholder="Others" />
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Debit Amount<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="amount"  id="debit_amount" required class="form-control col-md-7 col-xs-12"  
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
                                <textarea type="text" name="debit_particulars" id="debit_particulars" required class="form-control"><?php echo $particulars; ?></textarea>
                            </div>
                        </div>   
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-lg-12">
                               
                                <div id="successmsg1"></div>
                                <span id="loaderHide1">
                                 <button type="button" class="btn btn-success btn-sm" value="Submit" style="float:right" onclick="debitEntry();">
                                    <i class="fa fa-save"></i> Save</button>
                                </span>
                                
                                <span id="LoadingImage1" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                    <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>
                                
                            </div>
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