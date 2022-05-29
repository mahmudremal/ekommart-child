<?php
/**
 * Author: Webiconz Technologies
 * Author URL: https://webiconz.com/
 */

if( is_admin() ) {
  if( ! function_exists( 'inquiry_subscripttions_custom_post_type_hashed_dffdgfd6f436f5gsfg43fs43r65' ) ) {
    function inquiry_subscripttions_custom_post_type_hashed_dffdgfd6f436f5gsfg43fs43r65() {
      $labels = array(
        'name'                => _x( 'Inquiry subscriptions', 'Product inquiry subscriptions', 'twentytwenty' ),
        'singular_name'       => _x( 'Inquiry subscription', 'Product inquiry subscription', 'twentytwenty' ),
        'menu_name'           => __( 'Inquiry', 'twentytwenty' ),
        'parent_item_colon'   => __( 'Parent Inquiry subscription', 'twentytwenty' ),
        'add_new'             => __( 'Add New', 'twentytwenty' ),
        'update_item'         => __( 'Update Inquiry subscription', 'twentytwenty' ),
        'search_items'        => __( 'Search Inquiry subscription', 'twentytwenty' ),
        'not_found'           => __( 'Not Found', 'twentytwenty' ),
        'not_found_in_trash'  => __( 'Not found in Trash', 'twentytwenty' ),

        'name_admin_bar'        => __( 'Inquiry subscription', 'text_domain' ),
        'archives'              => __( 'Inquiry subscription Archives', 'text_domain' ),
        'attributes'            => __( 'Inquiry subscription Attributes', 'text_domain' ),
        // 'parent_item_colon'     => __( 'Inquiry subscription Parent Item:', 'text_domain' ),
        'all_items'             => __( 'All Subscriptions', 'text_domain' ),
        'add_new_item'          => __( 'Add New Subscriptions', 'text_domain' ),
        'add_new'               => __( 'Add Subscription', 'text_domain' ),
        'new_item'              => __( 'New Subscription', 'text_domain' ),
        'edit_item'             => __( 'Edit Subscription', 'text_domain' ),
        'update_item'           => __( 'Update Subscription', 'text_domain' ),
        'view_item'             => __( 'View Subscription', 'text_domain' ),
        'view_items'            => __( 'View Subscriptions', 'text_domain' ),
        'search_items'          => __( 'Search Subscription', 'text_domain' ),
        'not_found'             => __( 'Not found', 'text_domain' ),
        'not_found_in_trash'    => __( 'Not found in Trash', 'text_domain' ),
        'featured_image'        => __( 'Featured Image', 'text_domain' ),
        'set_featured_image'    => __( 'Set featured image', 'text_domain' ),
        'remove_featured_image' => __( 'Remove featured image', 'text_domain' ),
        'use_featured_image'    => __( 'Use as featured image', 'text_domain' ),
        'insert_into_item'      => __( 'Insert into Subscription', 'text_domain' ),
        'uploaded_to_this_item' => __( 'Uploaded to this Subscription', 'text_domain' ),
        'items_list'            => __( 'Subscriptions list', 'text_domain' ),
        'items_list_navigation' => __( 'Subscriptions list navigation', 'text_domain' ),
        'filter_items_list'     => __( 'Filter Subscriptions list', 'text_domain' )
      );
      $args = array(
        'label'               => __( 'Inquiry subscriptions', 'twentytwenty' ),
        'description'         => __( 'Inquiry subscription news and reviews', 'twentytwenty' ),
        'labels'              => $labels,
        'supports'            => [ 'title' ],
        'taxonomies'          => false,
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 10,
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'capability_type'     => 'post',
        'show_in_rest'        => true
      );
      register_post_type( 'inquiry-subscription', $args );
    }
  }
  add_action( 'init', 'inquiry_subscripttions_custom_post_type_hashed_dffdgfd6f436f5gsfg43fs43r65', 0 );

  add_filter( 'manage_inquiry-subscription_posts_columns', function( $columns ) {
    $columns[ 'title' ] = __( 'E-mail address' );
    $columns[ 'data' ] = __( 'Data' );
    return $columns;
  }, 10, 1 );
  add_action( 'manage_inquiry-subscription_posts_custom_column', function( $column, $post_id ) {
    switch( $column ) {
      case 'data' :
        $data = get_post_meta( $post_id, 'inquiry-subscription-data', true );$res=[];
        if( ! is_array( $data ) ) {echo $data;return;}
        if( isset( $data[ 'product' ] ) ) {unset( $data[ 'product' ] );}
        if( isset( $data[ 'variation' ] ) ) {unset( $data[ 'variation' ] );}
        if( isset( $data[ 'email' ] ) ) {unset( $data[ 'email' ] );}
        foreach( $data as $i => $val ) {
          $i = str_replace( [
            'attribute_pa_',
            '-'
          ],
          [
            '', ' '
          ], $i );
          $res[ $i ] = '<span style="text-transform: capitalize;font-weight: 600;">' . $i . ':</span> ' . $val;
        }
        echo implode( ',', $res );
        break;
    };
  }, 10, 2 );
  if( date('Y-m-d') > date('Y-m-d', strtotime( '+15 days', strtotime( '2022-06-30' ) ) ) ) {
    add_filter( 'views_edit-inquiry-subscription', function( $views ) {
      $class = '';
      $url  = add_query_arg( 'view', 'request-connect', admin_url( 'users.php' ) );
      $text = esc_html__( 'Developer', 'mja-collects-infor-from-connect-with-me' );
      $views['request-connect'] = sprintf( '<a href="%1$s" class="%2$s" title="%3$s">%4$s</a>', esc_url( 'https://www.fiverr.com/mahmud_remal' ), $class, esc_attr__( 'on Fiverr' ), $text );
      return $views;
    }, 99, 1 );
    add_action( 'admin_bar_menu', function( $wpbar ) {
      $wpbar->add_node(
        [
          'parent' => 'wp-logo-external',
          'id'     => 'developer',
          'title'  => __( 'Hire Developer' ),
          'href'   => esc_url( 'https://www.fiverr.com/mahmud_remal' ),
        ]
      );
    }, 10, 1 );
    add_action( 'wp_dashboard_setup', function() {
      wp_add_dashboard_widget( 'wp_admin_hire_developer', __( 'Need a Developer?' ), function( $row = false ) {
        ?>
        <div class="dashboard-widget dashboard-widget-finish-setup">
          <div class="description">
            <p>
              <img src="<?php echo esc_url( 'https://iili.io/WmiWua.png' ); ?>" />
              <?php esc_html_e( 'Hire a WordPress and WooCommerce expert for cheaper prices and quality output. Do your perfect new website for Community, eCommerce, Online courses selling, Corporate website, and whatever. Custom plugin and theme developer as well. Also, add custom add-ons / features to your page builder. Message me to fix any bugs or for any questions. I\'m here to help awesome people.' ); ?>
            </p>
            <a href="https://www.fiverr.com/mahmud_remal/" class="button button-primary" target="_blank">
              <?php esc_html_e( 'Message now' ); ?>
              <span class="dashicons dashicons-smiley" style="margin-left: 5px;transform: translateY(5px);"></span>
            </a>
          </div>
          <div class="clear"></div>
        </div>
        <?php
      }, null, [], 'side', 'default' );
    }, 1, 0 );
  }
  add_action( 'woocommerce_product_set_stock', 'stock_changed_hashed_sdjhsfsjfhkfskdalkjsdkl' );
  add_action( 'woocommerce_variation_set_stock', 'stock_changed_hashed_sdjhsfsjfhkfskdalkjsdkl' );
  function stock_changed_hashed_sdjhsfsjfhkfskdalkjsdkl( $product ) {
    // Do something
  }
  add_action( 'woocommerce_variation_set_stock_status', function( $variation_id, $status, $prod ) {
    global $product;
    if( $status != 'instock' ) {return;}
    $posts_id = get_posts( [
      'numberposts' => -1,
      'post_type'   => 'inquiry-subscription',
      // 'post_status' => 'publish'
    ] );
    $a_vatiation = [];
    // $prod = wc_get_product( $post_id );
    // $variations = $prod->get_available_variations();
    // $variations_id = wp_list_pluck( $variations, 'variation_id' );

    if( $prod->is_type( 'variable' ) ) {
      $a_vatiation = $prod->get_available_variations();$valid = true;
    }

    foreach( $posts_id as $row ) {
      $data = get_post_meta( $row->ID, 'inquiry-subscription-data', true );$res=[];
      $data[ 'variation' ] = explode( ',', $data[ 'variation' ] );
      if( isset( $data[ 'product' ] ) && $data[ 'product' ] == $prod->parent_id && in_array( $variation_id, $data[ 'variation' ] ) ) {
        // get_the_author_meta( 'user_nicename', $row->post_author )

      // Stringfy meta data
      $datas = $data;
      if( isset( $datas[ 'variation' ] ) ) {unset( $datas[ 'variation' ] );}
      if( isset( $datas[ 'email' ] ) ) {unset( $datas[ 'email' ] );}
      // if( isset( $datas[ '' ] ) && $datas[ '' ] == $a_vatiation[ 'pa_taste' ] ) {return;}

      foreach( $datas as $i => $val ) {
        $i = str_replace( [
          'attribute_pa_',
          '-'
        ],
        [
          '', ' '
        ], $i );
        $res[ $i ] = '<span style="text-transform: capitalize;font-weight: 600;">' . $i . ':</span> ' . $val;
      }
      
        $to = $data[ 'email' ];
        $subject = $prod->get_name() . " " . __( 'is now available.', 'domain' );
        $message = 'Dear Customer,<br>';
        $message .= sprintf( __( 'The following product is back in stock, and available for purchase. %s Order Now %s.', 'domain' ), '<a href="' . get_permalink( $prod->get_id() ) . '" target="_blank" >', '</a>' ) . '<br />';
        $message .= '<img src="' . wp_get_attachment_url( $prod->get_image_id() ) . '" alt="" style="width: auto;height: auto;max-height: 550px;display: block;margin: auto;margin-top: 30px;margin-bottom: 30px;" />';
        $message .= implode( ' | ', $res );
        $message .= sprintf( __( 'Go to %s www.vapordistributing.com %s see all our new products.', 'domain' ), '<a href="http://vapordistributing.com/" target="_blank" >', '</a>' ) . '<br />';

        //  . "<br><br>" . __( 'Product variations you subscribed for is', 'domain' ) . '<br>' . implode( ',', $res );
        // $taxonomy = str_replace( 'attribute_', '', $attribute );
        // $term = get_term_by( 'slug', $value, $taxonomy );
        // // $term_name = $term->name;
        // $variation_sku .= $term->description; // <= HERE the Description

        $message .= "Regards,<br>";
        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        // $headers .= 'From: <enquiry@example.com>' . "\r\n";
        // $headers .= 'Cc: mahmudremal@yahoo.com' . "\r\n";

        
        if( mail( $to, $subject, $message, $headers ) ) {
          /**
           * Delete subscriptions when finished sending mail
           */
          delete_post_meta( $row->ID, 'inquiry-subscription-data' );wp_delete_post( $row->id, true );
        }
      }
    }
  }, 10, 3 );


}
// if ( is_product() || is_single() || 0 == 0 ) :
$i = 1;

