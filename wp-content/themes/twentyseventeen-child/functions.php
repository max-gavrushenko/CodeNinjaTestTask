<?php

if ( ! function_exists( 'custom_post_type_film' ) ) {

// Register Custom Post Type
	function custom_post_type_film() {

		$labels = array(
			'name'                  => _x( 'Films', 'Post Type General Name', 'twentyseventeen-child' ),
			'singular_name'         => _x( 'Film', 'Post Type Singular Name', 'twentyseventeen-child' ),
			'menu_name'             => __( 'Film', 'twentyseventeen-child' ),
			'name_admin_bar'        => __( 'Post Type', 'twentyseventeen-child' ),
			'archives'              => __( 'Film Archives', 'twentyseventeen-child' ),
			'attributes'            => __( 'Film Attributes', 'twentyseventeen-child' ),
			'parent_item_colon'     => __( 'Parent Film:', 'twentyseventeen-child' ),
			'all_items'             => __( 'All Films', 'twentyseventeen-child' ),
			'add_new_item'          => __( 'Add New Film', 'twentyseventeen-child' ),
			'add_new'               => __( 'Add New Film', 'twentyseventeen-child' ),
			'new_item'              => __( 'New Film', 'twentyseventeen-child' ),
			'edit_item'             => __( 'Edit Film', 'twentyseventeen-child' ),
			'update_item'           => __( 'Update Film', 'twentyseventeen-child' ),
			'view_item'             => __( 'View Film', 'twentyseventeen-child' ),
			'view_items'            => __( 'View Films', 'twentyseventeen-child' ),
			'search_items'          => __( 'Search Film', 'twentyseventeen-child' ),
			'not_found'             => __( 'Not found', 'twentyseventeen-child' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'twentyseventeen-child' ),
			'featured_image'        => __( 'Featured Image', 'twentyseventeen-child' ),
			'set_featured_image'    => __( 'Set featured image', 'twentyseventeen-child' ),
			'remove_featured_image' => __( 'Remove featured image', 'twentyseventeen-child' ),
			'use_featured_image'    => __( 'Use as featured image', 'twentyseventeen-child' ),
			'insert_into_item'      => __( 'Insert into item', 'twentyseventeen-child' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'twentyseventeen-child' ),
			'items_list'            => __( 'Films list', 'twentyseventeen-child' ),
			'items_list_navigation' => __( 'Films list navigation', 'twentyseventeen-child' ),
			'filter_items_list'     => __( 'Filter items list', 'twentyseventeen-child' ),
		);
		$args   = array(
			'label'               => __( 'Film', 'twentyseventeen-child' ),
			'description'         => __( 'Post Type Description', 'twentyseventeen-child' ),
			'labels'              => $labels,
			'supports'            => array(
				'title',
				'editor',
				'excerpt',
				'thumbnail'
			),
			'taxonomies'          => array( 'category' ),
			'hierarchical'        => FALSE,
			'public'              => TRUE,
			'show_ui'             => TRUE,
			'show_in_menu'        => TRUE,
			'menu_position'       => 5,
			'show_in_admin_bar'   => TRUE,
			'show_in_nav_menus'   => TRUE,
			'can_export'          => TRUE,
			'has_archive'         => TRUE,
			'exclude_from_search' => FALSE,
			'publicly_queryable'  => TRUE,
			'capability_type'     => 'post',
		);
		register_post_type( 'films', $args );

	}

	add_action( 'init', 'custom_post_type_film', 0 );

}

/**
 * Calls the class on the post edit screen.
 */
function call_filmsMetaBox() {
	new filmsMetaBox();
}

if ( is_admin() ) {
	add_action( 'load-post.php', 'call_filmsMetaBox' );
	add_action( 'load-post-new.php', 'call_filmsMetaBox' );
}

/**
 * The Class.
 */
class filmsMetaBox {

	/**
	 * Hook into the appropriate actions when the class is constructed.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
	}

	/**
	 * Adds the meta box container.
	 */
	public function add_meta_box( $post_type ) {
		// Limit meta box to certain post types.
		$post_types = array( 'films' );

		if ( in_array( $post_type, $post_types ) ) {
			add_meta_box(
				'films_meta_box',
				__( 'Films Meta Box', 'twentyseventeen-child' ),
				array( $this, 'render_films_meta_box_content' ),
				$post_type,
				'advanced',
				'high'
			);
		}
	}


