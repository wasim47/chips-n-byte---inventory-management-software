  <div class="container">
    <div class="row">
    	<p class="text-center text-warning" style="margin-top: 15px;">
            <a href="https://drive.google.com/open?id=0B4h3m4eBUrEwaGVFdE5reUFtS2c">Download Android App</a>
            <br>
            <br>Developed by <a class="text-info" href="http://www.inlbd.com" target="_blank">Inl BD</a></p>
            	
    </div>
  </div>
  <a id="scrollup">Scroll</a>
<script src="<?php echo base_url();?>assets/javascript/parally.js"></script> 
<script>
$('.parallax').parally({offset: -40});
</script>
</body>

</html>

<div id="userLoginPopup" class="modal fade" role="dialog">
  <div class="modal-dialog" style="z-index:100000; opacity:1">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn btn-danger btn-xs pull-right" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" style="width:50%; float:left; color:#fff; font-family:Arial, Helvetica, sans-serif">User Login</h4>
            </div>
             <?php echo form_open('index/userLogin');?> 
                <div class="modal-body">
                    <div class="row" style="padding:0 20px 20px 20px">
                    
                                                
                    <div class="form-group">
                        <label class="control-label col-sm-4 arialfont"> Email<span class="require">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="username" required placeholder="Email Address" class="form-control"  style="margin-bottom:10px;"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-4 arialfont"> Password<span class="require">*</span></label>
                        <div class="col-sm-8">
                            <input type="password" name="password" required  class="form-control"  placeholder="Password"/>
                        </div>
                    </div>
                    
                    
                    
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <input type="submit" name="login" value="Login" class="btn btn-success pull-right" />
                  </div>
             <?php echo form_close();?>
        </div>
    </div>
</div>
