<?php
/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'thb_custom_theme_options', 1 );

/**
 * Theme Mode demo code of all the available option types.
 *
 * @return    void
 *
 * @access    private
 * @since     2.0
 */
function thb_custom_theme_options() {
  
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Create a custom settings array that we pass to 
   * the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'sections'        => array(
      array(
        'title'       => esc_html__('Blog', 'revolution'),
        'id'          => 'blog'
      ),
      array(
        'title'       => esc_html__('Header & Menu', 'revolution'),
        'id'          => 'header'
      ),
      array(
        'title'       => esc_html__('Portfolio', 'revolution'),
        'id'          => 'portfolio'
      ),
      array(
        'title'       => esc_html__('Shop', 'revolution'),
        'id'          => 'shop'
      ),
      array(
        'title'       => esc_html__('Footer', 'revolution'),
        'id'          => 'footer'
      ),
      array(
        'title'       => esc_html__('Typography', 'revolution'),
        'id'          => 'typography'
      ),
      array(
        'title'       => esc_html__('Customization', 'revolution'),
        'id'          => 'customization'
      ),
      array(
        'title'       => esc_html__('Misc', 'revolution'),
        'id'          => 'misc'
      )
    ),
    'settings'        => array(
    	array(
    	  'id'          => 'blog_tab0',
    	  'label'       => esc_html__('Blog Listing', 'revolution'),
    	  'type'        => 'tab',
    	  'section'     => 'blog'
    	),
    	array(
    	  'label'       => esc_html__('Blog Header Style', 'revolution'),
    	  'id'          => 'blog_header',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('You can choose different blog header styles here', 'revolution'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Title & Categories', 'revolution'),
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => esc_html__('Page Content', 'revolution'),
    	      'value'       => 'style2'
    	    ),
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'blog'
    	),
    	array(
    	  'label'       => esc_html__('Blog Top Content', 'revolution'),
    	  'id'          => 'blog_top_content',
    	  'type'        => 'page-select',
    	  'desc'        => esc_html__('This allows you to add contents of a page above the blog.', 'revolution'),
    	  'section'     => 'blog',
    	  'condition'   => 'blog_header:is(style2)'
    	),
    	array(
    	  'label'       => esc_html__('Blog Header Categories', 'revolution'),
    	  'id'          => 'blog_header_categories',
    	  'type'        => 'category-checkbox',
    	  'desc'        => esc_html__('You can choose which categories to display under the blog title', 'revolution'),
    	  'section'     => 'blog',
    	  'condition'   => 'blog_header:is(style1)'
    	),
    	array(
    	  'label'       => esc_html__('Blog Style', 'revolution'),
    	  'id'          => 'blog_style',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('You can choose different blog styles here', 'revolution'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Style 1 - Grid', 'revolution'),
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 2 - Vertical', 'revolution'),
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 3 - Left Thumbnail', 'revolution'),
    	      'value'       => 'style3'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 4 - Masonry', 'revolution'),
    	      'value'       => 'style4'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 5 - Image Overlay', 'revolution'),
    	      'value'       => 'style5'
    	    ),
    	    array(
    	      'label'       => esc_html__('Style 6 - Grid with Border', 'revolution'),
    	      'value'       => 'style6'
    	    ),
    	    
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'blog'
    	),
    	array(
    	  'label'       => esc_html__('Blog Sidebar', 'revolution'),
    	  'id'          => 'blog_sidebar',
    	  'type'        => 'on_off',
    	  'desc'        => esc_html__('Do you want to display the sidebar for the blog?', 'revolution'),
    	  'std'         => 'on',
    	  'section'     => 'blog',
    	  'operator' 		=> 'or',
    	  'condition'   => 'blog_style:is(style1),blog_style:is(style3),blog_style:is(style4),blog_style:is(style5),blog_style:is(style6)'
    	),
    	array(
    		'label'       => esc_html__('Number of Columns', 'revolution' ),
    	  'id'          => 'thb_blog_columns',
    	  'std'         => '4',
    	  'type'        => 'numeric-slider',
    	  'section'     => 'blog',
    	  'min_max_step'=> '3,6,1',
    	  'operator' 		=> 'or',
    	  'condition'   => 'blog_style:is(style1),blog_style:is(style4),blog_style:is(style6)'
    	),
    	array(
    	  'label'       => esc_html__('Blog Animation', 'revolution'),
    	  'id'          => 'blog_animation',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('You can choose different blog animation styles here', 'revolution'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('None', 'revolution'),
    	      'value'       => ''
    	    ),
    	    array(
    	      'label'       => esc_html__('Right to Left', 'revolution'),
    	      'value'       => 'animation right-to-left'
    	    ),
    	    array(
    	      'label'       => esc_html__('Left to Right', 'revolution'),
    	      'value'       => 'animation left-to-right'
    	    ),
    	    array(
    	      'label'       => esc_html__('Right to Left - 3D', 'revolution'),
    	      'value'       => 'animation right-to-left-3d'
    	    ),
    	    array(
    	      'label'       => esc_html__('Left to Right - 3D', 'revolution'),
    	      'value'       => 'animation left-to-right-3d'
    	    ),
    	    array(
    	      'label'       => esc_html__('Bottom to Top', 'revolution'),
    	      'value'       => 'animation bottom-to-top'
    	    ),
    	    array(
    	      'label'       => esc_html__('Top to Bottom', 'revolution'),
    	      'value'       => 'animation top-to-bottom'
    	    ),
    	    array(
    	      'label'       => esc_html__('Bottom to Top - 3D', 'revolution'),
    	      'value'       => 'animation bottom-to-top-3d'
    	    ),
    	    array(
    	      'label'       => esc_html__('Top to Bottom - 3D', 'revolution'),
    	      'value'       => 'animation top-to-bottom-3d'
    	    ),
    	    array(
    	      'label'       => esc_html__('Scale', 'revolution'),
    	      'value'       => 'animation scale'
    	    ),
    	    array(
    	      'label'       => esc_html__('Fade', 'revolution'),
    	      'value'       => 'animation fade'
    	    ),
    	  ),
    	  'std'         => '',
    	  'section'     => 'blog'
    	),
    	array(
    	  'label'       => esc_html__('Blog Pagination Style', 'revolution'),
    	  'id'          => 'blog_pagination_style',
    	  'type'        => 'radio',
    	  'desc'        => esc_html__('You can choose different blog pagination styles here. The regular pagination will be used for archive pages.', 'revolution'),
    	  'choices'     => array(
    	    array(
    	      'label'       => esc_html__('Regular Pagination', 'revolution'),
    	      'value'       => 'style1'
    	    ),
    	    array(
    	      'label'       => esc_html__('Load More Button', 'revolution'),
    	      'value'       => 'style2'
    	    ),
    	    array(
    	      'label'       => esc_html__('Infinite Scroll', 'revolution'),
    	      'value'       => 'style3'
    	    )
    	  ),
    	  'std'         => 'style1',
    	  'section'     => 'blog'
    	),
      array(
        'id'          => 'blog_tab1',
        'label'       => esc_html__('Article Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Article Sidebar', 'revolution'),
        'id'          => 'article_sidebar',
        'type'        => 'on_off',
        'desc'        => esc_html__('Do you want to display the sidebar inside article pages?', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Display Tags?', 'revolution'),
        'id'          => 'article_tags',
        'type'        => 'on_off',
        'desc'        => esc_html__('Displays article tags at the bottom', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Display Author Info?', 'revolution'),
        'id'          => 'article_author',
        'type'        => 'on_off',
        'desc'        => esc_html__('Displays author information at the bottom. Will only be displayed if the author description is filled.', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Display Related Posts?', 'revolution'),
        'id'          => 'article_related',
        'type'        => 'on_off',
        'desc'        => esc_html__('Displays related posts at the bottom.', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Display Article Navigation?', 'revolution'),
        'id'          => 'blog_nav',
        'type'        => 'on_off',
        'desc'        => esc_html__('Displays article navigation at the bottom', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Article Navigation Style', 'revolution'),
        'id'          => 'blog_nav_style',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose your article navigation style here', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1 (Fixed)', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2 (With Images)', 'revolution'),
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Display Footer on Article Pages?', 'revolution'),
        'id'          => 'footer_article',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle footer inside article pages.', 'revolution'),
        'std'         => 'on',
        'section'     => 'blog'
      ),
      array(
        'id'          => 'blog_tab2',
        'label'       => esc_html__('Sharing Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'blog'
      ),
      array(
        'label'       => 'Sharing buttons',
        'id'          => 'sharing_buttons',
        'type'        => 'checkbox',
        'desc'        => 'You can choose which social networks to display and get counts from. Please visit <strong>Theme Options > Misc</strong> to fill out application details for the social media sites you choose. This also affects the Portfolio Pages.',
        'choices'     => array(
          array(
            'label'       => 'Facebook',
            'value'       => 'facebook'
          ),
          array(
            'label'       => 'Twitter',
            'value'       => 'twitter'
          ),
          array(
            'label'       => 'Pinterest',
            'value'       => 'pinterest'
          ),
          array(
            'label'       => 'Google Plus',
            'value'       => 'google-plus'
          ),
          array(
            'label'       => 'Linkedin',
            'value'       => 'linkedin'
          ),
          array(
            'label'       => 'Vkontakte',
            'value'       => 'vkontakte'
          ),
          array(
            'label'       => 'WhatsApp',
            'value'       => 'whatsapp'
          ),
          array(
            'label'       => 'Facebook Messenger',
            'value'       => 'facebook-messenger'
          ),
          array(
            'label'       => 'E-Mail',
            'value'       => 'email'
          )
        ),
        'section'     => 'blog'
      ),
      array(
        'label'       => esc_html__('Facebook App ID', 'revolution'),
        'id'          => 'facebook_app_id',
        'type'        => 'text',
        'desc'        => esc_html__('Facebook Application ID for Facebook Messenger, available <a href="https://developers.facebook.com/apps/" target="_blank">here</a>', 'revolution'),
        'section'     => 'blog'
      ),
      array(
        'id'          => 'portfolio_tab0',
        'label'       => esc_html__('General', 'revolution'),
        'type'        => 'tab',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => esc_html__('Portfolio Slug', 'revolution'),
        'id'          => 'portfolio_slug',
        'type'        => 'text',
        'desc'        => esc_html__('The portfolio slug used for the portfolio permalinks', 'revolution'),
        'section'     => 'portfolio'
      ),
      array(
        'label'       => esc_html__('Portfolio Navigation', 'revolution'),
        'id'          => 'portfolio_nav',
        'type'        => 'on_off',
        'desc'        => esc_html__('This displays a navigation above the footer for next/previous portfolios', 'revolution'),
        'std'         => 'on',
        'section'     => 'portfolio'
      ),
      array(
        'label'       => esc_html__('Portfolio Navigation Style', 'revolution'),
        'id'          => 'portfolio_nav_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Choose the navigation style below.', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Just Next Item', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Previous & Next Items', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Multiple Items', 'revolution'),
            'value'       => 'style3'
          ),
          array(
            'label'       => esc_html__('Just Text', 'revolution'),
            'value'       => 'style4'
          )
        ),
        'std'         => 'style3',
        'section'     => 'portfolio',
        'condition'   => 'portfolio_nav:is(on)'
      ),
      array(
        'label'       => esc_html__('Number of Portfolios to show', 'revolution'),
        'id'          => 'portfolio_nav_count',
        'type'        => 'text',
        'desc'        => esc_html__('Number of portfolios you want to show inside the navigation', 'revolution'),
        'section'     => 'portfolio',
        'std'					=> '10',
        'operator' 		=> 'and',
        'condition'   => 'portfolio_nav:is(on),portfolio_nav_style:is(style3)'
      ),
      array(
        'label'       => esc_html__('Display Footer on Portfolio Pages?', 'revolution'),
        'id'          => 'footer_portfolio',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle footer inside portfolio pages.', 'revolution'),
        'std'         => 'off',
        'section'     => 'portfolio'
      ),
      array(
        'id'          => 'shop_tab0',
        'label'       => esc_html__('General', 'revolution'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Catalog Mode', 'revolution'),
        'id'          => 'shop_catalog_mode',
        'type'        => 'on_off',
        'desc'        => esc_html__('If enabled, this will hide add to cart buttons and prices along the site.', 'revolution'),
        'section'     => 'shop',
        'std'         => 'off'
      ),
      array(
        'label'       => esc_html__('Product Listing Style', 'revolution'),
        'id'          => 'shop_product_listing',
        'type'        => 'radio',
        'desc'        => esc_html__('Which style would you like to use on listing pages?', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2', 'revolution'),
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product Listing Layout', 'revolution'),
        'id'          => 'shop_product_listing_layout',
        'type'        => 'radio',
        'desc'        => esc_html__('Which layout would you like to use on listing pages?', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Grid', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Alternating - 3 / 4 columns', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 5 columns', 'revolution'),
            'value'       => 'style3'
          ),
          array(
            'label'       => esc_html__('Alternating - 5 / 6 columns', 'revolution'),
            'value'       => 'style4'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 3 columns', 'revolution'),
            'value'       => 'style5'
          ),
          array(
            'label'       => esc_html__('Alternating - 5 / 4 columns', 'revolution'),
            'value'       => 'style6'
          ),
          array(
            'label'       => esc_html__('Alternating - 6 / 5 columns', 'revolution'),
            'value'       => 'style7'
          ),
          array(
            'label'       => esc_html__('Alternating - 4 / 4 / 3 columns', 'revolution'),
            'value'       => 'style8'
          )
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
      	'label'       => esc_html__('Products Per Row', 'revolution' ),
        'id'          => 'products_per_row',
        'std'         => 'thb-5',
        'type'        => 'radio',
        'choices'     => array(
          array(
            'label'       => esc_html__('2 Columns', 'revolution'),
            'value'       => 'large-6'
          ),
          array(
            'label'       => esc_html__('3 Columns', 'revolution'),
            'value'       => 'large-4'
          ),
          array(
            'label'       => esc_html__('4 Columns', 'revolution'),
            'value'       => 'large-3'
          ),
          array(
            'label'       => esc_html__('5 Columns', 'revolution'),
            'value'       => 'thb-5'
          ),
          array(
            'label'       => esc_html__('6 Columns', 'revolution'),
            'value'       => 'large-2'
          )
        ),
        'section'     => 'shop',
        'condition'   => 'shop_product_listing_layout:is(style1)'
      ),
      array(
        'label'       => esc_html__('Product Pagination Style', 'revolution'),
        'id'          => 'shop_product_listing_pagination',
        'type'        => 'radio',
        'desc'        => esc_html__('Which pagination syle would you like to use on shop page?', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Regular Pagination', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Load More Button', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Infinite Load', 'revolution'),
            'value'       => 'style3'
          )
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Products Per Page', 'revolution' ),
        'id'          => 'products_per_page',
        'type'        => 'text',
        'section'     => 'shop',
        'std' 				=> '12'
      ),
      array(
        'label'       => esc_html__('Product Hover Image', 'revolution'),
        'id'          => 'shop_product_hover',
        'type'        => 'on_off',
        'desc'        => esc_html__('When enabled, this shows a secondary product image on hover.', 'revolution'),
        'section'     => 'shop',
        'std'         => 'on'
      ),
      array(
        'id'          => 'shop_tab2',
        'label'       => esc_html__('Product Page', 'revolution'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product Page Style', 'revolution'),
        'id'          => 'shop_product_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which style would you like to use on product pages?', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Style 3', 'revolution'),
            'value'       => 'style3'
          ),
          array(
            'label'       => esc_html__('Style 4', 'revolution'),
            'value'       => 'style4'
          ),
          array(
            'label'       => esc_html__('Style 5', 'revolution'),
            'value'       => 'style5'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Use Lightbox or Zoom?', 'revolution'),
        'id'          => 'shop_product_lightbox',
        'type'        => 'radio',
        'desc'        => esc_html__('Would you like to use a lightbox or a mouse hover zoom?', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Lightbox', 'revolution'),
            'value'       => 'lightbox'
          ),
          array(
            'label'       => esc_html__('Zoom', 'revolution'),
            'value'       => 'zoom'
          )
          
        ),
        'std'         => 'lightbox',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'shop_tab4',
        'label'       => esc_html__('Shop Header', 'revolution'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Shop Page Header Style', 'revolution'),
        'id'          => 'shop_header_style',
        'type'        => 'radio',
        'desc'        => esc_html__('This changes the look of the header on main shop page.', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Just Text', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('With Image', 'revolution'),
            'value'       => 'style2'
          )
          
        ),
        'std'         => 'style1',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Shop Header Background', 'revolution'),
        'id'          => 'shop_header_bg',
        'type'        => 'background',
        'desc'        => esc_html__('Background settings for the shop header', 'revolution'),
        'section'     => 'shop',
        'condition'   => 'shop_header_style:is(style2)'
      ),
      array(
        'label'       => esc_html__('Shop Header Color', 'revolution'),
        'id'          => 'shop_menu_color',
        'type'        => 'radio',
        'desc'        => esc_html__('What color would you like to display for the header? <small>You can change category headers on individual Edit Category pages</small>', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'revolution'),
            'value'       => 'light-header'
          ),
          array(
            'label'       => esc_html__('Dark', 'revolution'),
            'value'       => 'dark-header'
          )
        ),
        'std'         => 'light-header',
        'section'     => 'shop',
        'condition'   => 'shop_header_style:is(style2)'
      ),
      array(
        'id'          => 'shop_tab5',
        'label'       => esc_html__('Misc', 'revolution'),
        'type'        => 'tab',
        'section'     => 'shop'
      ),
      array(
        'label'       => esc_html__('Product "Just Arrived" Badge time', 'revolution'),
        'id'          => 'shop_newness',
        'type'        => 'radio',
        'desc'        => esc_html__('Products that are added before the below time will display the new product page', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Never - "Just Arrived" Badge will never be shown', 'revolution'),
            'value'       => '0'
          ),
          array(
            'label'       => esc_html__('1 Day', 'revolution'),
            'value'       => '1'
          ),
          array(
            'label'       => esc_html__('2 Days', 'revolution'),
            'value'       => '2'
          ),
          array(
            'label'       => esc_html__('3 Days', 'revolution'),
            'value'       => '3'
          ),
          array(
            'label'       => esc_html__('1 Week', 'revolution'),
            'value'       => '7'
          ),
          array(
            'label'       => esc_html__('2 Weeks', 'revolution'),
            'value'       => '14'
          ),
          array(
            'label'       => esc_html__('3 Weeks', 'revolution'),
            'value'       => '21'
          ),
          array(
            'label'       => esc_html__('1 Month', 'revolution'),
            'value'       => '30'
          )
        ),
        'std'         => '7',
        'section'     => 'shop'
      ),
      array(
        'id'          => 'header_tab0',
        'label'       => esc_html__('General Header Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Style', 'revolution'),
        'id'          => 'header_style',
        'type'        => 'radio-image',
        'std'         => 'style1',
        'section'	  	=> 'header'
      ),
      array(
        'label'       => esc_html__('Header Border', 'revolution'),
        'id'          => 'header_border',
        'type'        => 'border',
        'desc'        => esc_html__('Display the fixed header?', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Full Width', 'revolution'),
        'id'          => 'thb_header_full_width',
        'type'        => 'on_off',
        'desc'        => esc_html__('By default, the header on revolution is limited to the grid, you can make it full width here.', 'revolution'),
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Header', 'revolution'),
        'id'          => 'fixed_header',
        'type'        => 'on_off',
        'desc'        => esc_html__('Display the fixed header?', 'revolution'),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Header Color', 'revolution'),
        'id'          => 'fixed_header_color',
        'type'        => 'radio',
        'desc'        => esc_html__('Color of the fixed header', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'revolution'),
            'value'       => 'light-header'
          ),
          array(
            'label'       => esc_html__('Dark', 'revolution'),
            'value'       => 'dark-header'
          )
        ),
        'std'         => 'dark-header',
        'section'     => 'header',
        'condition'   => 'fixed_header:is(on)'
      ),
      array(
        'label'       => esc_html__('Auto-Hide Fixed Header on Scroll', 'revolution'),
        'id'          => 'fixed_header_scroll',
        'type'        => 'on_off',
        'desc'        => esc_html__('Fixed header is hidden when you scroll down and only shown when you scroll up.', 'revolution'),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Header Shadow', 'revolution'),
        'id'          => 'fixed_header_shadow',
        'type'        => 'select',
        'desc'        => esc_html__('You can set your fixed header shadow here.', 'revolution'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('None', 'revolution'),
        	  'value'       => ''
        	),
          array(
            'label'       => esc_html__('Small', 'revolution'),
            'value'       => 'thb-fixed-shadow-style1'
          ),
          array(
            'label'       => esc_html__('Medium', 'revolution'),
            'value'       => 'thb-fixed-shadow-style2'
          ),
          array(
            'label'       => esc_html__('Large', 'revolution'),
            'value'       => 'thb-fixed-shadow-style3'
          )
        ),
        'std'         => '',
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab1',
        'label'       => esc_html__('Full Menu Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Full Menu Hover Style', 'revolution'),
        'id'          => 'full_menu_hover_style',
        'type'        => 'radio',
        'desc'        => esc_html__('Which hover style would you like to use?', 'revolution'),
        'choices'     => array(
      		array(
      			'label'       => esc_html__('Standard', 'revolution'),
      			'value'       => 'thb-standard'
      		),
      		array(
      			'label'       => esc_html__('Underline', 'revolution'),
      			'value'       => 'thb-underline'
      		),
      		array(
      			'label'       => esc_html__('Line Through', 'revolution'),
      			'value'       => 'thb-line-through'
      		),
      		array(
      			'label'       => esc_html__('Line Marker', 'revolution'),
      			'value'       => 'thb-line-marker'
      		)
        ),
        'std'         => 'thb-standard',
        'section'	  => 'header'
      ),
      array(
        'id'          => 'menu_margin',
        'label'       => esc_html__('Top Level Item Margin', 'revolution'),
        'desc'        => esc_html__('If you want to fit more menu items to the given space, you can decrease the margin between them here. The default margin is 30px', 'revolution'),
        'type'        => 'measurement',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Full Menu Social Links', 'revolution' ),
        'id'          => 'fullmenu_social_link',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links next to the full menu here', 'revolution' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab2',
        'label'       => esc_html__('Secondary Area Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Display Secondary Menu', 'revolution'),
        'id'          => 'header_secondary',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can display another menu inside secondary area.', 'revolution'),
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Language Switcher', 'revolution'),
        'id'          => 'thb_ls',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle the language switcher here. Requires that you have WPML or PolyLang installed.', 'revolution'),
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Secondary Menu', 'revolution'),
        'id'          => 'header_secondary_menu',
        'type'        => 'menu_select',
        'desc'        => esc_html__('Select menu to be displayed inside secondary area.', 'revolution' ),
        'section'     => 'header',
        'condition'   => 'header_secondary:is(on)'
      ),
      array(
        'label'       => esc_html__('Header Search', 'revolution'),
        'id'          => 'header_search',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle the search icon here.', 'revolution'),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Cart', 'revolution'),
        'id'          => 'header_cart',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can toggle the cart icon here.', 'revolution'),
        'std'         => 'on',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Icon Style', 'revolution' ),
        'id'          => 'mobile_menu_icon_style',
        'type'        => 'radio',
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('Style 1', 'revolution'),
        	  'value'       => 'style1'
        	),
          array(
            'label'       => esc_html__('Style 2', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Style 3', 'revolution'),
            'value'       => 'style3'
          ),
        ),
        'std'         => 'style1',
        'desc'        => esc_html__('You can select a different icon for your mobile menu here.', 'revolution' ),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Icon "MENU" label', 'revolution'),
        'id'          => 'mobile_menu_text',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display "Menu" Text next to mobile menu icon?', 'revolution'),
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Button', 'revolution'),
        'id'          => 'header_button',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can add a Call to Action button to your header.', 'revolution'),
        'std'         => 'off',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Button Text', 'revolution' ),
        'id'          => 'header_button_text',
        'type'        => 'text',
        'desc'        => esc_html__('Call-to-Action Button Text', 'revolution' ),
        'section'     => 'header',
        'std' 				=> esc_html__('Get the App', 'revolution'),
        'condition'   => 'header_button:is(on)'
      ),
      array(
        'label'       => esc_html__('Button Link', 'revolution' ),
        'id'          => 'header_action_button_link',
        'type'        => 'text',
        'desc'        => esc_html__('Call-to-Action Button link', 'revolution' ),
        'section'     => 'header',
        'std' 				=> esc_html__('https://themeforest.net/item/revolution-creative-portfolio-theme/17870799?ref=fuelthemes', 'revolution'),
        'condition'   => 'header_button:is(on)'
      ),
      array(
        'label'       => esc_html__('Button Style', 'revolution' ),
        'id'          => 'header_button_style',
        'type'        => 'radio',
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('Style - 1', 'revolution'),
        	  'value'       => 'style1'
        	),
          array(
            'label'       => esc_html__('Style - 2', 'revolution'),
            'value'       => 'style2'
          ),
          array(
            'label'       => esc_html__('Style - 3', 'revolution'),
            'value'       => 'style3'
          )
        ),
        'std'         => 'style1',
        'desc'        => esc_html__('Call-to-Action Button Style', 'revolution' ),
        'section'     => 'header',
        'condition'   => 'header_button:is(on)'
      ),
      array(
        'label'       => esc_html__('Button Border Radius', 'revolution' ),
        'id'          => 'header_button_radius',
        'type'        => 'radio',
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('No Radius', 'revolution'),
        	  'value'       => 'no-radius'
        	),
          array(
            'label'       => esc_html__('Small Radius', 'revolution'),
            'value'       => 'small-radius'
          ),
          array(
            'label'       => esc_html__('Pill Radius', 'revolution'),
            'value'       => 'pill-radius'
          )
        ),
        'std'         => 'no-radius',
        'desc'        => esc_html__('Call-to-Action Button Border Radius', 'revolution' ),
        'section'     => 'header',
        'condition'   => 'header_button:is(on)'
      ),
      array(
        'label'       => esc_html__('Button Color', 'revolution' ),
        'id'          => 'header_button_color',
        'type'        => 'radio',
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('Black', 'revolution'),
        	  'value'       => ''
        	),
          array(
            'label'       => esc_html__('White', 'revolution'),
            'value'       => 'white'
          ),
          array(
            'label'       => esc_html__('Accent', 'revolution'),
            'value'       => 'accent'
          )
        ),
        'std'         => 'white',
        'desc'        => esc_html__('Call-to-Action Button Color', 'revolution' ),
        'section'     => 'header',
        'condition'   => 'header_button:is(on)'
      ),
      array(
        'label'       => esc_html__('Secondary Menu Social Links', 'revolution' ),
        'id'          => 'secondarymenu_social_link',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links inside secondary area here.', 'revolution' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab3',
        'label'       => esc_html__('Mobile Menu Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      
      array(
        'label'       => esc_html__('Mobile Menu Style', 'revolution'),
        'id'          => 'mobile_menu_style',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose your mobile menu style here', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Style 1 (Half-page)', 'revolution'),
            'value'       => 'style1'
          ),
          array(
            'label'       => esc_html__('Style 2 (Full Screen)', 'revolution'),
            'value'       => 'style2'
          )
        ),
        'std'         => 'style1',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Submenu Behaviour', 'revolution'),
        'id'          => 'submenu_behaviour',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose how your arrows signs work', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Default - Clickable parent links', 'revolution'),
            'value'       => 'thb-default'
          ),
          array(
            'label'       => esc_html__('Open Submenu - Parent links open submenus', 'revolution'),
            'value'       => 'thb-submenu'
          )
        ),
        'std'         => 'thb-submenu',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Color', 'revolution'),
        'id'          => 'mobile_menu_color',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose your mobile menu color here.', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'revolution'),
            'value'       => 'light'
          ),
          array(
            'label'       => esc_html__('Dark', 'revolution'),
            'value'       => 'dark'
          )
        ),
        'std'         => 'light',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Footer', 'revolution'),
        'id'          => 'mobile_menu_footer',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears at the bottom of the menu. You can use your shortcodes here.', 'revolution'),
        'rows'        => '4',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Social Links', 'revolution' ),
        'id'          => 'mobile_menu_social_link',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links next to the mobile menu here', 'revolution' ),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab4',
        'label'       => esc_html__('Logo Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Logo Height', 'revolution'),
        'id'          => 'logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside header', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Logo Height', 'revolution'),
        'id'          => 'logo_height_mobile',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the logo height for the mobile screens.', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Dark Logo Upload (black)', 'revolution'),
        'id'          => 'logo',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double the size you set above.</strong>', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Light Logo Upload (white)', 'revolution'),
        'id'          => 'logo_light',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own logo here. Since this theme is retina-ready, <strong>please upload a double the size you set above.</strong>', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'id'          => 'header_tab5',
        'label'       => esc_html__('Measurements', 'revolution'),
        'type'        => 'tab',
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Header Padding', 'revolution'),
        'id'          => 'header_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__('This affects header on large screens. The values are in px.', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Fixed Header Padding', 'revolution'),
        'id'          => 'header_padding_fixed',
        'type'        => 'spacing',
        'desc'        => esc_html__('This affects the fixed header on large screens. The values are in px.', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'label'       => esc_html__('Mobile Header Padding', 'revolution'),
        'id'          => 'header_padding_mobile',
        'type'        => 'spacing',
        'desc'        => esc_html__('This affects header on mobile screens for both regular and fixed versions.', 'revolution'),
        'section'     => 'header'
      ),
      array(
        'id'          => 'footer_tab0',
        'label'       => esc_html__('Footer Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Footer', 'revolution'),
        'id'          => 'footer',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer?', 'revolution'),
        'std'         => 'on',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Effect', 'revolution'),
        'id'          => 'footer_effect',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to use the fold effect? This also affects the sub-footer', 'revolution'),
        'std'         => 'off',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Shadow', 'revolution'),
        'id'          => 'footer_shadow',
        'type'        => 'radio',
        'desc'        => esc_html__('You can change the footer shadow here', 'revolution'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('None', 'revolution'),
        	  'value'       => 'none'
        	),
          array(
            'label'       => esc_html__('Light', 'revolution'),
            'value'       => 'light'
          ),
          array(
            'label'       => esc_html__('Heavy', 'revolution'),
            'value'       => 'heavy'
          )
        ),
        'std'         => 'heavy',
        'section'     => 'footer',
        'condition'   => 'footer_effect:is(on)'
      ),
      array(
        'label'       => esc_html__('Display Footer Logo?', 'revolution'),
        'id'          => 'footer_logo',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer Logo on top of widgets?', 'revolution'),
        'std'         => 'off',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Logo Upload', 'revolution'),
        'id'          => 'footer_logo_upload',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own footer logo here. Since this theme is retina-ready, <strong>please upload a double the size you set below.</strong>', 'revolution'),
        'section'     => 'footer',
        'condition'		=> 'footer_logo:is(on)'
      ),
      array(
        'label'       => esc_html__('Footer Logo Height', 'revolution'),
        'id'          => 'footer_logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the footer logo height from here. This is maximum height, so your logo may get smaller depending on spacing inside footer', 'revolution'),
        'section'     => 'footer',
        'condition'		=> 'footer_logo:is(on)'
      ),
      array(
        'label'       => esc_html__('Footer Top Content', 'revolution'),
        'id'          => 'footer_top_content',
        'type'        => 'page-select',
        'desc'        => esc_html__('This allows you to add contents of a page inside the footer.', 'revolution'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Columns', 'revolution'),
        'id'          => 'footer_columns',
        'type'        => 'radio-image',
        'desc'        => esc_html__('You can change the layout of footer columns here', 'revolution'),
        'std'         => 'threecolumns',
        'section'     => 'footer',
      ),
      array(
        'label'       => esc_html__('Footer Color', 'revolution'),
        'id'          => 'footer_color',
        'type'        => 'radio',
        'desc'        => esc_html__('You can choose your footer color here. You can also change your footer background from "Customization"', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Light', 'revolution'),
            'value'       => 'light'
          ),
          array(
            'label'       => esc_html__('Dark', 'revolution'),
            'value'       => 'dark'
          )
        ),
        'std'         => 'light',
        'section'     => 'footer',
      ),
      array(
        'id'          => 'footer_tab2',
        'label'       => esc_html__('Sub-Footer Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Sub-Footer', 'revolution'),
        'id'          => 'subfooter',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Sub-Footer?', 'revolution'),
        'std'         => 'off',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Style', 'revolution'),
        'id'          => 'subfooter_style',
        'type'        => 'radio-image',
        'desc'        => esc_html__('Which subfooter style would you like to use?', 'revolution'),
        'std'         => 'style1',
        'section'	  	=> 'footer'
      ),
      array(
        'label'       => esc_html__('Display Sub-Footer Logo?', 'revolution'),
        'id'          => 'subfooter_logo',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Subfooter Logo?', 'revolution'),
        'std'         => 'off',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Logo', 'revolution'),
        'id'          => 'subfooter_logo_upload',
        'type'        => 'upload',
        'desc'        => esc_html__('You can upload your own subfooter logo here. Since this theme is retina-ready, <strong>please upload a double size image.</strong>', 'revolution'),
        'section'     => 'footer',
        'condition'		=> 'subfooter_logo:is(on)'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Logo Height', 'revolution'),
        'id'          => 'subfooter_logo_height',
        'type'        => 'measurement',
        'desc'        => esc_html__('You can modify the subfooter logo height from here. This is maximum height, so your logo may get smaller depending on screen size', 'revolution'),
        'section'     => 'footer',
        'condition'		=> 'subfooter_logo:is(on)'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Menu', 'revolution'),
        'id'          => 'subfooter_menu',
        'type'        => 'menu_select',
        'desc'        => esc_html__('Menu to be displayed on the subfooter', 'revolution' ),
        'section'     => 'footer',
        'operator' 		=> 'or',
        'condition'		=> 'subfooter_style:is(style2),subfooter_style:is(style3)'
        
      ),
      array(
        'label'       => esc_html__('Sub-Footer Text', 'revolution' ),
        'id'          => 'subfooter_text',
        'type'        => 'textarea',
        'desc'        => esc_html__('Text Content to be displayed on the subfooter', 'revolution' ),
        'section'     => 'footer',
        'std' 				=> esc_html__('&copy; 2018 Revolution', 'revolution'),
        'operator' 		=> 'or',
        'condition'		=> 'subfooter_style:is(style1),subfooter_style:is(style3)'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Social Links', 'revolution' ),
        'id'          => 'subfooter_social_link',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links for the subfooter here', 'revolution' ),
        'section'     => 'footer',
        'operator' 		=> 'or',
        'condition'		=> 'subfooter_style:is(style1),subfooter_style:is(style2)'
      ),
      array(
        'label'       => esc_html__('Payment Icons to display', 'revolution'),
        'id'          => 'footer_payment_icons',
        'type'        => 'list-item',
        'desc'        => esc_html__('Add your desired Payment Icons for the footer here', 'revolution'),
        'settings'    => array(
          array(
            'label'       => esc_html__('Payment Type', 'revolution'),
            'id'          => 'payment_type',
            'type'        => 'select',
            'choices'     => array(
          		array(
          			'label'       => 'Visa',
          			'value'       => 'payment_visa'
          		),
          		array(
          			'label'       => 'MasterCard',
          			'value'       => 'payment_mc'
          		),
          		array(
          			'label'       => 'PayPal',
          			'value'       => 'payment_pp'
          		),
          		array(
          			'label'       => 'Discover',
          			'value'       => 'payment_discover'
          		),
          		array(
          			'label'       => 'Amazon Payments',
          			'value'       => 'payment_amazon'
          		),
          		array(
          			'label'       => 'Stripe',
          			'value'       => 'payment_stripe'
          		),
          		array(
          			'label'       => 'American Express',
          			'value'       => 'payment_amex'
          		),
          		array(
          			'label'       => 'Diners Club',
          			'value'       => 'payment_diners'
          		),
          		array(
          			'label'       => 'Google Wallet',
          			'value'       => 'payment_wallet'
          		)
            )
          )
        ),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'footer_tab3',
        'label'       => esc_html__('Footer Bar', 'revolution'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Display Footer Bar', 'revolution'),
        'id'          => 'footer_bar',
        'type'        => 'on_off',
        'desc'        => esc_html__('Would you like to display the Footer Bar?', 'revolution'),
        'std'         => 'off',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Bar Style', 'revolution'),
        'id'          => 'footer_bar_style',
        'type'        => 'radio-image',
        'desc'        => esc_html__('Which footer bar style would you like to use?', 'revolution'),
        'std'         => 'style1',
        'section'	  	=> 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Bar Menu', 'revolution'),
        'id'          => 'footer_bar_menu',
        'type'        => 'menu_select',
        'desc'        => esc_html__('Select menu to be displayed inside the footer bar.', 'revolution' ),
        'section'     => 'footer',
      ),
      array(
        'label'       => esc_html__('Footer Bar Social Links', 'revolution' ),
        'id'          => 'footer_bar_social_link',
        'type'        => 'social-links',
        'desc'        => esc_html__('Add your desired Social Links next to the footer bar here', 'revolution' ),
        'section'     => 'footer',
        'cond'				=> 'footer_bar_style:is(style1)'
      ),
      array(
        'label'       => esc_html__('Footer Bar Text Content','revolution'),
        'id'          => 'footer_bar_content',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears on the left side of footer bar.','revolution'),
        'rows'        => '4',
        'section'     => 'footer',
        'cond'				=> 'footer_bar_style:is(style2)'
      ),
      array(
        'id'          => 'footer_tab4',
        'label'       => esc_html__('Measurements', 'revolution'),
        'type'        => 'tab',
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Padding', 'revolution'),
        'id'          => 'footer_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__('You can modify the footer padding here', 'revolution'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Sub-Footer Padding', 'revolution'),
        'id'          => 'subfooter_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__('You can modify the subfooter padding here', 'revolution'),
        'section'     => 'footer'
      ),
      array(
        'label'       => esc_html__('Footer Bar Padding', 'revolution'),
        'id'          => 'footerbar_padding',
        'type'        => 'spacing',
        'desc'        => esc_html__('You can modify the footer bar padding here', 'revolution'),
        'section'     => 'footer'
      ),
      array(
        'id'          => 'misc_tab0',
        'label'       => esc_html__('General', 'revolution'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Google Maps API Key', 'revolution'),
        'id'          => 'map_api_key',
        'type'        => 'text',
        'desc'        => esc_html__('Please enter the Google Maps Api Key. <small>You need to create a browser API key. For more information, please visit: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key">https://developers.google.com/maps/documentation/javascript/get-api-key</a></small>', 'revolution'),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Scroll To Top?', 'revolution'),
        'id'          => 'scroll_to_top',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can enable the Scroll To Top button here', 'revolution'),
        'std'         => 'on',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Extra CSS', 'revolution'),
        'id'          => 'extra_css',
        'type'        => 'css',
        'desc'        => esc_html__('Any CSS that you would like to add to the theme.', 'revolution'),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab1',
        'label'       => esc_html__('Instagram Settings', 'revolution'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Instagram ID', 'revolution' ),
        'id'          => 'instagram_id',
        'type'        => 'text',
        'desc'        => sprintf(esc_html__('Your Instagram ID, you can find your ID from here: %1$shttp://www.otzberg.net/iguserid/%2$s', 'revolution' ),
        	'<a href="http://www.otzberg.net/iguserid/">',
        	'</a>'
        	),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Instagram Username', 'revolution' ),
        'id'          => 'instagram_username',
        'type'        => 'text',
        'desc'        => esc_html__('Your Instagram Username', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token', 'revolution' ),
        'id'          => 'instagram_accesstoken',
        'type'        => 'text',
        'desc'        => sprintf(esc_html__('Visit %1$sthis link%2$s in a new tab, sign in with your Instagram account, click on Create a new application and create your own keys in case you dont have already. After that, you can get your Access Token using %3$shttp://instagram.pixelunion.net/%4$s', 'revolution' ),
        	'<a href="http://instagr.am/developer/register/" target="_blank">',
        	'</a>',
        	'<a href="http://instagram.pixelunion.net/" target="_blank">',
        	'</a>'
        	),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab2',
        'label'       => esc_html__('Twitter Settings', 'revolution' ),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'twitter_text',
        'label'       => esc_html__('About the Twitter Settings', 'revolution' ),
        'desc'        => esc_html__('You should fill out these settings if you want to use the Twitter related widgets or Visual Composer Elements', 'revolution' ),
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Twitter Sharing Cache', 'revolution'),
        'id'          => 'twitter_cache',
        'type'        => 'select',
        'desc'        => esc_html__('Amount of time before the new tweets are fetched.', 'revolution'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('1 Hour', 'revolution'),
        	  'value'       => '1h'
        	),
          array(
            'label'       => esc_html__('1 Day', 'revolution'),
            'value'       => '1'
          ),
          array(
            'label'       => esc_html__('7 Days', 'revolution'),
            'value'       => '7'
          ),
          array(
            'label'       => esc_html__('30 Days', 'revolution'),
            'value'       => '30'
          )
        ),
        'std'         => '1',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Twitter Username', 'revolution' ),
        'id'          => 'twitter_bar_username',
        'type'        => 'text',
        'desc'        => esc_html__('Username to pull tweets for', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Consumer Key', 'revolution' ),
        'id'          => 'twitter_bar_consumerkey',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps" target="_blank">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Consumer Secret', 'revolution' ),
        'id'          => 'twitter_bar_consumersecret',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps" target="_blank">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token', 'revolution' ),
        'id'          => 'twitter_bar_accesstoken',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps" target="_blank">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Access Token Secret', 'revolution' ),
        'id'          => 'twitter_bar_accesstokensecret',
        'type'        => 'text',
        'desc'        => esc_html__('Visit <a href="https://dev.twitter.com/apps" target="_blank">this link</a> in a new tab, sign in with your account, click on Create a new application and create your own keys in case you dont have already', 'revolution' ),
        'section'     => 'misc'
      ),
      array(
        'id'          => 'misc_tab4',
        'label'       => esc_html__('Create Additional Sidebars', 'revolution'),
        'type'        => 'tab',
        'section'     => 'misc'
      ),
      array(
        'id'          => 'sidebars_text',
        'label'       => esc_html__('About the sidebars', 'revolution'),
        'desc'        => esc_html__('All sidebars that you create here will appear both in the Widgets Page(Appearance > Widgets), from where you will have to configure them, and in the pages, where you will be able to choose a sidebar for each page', 'revolution'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'misc'
      ),
      array(
        'label'       => esc_html__('Create Sidebars', 'revolution'),
        'id'          => 'sidebars',
        'type'        => 'list-item',
        'desc'        => esc_html__('Please choose a unique title for each sidebar!', 'revolution'),
        'section'     => 'misc',
        'settings'    => array(
          array(
            'label'       => esc_html__('ID', 'revolution'),
            'id'          => 'id',
            'type'        => 'text',
            'desc'        => esc_html__('Please write a lowercase id, with <strong>no spaces</strong>', 'revolution')
          )
        )
      ),
      array(
        'id'          => 'typography_tab1',
        'label'       => esc_html__('Font Families', 'revolution'),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Primary Font', 'revolution'),
        'id'          => 'primary_font',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the primary font. Affects all headings.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Secondary Font', 'revolution'),
        'id'          => 'secondary_font',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the secondary font', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('<EM> Font', 'revolution'),
        'id'          => 'em_font',
        'type'        => 'typography',
        'desc'        => esc_html__('This adds a separate font for styling of EM tags so you can add stylish typographic elements.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Button Font', 'revolution'),
        'id'          => 'button_font',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the button. Uses the Secondary Font by default.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Full Menu Font', 'revolution'),
        'id'          => 'fullmenu_font',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the full menu. Uses the Secondary Font by default.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Font', 'revolution'),
        'id'          => 'mobilemenu_font',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Family Setting for the mobile menu. Uses the Secondary Font by default.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab2',
        'label'       => esc_html__('Typography', 'revolution'),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Body Font', 'revolution'),
        'id'          => 'body_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the body.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Full Menu Font', 'revolution'),
        'id'          => 'fullmenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the full menu', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Full Menu Sub-Menu Font', 'revolution'),
        'id'          => 'fullmenu_sub_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the sub-menus inside full menu', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Full Menu Social Icons Font-size ', 'revolution'),
        'id'          => 'fullmenu_social_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting specifically for the social icons.', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Font', 'revolution'),
        'id'          => 'mobilemenu_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the mobile menu', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Sub-Menu Font', 'revolution'),
        'id'          => 'mobilemenu_sub_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the sub-menus inside mobile menu', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Secondary Mobile Menu Font', 'revolution'),
        'id'          => 'mobilemenu_secondary_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the secondary mobile menu', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Footer Font', 'revolution'),
        'id'          => 'mobilemenu_footer_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the mobile menu footer', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Widget Title Font', 'revolution'),
        'id'          => 'widget_title_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Typography Setting for the footer widget titles', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab3',
        'label'       => esc_html__('Heading Typography', 'revolution'),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'id'          => 'heading_text',
        'label'       => esc_html__('About Heading Typography', 'revolution'),
        'desc'        => esc_html__('These affect all h* tags inside the theme, so use wisely. Some particular headings may need additional css to target.', 'revolution'),
        'type'        => 'textblock',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 1', 'revolution'),
        'id'          => 'h1_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H1 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 2', 'revolution'),
        'id'          => 'h2_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H2 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 3', 'revolution'),
        'id'          => 'h3_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H3 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 4', 'revolution'),
        'id'          => 'h4_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H4 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 5', 'revolution'),
        'id'          => 'h5_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H5 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Heading 6', 'revolution'),
        'id'          => 'h6_type',
        'type'        => 'typography',
        'desc'        => esc_html__('Font Settings for the H6 tag', 'revolution'),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typography_tab4',
        'label'       => esc_html__('Font Support', 'revolution'),
        'type'        => 'tab',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Google Font Subsets', 'revolution'),
        'id'          => 'font_subsets',
        'type'        => 'radio',
        'desc'        => esc_html__('You can add additional character subset specific to your language.', 'revolution'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('No Subset', 'revolution'),
        	  'value'       => 'no-subset'
        	),
        	array(
        	  'label'       => esc_html__('Latin Extended', 'revolution'),
        	  'value'       => 'latin-ext'
        	),
          array(
            'label'       => esc_html__('Greek', 'revolution'),
            'value'       => 'greek'
          ),
          array(
            'label'       => esc_html__('Cyrillic', 'revolution'),
            'value'       => 'cyrillic'
          ),
          array(
            'label'       => esc_html__('Vietnamese', 'revolution'),
            'value'       => 'vietnamese'
          )
        ),
        'std'         => 'no-subset',
        'section'     => 'typography'
      ),
      array(
        'id'          => 'typekit_text',
        'label'       => esc_html__('About Typekit Support', 'revolution'),
        'desc'        => esc_html__('Please make sure that you enter your Typekit ID or the fonts wont work. After adding Typekit Font Names, these names will appear on the font selection dropdown on the Font Families tab.', 'revolution'),
        'std'         => '',
        'type'        => 'textblock',
        'section'     => 'typography'
      ),
      array(
        'label'       => esc_html__('Typekit Kit ID', 'revolution'),
        'id'          => 'typekit_id',
        'type'        => 'text',
        'desc'        => esc_html__('Paste the provided Typekit Kit ID. <small>Usually 6-7 random letters</small>', 'revolution'),
        'section'     => 'typography',
      ),
      array(
        'label'       => esc_html__('Typekit Font Names', 'revolution'),
        'id'          => 'typekit_fonts',
        'type'        => 'text',
        'desc'        => esc_html__('Enter your Typekit Font Name, seperated by comma. For example: futura-pt,aktiv-grotesk <strong>Do not leave spaces between commas</strong>', 'revolution'),
        'section'     => 'typography',
      ),
      array(
        'label'       => esc_html__('Self Hosted Fonts', 'revolution'),
        'id'          => 'self_hosted_fonts',
        'type'        => 'list-item',
        'settings'    => array(
        	array(
        	  'label'       => esc_html__('Font Stylesheet URL', 'revolution'),
        	  'id'          => 'font_url',
        	  'type'        => 'text',
        	  'desc'        => esc_html__('URL of the font stylesheet (.css file) you want to use.', 'revolution'),
        	  'section'     => 'typography',
        	),
        	array(
        	  'label'       => esc_html__('Font Family Names', 'revolution'),
        	  'id'          => 'font_name',
        	  'type'        => 'text',
        	  'desc'        => esc_html__('Enter your Font Family Name, use the name that will be used in css. For example: futura-pt, aktiv-grotesk. After saving, you will be able to use this name in the typography settings.', 'revolution'),
        	  'section'     => 'typography',
        	),
        ),
        'section'     => 'typography'
      ),
      array(
        'id'          => 'customization_tab1',
        'label'       => esc_html__('Backgrounds', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Header Background', 'revolution'),
        'id'          => 'header_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the header.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Fixed Header Background', 'revolution'),
        'id'          => 'fixed_header_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the fixed header.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Header - Style 1 Open Background', 'revolution'),
        'id'          => 'header_style1_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the header - style1 when it is open.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Search Background', 'revolution'),
        'id'          => 'search_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the search form.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Background', 'revolution'),
        'id'          => 'footer_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the footer', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Sub - Footer Background', 'revolution'),
        'id'          => 'subfooter_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the subfooter', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Bar Background', 'revolution'),
        'id'          => 'footerbar_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the footer bar', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Background', 'revolution'),
        'id'          => 'mobilemenu_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the Mobile Menu', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('404 Page Background', 'revolution'),
        'id'          => 'notfound_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the 404 Page', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Preloader Background', 'revolution'),
        'id'          => 'preloader_bg',
        'type'        => 'background',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('Background settings for the Preloader', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab2',
        'label'       => esc_html__('Colors', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Accent Color', 'revolution'),
        'id'          => 'accent_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can modify the accent color here, default red you see in some areas.', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Icon Color', 'revolution'),
        'id'          => 'mobile_menu_icon_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can modify the hamburger menu icon color here.', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Post Category Color', 'revolution'),
        'id'          => 'post_category_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Changes the color of the post category links.', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Widget Title Color', 'revolution'),
        'id'          => 'footer_widget_title_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can modify the footer widget title color here', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Text Color', 'revolution'),
        'id'          => 'footer_text_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can modify the footer text color here', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Sub - Footer Text Color', 'revolution'),
        'id'          => 'subfooter_text_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('You can modify the subfooter text color here', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Preloader Icon Color', 'revolution'),
        'id'          => 'preloader_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('This will change the color of the preloader icon.', 'revolution'),
        'class'				=> 'ot-colorpicker-opacity',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab3',
        'label'       => esc_html__('Link Colors', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('General Link Color', 'revolution'),
        'id'          => 'general_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('You can modify the general link color here', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Full Menu Link Color', 'revolution'),
        'id'          => 'fullmenu_link_color_dark',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('You can modify the link color of the full menu.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Link Color', 'revolution'),
        'id'          => 'mobilemenu_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('You can modify the link color of the mobile menu.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Mobile Menu Secondary Link Color', 'revolution'),
        'id'          => 'mobilemenu_secondary_link_color',
        'type'        => 'link_color',
        'desc'        => esc_html__('You can modify the link color of the secondary mobile menu.', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Footer Link Color', 'revolution'),
        'id'          => 'footer_link_color',
        'type'        => 'link_color',
        'class'				=> 'ot-colorpicker-opacity',
        'desc'        => esc_html__('You can modify the footer link color here', 'revolution'),
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab4',
        'label'       => esc_html__('Page Transition', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Page Transition', 'revolution'),
        'id'          => 'page_transition',
        'type'        => 'on_off',
        'desc'        => esc_html__('This will enable an animation between loading your pages.', 'revolution'),
        'std'         => 'on',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Page Transition Style', 'revolution'),
        'id'          => 'page_transition_style',
        'type'        => 'select',
        'desc'        => esc_html__('Select the effect you want to use for page transition', 'revolution'),
        'choices'     => array(
        	array(
        	  'label'       => esc_html__('Fade', 'revolution'),
        	  'value'       => 'thb-fade'
        	),
          array(
            'label'       => esc_html__('Fade Up', 'revolution'),
            'value'       => 'thb-fade-up'
          ),
          array(
            'label'       => esc_html__('Fade Down', 'revolution'),
            'value'       => 'thb-fade-down'
          )
        ),
        'std'         => 'thb-fade',
        'section'     => 'customization'
      ),
      array(
      	'label'       => esc_html__('Fade In Speed', 'revolution' ),
        'id'          => 'page_transition_in_speed',
        'std'         => '1000',
        'type'        => 'numeric-slider',
        'section'     => 'customization',
        'min_max_step'=> '100,3000,50',
        'desc'        => esc_html__('The speed of the animation in milisecconds.', 'revolution'),
      ),
      array(
      	'label'       => esc_html__('Fade Out Speed', 'revolution' ),
        'id'          => 'page_transition_out_speed',
        'std'         => '500',
        'type'        => 'numeric-slider',
        'section'     => 'customization',
        'min_max_step'=> '100,3000,50',
        'desc'        => esc_html__('The speed of the animation in milisecconds.', 'revolution'),
      ),
      array(
        'id'          => 'customization_tab5',
        'label'       => esc_html__('Preloader / Lazy Load', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Preloading Type', 'revolution' ),
        'id'          => 'thb_preload_type',
        'type'        => 'radio',
        'desc'        => esc_html__('This is the hexagon preloader you see on some areas.', 'revolution'),
        'choices'     => array(
          array(
            'label'       => esc_html__('Full-Screen Preloader', 'revolution'),
            'value'       => 'preloader'
          ),
          array(
            'label'       => esc_html__('Lazy Load Images', 'revolution'),
            'value'       => 'lazyload'
          ),
          array(
            'label'       => esc_html__('No Preloader', 'revolution'),
            'value'       => 'none'
          )
        ),
        'std'         => 'preloader',
        'section'     => 'customization'
      ),
      array(
        'id'          => 'customization_tab6',
        'label'       => esc_html__('Other', 'revolution'),
        'type'        => 'tab',
        'section'     => 'customization'
      ),
      array(
        'label'       => esc_html__('Right Click Protection','revolution'),
        'id'          => 'right_click',
        'type'        => 'on_off',
        'desc'        => esc_html__('You can disable right click here.','revolution'),
        'section'     => 'customization',
        'std'         => 'on'
      ),
      array(
        'label'       => esc_html__('Right Click Text Content','revolution'),
        'id'          => 'right_click_content',
        'type'        => 'textarea',
        'desc'        => esc_html__('This content appears inside the right click protection overlay.','revolution'),
        'rows'        => '4',
        'section'     => 'customization',
        'cond'				=> 'right_click:is(on)'
      ),
      array(
        'label'       => esc_html__('Google Theme Color', 'revolution'),
        'id'          => 'thb_google_theme_color',
        'type'        => 'colorpicker',
        'desc'        => esc_html__('Applied only on Android mobile devices, click <a href="https://developers.google.com/web/updates/2014/11/Support-for-theme-color-in-Chrome-39-for-Android" target="_blank">here</a> to learn more about this', 'revolution'),
        'section'     => 'customization'
      )
    )
  );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
}

