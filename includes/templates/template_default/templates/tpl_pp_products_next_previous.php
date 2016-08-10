<?php
// -----
// Part of the "Product Pagination" plugin by lat9 (lat9@vinosdefrutastropicales.com)
// Copyright (c) 2010-2016 Vinos de Frutas Tropicales
// 
if ($products_found_count > 1) {
?>
<div class="ppNextPrevWrapper">
<?php
    $products_last_index = $products_found_count - 1;
    $page_link_parms    = "cPath=$cPath&amp;products_id=";
    $display_prev_link  = ($position == 0) ? false : true;
    $display_next_link  = ($position == $products_last_index) ? false : true;
?>
  <div class="ppNextPrevCounter">
    <p<?php echo (PRODUCTS_PAGINATION_LISTING_LINK == 'true') ? ' class="back pagination-list"' : '';?>><?php echo PP_PREV_NEXT_PRODUCT . ($position+1) . PP_PREV_NEXT_PRODUCT_SEP . $counter; ?></p>
<?php
    if (PRODUCTS_PAGINATION_LISTING_LINK == 'true') {
?>
    <div class="pagination prevnextReturn">
      <ul>
        <li><a href="<?php echo zen_href_link (FILENAME_DEFAULT, "cPath=$cPath"); ?>" class="prevnext" title="<?php echo sprintf (PP_TEXT_PRODUCT_LISTING_TITLE, $category_name_row->fields['categories_name']); ?>"><?php echo PP_TEXT_PRODUCT_LISTING; ?></a></li>
      </ul>
    </div>
  </div>
<?php
    }
?>
  <div class="pagination pagination-links">
    <ul>
<?php
    products_next_prev_link ($previous_position, PP_TEXT_PREVIOUS, $display_prev_link, ' class="prevnext"');

    if ($products_found_count <= PRODUCTS_PAGINATION_MAX) {
        for ($i=0; $i < $products_found_count; $i++) {
            products_next_prev_link ($i, $i+1, true, ($i == $position) ? ' class="currentpage"' : '');
        }
    } else {
        $first_product_link = $position - floor (PRODUCTS_PAGINATION_MID_RANGE/2);
        $last_product_link  = $position + floor (PRODUCTS_PAGINATION_MID_RANGE/2);

        if ($first_product_link < 0) {
            $last_product_link += abs($first_product_link);
            $first_product_link = 0;
        }
        if ($last_product_link > $products_last_index) {
            $first_product_link -= $last_product_link-$products_last_index;
            $last_product_link   = $products_last_index;
        }
        $display_range = range ($first_product_link, $last_product_link);

        for ($i=0; $i < $products_found_count; $i++) {
            if ($display_range[0] > 1 && $i == $display_range[0]) {
                echo '<li> ... </li>';
            }
            // loop through all pages. if first, last, or in range, display
            if ($i == 0 || $i == $products_last_index || in_array($i, $display_range)) {
                products_next_prev_link ($i, $i+1, true, ($i == $position) ? ' class="currentpage"' : '');
            }
            if ($display_range[PRODUCTS_PAGINATION_MID_RANGE-1] < $products_last_index-1 && $i == $display_range[PRODUCTS_PAGINATION_MID_RANGE-1]) {
                echo '<li> ... </li>';
            }
        }
    } 
    products_next_prev_link ($next_position, PP_TEXT_NEXT, $display_next_link, ' class="prevnext"');
?>
    </ul>
  </div>
</div>
<?php
}
