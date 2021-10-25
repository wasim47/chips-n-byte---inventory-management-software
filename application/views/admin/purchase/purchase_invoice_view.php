<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
        <div class="title_left">
        <h3>Purchase Invoice</h3>
        </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
        
        <div class="col-md-12 col-sm-12 col-xs-12">
        
        
        
        <div class="container">
        <div class="col-sm-3">
        	<?php $this->load->view('includes/leftcat');?>
        </div>
        <div class="col-sm-9"  style="background:#ccc; box-shadow:#999 0 0 1px 1px">
        	<form name="form" id="form" action="" method="post" onsubmit="return checkInvoice()">
        <table width="100%" height="607" border="0" cellpadding="0" cellspacing="0" class="d_bg">
        <tr>
        
        <td width="100%" align="center" valign="middle">
        <div id="page">
        <table width="98%" border="0" cellspacing="2" cellpadding="1">
        <tr>
        <td width="17%" height="21">&nbsp;</td>
        <td width="1%">&nbsp;</td>
        <td colspan="2"><input name="businessHub" type="hidden" id="businessHub" value="<?php echo $this->session->userdata('bh_admin_hub');?>" /></td>
        <td width="13%">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
        <td height="34" class="date">Invoice No </td>
        <td class="date">:</td>
        <td width="24%" class="date"><input name="invoice" type="text" id="invoice" class="form-control" value="<?php echo $inv_no;?>" readonly=""></td>
        <td width="5%" class="date">&nbsp;</td>
        <td class="date"> Date </td>
        <td width="2%" class="date">:</td>
        <td width="38%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="87%"><span class="date">
        <?php 
        $date=date('m/d/Y H:i:s', strtotime('+9 hour'));
        $convert_date=explode(" ",$date);
        
        //Example : 02/03/2015
        ?>
        <input name="date" type="text" id="date" class="datepicker input_ form-control" value="<?php echo $convert_date[0];?>" readonly="" />
        </span></td>
        <td width="13%">&nbsp;</td>
        </tr>
        
        </table></td>
        </tr>
        <tr>
        <td height="48" class="date">Manual Invoice </td>
        <td class="date">:</td>
        <td><span class="date">
        <input name="minvoice" type="text" id="minvoice" onKeyPress="return checkInt(event, '');hoverChange(this.id)" onblur="checkManual()" class="form-control" tabindex="1">
        </span></td>
        <td>&nbsp;</td>
        <td height="48" class="date">Supplier</td>
        <td class="date">:</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="87%"><span class="date">
        <div id="stockWiseSupp">
            <select name="supplier" id="supplier" class="form-control" required onchange="hoverChange(this.id);">
	            <option value="">Select Supplier</option>
				<?php
                foreach($supplierlist->result() as $row){
                ?>
                <option value="<?php echo $row->user_id; ?>"><?php echo $row->username; ?></option>
                <?php
                }
                ?>
            </select>
            
            
        </div>
        </span></td>
        <td width="13%">&nbsp;</td>
        </tr>
        </table></td>
        </tr>
        <tr>
          <td height="21" class="date">Stock </td>
          <td class="date">:</td>
          <td><span class="date">
             <select name="stockid" id="stockid" class="form-control" required>
			<option value="">Select Stock</option>
			<?php
            foreach($stocklist->result() as $row){
            ?>
            <option value="<?php echo $row->id; ?>"><?php echo $row->stock_name; ?></option>
            <?php
            }
            ?>
        </select>
          </span></td>
        <td align="center" class="date1">&nbsp;</td>
        <td align="left" valign="middle" class="date">&nbsp;</td>
        <td valign="top" class="date">&nbsp;</td>
        <td valign="top">&nbsp;</td>
        </tr>
        <tr>
        <td height="21" colspan="3">
        
        <div id="msg" style="display:none; color:#FF0000;">There is not enough quantity.</div>                      <div id="error" style="display:none; color:#FF0000;">Character not allow</div>
        <div id="err" style="color:#FF0000;"></div>        </td>
        <td align="center" class="date1">&nbsp;</td>
        <td align="left" valign="middle" class="date">&nbsp;</td>
        <td valign="top" class="date">&nbsp;</td>
        <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="87%" valign="middle">&nbsp;</td>
        <td width="13%">&nbsp;</td>
        </tr>
        </table></td>
        </tr>
        <tr>
        <td height="10" colspan="7"></td>
        </tr>
        <tr>
        <td height="21" colspan="7"><table width="100%" border="0" cellspacing="0" cellpadding="1">
        <tr>
        <td width="19%" height="29" align="center" bgcolor="#EBEBEB" class="date">Product Name </td>
        <td width="16%" align="center" bgcolor="#EBEBEB" class="date">Product Code </td>
        <td width="15%" align="center" bgcolor="#EBEBEB" class="date">Unit</td>
        <td width="15%" align="center" bgcolor="#EBEBEB" class="date">Qty</td>
        <td width="18%" align="center" bgcolor="#EBEBEB" class="date">Price</td>
        <td width="17%" align="center" bgcolor="#EBEBEB" class="date">Net Amount </td>
        </tr>
        <tr>
        <td height="5" colspan="5"></td>
        </tr>
        <tr>
        <td height="30" align="left"><span class="date">
        <?php /*?><div id="suppierWiseProduct">
        <select name="pro_name" id="pro_name" class="form-control" required onchange="selectedItem();hoverChange(this.id)" >
        	<option value="">Select Product</option>
				<?php
                foreach($product->result() as $row){
                ?>
                <option value="<?php echo $row->product_id.'~'.$row->product_name; ?>"><?php echo $row->product_name; ?></option>
                <?php
                }
                ?>
        </select>
        </div><?php */?>
        <input type="text" name="pro_name" id="pro_name" onkeyup="getPurProduct();" class="form-control" onchange="selectedItem();hoverChange(this.id)"/>
        <input type="hidden" id="products_id"/>
        <div id="prodlist"></div>
        </span></td>
        <td height="30" align="left"><span class="date">
          <input name="pro_code" type="text" id="pro_code" class="vertical input_ form-control" readonly=""/>
          <input id="prof_count" type="hidden" value="1" name="prof_count">
          <input id="pro_id" type="hidden" value="" name="pro_id" />
        </span></td>
        <td align="center"><select name="units" id="units" class="form-control" required="required" onchange="hoverChange(this.id)" >
          <option value="">Unit</option>
          <?php
                foreach($unitslist->result() as $row){
                ?>
          <option value="<?php echo $row->unit_id; ?>"><?php echo $row->unit_name; ?></option>
          <?php
                }
                ?>
        </select>
        </td>
        <td align="center">
          <input name="qty" type="text" class="vertical input_ form-control" id="qty" onKeyPress="return checkInt(event, '')" onkeyup="checkQtyP()" maxlength="8"></td>
        <td align="right"><span class="date">
          <input name="price" type="text" id="price" class="input_ form-control" onKeyPress="return checkInt(event, '')" onkeyup="checkQtyP()">
         
        </span></td>
        <td align="right">
        <input name="net" type="text" id="net" class="input_ form-control" readonly="" /></td>
        </tr>
        </table></td>
        </tr>
        <tr>
        <td height="5" colspan="7"></td>
        </tr>
        <tr>
        <td height="21" colspan="7" align="right">
        <div style="height:220px; overflow:scroll; overflow-x:hidden; margin-bottom:5px;">	
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr id="prof_1" style="padding-top:5px;"></tr>
        </table>
        </div>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border-top:1px solid #EEEEEE;">
        <tr>
        <td width="71%" height="32">&nbsp;</td>
        <td width="13%" align="right" class="date">Total Price : 
        <input type="hidden" name="main_net" id="main_net" />                          &nbsp;</td>
        <td width="16%"><input name="net_total" type="text" id="net_total" class="input_ form-control" readonly="" /></td>
        </tr>
        </table>        </td>
        </tr>
        </table>
        </div>
        </td>
        </tr>
        <tr>
        <td height="43" align="center" valign="middle"  style="border-top:1px solid #EEEEEE;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
        <td width="50%" align="right" id="msg1">
        
        <input type="button" name="Submit" value="Submit" class="btn btn-primary" style="background-color:#093" onclick="checkInvoice()" id="save2" />
        <input type="button" name="Submit" value="Disable" style="display:none;background-color:#093" class="btn btn-primary" id="save3" />
        
        </td>
        <td width="50%" align="center"><div id="rec_mess" style="font-family:Arial, Helvetica, sans-serif; color:#F00; font-size:14px;"></div></td>
        </tr>
        </table></td>
        </tr>
        </table>
        </form>
        </div>
        </div>
        </div>
        
        </div>
        </div>
    </div>
               
