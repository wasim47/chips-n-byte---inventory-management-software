<div class="breadcrumb">
        <ul>
			<?php 
            $query_cat=$this->db->query("select * from category where status=1 order by sequence asc");
            foreach($query_cat->result() as $row_cat){
                $cat_id=$row_cat->caegory_title;
                $cat_name=$row_cat->cat_name;
            ?>
            <li><a href="<?php echo base_url('products/gallery/'.$cat_id);?>"><?php echo $cat_name;?> | </a></li>
            <?php
            }
            ?>
      </ul>        
  </div>