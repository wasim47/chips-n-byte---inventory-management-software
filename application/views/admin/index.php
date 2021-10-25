<?php $this->load->view('includes/admin_tophead.php');?>
<div class="main_container">
             <div class="col-md-4 col-sm-6 col-xs-12 col-lg-offset-4 col-md-offset-4 col-sm-offset-4" style="margin-top:10%;">
<a href="<?php echo base_url() ?>"> <center> 
<a href="#"><h2><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:150px; height:auto" /></h2></a>
<h1 style="color:#FFFFFF"><?php echo $cname;?></h1> </center> </a>	
	<div class="panel panel-primary">
	
	     <?php echo form_open('admin/userLogin', array('class'=>'form-horizontal', 'style'=>'margin-bottom: 0px !important;')); ?>

	
		<div class="panel-body">
			<h4 class="text-center" style="margin-bottom: 25px;">Log in to get started </h4>
						<?php echo $this->session->flashdata('msg');?>
                
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" id="username" placeholder="Username">
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="input-group">
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" name="password" class="form-control" id="password" placeholder="Password">
								</div>
							</div>
						</div>				
					
		</div>
		<div class="panel-footer">
			<div class="pull-right">
				
               <?php echo form_reset('', 'Reset',"class='btn btn-default'"); ?>
               <?php echo form_submit('submit', 'Log In',"class='btn btn-primary'"); ?>
			</div>
            
		</div>
		
		</form>
		
		
	</div>
 </div>
</div>
</html>