<?php
   $basename_get = basename($this->input->server('REQUEST_URI'));
   //$find = ['/?','?'];
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
<aside class="sidebar_widget">
                    <div class="widget_inner p-3">
                        <div class="widget_list widget_filter mb-2">
                            <?php
                            if ($basename == 'products-filter-by-questionaries') {
                                unset($_GET['amount_range']);
                                unset($_GET['brand_id']);
                                unset($_GET['filter']);
                                unset($_GET['option']);
                                ?>
                                <form method="get" action="<?= base_url() ?>products-filter-by-questionaries">
                                    <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                                    <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                                    <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                                    <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                                    <input type="hidden" name="message" value="<?php echo $message; ?>" />
                                    <div class="fixed-text">
                        <span class="filters">Filters</span>
                                    <button type="submit" id="clearAllButton">Clear All</button>
                            </div>
                                </form>
                                <?php
                            } else if ($basename == 'search') {
                                unset($_GET['amount_range']);
                                unset($_GET['brand_id']);
                                unset($_GET['filter']);
                                unset($_GET['option']);
                                ?>
                                <form method="get" action="<?= base_url('search') ?>">
                                    <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                                    <div class="fixed-text">
                        <span class="filters">Filters</span>
                                    <button type="submit" id="clearAllButton">Clear All</button>
                            </div>
                                </form>
                            <?php } else {
                                ?>
                                <form>
                                <div class="fixed-text">
                        <span class="filters">Filters</span>
                                    <a href="<?= $request_uri ?>"><button id="clearAllButton">Clear All</button></a>
                            </div>
<!--                                    <a href="<?= base_url() ?>"><button style="margin-left: 10px;" type="button">Back</button></a>-->
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
                                //    echo  $sub_category->seo_url . '/' . $option_details->seo_url;
                                //  echo base_url().$request_uri_explode[1]."/".$request_uri_explode[2];
                                // echo base_url()."sub-cat-products/".$sub_category->seo_url;
                                echo $sub_category->seo_url;
                             }
                             ?>">

                                            <div id="output_mob" style="border:0; color:#f6931f; font-weight:bold;display:none;"></div>
                                            <input type="text" name="amount_range" id="amount_mob" readonly style="border:0; color:#f6931f; font-weight:bold;display:none;"/>
                                           
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


<div class="checkbox-container1">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[0]['min'] ?>" data-max="<?= $priceRanges[0]['max'] ?>" class="price-range" id="<?= $priceRanges[0]['id'] ?>" name="price-range[]" <?= $priceRangeChecked1 ? 'checked' : '' ?> />
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[0]['min'] ?>-Rs.<?= $priceRanges[0]['max'] ?><span id="product-count-<?= $priceRanges[0]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container1">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[1]['min'] ?>" data-max="<?= $priceRanges[1]['max'] ?>" class="price-range" id="<?= $priceRanges[1]['id'] ?>" name="price-range[]" <?= $priceRangeChecked2 ? 'checked' : '' ?> />
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[1]['min'] ?>-Rs.<?= $priceRanges[1]['max'] ?><span id="product-count-<?= $priceRanges[1]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container1">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[2]['min'] ?>" data-max="<?= $priceRanges[2]['max'] ?>" class="price-range" id="<?= $priceRanges[2]['id'] ?>" name="price-range[]" <?= $priceRangeChecked3 ? 'checked' : '' ?> />
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[2]['min'] ?>-Rs.<?= $priceRanges[2]['max'] ?><span id="product-count-<?= $priceRanges[2]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container1">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[3]['min'] ?>" data-max="<?= $priceRanges[3]['max'] ?>" class="price-range" id="<?= $priceRanges[3]['id'] ?>" name="price-range[]" <?= $priceRangeChecked4 ? 'checked' : '' ?> />
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[3]['min'] ?>-Rs.<?= $priceRanges[3]['max'] ?><span id="product-count-<?= $priceRanges[3]['id'] ?>"></span>
        </label>
    </label>
</div>

