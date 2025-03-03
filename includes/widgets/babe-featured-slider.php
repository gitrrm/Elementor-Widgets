<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit;

class Babe_Featured_Slider extends Widget_Base {

    public function get_name() {
        return 'babe_featured_slider';
    }

    public function get_title() {
        return __( 'Featured Slider', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-post-slider';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'featured_slider_section',
            [
                'label' => __( 'Content & Settings', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        
        // Fetch public post types
        $post_types = get_post_types( [ 'public' => true ], 'objects' );
        $allowed_post_types = ['post', 'portfolio']; // Add your post types here
        $post_type_options = [];

        // Populate post type options
        foreach ( $post_types as $post_type ) {
            if ( in_array( $post_type->name, $allowed_post_types ) ) {
                $post_type_options[ $post_type->name ] = $post_type->label;
            }
        }

        // Default category options
        $post_type_sub_category_options = [];

        // If "portfolio" is the default post type, pre-load its categories
        if (isset($_POST['post_type']) && $_POST['post_type'] === 'portfolio') {
            $categories = get_terms([
                'taxonomy' => 'portfolio_category', // Custom taxonomy name
                'hide_empty' => false,
            ]);

            if (!empty($categories) && !is_wp_error($categories)) {
                foreach ($categories as $category) {
                    $post_type_sub_category_options[$category->term_id] = $category->name;
                }
            }
        }

        // Add post type control
        $this->add_control(
            'select_post_type',
            [
                'label' => __( 'Select Post Type', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $post_type_options,
                'default' => 'post', // Default value
                'multiple' => false,
                'label_block' => true,
                'frontend_available' => true,
            ]
        );

        // Add categories control, start with empty options
        $this->add_control(
            'select_post_category',
            [
                'label' => __( 'Filter by Categories', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $post_type_sub_category_options, // Set default options
                'multiple' => true,
                'label_block' => true,
                'default' => [], // Set default to empty array initially
                'render_type' => 'template', // Ensure it's rendered correctly
            ]
        );
        $this->add_control(
            'include_posts_by_id_or_slug',
            [
                'label' => __( 'Include Posts (ID or Slug)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Enter post IDs or slugs separated by commas', 'babe-addons' ),
                'label_block' => true,
            ]
        );
        // Add control to exclude IDs or slugs
        $this->add_control(
            'exclude_posts_by_id_or_slug',
            [
                'label' => __( 'Exclude Posts (ID or Slug)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __( 'Enter post IDs or slugs separated by commas to exclude', 'babe-addons' ),
                'label_block' => true,
            ]
        );
         // Add control for primary order
        $this->add_control(
            'primary_order',
            [
                'label' => __( 'Primary Order By', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date' => __( 'Order By Date', 'babe-addons' ),
                    'id' => __( 'Order By ID', 'babe-addons' ),
                ],
                'default' => 'date',
            ]
        );

        // Add control for order direction
        $this->add_control(
            'order_direction',
            [
                'label' => __( 'Order Direction', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => __( 'Ascending', 'babe-addons' ),
                    'desc' => __( 'Descending', 'babe-addons' ),
                ],
                'default' => 'desc',
            ]
        );

       
        

        $this->add_control(
            'number_of_posts',
            [
                'label' => __( 'Display Posts', 'babe-addons' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 100,
                'step' => 1,
                'default' => 6,
            ]
        );
        
        $this->add_responsive_control(
            'featured_item_gap_between',
            [
                'label' => __( 'Gap Between Items', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'size' => 30, // Default gap in pixels
                    'unit' => 'px', // Default unit
                ],
                'tablet_default' => [
                    'size' => 30, // Default gap for tablet
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 30, // Default gap for mobile
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'margin-right: {{SIZE}}{{UNIT}};', // Adjust this selector as needed
                ],
            ]
        );
        $this->add_control(
            'animation_type',
            [
                'label' => __( 'Select Animation Type', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'slide' => __( 'Slide', 'babe-addons' ),
                    'fade' => __( 'Fade', 'babe-addons' ),
                    'coverflow' => __( 'Coverflow', 'babe-addons' ),
                    'flip' => __( 'Flip', 'babe-addons' ),
                    'cube' => __( 'Cube', 'babe-addons' ),
                ],
                'default' => 'slide',
                'multiple' => false,
            ]
        );
        $this->add_control(
            'background_image_width',
            [
                'label' => __( 'Background Image Width(%)', 'babe-addons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 85, // Default width in pixels
                'min' => 50,
                'max' => 100,
                'step' => 1,
                'description' => 'Set the width of the slider images in percentage.',
            ]
        );
        $this->add_control(
            'background_alignment',
            [
                'label' => __( 'Background Image Alignment', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT, // Changed to SELECT
                'options' => [
                    'left' => __( 'Left', 'babe-addons' ),
                    'right' => __( 'Right', 'babe-addons' ),
                ],
                'default' => 'left', // Default option
            ]
        );
        $this->add_control(
			'hide_navigation',
			[
				'label' => esc_html__( 'Hide Navigation', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'babe-addons' ),
				'label_off' => esc_html__( 'Off', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        
        $this->end_controls_section();
        $this->start_controls_section(
            'navigation_section',
            [
                'label' => __( 'Navigation Arrows', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Previous Arrow Icon
        $this->add_control(
            'prev_arrow_icon',
            [
                'label' => __( 'Previous Arrow Icon', 'babe-addons' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // Next Arrow Icon
        $this->add_control(
            'next_arrow_icon',
            [
                'label' => __( 'Next Arrow Icon', 'babe-addons' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->end_controls_section();

        // Read mmore Button Elemnent
        $this->start_controls_section(
            'read_more_button_section',
            [
                'label' => __( 'Read More Button', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Read More Button Icon
        $this->add_control(
            'read_more_button_icon',
            [
                'label' => __( 'Read More Button Icon', 'babe-addons' ),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-long-arrow-alt-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'read_more_button_text',
            [
                'label' => __( 'Button Text', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'View',
            ]
        );
        // Icon Spacing (Margin)
        $this->add_responsive_control(
            'featured_button_icon_spacing',
            [
                'label' => __( 'Button Icon Spacing', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .featured-button a i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Image Style Section
        $this->start_controls_section(
            'image_section_style',
            [
                'label' => __( 'Image', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'featured_image_heading',
            [
                'label' => __( 'Image', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_responsive_control(
            'featured_image_alignment',
            [
                'label' => __( 'Image Alignment', 'babe-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'babe-addons' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'babe-addons' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'center', // Default alignment is center
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap' => 'text-align: {{VALUE}};',
                ],
                'tablet_default' => 'center', // Default for tablets
                'mobile_default' => 'center', // Default for mobile
            ]
        );
        
        
        $this->add_responsive_control(
            'featured_image_width',
            [
                'label' => __( 'Image Width', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'size' => 100, // Default width
                    'unit' => '%', // Default unit
                ],
                'tablet_default' => [
                    'size' => 100, // Default width for tablet
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'size' => 100, // Default width for mobile
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        
        // Border Type Control        
        // Adding responsive controls for different screen sizes
        $this->add_responsive_control(
            'featured_image_border_type',
            [
                'label' => __( 'Border Type', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '' => __( 'None', 'babe-addons' ),
                    'solid' => __( 'Solid', 'babe-addons' ),
                    'dashed' => __( 'Dashed', 'babe-addons' ),
                    'dotted' => __( 'Dotted', 'babe-addons' ),
                    'double' => __( 'Double', 'babe-addons' ),
                ],
                'default' => 'none',
                'tablet_default' => 'solid', // Default for tablet
                'mobile_default' => 'dashed', // Default for mobile
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap' => 'border-style: {{VALUE}};',
                ],
                'render_type' => 'template',
            ]
        );
        

        // Border Width Control (conditional based on the selected border type)
        $this->add_responsive_control(
            'featured_image_border_width',
            [
                'label' => __( 'Border Width', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'featured_image_border_type!' => '',  // Show when a border type is selected
                ],
            ]
        );

        // Border Color Control (conditional based on the selected border type)
        $this->add_control(
            'featured_image_border_color',
            [
                'label' => __( 'Border Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'featured_image_border_type!' => '',  // Show when a border type is selected
                ],
            ]
        );

        // Border Radius Control
        $this->add_responsive_control(
            'featured_image_border_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Responsive control for Featured Image Margin
        $this->add_responsive_control(
            'featured_image_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Responsive control for Featured Image Padding
        $this->add_responsive_control(
            'featured_image_padding',
            [
                'label' => __( 'Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .image-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

         // Title Style
         $this->start_controls_section(
            'featured_title_section_style',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'featured_title_heading',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'featured_title_alignment',
            [
                'label' => __( 'Alignment', 'babe-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'babe-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'babe-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .featured-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'featured_title_color',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'featured_title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .featured-title',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );
        
        
        // Title Spacing (Margin & Padding)
        $this->add_control(
            'featured_title_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'featured_title_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();
        // Excerpt Style
        $this->start_controls_section(
            'featured_excerpt_section_style',
            [
                'label' => __( 'Excerpt', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'featured_excerpt_heading',
            [
                'label' => __( 'Excerpt', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'featured_excerpt_alignment',
            [
                'label' => __( 'Alignment', 'babe-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'babe-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'babe-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .featured-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'featured_excerpt_color',
            [
                'label' => __( 'Excerpt Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-excerpt' => 'color: {{VALUE}};',
                ],
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'featured_excerpt_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .featured-excerpt',
            ]
        );
        
        // Title Spacing (Margin & Padding)
        $this->add_control(
            'featured_excerpt_margin',
            [
                'label' => __( 'Excerpt Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'featured_excerpt_padding',
            [
                'label' => __( 'Excerpt Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();

        // Button Style
        $this->start_controls_section(
            'featured_button_section_style',
            [
                'label' => __( 'Button', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'featured_button_heading',
            [
                'label' => __( 'Button', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'featured_button_alignment',
            [
                'label' => __( 'Alignment', 'babe-addons' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'babe-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'babe-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .featured-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        // Button Background Color Control
        $this->add_responsive_control(
            'featured_button_normal_background_color',
            [
                'label' => __( 'Button Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-button a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Background Color Control
        $this->add_responsive_control(
            'featured_button_hover_background_color',
            [
                'label' => __( 'Button Hover Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-button a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'featured_button_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .featured-button',
            ]
        );
        // Button text Color Control
        $this->add_responsive_control(
            'featured_button_normal_text_color',
            [
                'label' => __( 'Button Text Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .featured-button a' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button Hover Background Color Control
        $this->add_responsive_control(
            'featured_button_hover_text_color',
            [
                'label' => __( 'Button Hover Text Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#777777', // Default color set to black
                'selectors' => [
                    '{{WRAPPER}} .featured-button a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'featured_button_border',
                'label' => __( 'Button Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .featured-button a',
                'fields_options' => [
                    'border' => [
                        'responsive' => true,  // This allows you to specify border for different devices
                    ],
                ],
            ]
        );
        
        // Container Border Radius
        $this->add_responsive_control(
            'featured_button_border_radius',
            [
                'label' => __( 'Button Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-button a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        // Button Spacing (Margin & Padding)
        $this->add_responsive_control(
            'featured_button_margin',
            [
                'label' => __( 'Button Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-button ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'featured_button_padding',
            [
                'label' => __( 'Button Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .featured-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Button Icon Color Control
        $this->add_control(
            'featured_button_icon_color',
            [
                'label' => __( 'Button Icon Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-button a i' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'featured_button_icon_hover_color',
            [
                'label' => __( 'Button Icon Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .featured-button a:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
        
    }

    protected function render() {
        $settings = $this->get_settings_for_display();        
        $widget = $this->get_data();
        $unique_id = $widget['id'];
        $selected_post_type = $settings['select_post_type'];
        $select_post_category = $settings['select_post_category'];
        $number_of_posts = !empty($settings['number_of_posts']) ? $settings['number_of_posts'] : -1;
        // $post_order = $settings['post_order']; 
        // $exclude_posts = !empty($settings['exclude_posts']) ? $settings['exclude_posts'] : []; 
        // $include_posts = !empty($settings['include_posts']) ? $settings['include_posts'] : []; 
        

        // $selected_categories = !empty($settings['select_post_category']) ? $settings['select_post_category'] : [];
        $selected_categories = isset($settings['select_post_category']) ? $settings['select_post_category'] : [];

        $taxonomy = ($selected_post_type === 'portfolio') ? 'portfolio_category' : 'category';

        // Fetch categories for the selected taxonomy
        $categories = get_terms([
            'taxonomy' => $taxonomy,
            'hide_empty' => false,
        ]);
    
        // Prepare a mapping of category ID to category name
        $category_options = [];
        if (!empty($categories) && !is_wp_error($categories)) {
            foreach ($categories as $category) {
                $category_options[$category->term_id] = $category->name;
            }
        }
    
        
        
        

        $prev_arrow_icon = $settings['prev_arrow_icon'] ?? ''; 
        $next_arrow_icon = $settings['next_arrow_icon'] ?? '';
        $read_more_button_icon = $settings['read_more_button_icon'] ?? '';
        $read_more_button_text = $settings['read_more_button_text']?? 'View';
        $hide_navigation = $settings['hide_navigation'] === 'yes' ? 'true' : 'false';
        $animation_type = $settings['animation_type'];
        $background_alignment = $settings['background_alignment'] ?? 'right';
        $background_image_width = $settings['background_image_width'] ?? 85;

        $include_posts_input = $settings['include_posts_by_id_or_slug'];
        $exclude_posts_input = $settings['exclude_posts_by_id_or_slug'];

        // Get order settings
        // $order_by_date = $settings['order_by_date'];
        // $order_by_id = $settings['order_by_id'];

        // Prepare arrays for IDs and slugs
        $post_ids = [];
        $post_slugs = [];
        $exclude_post_ids = [];
        $exclude_post_slugs = [];

        // Check if user entered anything
        if ( ! empty( $include_posts_input ) ) {
            $include_posts = array_map( 'trim', explode( ',', $include_posts_input ) );

            foreach ( $include_posts as $post_identifier ) {
                // If it's numeric, treat it as an ID
                if ( is_numeric( $post_identifier ) ) {
                    $post_ids[] = (int) $post_identifier;
                } else {
                    // Otherwise, treat it as a slug
                    $post_slugs[] = $post_identifier;
                }
            }
        }
        // Handle excluded posts
        if ( ! empty( $exclude_posts_input ) ) {
            $exclude_posts = array_map( 'trim', explode( ',', $exclude_posts_input ) );

            foreach ( $exclude_posts as $post_identifier ) {
                if ( is_numeric( $post_identifier ) ) {
                    $exclude_post_ids[] = (int) $post_identifier;
                } else {
                    $exclude_post_slugs[] = $post_identifier;
                }
            }
        }

        
        

        // Determine the taxonomy to use based on the selected post type
        // $taxonomy = ($selected_post_type === 'portfolio') ? 'portfolio_category' : 'category';

        // Query posts of the selected post type
        $args = [
            'post_type'      => $settings['select_post_type'],
            'posts_per_page' => $settings['number_of_posts'],
            // 'order'          => $post_order === 'asc' ? 'ASC' : 'DESC',
        ];

        if (!empty($select_post_category)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => $taxonomy,
                    'field'    => 'term_id',
                    'terms'    => $select_post_category,
                ],
            ];
        }

       

        // Set primary order
        $primary_order = $settings['primary_order'];
        $order_direction = $settings['order_direction'];

        if ($primary_order === 'date') {
            $args['orderby'] = 'date';
        } else {
            $args['orderby'] = 'ID';
        }

        $args['order'] = $order_direction === 'asc' ? 'ASC' : 'DESC';
        

         // Modify query to include posts by ID or slug
        if ( ! empty( $post_ids ) || ! empty( $post_slugs ) ) {
            $args['post__in'] = $post_ids;

            if ( ! empty( $post_slugs ) ) {
                $args['name__in'] = $post_slugs;
            }
        }
        // Modify query to exclude posts by ID or slug
        if ( ! empty( $exclude_post_ids ) || ! empty( $exclude_post_slugs ) ) {
            $args['post__not_in'] = $exclude_post_ids;

            if ( ! empty( $exclude_post_slugs ) ) {
                $args['name__not_in'] = $exclude_post_slugs; // For slug exclusion, we have to filter in post-processing
            }
        }

    
        $query = new WP_Query($args);

        if ($query->have_posts()) : ?>
        
            <!-- <?php var_dump($selected_categories); ?>
            <?php echo "<br>" ?>
            <?php echo json_encode($selected_categories); ?> -->
            <script>
                var selectedCategories = <?php echo json_encode($selected_categories); ?>;
                // console.log("selectedCategories: from php :: " + selectedCategories);
            </script>

            <div class="featured-gallery-wrapper">
                <div class="thumbnail-container thumbs-slider<?php echo $unique_id; ?>">
                    <div class="swiper-wrapper">                    
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="swiper-slide">
                                <div class="image-wrap">
                                    <a href><img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>" ></a>
                                </div>
                                <div class="deatil-wrap">         
                                    <h2 class="featured-title"><?php echo the_title(); ?></h2>
                                    <div class="featured-excerpt"><p><?php echo the_excerpt(); ?></p></div>
                                    
                                    <div class="featured-button"><a href="<?php echo the_permalink(); ?>"> <?php echo $read_more_button_text; ?> <i class="<?php echo esc_attr( $read_more_button_icon['value'] ); ?>"></i></a></div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <?php if( $hide_navigation === 'false' ) : ?>
                        <div class="featured-nav">
                            <div class="swiper-button-prev"><i class="<?php echo esc_attr( $prev_arrow_icon['value'] ); ?>"></i></div>
                            <div class="swiper-button-next"><i class="<?php echo esc_attr( $next_arrow_icon['value'] ); ?>"></i></div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="background-container background-slider<?php echo $unique_id; ?> featureWork-overlay">
                    <div class="swiper-wrapper">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="swiper-slide">
                                
                                <div class="swiper-image-holder" style="<?php echo $background_alignment ?>:0; width: <?php echo $background_image_width?>%;">
                                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID()); ?>" alt="<?php echo the_title(); ?>" title="<?php echo the_title(); ?>" >
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div>
                    
                </div>
            </div>
            
            <?php wp_reset_postdata(); ?>
                    
            
            <style>
                .background-slider<?php echo $unique_id; ?> {
                    width: 100%;
                    height: auto;
                    margin: 0 0 10px 0;
                }
                .background-slider<?php echo $unique_id; ?> .swiper-slide {
                    width: auto;
                }
                .background-slider<?php echo $unique_id; ?> .swiper-slide img {
                    display: block;
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }

                .thumbs-slider<?php echo $unique_id; ?> .swiper-slide {
                    width: 100px;
                    border-radius: 0;
                }
                

                .thumbs-slider<?php echo $unique_id; ?> .swiper-slide img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    filter: blur(4px);
                }
                .thumbs-slider<?php echo $unique_id; ?> .swiper-slide-active img{
                    filter: blur(0);
                }
                
            </style>
            <script>
                const featuredSliderOne = document.querySelector('.featured-gallery-wrapper');
                if(featuredSliderOne){
                    var slider = new Swiper ('.background-slider<?php echo $unique_id; ?>', {
                        initialSlide:1,
                        slidesPerView: 1,
                        centeredSlides: true,
                        loop: false,
                        loopedSlides: 6, 
                        effect : '<?php echo $animation_type; ?>',
                        // rtl: true,
                                    
                    });


                    var thumbs = new Swiper ('.thumbs-slider<?php echo $unique_id; ?>', {
                        initialSlide:4,
                        slidesPerView: "auto",
                        slidesPerView: 3.5,
                        // spaceBetween: 30,
                        centeredSlides: true,
                        slideToClickedSlide: false,
                        freeMode: false,
                        loop: false,
                        // rtl: true,
                        navigation: {
                            nextEl: '.swiper-button-next',
                            prevEl: '.swiper-button-prev',
                        },
                        breakpoints: {
                            1024: {
                                slidesPerView: 3, 
                            },
                            600: {
                                slidesPerView: 2, 
                            },
                            300: {
                                slidesPerView: 1, 
                            },
                        }
                    });
                    slider.controller.control = thumbs;
                    thumbs.controller.control = slider;
                }
                
            </script>
        <?php endif;
    }
    
    
    // Function to retrieve categories based on post types
    protected function get_categories_data() {
        $allowed_post_types = ['post', 'portfolio'];
        $categories_data = [];

        // Loop through allowed post types
        foreach ($allowed_post_types as $post_type) {
            $taxonomies = get_object_taxonomies($post_type);
            
            foreach ($taxonomies as $taxonomy) {
                $categories = get_terms([
                    'taxonomy' => $taxonomy,
                    'hide_empty' => false,
                ]);

                if (!empty($categories) && !is_wp_error($categories)) {
                    // Initialize the post type entry if not already set
                    if (!isset($categories_data[$post_type])) {
                        $categories_data[$post_type] = [];
                    }

                    foreach ($categories as $category) {
                        $categories_data[$post_type][] = [
                            'value' => $category->term_id,
                            'label' => $category->slug,
                        ];
                    }
                }
            }
        }

        return $categories_data;
    }

    protected function get_saved_categories() {
        $settings = $this->get_settings_for_display();
        
        // Retrieve the saved categories from settings
        if ( isset( $settings['select_post_category'] ) && !empty( $settings['select_post_category'] ) ) {
            return $settings['select_post_category'];
        }
        
        return []; // Return an empty array if no categories are saved
    }
    
    
    
    

    
}
