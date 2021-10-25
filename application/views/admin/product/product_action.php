<?php
if($productUpdate->num_rows()>0){
	foreach($productUpdate->result() as $productData);
	$product_id=$productData->product_id;
	$product_name=$productData->product_name;
	$pro_code=$productData->pro_code;
	$pro_price=$productData->price;
	$qty=$productData->qty;
	$details=$productData->details;

	$main_image=$productData->main_image;
	$photo1=$productData->photo1;
	$photo2=$productData->photo2;
	$photo3=$productData->photo3;
	$color=$productData->color;
	$size=$productData->size;
	$seo_title=$productData->seo_title;
	$seo_details=$productData->seo_details;
	$keyword=$productData->keyword;
	$supplier=$productData->supplier;
	$cat_id=$productData->cat_id;
	$scat_id=$productData->scat_id;
	$brand=$productData->brand;
}
else{
	$product_id='';
	$product_name='';
	$details='';
	$pro_code='';
	$pro_price='';
	$qty='';
	$details='';
	$main_image='';
	$photo1='';
	$photo2='';
	$photo3='';
	$color='';
	$size='';
	$seo_title='';
	$seo_details='';
	$keyword='';
	$supplier='';
	$cat_id='';
	$scat_id='';
	$brand='';
}
?>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script type="text/javascript">
var app = angular.module("appTable",[]);
app.controller("ItemsController",function($scope) {

	//////////// Angel View Products Photo Popup /////////////////
	$scope.items = [{newItemName:''}];
   	 	$scope.addItem = function (index) {
            $scope.items.push({newItemName:''});
        }
		var newDataList = [];
		 $scope.deleteItem = function (index) {
			 if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.items.push({newItemName:''});
			}
            $scope.items.splice(index, 1);
        }
});
	
	
</script>
<script>
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

	
	function getSubCategory(strURL) {		
		var req = getXMLHTTP();
		if (req) {
			req.onreadystatechange = function() {
				if (req.readyState == 4) {
					// only if "OK"
					if (req.status == 200) {						
						document.getElementById('lastcat').innerHTML=req.responseText;
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
<style>
.required{
	color:#f00;
}
#exTab2 h3 {
	  color : white;
	  background-color: #428bca;
	  padding : 5px 15px;
	}
.tab-content{
	margin:10px;
	background:#f5f5f5;
	padding:10px;
	border-radius:10px;
	border:1px solid #ccc;
}


.hidden {
    display:none;
}
.button {
    border: 1px solid #f5f5f5;
    padding: 5px;
    background: #000066;
    color: #fff;
    width:100%;
	font-size:16px;
	text-align:center;
}

.button:hover {
    background: #333;
    cursor: pointer;
}
</style>

<script src="<?php echo base_url('asset/js/angularjs.min.js');?>"></script>
<script type="text/javascript">

$(document).ready(function(){
	$("#uploadTrigger").click(function(){
	   $("#uploadFile").click();
	});
});

var app = angular.module("appTable",[]);
app.controller("ItemsController",function($scope) {

	//////////// Color Popup /////////////////
	$scope.items = [{newItemName:''}];
   	 	$scope.addItem = function (index) {
            $scope.items.push({newItemName:''});
        }
		var newDataList = [];
		 $scope.deleteItem = function (index) {
			 if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.items.push({newItemName:''});
			}
            $scope.items.splice(index, 1);
        }
		
		
		////////////Size Quantity Popup /////////////////
	$scope.itemss = [{newItemSize:''}];
   	 	$scope.addSizeItem = function (index) {
            $scope.itemss.push({newItemSize:''});
        }
		var newDataList = [];
		 $scope.deleteSizeItem = function (index) {
			 if(!index){
				alert("\tDelete Error. \n Root Row not deletable.");
				$scope.itemss.push({newItemSize:''});
			}
            $scope.itemss.splice(index, 1);
        }
	
});
	
	
</script>

<div class="right_col" role="main"  ng-app="appTable" ng-controller="ItemsController">
  <div>
     
                    <div class="clearfix"></div>
                    <div class="row">




    





                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="x_panel">
                              <div class="x_content">
                                <?php echo form_open_multipart('', 'class="form-horizontal form-label-left"');?>
                                   <div id="registration_form">	
                                  	  <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                 <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                 <h4 class="panel-title">
                                                   Product Information </h4>
                                                 </a>
                                            </div>
                                            
                                            <div id="collapseOne" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                        
                                        		<div id="exTab2">	
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a  href="#general" id="invitation" data-toggle="tab"><strong>Product Information</strong></a></li>
                                                        <li><a href="#image" data-toggle="tab"><strong>Images</strong></a></li>
                                                        <li><a href="#seo" data-toggle="tab"><strong>SEO</strong></a></li>
                                                    </ul>
        
                    <div class="tab-content">
                        <div class="tab-pane active" id="general">
                            <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Supplier</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="supplier" id="supplier" class="form-control col-md-7 col-xs-12">
                                    <option value="<?php echo $supplier;?>"><?php echo $supplier;?></option>
                                    <?php
                                    foreach($supplierlist->result() as $row){
                                    $sub_id=$row->user_id;
                                    $sup_name=$row->username;
                                    ?>
                                        <option value="<?php echo $sub_id; ?>"><?php echo $sup_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                 
                                </div>
                            </div>
                            
                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Category<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="cat_id" id="cat_id" class="form-control col-md-7 col-xs-12"  
                                    onChange="getCategory('<?php echo base_url();?>admin/ajaxCategory?cat_id='+this.value);"
                                     required>
                                    <option value="<?php echo $cat_id;?>"><?php echo $cat_id;?></option>
                                    <?php
                                    foreach($allcategory->result() as $row){
                                    $caegory_title=$row->caegory_title;
                                    $cat_name=$row->cat_name;
                                    ?>
                                        <option value="<?php echo $caegory_title; ?>"><?php echo $cat_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                 <?php echo form_error('cat_id', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div id="citydiv">
                                         <select name="subcat_id" id="subcat_id" class="form-control col-md-7 col-xs-12"> 
                                                    <option value="<?php echo $scat_id;?>"><?php echo $scat_id;?></option>
                                         </select>
                                    </div>
                                </div>
                            </div>
                             <div class="form-group">
                               <label class="control-label col-md-3 col-sm-3 col-xs-12">Brand<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="brand" id="brand" class="form-control col-md-7 col-xs-12" required>
                                    <option value="<?php echo $brand;?>"><?php echo $brand;?></option>
                                    <?php
                                    foreach($allbrand->result() as $rowb){
                                    $caegory_title=$rowb->caegory_title;
                                    $cat_name=$rowb->cat_name;
                                    ?>
                                     <option value="<?php echo $caegory_title; ?>"><?php echo $cat_name; ?></option>
                                    <?php
                                    }
                                    ?>
                                    </select>
                                    <?php echo form_error('brand', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Name<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="pro_name" required class="form-control col-md-7 col-xs-12" 
                                    placeholder='Product Name' value="<?php echo $product_name; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Product Name'">
                                 <?php echo form_error('pro_name', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Code<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="pro_code" required class="form-control col-md-7 col-xs-12" 
                                    placeholder='Product Code' value="<?php echo $pro_code; ?>"  onFocus="this.placeholder=''" onBlur="this.placeholder='Product Code'">
                                 <?php echo form_error('pro_code', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                          
                          <div class="form-group">
	                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Serial No.<span class="required">*</span></label>
                             <div class="col-md-8 col-sm-8 col-xs-12">
                                    <div style="width:30%; float:left; margin:5px"  ng-repeat="item in items" ng-model="newItemName">
                                     <input type="text" name="serial_no[]" class="form-control" style="width:76%; float:left;" placeholder="Serial No.">
                                     <a ng-click="deleteItem($index)" class="btn btn-danger btn-sm" title="Remove This Row" 
                                     style="width:20%; float:left; text-align:center; padding:6px" >
                                        <i class="glyphicon glyphicon-remove-circle"></i></a>
                                    </div>
                                </div>
                             <div style="float:right; position:absolute; text-align:right; right:100px;" class="col-sm-2 pull-right">
                                <a href="javascript:void();" ng-click="addItem()" class="btn btn-success"><i class="fa fa-plus"></i></a></div>                            
                             </div>                       
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Product Details</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea type="text" name="full_description" class="form-control col-md-7 col-xs-12 ckeditor"><?php echo $details; ?></textarea>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Quantity<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="quantity"  class="form-control" style="width:50%" 
                                    placeholder='Only Number Allow' value="<?php echo $qty; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Only Number Allow'">
                                    <?php echo form_error('quantity', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Price<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="pro_price"  class="form-control" style="width:50%" 
                                    placeholder='Amount in BDT' value="<?php echo $pro_price; ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Amount in BDT'">
                                    <?php echo form_error('price', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Commission</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="commission" id="commission" required class="form-control" style="width:30%; float:left" value="0">
                                        <select name="com_type" id="comission_type" class="form-control"  style="width:20%; float:left">
                                        	<option value="%" selected="selected">%</option>
                                            <option value="Tk">Tk</option>
                                        </select>
                                    <?php echo form_error('price', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Vat</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="number" name="vat" id="vat" required class="form-control" style="width:50%; float:left" value="0">
                                       
                                    <?php echo form_error('price', '<p style="color:#ff0000;margin:0;">', '</p>'); ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Size</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="size"  class="form-control" style="width:50%" 
                                    placeholder='Available Size' value="<?php echo $size ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Available Size'">
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Color</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="color"  class="form-control" style="width:50%" 
                                    placeholder='Available color' value="<?php echo $color ?>"  onFocus="this.placeholder=''" 
                                    onBlur="this.placeholder='Available color'">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status<span class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="status" class="form-control"  style="width:50%" >
                                        <option value="1">Enable</option>
                                        <option value="0">Disable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="image">
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Product Main Image<span class="required">*</span>
                               </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="main_images">
                                </div>
                                <?php
                                if($main_image!=""){
                                    ?>
                                <div class="col-md-1 col-sm-1">
                                    <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"  style="height:auto; width:100%;" />
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="photo1">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="photo2">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Photo 2</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control" type="file" name="photo3">
                                </div>
                            </div>
                                        
                        </div>
                        
                        
                        <div class="tab-pane" id="seo">
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Title</label><div class="col-md-8 col-sm-8 col-xs-12">
                                    <input type="text" name="seo_title" class="form-control" value="<?php echo $seo_title;?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Meta Description</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea type="text" name="seo_details" class="form-control col-md-7 col-xs-12"><?php echo $seo_details;?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keywords</label>
                                <div class="col-md-8 col-sm-8 col-xs-12">
                                    <textarea type="text" name="keyword" class="form-control col-md-7 col-xs-12"><?php echo $keyword; ?></textarea>
                                </div>
                            </div>
                        </div>
                    	
                       
                        
                
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
                                        <input type="hidden" name="product_id" value="<?php echo $product_id;?>" />
                                        <input type="hidden" name="mainImg" value="<?php echo $main_image;?>" />
                                        <input type="hidden" name="photo1" value="<?php echo $photo1;?>" />
                                        <input type="hidden" name="photo2" value="<?php echo $photo2;?>" />
                                        <input type="hidden" name="photo3" value="<?php echo $photo3;?>" />

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
               