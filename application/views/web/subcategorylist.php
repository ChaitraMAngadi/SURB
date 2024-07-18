<!--breadcrumbs area start-->
<style>
    #productQAModal .modal-body {
        min-height: inherit!important;
    }
    .categories_product_area {
  flex-direction: row-reverse;
}
.active-button {
        background-color: #2556B9;
        color: white;
    }
    .category-image{

        background-color: white;
    }
    .category-image:active{
        background-color: #2556B9;
    }
        
        .selected-image {
            background-color: #2556B9 ;
        }
</style>
<?php if (count($banners) > 0) { ?>
    <div class="breadcrumbs_area  mt-72">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb_content">
                    <?php foreach ($categories as $k => $category) {
             if($category['seo_url']==$active_category_url){
                   $category_title=$category['title'];
             
            
                }}?>
                        <h3>
                            <!-- <a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"> -->
                            <ul>
                            <li><a href="<?php echo base_url(); ?>">home</a></li>

                            <!-- <li><a href="<?php echo base_url(); ?>">category</a></li> -->
                            <li style="font-weight:bold;"><?php echo $category_title; ?> </li>
                        </ul>
                    <!-- </a> -->
                </h3>
                        <!-- <h3>sub categories</h3> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


<?php 
// echo "<pre>"; 
// print_r($categories); 
// exit;?>

<div class="row" style="display:flex;justify-content:space-between;flex-direction:column;"> 
           
                      

<div class="categories_product_area" style="min-height: 600px; display: flex;">

    <div class="container">
        <?php 
        // echo "<pre>"; 
        //                                    print_r($active_category_url );
        //                                    exit;
?>
      <div class="row">
        <div class="col-lg-2 col-md-4 col-sm-4 col-xl-2 scrollable-div">

      
          <!-- Your content on the left side goes here -->
          <?php foreach ($categories as $k => $category) {
           // echo "<pre>";print_r($category['question'][0]->id);exit;
             if($category['seo_url']==$active_category_url){
                   $category_title=$category['title'];
             
            
                }

                            ?>
                            
                            <?php 
                            // print_r($active_seo_url);
                            // print_r($category['id']);//50
                           
                            // exit;?>
                                <article class="single_categories">
                                    <figure>
                                        <div class="categories_thumb" class="category-image <?php if ($category['seo_url'] === $active_category_url) echo 'active'; ?>">
                                            <!-- <?php echo base_url(); ?>web/store_categories/<?php echo $category['seo_url']; ?> -->
                                           <?php 
                                           
// print_r($category['seo_url']); //50-haircare
// print_r($category['sub_cat_rows']); //3
// print_r($category['question']);//questionary form

// exit;?>

<?php if (($category['sub_cat_rows'] == 0) && (sizeof($category['question']) == 0)){?>
  <a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>"  id="image_<?php echo $key; ?>" alt="" class="category-image"></a>  
<?php }else{?>
    <a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"><img src="<?php echo $category['image']; ?>"  id="image_<?php echo $key; ?>" alt="" class="category-image"></a>
<?php }?>
                                           
                                        </div>
                                        <!-- <figcaption class="categories_content">
                                            <?php if ($category['sub_cat_rows'] == 0) { ?>
                                                <?php if (sizeof($category['question']) > 0) { ?>
                                                    <h4 class="product_name"><a href="#productQAModal<?php echo $category['id']; ?>" data-toggle="modal"><?php echo $category['title']; ?></a></h4>
                                                <?php } else { ?>
                                                    <h4 class="product_name"><a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></h4>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <h4 class="product_name"><a href="<?php echo base_url(); ?>web/view_subcategories/<?php echo $category['seo_url']; ?>"><?php echo $category['title']; ?></a></h4>
                                            <?php } ?>
                                        </figcaption> -->
                                    </figure>
                                </article>
                               
                            
                                          
<?php }?>
        </div>
        <?php 
         //echo "<pre>"; print_r($categories);exit;?>
        <?php if(sizeof($sub_categories)>0){?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 col-xl-6 col-6 mybox">
    <div class="row">
        <div class="title_cat">
        <?php echo "&nbsp;&nbsp;Choose the ".$category_title ." product<br>";?>
        </div>
        <?php  
        // print_r($sub_categories);
        foreach ($sub_categories as $key => $sub_cat) {
           
        ?>               
        <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6 col-6"> <!-- Change the class here -->
            <article class="single_categories">
                <figure>
                    <figcaption class="categories_content">
                        <h4 class="product_name">
                            <!-- Update data-target with the ID of the corresponding form -->
                            <button id="btn_<?php echo $key; ?>" class="btn  subcat-btn" data-target="<?php echo $sub_cat->question_id; ?>">
                                <a href="#" class="sub_cat_name"><?php echo $sub_cat->sub_category_name; ?></a>
                            </button>
                        </h4>
                    </figcaption>
                </figure>
            </article>
        </div>
        <?php } ?>
    </div>
    <?php
$this->db->where('name', 'Questionary');
$query = $this->db->get('features');
$feature = $query->row();
$show_questionaries = !empty($feature) && $feature->status == 0;
?>
<?php if ($show_questionaries): ?>

        <!-- <a href="<?php echo base_url(); ?>sub-cat-products/<?php echo $sub_cat->seo_url; ?>" class="btn text-white  btn-lg float-right submit_sub" style="background-color: #2556B9; padding-top: 15px; <?php echo '@media (max-width: 768px) { padding-top: 0px; }'; ?>">Search</a>  -->
        <a href="<?php echo base_url(); ?>sub-cat-products/<?php echo $sub_cat->seo_url; ?>" >
        <div style="text-align: center;">
    <button type="submit" class="btn text-white btn-lg float-none submit_sub" >Submit</button>
    </div>
</a>
        <?php endif; ?>
    </div>

<?php }?>
<?php
$this->db->where('name', 'Questionary');
$query = $this->db->get('features');
$feature = $query->row();
$show_questionaries = !empty($feature) && $feature->status == 1;
?>
<?php if ($show_questionaries): ?>
<?php if(sizeof($sub_categories)>0){?>
<div class="col-lg-4 col-md-4 col-sm-4 col-4 col-xs-4  question">
<div id="content">
<!-- <?php $formDisplayed = false; ?> -->
<?php foreach ($sub_categories as $key => $sub_cat) { 
    // if (!$formDisplayed) {?>
    <!-- <?php echo $sub_cat->cat_id;//51 ?> -->
    <!-- <?php echo $sub_cat->question_id; ?> -->
    


<form method="get"  id='questionary-form-<?php echo $sub_cat->question_id; ?>' action="<?php echo base_url(); ?>products-filter-by-questionaries" onsubmit="return chkform(<?php echo $key; ?>)" style="display: none;">
<h4 class="myquestion"><?php echo $sub_cat->question; ?>(optional)</h4>
                                                                    <input type="hidden" name="cat_id" value="<?php echo $sub_cat->cat_id; ?>">
                                                                    <input type="hidden" name="question_id" value="<?php echo $sub_cat->question_id; ?>">
                                                                    <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat->id; ?>">

                                                                    <div class="row qaoptions">
                                                                        <?php foreach ($sub_cat->options as $value) { ?>
                                                                           <div class="font">
                                                                                <label class="custradiobtn"><span class="font-content"><?php echo $value->option; ?></span>
                                                                                    <input type="checkbox" onchange="chkbox(this, '<?php echo $key; ?>')" class="options" name="ques_options[]" value="<?php echo $value->id; ?>">
                                                                                    <span class="checkmark"></span>
                                                                                </label>
                                                                            </div>
                                                                        <?php } ?>
                                                                       <div class="font">
                                                                            <label class="custradiobtn"><span class="font-content">Others</span>
                                                                                <input type="checkbox" onchange="msgbox(this, '<?php echo $key; ?>')" class="other" id="other_<?php echo $key; ?>" name="ques_options[]" value="other">
                                                                                <span class="checkmark"></span>
                                                                            </label><br>
                                                                            </label>
                                                                        </div><br>
                                                                       
                                                                        <!-- <span class=" msgothers" id="message-<?php echo $key; ?>" style="display:none;">
                                                                            <input type="text" name="message" id="message-input-<?php echo $key; ?>" class="form-control" placeholder="Message"/>
                                                                        </span> -->
                                                                        <div class="col-md-12 msgothers" id="message-<?php echo $key; ?>" style="display:none;">
        <input type="text" name="message" id="message-<?php echo $key; ?>" placeholder="Please enter your issues..." class="othersmsg"/>
    </div>
                                                                        
                                                                        
                                                                        
                                                                        <div class="text-center submitcontrol" style="display:flex;gap:1.3rem;">
                                                        <a href="<?php echo base_url(); ?>sub-cat-products/<?php echo $sub_cat->seo_url; ?>" class="btn btn-outline-primary text-primary btn-lg skip_sub" onmouseover="this.style.color = 'blue'" onmouseout="this.style.color = 'blue'">Skip</a>
                                                                             <button type="submit"class="btn text-white  btn-lg float-right submit_sub">Submit</button>
                                                                            <!-- <a href="#" data-dismiss="modal" class="btn btn-outline-light mt-2 mr-2 btn-md text-white">Close</a> -->
                                                                        </div>
                                                                    </div>
</form>


<?php
// $formDisplayed = true;
    // }?>
<?php }?>
</div>
</div>

<?php }?>   
<?php if(sizeof($sub_categories)==0){?>                                                                   
<div class="col-lg-10 question2">
<div id="content2">
<!-- <?php $formDisplayed = false; ?> -->
<?php foreach ($categories as $key => $category) { 
    ?>
<?php if($category['sub_cat_rows']==0 && $category['seo_url']==$active_category_url){?>
  
    <?php 
   // echo "<pre>";print_r($category);?>
    <!-- <?php echo $sub_cat->cat_id;//51 ?> -->
    <!-- <?php echo $sub_cat->question_id; ?> -->
    
                                                               
                                                                    <form method="get" id='questionary-form2-<?php echo $category['question'][0]->cat_id;?>' action="<?php echo base_url(); ?>products-filter-by-questionaries" onsubmit="return chkform(<?php echo $k; ?>)">
                                                                    <span class="myquestion">
                                                                <h4><?php echo $category['question'][0]->question; ?></h4></span>
                                                                        <input type="hidden" name="cat_id" value="<?php echo $category['id']; ?>">
                                                                        <input type="hidden" name="question_id" value="<?php echo $category['question'][0]->id; ?>">
                                                                        <?php if (!empty($category['question'][0]->sub_cat_id) && $category['question'][0]->sub_cat_id > 0) { ?>
                                                                            <input type="hidden" name="sub_cat_id" value="<?php echo $category['question'][0]->sub_cat_id; ?>">
                                                                    <?php } ?>
                                                                        <div class="row qaoptions1">

                                                                            <?php
                                                                            $ques_id = $category['question'][0]->id;
                                                                            $options = $this->common_model->get_data_with_condition(['ques_id' => $ques_id], 'options');
                                                                            foreach ($options as $key => $val) {
                                                                                ?>
                                                                                <div class="col-md-12 font">
                                                                                    <label class="custradiobtn"><?php echo $val->option; ?>
                                                                                        <input type="checkbox" onchange="chkbox(this, '<?php echo $k; ?>')" class="options" name="ques_options[]" value="<?php echo $value->id; ?>">
                                                                                        <span class="checkmark"></span>
                                                                                    </label>
                                                                                </div>
                                                                        <?php } ?>
                                                                            
                                                                            <div class="font">
                                                                            <label class="custradiobtn"><span class="font-content">Others</span>
                                                                                <input type="checkbox" onchange="msgbox(this, '<?php echo $k; ?>')" class="other" id="other_<?php echo $k; ?>" name="ques_options[]" value="other">
                                                                                <span class="checkmark"></span>
                                                                            </label><br>
                                                                           
                                                                        </div><br>

                                                                            
                                                                            <div class="col-md-12 msgothers" id="message-<?php echo $k; ?>" style="display:none;">
        <input type="text" name="message" id="message-<?php echo $key; ?>" placeholder="Please enter your issues..." class="othersmsg"/>
        </div>    
                                                                        <div class="text-center submitcontrol" style="display:flex;gap:1.3rem;">
                                                        <a href="<?php echo base_url(); ?>products/<?php echo $category['seo_url']; ?>" class="btn btn-outline-primary text-primary btn-lg skip_sub" onmouseover="this.style.color = 'blue'" onmouseout="this.style.color = 'blue'">Skip</a>
                                                                             <button type="submit"class="btn text-white  btn-lg float-right submit_sub">Submit</button>
                                                                            <!-- <a href="#" data-dismiss="modal" class="btn btn-outline-light mt-2 mr-2 btn-md text-white">Close</a> -->
                                                                        </div>
                                                                        </div>
                                                                    </form>
                                                                    


<?php
// $formDisplayed = true;
    // }?>
<?php }?>

<?php }?></div>
</div><?php }?>
</div></div></div>



<?php endif; ?>












                                                                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {


   
    function showForm(questionId) {
        <?php foreach ($sub_categories as $key => $sub_cat) { ?>
            var form_<?php echo $sub_cat->question_id; ?> = document.getElementById('questionary-form-<?php echo $sub_cat->question_id; ?>');
           
            
            if (questionId === '<?php echo $sub_cat->question_id; ?>') {
                form_<?php echo $sub_cat->question_id; ?>.style.display = 'block';
                
               
            } else {
                form_<?php echo $sub_cat->question_id; ?>.style.display = 'none';
              
            }
        <?php } ?>
    }
    function showForm2(questionId) {
        <?php foreach ($categories as $key => $category) {  ?>
            var form_<?php echo $category['question'][0]->cat_id; ?> = document.getElementById('questionary-form2-<?php echo $category['question'][0]->cat_id; ?>');
           
            
            if (questionId === '<?php echo $category['question'][0]->cat_id; ?>') {
                form_<?php echo $category['question'][0]->cat_id; ?>.style.display = 'block';
               // $('.question').hide();
               // $('#content').hide();
               
            } else {
                form_<?php echo $category['question'][0]->cat_id; ?>.style.display = 'none';
              //  $('.question').show();
               // $('#content').show();
               
            }
        <?php } ?>
    }

    
   
    <?php foreach ($sub_categories as $key => $sub_cat) { ?>
        document.getElementById('btn_<?php echo $key; ?>').addEventListener('click', function() {
            showForm('<?php echo $sub_cat->question_id; ?>');
        });
    <?php } ?>

    // Show the first form and apply active style to the first button by default
    <?php if(sizeof($sub_categories)>0){?>
    showForm('<?php echo $sub_categories[0]->question_id; ?>');
   <?php }else {
    ?>
    //console.log(<?php echo $category; ?>);
  showForm2('<?php echo $category['question'][0]->cat_id;?>');
 // $('.question').hide();
 // $('#content').hide();
 <?php  }?>
   

        });
        document.addEventListener("DOMContentLoaded", function() {
    
    var buttons = document.querySelectorAll(".subcat-btn");
    var links= document.querySelectorAll(".sub_cat_name");

buttons[0].style.backgroundColor="#2556B9";
buttons[0].style.color="white";
    var currentButton = null;

    var currentlink=null;
    buttons.forEach(function(button) {
        button.addEventListener("click", function() {
           
            if (currentButton !== null) {
                currentButton.style.backgroundColor = ""; 

                currentButton.style.color="";

            }

            buttons[0].style.backgroundColor="";
            buttons[0].style.color="";
            this.style.backgroundColor = "#2556B9"; 

            this.style.color="white";

          
            currentButton = this;
        });
    });
    links.forEach(function(button) {
        button.addEventListener("click", function() {
           
            if (currentlink !== null) {
                

                currentlink.style.color="";

            }

           
            

            this.style.color="";

          
            currentlink = this;
        });
    });
});


document.addEventListener("DOMContentLoaded", function() {
    // var image="<?php echo $category_title;?>";
    // var myimage=null;
    // image.style.backgroundColor="#2556B9";
            var buttons = document.querySelectorAll(".category-image");
            var currentButton = null;

            // Check if there's a stored active button in local storage
            var activeButtonIndex = localStorage.getItem("activeButtonIndex");

            if (activeButtonIndex !== null) {
                // Remove active color from all buttons
                buttons.forEach(function(button) {
                    button.style.backgroundColor = "";
                    button.style.color = "";
                });

                // Apply active color to the previously clicked button
                buttons[activeButtonIndex].style.backgroundColor = "#2556B9";
                buttons[activeButtonIndex].style.background = "#2556B9 0% 0% no-repeat padding-box";
                buttons[activeButtonIndex].style.color = "white";

                currentButton = buttons[activeButtonIndex];
            }

            buttons.forEach(function(button, index) {
                button.addEventListener("click", function() {
                    // Remove active color from the previous button
                    if (currentButton !== null) {
                        currentButton.style.backgroundColor = "";
                        currentButton.style.color = "";
                    }

                    // Apply active color to the clicked button
                    this.style.backgroundColor = "#2556B9";
                    this.style.background = "#2556B9 0% 0% no-repeat padding-box";
                    this.style.color = "white";

                    // Store the index of the clicked button in local storage
                    localStorage.setItem("activeButtonIndex", index);

                    currentButton = this;
                });
            });
           
        });


    </script>








                                                                        









                                                                        
                                                                                   
 
                                                                        
<script async defer src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
   

            function chkform(key) {
                var already_checked = 0;
                $(".options").each(function () {
                    if ($(this).prop("checked") == true) {
                        $('#other_'+key).prop('checked', false);
                        already_checked += 1;
                    }
                });

                if ($('#other_'+key).prop("checked") == true) {
                    already_checked += 1;
                }

                if (already_checked > 0) {
                    return true;
                } else {
                    toastr.error('Select atleast one option from the list to proceed');
                    return false;
                }
                $('#questionary-form').trigger("reset");
            }

    function msgbox(ele, key) {
        if ($(ele).prop("checked") == true) {
            $('.options').prop('checked', false);
            $('#other_'+key).prop('checked', true);
            $('#message-' + key).show();
            $('#message-input-' + key).prop('required', true);
        } else {
            $('#message-' + key).hide();
            $('#message-input-' + key).prop('required', false);
        }
    }

                                                                                    function chkbox(ele, key) {
                                                                                        if ($(ele).prop("checked") == true) {
                                                                                            $('.other').prop('checked', false);
                                                                                            $('#message-' + key).hide();
                                                                                            $('#message-input-' + key).val('');
                                                                                            $('#message-input-' + key).prop('required', false);
                                                                                        }
                                                                                    }
                                                                                


</script>