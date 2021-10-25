
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
/*else{
			$id='';
			$userid='';
			$custname='';
			$amount='';
			$received_by='';
			$particulars='';
			$pay_method='';
			$paid_date='';*/
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
	  var voucher = $("#voucher").val();
	  var amount = $("#amount").val();
	  var pay_method = $("#pay_method").val();
	  var cost_by = $("#cost_by").val();
	  var particulars = $("#particulars").val();
	  var pay_date = $("#pay_date").val();
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
	/*else if(status=="Others"){
		document.getElementById('othersval').style.display="inline";
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
	}*/
	else{
		document.getElementById('bankinfo').style.display="none";
		document.getElementById('tranid').style.display="none";
		document.getElementById('bkash_no').style.display="none";
		//document.getElementById('othersval').style.display="none";
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

<div class="right_col" role="main">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2 style="width:50%; float:left; padding:0; margin:10px 0 0 0">TA/DA Statement Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <?php echo form_open_multipart('admin/tada_statement_action', 'class="form-horizontal form-label-left"');?>
                    <div class="row" style="background:#f5f5f5; padding:10px">
                                
                       <div class="col-sm-8 col-sm-offset-1">
                        
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
                                placeholder='Date' onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Date'">
                            </div>
                            </div>
                            
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Salse Representative<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                               <select name="salse_id" class="form-control">
                               	<option value="">Salse Representative</option>
                                <?php foreach($salserepres->result() as $salseu):?>
                                <option value="<?php echo $salseu->user_id;?>"><?php echo $salseu->username;?></option>
                                <?php endforeach; ?>
                               </select>
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Particulars<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="particulars"  id="particulars" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Description of Expense' onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Description of Expense'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Cost By<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-8">
                                <input type="text" name="cost_by" id="cost_by" required class="form-control" 
                                placeholder='Cost By'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Cost By">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Rickshaw
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="rickshaw"  id="rickshaw" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>   
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Bus
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="bus"  id="bus" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Motorcycle
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="motorcycle"  id="motorcycle" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">CNG
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="cng"  id="cng" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Mobile
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="mobile"  id="mobile" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Foods
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="foods"  id="foods" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Hotel
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="hotel"  id="hotel" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Misc
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="misc"  id="misc" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        <div class="form-group" style="margin:0 0 5px 0; padding:0">
                            <label class="control-label col-md-4 col-sm-4 col-xs-12">Others
                            </label>
                            <div class="col-md-6 col-sm-6 col-lg-4">
                                <input type="text" name="others"  id="others" required class="form-control col-md-7 col-xs-12"  
                                placeholder='Amount'  onFocus="this.placeholder=''" 
                                onBlur="this.placeholder='Amount'">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-lg-12">
                               
                                <div id="successmsg1"></div>
                                <span id="loaderHide1">
                                <!-- <button type="submit" class="btn btn-success btn-sm" value="Submit" style="float:right">
                                    <i class="fa fa-save"></i> Save</button>-->
                                    
                                    <input type="submit" name="tadasubmit" value="Save" />
                                </span>
                                
                                <!--<span id="LoadingImage1" style="display:none; float:right"><a href="javascript:void();" class="btn apply" style="background:#ccc">
                                    <i class="fa fa-paper-plane" aria-hidden="true"></i> 
                                    <img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>-->
                                
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