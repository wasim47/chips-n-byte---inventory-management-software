function addRow(tableID) {
	var table = document.getElementById(tableID);
	var rowCount = table.rows.length;
	var row = table.insertRow(rowCount);
	 
	 var pname = $("#pro_id").val();
	 var pcode = $("#pro_code").val();
	 var pprice = $("#unit_price").val();
	 var psprice = $("#sale_price").val();
	 var psize = $("#size").val();
	 var pqty = $("#pro_qty").val();
	
	/*var cell0 = row.insertCell(0);
	cell0.innerHTML = rowCount + 1;*/
	
	var cell0 = row.insertCell(0);
	var element0 = document.createElement("input");
	element0.type = "checkbox";
	element0.name="chkbox[]";
	cell0.appendChild(element0);
	
	var cell1 = row.insertCell(1);
	var element1 = document.createElement("input");
	element1.type = "text";
	element1.name = "pname[]";
	element1.value = pname;
	element1.setAttribute("readOnly", true);		
	element1.className = "extdinput";
	cell1.appendChild(element1);
	
	var cell2 = row.insertCell(2);
	var element2 = document.createElement("input");
	element2.type = "text";
	element2.name = "pcode[]";
	element2.value = pcode;	
	element2.setAttribute("readOnly", true);
	element2.className = "extdinput";
	cell2.appendChild(element2);
	
	var cell3 = row.insertCell(2);
	var element3 = document.createElement("input");
	element3.type = "text";
	element3.name = "pprice[]";
	element3.value = pprice;	
	element3.setAttribute("readOnly", true);	
	element3.className = "extdinput";
	cell3.appendChild(element3);
	
	
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
		
/*//////////// Angularjs Form /////////////
function ajaxProduct(pid){
	  var pname = $("#proname"+pid).val();
	  var key = $("#pro_id").val(pname);
	  
	 // var prid = $("#products_id"+pid).val();
	  $("#products_id").val(pid);
	  $("#prodlist").hide(200);
	  // alert(pname);
   	  var surl = 'http://[::1]/wasim/chipsnbyte/admin/saleProductAjax';
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
			//funcB(pname);
			//alert(pname);
          // alert(response.cart_info); 
		  //console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          alert('Unknown error ' + status); 
        }    
      });  
    }	
	
	
var app = angular.module('commonApp', []);
app.controller('commonContrl', function($scope,$http) {
   //alert('dfjdhj');
   $scope.getproduct = function(stringurl){	  
	   var key = $("#pro_id").val();
		  if(key.length > 0){
			 $("#prodlist").show(200);
			  var surl = stringurl;
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
   };
   
	
  ////////////// Form Vlaue added into table Start/////////////////// 
	 $scope.data = [];
	  $scope.addNew = function(data){
	 		//alert(data.fname);
			
            $scope.data.push({ 
                'pname': $("#pname").val(), 
                'pcode': data.pcode,
				'pprice': data.pprice,
                'psize': data.psize,
            });
            //$scope.PD = {};
        };
		
		 $scope.remove = function(){
            var newDataList=[];
			
            $scope.selectedAll = false;
            angular.forEach($scope.data, function(selected){
                if(!selected.selected){
                    newDataList.push(selected);
                }
            }); 
            $scope.data = newDataList;
        };
    
        $scope.checkAll = function () {
		
            if (!$scope.selectedAll) {
                $scope.selectedAll = false;
            } else {
                $scope.selectedAll = true;
            }
            angular.forEach($scope.data, function (data) {
                data.selected = $scope.selectedAll;
            });
        };
////////////// Form Vlaue added into table END/////////////////// 
		
});


*/