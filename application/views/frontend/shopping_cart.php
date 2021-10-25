<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all Shopping?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}

function remove_item(id) {
	var result = confirm('Are you sure want to Remove this item from cart');
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/"+id;
	}else{
		return false; // cancel button
	}
}


 function orderFormSub()
    {
       document.orderform.action = "<?php echo base_url('index/ordersubmitted');?>";
       document.orderform.submit();          
       return true;
    }

    function updateCart()
    {
       document.orderform.action = "<?php echo base_url('cart/update_cart');?>";
       document.orderform.submit();          
       return true;
    }
</script>
<div class="container">
  
  <div class="row">
    
    
    
    
    <?php if ($cart = $this->cart->contents()){
			//$url='index/ordersubmitted';
		   echo form_open_multipart('cart/update_cart', array('class'=>'form-horizontal','role'=>'form','name'=>'orderform'));?>
    <div class="col-sm-12" id="content">
    	
        <div class="cattitle"><h3>Shopping Cart &nbsp;(<?php echo count($cart);?> Items)</h3></div>
        <div class="table-responsive">
          <table class="table table-bordered" width="100%">
            <thead>
              <tr>
                <td width="15%" align="left" class="text-center">Image</td>
                <td width="26%" align="left" class="text-left">Product Name</td>
                <td width="11%" align="left" class="text-left">Model</td>
                <td width="21%" align="left" class="text-left">Quantity</td>
                <td width="12%" align="left" class="text-right">Unit Price</td>
                <td width="15%" align="left" class="text-right">Total</td>
              </tr>
            </thead>
            <tbody>
            	<?php
        $grand_total = 0; $i = 1;
        //echo form_open('cart/update_cart');
        foreach ($cart as $item):
         	echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
			echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
			echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
			echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
			echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
			
			$grand_total = $grand_total + $item['subtotal'];
			$productAllId[] = $item['id'];
			//$totitemval[] = $item['id'];
			//echo count($totitemval);
			$qty[] = $item['qty'];
			$unitPrice[] = $item['price'];
			$subtotal[] = $item['subtotal'];
			$shippment_val = $item['options']['shipment'];
			$shippment_total_val[] = $shippment_val;
				
			  $pro_id=$item['id'];
			  $result=$this->db->query("select * from product where product_id='$pro_id'");
			  $resPro=$result->result();
			  foreach($resPro as $pro);
			  $product_id=$pro->product_id;
			  $main_image=$pro->main_image;
			  $pro_price=$pro->price;
			  $pro_code=$pro->pro_code;
			  $main_image=$pro->main_image;
			  
			  
	?>
              <tr>
                <td align="center" class="text-center"><a href="<?php echo base_url();?>index/product_details/<?php echo $product_id;?>"><img src="<?php echo base_url()?>uploads/images/product/main_img/<?php echo $main_image;?>" alt="<?php echo $item['name'];?>" style="width:80px; height:60px	"></a></td>
                <td align="center" class="text-left"><a href="<?php echo base_url();?>index/product_details/<?php echo $product_id;?>"><?php echo $item['name'];?></a></td>
                <td align="center" class="text-left"><?php echo $pro_code;?></td>
                
              <td align="center" class="text-right"><div style="max-width: 200px;" class="input-group btn-block">
                    <?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="5" size="1" class="form-control quantity"'); ?>
                    <span class="input-group-btn">
                    <button class="btn btn-primary" data-toggle="tooltip" type="button" onclick="updateCart();" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                    <button class="btn btn-danger" data-toggle="tooltip" type="button" data-original-title="Remove" 
                    onclick="remove_item('<?php echo $item['rowid']; ?>');"><i class="fa fa-times-circle"></i></button>
                    </span></div></td>
                <td align="center" class="text-left"><?php echo 'BDT '.$item['price'].' Tk';?></td>
                <td align="center" class="text-right"><?php echo 'BDT '.$item['subtotal'].' TK';?></td>
              </tr>

			
           	    <input type="hidden" value="<?php echo $main_image;?>" name="mainimg<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $pro_code;?>" name="pro_code<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $item['name'];?>" name="pro_name<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $item['id'];?>" name="product_id<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $item['qty'];?>" name="qty<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $item['price'];?>" name="unit_price<?php echo $i;?>" />
                <input type="hidden" value="<?php echo $item['subtotal'];?>" name="sub_total<?php echo $i;?>" />
       		<?php   
			$i++;
			endforeach; ?>
            <?php
        $pro_array = join(',', $productAllId);
         $grandTotalPrice = $grand_total;
        ?>
        <input type="hidden" value="<?php echo $pro_array;?>" name="productId" />          
              
            </tbody>
	            <tfoot>
                     <tr>
                        <td colspan="4" align="right"><strong>Grand Total</strong></td>
                        <td colspan="2" align="right"><strong><?php echo number_format($grandTotalPrice,2);?></strong></td>
                    </tr>
                </tfoot>
          </table>
      </div>
      
      
      <div class="buttons">
        <div class="pull-left"><a class="btn btn-info" href="javascript:void();" onclick="location.history.back();" style="padding:10px; border-radius:10px;">
        << Continue Shopping</a></div>
        <div class="pull-right">
        
        
        
        <?php 
			if($this->session->userdata('userAccessMail') && $this->session->userdata('userAccessType')=='customer'){
			?>
           <input type="button" class="btn btn-success" name="confirmorder" onclick="orderFormSub();" style="padding:10px; border-radius:10px;" value="Submit Order >> " />
		   <?php
		   }
		   else{
		   ?>
           <a class="btn btn-primary" href="javascript:void()" data-toggle="modal" data-target="#userLoginPopup" style="padding:10px; border-radius:10px;">Submit Order >></a>
		   <?php
		   }
		   ?>
                       
        </div>
      </div>
    </div>
    
    
      <?php
            $order_q=$this->db->query("select * from orders order by order_id desc limit 1");
			if($order_q->num_rows() > 0){
				foreach($order_q->result() as $ord);
				$orderN=$ord->order_number;
					$orderNum=$orderN+1;
			}
			else{
				$orderNum=1111;
			}
            ?>
            <input type="hidden" name="order_number" value="<?php echo $orderNum;?>" />
            <input type="hidden" name="total_price" value="<?php echo $grandTotalPrice;?>" />
            
    <?php
	//echo $this->session->userdata('userAccessMail');
	 echo form_close();
	 }
	 else{
		?>
        <div class="heading-counter warning" style="text-align:center; font-size:20px; color:#f00">Your shopping cart is Empty</span>
          </div>
        <?php
	}
?>
  </div>
</div>