	/**
	 * Render Meta Box content.
	 *
	 * @param WP_Post $post The post object.
	 */
	public function render_films_meta_box_content( $post ) {

		// Add an nonce field so we can check for it later.
		wp_nonce_field( 'films_meta_inner_custom_box', 'films_meta_inner_custom_box_nonce' );

		// Use get_post_meta to retrieve an existing value from the database.
		$subTitleFilm = get_post_meta( $post->ID, 'subTitleFilm', TRUE );
		$price        = get_post_meta( $post->ID, '_regular_price', TRUE );

		// Display the form, using the current value.
		?>
        <label>
			<?php _e( 'Sub Title', 'twentyseventeen-child' ); ?>:

            <input type="text" id="subTitleFilm_field" name="subTitleFilm"
                   value="<?php echo esc_attr( $subTitleFilm ); ?>" size="25"/></label>
        <br>
        <label>
			<?php _e( 'Price', 'twentyseventeen-child' ); ?>:

            <input type="text" id="price_field" name="_regular_price"
                   value="<?php echo esc_attr( $price ); ?>" size="25"/></label>
		<?php
	}
}


add_action( 'save_post', 'save_films', 10, 2 );
function save_films( $post_id, $post ) {
//	var_dump( $post_id, $post );
//	exit;
	if ( $post->post_type == 'films' ) {

		//save post meta
		/*
 * We need to verify this came from the our screen and with proper authorization,
 * because save_post can be triggered at other times.
 */

		// Check if our nonce is set.
		if ( ! isset( $_POST['films_meta_inner_custom_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['films_meta_inner_custom_box_nonce'];

		// Verify that the nonce is valid.
		if ( ! wp_verify_nonce( $nonce, 'films_meta_inner_custom_box' ) ) {
			return $post_id;
		}

		/*
		 * If this is an autosave, our form has not been submitted,
		 * so we don't want to do anything.
		 */
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}


		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}


		/* OK, it's safe for us to save the data now. */

		// Sanitize the user input.
		$subTitleFilm = sanitize_text_field( $_POST['subTitleFilm'] );
		$price        = sanitize_text_field( $_POST['_regular_price'] );
		$thumbnail_id = sanitize_text_field( $_POST['_thumbnail_id'] );

		$post_category = ( $_POST['post_category'] );

		// Update the meta field.
		update_post_meta( $post_id, 'subTitleFilm', $subTitleFilm );
		update_post_meta( $post_id, '_regular_price', $price );
//////////////////////////////////////////////////////////////////////////
		$post_args  = array(
			'comment_status' => 'open',
			'post_content'   => $post->post_content,
			'post_name'      => $post->post_name,
			'post_status'    => 'publish',
			'post_author'    => $post->post_author,
			'post_title'     => $post->post_title,
			'post_type'      => 'product',
		);
		$product_id = get_post_meta( $post_id, '_product_assigned', TRUE );


		if ( ! $product_id ) {
			$product_id = wp_insert_post( $post_args );
			if ( ! is_wp_error( $product_id ) ) {
				update_post_meta( $post_id, '_product_assigned', $product_id );
			}
			// Sanitize the user input.
			$price = sanitize_text_field( $_POST['_regular_price'] );

			// Update the meta field.
			update_post_meta( $product_id, '_regular_price', $price );
			update_post_meta( $product_id, '_price', $price );
			update_post_meta( $product_id, '_sale_price', $price );
			update_post_meta( $product_id, '_stock_status', 'instock' );
			update_post_meta( $product_id, 'total_sales', 0 );
			update_post_meta( $product_id, '_downloadable', 'no' );
			update_post_meta( $product_id, '_virtual', 'no' );
			update_post_meta( $product_id, '_purchase_note', '' );
			update_post_meta( $product_id, '_featured', 'no' );
			update_post_meta( $product_id, '_weight', '' );
			update_post_meta( $product_id, '_length', '' );
			update_post_meta( $product_id, '_width', '' );
			update_post_meta( $product_id, '_height', '' );
			update_post_meta( $product_id, '_sku', '' );
			update_post_meta( $product_id, '_product_attributes', array() );
			update_post_meta( $product_id, '_manage_stock', 'no' );
			update_post_meta( $product_id, '_backorders', 'no' );
			update_post_meta( $product_id, '_visibility', 'visible' );
			update_post_meta( $product_id, '_sale_price_dates_from', '' );
			update_post_meta( $product_id, '_sale_price_dates_to', '' );
			update_post_meta( $product_id, '_sold_individually', '' );
			update_post_meta( $product_id, '_upsell_ids', array() );
			update_post_meta( $product_id, '_crosssell_ids', array() );
			update_post_meta( $product_id, '_product_version', '2.6.14' );
			update_post_meta( $product_id, '_product_image_gallery', '' );
			update_post_meta( $product_id, '_wc_rating_count', array() );

		} else {
			//update prod
			$post_args['ID'] = $product_id;
			$item_id         = wp_update_post( $post_args );

			// Sanitize the user input.
			$price = sanitize_text_field( $_POST['_regular_price'] );

			// Update the meta field.
			update_post_meta( $product_id, '_regular_price', $price );
			update_post_meta( $product_id, '_price', $price );

		}
		set_post_thumbnail( $product_id, $thumbnail_id );

		foreach ( $post_category as $cat ) {
			if ( $cat !== '0' ) {

				$cat_name = get_the_category_by_ID( intval( $cat ) );
				$args     = array(
					'taxonomy' => array( 'product_cat' ),
					'get'      => 'all'
				);

				$woo_terms = get_terms( $args );
				if ( empty( $woo_terms ) ) {
					$result_id = wp_insert_term( $cat_name, 'product_cat' );
					if ( ! is_wp_error( $result_id ) ) {
						$result = wp_set_post_terms( $product_id, $result_id['term_id'], 'product_cat', TRUE );
					}
				}

				foreach ( $woo_terms as $term ) {
					if ( $term->name == $cat_name ) {
						$result = wp_set_post_terms( $product_id, $term->term_id, 'product_cat', TRUE );
					} else {
						$result_id = wp_insert_term( $cat_name, 'product_cat' );
						if ( ! is_wp_error( $result_id ) ) {
							$result = wp_set_post_terms( $product_id, $result_id['term_id'], 'product_cat', TRUE );
						}
					}
				}
			}

		}
	}

}


function wooc_extra_register_fields() {

	?>

    <p class="form-row form-row-wide">

        <label for="reg_billing_skype"><?php _e( 'Skype', 'woocommerce' ); ?>
            <span class="required">*</span></label>

        <input type="text" class="input-text" name="billing_skype"
               id="reg_billing_skype"
               value="<?php if ( ! empty( $_POST['billing_skype'] ) ) {
			       esc_attr_e( $_POST['billing_skype'] );
		       } ?>"/>

    </p>


	<?php

}

