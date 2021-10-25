<?php
if($paymentUpdate->num_rows()>0){
	foreach($paymentUpdate->result() as $paymentData);
			$bank_name=$paymentData->bank_name;
			$total_amount=$paymentData->total_amount;
			$bd_id=$paymentData->bd_id;
			$deposit_by=$paymentData->deposit_by;
			$amount_in_word=$paymentData->amount_in_word;
			$pay_date=$paymentData->payment_date;
}
else{
			$bank_name='';
			$total_amount='';
			$bd_id='';
			$pay_date='';
			$deposit_by='';
			$amount_in_word='';
	}
?>


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
                  <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                                <div class="x_title">
                                    <h2>Bank Deposit Form</h2>
                                    
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
                                                
                                        
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Bank Name</label>
                                       <div class="col-md-6 col-sm-6 col-xs-12">
                                               <select class="form-control" name="bankname" 
                                               onchange="document.getElementById('accountno').value = this.options[selectedIndex].title">
                                               <option value="">Select Bank</option>
                                                  <?php $query=$this->db->query("select * from bank order by bank_name asc");
												  foreach($query->result() as $parrow){
													  echo '<option value="'.$parrow->b_id.'" title="'.$parrow->account_no.'">
													  '.$parrow->bank_name.' - '.$parrow->account_no.'</li>';
													}
											?>
                                                   
                                              </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Account No</label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="account_no" id="accountno" class="form-control col-md-7 col-xs-12" 
                                                placeholder='Account No.' value="<?php echo $deposit_by; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Account No.'" readonly="readonly">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Total Amount</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="investamount" id="investamount" class="form-control col-md-7 col-xs-12" onchange="totalprice()" onkeyup="totalprice()" 
                                                placeholder='Total Amount' value="<?php echo $total_amount; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Total Amount'">
                                            </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Amount In Word</label>
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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deposit By</label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="deposit_by" class="form-control col-md-7 col-xs-12" 
                                                placeholder='Deposit By' value="<?php echo $deposit_by; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Deposit By'">
                                            </div>
                                        </div>          
                                                    
                                              <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Deposit Date</label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" name="pay_date" class="form-control col-md-7 col-xs-12 date-picker" 
                                                placeholder='Deposit Date' value="<?php echo $pay_date; ?>"  onFocus="this.placeholder=''" 
                                                onBlur="this.placeholder='Deposit Date'">
                                            </div>
                                        </div>    
                                                </div>
                                            </div>
                                        </div>
                                        
                               	     </div>
                                   </div> 
                                    
                                    <div class="ln_solid"></div>
                                    <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                           <input type="hidden" name="bd_id" value="<?php echo $bd_id; ?>">
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