<div class="checkbox-container1">
    <label class="cust">
        <input type="checkbox" data-min="<?= $priceRanges[4]['min'] ?>" data-max="<?= $priceRanges[4]['max'] ?>" class="price-range" id="<?= $priceRanges[4]['id'] ?>" name="price-range[]" <?= $priceRangeChecked5 ? 'checked' : '' ?> />
        <span class="checkmark1"></span>
        <label class="content">
            Rs.<?= $priceRanges[4]['min'] ?>-Rs.<?= $priceRanges[4]['max'] ?><span id="product-count-<?= $priceRanges[4]['id'] ?>"></span>
        </label>
    </label>
</div>
                                         <!-- <div  id="output1" style="display:none;"></div> <input type="text" name="amount_range" id="amount1" readonly style="border:0; color:#f6931f; font-weight:bold;"/> -->
                             </ul></div></div>
                              <!-- <div id="slider-range"></div>
                              <div id="output"></div>
                                        <input type="text" name="amount_range" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"/> -->
                             <!-- <input type="text" name="amount_range" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"/>          -->
                             <input type="hidden" name="cat_id" value="<?php echo $category->id; ?>" />
                             <input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id; ?>" />
                             <input type="hidden" name="question_id" value="<?php echo $question_id; ?>" />
                             <input type="hidden" name="ques_option_str" value="<?php echo $ques_options; ?>" />
                             <input type="hidden" name="message" value="<?php echo $message; ?>" />
                             <input type="hidden" name="searchdata" value="<?php echo $searchdata; ?>" />
                            

                                    
                            
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
                         ?>
                  <li>
                  <label class="cust">
                  <input type="checkbox" class="questions1" name="brand_id[]" value="<?= $brand_detail->id ?>" <?= in_array($brand_detail->id, $brand_selected) ? 'checked' : '' ?>/> <?= $brand_detail->brand_name ?> <span>(<?= $brand_count ?>)</span>
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

                  <input type="checkbox" class="questions1" style="visibility:hidden;" id="mob_<?= $id ?>" name="filter[]" value="<?= $id ?>" <?php

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
                  <input type="checkbox" class="questions1 option_<?= $id ?>" name="option[]" value="<?= $option_id ?>" onchange="chk_filter('<?= $id ?>')" <?php
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
                  <div style="display:flex;justify-content:space-between;margin-top:7px;">
                    <button class="cancel-btn"><a href="javascript:void(0)" onclick="closeNavbar()" style="color:#2556B9">Cancel</a></button>
                    <center><button type="submit" class="filtering">Apply</button></center></div>
                  </form>
                  
                  <?php } ?>
                  
               </div>
                </aside>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script>