add_action( 'woocommerce_register_form_start', 'wooc_extra_register_fields' );

function wooc_validate_extra_register_fields( $username, $email, $validation_errors ) {

	if ( isset( $_POST['billing_skype'] ) && empty( $_POST['billing_skype'] ) ) {

		$validation_errors->add( 'billing_skype_error', __( '<strong>Error</strong>: Skype is required!', 'woocommerce' ) );

	}

}

add_action( 'woocommerce_register_post', 'wooc_validate_extra_register_fields', 10, 3 );

function wooc_save_extra_register_fields( $customer_id ) {

	if ( isset( $_POST['billing_skype'] ) ) {

		// WooCommerce billing first name.

		update_user_meta( $customer_id, 'billing_skype', sanitize_text_field( $_POST['billing_skype'] ) );

	}


}

add_action( 'woocommerce_created_customer', 'wooc_save_extra_register_fields' );


// After registration, redirect to home page
function custom_registration_redirect() {

	return home_url( '/product-category/featured/' );
}

add_action( 'woocommerce_registration_redirect', 'custom_registration_redirect', 2 );

add_filter( 'add_to_cart_redirect', 'films_add_to_cart_redirect' );
function films_add_to_cart_redirect() {
	global $woocommerce;
	$checkout_url = $woocommerce->cart->get_checkout_url();

	return $checkout_url;
}
