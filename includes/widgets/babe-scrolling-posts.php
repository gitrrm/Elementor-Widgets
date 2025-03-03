<?php
use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

// Define the widget class
class Babe_Scrolling_posts extends Widget_Base
{

    // Return the widget name
    public function get_name()
    {
        return 'babe_scrolling_posts'; // Widget slug
    }

    // Return the widget title
    public function get_title()
    {
        return __('Scrolling Posts', 'babe-addons'); // Display name for the widget
    }

    // Return the widget icon (used in the Elementor interface)
    public function get_icon()
    {
        return 'eicon-form-vertical'; // Elementor icon for the widget
    }

    // Return the widget category
    public function get_categories()
    {
        return ['babe_addons']; // Assign the widget to a custom category
    }

    // Register the required JavaScript dependencies
    public function get_script_depends()
    {
        return ['swiper-js']; // Swiper.js script dependency for slider functionality
    }

    // Register the required CSS dependencies
    public function get_style_depends()
    {
        return ['swiper-css']; // Swiper CSS dependency for styling the slider
    }

    // Register the widget controls
    protected function register_controls()
    {
        // Define the section for widget settings in Elementor
        $this->start_controls_section(
            'scrolling_posts_section',
            [
                'label' => __('Scrolling Posts Setting', 'babe-addons'), // Section label
                'tab' => Controls_Manager::TAB_CONTENT, // Content tab in Elementor
            ]
        );

        // Fetch all available post types
        $post_types = get_post_types(['public' => true], 'objects'); // Get public post types
        $post_type_options = [];
        foreach ($post_types as $post_type) {
            $post_type_options[$post_type->name] = $post_type->label; // Store post types in options array
        }

        // Control for selecting post types
        $this->add_control(
            'scrolling_posts_type',
            [
                'label' => __('Select Post Type', 'babe-addons'), // Label for the post type control
                'type' => Controls_Manager::SELECT2, // Control type: select dropdown
                'options' => $post_type_options, // Available post types as options
                'default' => 'post', // Default post type
                'multiple' => false, // Single selection
            ]
        );

        // Control for the number of posts to display
        $this->add_control(
            'scrolling_number_of_posts',
            [
                'label' => __('Number of Posts', 'babe-addons'), // Label for number of posts
                'type' => Controls_Manager::NUMBER, // Control type: number input
                'default' => 6, // Default number of posts
                'min' => -1, // Minimum posts (-1 for unlimited)
                'max' => 100, // Maximum posts
                'step' => 1, // Step for number input
                'description' => 'Set the number of posts to display.', // Additional description
            ]
        );
        // Add control for space between items
        $this->add_control(
            'space_between_items',
            [
                'label' => __( 'Space Between Items', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .posts-item' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Show Number of Items on screen
        $this->add_control(
			'number_of_items',
			[
				'label' => esc_html__( 'Number of items to display on screen', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => '4',
				'options' => [
					// '' => esc_html__( 'Default', 'babe-addons' ),
					'1'  => esc_html__( '1', 'babe-addons' ),
					'2' => esc_html__( '2', 'babe-addons' ),
					'3' => esc_html__( '3', 'babe-addons' ),
					'4' => esc_html__( '4', 'babe-addons' ),
				],
			]
		);
        // Featured Image Height
        $this->add_control(
			'featured_image_height',
			[
				'type' => \Elementor\Controls_Manager::SLIDER,
				'label' => esc_html__( 'Featured Image Height', 'babe-addons' ),
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
				],
				'devices' => [ 'desktop', 'tablet', 'mobile' ],
				'default' => [
                    'size' => 500,
                    'unit' => 'px',
                ],
				'selectors' => [
					'{{WRAPPER}} .imgItems img' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

        // Control to reverse the scroll direction
        $this->add_control(
            'reverse_scroll',
            [
                'label' => __('Reverse Scroll Direction', 'babe-addons'), // Label for reverse scroll
                'type' => Controls_Manager::SWITCHER, // Control type: switch (on/off)
                'label_on' => __('Yes', 'babe-addons'), // Label when enabled
                'label_off' => __('No', 'babe-addons'), // Label when disabled
                'return_value' => 'yes', // Value when enabled
                'default' => 'no', // Default value (not reversed)
            ]
        );

        // Control for scroll speed
        $this->add_control(
            'scrolling_posts_speed',
            [
                'label' => __('Scroll Speed', 'babe-addons'), // Label for scroll speed
                'type' => Controls_Manager::NUMBER, // Control type: number input
                'default' => 2, // Default scroll speed
                'min' => 0.1, // Minimum scroll speed
                'max' => 10, // Maximum scroll speed
                'step' => 0.1, // Step for speed input
                'description' => 'Set the speed at which the posts scroll.', // Description for the control
            ]
        );

        $this->end_controls_section(); // End the control section

        // Start of the style section
        $this->start_controls_section(
            'srolling_post_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add heading for scrolling element style
       /*  $this->add_control(
            'srolling_posts_styles',
            [
                'label' => __('Title (on hover)', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        ); */
        // Add control for text color
        $this->add_control(
            'srolling_posts_title_color',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .posts-item .text' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Add typography control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'srolling_posts_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .posts-item .text',
                'default' => [
                    'typography' => 'custom',
                    'font_size' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                ],
            ]
        );
        $this->end_controls_section(); // End the control section
        // Start of the Container section
        $this->start_controls_section(
            'srolling_post_container_section',
            [
                'label' => __('Item', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Add border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'sp_wrapper_border',
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .posts-item',
            ]
        );

        // Add control for border radius
        $this->add_control(
            'sp_border_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .posts-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    
                ],
            ]
        );
        
        $this->end_controls_section(); // End the control section
    }

    // Render the widget output on the frontend
    protected function render()
    {
        // Get the settings for the current display
        $settings = $this->get_settings_for_display();

        // Get the widget's unique ID
        $widget = $this->get_data();
        $unique_id = isset($widget['id']) ? $widget['id'] : uniqid('scrolling-text-');

        // Fetch the selected post type and number of posts from the settings
        $selected_post_type = $settings['scrolling_posts_type'];
        $number_of_posts = $settings['scrolling_number_of_posts'] ?? -1;

        // Check if reverse scroll is enabled
        $reverse_direction = $settings['reverse_scroll'] === 'yes';

        // Calculate the scroll speed (convert to milliseconds)
        $scroll_speed = 10000 / $settings['scrolling_posts_speed'];
        // Get the space between items
        $space_between_items = isset($settings['space_between_items']['size']) ? $settings['space_between_items']['size'] : 30;

        // Query for the posts based on the selected post type and number
        $args = [
            'post_type' => $selected_post_type,
            'posts_per_page' => $number_of_posts,
        ];

        $query = new WP_Query($args); // Execute the post query

        if ($query->have_posts()): ?>

            <!-- Begin the swiper container with custom attributes -->
            <div class="marquee-carousel<?php echo $unique_id ?>" data-speed="<?php echo $scroll_speed ?>" data-reverseDirection="<?php echo $reverse_direction ? 'true' : 'false'; ?>">
                <div class="swiper-wrapper">
                    <?php while ($query->have_posts()): $query->the_post();?>
	                        <div class="swiper-slide posts-item">
	                            <a href="<?php the_permalink();?>" class="swiper-holder">
	                                <div class="imgItems">
	                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID())); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" title="<?php echo esc_attr(get_the_title()); ?>" >
	                                    <div class="img-overlay">
	                                        <div class="text"><?php echo get_the_title(); ?></div>
	                                    </div>
	                                </div>
	                            </a>
	                        </div>
	                    <?php endwhile;
        wp_reset_postdata();?>
                </div>
            </div>

            <!-- JavaScript for the swiper carousel -->
            <script id="scrolling-posts-script<?php echo $unique_id ?>">
                var marqueeCarousel = document.querySelector('.marquee-carousel<?php echo $unique_id ?>');
                if (marqueeCarousel) {
                    let marqueeCarouselSpeed;

                    // Set the speed from the data attribute
                    if (marqueeCarousel.dataset.speed) {
                            marqueeCarouselSpeed = marqueeCarousel.dataset.speed;
                        } else {
                            marqueeCarouselSpeed = 10000;
                        }

                    // Get the reverse scroll setting from the data attribute
                    let reverseScroll = marqueeCarousel.dataset.reversedirection === 'true';

                    // Initialize Swiper with settings
                    new Swiper(".marquee-carousel<?php echo $unique_id ?>", {
                        autoplay: {
                            delay: 1,
                            disableOnInteraction: false,
                            pauseOnMouseEnter: true,
                            reverseDirection: reverseScroll, // Use reverse scroll direction
                        },
                        slidesPerView: parseInt(<?php echo $settings['number_of_items']; ?>),   // Number of slides per view
                        speed: parseInt(marqueeCarouselSpeed), // Scroll speed
                        loop: true,
                        spaceBetween: parseInt(<?php echo $space_between_items; ?>),
                    });
                }
            </script>

        <?php endif;
    }
}
