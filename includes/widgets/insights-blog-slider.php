<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if (! defined('ABSPATH')) exit;

class Insights_Blog_Slider extends Widget_Base
{
    public function get_name()
    {
        return 'insights_blog_slider';
    }

    public function get_title()
    {
        return __('Insights Blog Slider', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-posts-carousel';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function _register_controls()
    {

        $this->start_controls_section(
            'insights_section',
            [
                'label' => __('Content & Settings', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $post_types = get_post_types(['public' => true], 'objects');
        $allowed_post_types = ['post', 'portfolio']; // Add your post types here
        $post_type_options = [];

        // Populate post type options
        foreach ($post_types as $post_type) {
            if (in_array($post_type->name, $allowed_post_types)) {
                $post_type_options[$post_type->name] = $post_type->label;
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

        $this->add_control(
            'select_post_type',
            [
                'label' => __('Select Post Type', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => $post_type_options,
                'default' => 'post',
                'multiple' => false,
                'label_block' => true,
                'frontend_available' => true,
            ]
        );

        // Add categories control dynamically based on selected post type
       /*  $this->add_control(
            'select_post_category',
            [
                'label'       => __('Select Post Category', 'babe-addons'),
                'type'        => \Elementor\Controls_Manager::SELECT2,
                'options'     => $this->get_post_categories($settings['select_post_type'] ?? 'post'), // Fetch categories based on selected post type
                'multiple'    => true,
                'label_block' => true,
                'default'     => $settings['select_post_category'] ?? [], // Retain the selected categories
            ]
        ); */


        // Add post type control


        $this->add_control(
            'include_posts_by_id_or_slug',
            [
                'label' => __('Include Posts (ID or Slug)', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Enter post IDs or slugs separated by commas', 'babe-addons'),
                'label_block' => true,
            ]
        );
        // Add control to exclude IDs or slugs
        $this->add_control(
            'exclude_posts_by_id_or_slug',
            [
                'label' => __('Exclude Posts (ID or Slug)', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Enter post IDs or slugs separated by commas to exclude', 'babe-addons'),
                'label_block' => true,
            ]
        );
        // Add control for primary order
        $this->add_control(
            'primary_order',
            [
                'label' => __('Primary Order By', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date' => __('Order By Date', 'babe-addons'),
                    'id' => __('Order By ID', 'babe-addons'),
                ],
                'default' => 'date',
            ]
        );

        // Add control for order direction
        $this->add_control(
            'order_direction',
            [
                'label' => __('Order Direction', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'asc' => __('Ascending', 'babe-addons'),
                    'desc' => __('Descending', 'babe-addons'),
                ],
                'default' => 'desc',
            ]
        );
        $this->add_control(
            'number_of_posts',
            [
                'label' => __('Display Posts', 'babe-addons'),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 100,
                'step' => 1,
                'default' => 6,
            ]
        );
        $this->add_control(
            'insights_date_format',
            [
                'label' => __('Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'F j, Y' => 'October 14, 2024',
                    'm/d/Y' => '10/14/2024',
                    'd/m/Y' => '14/10/2024',
                    'Y-m-d' => '2024-10-14',
                    'd-m-Y' => '14-10-2024',
                    'custom' => __('Custom', 'babe-addons'),
                ],
                'default' => 'd-m-Y',


            ]
        );
        $this->add_control(
            'insights_custom_date_format',
            [
                'label' => __('Custom Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'F j, Y',
                'condition' => [
                    'insights_date_format' => 'custom',
                ],
                'description' => __('Date format examples: <code>F j, Y</code> => October 14, 2024 | <code>m/d/Y</code> => 10/14/2024. Use: <code>d</code> (01-31), <code>D</code> (Mon-Sun), <code>m</code> (01-12), <code>M</code> (Jan-Dec), <code>y</code> (00-99), <code>Y</code> (2024).', 'babe-addons'),
            ]
        );
        $this->add_control(
            'insights_entrance_animation',
            [
                'label' => esc_html__('Entrance Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );
        $this->add_control(
            'insights_exit_animation',
            [
                'label' => esc_html__('Exit Animation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::EXIT_ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'navigation_section',
            [
                'label' => __('Navigation Arrows', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Previous Button Icon Control
        $this->add_control(
            'prev_button_icon',
            [
                'label' => __('Previous Button Icon', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-chevron-left', // Default icon
                    'library' => 'solid',
                ],
            ]
        );

        // Next Button Icon Control
        $this->add_control(
            'next_button_icon',
            [
                'label' => __('Next Button Icon', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-chevron-right', // Default icon
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'show_insight_nav',
            [
                'label' => esc_html__('Show Navigation', 'textdomain'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'textdomain'),
                'label_off' => esc_html__('Hide', 'textdomain'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        // Read mmore Button Elemnent
        $this->start_controls_section(
            'read_more_button_section',
            [
                'label' => __('Read More Button', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Read More Button Icon
        $this->add_control(
            'insights_read_more_button_icon',
            [
                'label' => __('Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-long-arrow-alt-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'insights_read_more_button_text',
            [
                'label' => __('Button Text', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Read More',
            ]
        );
        $this->add_responsive_control(
            'insights_button_icon_size',
            [
                'label' => __('Icon Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
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
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .read-more svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .read-more i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Icon Spacing (Margin)
        $this->add_responsive_control(
            'insights_button_icon_spacing',
            [
                'label' => __('Button Icon Spacing', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
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
                    '{{WRAPPER}} .inshghtsItem .read-more i' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .inshghtsItem .read-more svg' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Insights Style Section
        $this->start_controls_section(
            'insights_date',
            [
                'label' => __('Date', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'insights_date_alignment',
            [
                'label' => __('Alignment', 'babe-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'babe-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'babe-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .date' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'insights_date_color',
            [
                'label' => __('Date Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .date' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_date_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .date',
            ]
        );
        $this->add_responsive_control(
            'insights_date_margin',
            [
                'label' => __('Date Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_date_padding',
            [
                'label' => __('Date Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // Title Style
        $this->start_controls_section(
            'insights_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'insights_title_heading',
            [
                'label' => __('Title', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'insights_title_alignment',
            [
                'label' => __('Alignment', 'babe-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'babe-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'babe-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->start_controls_tabs(
            'title_style_tabs'
        );

        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'title_hover_color',
            [
                'label' => __('Title Hover Color', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_excerpt_hover_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'insights_title_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_title_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        $this->start_controls_section(
            'insights_excerpt_section_style',
            [
                'label' => __('Excerpt', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'insights_excerpt_heading',
            [
                'label' => __('Excerpt', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // excerpt Alignment
        $this->add_control(
            'insights_excerpt_alignment',
            [
                'label' => __('Alignment', 'babe-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'babe-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'babe-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'insights_excerpt_color',
            [
                'label' => __('Excerpt Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .excerpt a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_excerpt_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .excerpt a',
            ]
        );

        // excerpt Spacing (Margin & Padding)
        $this->add_responsive_control(
            'insights_excerpt_margin',
            [
                'label' => __('Excerpt Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .excerpt a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_excerpt_padding',
            [
                'label' => __('Excerpt Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .excerpt a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        // Button Style
        $this->start_controls_section(
            'insights_button_section_style',
            [
                'label' => __('Button', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Button Alignment
        $this->add_control(
            'insights_button_alignment',
            [
                'label' => __('Button Alignment', 'babe-addons'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'babe-addons'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'babe-addons'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->start_controls_tabs(
            'button_style_tabs'
        );
        $this->start_controls_tab(
            'button_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_button_normal_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a',
            ]
        );
        // Button text Color Control
        $this->add_responsive_control(
            'insights_button_normal_text_color',
            [
                'label' => __('Text Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Button Background Color Control
        $this->add_responsive_control(
            'insights_button_normal_background_color',
            [
                'label' => __('Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'insights_button_hover_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a',
            ]
        );
        $this->add_responsive_control(
            'insights_button_hover_text_color',
            [
                'label' => __('Text Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#777777', // Default color set to black
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Button Hover Background Color Control
        $this->add_responsive_control(
            'insights_button_hover_background_color',
            [
                'label' => __('Background', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_control(
            'insights_button_border_heading',
            [
                'label' => __('Button Borders', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'insights_button_border',
                'label' => __('Button Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a',
                'fields_options' => [
                    'border' => [
                        'responsive' => true,  // This allows you to specify border for different devices
                    ],
                ],
            ]
        );
        // Button Border Radius
        $this->add_responsive_control(
            'insights_button_border_radius',
            [
                'label' => __('Button Border Radius', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Button Spacing (Margin & Padding)
        $this->add_control(
            'insights_button_spacing_heading',
            [
                'label' => __('Button Spacings', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'insights_button_margin',
            [
                'label' => __('Button Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_button_padding',
            [
                'label' => __('Button Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'insights_button_hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::HOVER_ANIMATION,
            ]
        );
        // Button Icon Color Control
        $this->add_control(
            'insights_button_icon_heading',
            [
                'label' => __('Icon Styles', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs(
            'button_icons_tabs'
        );
        $this->start_controls_tab(
            'button_icon_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'insights_button_icon_color',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'button_icon_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'insights_button_icon_hover_color',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .inshghtsItem .deatil-wrap .read-more a',
            ]
        );


        $this->end_controls_section();
        // Navigation styles
        // Navigation Color Control
        $this->start_controls_section(
            'insights_navigation_icons',
            [
                'label' => __('Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'insights_navigation_icon_heading',
            [
                'label' => __('Icon Styles', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->start_controls_tabs(
            'navigation_icons_tabs'
        );
        $this->start_controls_tab(
            'navigation_icon_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'insights_navigation_icons_color',
            [
                'label' => __('Navigation Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'insights_navigation_icons_bgcolor',
            [
                'label' => __('Icon Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-prev' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'navigation_icon_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'insights_navigation_icon_hover_color',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-prev:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-prev:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-next:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-next:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'insights_navigation_icons_bgcolor_hover',
            [
                'label' => __('Icon Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );


        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'insights_navigation_icon_size',
            [
                'label' => __('Icon Size', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vw'], // Units can be pixel, percentage, viewport width
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100, // Adjust the max value as needed
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 16, // Default size in pixels
                ],
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'insights_navigation_pagination_color',
            [
                'label' => __('Paginations Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-navigation .swiper-pagination' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'insights_navigation_margin',
            [
                'label' => __('Navigation Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_navigation_padding',
            [
                'label' => __('Navigation Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .insight-posts-wrapper .swiper-navigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
        // end of navigation

        $this->start_controls_section(
            'insights_item_image_style',
            [
                'label' => __('Image', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'insights_image_filter_heading',
            [
                'label' => __('Image Filters', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Css_Filter::get_type(),
            [
                'name' => 'custom_css_filters',
                // 'label' => 'Image Filter',
                'selector' => '{{WRAPPER}} .inshghtsItem .inshghtsItem-image-holder a img',
            ]
        );
        $this->add_responsive_control(
            'insights_responsive_image_width',
            [
                'label' => __('Image Width', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'vw'], // Units can be pixel, percentage, viewport width
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 600,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 540,
                ],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .inshghtsItem-image-holder a img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();

        // Item Container Style
        $this->start_controls_section(
            'insights_item_container_style',
            [
                'label' => __('Item Container', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Background Control
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'insights_item_background',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient', 'video'],
                'selector' => '{{WRAPPER}} .inshghtsItem', // Target the element's CSS selector
            ]
        );

        $this->add_control(
            'insights_background_overlay_heading',
            [
                'label' => __('Background Overlay', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'insights_background_overlay',
                'label' => __('Background Overlay', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .inshghtsItem::before', // Target the overlay layer
                'exclude' => ['image'], // Exclude image by default if needed
                'fields_options' => [
                    'background' => [
                        'default' => 'transparent',
                    ],
                    'color' => [
                        'default' => 'rgba(0, 0, 0, 0)', // Transparent default color
                    ],
                    'background_gradient' => [
                        'default' => [
                            'color' => 'rgba(0, 0, 0, 0)', // Gradient start color transparent
                            'color_b' => 'rgba(0, 0, 0, 0)', // Gradient end color transparent
                            'angle' => 180,
                        ],
                    ],
                ],
            ]
        );

        // Overlay Opacity Control
        $this->add_responsive_control(
            'insights_background_overlay_opacity',
            [
                'label' => __('Overlay Opacity', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 0.5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem::before' => 'opacity: {{SIZE}};',
                ],
            ]
        );
        // Item Container Spacing (Margin & Padding)
        $this->add_responsive_control(
            'insights_item_container_margin',
            [
                'label' => __('Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'insights_item_container_padding',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .inshghtsItem .deatil-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'insights_item_container_entrance_animation',
            [
                'label' => esc_html__('Entrance Animation', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::ANIMATION,
                'prefix_class' => 'animated ',
            ]
        );
        $this->end_controls_section();
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // $prev_arrow_icon = $settings['prev_arrow_icon'];
        // $next_arrow_icon = $settings['next_arrow_icon'];

        $show_insight_nav = $settings['show_insight_nav'] ?? 'yes';
        $insights_read_more_button_text = !empty($settings['insights_read_more_button_text']) ? $settings['insights_read_more_button_text'] : 'Read More';





        $include_posts_input = $settings['include_posts_by_id_or_slug'];
        $exclude_posts_input = $settings['exclude_posts_by_id_or_slug'];
        $post_type = $settings['select_post_type'];
        // $categories = $settings['select_post_category'];
        $primary_order = $settings['primary_order'];
        $order_direction = $settings['order_direction'];

        // $last_selected_categories = $categories;

        // echo '<pre>';
        // var_dump($last_selected_categories);
        // echo '</pre>';

        // Initialize arrays for IDs and slugs
        $post_ids = [];
        $post_slugs = [];
        $exclude_post_ids = [];
        $exclude_post_slugs = [];

        // Handle included posts
        if (!empty($include_posts_input)) {
            $include_posts = array_map('trim', explode(',', $include_posts_input));

            foreach ($include_posts as $post_identifier) {
                if (is_numeric($post_identifier)) {
                    $post_ids[] = (int) $post_identifier; // Treat as ID
                } else {
                    $post_slugs[] = $post_identifier; // Treat as slug
                }
            }
        }

        // Handle excluded posts
        if (!empty($exclude_posts_input)) {
            $exclude_posts = array_map('trim', explode(',', $exclude_posts_input));

            foreach ($exclude_posts as $post_identifier) {
                if (is_numeric($post_identifier)) {
                    $exclude_post_ids[] = (int) $post_identifier; // Treat as ID
                } else {
                    $exclude_post_slugs[] = $post_identifier; // Treat as slug
                }
            }
        }

        // Set up the query arguments
        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => $settings['number_of_posts'],
            'post_status'    => 'publish',
            'post__in'       => !empty($post_ids) ? $post_ids : null, // Include IDs if provided
            'orderby'        => !empty($post_ids) ? 'post__in' : $primary_order, // Order by ID if including specific posts
            'order'          => $order_direction === 'asc' ? 'ASC' : 'DESC',
        ];

        // Handle category filtering
        if (!empty($categories)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => $post_type === 'portfolio' ? 'portfolio_category' : 'category',
                    'field'    => 'term_id',
                    'terms'    => $categories,
                ],
            ];
        }

        // If slugs are provided for inclusion, fetch their IDs
        if (!empty($post_slugs)) {
            $included_posts_by_slug = get_posts([
                'name'            => $post_slugs,
                'post_type'       => $post_type,
                'fields'          => 'ids',
                'posts_per_page'  => -1,
            ]);
            $args['post__in'] = array_merge($args['post__in'] ?? [], wp_list_pluck($included_posts_by_slug, 'ID'));
        }

        // Handle excluded posts by ID
        if (!empty($exclude_post_ids)) {
            $args['post__not_in'] = $exclude_post_ids;
        }

        // If slugs are provided for exclusion, fetch their IDs
        if (!empty($exclude_post_slugs)) {
            $excluded_posts_by_slug = get_posts([
                'name'            => $exclude_post_slugs,
                'post_type'       => $post_type,
                'fields'          => 'ids',
                'posts_per_page'  => -1,
            ]);
            $args['post__not_in'] = array_merge($args['post__not_in'] ?? [], wp_list_pluck($excluded_posts_by_slug, 'ID'));
        }

        // Query posts
        $query = new WP_Query($args);

        // Date Format
        $date_format = $settings['insights_date_format'] === 'custom' ? $settings['insights_custom_date_format'] : $settings['insights_date_format'];
        $formatted_date = get_the_date($date_format);

        if ($query->have_posts()) {
            echo '<div class="insight-posts-wrapper">';
            echo '<div class="swiper-wrapper">';
            while ($query->have_posts()) {
                $query->the_post();
?>

                <div class="swiper-slide <?php echo esc_attr($settings['insights_entrance_animation']); ?> <?php echo esc_attr($settings['insights_exit_animation']); ?>">
                    <div class="inshghtsItem <?php echo esc_attr($settings['insights_item_container_entrance_animation']); ?>">
                        <div class="inshghtsItem-image-div">
                            <div class="inshghtsItem-image-holder">
                                <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
                            </div>
                        </div>
                        <div class="deatil-wrap">
                            <div class=" ">
                                <div class="date"><?php echo esc_html($formatted_date); ?></div>
                                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                                <p class="excerpt"><a href="<?php the_permalink(); ?>"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></a></p>
                                <div class="read-more">
                                    <a href="<?php the_permalink(); ?>">
                                        <span><?php echo $insights_read_more_button_text; ?></span>
                                        <span>
                                            <?php
                                            \Elementor\Icons_Manager::render_icon($settings['insights_read_more_button_icon'], ['aria-hidden' => 'true']);
                                            ?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            <?php
            }
            echo '</div>';
            ?>
            <div class="swiper-navigation-wrap">
                <div class="swiper-navigation">
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-prev">

                        <?php
                        if (isset($settings['prev_button_icon']) && !empty($settings['prev_button_icon']['value'])) {
                            \Elementor\Icons_Manager::render_icon($settings['prev_button_icon'], ['aria-hidden' => 'true']);
                        } else {
                            echo '<i class="fa-solid fa-chevron-left"></i>'; // Fallback icon
                        }
                        ?>
                        <i class="fa-solid fa-arrow-left-long"></i>
                    </div>
                    <div class="swiper-button-next">
                        <?php
                        if (isset($settings['next_button_icon']) && !empty($settings['next_button_icon']['value'])) {
                            \Elementor\Icons_Manager::render_icon($settings['next_button_icon'], ['aria-hidden' => 'true']);
                        } else {
                            echo '<i class="fa-solid fa-chevron-right"></i>'; // Fallback icon
                        }
                        ?>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </div>
                </div>
            </div>
        <?php
            echo '</div>';
        } else {
            echo '<p>' . __('No posts found.', 'babe-addons') . '</p>';
        }

        wp_reset_postdata();
        ?>
        <style>
            <?php if ($show_insight_nav !== 'yes') : ?>.swiper-navigation-wrap {
                display: none;
            }

            <?php endif; ?>
        </style>
        <script>
            function handleInsightSlider() {
                var insightBlog = document.querySelector('.insight-posts-wrapper');
                if (insightBlog) {
                    const swiperFull = new Swiper(".insight-posts-wrapper", {
                        slidesPerView: "auto",
                        centeredSlides: true,
                        spaceBetween: 32,
                        loop: true,
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                            type: 'fraction',
                            renderFraction: function(current, total) {
                                // Helper function to add leading zero if needed
                                function addLeadingZero(number) {
                                    return number < 10 ? '0' + number : number;
                                }

                                let currentFormatted = addLeadingZero(this.activeIndex + 1); // Adjusting current since it's zero-indexed
                                let totalFormatted = addLeadingZero(this.slides.length);

                                return '<span class="currentClass">' + currentFormatted + '</span>' +
                                    ' <span class="pagination-line"> / </span>' +
                                    '<span class="totalClass">' + totalFormatted + '</span>';
                            },

                        },
                        on: {
                            slideChange: function() {
                                const pagination = this.pagination;
                                pagination.render();
                            },
                        },
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                    });
                }
            };
            handleInsightSlider();
        </script>

<?php

    }

    private function get_post_categories($post_type = 'post')
    {
        // Default taxonomy for posts
        $taxonomy = 'category';

        // Use portfolio_category for custom post type 'portfolio'
        if ($post_type === 'portfolio') {
            $taxonomy = 'portfolio_category'; // Replace with the correct taxonomy name for portfolio
        }

        $categories = get_terms([
            'taxonomy'   => $taxonomy,
            'hide_empty' => false,
        ]);

        $category_options = [];
        if (! empty($categories) && ! is_wp_error($categories)) {
            foreach ($categories as $category) {
                $category_options[$category->term_id] = $category->name;
            }
        }

        return $category_options;
    }
}
