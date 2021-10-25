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
                	<li><a href="javascript:void(0);" id="maincat<?php echo $i;?>" onclick="menuSaled(<?php echo $i;?>)"><?php echo $catinfo->cat_name.' '.$icon;?> </a> 
                    	<?php if($subcatquery->num_rows() > 0){?>
                    		<ul id="subcatsale<?php echo $i;?>" style="display:none; margin-left:10px;">
                            	 <?php 
								 $j = 0;
								 foreach($subcatquery->result() as $scatinfo): $j++; ?>
									<li><a href="javascript:void(0)" onclick="smenuSaled(<?php echo $j;?>)"><?php echo $scatinfo->sub_cat_name;?></a>
                                    	<ul id="brandsale<?php echo $j;?>" style="display:none; margin-left:10px;">
											 <?php 
											 $k = 0;
											 foreach($brandque->result() as $brn): $k++;
											 		$productQuery = $this->db->query("SELECT * FROM product WHERE 
													cat_id = '".$catinfo->caegory_title."' AND scat_id = '".$scatinfo->sub_cat_title."' 
													AND brand = '".$brn->cid."'");
											  ?>
                                                <li><a href="javascript:void(0)" onclick="proSaled(<?php echo $k;?>)"><?php echo $brn->cat_name;?></a>
                                                	<ul id="productsale<?php echo $k;?>" style="display:none; margin-left:10px;">
														 <?php foreach($productQuery->result() as $pro):
														 	$pname = $pro->product_name;
															$pcode = $pro->pro_code;
															$pid = $pro->product_id;
															$pprice = $pro->price;
														  ?>
                                                            <li><a href="javascript:void(0)" onclick="getProductInfo('<?php echo $pname;?>','<?php echo $pid;?>','<?php echo $pcode;?>','<?php echo $pprice;?>');"><?php echo $pname;?></a></li>
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
	function menuSaled(id){
		$('#subcatsale'+id).slideToggle();
	}
	function smenuSaled(id){
		$('#brandsale'+id).slideToggle();
	}
	function proSaled(id){
		$('#productsale'+id).slideToggle();
	}
	function getProductInfo(name,id,code,price){
		//alert(code);
		$('#pro_name').val(name);
		$('#pro_code').val(code);
		$('#pro_id').val(id);
		$('#price').val(price);
		var prodnid = id+'~'+name;
		$('#products_id').val(prodnid);
	}
	
	
</script>