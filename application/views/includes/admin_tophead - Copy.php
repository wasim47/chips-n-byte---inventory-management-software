<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?></title>
    <link href="<?php echo base_url();?>asset/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/fonts/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/animate.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/custom.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/icheck/flat/green.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/editor/index.css" rel="stylesheet">
    <link href="<?php echo base_url();?>asset/css/select/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url();?>asset/css/switchery/switchery.min.css" />

<style>
.productinfo-tab {
	width:100%;
	height:auto;
	
}
.nav-tabs {
	padding: 0;
	margin: 0;
	background:#f4f4f4;
}

.productinfo-tab .tab-content {
	/*border-width: 1px 0 0;
	border-style: solid;
	border-color: #ddd;*/
	overflow: hidden;
}
ul.autocomplete{
	width:300px;
	max-height:400px;
	float:left;
	position:absolute;
	height:auto;
	z-index:1;
	background:#fff;
	overflow:scroll;
	display:block;
	margin:0;
	padding:0;
	border:1px solid #ccc;
}
ul.autocomplete li{
	border-bottom:1px solid #ccc;
	padding:5px;
	cursor:pointer;
	text-align:left;
	display:block;
	font-size:12px;
	text-transform:capitalize;
}
</style>
    <script src="<?php echo base_url();?>asset/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>asset/ckeditor/ckeditor.js"></script>
	
    <script>
	
	function selectedItem()
	{
		//alert('IN');
		var pro_name=document.getElementById("pro_name").value;
		//alert(pro_name);
	   $.ajax({
		type: "POST",
		url: "<?php echo base_url()?>admin/finditem",
		data: ({pro_name: pro_name}),

		success: function(response)
		{
	   
	   		if(response!=0)
			{
				//alert(response);
					  
				var x=response.split('~');
				//alert(x)
				document.getElementById("pro_code").value=x[0];
				document.getElementById("price").value=x[1];
				document.getElementById("pro_id").value=x[2];
			}
			else
			{
				document.getElementById("pro_code").value='';
				document.getElementById("price").value='';
				document.getElementById("pro_id").value='';
			}
		}          
	});
	}
	
	//====================== Number Only
	
	function checkInt(evt, val) {
		evt = (evt) ? evt : window.event
		var charCode = (evt.which) ? evt.which : evt.keyCode
	   // alert(charCode);
		if (charCode != 46 && charCode > 31 
				&& (charCode < 48 || charCode > 57)) {
			//alert_message2(val+' field accepts numbers and decimal points only');
		   // status = "This field accepts numbers only."
			return false
		}
	  //  status = ""
		return true
	}
	
	function hoverChange(id)
	{
		document.getElementById(id).style.borderColor='';
	}	
	
	function loadAjaxData(thisval) {
		var getBaseUrl = "<?php echo base_url('admin/getAllSupplierProduct/');?>?supplierid="+thisval;
		//alert(getBaseUrl);
		  var xhttp = new XMLHttpRequest();
		  xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
			  document.getElementById("suppierWiseProduct").innerHTML = this.responseText;
			}
		  };
		  xhttp.open("GET", getBaseUrl, true);
		  xhttp.send();
	}



	function checkQtyP()
	{
		var qty=document.getElementById("qty").value;
		var mainPrize=document.getElementById("price").value;
		
		if(qty>0)
		{
			var netAmmount=(mainPrize * qty);
			document.getElementById("net").value=netAmmount;
		}
		else
		{
			document.getElementById("net").value='';
			document.getElementById("qty").value='';
			return true;
		}
	}
		
	
	//=================== Control click to call function and check purchase invoice
	
	$(document).keydown(function(e){
	if(e.keyCode==13)
	{
		//alert('In');
		var stockid=$('#stockid').val();
		var minvoice=$('#minvoice').val();
		var supplier=$('#supplier').val();
		
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		
		if(minvoice=='' || supplier=='' || pro_name=='' || qty=='')
		{
			if(minvoice=='')
			{
				document.getElementById('minvoice').style.borderColor='#FF0000';
				document.getElementById('minvoice').focus();
				return true;
			}
			else
			{
				document.getElementById('minvoice').style.borderColor='';
			}
			
			if(supplier=='')
			{
				document.getElementById('supplier').style.borderColor='#FF0000';
				document.getElementById('supplier').focus();
				return true;
			}
			else
			{
				document.getElementById('supplier').style.borderColor='';
			}
			
			if(pro_name=='')
			{
				document.getElementById('pro_name').style.borderColor='#FF0000';
				document.getElementById('pro_name').focus();
				return true;
			}
			else
			{
				document.getElementById('pro_name').style.borderColor='';
			}
			
			if(qty=='')
			{
				document.getElementById('qty').style.borderColor='#FF0000';
				document.getElementById('qty').focus();
				return true;
			}
			else
			{
				document.getElementById('qty').style.borderColor='';
			}
		}
		else if(minvoice!='' && supplier!='' && pro_name!='' && qty!='')
		{
				
			var pro_code5=document.getElementsByName("pro_code1[]");
			var j=0;
			for(var i=0;i<pro_code5.length;i++)
			{
				if(pro_code5[i].value==pro_code)
				{
					j++;
					alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
				}
			}
			if(j>0)
			{
				return true;
			}
			else
			{
				addrowsPurchaseInvoice();
			}
		}
	}
});