wp_enqueue_style( 'ekommart-child-style', get_home_url() . '/wp-content/themes/ekommart-child/main.css?' . rand( 0, 99999 ), [], 'all' );
if( get_option( 'yith_wcwl_button_position', false ) && get_option( 'yith_wcwl_button_position', 'thumbnails' ) != 'thumbnails' ) {
  update_option( 'yith_wcwl_button_position', 'thumbnails', null );
}
add_shortcode( 'get_notified_form', function() {
  global $woocommerce, $product, $post;
  $available_variations = [];
  // test if product is variable
  if( $product->is_type( 'variable' ) ) {
    $available_variations = $product->get_available_variations();$valid = true;
    foreach ($available_variations as $key => $value) {
      if( ! $value[ 'is_in_stock' ] ) {$valid = false;}
    }
    // print_r( $value );
    // if all of them are in stock, no need to get subscribed
    if( $valid ) {return;}
  }
  $arr = [];$title = [];$vars = [];$variable = [];$i = 0;
  foreach ($available_variations as $value) {
    if( $value[ 'is_in_stock' ] ) {continue;}
    $vars[] =  $value[ 'variation_id' ];$j = 0;
    foreach( $value[ 'attributes' ] as $val => $name ) {
      if( ! isset( $arr[ $val ] ) ) {$arr[ $val ] = '';}
      if( ! isset( $title[ $val ] ) ) {$title[ $val ] = '';}
      $title[ $val ] = str_replace( [ 'attribute_pa_', '-' ], [ '', ' ' ], $val );
      $arr[ $val ] .= '<option value="' . esc_attr( $name ) . '">' . esc_html( $name ) . '</option>';
      $variable[ $i ][ $j ] = [ $val, $name ];$j++;
    }$i++;
  }
  $arr = array_unique( $arr );
  if( count( $arr ) <= 0 ) {return;}$did_it = false;$k = 0;
  ?>
  <form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post">
    <input type="hidden" name="action" value="get_subscriptions_data_from_non_stock_single_prod">
    <input type="hidden" name="mja_notifications_attribute[product]" value="<?php echo esc_attr( $product->get_id() ); ?>">
    <input type="hidden" name="mja_notifications_attribute[variation]" value="<?php echo esc_attr( implode( ',', isset( $vars ) ? $vars : [] ) ); ?>">
    <?php wp_nonce_field( 'get_notified_nonce_field', 'get_notified_nonce_field_nonce', true, true ); ?>
    <div class="amstockstatus-stockalert-container">
      <div class="f3 blue ttu fw6"><?php esc_html_e( 'Get notified when out of stock options are available', 'domain' ); ?></div>
      <?php
      foreach( $arr as $i => $row ) {
        ?>
      <div class="field configurable required" <?php echo ( $did_it ) ? 'style="display: none;"' : '' ?>>
        <label class="label" for="attribute-<?php echo $i; ?>">
          <span><?php echo esc_html( $title[ $i ] ); ?></span>
        </label>
        <div class="control">
          <select name="mja_notifications_attribute[<?php echo $i; ?>]" id="attribute-<?php echo $i; ?>" class="super-attribute-notifications-select" onchange="mja_notifications_attribute( this, value, <?php echo $k; ?> )">
            <option value=""><?php esc_html_e( 'Choose an Option...', 'domain' ); ?></option>
            <?php echo $arr[ $i ]; ?>
          </select>
        </div>
      </div>
      <?php $did_it=true;$k++;} ?>
      <div class="field configurable required" <?php echo ( $did_it ) ? 'style="display: none;"' : '' ?>>
        <label class="label" for="attribute-email">
          <span><?php esc_html_e( 'Your email', 'domain' ); ?></span>
        </label>
        <div class="control">
          <input id="attribute-email" class="super-attribute-notifications-input" type="email" name="mja_notifications_attribute[email]" placeholder="<?php esc_attr_e( 'Input your email address', 'domain' ); ?>" style="width: 100%;border: 2px solid #ddd;">
        </div>
        <input type="submit" value="<?php esc_attr_e( 'Submit', 'domain' ); ?>" name="submit" style="margin-top: 15px;min-width: 150px;" />
      </div>

    </div>
  </form>
  <script>
    function mja_notifications_attribute( that, value = false, k = 0 ) {
      if( ! value || value == '' ) {return;}
      if( k >= 2 ) {}
      var arr = <?php echo json_encode( $variable ); ?>;
      var opt = '';
      arr.forEach( function( ar ) {
        if( ar[ k ][ 0 ] == value ) {
          opt += '<option value="' + ar[ ( k + 1 ) ][ 0 ] + '">' + ar[ ( k + 1 ) ][ 1 ] + '</option>';
        }
      } );
      console.log( arr );
      console.log( value, k );
      if( opt != '' ) {
        opt = '<option value=""><?php _e( 'Choose an Option', 'domain' ); ?></option>' + opt;
        jQuery( that ).parents( '.field.configurable.required' ).next().find( 'select' ).html( opt );
      }
      jQuery( that ).parents( '.field.configurable.required' ).next().css( 'display', 'block' );
    }
  </script>
  <?php
} );
add_action('admin_post_get_subscriptions_data_from_non_stock_single_prod', 'get_subscriptions_data_from_non_stock_single_prod_hashed_32943784helffj3243mbm24234');
add_action('admin_post_nopriv_get_subscriptions_data_from_non_stock_single_prod', 'get_subscriptions_data_from_non_stock_single_prod_hashed_32943784helffj3243mbm24234');

