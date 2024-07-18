<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<style>
   @media (min-width:961px)  {
   .noproduct {
   }
   }

   #selectedchoice{
    width:fit-content;
    height:fit-content;

    margin-left:30px;

   }
   #selectedoption{
    width:fit-content;
    height:fit-content;

    margin-left:30px;

   }
   #selectedfilter{
    width:fit-content;
    height:fit-content;

    margin-left:30px;

   }
   #output{
    width:fit-content;
    height:fit-content;
   }
   #amount{
    width:fit-content;
    height:fit-content;
   }
   .close-button-brand{
    cursor: pointer;

    margin-left: 5px;
    color: white;
    border-radius: 70%;
    width: 16px!important;
    /* height: 16px; */

    background-color: #2556B9;
    text-align: center;
    align-items: center;
    justify-content: center;
    font-weight: bold;

    font-size: 12px;
    
        }
        .close-button-option{
            cursor: pointer;
    margin-left: 5px;
    color: white;
    border-radius: 70%;
    width: 16px!important;
    /* height: 16px; */
    background-color: #2556B9;
    text-align: center;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    font-size: 12px;
        }
        .close-button-filter{
            cursor: pointer;
    margin-left: 5px;
    color: white;
    border-radius: 70%;
    width: 16px!important;
    /* height: 16px; */

    background-color: #2556B9;
    text-align: center;
    align-items: center;
    justify-content: center;
    font-weight: bold;

    font-size: 12px;

        }
        .selected-brand{
            border-radius: 9999px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    border: 1px solid #2556B9;

    padding: 5px;

    /* margin-right: 8px; */
    margin-bottom: 8px;
    background: white;
    color: #2556B9;
    width: fit-content;
    /* height: fit-content; */
    text-align: center;
    justify-content: center;

    /* height: 30px; */
    font-size: 12px;

        }
        .selected-option{
            border-radius: 9999px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    border: 1px solid #2556B9;

    padding: 5px;

    /* margin-right: 8px; */
    margin-bottom: 8px;
    background: white;
    color: #2556B9;
    width: fit-content;
    /* height: fit-content; */
    text-align: center;
    justify-content: center;

    /* height: 30px; */
    font-size: 12px;

        }
        .selected-filter{
            border-radius: 9999px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    border: 1px solid #2556B9;

    padding: 5px;
    /* margin-right: 8px; */

    margin-bottom: 8px;
    background: white;
    color: #2556B9;
    width: fit-content;

    /* height: fit-content; */
    text-align: center;
    justify-content: center;
    /* height: 30px; */
    font-size: 12px;
        }
   .filtering{
   width: 100px;
   height: 40px;
   margin-left:10px;
   background: var(--unnamed-color-2556b9) 0% 0% no-repeat padding-box;
   background: #2556B9 0% 0% no-repeat padding-box;
   border-radius: 25px;
   opacity: 1;
   color:white;
   float:left;
   margin-bottom:10px;
   border-color:white;
   border-style: solid;
   }
   .checkbox-container {
   /* display: flex;
   flex-direction: row;
   gap: 10px;
   align-items: center; */
   }
   .checkbox-container1 {
   /* display: flex;
   flex-direction: row;
   gap: 10px;
   align-items: center; */
   }
   .checkbox-container1 {
   display: flex;
   flex-direction: row;
   gap: 10px;
   align-items: center;
   }
   .content {
   order: 1;

   /* margin-bottom:5px; */
   order: 1;
    /* margin-bottom: 2px; */
    /* margin-left: 10px; */
    /* text-align: center; */
    /* align-items: center; */


   }
   .checkbox {
   order: 0;
   }
   .abs-btn{
   height: 30px;
   line-height: 30px;
   padding: 0 20px;
   text-transform: capitalize;
   color: #ffffff;
   background: var(--thm-blue);
   border: 0;
   border-radius: 30px;
   float: left;
   -webkit-transition: 0.3s;
   transition: 0.3s;
   }
   .filterbox{

   /* padding:10px; */
   width: 195;
    margin: 0 auto;
 
    justify-content: center;
    align-items: center;
    border-top: 1px solid #2547A81A;
    opacity: 1;

   }
</style>
<?php
   $basename_get = basename($this->input->server('REQUEST_URI'));
   //$find = ['/?','?'];
//    print_r($basename_get);
   if (strpos($basename_get, '?')) {
       $basename = substr($basename_get, 0, strpos($basename_get, '?'));
   } else {
       $basename = $basename_get;
   }
   
   $request_uri = substr($this->input->server('REQUEST_URI'), 1);
   
   $request_uri_explode = explode('/', $request_uri);
   if($request_uri_explode[0] == 'products') {
       $request_uri = 'web';
   }
   if($request_uri_explode[0] == 'sub-cat-products') {
       $request_uri = 'web';
   }
   

   
   ?>
   <?php 