function addrowsPurchaseInvoice()
		{
			//alert("new row working");
			$(document).ready(function(){
			//alert("In");
			var pro_code=$('#pro_code').val();
			var pro_id=$('#pro_id').val();
			var pro_name=$('#products_id').val();
			
			var ex = pro_name.split('~');
			var itemid = ex[0];
			var itemname = ex[1];
			
			var qty=$('#qty').val();
			var price=$('#price').val();
			var net=Number($('#net').val());
			var main_net=$('#main_net').val();
			var net_total=$('#net_total').val();
			var total_price_final=(Number(net)+Number(net_total));
			var total_price_final_net=(Number(net)+Number(main_net));
			 //alert(p_c1);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			if(pro_name!='' && qty!='' && qty>0){
			
			strCountField = '#prof_count';      
			intFields = $(strCountField).val();
			intFields = Number(intFields);    
			newField = intFields + 1;
				
			strNewField = '<tr class="prof blueBox" id="prof_' + newField + '">\
			<input type="hidden" id="id' + newField + '" name="id' + newField + '" value="-1" />\
			<td><input type="text" id="pro_name' + newField + '" name="pro_name1[]" maxlength="10" value="'+itemname+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="pro_code' + newField + '" name="pro_code1[]" maxlength="10" value="'+pro_code+'" class="form-control" readonly="" /></td>\
			<td><input type="hidden" id="pro_id' + newField + '" name="pro_id1[]" maxlength="10" value="'+itemid+'" readonly="" /></td>\
			<td><input type="text" id="qty' + newField + '" name="qty1[]" maxlength="10" value="'+qty+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="price' + newField + '" name="price1[]" maxlength="10" value="'+price+'" class="form-control" readonly="" /></td>\
			<td><input type="text" id="net' + newField + '" name="net1[]" maxlength="10" value="'+net+'" class="form-control" readonly="" /></td>\
			<td style="z-index:100;"><img src="<?php echo base_url();?>asset/images/icon/Minus-64.png" width="30" height="30" border="0" id="prof_' + newField + '"  value="prof_' + newField + '" onClick="del(this)" title="Delete" style="cursor:pointer;"></td>\
			</tr>\
		  <div class="nopass"><!-- clears floats --></div>\
		  '
		  ;

			$("#prof_" + intFields).after(strNewField);    
			$("#prof_" + newField).slideDown("medium");
			$(strCountField).val(newField);				
			$('#pro_code').val('');
			$('#pro_name').val('');
			$('#pro_id').val('');
			$('#qty').val('');
			$('#price').val('');
			$('#net').val('');
			//alert(strNewField);
			$("#pro_name").focus();
			document.getElementById('qty').style.borderColor='';
			}
	});
}

