<?php include("tophead.php");?>
<script>
$(window).scroll(function () { 
	if ($(this).scrollTop() > 100) {
		$("#headerarea").addClass("fixed-header");
	} else {
		$("#headerarea").removeClass("fixed-header");
	}
});

 function addToCart(si){
 	//alert(si);
   $("#LoadingImage"+si).show();
   $("#loaderHide"+si).hide();
   	  var pid = $("#id"+si).val();
	  var pname = $("#name"+si).val();
	   var pprice = $("#price"+si).val();
	  //alert(jid);
   	  var surl = '<?php echo base_url('cart/add');?>';
	  
      $.ajax({ 
        type: "POST", 
        dataType: "json",
        url: surl,  
		data:{'id':pid,'name':pname,'price':pprice},
        cache : false, 
        success: function(response) { 
          $("#LoadingImage"+si).hide();
		  $("#loaderHide"+si).show();
		  
		   $("#userstatus"+si).html(response.msg);
		   $("#cartinfoajax").html(response.cart_info);
		   $("#cartbtn").css('display','inline');
		   $("#totalcart").html(response.totalc);
          // alert(response.cart_info); 
		  console.log(response.cart_info);
        }, 
        error: function (xhr, status) {  
          $("#LoadingImage"+si).hide();
		  $("#loaderHide"+si).show();
          alert('Unknown error ' + status); 
        }    
      });  
    }
