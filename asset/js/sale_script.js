function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	 
	 var pname = $("#pro_id").val();
	 var pid = $("#products_id").val();
	 var pcode = $("#pro_code").val();
	 var pprice = $("#unit_price").val();
	 var psprice = $("#sale_price").val();
	 var psize = $("#size").val();
	 var pqty = $("#pro_qty").val();
	 var ptotal = $("#total_pro_price").val();
	 var pvat = $("#pro_vat").val();
	 var pcom = $("#pro_commission").val();
	/*var cell0 = row.insertCell(0);
	cell0.innerHTML = rowCount + 1;*/
	
	var cell0 = row.insertCell(0);
	var element0 = document.createElement("input");
	element0.type = "checkbox";
	element0.name="chkbox[]";
	cell0.appendChild(element0);
	
	var cell1 = row.insertCell(1);
	var element1_1 = document.createElement("input");
	var element1 = document.createElement("input");
	element1.type = "text";
	element1.name = "pname[]";
	element1.value = pname;
	element1.setAttribute("readOnly", true);		
	element1.className = "extinputname";	
	
	element1_1.type = "hidden";
	element1_1.name = "pid[]";
	element1_1.value = pid;
	cell1.appendChild(element1_1);
	cell1.appendChild(element1);
	
	
	var cell2 = row.insertCell(2);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "pcode[]";
	element2.value = pcode;	
	element2.setAttribute("readOnly", true);
	element2.className = "extdinput";
	cell2.style.width = '50px';
	cell2.appendChild(element2);
	
	var cell3 = row.insertCell(3);
	var element3 = document.createElement("input");
	element3.type = "text";
	element3.name = "psize[]";
	element3.value = psize;	
	element3.setAttribute("readOnly", true);	
	element3.className = "extdinput";
	cell3.style.width = '50px';
	cell3.appendChild(element3);
	
	var cell4 = row.insertCell(4);
	var element4 = document.createElement("input");
	element4.type = "number";
	element4.name = "pqty[]";
	element4.value = pqty;	
	element4.setAttribute("readOnly", true);
	element4.ondblclick = function () {
		this.readOnly="";
		this.className = 'extdinput_enable';
	};
	
	element4.onkeyup = function () {
		var thisval = this.value;
		var esprice = element6.value;
		var evat = element7.value;
		var ecom = element8.value;
		var totalvp = thisval*esprice;
		var totalFormate = parseFloat(totalvp).toFixed(2);
		element9.value = totalFormate;
		var tqty = $("input[name='pqty[]']").map(function(){	return $(this).val();}).get();
		var tamount = $("input[name='ptotal[]']").map(function(){	return $(this).val();}).get();
		totalval(tqty,tamount);
		
	};
	element4.onblur = function () {
		this.readOnly=true;
		this.className = 'extdinput';
	};
		
	element4.className = "extdinput";
	cell4.style.width = '50px';
	cell4.appendChild(element4);
	
	var cell5 = row.insertCell(5);
	var element5 = document.createElement("input");
	element5.type = "text";
	element5.name = "pprice[]";
	element5.value = pprice;	
	element5.setAttribute("readOnly", true);	
	element5.className = "extdinput";
	cell5.style.width = '50px';
	cell5.appendChild(element5);
	
	var cell6 = row.insertCell(6);
	var element6 = document.createElement("input");
	element6.type = "text";
	element6.name = "psprice[]";
	element6.value = psprice;	
	element6.setAttribute("readOnly", true);
	element6.className = "extdinput";
	element6.ondblclick = function () {
		this.readOnly="";
		this.className = 'extdinput_enable';
	};
	
	element6.onkeyup = function () {
		var thisval = this.value;
		var eqty = element4.value;
		var evat = element7.value;
		var ecom = element8.value;

		var totalvp = thisval*eqty;
		var totalFormate = parseFloat(totalvp).toFixed(2);
		element9.value = totalFormate;
		var tqty = $("input[name='pqty[]']").map(function(){	return $(this).val();}).get();
		var tamount = $("input[name='ptotal[]']").map(function(){	return $(this).val();}).get();
		totalval(tqty,tamount);
		
	};
	element6.onblur = function () {
		this.readOnly=true;
		this.className = 'extdinput';
	};
	
	cell6.style.width = '50px';
	cell6.appendChild(element6);
	
	var cell7 = row.insertCell(7);
	var element7 = document.createElement("input");
	element7.type = "text";
	element7.name = "pcom[]";
	element7.value = pcom;	
	element7.setAttribute("readOnly", true);	
	element7.className = "extdinput";
	cell7.style.width = '50px';
	cell7.appendChild(element7);
	
	var cell8 = row.insertCell(8);
	var element8 = document.createElement("input");
	element8.type = "text";
	element8.name = "pvat[]";
	element8.value = pvat;	
	element8.setAttribute("readOnly", true);	
	element8.className = "extdinput";
	cell8.style.width = '50px';
	cell8.appendChild(element8);
	
	var cell9 = row.insertCell(9);
	var element9 = document.createElement("input");
	element9.type = "text";
	element9.name = "ptotal[]";
	element9.value = ptotal;	
	element9.setAttribute("readOnly", true);	
	element9.className = "extdinputtotal";
	cell9.appendChild(element9);
	
	
	$("#pro_id").val('');
	$("#pro_code").val('');
	$("#unit_price").val('');
	$("#sale_price").val('');
	$("#size").val('');
	$("#pro_qty").val('');
	$("#total_pro_price").val('');
	$("#pro_vat").val('');
	$("#pro_commission").val('');
	$("#pro_id").focus();
	//alert(rowCount);
	var tqty = $("input[name='pqty[]']").map(function(){	return $(this).val();}).get();
	var tamount = $("input[name='ptotal[]']").map(function(){	return $(this).val();}).get();
	totalval(tqty,tamount);
}


