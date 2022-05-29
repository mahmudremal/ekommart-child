(function ($) {
    $( 'button.pvtfw_variant_table_cart_btn[disabled]' ).parents( 'td' ).siblings( 'td[data-title=quantity]' ).attr( 'class', 'disabled' );
    $(document).on('click', '#product-addtocart-button', function (e) {
        e.preventDefault();var $thisbutton = $(this);
        var product_qty = [], product_id = [], variation_id = [], price = 0, quantiity = 0;
        $( '.single-product div.product .pvtfw_variant_table_block table tbody tr' ).each( function( el ) {
          var p_id = $( this ).find( '.pvtfw_variant_table_cart_btn' ).data( 'product-id' );
          var qty = parseInt( $( this ).find( 'input.input-text.qty.text' ).val() );
          var variation = $( this ).find( '.pvtfw_variant_table_cart_btn' ).data( 'variant' );
          if( qty >= 1 && variation !== undefined && p_id !== undefined ) {
              price = ( price + ( qty * $( this ).find( 'input.hidden_price' ).val() ) );
              quantiity = ( quantiity + qty );
              product_qty.push( qty );
              product_id.push( p_id );
              variation_id.push( variation );
          }
          // make default
          // setTimeout( function(){
            $( this ).find( 'input.input-text.qty.text' ).val( '0' );
          // }, 4000);
        });
        var currency = $( '#config-bottom-details' ).data( 'currency' );
        $( '#config-bottom-details .cart-total .value, #config-bottom-details .price-total .value, #config-bottom-details .cart-estimated .value' ).html( 0 ); // currency + price
        $( '#config-bottom-details .qty-total .value' ).html( '0' ); // quantiity
        // var data = {product_qty: product_qty, quantity: product_qty, variation_id: variation_id};
        var data = {
            action: 'woocommerce_ajax_add_to_cart',
            // data: data,
            product_id: product_id,
            quantity: product_qty,
            variation_id: variation_id,
            product_sku: ''
        };
        // $(document.body).trigger('adding_to_cart', [$thisbutton, data]);
        $.ajax({
            type: 'post',
            url: wc_add_to_cart_params.ajax_url,
            data: data,
            beforeSend: function (response) {
                $thisbutton.removeClass('added').addClass('loading');
            },
            complete: function (response) {
                $thisbutton.addClass('added').removeClass('loading');
            },
            success: function (response) {

                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                } else {
                    // $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
                    $( '#after-added_to_cart_message' ).show( 800 );
                    $.ajax({
                        type: 'post',
                        url: wc_add_to_cart_params.ajax_url,
                        data: { action: 'woocommerce_ajax_get_info_cart', product_id: product_id },
                        success: function (res) {
                          var currency = $( '#config-bottom-details' ).data( 'currency' );
                          if( res.success ) {
                              res = res.data;
                              $( '#config-bottom-details .cart-total .value, #config-bottom-details .price-to tal .value' ).html( currency + res.subtotal );
                              $( '#config-bottom-details .cart-estimated .value' ).html( currency + res.total );
                              if( res.popup ) {
                                var popup = res.popup;
                                $( popup ).insertAfter( 'body' );
                              }
                          }
                          console.log( res.data );
                        }
                    });
                }
            },
        });

    return false;
    });
})(jQuery);