</script>
<header>

 <div class="cs-headertop clearfix cs-sticky-fixed animated fadeInDown">
  <div class="container">
      <div class="col-sm-1 col-xs-12 header-left">
         <a href="<?php echo base_url();?>">
          <img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100%; height:auto" title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></a> 
      </div>
      <div class="col-sm-2">&nbsp;</div>
      <div class="col-sm-7 col-xs-12">
          <?php echo form_open('', 'style="padding:0; margin:0"');?>
        <input type="text" class="searchbox" placeholder="Search Products..." name="keyword" />
        <button type="submit" class="btn btn-success" style="width:5%; float:left; font-size:18px; margin-top:5px; padding:8px 10px"><i class="fa fa-search"></i></button>
        <?php echo form_close(); ?>
      </div>
      <div class="col-sm-2 col-xs-12 header-right">
    		
        <div class="col-sm-12 pull-right">
            <div id="header_user_info">          
                <?php 
                if($this->session->userdata('userAccessMail') && $this->session->userdata('userAccessType')=='customer'){
                ?>
               <a class="login" href="<?php echo base_url('index/logout');?>" title="Sign Out"><i class="fa fa-sign-out" style="font-size:20px;"></i></a>
               <?php
               }
               else{
               ?>
               <a class="login" href="javascript:void()" data-toggle="modal" data-target="#userLoginPopup" title="Sign in">
               <i class="fa fa-sign-in" aria-hidden="true" style="font-size:20px;color:#ebe8e1;"></i></a>
               <?php
               }
               ?>
                
                  <div id="cart">
                     <button type="button" class="dropdown-toggle cart-dropdown-button" 
                                style="background:none; color:#ebe8e1; border:none; margin:0; padding:0; display:none" id="cartbtn">
                                     <span id="cart-total" style="margin:0; padding:0">
                                        <i class="fa fa-shopping-cart icondefault" aria-hidden="true" 
                                        style="margin-top:0; font-size:30px"></i><span class="cart-title"><span id="totalcart"></span></span>
                                     </span>
                                </button>           
                     <div id="cartinfoajax">
                            <?php if ($cart = $this->cart->contents()){
                                 $grand_total1 = 0;
                                 foreach ($cart as $item):
                                
                                $totalItem=count($cart);
                                $grand_total1 = $grand_total1 + $item['subtotal'];
                                endforeach;
                                $grandTotalPrice1=$grand_total1+60;					
                             ?>
                         
                             <button type="button" class="dropdown-toggle cart-dropdown-button" style="background:none; color:#ebe8e1; border:none; margin:0; padding:0">
                                     <span id="cart-total" style="margin:0; padding:0">
                                        <i class="fa fa-shopping-cart icondefault" aria-hidden="true" 
                                        style="margin-top:0; font-size:30px"></i><span class="cart-title"><?php echo $totalItem;?></span>
                                     </span>
                                </button>
                          <ul class="dropdown-menu pull-right cart-dropdown-menu" style="margin:0; padding:0; border:1px solid #000; max-height:500px; overflow:scroll; overflow-x:hidden">
                             <li>
                              <table class="table"  width="100%" style="margin:0; padding:0;">
                                <tbody>
                                  <tr style="background:#2d2d2d; color:#fff">
                                    <td width="3%">Image</td>
                                    <td width="43%" style="padding:0; margin:0; font-size:10px;">Name</td>
                                    <td width="17%" style="padding:0; margin:0; font-size:10px;">Price</td>
                                    <td width="25%" style="padding:0; margin:0; font-size:10px;">Qty</td>
                                    <td width="12%" style="padding:0; margin:0; font-size:10px;" align="center" title="Remove"><i class="fa fa-times" aria-hidden="true" title="Remove"></i></td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                            <?php
                            $grand_total = 0; $i = 1;
                            //print_r($cart);
                            foreach ($cart as $item):
                                echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
                                echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
                                echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
                                echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
                                echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
                                
                                  $pro_id=$item['id'];
                                  $result=$this->db->query("select * from product where product_id='$pro_id'");
                                  $resPro=$result->result();
                                  foreach($resPro as $pro);
                                  $product_id=$pro->product_id;
                                  $main_image=$pro->main_image;
                                  $pro_price=$item['price'];
                                  
                                 $grand_total = $grand_total + $item['subtotal'];
                                
                            ?>
                            <li>
                              <table class="table"  width="100%" style="margin:0; padding:0;">
                                <tbody>
                                  <tr>
                                    <td width="4%">
                                    <a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>" style="padding:0; margin:0;">
                                    <img style="width:40px; height:auto" alt="<?php echo $item['name'];?>" title="<?php echo $item['name'];?>" 
                                    src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>"></a></td>
                                    
                                    <td width="43%" class="text-left" style="padding:0; margin:0;">
                                    <a href="<?php echo base_url();?>products/<?php echo $pro->slug;?>" style="font-size:9px;"><?php echo $item['name'];?></a></td>
                                    <td width="17%" class="text-right" style="padding:0; margin:0;"> <?php echo $pro_price; ?></td>
                                    <td width="24%" class="text-right" style="padding:0; margin:0;"><i class="fa fa-times" aria-hidden="true"></i> <?php echo $item['qty']; ?></td>
                                  
                                    <td width="12%" class="text-right">
                                    <button title="Remove" type="button" style="padding:3px 5px; border-radius:10px; color:#de5347; background:none; border:none; font-size:15px;" 
                                    onclick="window.location.href='<?php echo base_url('cart/remove/'.$item['rowid']);?>'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </li>
                             <?php endforeach;?>  
                             <li style="border-top:1px solid #ccc; padding:10px 0">
                                <table width="100%" class="table" style="margin:0; padding:0;">
                                            <tr>
                                                <td style="padding:0 10px; margin:0;">Subtotal</td>
                                                <td style="padding:0 10px; margin:0;"><?php echo $grand_total;?></td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0 10px; margin:0;">Shipping</td>
                                                <td style="padding:0 10px; margin:0;">60</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0 10px; margin:0;">Total</td>
                                                <td style="padding:0 10px; margin:0;">
                                                    <?php 
                                                    $grandTotalPrice=$grand_total+60;						
                                                    echo $grandTotalPrice;?>
                                                </td>
                                            </tr>
                                            <tr><td colspan="2">&nbsp;</td></tr>
                                            <tr>
                                                <td><a href="<?php echo base_url('cart/shopping_cart');?>" class="btn" 
                                                style="font-size:16px; text-align:left; background:#de5347;border-radius:5px;">View Cart</a></td>
                                                
                                            </tr>
                                        </table>
                             </li>
                          </ul>
                          <?php
                          }
                            else{
                                $totalItem=0;
                                ?>
                            <button type="button" class="dropdown-toggle cart-dropdown-button" style="background:none; color:#ebe8e1; border:none; margin:0; padding:0">
                                 <span id="cart-total">
                                    <i class="fa fa-shopping-cart icondefault" aria-hidden="true" 
                                    style="font-size:30px"></i><span class="cart-title"><?php echo $totalItem;?></span>
                                 </span>
                            </button>
                     <?php
                      }
                      ?>
              
                    </div>
        		</div>
            </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php if($this->session->flashdata('invalidmsg')!=""){ 
 	 echo '<div class="row">'.$this->session->flashdata('invalidmsg').'</div>';
   }?>
</header>

