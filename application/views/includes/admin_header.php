<?php include('admin_tophead.php');?>
<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0; height:auto">
                        <a href="#"><h2><img src="<?php echo base_url('uploads/images/company/'.$clogo);?>" style="width:100%; height:auto" title="<?php echo $cname;?>" alt="<?php echo $cname;?>" /></h2></a>
                    </div>
                    <div class="clearfix"></div>



                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu" style="margin-top:60px;">
                        	
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
                                      
                                      <li><a><i class="fa fa-desktop"></i>Configuration<span class="fa fa-chevron-down"></span></a>
                                            <ul class="nav child_menu" style="display: none">
                                                <li><a href="<?php echo base_url('admin/configuration');?>">General Setting</a></li>
                                            </ul>
                                        </li> 
                                        
                                        
                                      <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/stock_list');?>">Stock List</a></li>
                                            <li><a href="<?php echo base_url('admin/stock_registration');?>">New Stock</a></li>
                                        </ul>
                                    </li> 
                                    <li><a><i class="fa fa-picture-o"></i>Supplier Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/supplier_list');?>">Supplier List</a></li>
                                            <li><a href="<?php echo base_url('admin/supplier_registration');?>">New Supplier</a></li>
                                        </ul>
                                    </li>   
                                    
                                   <!-- <li><a><i class="fa fa-picture-o"></i>Salse Representative<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/sales_represntative_list');?>">User List</a></li>
                                            <li><a href="<?php echo base_url('admin/sales_represntative_registration');?>">New User</a></li>
                                            <li><a href="<?php echo base_url('admin/tada_statement');?>">TA/DA List</a></li>
                                            <li><a href="<?php echo base_url('admin/tada_statement_action');?>">New TA/DA</a></li>
                                        </ul>
                                    </li> -->
                                    
                                    <li><a><i class="fa fa-picture-o"></i>Customer Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/customer_list');?>">Customer List</a></li>
                                            <li><a href="<?php echo base_url('admin/customer_registration');?>">New Customer</a></li>
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
                                           <?php /*?> <li><a href="<?php echo base_url('admin/last_category_list');?>">Last Category List</a></li>
                                            <li><a href="<?php echo base_url('admin/last_category_registration');?>">New Last Category</a></li><?php */?>
                                        </ul>
                                    </li>  
                                     <li><a><i class="fa fa-picture-o"></i>Brand Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                             <li><a href="<?php echo base_url('admin/brand_list');?>">Brand List</a></li>
                                            <li><a href="<?php echo base_url('admin/brand_registration');?>">New Brand</a></li>
                                        </ul>
                                    </li>   
                                    <li><a><i class="fa fa-picture-o"></i>Product Manage<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                             <li><a href="<?php echo base_url('admin/product_list');?>">Product List</a></li>
                                            <li><a href="<?php echo base_url('admin/product_registration');?>">New Product</a></li>
                                        </ul>
                                    </li>      
                                                         
                                   
                                    
                                </ul>
                              </div>
                                <div class="menu_section">
                                <h3 style="font-size:16px; cursor:pointer" id="instock_menu"> Inventory Manager</h3>
                                <ul class="nav side-menu" id="instock_item">                                                                    
                                    <li><a><i class="fa fa-picture-o"></i>Order<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/order_list');?>">Order List</a></li>
                                            <li><a href="<?php echo base_url('admin/completed_order');?>">Completed Order</a></li>
                                        </ul>
                                    </li>
                                    
                                    
                                    <li><a><i class="fa fa-picture-o"></i>Sale<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/saleentry');?>">Sale Entry</a></li>
                                        
                                    </ul>
                                </li>
                                
                                  <li><a><i class="fa fa-picture-o"></i>Stock Manage<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/stockProduct');?>">Stock Product</a></li>
                                        <li><a href="<?php echo base_url('admin/stockTransfer');?>">Stock Trasfer</a></li>
                                    </ul>
                                </li>
                                  
                                 	  <li><a><i class="fa fa-list-alt"></i>Purchase<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                            <li><a href="<?php echo base_url('admin/purchase');?>">Purches</a></li> 
                                        </ul>
                                    </li>
                                 	  <li><a><i class="fa fa-bars"></i> Expense Asset<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                        <li><a href="<?php echo base_url('admin/expense_list');?>">Asset List</a></li>
                                        <li><a href="<?php echo base_url('admin/expense_registration');?>">New Asset</a>
                                        </li>
                                    </ul>
                                </li>
                                 <li><a><i class="fa fa-bars"></i> Bank<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('admin/bank_list');?>">Bank List</a></li>
                                        <li><a href="<?php echo base_url('admin/bank_registration');?>">New Bank</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-bars"></i> Voucher<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('admin/credit_voucher');?>">Credit Voucher</a></li>
                                        <li><a href="<?php echo base_url('admin/debit_voucher');?>">Debit Voucher</a></li>
                                    </ul>
                                    
                                </li>
                             <li><a><i class="fa fa-bars"></i> Bank Deposit<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">
                                	    <li><a href="<?php echo base_url('admin/bank_deposit_list');?>">Cost List</a></li>
                                        <li><a href="<?php echo base_url('admin/bank_deposit_registration');?>">New Cost</a>
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
                                 <!--<li><a href="<?php echo base_url('admin/cashbook');?>"><i class="fa fa-usd"></i> Cashbook</a></li>-->
                                 <li><a><i class="fa fa-bars"></i> Reports<span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu" style="display: none">
                                          <li><a href="<?php echo base_url('admin/daily_sale_reports');?>">Daily Order Report</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_sale_reports');?>">Date Wise Order Report</a></li>
                                          
                                          <!--<li><a href="<?php echo base_url('admin/today_reports');?>">Daily Balance Sheet</a></li>
                                          <li><a href="<?php echo base_url('admin/datewise_reports');?>">Date Wise Balance Sheet</a></li>-->                                                                                   
                                         <!-- <li> <a href="<?php echo base_url('admin/party_ladger');?>">Party Ladger</a></li>
                                          <li> <a href="<?php echo base_url('admin/sr_reports');?>">Salse Representative</a></li>
                                          <li> <a href="<?php echo base_url('admin/sale_reports');?>">Sale Reports</a></li>-->
                                          <li> <a href="<?php echo base_url('admin/purchase_reports');?>">Purchase Reports</a></li>
                                           <li> <a href="<?php echo base_url('admin/sale_products_reports');?>">Sale Reports</a></li>
                                          <li> <a href="<?php echo base_url('admin/stock');?>">Stock Report</a></li>
                                          <!--<li> <a href="<?php echo base_url('admin/stockin_reports');?>">Current Stock Report</a></li>-->
                                        </ul>
                                    </li>
                                    
                                </ul>
                              </div>
                        
                       
                     
                    </div>
                    
                    
                    
                    
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">&nbsp;
                            <!--<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>-->
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">&nbsp;
                            <!--<span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>-->
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">&nbsp;
                            <!--<span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>-->
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
                        <div class="nav toggle col-sm-2">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
						<h1 class="col-sm-7" style="font-size:25px; text-align:right; text-shadow:#ccc 1px 1px; text-align:center; "><?php echo $cname;?></h1>
                        <div class="col-sm-4 pull-right">
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
                        </div>
                    </nav>
                </div>

            </div>