function del(id)
{
//alert(id);
//return true;
	var agree=confirm ('Are you want to delete This?')
	{
		if(agree)
		{
			var y= ($(id).attr("id"));
			//alert(y);
			
			var x=y.split('_');
			
			var pro_code="pro_code"+x[1];
			var pro_name="pro_name"+x[1];
			var pro_id="pro_id"+x[1];
			var qty="qty"+x[1];
			var price="price"+x[1];
			var net="net"+x[1];
			
			var netPrize=document.getElementById(net).value;
			
			var total_price=$('#net_total').val();
			var main_net=$('#main_net').val();
			
			var total_price_final=(Number(total_price)-Number(netPrize));
			var total_price_final_net=(Number(main_net)-Number(netPrize));
			//alert(total_price_final);
			document.getElementById("net_total").value=total_price_final;
			document.getElementById("main_net").value=total_price_final_net;
			
			document.getElementById(pro_code).value='';
			document.getElementById(pro_name).value='';
			document.getElementById(pro_id).value='';
			document.getElementById(qty).value='';
			document.getElementById(price).value='';
			document.getElementById(net).value='';
			
			document.getElementById(y).style.display='none';
			return true
		}
		else
		{
			return false;
		}
	}
}


function checkInvoice()
{
	//alert('In');
	
	    var stockid=$('#stockid').val();
		var minvoice=$('#minvoice').val();
		var supplier=$('#supplier').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		var pro_code5=document.getElementsByName("pro_code1[]");
	
	//alert(pro_code5);
	if(pro_code5.length=='')
	{
		var stockid=$('#stockid').val();
		var minvoice=$('#minvoice').val();
		var supplier=$('#supplier').val();
		var pro_code=$('#pro_code').val();
		var pro_name=$('#pro_name').val();
		var qty=$('#qty').val();
		var net_price=Number($('#net').val());
		
		if(minvoice=='')
		{
			document.getElementById('minvoice').style.borderColor='#FF0000';
			document.getElementById('minvoice').focus();
			return true;
		}
		else
		{
			document.getElementById('minvoice').style.borderColor='';
		}
		if(supplier=='')
		{
			document.getElementById('supplier').style.borderColor='#FF0000';
			document.getElementById('supplier').focus();
			return true;
		}
		else
		{
			document.getElementById('supplier').style.borderColor='';
		}
		if(pro_name=='')
		{
			document.getElementById('pro_name').style.borderColor='#FF0000';
			document.getElementById('pro_name').focus();
			return true;
		}
		else
		{
			document.getElementById('pro_name').style.borderColor='';
		}
		if(qty=='')
		{
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		else
		{
			document.getElementById('qty').style.borderColor='';
		}
		
		if(net_price<=0){
			document.getElementById('qty').style.borderColor='#FF0000';
			document.getElementById('qty').focus();
			return true;
		}
		var pro_code5=document.getElementsByName("pro_code1[]");
		var j=0;
		for(var i=0;i<pro_code5.length;i++)
		{
			if(pro_code5[i].value==pro_code)
			{
				j++;
				alert("Duplicate Product Not Add ! Please remove duplicate product then add.");
			}
		}
		if(j>0){
			return true;
		}
	}
	else
	{
		submitInvoiceBilling(form);	
	}
}


function submitInvoiceBilling(form)
{
	var frm=document.getElementById('form');
	var action_url='<?php echo base_url()?>admin/purchaseinvoice';
	
   // var div_id=divid;
   
    // Create the iframe...
    var iframe = document.createElement("iframe");
    iframe.setAttribute("id","upload_iframe");
    iframe.setAttribute("name","upload_iframe");
    iframe.setAttribute("width","0");
    iframe.setAttribute("height","0");
    iframe.setAttribute("border","0");
    iframe.setAttribute("style","width: 0; height: 0; border: none;");
   
    // Add to document...
    form.parentNode.appendChild(iframe);
   
    window.frames['upload_iframe'].name="upload_iframe";
   
    iframeId = document.getElementById("upload_iframe");
   
    // Add event...
    var eventHandler = function()  {
   
    if (iframeId.detachEvent)
    iframeId.detachEvent("onload", eventHandler);
    else
    iframeId.removeEventListener("load", eventHandler, false);
   
    // Message from server...
    if (iframeId.contentDocument) {
    content = iframeId.contentDocument.body.innerHTML;
    } else if (iframeId.contentWindow) {
    content = iframeId.contentWindow.document.body.innerHTML;
    } else if (iframeId.document) {
    content = iframeId.document.body.innerHTML;
    }
   
    //document.getElementById(div_id).innerHTML = content;
   
    // Del the iframe...
    setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
    }
   
    if (iframeId.addEventListener)
    iframeId.addEventListener("load", eventHandler, true);
    if (iframeId.attachEvent)
    iframeId.attachEvent("onload", eventHandler);
   
    // Set properties of form...
    form.setAttribute("target","upload_iframe");
    form.setAttribute("action", action_url);
    form.setAttribute("method","post");
    form.setAttribute("enctype","multipart/form-data");
    form.setAttribute("encoding","multipart/form-data");
   
    // Submit the form...
    form.submit(); 
	//lastInvoice();
	document.getElementById('rec_mess').innerHTML="Purchase Invoice Successfully submit.";
	
	window.setTimeout(function() {
    window.location.reload();
}, 2000);
}
</script>
	
	<script>
     function saleEntry(){
		//alert(si);
	   $("#LoadingImage").show();
	   $("#loaderHide").hide();

		var userid = $("#cust_id").val();
		var product_id = $("#products_id").val();
		var bill_no = $("#bill_no").val();
		var received_by = $("#received_by").val();
		var sale_date = $("#sale_date").val();
		var total_qty = $("#total_qty").val();
		var total_amount = $("#total_amount").val();
		var payment = $("#payment").val();
		var commission = $("#commission").val();
		var vat = $("#vat").val();
		var due = $("#due").val();
		var net_amount = $("#net_amount").val();
		var comments = $("#comments").val();
		var sale_price = $("#sale_price").val();
		var transport_cost = $("#transport_cost").val();
		var pro_commission = $("#pro_commission").val();
		var pro_vat = $("#pro_vat").val();
		var total_pro_price = $("#total_pro_price").val();
		var pro_qty = $("#pro_qty").val();
		
		var buyer_type = $("#buyer_type").val();
		var nc_code = $("#nc_code").val();
		var nc_name = $("#nc_name").val();
		var nc_email = $("#nc_email").val();
		var nc_mobile = $("#nc_mobile").val();
		var nc_address = $("#nc_address").val();
	
	  //alert(jid);
   	  var surl = '<?php echo base_url('admin/saleentry_action');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'cust_id':userid,'product_id':product_id,'bill_no':bill_no,'received_by':received_by,'transport_cost':transport_cost,'sale_date':sale_date,
		'total_qty':total_qty,'total_amount':total_amount,'payment':payment,'commission':commission,'vat':vat,'due':due,'net_amount':net_amount,'comments':comments,
		'sale_price':sale_price,'pro_commission':pro_commission,'pro_vat':pro_vat,'total_pro_price':total_pro_price,'pro_qty':pro_qty,
		'buyer_type':buyer_type,'nc_code':nc_code,'nc_name':nc_name,'nc_email':nc_email,'nc_mobile':nc_mobile,'nc_address':nc_address},
        cache : false, 
        success: function(response) { 
          $("#LoadingImage").hide();
		  $("#loaderHide").show();
		  
		   $("#succes_insert").html(response.msg);
		   $("#product_list").html(response.productinfo);
		   $("#total_qty").val(response.tQty);
		   $("#total_amount").val(response.tPrice);
		   $("#vat").val(response.tVat);
		   $("#commission").val(response.tCom);
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
	

function ajaxBuyer(custid){
	  alert(custid);
   	 /* var surl = '<?php echo base_url('admin/buyerAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'custid':custid},
        cache : false, 
        success: function(response) { 
		  
		   $("#total_buyer_amount").val(response.total);
		   $("#due_amount").val(response.due);
			
          // alert(response.cart_info); 
		  //console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      }); */ 
}


function getProduct(){

	  //alert(pid);
	  var key = $("#pro_id").val();
	  if(key.length > 0){
	  	 $("#prodlist").show(200);
		  var surl = '<?php echo base_url('admin/getProductAjax');?>';
		  $.ajax({ 
			type: "POST", 
			dataType: "json",
			url: surl,  
			data:{'keyword':key},
			cache : false, 
			success: function(response) { 		  
			   $("#prodlist").html(response.prodlist);
			}, 
			error: function (xhr, status) {  
			  alert('Unknown error ' + status); 
			}    
		  });  
	   }
	   else{
	   	$("#prodlist").html('');
	   }
    }	
	



function ajaxProduct(pid){

	 
	  var pname = $("#proname"+pid).val();
	  var key = $("#pro_id").val(pname);
	  
	 // var prid = $("#products_id"+pid).val();
	  $("#products_id").val(pid);
	  
	  $("#prodlist").hide(200);
	  // alert(pname);
   	  var surl = '<?php echo base_url('admin/saleProductAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'pro_id':pid},
        cache : false, 
        success: function(response) { 
		  
		   $("#pro_code").val(response.pcode);
		   $("#unit_price").val(response.uprice);
		   $("#sale_price").val(response.uprice);
		   $("#size").val(response.size);
		   $("#pro_qty").val(response.stock);
		  
		   var totalpp = response.stock*response.uprice;
		   var totalFormate = parseFloat(totalpp).toFixed(2);
		    $("#total_pro_price").val(totalFormate);
			$("#pro_vat").val(0);
			$("#pro_commission").val(0);
			
          // alert(response.cart_info); 
		  //console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  
    }	
	

	function getPurProduct(){

	  //alert(pid);
	  var key = $("#pro_name").val();
	  if(key.length > 0){
	  	 $("#prodlist").show(200);
		  var surl = '<?php echo base_url('admin/getPurProductAjax');?>';
		  $.ajax({ 
			type: "POST", 
			dataType: "json",
			url: surl,  
			data:{'keyword':key},
			cache : false, 
			success: function(response) { 		  
			   $("#prodlist").html(response.prodlist);
			}, 
			error: function (xhr, status) {  
			  alert('Unknown error ' + status); 
			}    
		  });  
	   }
	   else{
	   	$("#prodlist").html('');
	   }
    }	


  function ajaxPurProduct(pid){
	  var pname = $("#proname"+pid).val();
	  var key = $("#pro_name").val(pname);
	  var finalprodcut = pid+'~'+pname;
	 // var prid = $("#products_id"+pid).val();
	  $("#products_id").val(finalprodcut);
	  
	  $("#prodlist").hide(200);
	  // alert(pname);
   	  var surl = '<?php echo base_url('admin/saleProductAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'pro_id':pid},
        cache : false, 
        success: function(response) { 		  
		   $("#pro_code").val(response.pcode);
		   $("#price").val(response.uprice);

        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  
  }	
	
	

function getBuyer(){

	  //alert(pid);
	  var key = $("#cust_id").val();
	   //alert(key);
	  if(key.length > 0){
	  	 $("#custlist").show(200);
		  var surl = '<?php echo base_url('admin/getCustomerAjax');?>';
		  $.ajax({ 
			type: "POST", 
			dataType: "json",
			url: surl,  
			data:{'keyword':key},
			cache : false, 
			success: function(response) { 		  
			   $("#custlist").html(response.custlist);
			}, 
			error: function (xhr, status) {  
			  alert('Unknown error ' + status); 
			}    
		  });  
	   }
	   else{
	   	$("#prodlist").html('');
	   }
    }	
	


function ajaxBuyer(pid){

	
	  var pname = $("#custname"+pid).val();
	  var key = $("#cust_id").val(pname);
	  $("#customers_id").val(pid);
	  
	  $("#custlist").hide(200);
	  // alert(pname);
   	  /*var surl = '<?php //echo base_url('admin/saleCustomerAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'customer_id':pid},
        cache : false, 
        success: function(response) { 
		   $("#cust_code").val(response.ccode);
		   $("#cust_name").val(response.cname);
		   $("#cust_mobile").val(response.cmobile);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  */
    }



function getSupplier(field){

	  //alert(pid);
	  var key = $("#supp_id").val();
	  // alert(key);
	  if(key.length > 0){
	  	 $("#"+field).attr('disabled','disabled');
	  	 $("#supplist").show(200);
		  var surl = '<?php echo base_url('admin/getSupplierAjax');?>';
		  $.ajax({ 
			type: "POST", 
			dataType: "json",
			url: surl,  
			data:{'keyword':key},
			cache : false, 
			success: function(response) { 		  
			   $("#supplist").html(response.supplist);
			}, 
			error: function (xhr, status) {  
			  alert('Unknown error ' + status); 
			}    
		  });  
	   }
	   else{
	   	$("#supplist").html('');
		$("#"+field).removeAttr('disabled');
	   }
    }	
	


function ajaxSupplier(pid){

	
	  var sname = $("#suppname"+pid).val();
	  var key = $("#supp_id").val(sname);
	  $("#supplier_id").val(pid);
	  
	  $("#supplist").hide(200);
	  // alert(sname);
   	  /*var surl = '<?php //echo base_url('admin/saleCustomerAjax');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'supplier_id':pid},
        cache : false, 
        success: function(response) { 
		   $("#supp_code").val(response.ccode);
		   $("#supp_name").val(response.cname);
		   $("#supp_mobile").val(response.cmobile);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  */
    }
	
	

	

	function proQtyUpdate(){
		var vat = $("#pro_vat").val();
		var commission = $("#pro_commission").val();
		
		var sprice = $("#sale_price").val();
	    var qty = $("#pro_qty").val();
	    var totalpp = qty*sprice;
		//var grandTotal = 0;
		if(vat && vat > 0){
			totalpp = parseInt(totalpp) + parseInt(vat);
		}
		if(commission && commission > 0){
			totalpp = parseInt(totalpp) - parseInt(commission);
		}
		else{
			totalpp = totalpp;
		}
		var totalFormate = parseFloat(totalpp).toFixed(2);
		$("#total_pro_price").val(totalFormate);
	}	
	
	
	function paymentFunc(){
		var payment = $("#payment").val();
		var total_amount = $("#total_amount").val();
		var vat = $("#vat").val();
		var commission = $("#commission").val();
		
	    var netAm = payment;
		var dueCalc = total_amount - netAm;
		var dueFormate = parseFloat(dueCalc).toFixed(2);
		$("#due").val(dueFormate);
			
		//var grandTotal = 0;
		if(payment && payment > 0){
			if(vat && vat > 0){
				netAm = parseInt(netAm) + parseInt(vat);
			}
			if(commission && commission > 0){
				netAm = parseInt(netAm) - parseInt(commission);
			}
			
			var totalFormate = parseFloat(netAm).toFixed(2);
			$("#net_amount").val(totalFormate);
			
			
			
		}
	}	


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


function disabledFunc(type,field){
  //alert(field);
  var checkval = $("#"+type).val();
  if(checkval!=""){
	$("#"+field).attr('disabled','disabled');
  }
  else{
	$("#"+field).removeAttr('disabled');

  }
}
	
function getLeftContent(name,id,f1,f2){
  $("#asset").attr('disabled','disabled');
  $("#"+f1).val(name);
  $("#"+f2).val(id);
}

</script>

   
</head>