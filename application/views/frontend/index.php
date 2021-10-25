<div class="container">
    <div class="row">
         <div class="col-md-12" style="margin:0; padding:0 8px">
      <div id="main-banner" class="owl-carousel home-slider"  style="z-index:-9999999;">
        <?php 
        $i=0;
        foreach($bannerslider->result() as $banner):
            $image=$banner->image;
            $banner_name1=$banner->banner_name;
        ?>
        <div class="item"> <a href="#"><img src="<?php echo base_url('uploads/images/banner/'.$image)?>" alt="<?php echo $banner_name1;?>" 
        title="<?php echo $banner_name1;?>" style="width:100%; height:auto" /></a> </div>
        <?php endforeach; ?>
      </div>
      </div>
      </div>
    <div class="col-sm-12" style="background:#F8F8F8; margin-top:20px; box-shadow:#eaeaea 0 0 2px 2px; padding:20px 0;">
    	<div class="col-sm-10 col-sm-offset-1">
        
    <?php 
	if($productgallery->num_rows() > 0){
		$i=0;
		foreach($productgallery->result() as $gallery):
		  $product_id=$gallery->product_id;
		  $slug=$gallery->slug;
		  $product_name=$gallery->product_name;
		  $main_image=$gallery->main_image;
		  $prosummery=$gallery->details;
		  $pro_price=$gallery->price;
		  $size=$gallery->size;
			$i++;
		 // echo form_open(base_url('cart/add'), 'style="padding:0; margin:0"');?>
			<input type="hidden" value="<?php echo $product_id;?>" name="id" id="id<?php echo $i;?>" />
			<input type="hidden" value="<?php echo $product_name;?>" name="name" id="name<?php echo $i;?>" />
			<input type="hidden" value="<?php echo $pro_price;?>" name="price" id="price<?php echo $i;?>" />

			 <div class="col-sm-6">
			  <div style="height:400px; padding:10px; border:1px solid #eaeaea; margin-top:5px;background:#fff">
				<a href="#">
				  <img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" 
				  alt="<?php echo $product_name;?>" title="<?php echo $product_name;?>" style="width:90%; height:auto; max-height:250px"/>
				</a>
				
				
				<div class="col-sm-12">
				  <h4 class="col-sm-12" style="font-size:20px; text-transform:lowercase; font-weight:bold; 
				  color:#5F8DDC; font-family:Arial, Helvetica, sans-serif">
				  <?php echo $product_name;?> </h4>
				   <div class="col-sm-6" style="float:left; text-align:left; font-size:18px; font-weight:bold"> <?php echo $size;?></div>
				   <div class="col-sm-6" style="float:right;text-align:right; font-size:18px; font-weight:bold"> <?php echo $pro_price;?></div>
				   <div class="col-sm-12" style="margin-top:10px; text-align:center">
				  <div class="row" id="userstatus<?php echo $i;?>"></div>
				   <span id="loaderHide<?php echo $i;?>">
						<button type="button" onclick="addToCart(<?php echo $i;?>);" class="btn btn-success" style="font-size:20px;">
							<i class="fa fa-plus"></i> Order/Buy</button>
						</span>
				   <span id="LoadingImage<?php echo $i;?>" style="display:none;"><a href="javascript:void();" class="btn apply" style="background:#ccc">
						<i class="fa fa-paper-plane" aria-hidden="true"></i> 
						<img src="<?php echo base_url('assets/images/ajax-loader.gif');?>" style="width:20px; height:auto" /></a></span>     
						
				</div>
				</div>
				
			  </div>
			</div>

			<?php //echo form_close();
				endforeach;
			}
			else{
		echo '<h2 style="color:#f00; text-align:center;text-transform:uppercase; margin-top:10%; margin:auto float:left; font-size:30px; font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;">
		Sorry ! Product not found</h2>';
		}
		?>	
            
            
            
            
          </div>   
    	<div class="category-page-wrapper">
        <div class="pagination-inner">
          <ul class="pagination">
            <?php echo "<li>". $pagination."</li>"; ?>
          </ul>
        </div>
      </div>
    </div>
</div>