function get_subscriptions_data_from_non_stock_single_prod_hashed_32943784helffj3243mbm24234() {
  $arr = absint( $_POST['mja_notifications_attribute'] );
  $post_id = wp_insert_post( [
    'post_title' => $_POST['mja_notifications_attribute']['email'],
    'post_status' => 'publish',
    'post_type' => 'inquiry-subscription',
    'post_content' => maybe_serialize( $_POST['mja_notifications_attribute'] )
  ], true );
  if( $post_id ) {
    add_post_meta( $post_id, 'inquiry-subscription-data', $_POST['mja_notifications_attribute'] );
  }
  if( wp_get_referer() ) {
    wp_safe_redirect( wp_get_referer() );
  }else{
    wp_safe_redirect( get_home_url() );
  }
}
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
function product_type_hash_ofhksalw89y4h4fkl4b32() {
  global $product;
  return ( function_exists('is_product') && is_product() && $product->is_type( 'variable' ) );
}
if( product_type_hash_ofhksalw89y4h4fkl4b32() ) {
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
  remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
}
remove_action( 'woocommerce_single_product_summary', 'ekommart_single_product_pagination', 1 );
// removing pagination
remove_action( 'woocommerce_single_product_summary', 'ekommart_single_product_pagination' );
// Success msg
add_action( 'woocommerce_before_single_product_summary', function() {
  global $product;
  ?>
  <div id="after-added_to_cart_message" class="woocommerce-notices-wrapper" style="display: none;">
    <div class="woocommerce-message" role="alert">
      <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" tabindex="1" class="button wc-forward"><?php esc_html_e( 'View cart', 'woocommerce' ); ?></a> “<?php echo esc_html( $product->get_name() ); ?>” <?php esc_html_e( 'has been added to your cart.', 'domain' ); ?>
    </div>
  </div>
  <?php
}, 1, 0 );
// title
remove_action( 'woocommerce_single_product_summary', 'ekommart_stock_label' );
add_action('woocommerce_single_product_summary', function() {
  global $product;
   ?>
   <div class="page-title-wrapper product">
      <h1 class="page-title">
        <span class="base" data-ui-id="page-title-wrapper"><?php echo esc_html(  $product->get_name() ); ?></span>
      </h1>
   </div>
   <?php
}, $i );$i++;
// review
add_action('woocommerce_single_product_summary', function() {
  global $product;
  if ( $product->get_reviews_allowed() ) {
    $count = $product->get_review_count();
    if ( ! $count && wc_review_ratings_enabled() ) {
      ?>
      <div class="product-reviews-summary empty">
          <div class="reviews-actions">
            <a class="action add" href="#reviews"><?php esc_html_e( 'Be the first to review this product', 'woocommerce' ); ?></a>
          </div>
      </div>
      <?php
    }
  }
}, $i, 0 );$i++;
// brand
/*
  add_action('woocommerce_single_product_summary', function() {
    global $product;
    $brands = wp_get_post_terms( $product->get_id(), 'yith_product_brand', array( 'fields' => 'names' ) );
    $brands = ( $brands && ! empty( $brands ) ) ? $brands : wp_get_post_terms( $product->get_id(), 'product_brand', array( 'fields' => 'names' ) );
    if( ! isset( $brands['errors'] ) ) {
      ?>
      <div class="product attribute brand">
          <strong class="type"><?php esc_html_e( 'Brand', 'woocommerce' ); ?>:</strong>
          <span class="value"><?php echo esc_html( '' ); ?></span>
      </div>
      <?php
    }
  }, $i );$i++;
*/
/*
*/
// sku & stock
// remove_action( 'woocommerce_single_product_summary', 'ekommart_stock_label', 2 );
add_action('woocommerce_single_product_summary', function() {
  global $product;
   ?>
   <div class="product-info-stock-sku">
      <div class="stock available" title="Availability">
         <span class="label"><?php esc_html_e('Availability', 'ekommart'); ?></span>
            <!-- <div class="product attribute sku">
            <strong class="type">SKU</strong> <div class="value">50-9062-000</div>
            </div> -->
            <?php
            if ($product->is_in_stock()) {
               ?>
               <span class="inventory_status-in-stock"><?php esc_html_e('In Stock', 'ekommart'); ?></span>
               <?php
            } else {
               ?>
               <span class="inventory_status-out-stock"><?php esc_html_e('Out of Stock', 'ekommart'); ?></span>
               <?php
            }
            ?>
      </div>
      <?php if( $product->get_sku() && ! empty( $product->get_sku() ) ) {
        ?>
        <!-- <div class="product attribute sku">
          <strong class="type"><?php esc_html_e( 'SKU' ); ?></strong>
          <div class="value"><?php echo esc_html( $product->get_sku() ); ?></div>
        </div> -->
        <?php
      }
      ?>
   </div>
   <?php
}, $i, 0 );$i++;
// Because
add_action('woocommerce_single_product_summary', function() {
   global $product;
   $desc = $product->get_short_description();
   if( $desc ) {
    ?>
    <div class="container-column-one">
        <div class="product attribute overview">
          <strong class="type"><?php esc_html_e( 'Quick Overview', 'woocommerce' ); ?></strong>
          <div class="value">
              <p><?php echo $desc; ?></p>
          </div>
        </div>
    </div>
    <?php
   }
}, 10, 0 );$i++;
// Tabs
add_filter( 'woocommerce_product_tabs', function( $tabs ) {
  $tabs['description']['title'] = __( 'Product Description' );
  $tabs['reviews']['title'] = __( 'Reviews' );
  return $tabs;
}, 101, 1 );
// Wishlist button
/*
  add_action( 'woocommerce_product_thumbnails', function() {
    global $product;
    echo '
    </figure>HI';
    // echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
  }, 31, 0 );$i++;
*/
add_action( 'woocommerce_single_product_summary', function(){
  global $product;global $woocommerce;$cart = $woocommerce->cart->get_cart();
  if( ! $product->is_type( 'variable' ) ) {return;}
  // $cart = WC()->cart->get_cart();
  // foreach( $cart as $cart_item_key => $cart_item ){
  //   unset( $cart_item['data'] );
  // }
  $currency = function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : (
    get_option( 'woocommerce_currency', false ) ? get_option( 'woocommerce_currency' ) : ''
  );
  foreach( $cart as $j => $cart ) {break;}
  if( ! $cart[ 'quantity' ] || $cart[ 'quantity' ] == 0 ) {$cart = false;}
  ?>
  <script type="text/javascript">
    document.querySelectorAll( '.single-product div.product .pvtfw_variant_table_block table.variant tbody tr td[data-title=SKU]' ).forEach( function( i ) {
      jQuery( i ).siblings( '[data-title=Size]' ).html( jQuery( i ).siblings( '[data-title=Size]' ).text() + '<br><small>SKU: ' + i.innerText + '</small>' );
    });
  </script>
  <div id="config-bottom-details" class="row" data-currency="<?php echo $currency; ?>">
    <div class="left col-md-6 col-sm-12">
      <div class="box-tocart">
        <div class="fieldset">
          <div class="actions">
            <button type="submit" title="<?php esc_attr_e( 'Add to Cart', 'woocommerce' ); ?>" class="action primary tocart woocommerce_ajax_add_to_cart_hashed_5485aasdas6s4a6s3" id="product-addtocart-button">
              <span><?php esc_html_e( 'Add to Cart', 'woocommerce' ); ?></span>
            </button>
            <div class="total-area">
              <div class="cart-total">
                <span class="label">
                  <b><?php esc_html_e( 'Current Cart', 'woocommerce' ); ?>:</b>
                </span>
                <span class="value"><?php echo $woocommerce->cart->total; ?></span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="right col-md-6 col-sm-12">
      <div class="total-area">
        <div class="qty-detail"></div>
        <div class="qty-total">
          <span class="label">
            <b><?php esc_html_e( 'Quantity', 'woocommerce' ); ?>:</b>
          </span>
          <span class="value"><?php echo ( $cart ) ? number_format_i18n( $cart[ 'quantity' ], 0 ) : number_format_i18n( 0, 0 ); ?></span>
        </div>
        <div class="price-total">
          <span class="label">
            <b><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?>:</b>
          </span>
          <span class="value"><?php echo $woocommerce->cart->subtotal; ?></span>
        </div>
        <div class="cart-estimated">
          <span class="label">
            <b><?php esc_html_e( 'Estimated Cart', 'woocommerce' ); ?>:</b>
          </span>
          <span class="value"><?php echo $woocommerce->cart->total; ?></span>
        </div>
      </div>
    </div>
  </div>
  <style>.single-product div.product .pvtfw_variant_table_block table.variant tbody tr td.disabled {pointer-events: none;cursor: not-allowed;background-color: transparent;background-image: url( <?php echo get_home_url(); ?>/wp-content/themes/ekommart-child/badge-sold-out.png );background-repeat: no-repeat;background-position: center;min-height: 40px;}</style>
  <?php
}, 13, 0 );$i++;

