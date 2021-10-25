<div class="leftcat">
            	<h2 style="background:#fff; color:#333; padding:7px 10px; margin:0 0 10px 0;">Select Product</h2>
                <ul>
                    
                    <?php 
					$i=0;
					$categorylist = $this->Index_model->getTable('category','cid','asc');
					foreach($categorylist->result() as $catinfo):
					$i++;
					$subcatquery = $this->db->query("SELECT * FROM sub_category WHERE cat_id = '".$catinfo->caegory_title."'");
					$brandque = $this->db->query("SELECT * FROM brand");
					if($subcatquery->num_rows() > 0){
						$icon = '<i class="fa fa-plus" style="float:right; text-align:right"></i>';
					}
					else{
						$icon = '';
					}
					?>
                	<li><a href="javascript:void(0);" id="maincat<?php echo $i;?>" onclick="catSale1(<?php echo $i;?>)"><?php echo $catinfo->cat_name.' '.$icon;?> </a> 
                    	<?php if($subcatquery->num_rows() > 0){?>
                    		<ul id="subcatsale1<?php echo $i;?>" style="display:none; margin-left:10px;">
                            	 <?php 
								 $j = 0;
								 foreach($subcatquery->result() as $scatinfo): $j++; ?>
									<li><a href="javascript:void(0)" onclick="scatSale1(<?php echo $j;?>)"><?php echo $scatinfo->sub_cat_name;?></a>
                                    	<ul id="brandsale1<?php echo $j;?>" style="display:none; margin-left:10px;">
											 <?php 
											 $k = 0;
											 foreach($brandque->result() as $brn): $k++;
											 		$productQuery = $this->db->query("SELECT * FROM product WHERE 
													cat_id = '".$catinfo->caegory_title."' AND scat_id = '".$scatinfo->sub_cat_title."' 
													AND brand = '".$brn->cid."'");
											  ?>
                                                <li><a href="javascript:void(0)" onclick="proSale1(<?php echo $k;?>)"><?php echo $brn->cat_name;?></a>
                                                	<ul id="productsale1<?php echo $k;?>" style="display:none; margin-left:10px;">
														 <?php foreach($productQuery->result() as $pro):
														 	$pname = $pro->product_name;
															$pcode = $pro->pro_code;
															$pid = $pro->product_id;
															$pprice = $pro->price;
															$psize = $pro->size;
															$pqty = $pro->qty;
														  ?>
                                                            <li><a href="javascript:void(0)" onclick="getSaleProductInfo('<?php echo $pname;?>','<?php echo $pid;?>','<?php echo $pcode;?>','<?php echo $pprice;?>','<?php echo $psize;?>','<?php echo $pqty;?>');"><?php echo $pname;?></a></li>
                                                         <?php endforeach; ?>
                                                    </ul>
                                                </li>
                                             <?php endforeach; ?>
                                        </ul>
                                    </li>
                                 <?php endforeach; ?>
							</ul>
                         <?php } ?>
                    </li>
                    <?php endforeach; ?>
				</ul>
            </div>
            
            
<script type="text/javascript">
	function catSale1(id){
		$('#subcatsale1'+id).slideToggle();
	}
	function scatSale1(id){
		$('#brandsale1'+id).slideToggle();
	}
	function proSale1(id){
		$('#productsale1'+id).slideToggle();
	}
	
	function getSaleProductInfo(name,id,code,price,size,qty){
		//alert(code);
		$('#pro_code').val(code);
		$('#pro_id').val(name);
		$('#unit_price').val(price);
		$('#sale_price').val(price);
		$('#products_id').val(id);
		$('#size').val(size);
		$('#pro_qty').val(qty);
		
		 var totalpp = qty*price;
		 var totalFormate = parseFloat(totalpp).toFixed(2);
		    $("#total_pro_price").val(totalFormate);
			$("#pro_vat").val(0);
			$("#pro_commission").val(0);
	}
</script>