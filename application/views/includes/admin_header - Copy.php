<?php include('admin_tophead.php');?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0; height:auto">
                        <a href="#"><img src="<?php echo base_url();?>assets/images/logo.png" class="img-responsive" style="margin:10px;"></a>
                    </div>
                    <div class="clearfix"></div>



                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top:60px;">

							 <?php if($this->session->userdata('AdminType')=="Precident" || 
							  $this->session->userdata('AdminType')=="CEO" || 
							  $this->session->userdata('AdminType')=="Country Manager"):?>
                        	
                                <div class="menu_section">
                                <h3 style="font-size:16px">Setting</h3>
                                <ul class="nav side-menu">
                             
                                    <li><a><i class="fa fa-home"></i> Home <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/dashboard');?>">Dashboard</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-desktop"></i>Administration<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/admin_list');?>">Admin List</a></li>
                                                <li><a href="<?php echo base_url('admin/admin_registration');?>">New Admin Registration</a></li>
                                            </ul>
                                        </li>                                
                                 </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px; margin-left:5px; padding:0;">Category & Products</h3>
                                <ul class="nav side-menu">
                                    
                                   
                                           <li><a><i class="fa fa-bars"></i>Product Category<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/category_list');?>">Category List</a></li>
                                            <li><a href="<?php echo base_url('admin/category_registration');?>">New Category</a></li>
                                            <li><a href="<?php echo base_url('admin/sub_category_list');?>">Sub Category List</a></li>
                                            <li><a href="<?php echo base_url('admin/sub_category_registration');?>">New Sub Category</a></li>
                                            <!--<li><a href="<?php echo base_url('admin/last_category_list');?>">Last Category List</a></li>
                                            <li><a href="<?php echo base_url('admin/last_category_registration');?>">New Last Category</a></li>-->
                                        </ul>
                                    </li>
                                    
                                    <li><a><i class="fa fa-picture-o"></i>Product Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_product_list');?>">Pre Order Product List</a></li>
                                             <li><a href="<?php echo base_url('admin/product_list');?>">In Stock Product List</a></li>
                                            <li><a href="<?php echo base_url('admin/product_registration');?>">New Product</a></li>
                                        </ul>
                                    </li>                           
                                   
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px"> In Stock Manager</h3>
                                <ul class="nav side-menu">
                                    
                                   
                                                                    
                                    <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/order_list');?>">Order List</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i>Purchase<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/purchase');?>">Purches</a></li> 
                                        </ul>
                                    </li>
                                    
                                  <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/purchasestock');?>">Stock Management</a></li>
                                        <li> <a href="<?php echo base_url('admin/purchasestock');?>">Stock Out</a></li>
                                        
                                    </ul>
                                </li>
                                  <li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/asset_investment_list');?>">Asset List</a></li>
                                        <li><a href="<?php echo base_url('admin/asset_investment_registration');?>">New Asset</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                 <li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/internal_cost_list');?>">Cost List</a></li>
                                            <li><a href="<?php echo base_url('admin/internal_cost_registration');?>">New Cost</a>
                                            </li>
                                        </ul>
                                    </li>
                                 <li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <li><a href="<?php echo base_url('admin/daily_sale_reports');?>">Daily Sales Report</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_sale_reports');?>">Date Wise Sales Report</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/today_reports');?>">Daily Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_reports');?>">Date Wise Balance Sheet</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/purchasereport');?>">Purchase Invoice Reports</a></li>
                                          <li> <a href="<?php echo base_url('admin/stockin_reports');?>">Current Stock Report</a></li><!--
                                         <li> <a href="<?php echo base_url()?>storestock_report/sales_invoice">Salesman Invoice History</a></li>
                                        <li> <a href="<?php echo base_url()?>userstock_report/showroom">Showroom Invoice History</a></li>
                                        <li> <a href="<?php echo base_url('admin/stockout_reports');?>">Stockout History</a></li>-->
                                        </ul>
                                    </li>
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px"> Pre Stock Manager</h3>
                                <ul class="nav side-menu">
                                    <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_order_list');?>">Order List</a></li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i>Purchase<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_purchase');?>">Purches</a></li> 
                                        </ul>
                                    </li>
                                    
                                    <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/pre_purchasestock');?>">Stock Management</a></li>
                                        <li> <a href="<?php echo base_url('admin/pre_purchasestock');?>">Stock Out</a></li>
                                        
                                    </ul>
                                </li>
                                    <li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/pre_asset_investment_list');?>">Asset List</a></li>
                                        <li><a href="<?php echo base_url('admin/pre_asset_investment_registration');?>">New Asset</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                   <li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_internal_cost_list');?>">Cost List</a></li>
                                            <li><a href="<?php echo base_url('admin/pre_internal_cost_registration');?>">New Cost</a>
                                            </li>
                                        </ul>
                                    </li>
                                   <li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <li><a href="<?php echo base_url('admin/pre_daily_sale_reports');?>">Daily Sales Report</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_datewise_sale_reports');?>">Date Wise Sales Report</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/pre_today_reports');?>">Daily Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_datewise_reports');?>">Date Wise Balance Sheet</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/pre_purchasereport');?>">Purchase Invoice Reports</a></li>
                                          <li> <a href="<?php echo base_url('admin/pre_stockin_reports');?>">Current Stock Report</a></li><!--
                                         <li> <a href="<?php echo base_url()?>storestock_report/sales_invoice">Salesman Invoice History</a></li>
                                        <li> <a href="<?php echo base_url()?>userstock_report/showroom">Showroom Invoice History</a></li>
                                        <li> <a href="<?php echo base_url('admin/pre_stockout_reports');?>">Stockout History</a></li>-->
                                        </ul>
                                    </li>
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px; margin-left:5px; padding:0;">Customer Care</h3>
                                <ul class="nav side-menu">
                                    
                                   <li><a><i class="fa fa-comment"></i>Email & Messages<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Email</a></li>
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Messages</a></li>
                                        </ul>
                                    </li>
                         		   <li><a><i class="fa fa-users"></i>Customer<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customer_list');?>">Customer List</a></li>
                                        </ul>
                                    </li>                           
                                   
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px; margin-left:5px; padding:0;">Brand Promoter</h3>
                                <ul class="nav side-menu">
                                    
                                     <li><a><i class="fa fa-comment"></i>Email & Messages<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Email</a></li>
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Messages</a></li>
                                        </ul>
                                    </li>
                         		     <li><a><i class="fa fa-users"></i>Customer<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customer_list');?>">Customer List</a></li>
                                        </ul>
                                    </li>                          
                                   
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px">Website</h3>
                                <ul class="nav side-menu">       
                                  
                                    <li><a><i class="fa fa-bars"></i>Menu Manage<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/menu_list');?>">Menu List</a></li>
                                                <li><a href="<?php echo base_url('admin/menu_registration');?>">Menu Registration</a></li>
                                            </ul>
                                        </li>
                                    <li><a><i class="fa fa-font"></i>Article Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/article_list');?>">Article List</a></li>
                                            <li><a href="<?php echo base_url('admin/article_registration');?>">Article Registration</a></li>
                                        </ul>
                                    </li>
                                  
                                    <li><a><i class="fa fa-picture-o"></i>Banner Banage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/banner_list');?>">Banner List</a></li>
                                            <li><a href="<?php echo base_url('admin/banner_registration');?>">Banner Registration</a></li>
                                        </ul>
                                    </li>
                                   
                                   </ul>
                                  </div>
                         <?php endif; ?>
                         
                         
                         <?php 
						 if($this->session->userdata('AdminType')=='Employee' && $this->session->userdata('AdminAccessPermission')!=""){
							   $userAccess=explode(',',$this->session->userdata('AdminAccessPermission'));
							   
							   ?> 
                                
                                <?php if(in_array('category',$userAccess)){?>     
                              	  <div class="menu_section">
                                    <h3 style="font-size:16px; margin-left:5px; padding:0;">Category</h3>
                                    <ul class="nav side-menu">
                                          <li><a><i class="fa fa-bars"></i>Category<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/category_list');?>">Category List</a></li>
                                                <li><a href="<?php echo base_url('admin/category_registration');?>">New Category</a></li>
                                                <li><a href="<?php echo base_url('admin/sub_category_list');?>">Sub Category List</a></li>
                                                <li><a href="<?php echo base_url('admin/sub_category_registration');?>">New Sub Category</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                  </div>
                                <?php } ?>
                                <?php if(in_array('product_entry',$userAccess)){?>
                                <div class="menu_section">
                                	<h3 style="font-size:16px; margin-left:5px; padding:0;">Products</h3>
                                    <ul class="nav side-menu">
                                        <li><a><i class="fa fa-picture-o"></i>Product Manage<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/product_registration');?>">New Product</a></li>
                                            </ul>
                                        </li>                           
                                    </ul>
                                </div>
                                <?php } ?>
                                
								
								
                                <div class="menu_section">
                                <h3 style="font-size:16px"> In Stock Manager</h3>
                                <ul class="nav side-menu">
                                    <?php if(in_array('instockproduct',$userAccess)){?>                                
                                  		 <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/product_list');?>">Product List</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('order',$userAccess)){?>                                
                                         <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/order_list');?>">Order List</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('purchase',$userAccess)){?>
                                   		 <li><a><i class="fa fa-list-alt"></i>Purchase<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/purchase');?>">Purches</a></li> 
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('stock',$userAccess)){?>
                                  		  <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/purchasestock');?>">Stock Management</a></li>
                                                <li> <a href="<?php echo base_url('admin/purchasestock');?>">Stock Out</a></li>
                                                
                                            </ul>
                                        </li>
									<?php } ?>
                                    <?php if(in_array('accounts',$userAccess)){?>
                                   		  <li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/asset_investment_list');?>">Asset List</a></li>
                                        <li><a href="<?php echo base_url('admin/asset_investment_registration');?>">New Asset</a>
                                        </li>
                                    </ul>
                                </li>
                                	
                                 		  <li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/internal_cost_list');?>">Cost List</a></li>
                                            <li><a href="<?php echo base_url('admin/internal_cost_registration');?>">New Cost</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                    <?php if(in_array('reports',$userAccess)){?>
                                		  <li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <li><a href="<?php echo base_url('admin/daily_sale_reports');?>">Daily Sales Report</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_sale_reports');?>">Date Wise Sales Report</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/today_reports');?>">Daily Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_reports');?>">Date Wise Balance Sheet</a></li>
                                          
                                          <li><a href="<?php echo base_url('admin/purchasereport');?>">Purchase Invoice Reports</a></li>
                                          <li> <a href="<?php echo base_url('admin/stockin_reports');?>">Current Stock Report</a></li><!--
                                         <li> <a href="<?php echo base_url()?>storestock_report/sales_invoice">Salesman Invoice History</a></li>
                                        <li> <a href="<?php echo base_url()?>userstock_report/showroom">Showroom Invoice History</a></li>
                                        <li> <a href="<?php echo base_url('admin/stockout_reports');?>">Stockout History</a></li>-->
                                        </ul>
                                    </li>
                                     <?php } ?>
                                </ul>
                              </div>
                                
                                <div class="menu_section">
                                <h3 style="font-size:16px"> Pre Stock Manager</h3>
                                <ul class="nav side-menu">
                                 <?php if(in_array('pre_product',$userAccess)){?>                                
                                  	 <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_product_list');?>">Product List</a></li>
                                        </ul>
                                    </li>
                                    <?php } ?>
                                <?php if(in_array('pre_order',$userAccess)){?>
                                    <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_order_list');?>">Order List</a></li>
                                        </ul>
                                    </li>
                                <?php } ?>
                                <?php if(in_array('pre_purchase',$userAccess)){?>
                                    <li><a><i class="fa fa-list-alt"></i>Purchase<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_purchase');?>">Purches</a></li> 
                                        </ul>
                                    </li>
                               <?php } ?>
                                <?php if(in_array('pre_stock',$userAccess)){?>     
                                    <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/pre_purchasestock');?>">Stock Management</a></li>
                                        <li> <a href="<?php echo base_url('admin/pre_purchasestock');?>">Stock Out</a></li>
                                        
                                    </ul>
                                </li>
                               <?php } ?>
                                <?php if(in_array('pre_accounts',$userAccess)){?> 
                                    <li><a><i class="fa fa-bars"></i> Asset & Investment<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/pre_asset_investment_list');?>">Asset List</a></li>
                                        <li><a href="<?php echo base_url('admin/pre_asset_investment_registration');?>">New Asset</a>
                                        </li>
                                    </ul>
                                </li>
                                
                                   <li><a><i class="fa fa-bars"></i> Internal Cost<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/pre_internal_cost_list');?>">Cost List</a></li>
                                            <li><a href="<?php echo base_url('admin/pre_internal_cost_registration');?>">New Cost</a>
                                            </li>
                                        </ul>
                                    </li>
                              <?php } ?>
                              <?php if(in_array('pre_reports',$userAccess)){?>      
                                   <li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <li><a href="<?php echo base_url('admin/pre_daily_sale_reports');?>">Daily Sales Report</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_datewise_sale_reports');?>">Date Wise Sales Report</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_today_reports');?>">Daily Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_datewise_reports');?>">Date Wise Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/pre_purchasereport');?>">Purchase Invoice Reports</a></li>
                                          <li> <a href="<?php echo base_url('admin/pre_stockin_reports');?>">Current Stock Report</a></li>
                                        </ul>
                                    </li>
                              <?php } ?>      
                                </ul>
                              </div>
                                
                                <div class="menu_section">
                                <h3 style="font-size:16px">Website</h3>
                                <ul class="nav side-menu">       
                                  <?php if(in_array('menu',$userAccess)){?>
                                    <li><a><i class="fa fa-bars"></i>Menu Manage<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/menu_list');?>">Menu List</a></li>
                                                <li><a href="<?php echo base_url('admin/menu_registration');?>">Menu Registration</a></li>
                                            </ul>
                                        </li>
                                     <?php } ?>
                                     <?php if(in_array('content',$userAccess)){?>
                                    <li><a><i class="fa fa-font"></i>Article Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/article_list');?>">Article List</a></li>
                                            <li><a href="<?php echo base_url('admin/article_registration');?>">Article Registration</a></li>
                                        </ul>
                                    </li>
                                  <?php } ?>
                                  <?php if(in_array('banner',$userAccess)){?>
                                    <li><a><i class="fa fa-picture-o"></i>Banner Banage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/banner_list');?>">Banner List</a></li>
                                            <li><a href="<?php echo base_url('admin/banner_registration');?>">Banner Registration</a></li>
                                        </ul>
                                    </li>
                                   <?php } ?>
                                   </ul>
                                  </div>  
                                          
                        
                         <?php } ?>
                         
                         
                         <?php if($this->session->userdata('AdminType')=='Customer Care'){?>
                                <div class="menu_section">
                                <h3 style="font-size:16px; margin-left:5px; padding:0;">Customer Care</h3>
                                <ul class="nav side-menu">
                                    
                                   <li><a><i class="fa fa-comment"></i>Email & Messages<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Email</a></li>
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Messages</a></li>
                                        </ul>
                                    </li>
                                   <li><a><i class="fa fa-users"></i>Customer<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customer_list');?>">Customer List</a></li>
                                        </ul>
                                    </li>                           
                                   
                                    
                                </ul>
                              </div>
                         <?php } ?>
						<?php if($this->session->userdata('AdminType')=='Brand Promoter'){?>
                       			<div class="menu_section">
                        <h3 style="font-size:16px; margin-left:5px; padding:0;">Brand Promoter</h3>
                        <ul class="nav side-menu">
                            
                          <li><a><i class="fa fa-comment"></i>Email & Messages<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Email</a></li>
                                            <li><a href="<?php echo base_url('admin/customerQuery_list');?>">Messages</a></li>
                                        </ul>
                                    </li>
                          <li><a><i class="fa fa-users"></i>Customer<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customer_list');?>">Customer List</a></li>
                                        </ul>
                                    </li>                                 
                           
                            
                        </ul>
                      </div>
                        <?php } ?>
                    </div>
                    
                    
                    
                    
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?php echo base_url();?>asset/images/img.jpg" alt=""><?php echo $this->session->userdata('AdminAccessName');?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="javascript:;">  Profile</a></li>
                                    <li><a href="<?php echo base_url('admin/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>

                            

                        </ul>
                    </nav>
                </div>

            </div>