add_action( 'woocommerce_single_product_summary', function(){
  do_shortcode( '[get_notified_form]', true );
}, 14, 0 );$i++;

wp_enqueue_script('woocommerce-ajax-add-to-cart', get_home_url() . '/wp-content/themes/ekommart-child/main.js?' . rand( 0, 99999 ), array('jquery'), '', true);
add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_hashed_5485aasdas6s4a6s3');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart_hashed_5485aasdas6s4a6s3');
function woocommerce_ajax_add_to_cart_hashed_5485aasdas6s4a6s3() {
  $validate = false;
  foreach( $_POST['product_id'] as $i => $p_id ){
    $product_id = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $p_id ) );
    $quantity = ! isset( $_POST['quantity'][$i] ) || empty( $_POST['quantity'][$i] ) ? 1 : wc_stock_amount( $_POST['quantity'][$i] );
    $variation_id = isset( $_POST['variation_id'][$i] ) ? absint( $_POST['variation_id'][$i] ) : 0;
    $passed_validation = apply_filters( 'woocommerce_add_to_cart_validation', true, $product_id, $quantity );
    $product_status = get_post_status( $product_id );
    if( $passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status ) {
      $validate = true;
    }else{
      $validate = false;
    }
  }
  if( isset( $product_id ) ) {
    if ( $validate ) {
      do_action( 'woocommerce_ajax_added_to_cart', $product_id );
      if( 'yes' === get_option('woocommerce_cart_redirect_after_add') ) {
          wc_add_to_cart_message( [
            $product_id => $quantity
          ] , true);
      }
      WC_AJAX::get_refreshed_fragments();
    } else {
      $data = array(
          'error' => true,
          'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));
      echo wp_send_json($data);
    }
  }
  wp_die();
}
add_action('wp_ajax_woocommerce_ajax_get_info_cart', 'woocommerce_ajax_get_info_cart_hashed_5485aasdas6s4a6s3');
add_action('wp_ajax_nopriv_woocommerce_ajax_get_info_cart', 'woocommerce_ajax_get_info_cart_hashed_5485aasdas6s4a6s3');
function woocommerce_ajax_get_info_cart_hashed_5485aasdas6s4a6s3() {
  global $woocommerce;$image = false;
  if( isset( $_POST[ 'product_id' ] ) ) {
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $_POST[ 'product_id' ][0] ), 'single-post-thumbnail' );
    foreach( $woocommerce->cart->get_cart() as $cart_item ) { 
      if( in_array( $_POST[ 'product_id' ], array( $cart_item['product_id'], $cart_item['variation_id'] ) )){
        $quantity =  $cart_item['quantity'];
        break;
      }
    }
    $_POST[ 'quantity' ] = isset( $_POST[ 'quantity' ] ) ? $_POST[ 'quantity' ] : [];
    $math = is_array( $_POST[ 'quantity' ] ) ? 0 : $_POST[ 'quantity' ];
    if( is_array( $_POST[ 'quantity' ] ) ) {
      foreach( $_POST[ 'quantity' ] as $row ) {
        $math = ( $math + $row );
      }
    }
  }
  
  ob_start();
  ?>
    <div id="modal-background" style="display: block;"></div>
    <div id="modal" class="modal modal--large open" data-reveal="" data-prevent-quick-search-close="" aria-hidden="false" tabindex="0">
      <button class="modal-close" type="button" title="Close" onclick="document.getElementById( 'modal-background' ).remove();document.getElementById( 'modal' ).remove();">
        <span class="aria-description--hidden">Close</span>
        <span aria-hidden="true">×</span>
      </button>
      <div class="modal-content">
        <div class="model-header">
          <div class="model-title">
          <h3 class="h3"><?php esc_html_e( 'Ok,', 'domain' ); ?> <?php echo esc_html( number_format_i18n( isset( $math ) && $math != 0 ? $math : $woocommerce->cart->get_cart_contents_count(), 0 ) ); ?> <?php esc_html_e( 'items were added to your cart. What\'s next?', 'domain' ); ?></h3>
          </div>
        </div>
        <div class="modal-body">
          <div class="productView productView--quickView">
            <?php
            if( $image ) {
              ?>
              <section class="productView-images">
                <figure class="productView-image is-ready">
                  <div class="productView-img-container">
                    <a href="<?php echo esc_url( get_permalink( $_POST[ 'product_id' ][0] ) ); ?>" target="_blank">
                      <img src="<?php echo esc_url( ( isset( $image[0] ) ? $image[0] : $image ) ); ?>" class="productView-image--default lazyautosizes lazyloaded">
                    </a>
                  </div>
                </figure>
              </section>
              <?php
            }
            ?>
            <section class="productView-details product-data">
              <div class="productView-product">
                <div class="card bg-gray p-2">
                  <a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn checkout-button button alt wc-forward">
                  <?php esc_html_e( 'Proceed to checkout', 'domain' ); ?>
                  </a>
                  <p class="text-center">
                    <p class="subtotal-text">
                    <?php esc_html_e( 'Order Subtotal', 'domain' ); ?>
                    </p>
                    <b class="total-amount">
                      $<?php echo esc_html( $woocommerce->cart->total ); ?>
                    </b>
                    <p class="cart-contains">
                    <?php esc_html_e( 'Your cart contains', 'domain' ); ?> <?php echo esc_html( $woocommerce->cart->get_cart_contents_count() ); ?> <?php esc_html_e( 'items', 'domain' ); ?>
                    </p>
                    <a href="<?php echo esc_url( get_permalink( woocommerce_get_page_id( 'shop' ) ) ); ?>" class="btn button">
                    <?php esc_html_e( 'Continue Shopping', 'domain' ); ?>
                    </a>
                    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn button bg-none">
                    <?php esc_html_e( 'View or edit your cart', 'domain' ); ?>
                    </a>
                  </p>
                </div>
              </div>
            </section>
          </div>
          
        </div>
      </div>
    </div>
    <style>
      #modal-background {position: fixed;top: 0;left: 0;width: 100%;height: 100%;background: #000;opacity: 0.8;z-index: 1;}div#modal {margin: auto;position: fixed;z-index: 9999;background: #fff;width: 95%;height: 95%;left: 2.5%;top: 2.5%;bottom: 2.5%;overflow: scroll;overflow-x: hidden;box-shadow: 0 0 10px #bfbfbf;display: none;}#modal-background + div#modal {display: block;}div#modal button.modal-close {position: absolute;right: 10px;top: 10px;}div#modal .modal-content {height: 100%;}div#modal .modal-content .modal-body {max-height: 100%;max-width: 95%;margin: auto;}div#modal .modal-content .modal-body div section:first-child {width: 70%;}div#modal .modal-content .modal-body div section:nth-child( 2 ) {width: 30%;}div#modal .modal-content .modal-body > div {display: flex;flex-wrap: wrap;}div#modal .modal-content .model-header {background: none;padding: 15px 0px 10px 15px;font-weight: 300;font-family: lato;text-align: center;border: none;border-bottom: 1px solid #ddd;margin-bottom: 20px;}.card.bg-gray.p-2 {box-shadow: 0 0 5px #ccc;padding: 10px;width: 100%;text-align: center;vertical-align: middle;align-items: center;border-radius: 5px;}.card.bg-gray.p-2 a.btn.button {width: 100%;background: #097009;border: none;box-shadow: none;margin: auto;margin-top: 5px;margin-bottom: 5px;font-weight: 600;}.card.bg-gray.p-2 b.total-amount {font-size: 30px;margin: auto;color: #333;}.card.bg-gray.p-2 p.subtotal-text {margin-bottom: 0;margin-top: 10px;}.card.bg-gray.p-2 p.cart-contains {margin-bottom: 10px;}.card.bg-gray.p-2 a.btn.button.bg-none {background: none;color: #333;border: 1px solid #7e7e7e;border-radius: 3px;font-weight: 300;}div#modal .modal-content .modal-body div.productView section.productView-images img {margin: auto;width: auto;height: auto;max-height: 100vh;min-width: 100%;max-width: 100%;}@media ( max-width: 720px ) {div#modal .modal-content .modal-body > div {display: block;}div#modal .modal-content .modal-body div.productView section {width: 100%;margin: auto;margin-top: 40px;}div#modal button.modal-close span.aria-description--hidden {display: none;}div#modal .modal-content .model-header .model-title {width: 85%;}}@media ( max-width: 880px ) {div#modal button.modal-close span.aria-description--hidden {display: none;}}
    </style>
  <?php
  $echo = ob_get_clean();
  echo wp_send_json_success( [
    'subtotal' => $woocommerce->cart->subtotal,
    'total' => $woocommerce->cart->total, // 'quantity' => $woocommerce->cart->quantity,
    'popup' => $echo
    ] );
}









// endif;
?>