/**
 * Gradient option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 * @updated   2.2.0
 */
if ( ! function_exists( 'ot_type_gradient' ) ) {
  
  function ot_type_gradient( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-colorpicker ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . wp_specialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">'; 

        /* build colorpicker */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          $field_id_1 = $field_id.'_1';
          $field_name_1 = $field_name.'[0]';
          $field_value_1 = isset($field_value[0]) ? $field_value[0] : '';
          /* colorpicker JS */      
          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id_1 ) . '"); });</script>';
          
          /* input */
          echo '<input type="text" name="'.esc_attr($field_name_1).'" id="' . esc_attr( $field_id_1 ) . '" value="' . esc_attr( $field_value_1 ) . '" class="hide-color-picker ot-colorpicker-opacity ' . esc_attr( $field_class ) . '" />';
        
        echo '</div>';
        
        /* build colorpicker 2 */  
        echo '<div class="option-tree-ui-colorpicker-input-wrap">';
          
          $field_id_2 = $field_id.'_2';
          $field_name_2 = $field_name.'[1]';
          $field_value_2 = isset($field_value[1]) ? $field_value[1] : '';
          /* colorpicker JS */      
          echo '<script>jQuery(document).ready(function($) { OT_UI.bind_colorpicker("' . esc_attr( $field_id_2 ) . '"); });</script>';
          
          /* input */
          echo '<input type="text" name="'.esc_attr($field_name_2).'" id="' . esc_attr( $field_id_2 ) . '" value="' . esc_attr( $field_value_2 ) . '" class="hide-color-picker ot-colorpicker-opacity ' . esc_attr( $field_class ) . '" />';
        
        echo '</div>';
      
      echo '</div>';

    echo '</div>';
    
  }
  
}