$categorySums = [];
$subcategorySums = [];


foreach ($products as $product) {
    
    $cat_qry=$this->db->query("select category_name from categories where id='".$product->cat_id."'");
    $cat_qry_res=$cat_qry->row();
    $sub_qry=$this->db->query("select sub_category_name from sub_categories where id='".$product->sub_cat_id."'");
    $sub_qry_res=$sub_qry->row();
 


    $cat_name = $cat_qry_res->category_name;
    $sub_name = $sub_qry_res->sub_category_name;
    $orders_placed = $product->orders_placed;
    $categorySums[$cat_name] = isset($categorySums[$cat_name]) ? $categorySums[$cat_name] + $orders_placed : $orders_placed;
    $subcategorySums[$sub_name] = isset($subcategorySums[$sub_name]) ? $subcategorySums[$sub_name] + $orders_placed : $orders_placed;
}

arsort($categorySums);
arsort($subcategorySums);

$top3Categories = array_slice($categorySums, 0, 3, true);
$top3Subcategories = array_slice($subcategorySums, 0, 3, true);


?>

<div class="breadcrumbs_area mb-3 mt-72">
   <div class="container">
      <div class="row">
         <div class="col-12">
            <div class="breadcrumb_content">
                <?php 
                $sub_cat_na=$this->db->query("select sub_category_name from sub_categories where id='".$sub_cat_id."'");
                $sub_re=$sub_cat_na->row();
                ?>
            <ul>
                            <li><a href="<?php echo base_url(); ?>">Home</a></li>
                           <?php if ($category != null) {?>
                     <li>
                        <a href="<?=base_url()?>web/view_subcategories/<?=$category->seo_url?>"><?php echo $category->category_name; ?> </a>
                            </li><?php }?><li class="mylink"><?php
                  if ($category != null && $sub_cat_id != null) {
                      echo  $sub_re->sub_category_name;
                  } else if ($searchdata!=null) {
                      echo  $searchdata;
                  } else if ($sub_cat_id && $sub_cat_id != null) {
                      echo $sub_re->sub_category_name;
                  } else {
                    preg_match('/^([^\d]+)\d+/', $basename_get, $matches);

                    if (isset($matches[1])) {
                        $name_base = trim($matches[1]);
                        $name = rtrim($name_base, '-');

                        echo $name;
                    // echo $base_name; // Output: face-moisturizer
                    }
                   

                  }
                  ?></li></ul>
            </div>
         </div>
      </div>
   </div>
</div>
<style type="text/css">
   .inner_slider{
   width: 100%;
   height: 300px;
   object-fit: contain;
   }
  

   .scrollable::-webkit-scrollbar {
   width: 5px; 
   position: absolute;
   left: 0;
   }
   .scrollable::-webkit-scrollbar-thumb {
   background-color: #CDCDCD; 
   }
   .arrow-down::before {
   content: "\f078";
   font-family: "Font Awesome 5 Free";
   font-weight: 900;
   display: inline-block;
   margin-right: 10px;
   float:right;
   cursor:pointer
   }
   .arrow-up::before {
   content: "\f077";
   font-family: "Font Awesome 5 Free";
   font-weight: 900;
   display: inline-block;
   margin-right: 10px;
   float:right;
   cursor: pointer;
   }
.cancel-btn{
   width: 100px;
   height: 40px;
   margin-left:25px;
   background: #ffffff 0% 0% no-repeat padding-box;
   background: white 0% 0% no-repeat padding-box;
   border-radius: 25px;
   opacity: 1;
   color:#2556B9;
   border-color: #2556B91A;
   margin-bottom:10px;
   }
