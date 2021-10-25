<link rel="stylesheet" href="<?php echo base_url();?>assets/megamenu/menu/css/style.css">

<div id="menuMega" class="menu3dmega navbar navbar-fixed-top bs-docs-nav" style="margin:0; padding:0; margin-bottom:0px;">
<ul class="container">
<li class="menu-non-dropdown">
<a href="<?php echo base_url();?>">
<i class="fa fa-home" style="font-weight:normal"></i> হোম</a>
</li>
<?php /*?><li>
<span class="arrow-icon-bottom"><span>Main Menu</span></span>
<div class="dropdown-menu flyout-menu">
    <ul>
		<?php foreach($menu->result() as $fmenu){
            $menu_name=$fmenu->menu_name;
            $slug=$fmenu->slug;
            $strMenu=$fmenu->page_structure;
            $m_id=$fmenu->m_id;
            $url=base_url('index/'.$strMenu.'/'.$slug);
			$query_scat=$this->db->query("select * from menu where root_id='".$m_id."' and sroot_id=0 order by m_id asc");
			if($query_scat->num_rows() > 0){
				$class1='dropdown-menu sub';
			}
			else{
				$class1='dropdown-menu';	
			}
        ?>
        <li><a href="javascript:void();" title="<?php echo $menu_name;?>"><?php echo $menu_name;?></a>
            <ul class="<?php echo $class1;?>">
            	<?php
					$row_scatRes=$query_scat->result();
					foreach($row_scatRes as $row_scat){
					$scid_id=$row_scat->m_id;
					$sslug=$row_scat->slug;
					$sub_cat_name=$row_scat->menu_name;
					$strSmenu=$row_scat->page_structure;
					$urls=base_url('index/'.$strSmenu.'/'.$slug.'/'.$sslug);
					$query_lcat=$this->db->query("select * from menu where sroot_id='".$scid_id."' order by m_id asc");
					if($query_lcat->num_rows() > 0){
						$class='dropdown-menu sub';
					}
					else{
						$class='dropdown-menu';	
					}
				?>
                <li><a href="javascript:;" title="<?php echo $sub_cat_name;?>"><?php echo $sub_cat_name;?></a>
                    <ul class="<?php echo $class;?>">
                        <?php
							
							$row_lcatRes=$query_lcat->result();
							foreach($row_lcatRes as $row_lcat){
							$lcid_id=$row_lcat->slug;
							$last_cat_name=$row_lcat->menu_name;
							$strLmenu=$row_scat->page_structure;
							$urll=base_url('index/'.$strLmenu.'/'.$slug.'/'.$sslug.'/'.$lcid_id);
						?>
                        <li><a href='<?php echo $urll;?>' title="<?php echo $last_cat_name;?>"><?php echo $last_cat_name;?></a></li>
                        <?php
						}
						?>
                    </ul>
                </li>
              <?php
				  }
				?>  
            </ul>
       </li>
        <?php
		  }
		?>
        
    </ul>
</div>
</li><?php */?>
<?php 
foreach($query_cat->result() as $row_cat){
	$cat_id=$row_cat->caegory_title;
	$cat_name=$row_cat->cat_name;
?>
<li class="full-width">
<a href="<?php echo base_url('products/gallery/'.$cat_id);?>" style="font-weight:normal;"><?php echo $cat_name;?></a>
<div class="dropdown-menu flyout-menu">
<div class="content" style="margin-top:0; padding-top:0">
        	<div class="navMenu">
			<?php
               $query_scat=$this->db->query("select * from sub_category where cat_id='".$cat_id."' order by sub_cat_name asc");
				foreach($query_scat->result() as $row_scat){
					$scid_id=$row_scat->sub_cat_title;
					$scid_name=$row_scat->sub_cat_name;
                ?>
                <div class="navMenu-column">
                    <h3><a href="<?php echo base_url('products/gallery/'.$cat_id.'/'.$scid_id);?>" style="font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi;font-size:16px"><?php echo $scid_name;?></a></h3>
                    <ul>
                        <?php
                        $query_lcat=$this->db->query("select * from last_category where cat_id='".$cat_id."' and subcat_id='".$scid_id."' order by lastcat_name asc");
						foreach($query_lcat->result() as $row_lcat){
							$last_cat_title=$row_lcat->last_cat_title;
						    $lastcat_name=$row_lcat->lastcat_name;
                        ?>
                   <li><a href="<?php echo base_url('products/gallery/'.$cat_id.'/'.$scid_id.'/'.$last_cat_title);?>" style="font-family: BNG,SutonnyBanglaOMJ,SolaimanLipi; font-size:15px "><?php echo $lastcat_name;?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
               <?php
                }
                ?>
            </div>
</div>
</div>
</li>
<?php
}
?>


<li>
<a href="#" style="font-weight:normal;">বুটিক শপ</a>
<div class="dropdown-menu">
    <div class="content">
    	<?php
		  foreach($allbutikshop->result() as $allbutik){
			  $butikname=$allbutik->username;
			  $urlnamemenu=$allbutik->urlname;
			  $butikimg=$allbutik->photo;
			  $butikId=$allbutik->user_id;
			  if($allbutikshop->num_rows() > 0){
						$urlm= base_url($urlnamemenu);
						$targetm='_blank';
				 }
				 else{
				   $urlm= "javascript:void();";  
				   $targetm='_self"';
				 }
		  ?>
        <div class="col-lg-1" style="margin:3px 10px; padding:3px; border:1px solid #F7C723">
          <a href="<?php echo $urlm;?>" target="<?php echo $targetm;?>">
            <img src="<?php echo base_url('uploads/images/boutiqueshop/'.$butikimg);?>" title="<?php echo $butikname;?>" alt="<?php echo $butikname;?>" class="img_responsive">
           </a>
        </div>
        <?php } ?>
    </div>
</div>
</li>
<li>
<a href="#" style="font-weight:normal;">মিডিয়া</a>
<div class="dropdown-menu span5">
<div class="content">
<ul class="media-list">
<li class="media">
<a class="pull-right" href="#"> <img alt="64x64" src="<?php echo base_url('assets/megamenu/img/photo.jpg');?>"> </a>
</li>
<li class="media">
<a class="pull-right" href="#"> <img alt="64x64" src="<?php echo base_url('assets/megamenu/img/video.jpg');?>"> </a>

</li>
</ul>
</div>
</div>
</li>
<!--<li><a href="#">Contact</a>
<div class="dropdown-menu">
<div class="clearfix content">
<div class="col-lg-6">
<div class="menu-title">YOU CAN FIND US HERE</div>

</div>
<div class="col-lg-6">
<div class="menu-title margin-botton-10">CONTACT US</div>
<ul class="contact-form">
<li>
<span>Name (required) </span>
<input type="text" name="name" class="form-control"/>
</li>
<li>
<span>Eamil (required) </span>
<input type="text" name="email" class="form-control"/>
</li>
<li>
<span>Subject </span>
<input type="text" name="subject" class="form-control"/>
</li>
<li>
<span>Message </span>
<textarea name="message" class="form-control"></textarea>
</li>
<li>
<input type="submit" value="Send" class="btn btn-success"/>
</li>
</ul>
</div>
</div>
<div class="separate"></div>
<div class="clearfix content">
<div class="col-lg-6">
<div class="social">
<a class="no-background" href="#"><img src="img/feed.png" alt="Feed"></a>
<a class="no-background" href="#"><img src="img/facebook.png" alt="Facebook"></a>
<a class="no-background" href="#"><img src="img/twitter.png" alt="Twitter"></a>
<a class="no-background" href="#"><img src="img/linkedin.png" alt="Linkedin"></a>
<a class="no-background" href="#"><img src="img/flickr.png" alt="Flickr"></a>
<a class="no-background" href="#"><img src="img/vimeo.png" alt="Vimeo"></a>
</div>
</div>
</div>
</div>
</li>-->


</ul>


</div>
<input type="checkbox" style="display:none" id="ckbResponsive"/>