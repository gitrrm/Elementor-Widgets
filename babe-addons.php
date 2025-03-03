<?php
/**
 * Plugin Name: Babe Addons
 * Description: A collection of custom addons for Elementor.
 * Version: 1.0.0
 * Author: Rashmi
 * License: GPL2
 * Text Domain: babe-addons
 * Domain Path: /languages
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define plugin constants.
define( 'BABE_ADDONS_VERSION', '1.0.0' );
define( 'BABE_ADDONS_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BABE_ADDONS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Load plugin text domain for translations.
function babe_addons_load_textdomain() {
    load_plugin_textdomain( 'babe-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'babe_addons_load_textdomain' );

// Check if Elementor is active
function babe_addons_check_elementor() {
    // Check if Elementor is installed and active
    if ( ! did_action( 'elementor/loaded' ) ) {
        // Display admin notice
        add_action( 'admin_notices', 'babe_addons_elementor_not_installed_notice' );

        // Deactivate the plugin if in admin context
        if ( is_admin() ) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
            deactivate_plugins( plugin_basename( __FILE__ ) );
        }

        // Prevent further execution
        return false;
    }
    return true;
}

// Display admin notice if Elementor is not installed
function babe_addons_elementor_not_installed_notice() {
    ?>
    <div class="notice notice-error">
        <p><?php esc_html_e( 'Babe Addons requires Elementor to be installed and activated.', 'babe-addons' ); ?></p>
    </div>
    <?php
}

// Hook into the 'plugins_loaded' action to check for Elementor
add_action( 'plugins_loaded', 'babe_addons_check_elementor' );

// Include necessary files for the plugin only if Elementor is active
function babe_addons_init() {
    if ( babe_addons_check_elementor() ) {
        // Include the widget classes
        function register_babe_addons_widgets( $widgets_manager ) {
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-site-logo.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-social-icons.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-testimonial-widget.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-simple-tab.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/team-members.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-featured-slider-two.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/scrolling-text.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-scrolling-posts.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/insights-blog-slider.php' ); 
            // require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-tab-content-widget.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/blog-grid.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-post-slider.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/team-tabs-vertical.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/service-tab-slider.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-post-grid.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-clients.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-banner-fullscreen.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/services-circle-widget.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-image-gallery-slider.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-masnory-gallery.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/work-masonry-widget.php' ); 
            // require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-portfolio-grid.php' ); 
            require_once( BABE_ADDONS_PLUGIN_DIR . 'includes/widgets/babe-portfolios-widget.php' ); 

            // register widgets
            $widgets_manager->register( new \Babe_Site_Logo_Widget() ); 
            $widgets_manager->register( new \Babe_Social_Icons_Widget() ); 
            $widgets_manager->register( new \Testimonial_Widget() ); 
            $widgets_manager->register( new \Babe_Simple_Tabs() ); 
            $widgets_manager->register( new \Team_Members() ); 
            $widgets_manager->register( new \Feature_Slider_Two() ); 
            $widgets_manager->register( new \Babe_Scrolling_Text() ); 
            $widgets_manager->register( new \Babe_Scrolling_posts() ); 
            $widgets_manager->register( new \Insights_Blog_Slider() ); 
            // $widgets_manager->register( new \Babe_Tab_Content_Widget() ); 
            $widgets_manager->register( new \Babe_Blog_Grid() ); 
            $widgets_manager->register( new \Babe_Post_Slider() ); 
            $widgets_manager->register( new \Babe_Team_Tabs_Vertical() ); 
            $widgets_manager->register( new \Service_Tab_Slider() ); 
            $widgets_manager->register( new \Babe_Post_Grid_Widget() ); 
            $widgets_manager->register( new \Babe_Clients_Widget() ); 
            $widgets_manager->register( new \Babe_Banner_Fullscreen_Widget() ); 
            $widgets_manager->register( new \Services_Circle_Widget() ); 
            $widgets_manager->register( new \Babe_Image_Gallery_Widget() ); 
            $widgets_manager->register( new \Babe_Masonry_Gallery() ); 
            $widgets_manager->register( new \Work_Masonry_Widget() ); 
            // $widgets_manager->register( new \Babe_Portfolio_Grid_Widget() ); 
            $widgets_manager->register( new \Babe_Portfolios_Widget() ); 
        }
        add_action( 'elementor/widgets/register', 'register_babe_addons_widgets' );

        // Add Elementor widget categories
        function add_babe_addons_widget_categories( $elements_manager ) {
            $elements_manager->add_category(
                'babe_addons',
                [
                    'title' => __( 'Babe Addons', 'babe-addons' ),
                    'icon' => 'fa fa-plug',
                    'priority' => 10,
                ]
            );
        }
        add_action( 'elementor/elements/categories_registered', 'add_babe_addons_widget_categories' );

        // Include Elementor widget files

        function babe_addons_enqueue_scripts() {
            wp_enqueue_style( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/css/owl.carousel.min.css' );
            wp_enqueue_style( 'owl-carousel-theme', plugin_dir_url( __FILE__ ) . 'assets/css/owl.theme.default.min.css' );
            wp_enqueue_style( 'swiper-style', plugin_dir_url( __FILE__ ) . 'assets/css/swiper-bundle.min.css' );
            wp_enqueue_style( 'babe-hero-scroll-slider', plugin_dir_url( __FILE__ ) . 'assets/css/babe-hero-scroll-slider.css' );
            wp_enqueue_style( 'glightbox', plugin_dir_url( __FILE__ ) . 'assets/css/glightbox.min.css' );
            wp_enqueue_style( 'all-widget-styles', plugin_dir_url( __FILE__ ) . 'assets/css/all-widget-styles.css' );

            // Add Script files
            wp_enqueue_script( 'owl-carousel', plugin_dir_url( __FILE__ ) . 'assets/js/owl.carousel.min.js', array('jquery'), null, false );
            wp_enqueue_script( 'swiper-script', plugin_dir_url( __FILE__ ) . 'assets/js/swiper-bundle.min.js', [], null, false );
            wp_enqueue_script( 'glightbox', plugin_dir_url( __FILE__ ) . 'assets/js/glightbox.min.js', ['jquery'], null, true );
            // Enqueue Font Awesome styles
            if( ! wp_style_is( 'font-awesome-style', 'enqueued' ) ){
                wp_enqueue_style(
                    'addon-font-awesome-style',
                    plugin_dir_url( __FILE__ ) . 'assets/css/fa-all.min.css',
                    array(),
                    '5.1.3'
                );
            }
            wp_enqueue_script( 'babe-team-larger-script', plugin_dir_url( __FILE__ ) . 'assets/js/babe-team-larger.js', array('jquery', 'owl-carousel'), null, true ); // Check if it used in the team widget or not
        }
        add_action( 'wp_enqueue_scripts', 'babe_addons_enqueue_scripts' );

        function get_post_type_categories_callback() {
            if ( ! isset($_POST['post_type']) ) {
                wp_send_json_error('Post type not set');
                return;
            }
            if ( ! isset($_POST['nonce']) || ! wp_verify_nonce($_POST['nonce'], 'babe_nonce') ) {
                wp_send_json_error('Nonce verification failed');
                return;
            }

            $post_type = sanitize_text_field($_POST['post_type']);
            
            // Log the received post type
            error_log("Received post type: " . $post_type);

            // Determine the taxonomy based on the post type
            $taxonomy = 'portfolio_category'; // Default taxonomy for portfolio

            // Add more mappings here if needed
            if ($post_type === 'post') {
                $taxonomy = 'category'; // Default taxonomy for posts
            }

            $categories = get_terms([
                'taxonomy' => $taxonomy,
                'hide_empty' => false,
            ]);

            if (!is_wp_error($categories)) {
                $data = [];
                foreach ($categories as $category) {
                    $data[$category->term_id] = $category->name; // Use term_id for value
                }
                error_log(print_r($data, true)); // Log the categories
                wp_send_json_success($data);
            } else {
                wp_send_json_error('Error fetching categories');
            }
        }

        // Register AJAX action hooks
        add_action('wp_ajax_get_post_type_categories', 'get_post_type_categories_callback');
        add_action('wp_ajax_nopriv_get_post_type_categories', 'get_post_type_categories_callback');

        add_action( 'elementor/editor/after_enqueue_scripts', function() {
            wp_enqueue_script( 'custom-elementor-control', plugin_dir_url( __FILE__ ) . 'assets/js/custom-elementor-control.js', ['jquery'], '1.0', true );

            // Pass AJAX URL to JavaScript
            wp_localize_script('custom-elementor-control', 'ajax_object', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'nonce' => wp_create_nonce('babe_nonce'), // Create nonce
            ]);
        });

        add_action('wp_footer', function() {
            ?>
            <script>
                jQuery(document).ready(function($) {
                    // Assuming you have the options already populated in the 'sub_category' control
                    $('#your_widget_id .elementor-control-post_type select').change(function() {
                        var postType = $(this).val();
                        var subCategorySelect = $('#your_widget_id .elementor-control-sub_category select');
                        
                        // Clear previous options
                        subCategorySelect.empty();
                        
                        // AJAX request to get subcategories based on the selected post type
                        $.ajax({
                            url: ajax_object.ajax_url,
                            type: 'POST',
                            data: {
                                action: 'get_subcategories',
                                post_type: postType,
                                nonce: ajax_object.nonce
                            },
                            success: function(response) {
                                // Populate the subcategory dropdown
                                $.each(response.data, function(index, value) {
                                    subCategorySelect.append('<option value="' + index + '">' + value + '</option>');
                                });
                            }
                        });
                    });
                });
            </script>
            <?php
        });
    }
}
add_action( 'plugins_loaded', 'babe_addons_init' );