/**
 * Menu Select option type.
 *
 * See @ot_display_by_type to see the full list of available arguments.
 *
 * @param     array     An array of arguments.
 * @return    string
 *
 * @access    public
 * @since     2.0
 */
if ( ! function_exists( 'ot_type_menu_select' ) ) {
  
  function ot_type_menu_select( $args = array() ) {
    
    /* turns arguments array into variables */
    extract( $args );
    
    /* verify a description */
    $has_desc = $field_desc ? true : false;
    
    /* format setting outer wrapper */
    echo '<div class="format-setting type-category-select ' . ( $has_desc ? 'has-desc' : 'no-desc' ) . '">';
      
      /* description */
      echo $has_desc ? '<div class="description">' . wp_specialchars_decode( $field_desc ) . '</div>' : '';
      
      /* format setting inner wrapper */
      echo '<div class="format-setting-inner">';
      
        /* build category */
        echo '<select name="' . esc_attr( $field_name ) . '" id="' . esc_attr( $field_id ) . '" class="option-tree-ui-select ' . $field_class . '">';
        
        /* get category array */
        $menus = get_terms( 'nav_menu');
        
        /* has cats */
        if ( ! empty( $menus ) ) {
          echo '<option value="">-- ' . esc_html__( 'Choose One', 'revolution' ) . ' --</option>';
          foreach ( $menus as $menu ) {
            echo '<option value="' . esc_attr( $menu->slug ) . '"' . selected( $field_value, $menu->slug, false ) . '>' . esc_attr( $menu->name ) . '</option>';
          }
        } else {
          echo '<option value="">' . esc_html__( 'No Menus Found', 'revolution' ) . '</option>';
        }
        
        echo '</select>';
      
      echo '</div>';
    
    echo '</div>';
    
  }
  
}