function totalval(tqty,tamount) {
		//alert(tamount);
        var sumQty = 0;
        for (var i = 0; i < tqty.length; i++) {
            sumQty += parseInt(tqty[i]);
        }
		$("#total_qty").val(sumQty);
		
		var sumAmount = 0;
        for (var i = 0; i < tamount.length; i++) {
            sumAmount += parseInt(tamount[i]);
        }
		
		var totalFormate = parseFloat(sumAmount).toFixed(2);
		
		$("#total_amount").val(totalFormate);
		$("#due").val(totalFormate);
		$("#net_amount").val(totalFormate);
       // alert(sum);
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
		var comission_type = $("#comission_type").val();
		//var payable = $("#due").val();
		var vat = $("#vat").val();
		var commission = $("#commission").val();
		
		
		if(commission && commission > 0){
			if(comission_type=='%'){
				if(commission > 100){
					$("#comerror").html("Commission doesn't allow to greater than 100%");
					$("#commission").val('');
					total_amount = total_amount;
				}
				else{
					setInterval(function(){ $("#comerror").css('display','none'); }, 3000);
					var comAmount =  (parseFloat(total_amount)*parseFloat(commission))/100;
					var totalWCom = parseInt(total_amount) - parseInt(comAmount);
					total_amount = totalWCom;					
				}
			}
			else if(comission_type=='Tk'){
				if(commission >  parseInt(total_amount)){
					$("#comerror").html("Commission doesn't allow to greater than Total Amount "+total_amount);
					$("#commission").val('');
					total_amount = total_amount;
				}
				else{
					//$("#comerror").css('display','none');
					setInterval(function(){ $("#comerror").css('display','none'); }, 3000);
					var totalWCom = parseInt(total_amount) - parseInt(commission);
					total_amount = totalWCom;
				}
			}	
		}
		else{
			total_amount = total_amount;
		}
		
		
		if(vat && vat > 0){
			var vatAmount =  (parseFloat(total_amount)*parseFloat(vat))/100;
			var totalWVat = parseInt(total_amount) + parseInt(vatAmount);
			//$("#due").val(totalWVat);
			//netAm = totalWVat;
			total_amount = totalWVat;
		}
		else{
			total_amount = total_amount;
		}	
		
		var totalFormate = parseFloat(total_amount).toFixed(2);
		$("#due").val(totalFormate);
		
		if(payment && payment > 0){	
			if( parseInt(payment) >  parseInt(total_amount)){
				$("#payment").html("Payment doesn't allow to greater than Total Amount "+total_amount);
				$("#payment").val('');
				netAm = total_amount;		
				var totalFormate = parseFloat(netAm).toFixed(2);
			}
			else{
				netAm = total_amount - payment;		
				var totalFormate = parseFloat(netAm).toFixed(2);
			}
		}
		else{
			netAm = total_amount;
			var totalFormate = parseFloat(netAm).toFixed(2);
		}
		$("#net_amount").val(totalFormate);
	}	



function deleteRow(tableID) {
		try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;
			
			for(var i=0; i<rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if(null != chkbox && true == chkbox.checked) {
					table.deleteRow(i);
					rowCount--;
					i--;
				}
			
			
			}
		}
		catch(e) {
			alert(e);
		}
}

$(document).ready(function(){
	$('#saleform').on('keyup keypress', function(e) {
	  var keyCode = e.keyCode || e.which;
	  alert(keyCode);
	  if (keyCode === 13) { 
		e.preventDefault();
		return false;
	  }
	});
});
/*function formsubmit() {
	 document.getElementById("saleform").submit();
}*/