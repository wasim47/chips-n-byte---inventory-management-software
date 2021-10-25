<html>
<head>
<script>
function clear_cart() {
		setTimeout("location.href = '<?php echo base_url(); ?>cart/remove/all';",5000);
}
</script>
</head>
<body onLoad="clear_cart();">
<section id="cart_items">
		<div class="container">
        <div class="row middlecontainer">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="col-sm-12 middlecontainer" style="text-align:center; min-height:400px;">
            	<h2>Successfully Order Submitted</h2>
            	<div class="col-sm-12">Thanks for Online shopping with butikbd.com<br />Your Shopping Information Details already sent to your email address</div>
			</div>
		    
</div>
		</div>
	</section>
</body>
</html>