$(document).ready(function () {
    function setSelectedBrandNames(brandNames) {
      localStorage.setItem('selectedBrandNames', JSON.stringify(brandNames));
    }

    function getSelectedBrandNames() {
      var storedBrandNames = localStorage.getItem('selectedBrandNames');
      return storedBrandNames ? JSON.parse(storedBrandNames) : [];
    }

    function updateSelectedChoice() {
      var brandData = getSelectedBrandNames();
      console.log("brand data", brandData);
      var html = '';

      brandData.forEach(function (brand) {
        
        html += '<div class="selected-brand" data-value="' + brand.value + '">' + brand.name + '<span class="close-button-brand" data-brand="' + brand.name + '" data-brand-value="' + brand.value + '">×</span></div>';
      });
      document.getElementById("selectedchoice").style.display = "block";
      $('#selectedchoice').html(html);
    }

    $(document).on('click', '.close-button-brand', function () {
      var brandNameToRemove = $(this).data('brand');
     

      var brandValueToremove = $(this).data('brand-value');
    
      localStorage.removeItem(brandNameToRemove);
    


    
    var updatedBrandData = getSelectedBrandNames().filter(function (brand) {
        return brand.name !== brandNameToRemove;
      });

    setSelectedBrandNames(updatedBrandData);
    updateSelectedChoice();

   
    $('#brand_' + brandValueToremove).prop('checked', false);

    
    $('#brand_' + brandValueToremove).val('');


    
    $('#brand_' + brandValueToremove).closest('form').submit();
    });

    updateSelectedChoice();

    $('#clearAllButton').click(function () {
      localStorage.clear();
      updateSelectedChoice();
    });

    $('.questions_brand').change(function () {

      // var checkbox = $(this);
      // var brandName = checkbox.parent().text().trim().replace(/(\r\n|\n|\r)/gm, "");
      // var brandValue = checkbox.val();
      var checkbox = $(this);
    // Get the text of the parent element, excluding the count within parentheses
    var brandName = checkbox.parent().clone().children().remove().end().text().trim();
    var brandValue = checkbox.val();


      if (checkbox.is(':checked')) {
        localStorage.setItem(brandName, brandValue);
      } else {
        localStorage.removeItem(brandName);
      }

      $("questions_brand:contains('" + brandName + "'):not(#" + checkbox.attr('id') + ")").prop('checked', false);
      checkbox.closest('form').submit();

      var brandData = getSelectedBrandNames();


      if (checkbox.is(':checked')) {
        brandData.push({ name: brandName, value: brandValue });
      } else {
        var index = brandData.findIndex(function (brand) {
          return brand.name === brandName;
        });

        if (index !== -1) {
          brandData.splice(index, 1);
        }
      }
      setSelectedBrandNames(brandData);
      updateSelectedChoice();
    });
  });





  $(document).ready(function () {
  function setSelectedOptions(optionNames) {
    localStorage.setItem('selectedOptionNames', JSON.stringify(optionNames));
  }

  function getSelectedOptions() {
    var storedOptionNames = localStorage.getItem('selectedOptionNames');
    return storedOptionNames ? JSON.parse(storedOptionNames) : [];
  }


  function updateSelectedOptions() {
    var optionData = getSelectedOptions();
    console.log("option data", optionData);
    var html = '';

    optionData.forEach(function (option) {
      html += '<div class="selected-option" data-value="' + option.value + '">' + option.name + '<span class="close-button-option" data-option="' + option.name + '" data-option-value="' + option.value + '">×</span></div>';
    });
    document.getElementById("selectedoption").style.display = "block";
    $('#selectedoption').html(html);
    
  }
  $(document).on('click', '.close-button-option', function () {
    var optionValueToremove = $(this).data('option-value');
    var optionNameToRemove =$(this).data('option');

    
    localStorage.removeItem(optionNameToRemove);

    
    var updatedOptionData = getSelectedOptions().filter(function (option) {
      return option.name !== optionNameToRemove;
    });

    setSelectedOptions(updatedOptionData);
    updateSelectedOptions();

   
    $('#option_' + optionValueToremove).prop('checked', false);


    
    $('#option_' + optionValueToremove).val('');

    
    $('#option_' + optionValueToremove).closest('form').submit();
  });



  updateSelectedOptions();


  
  function setSelectedFilters(filterNames) {
    localStorage.setItem('selectedFilterNames', JSON.stringify(filterNames));
  }

  function getSelectedFilters() {
    var storedFilterNames = localStorage.getItem('selectedFilterNames');
    return storedFilterNames ? JSON.parse(storedFilterNames) : [];
  }

  function updateSelectedFilters() {
    var filterData = getSelectedFilters();
    console.log("filter data", filterData);
    var html = '';

    filterData.forEach(function (filter) {
        
      html += '<div class="selected-filter" data-value="' + filter.value + '">' + filter.name + '<span class="close-button-filter" data-filter="' + filter.name + '" data-filter-value="' + filter.value + '">×</span></div>';
    });
document.getElementById("selectedfilter").style.display = "block";
    $('#selectedfilter').html(html);
  }

  
  $(document).on('click', '.close-button-filter', function () {
    var filterNameToRemove = $(this).data('filter');
    var filterValueToRemove= $(this).data('filter-value');
    localStorage.removeItem(filterNameToRemove);

    var updatedFilterData = getSelectedFilters().filter(function (filter) {
      return filter.name !== filterNameToRemove;
    });
   

    setSelectedFilters(updatedFilterData);
    updateSelectedFilters();

   
    $('#filter_' + filterValueToRemove).prop('checked', false);

    
    $('#filter_' + filterValueToRemove).val('');

    
    $('#filter_' + filterValueToRemove).closest('form').submit();
  });

  updateSelectedFilters();

  $('#clearAllButton').click(function () {
      localStorage.clear();
      updateSelectedChoice();
    });


  $('.questions_option').change(function () {
    var checkboxOption = $(this);
    var optionName = checkboxOption.parent().text().trim().replace(/(\r\n|\n|\r)/gm, "");
    var optionValue = checkboxOption.val();

    if (checkboxOption.is(':checked')) {
     
      localStorage.setItem(optionName, optionValue);
    } else {
      
      localStorage.removeItem(optionName);
    }

    $("questions_option:contains('" + optionName + "'):not(#" + checkboxOption.attr('id') + ")").prop('checked', false);
    checkboxOption.closest('form').submit();

    var optionData = getSelectedOptions();

    if (checkboxOption.is(':checked')) {
      optionData.push({ name: optionName, value: optionValue });
    } else {
      var index = optionData.findIndex(function (option) {
        return option.name === optionName;
      });

      if (index !== -1) {
        optionData.splice(index, 1);
      }
    }
    setSelectedOptions(optionData);
    updateSelectedOptions();
  });

  $('.questions_filter').change(function () {
    var checkboxFilter = $(this);
    var filterName = checkboxFilter.parent().text().trim().replace(/(\r\n|\n|\r)/gm, "");
    var filterValue = checkboxFilter.val();

    if (checkboxFilter.is(':checked')) {
      localStorage.setItem(filterName, filterValue);
    } else {
      localStorage.removeItem(filterName);
    }

    $("questions_filter:contains('" + filterName + "'):not(#" + checkboxFilter.attr('id') + ")").prop('checked', false);
    checkboxFilter.closest('form').submit();

    var filterData = getSelectedFilters();

    if (checkboxFilter.is(':checked')) {
      filterData.push({ name: filterName, value: filterValue });
    } else {
      var index = filterData.findIndex(function (filter) {
        return filter.name === filterName;
      });

      if (index !== -1) {
        filterData.splice(index, 1);
      }
    }
    setSelectedFilters(filterData);
    updateSelectedFilters();
  });
});



