 function saleEntry(){
 	//alert(si);
   $("#LoadingImage").show();
   $("#loaderHide").hide();


		var userid = $("#cust_id").val();
		var product_id = $("#pro_id").val();
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
	
	  //alert(jid);
   	  var surl = '<?php echo base_url('admin/saleentry_action');?>';
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'cust_id':userid,'product_id':product_id,'bill_no':bill_no,'received_by':received_by,'transport_cost':transport_cost,'sale_date':sale_date,
		'total_qty':total_qty,'total_amount':total_amount,'payment':payment,'commission':commission,'vat':vat,'due':due,'net_amount':net_amount,'comments':comments,
		'sale_price':sale_price,'pro_commission':pro_commission,'pro_vat':pro_vat,'total_pro_price':total_pro_price,'pro_qty':pro_qty},
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

	  //alert(custid);
   	  var surl = '<?php echo base_url('admin/buyerAjax');?>';
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
      });  
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
