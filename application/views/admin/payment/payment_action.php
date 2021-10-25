
<?php
if($paymentUpdate->num_rows()>0){
	foreach($paymentUpdate->result() as $paymentData);
			$id=$paymentData->id;
			$customer_id=$paymentData->customer_id;
			$sale_amount=$paymentData->sale_amount;
			$paid_amount=$paymentData->paid_amount;
			$due_amount=$paymentData->due_amount;
			$pay_method=$paymentData->pay_method;
			$paid_date=$paymentData->payment_date;
			
			$queryStd=$this->db->query("select * from customers where customer_id='".$customer_id."'");
			foreach($queryStd->result() as $rowSt);
			$custname=$rowSt->name;
			
			/*$queryPar=$this->db->query("select * from particulars where par_id ='".$paymentfor."' order by particulars_name asc");
 		    foreach($queryPar->result() as $rowP);
			$parname=$rowP->particulars_name;
			
			$queryCur=$this->db->query("select * from currency where m_id='".$currency."' order by currency_name asc");
		    foreach($queryCur->result() as $curR);
			$curname=$curR->currency_name;*/
}
else{
			$id='';
			$customer_id='';
			$custname='';
			$sale_amount='';
			$paid_amount='';
			$due_amount='';
			$pay_method='';
			$paid_date='';
	}
?>

<script>
function paymentMethod(status){
	//alert(status);
	if(status=="Bank"){
		document.getElementById('bankinfo').style.display="inline";
		document.getElementById('tranid').style.display="none";
		document.getElementById('othersval').style.display="none";
	}
	else if(status=="bKash"){
		document.getElementById('tranid').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('othersval').style.display="none";
	}
	else if(status=="Others"){
		document.getElementById('othersval').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
	}
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
		document.getElementById('othersval').style.display="none";
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
<script type="text/javascript">
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
</script>
<div class="right_col" role="main">
                <div class="">

                    <div class="page-title">
                        <div class="title_left">
                            <h3>Payment Details</h3>
                        </div>
                        
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Payment Registraion Form</h2>
                                    
                                    <div class="clearfix"></div>
                                </div>
                                <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                  Payment Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                
                                       <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4" for="first-name">Customer Id<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-lg-8">
                                               <select class="form-control" name="custid" id="custid" required   
                                                onChange="getCategory('<?php echo base_url();?>admin/ajaxDataPayment?custid='+this.value);">
                                                    <option value="<?php echo $customer_id;?>"><?php echo $custname;?></option>
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
                                                    <?php echo form_error('std_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Method<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-lg-8">
                                               <select class="form-control" name="pay_method" style="width:50%; float:left" onchange="paymentMethod(this.value)">
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
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Total Amount<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-lg-8">
                                                <input type="text" name="sale_amount"  id="investamount" required class="form-control col-md-7 col-xs-12"  onchange="totalprice()" onkeyup="totalprice()"  
                                                placeholder='Total Amount' value="<?php echo $sale_amount; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Total Amount'">
                                             <?php echo form_error('amount', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Amount In Word</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                      	<input type="hidden"
										id="number"
										size="15"
										onkeyup="totalprice();"
										onkeydown="return (event.ctrlKey || event.altKey 
														|| (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
														|| (95<event.keyCode && event.keyCode<106)
														|| (event.keyCode==8) || (event.keyCode==9) 
														|| (event.keyCode>34 && event.keyCode<40) 
														|| (event.keyCode==46) )"/>
                                                <input type="text" name="amount_in_word" class="form-control col-md-7 col-xs-12" id="container" style="text-transform:capitalize">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Payment Date<span class="required">*</span>
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-lg-8">
                                                <input type="text" name="pay_date" required class="form-control col-md-7 col-xs-12 date-picker" 
                                                placeholder='Payment Date' value="<?php echo $paid_date; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Payment Date'">
                                                <?php echo form_error('pay_date', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                            </div>
                                        </div>          
                                      </div> 
                                      <div class="col-sm-6">
                                       <div id="citydiv"></div>
                                      </div>                  
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-lg-8 col-md-offset-3">
                                           <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <input type="reset" class="btn btn-primary" value="Reset">
                                            <input type="submit" name="registration" class="btn btn-success" value="Submit">
                                        </div>
                                    </div>
                               <?php echo form_close();?>
                                </div>
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
                    
                    
                    
<!--<div id="historyModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>-->