</style>
<div class="categories_product_area mb-30">
   <div class="container">
      <div class="row">
         <?php if ($products) { ?>
          
         <div class="col-lg-3 one">
           
            
            <aside class="sidebar_widget d-lg-block d-none">
               <div class="widget_inner">
              
                  <div class="widget_list widget_filter">
                     <?php
                        if ($basename == 'products-filter-by-questionaries') {
                            // unset($_GET['amount_range']);
                            // unset($_GET['brand_id']);
                            // unset($_GET['filter']);
                            // unset($_GET['option']);
                            ?>
                     <form method="get" action="<?= base_url() ?>products-filter-by-questionaries">
                        <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                        <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                        <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                        <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                        <input type="hidden" name="message" value="<?php echo $message; ?>" />
                        <div class="fixed-text">
                        <span class="filters">Filters</span>
                        
                        <?php if (
    (isset($_GET['brand_id']) && !empty($_GET['brand_id'])) ||
    ((isset($_GET['filter']) && !empty($_GET['filter'])) &&
    (isset($_GET['option']) && !empty($_GET['option'])) )||
    ((isset($_GET['amount_range']) && !empty($_GET['amount_range']))&&
    (isset($_GET['price-range']) && !empty($_GET['price-range'])))
) {?>
                        <button type="submit" id="clearAllButton">Clear All</button>
                        <?php }?>
                        </div>
                        <!--                                    <a href="<?= base_url() ?>products-filter-by-questionaries"><button style="margin-left: 10px;" type="button">Back</button></a>-->
                     </form>
                     <?php
                        } else if ($basename == 'search') {
                            // unset($_GET['amount_range']);
                            // unset($_GET['brand_id']);
                            // unset($_GET['filter']);
                            // unset($_GET['option']);

                            ?>
                     <form method="get" action="<?= base_url('search') ?>">
                        <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                        <span class="filters">Filters</span>
                      
                        <?php if (
    (isset($_GET['cat_id']) && !empty($_GET['cat_id'])) ||
    (isset($_GET['sub_cat_id']) && !empty($_GET['sub_cat_id'])) ||
    (isset($_GET['question_id']) && !empty($_GET['question_id'])) ||
    (isset($_GET['ques_option_str']) && !empty($_GET['ques_option_str'])) ||
    (isset($_GET['message']) && !empty($_GET['message']))  ||
    (isset($_GET['brand_id']) && !empty($_GET['brand_id'])) ||
    ((isset($_GET['filter']) && !empty($_GET['filter'])) &&
    (isset($_GET['option']) && !empty($_GET['option'])) )||
    (isset($_GET['price-range']) && !empty($_GET['price-range']))
) {?>
                        <button type="submit" id="clearAllButton">Clear All</button>
                        <?php }?>
                        <!--                                    <a href="<?= base_url() ?>"><button style="margin-left: 10px;" type="button">Back</button></a>-->
                     </form>
                     <?php } else {
                    // print_r($_POST);    ?>
                     <form>
                        <span class="filters">Filters</span>
                        
                   <?php   if (
    (isset($_GET['message']) && !empty($_GET['message']))  ||
    (isset($_GET['brand_id']) && !empty($_GET['brand_id'])) ||
    ((isset($_GET['filter']) && !empty($_GET['filter'])) &&
    (isset($_GET['option']) && !empty($_GET['option'])) )||
    ((isset($_GET['amount_range']) && !empty($_GET['amount_range']))&&
    (isset($_GET['price-range']) && !empty($_GET['price-range'])))
) {?>
                        <a href="<?= $request_uri ?>"><button id="clearAllButton">Clear All</button></a>
                        <!--                                    <a href="<?= base_url() ?>"><button style="margin-left: 10px;" type="button">Back</button></a>-->
                    <?php }?> 
                    </form>
                     <?php } ?>
                  </div>
                
                  <?php if ($products) { ?>

                           <form method="get" action="<?php
                              if ($basename == 'products-filter-by-questionaries') {
                                 echo base_url().'products-filter-by-questionaries';
                             } else if ($basename == 'search') {
                                 echo base_url().'search';
                             } else {
                                echo $sub_category->seo_url;
                            //   echo base_url().'sub-cat-products/' . $sub_category->seo_url . '/' . $option_details->seo_url;
                                 // echo base_url().$request_uri_explode[1]."/".$request_uri_explode[2];
                                //  echo base_url()."sub-cat-products/".$sub_category->seo_url;
                             }
                             ?>">
                             
                             <div id="selectedchoice" name="selectedchoice" style="display: none;"></div>
                             <div id="selectedoption" name="selectedoption" style="display: none;"></div>
                             <div id="selectedfilter" name="selectedfilter" style="display: none;"></div>
                             <div  id="output" style="visibity:hidden;display:none;"></div>
                              <input type="text" name="amount_range" id="amount" readonly style="visibity:hidden;display:none;"/>
                            <div class="scrollable">
                            <div class="filterbox">
                  <div class="widget_list widget_brand">
                  <h3 class="arrow-down">Price</h3>
                  <ul>
             



 
                  <?php

$priceRanges = array(
    array('id' => 'range1', 'min' => 1, 'max' => 500),
    array('id' => 'range2', 'min' => 501, 'max' => 1000),
    array('id' => 'range3', 'min' => 1001, 'max' => 1500),
    array('id' => 'range4', 'min' => 1501, 'max' => 2000),
    array('id' => 'range5', 'min' => 2001, 'max' => 5000)
);



foreach ($priceRanges as $range) {
    $isChecked = isset($_GET['price-range']) && in_array($range['id'], $_GET['price-range']);
    ${"priceRangeChecked" . $range['id']} = $isChecked;
}


?>


<div class="checkbox-container">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[0]['min'] ?>" data-max="<?= $priceRanges[0]['max'] ?>" class="price-range" id="<?= $priceRanges[0]['id'] ?>" name="price-range[]"  value="Rs.<?= $priceRanges[0]['min'] ?>-Rs.<?= $priceRanges[0]['max'] ?>"/>
        <!-- <?= $priceRangeChecked1 ? 'checked' : '' ?> -->
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[0]['min'] ?>-Rs.<?= $priceRanges[0]['max'] ?><span id="product-count-<?= $priceRanges[0]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[1]['min'] ?>" data-max="<?= $priceRanges[1]['max'] ?>" class="price-range" id="<?= $priceRanges[1]['id'] ?>" name="price-range[]" value="Rs.<?= $priceRanges[1]['min'] ?>-Rs.<?= $priceRanges[1]['max'] ?>" />
        <!-- <?= $priceRangeChecked2 ? 'checked' : '' ?> -->
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[1]['min'] ?>-Rs.<?= $priceRanges[1]['max'] ?><span id="product-count-<?= $priceRanges[1]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[2]['min'] ?>" data-max="<?= $priceRanges[2]['max'] ?>" class="price-range" id="<?= $priceRanges[2]['id'] ?>" name="price-range[]" value="Rs.<?= $priceRanges[2]['min'] ?>-Rs.<?= $priceRanges[2]['max'] ?>"/>
        <!-- <?= $priceRangeChecked3 ? 'checked' : '' ?>  -->
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[2]['min'] ?>-Rs.<?= $priceRanges[2]['max'] ?><span id="product-count-<?= $priceRanges[2]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[3]['min'] ?>" data-max="<?= $priceRanges[3]['max'] ?>" class="price-range" id="<?= $priceRanges[3]['id'] ?>" name="price-range[]" value="Rs.<?= $priceRanges[3]['min'] ?>-Rs.<?= $priceRanges[3]['max'] ?>"/>
        <!-- <?= $priceRangeChecked4 ? 'checked' : '' ?>  -->
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[3]['min'] ?>-Rs.<?= $priceRanges[3]['max'] ?><span id="product-count-<?= $priceRanges[3]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[4]['min'] ?>" data-max="<?= $priceRanges[4]['max'] ?>" class="price-range" id="<?= $priceRanges[4]['id'] ?>" name="price-range[]"  value="Rs.<?= $priceRanges[4]['min'] ?>-Rs.<?= $priceRanges[4]['max'] ?>"/>
       
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[4]['min'] ?>-Rs.<?= $priceRanges[4]['max'] ?><span id="product-count-<?= $priceRanges[4]['id'] ?>"></span>
        </label>
    </label>
</div>
    
                             <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                             <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                             <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                             <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                             <input type="hidden" name="message" value="<?php echo $message; ?>" />
                             <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                            

                             </div></div>

                           
                 
                  <div class="filterbox">
                  <div class="widget_list widget_brand">
                  <h3 class="arrow-down">Brand</h3>
                  <ul>
                  
                  <?php
                     $vals = array_count_values($brands);
                   
                     $brand = array_unique($brands);

                  
                     $brand_selected = explode(',', $brand_checked);
                 
                     foreach ($brand as $brand_id) {
                         $qry = $this->db->query("select * from attr_brands where id='" . $brand_id . "'");
                         $brand_detail = $qry->row();
                        
                         $brand_count = $vals[$brand_detail->id];
                        //  print_r($brand_id);
                         ?>
                  <li>
                  <label class="cust">
                <?php 
                ?>

                  <input type="checkbox" id="brand_<?=$brand_detail->id;?>" class="questions_brand" name="brand_id[]" value="<?= $brand_detail->id ?>" <?= in_array($brand_detail->id, $brand_selected) ? 'checked' : '' ?>/> <?= $brand_detail->brand_name ?> <span>(<?= $brand_count ?>)</span>
                  
                  <span class="checkmark1"></span> </li>
                  <?php } ?>
                  </ul>
                  </div>
                  </div>
                  <div class="filterbox">
                  <?php
                     $filter_explode = explode(',', $filter);
                     $option_explode = explode(',', $option);
                     ?>
                  <?php
                     foreach ($unique_filter_ids as $id) {
                         $filter_title = ($this->common_model->get_data_row(['id' => $id], 'filters'))->title;
                         $options_arr = [];
                         ?>
                  <div class="widget_list widget_brand">

                  <input type="checkbox" style="visibility:hidden;" id="<?= $id ?>" id="filter_<?= $id ?>"name="filter[]" class="questions_filter" value="<?= $id ?>" <?php

                     if ($filter_explode) {
                         if (in_array($id, $filter_explode)) {
                             echo 'checked';
                         }
                     }
                     ?> />
                  <h3 class="arrow-down"><?= $filter_title ?></h3>

                  <ul>

                  <?php
                  
                     foreach ($filters as $option) {
                         if ($id == $option['filter_id']) {
                             array_push($options_arr, $option['option']);
                         }
                     }
                     $options = array_unique(explode(',', (implode(',', $options_arr))));
                     foreach ($options as $option_id) {
                         $option = $this->common_model->get_data_row(['id' => $option_id], 'filter_options');
                         $option_name = $option->options;
                         ?>
                  <li>
                  <label class="cust">
                  <input type="checkbox" class="questions_option  option_<?= $id ?>" name="option[]" value="<?= $option_id ?>" id="option_<?= $option_id ?>"onchange="chk_filter('<?= $id ?>')" <?php
                     if ($option_explode) {
                         if (in_array($option_id, $option_explode)) {
                             echo 'checked';
                         }
                     }
                     ?> />
                  <span class="checkmark1"></span>
                  
                  <span><?= $option_name ?></span></label>
                  </li>
                  <?php } ?>
                  </ul>
                  </div>
                  <?php } ?>
                  </div></div>
                  </form>
                  <?php } ?>
               </div>
                  
            </aside>
           
         </div>
         <?php } ?>
         <div class="fil col-lg-9">
            <div class="row myfilter">
               <?php
                  if ($products) {
                      foreach ($products as $product) {
                        if($product->variant->stock>0){
                          $qry = $this->db->query("select * from attr_brands where id='" . $product->brand . "'");
                          $brand_detail = $qry->row();
                          ?>
               <div class="filter_cards  col-lg-3 col-md-3 col-sm-3 col-xl-3 col-xxl-3 " style="flex: 0;">
                  <article class="single_product" style="margin-bottom:20px;">
                     <figure>
                        <div class="product_thumb">
                           <a class="primary_img myimg" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>" target="_blank"><img data-src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt=""class="lozad" loading="lazy"></a>
                           <a class="secondary_img" href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>" target="_blank" style="visibility:hidden;"><img data-src="<?= base_url('uploads/products/') ?><?= $product->product_image ?>" alt="" style="visibility:hidden;" class="lozad" loading="lazy"></a>
                           <div class="label_product">
                           <?php 


$count_arr[] = $product->orders_placed;


if ($product->orders_placed > $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = $max1;
    $max1 = array('orders_placed' => $product->orders_placed);
} elseif ($product->orders_placed > $max2['orders_placed'] && $product->orders_placed < $max1['orders_placed']) {
    $max3 = $max2;
    $max2 = array('orders_placed' => $product->orders_placed);
} elseif ($product->orders_placed > $max3['orders_placed'] && $product->orders_placed < $max2['orders_placed']) {
    $max3 = array('orders_placed' => $product->orders_placed);
}

$cat_qry=$this->db->query("select category_name from categories where id='".$product->cat_id."'");
$cat_qry_res=$cat_qry->row();

$sub_qry=$this->db->query("select sub_category_name from sub_categories where id='".$product->sub_cat_id."'");
$sub_qry_res=$sub_qry->row();
$cat_name=$cat_qry_res->category_name;
$sub_name=$sub_qry_res->sub_category_name;

if (isset($top3Categories[$cat_name]) && isset($top3Subcategories[$sub_name]) &&
    ($product->orders_placed == $max1['orders_placed'] ||
     $product->orders_placed == $max2['orders_placed'] ||
     $product->orders_placed == $max3['orders_placed'])&& ($product->orders_placed!=null || $product->orders_placed!=''|| $product->orders_placed!=0)) {
?>
    <span class="label_sale">Best seller</span>
<?php } ?>


                             
                           </div>
                           <div class="wishlist">
                              <a title="<?= ($product->whishlist_status == true) ? 'Remove from Wishlist' : 'Add to Wishlist' ?>" onclick="addremoveFavorite('<?php echo $product->variant->id; ?>')"><span id="favoritecls_<?php echo $product->variant->id; ?>" class="<?php
                                 if ($product->whishlist_status == true) {
                                     echo 'fas';
                                 } else {
                                     echo 'fal';
                                 }
                                 ?> fa-heart"></span></a>
                           </div>
                           
                         <div class="add1">  <?php



   
       foreach($rating as $rat){
if($product->id==$rat['product_id']){
       
          
           


            ?>
            <div class="starrating2">
                <span class="rating-number"><?php echo round($rat['rating'],1); ?></span>
                <span class="star-symbol"><img data-src="<?php echo base_url(); ?>web_assets/img/star-icon.svg" class="lozad" loading="lazy"></span>
            </div>
            <?php

           
}    
}

?>


                           <div class="add_to_cart d-lg-block d-md-block d-sm-none d-none">
                              <?php if ($product->in_cart == 0) { ?>
                              <a class="not_in_cart_<?php echo $product->variant->id; ?>" onclick="addtocart('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>', '1')"> Add to cart</a>
                              <?php } else { ?>
                              <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                              <?php } ?>
                              <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                           </div></div>
                        </div>
                       <div class="add2"> <?php



   
foreach($rating as $rat){
if($product->id==$rat['product_id']){

   
    

   
     ?>
     <div class="starrating1 rating_add">
         <span class="rating-number1"><?php echo round($rat['rating'],1); ?></span>
         <span class="star-symbol1"><img data-src="<?php echo base_url(); ?>web_assets/img/star-icon.svg" class="lozad" loading="lazy"></span>
     </div>
     <?php

    
}    
}

?>


                    <div class="add_to_cart d-lg-none d-md-none d-sm-block d-xm-block d-xs-block d-none">
                       <?php if ($product->in_cart == 0) { ?>
                       <a class="not_in_cart_<?php echo $product->variant->id; ?>" onclick="addtocart('<?php echo $product->variant->id; ?>', '<?php echo $product->shop_id; ?>', '<?php echo $product->variant->saleprice; ?>', '1')"> Add to cart</a>
                       <?php } else { ?>
                       <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>"><i class="fal fa-cart-plus"></i> Go to cart</a>
                       <?php } ?>
                       <a class="in_cart_<?php echo $product->variant->id; ?>" href="<?= base_url('web/checkout') ?>" style="display:none;"><i class="fal fa-cart-plus"></i> Go to cart</a>
                    </div></div>
                        <figcaption class="product_content">
                           <div class="product_content_inner" style="display:flex;flex-direction:column;justify-content:space-between;">
                           <div class="product-info"> <div>
                                 <?php if ($brand_detail->brand_name) { ?>
                                 <p class="shop-name">Brand: <?php echo $brand_detail->brand_name; ?></p>
                                 <?php } ?>
                                 <h4 class="product_name"><a href="<?php echo base_url(); ?>single-product/<?php echo $product->seo_url; ?>" target="_blank"><?php echo $product->name; ?></a></h4>
                              </div>
                              <div class="price_box">
                                 <span class="current_price"><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->saleprice; ?></span>
                                 <?php if ($product->variant->saleprice != $product->variant->price) { ?>
                                 <del><i class="fal fa-rupee-sign"></i> <?php echo $product->variant->price; ?></del>
                                 <?php } ?>
                                 <?php if ($product->variant->saleprice != $product->variant->price) { 
                                    $discount = (($product->variant->price - $product->variant->saleprice)/$product->variant->price)*100;?>
                                 <span class="discount" style="color: #FF6200;">(<?php echo round($discount); ?>% OFF)</span>
                                 <?php } ?>
                              </div></div><?php 
                              ?>
                              <div class="quants">
                                 <?php if ($product->in_cart == 0) { ?>

                                    <div id="qty-<?= $product->variant->$variant_id;?>">


                                    <label for="quantity-select-<?php echo $product->variant->$variant_id; ?>" class="mr-2">Quantity:</label>
            <select id="quantity-select-<?php echo $product->variant->$variant_id; ?>" class="select-style quantity_<?php echo $product->variant->$variant_id; ?>" name="quantity" onchange="checkcart_limit(<?php echo $product->variant->$variant_id; ?>)">
            <?php  
            $stock=$product->variant->stock;
            $cartlimit=$product->cart_limit;
            if($stock<$cartlimit){
                        $limit=$stock;
                    }
                    else{
                        $limit = $cartlimit <= 10  || $cartlimit <= $stock? $cartlimit :10;
                    }?>
                <?php for ($i = 1; $i <= $limit; $i++) { ?>
                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
            </select>
                                    </div>
                                    <?php } ?>
                              </div>
                           </div>
                        </figcaption>
                     </figure>
                  </article>
               </div>
               <?php
                  }}
                  } else {
                  ?>
                 </div>
         </div>
      </div>
    
            
                            
               <div class="noproduct">
               <center>
                             <a>  <button class="abs-btn" id="abs_btn"  type="submit">Back</button></a>
                                
                               
                              
                            </center>
               </div>
               
               <div class="nopro">
                   <h3 style="font-size: 17px;
    text-align: center;
    justify-content: center;
    align-items: center;
    width: 100%;
    margin: 0 auto;">No products found!</h3>
    <img data-src="<?=base_url()?>web_assets/img/noproducts.jpg" class="lozad" loading="lazy"/>
    </div>
      <?php  }
    // } ?>
            
      <div class="filter-sidebar" style="display:none;">
               <button type="button" class="myfilterbutton" data-toggle="collapse" onclick="openNav()" style="border:none; background-color: #fff; color:#333; border-radius: 5px; padding:3px 10px;">
               <div class="filterbtn"><i class="fal fa-filter fa-lg"></i> <span>Filter</span></div>
               </button>
               <div id="mySidenav" class="sidenav visible-sm visible-xs">
                  <a href="javascript:void(0)" class="closebtn" onclick="closeNavbar()">&times;</a>
                  <?php $this->load->view("web/filter"); ?> 
               </div>
            </div>
   </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/lozad"></script>
<script>
                                       
                                            
                                            $(function () {
            $(".widget_list h3").click(function () {
                
                $(this).toggleClass("arrow-down arrow-up");
                $(this).next("ul").slideToggle();
            });
        });
                                      
 
     
        $(document).ready(function(e) {
            
            <?php if ($products) { ?>
                $('.filter-sidebar').show();
                $('.myfilterbutton').show();
                $('.filterbtn').show();
                $('#mySidenav').show();
          <?php  } else {?>
                $('.filter-sidebar').hide();
                $('.myfilterbutton').hide();
                $('.filterbtn').hide();
                $('#mySidenav').hide();
           <?php }?>
        });

        // $(function () {
        //                                         var min_price = '<?= $min ?>';
        //                                         var max_price = '<?= $max ?>';
        //                                         $("#output").text(max_price);
        //                                         // print(min_price)
        //                                         $("#slider-range").slider({
        //                                             range: true,
        //                                             min: 1,
        //                                             max: max_price,
        //                                             values: [min_price, max_price],
        //                                             slide: function (event, ui) {
        //                                                 $("#amount").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
        //                                             }
        //                                         });
        //                                         $("#slider_range_mob").slider({
        //                                             range: true,
        //                                             min: 1,
        //                                             max: max_price,
        //                                             values: [min_price, max_price],
        //                                             slide: function (event, ui) {
        //                                                 $("#amount_mob").val("Rs." + ui.values[ 0 ] + " - Rs." + ui.values[ 1 ]);
        //                                             }
        //                                         });

        //                                         $("#amount").val("Rs." + $("#slider-range").slider("values", 0) +
        //                                                 " - Rs." + $("#slider-range").slider("values", 1));
        //                                         $("#amount_mob").val("Rs." + $("#slider_range_mob").slider("values", 0) +
        //                                                 " - Rs." + $("#slider_range_mob").slider("values", 1));
        //                                     });
      
   

                                            function chk_filter(filter_id) {
                                                var already_checked = 0;
                                                var total_option = 0;
                    
                                                $(".option_" + filter_id).each(function () {
                                                    total_option += 1;
                                                    if ($(this).prop("checked") == true) {
                                                        already_checked += 1;
                                                    }
                                                   
                                                });
                                                if (already_checked > 0) {
                                                    $("#" + filter_id).prop("checked", true);
                                                    $("#mob_" + filter_id).prop("checked", true);
                                                } else {
                                                    $("#" + filter_id).prop("checked", false);
                                                    $("#mob_" + filter_id).prop("checked", false);
                                                }
                                                
                                                if((total_option / 2) - already_checked == (total_option / 2)) {
                                                    $("#" + filter_id).prop("checked", false);
                                                    $("#mob_" + filter_id).prop("checked", false);
                                                }
                                            }

                                            function filter_by_brand(brand_id) {
                                            
                                                $('#brand-' + brand_id).submit();
                                            }
</script>


<script>
     document.addEventListener("DOMContentLoaded", function() {
    
            var buttons = document.querySelectorAll(".mylink");
            var currentButton = null;

          
            var activeButtonIndex = localStorage.getItem("activeButtonIndex");

            if (activeButtonIndex !== null) {
             
                buttons.forEach(function(button) {
                    button.style.backgroundColor = "";
                    button.style.color = "";
                });

               

                currentButton = buttons[activeButtonIndex];
            }

            buttons.forEach(function(button, index) {
                button.addEventListener("click", function() {
                    if (currentButton !== null) {
                        currentButton.style.backgroundColor = "";
                        currentButton.style.color = "";
                    }

                    
                    localStorage.setItem("activeButtonIndex", index);

                    currentButton = this;
                });
            });
            window.addEventListener("load", function() {
      
    });
        });

    function openNav() {
        document.getElementById("mySidenav").style.width = "260px";
    }
    function closeNavbar() {
        document.getElementById("mySidenav").style.width = "0";
    }
   
$(function () {
    var min_price = 1;
    var max_price = 5000;

    

   
    initializeCheckboxes(min_price, max_price);
    $(".checkbox-container input[type='checkbox']").change(function () {
        updateOutput($(this)); 
    });

    $('#clearAllButton').click(function () {
        localStorage.clear();
        updateOutput(); 
    });

    function initializeCheckboxes(min, max) {
        $(".checkbox-container input[type='checkbox']").each(function () {
            var checkboxId = $(this).attr('id');
            var isChecked = localStorage.getItem(checkboxId) === 'true';
            $(this).prop("checked", isChecked);
        });
    }

    function updateOutput(checkbox) {
        var selectedRanges = $(".checkbox-container input[type='checkbox']:checked").map(function () {
            return {
                min: $(this).data("min"),
                max: $(this).data("max"),
                id: $(this).attr('id')
            };   
        }).get();

        var minSelected, maxSelected;

        if (selectedRanges.length > 0) {
            minSelected = selectedRanges[0].min;
            maxSelected = selectedRanges[selectedRanges.length - 1].max;
        } else {
            minSelected = min_price;
            maxSelected = max_price;
        }

        var outputText = "Selected Ranges:<br>";
        selectedRanges.forEach(function (range, index) {
            outputText += "Range " + (index + 1) + ": Rs." + range.min + " - Rs." + range.max + "<br>";
        });

        $("#amount").val("Rs." + minSelected + " - Rs." + maxSelected);
        localStorage.setItem('lastAmountValue', "Rs." + minSelected + " - Rs." + maxSelected);

        if (checkbox) {
            localStorage.setItem(checkbox.attr('id'), checkbox.prop("checked"));
        }
        else{
            localStorage.setItem(checkbox.attr('id'), false);
        }

        $("#amount").closest('form').submit();
    }

    $(document).on('submit', 'form', function () {
       var amountValue = $("#amount").val();
       $("#amount").val(localStorage.getItem('lastAmountValue'));
    });
    
    // var previousUrl = localStorage.getItem('previousUrl');

    // // Store the current URL in local storage
    // localStorage.setItem('previousUrl', window.location.href);

    // // Check if the previous URL exists and is different from the current URL
    // if (previousUrl && previousUrl !== window.location.href) {
    //     // Clear local storage
    //     localStorage.clear();
    //     // Uncheck all checkboxes
    //     $('.questions_brand').prop('checked', false);
    //     $('.questions_filter').prop('checked', false);
    //     $('.questions_option').prop('checked', false);
    //     $('.checkbox-container').prop('checked',false);
    //     $('.price-range').prop('checked',false);
    //     $(".checkbox-container input[type='checkbox']").prop("checked", false);
    // }



    
});




 $('#abs_btn').click(function () {
    window.history.back();
    // localStorage.clear();
});



// $(function () {
//             var min_price = 1;
//             var max_price = 5000;

//             initializeCheckboxes(min_price, max_price);
//             $(".checkbox-container input[type='checkbox']").change(function () {
//                 updateOutput($(this)); 
//             });

//             $('#clearAllButton').click(function () {
//                 localStorage.clear();
//                 updateOutput(); 
//             });

//             // Automatically trigger updateOutput when the page loads
//             updateOutput();

//             function initializeCheckboxes(min, max) {
//                 $(".checkbox-container input[type='checkbox']").each(function () {
//                     var checkboxId = $(this).attr('id');
//                     var isChecked = localStorage.getItem(checkboxId) === 'true';
//                     $(this).prop("checked", isChecked);
//                 });
//             }

//             function updateOutput(checkbox) {
//                 var selectedRanges = $(".checkbox-container input[type='checkbox']:checked").map(function () {
//                     return {
//                         min: $(this).data("min"),
//                         max: $(this).data("max"),
//                         id: $(this).attr('id')
//                     };   
//                 }).get();

//                 var minSelected, maxSelected;

//                 if (selectedRanges.length > 0) {
//                     minSelected = selectedRanges[0].min;
//                     maxSelected = selectedRanges[selectedRanges.length - 1].max;
//                 } else {
//                     minSelected = min_price;
//                     maxSelected = max_price;
//                 }
                

//                 // var amount_range = "Rs." + minSelected + " - Rs." + maxSelected;
//                 $("#amount").val("Rs." + minSelected + " - Rs." + maxSelected);
//                 localStorage.setItem('lastAmountValue', "Rs." + minSelected + " - Rs." + maxSelected);

//                 if (checkbox) {
//                     localStorage.setItem(checkbox.attr('id'), checkbox.prop("checked"));
//                 }
//                 else{
//                     localStorage.setItem(checkbox.attr('id'), false);
//                 }

//                 var amount_range=$('#amount').val();

//                 // Send AJAX request to filter.php with amountValue
//                 $.ajax({
//                     url: '<?php echo base_url('search');?>',
//                     type: 'GET',
//                     data: { amount_range: amount_range },
//                     success: function(data) {
//                         // Update UI with filtered data
//                         $("#amount").closest('form').submit();
//                     },
//                     error: function(xhr, status, error) {
//                         console.error('AJAX Error:', error);
//                     }
//                 });
//             }

            
//         });

//         $(window).on('popstate', function() {
//             // Clear localStorage
//             localStorage.clear();

//             // Uncheck all checkboxes after a slight delay
//             setTimeout(function() {
//                 $(".checkbox-container input[type='checkbox']").prop("checked", false);
//             }, 100);
//         });

//  $('#abs_btn').click(function () {
//     // Clear localStorage
//     localStorage.clear();

//     // Uncheck all checkboxes after a slight delay
//     setTimeout(function() {
//         $(".checkbox-container input[type='checkbox']").prop("checked", false);
//     }, 100);

//     // Clear the history
//     window.history.back();
// });



</script>
<script type="text/javascript">

    lozad('.lozad',{
        load:function(el){
            el.src=el.dataset.src;
            el.onload=function(){

            }
        }
    }).observe()
    </script>