$(function () {
    var min_price = 1;
    var max_price = 5000;
    initializeCheckboxes(min_price, max_price);

    $(".checkbox-container1 input[type='checkbox']").change(function () {
        updateOutput($(this)); 
    });

    $('#clearAllButton').click(function () {
        localStorage.clear();
        updateOutput(); 
    });

    function initializeCheckboxes(min, max) {
        $(".checkbox-container1 input[type='checkbox']").each(function () {
            var checkboxId = $(this).attr('id');
            var isChecked = localStorage.getItem(checkboxId) === 'true';
            $(this).prop("checked", isChecked);
            

        });
        
    }

    function updateOutput(checkbox) {
        var selectedRanges = $(".checkbox-container1 input[type='checkbox']:checked").map(function () {
            return {
                min: $(this).data("min"),
                max: $(this).data("max"),
                id: $(this).attr('id')
            };
        }).get();

        var outputText = "Selected Ranges:<br>";
        selectedRanges.forEach(function (range, index) {
            outputText += "Range " + (index + 1) + ": Rs." + range.min + " - Rs." + range.max + "<br>";
        });

        $("#output_mob").html(outputText);

        if (selectedRanges.length > 0) {
            var minSelected = selectedRanges[0].min;
            var maxSelected = selectedRanges[selectedRanges.length - 1].max;

            // $("#amount_mob").val("Rs." + minSelected + " - Rs." + maxSelected);
          
        } else {
            // $("#amount_mob").val("Rs." + min_price + " - Rs." + max_price);
           
            minSelected = min_price;
            maxSelected = max_price;
        }

        var outputText = "Selected Ranges:<br>";
        selectedRanges.forEach(function (range, index) {
            outputText += "Range " + (index + 1) + ": Rs." + range.min + " - Rs." + range.max + "<br>";
        });

        $("#amount_mob").val("Rs." + minSelected + " - Rs." + maxSelected);
        localStorage.setItem('lastAmountValue', "Rs." + minSelected + " - Rs." + maxSelected);

        if (checkbox) {
            localStorage.setItem(checkbox.attr('id'), checkbox.prop("checked"));
        }
    }

    
});

function openNav() {
        document.getElementById("mySidenav").style.width = "260px";
    }
    /* Set the width of the side navigation to 0 */
    function closeNavbar() {
        document.getElementById("mySidenav").style.width = "0";
    }
</script>