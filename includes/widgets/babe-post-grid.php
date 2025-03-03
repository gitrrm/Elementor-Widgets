<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Babe_Post_Grid_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'babe_post_grid';
    }

    public function get_title()
    {
        return __('Babe Post Grid', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-post-list';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()    {

        // Start Content Controls
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'selected_categories',
            [
                'label' => __('Select Categories', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_post_categories(),
                'multiple' => true, // Allow multiple selections
                'label_block' => true,
            ]
        );
        // Number of Posts
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );
        $this->add_control(
            'number_of_cols',
            [
                'label' => __('Number of Columns', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
            ]
        );
        // Include Posts Control
        $this->add_control(
            'babe_post_grid_by_id_or_slug', 
            [
                'label' => __('Include Posts (ID or Slug)', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Enter post IDs or slugs separated by commas', 'babe-addons'),
                'label_block' => true,
            ]
        );

        // Exclude Posts Control
        $this->add_control('exclude_babe_post_grid_by_id_or_slug', [
            'label' => __('Exclude Posts (ID or Slug)', 'babe-addons'),
            'type' => Controls_Manager::TEXT,
            'description' => __('Enter post IDs or slugs separated by commas to exclude', 'babe-addons'),
            'label_block' => true,
        ]);

        // Order By Control
        $this->add_control('babe_post_grid_primary_order', [
            'label' => __('Primary Order By', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => __('Order By Date', 'babe-addons'),
                'id' => __('Order By ID', 'babe-addons'),
            ],
            'default' => 'date',
        ]);

        // Order Direction Control
        $this->add_control('babe_post_grid_order_direction', [
            'label' => __('Order Direction', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'asc' => __('Ascending', 'babe-addons'),
                'desc' => __('Descending', 'babe-addons'),
            ],
            'default' => 'desc',
        ]);
        $this->add_control(
            'babe_post_grid_date_format',
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
            'babe_post_grid_custom_date_format',
            [
                'label' => __('Custom Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'F j, Y',
                'condition' => [
                    'babe_post_grid_date_format' => 'custom',
                ],
                'description' => __('Date format examples: <code>F j, Y</code> => October 14, 2024 | <code>m/d/Y</code> => 10/14/2024. Use: <code>d</code> (01-31), <code>D</code> (Mon-Sun), <code>m</code> (01-12), <code>M</code> (Jan-Dec), <code>y</code> (00-99), <code>Y</code> (2024).', 'babe-addons'),
            ]
        );



        // End Content Controls
        $this->end_controls_section();

        $this->start_controls_section(
            'babe_post_grid_pagination_section',
            [
                'label' => __('Pagination', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'hide_babe_post_grid_pagination',
			[
				'label' => esc_html__( 'Hide Pagination', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Show', 'babe-addons' ),
				'label_off' => esc_html__( 'Hide', 'babe-addons' ),
				'return_value' => 'no',
				'default' => 'no',
			]
		);
        $this->add_control(
			'babe_post_grid_navigation_icon_show_bottom',
			[
				'label' => esc_html__( 'Show Navigation on Bottom', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Top', 'babe-addons' ),
				'label_off' => esc_html__( 'Bottom', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);
       
        // Control for Previous Button Icon
        $this->add_control(
            'babe_post_grid_prev_button_icon',
            [
                'label' => __( 'Previous Button Icon', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-arrow-left-long',
                    'library' => 'solid',
                ],
            ]
        );

        // Control for Next Button Icon
        $this->add_control(
            'babe_post_grid_next_button_icon',
            [
                'label' => __( 'Next Button Icon', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-arrow-right-long',
                    'library' => 'solid',
                ],
            ]
        );

        $this->end_controls_section();

        // Start Title Controls
        $this->start_controls_section(
            'babe_post_grid_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Title Alignment
        $this->add_control(
            'babe_post_grid_title_alignment',
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
                    '{{WRAPPER}} .babe-post-grid .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Start control tabs for normal and hover states
        $this->start_controls_tabs('babe_post_grid_title_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'babe_post_grid_title_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'babe_post_grid_title_color_normal',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .title' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'babe_post_grid_title_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'babe_post_grid_title_color_hover',
            [
                'label' => __( 'Title Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .babe-item:hover .title' => 'color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_post_grid_title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-post-grid .title',
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
            'babe_post_grid_title_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_post_grid_title_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();

        // Start Date Controls
        $this->start_controls_section(
            'babe_post_grid_date_section',
            [
                'label' => __('Date', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Date Alignment
        $this->add_control(
            'babe_post_grid_date_alignment',
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
                    '{{WRAPPER}} .babe-post-grid .date' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('babe_post_grid_date_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'babe_post_grid_date_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'babe_post_grid_date_color_normal',
            [
                'label' => __( 'Date Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .date' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'babe_post_grid_date_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'babe_post_grid_date_color_hover',
            [
                'label' => __( 'Date Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .babe-item:hover .date' => 'color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_post_grid_date_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-post-grid .date',
                'default' => [
                    'font_size' => [
                        'size' => 18,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );      
        
        // Title Spacing (Margin & Padding)
        $this->add_control(
            'babe_post_grid_date_margin',
            [
                'label' => __( 'Date Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_post_grid_date_padding',
            [
                'label' => __( 'Date Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-post-grid .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();
        // Navigation
        $this->start_controls_section(
            'babe_post_grid_navigation_section',
            [
                'label' => __( 'Navigation', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        
        
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('service_navigation_tabs');
        
        // Normal State Tab
        $this->start_controls_tab(
            'babe_post_grid_navigation_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );
        
        // Icon Color Control for Normal State
        $this->add_control(
            'babe_post_grid_navigation_icon_color_normal',
            [
                'label' => __( 'Icon Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        // Background Color Control for Normal State
        $this->add_control(
            'babe_post_grid_navigation_background_color_normal',
            [
                'label' => __( 'Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'background-color: {{VALUE}};',
                ],
                'default' => 'transparent',
                'frontend_available' => true,
            ]
        );
        
        $this->end_controls_tab(); // End Normal State Tab
        
        // Hover State Tab
        $this->start_controls_tab(
            'babe_post_grid_navigation_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );
        
        // Icon Color Control for Hover State
        $this->add_control(
            'babe_post_grid_navigation_icon_color_hover',
            [
                'label' => __( 'Icon Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i:hover, {{WRAPPER}} .page-numbers .next i:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#ccc', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        // Background Color Control for Hover State
        $this->add_control(
            'babe_post_grid_navigation_background_color_hover',
            [
                'label' => __( 'Background Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i:hover, {{WRAPPER}} .page-numbers .next i:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => 'transparent', // Default hover background color
                'frontend_available' => true,
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab
        
        $this->end_controls_tabs(); // End Control Tabs

        // Responsive Icon Size Control
        $this->add_responsive_control(
            'babe_post_grid_navigation_icon_size',
            [
                'label' => __( 'Icon Size', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    '%' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
            ]
        );
        // Border Radius Control
        $this->add_responsive_control(
            'babe_post_grid_nav_arrow_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
         // nav arrow Spacing (Margin & Padding)
         $this->add_control(
            'babe_post_grid_nav_arrow_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_post_grid_nav_arrow_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers .prev i, {{WRAPPER}} .page-numbers .next i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section(); // End Service Navigation Section

         // Pagination
         $this->start_controls_section(
            'babe_post_grid_pagination_style_section',
            [
                'label' => __( 'Pagination', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

                
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('babe_post_grid_pagination_tabs');
        
        // Normal State Tab
        $this->start_controls_tab(
            'babe_post_grid_pagination_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );
        $this->add_control(
            'babe_post_grid_nav_alignment',
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
                    '{{WRAPPER}} .babe-post-pagination .page-numbers' => 'justify-content: {{VALUE}};',
                ],
            ]
        );
        
        
        // Icon Color Control for Normal State
        $this->add_control(
            'babe_post_grid_pagination_text_color_normal',
            [
                'label' => __( 'Text Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        // Background Color Control for Normal State
        $this->add_control(
            'babe_post_grid_pagination_background_color_normal',
            [
                'label' => __( 'Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers' => 'background-color: {{VALUE}};',
                ],
                'default' => 'transparent',
                'frontend_available' => true,
            ]
        );
        
        $this->end_controls_tab(); // End Normal State Tab
        
        // Hover State Tab
        $this->start_controls_tab(
            'babe_post_grid_pagination_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );
        
        // Icon Color Control for Hover State
        $this->add_control(
            'babe_post_grid_pagination_icon_color_hover',
            [
                'label' => __( 'Icon Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        // Background Color Control for Hover State
        $this->add_control(
            'babe_post_grid_pagination_background_color_hover',
            [
                'label' => __( 'Background Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .page-numbers:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => 'transparent', // Default hover background color
                'frontend_available' => true,
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab
        // Active State Tab
        $this->start_controls_tab(
            'babe_post_grid_pagination_active_tab',
            [
                'label' => __( 'Active', 'babe-addons' ),
            ]
        );
        
        // Icon Color Control for Hover State
        $this->add_control(
            'babe_post_grid_pagination_font_color_active',
            [
                'label' => __( 'Icon Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-pagination .page-numbers.current' => 'color: {{VALUE}};',
                ],
                'default' => '#fff', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        // Background Color Control for Hover State
        $this->add_control(
            'babe_post_grid_pagination_text_bg_color_active',
            [
                'label' => __( 'Background Color (Active)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-post-pagination .page-numbers.current' => 'background-color: {{VALUE}};',
                ],
                'default' => '#000', // Default hover background color
                'frontend_available' => true,
            ]
        );
        // Border Control for Active State
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'service_card_border_normal',
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-post-pagination .page-numbers.current',
            ]
        );
        // Border Radius Control
        $this->add_responsive_control(
            'babe_post_grid_pagination_text_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-post-pagination .page-numbers.current' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'default' => [
                    'top' => '50',
                    'right' => '50',
                    'bottom' => '50',
                    'left' => '50',
                    'unit' => '%',
                ],
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab
        
        $this->end_controls_tabs(); // End Control Tabs

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_post_grid_pagination_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .page-numbers',
                'default' => [
                    'font_size' => [
                        'size' => 16,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );
        
        
         // nav arrow Spacing (Margin & Padding)
         $this->add_control(
            'babe_post_grid_pagination_text_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_post_grid_pagination_text_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .page-numbers' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section(); // End Service Navigation Section
        // Text Background Style Section
        $this->start_controls_section(
            'textbg_section_style',
            [
                'label' => __( 'Background Overlay', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'post_grid_background_overlay',
                'label' => __( 'Background Overlay', 'babe-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .babe-post-grid .babe-item .overlay-detail',
                'fields_options' => [
                    'background' => [
                        'label' => __( 'Background', 'babe-addons' ),
                    ],
                    'color' => [
                        'responsive' => true,
                    ],
                    'background_image' => [
                        'responsive' => true,
                    ],
                    'background_size' => [
                        'responsive' => true,
                    ],
                    'background_position' => [
                        'responsive' => true,
                    ],
                    'background_repeat' => [
                        'responsive' => true,
                    ],
                    'background_attachment' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );
        
        $this->end_controls_section();


    }
    private function get_post_categories() {
        $categories = get_categories();
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }
        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $number_of_cols = $settings['number_of_cols'];
        $selected_categories = !empty($settings['selected_categories']) ? $settings['selected_categories'] : [];        
        $hide_babe_post_grid_pagination = $settings['hide_babe_post_grid_pagination'];
        $prev_class = $settings['babe_post_grid_prev_button_icon']['value'];
        $next_class = $settings['babe_post_grid_next_button_icon']['value'];
        $show_on_bottom = $settings['babe_post_grid_navigation_icon_show_bottom'];

        if( ! $prev_class ) {
            $prev_class = 'fa-solid fa-arrow-left-long'; // Default class for prev button
        }
        if( ! $next_class ) {
            $next_class = 'fa-solid fa-arrow-right-long'; // Default class for next button
        }
        
        
        // Current page number
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        // WP Query to get posts with pagination
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['posts_per_page'],
            'paged' => $paged,  // Set the current page
            'orderby' => $settings['babe_post_grid_primary_order'],
            'order' => $settings['babe_post_grid_order_direction'],
        ];

        // Include specific posts if provided
        if (!empty($settings['babe_post_grid_by_id_or_slug'])) {
            $args['post__in'] = array_map('trim', explode(',', $settings['babe_post_grid_by_id_or_slug']));
        }

        // Exclude specific posts if provided
        if (!empty($settings['exclude_babe_post_grid_by_id_or_slug'])) {
            $args['post__not_in'] = array_map('trim', explode(',', $settings['exclude_babe_post_grid_by_id_or_slug']));
        }

        // Add category filter if selected
        if (!empty($selected_categories)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category',
                    'field'    => 'term_id',
                    'terms'    => $selected_categories,
                    'operator' => 'IN', // Select posts in the selected categories
                ],
            ];
        }
        
        $query = new \WP_Query($args);

        if ($query->have_posts()) {

            // Pagination
            if ( ! $hide_babe_post_grid_pagination ){
                if(!$show_on_bottom){
                    $total_pages = $query->max_num_pages;
                    if ($total_pages > 1) {
                        $big = 999999999; // Need an unlikely integer
                        $pagination = paginate_links([
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $total_pages,
                            'prev_text' => __('<i class="' . esc_attr($prev_class) . '"></i>', 'babe-addons'),
                            'next_text' => __('<i class="'. esc_attr($next_class) .'"></i>', 'babe-addons'),
                            'type' => 'list',
                        ]);

                        echo '<div class="babe-post-pagination">' . $pagination . '</div>';
                    }
                }
                
            }

            echo '<div class="babe-post-grid">';

             // Date Format
             $date_format = $settings['babe_post_grid_date_format'] === 'custom' ? $settings['babe_post_grid_custom_date_format'] : $settings['babe_post_grid_date_format'];
             $formatted_date = get_the_date($date_format);

           

            while ($query->have_posts()) {
                $query->the_post();
                
                ?>
                <a href="<?php the_permalink(); ?>" class="babe-item">
                    <div class="img-holder">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="overlay-detail">
                        <div class="date"><?php echo esc_html($formatted_date); ?></div>
                        <h2 class="title"><?php echo get_the_title(); ?></h2>
                    </div>
                </a>
            <?php
            }

            

            echo '</div>';

            // Pagination
            if ( ! $hide_babe_post_grid_pagination ){
                if($show_on_bottom){
                    $total_pages = $query->max_num_pages;
                    if ($total_pages > 1) {
                        $big = 999999999; // Need an unlikely integer
                        $pagination = paginate_links([
                            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
                            'format' => '?paged=%#%',
                            'current' => max(1, $paged),
                            'total' => $total_pages,
                            'prev_text' => __('<i class="' . esc_attr($prev_class) . '"></i>', 'babe-addons'),
                            'next_text' => __('<i class="'. esc_attr($next_class) .'"></i>', 'babe-addons'),
                            'type' => 'list',
                        ]);

                        echo '<div class="babe-post-pagination">' . $pagination . '</div>';
                    }
                }
                
            }
            


            $cols = '';
            if ($number_of_cols) {
                for ($i = 0; $i < $number_of_cols; $i++) {
                    $cols .= '1fr ';
                }
            }

            ?>
            <style>
                .babe-post-pagination{
                    margin: 30px 0;
                }
                .babe-post-pagination .page-numbers {
                    list-style: none;
                    display: flex;
                    /* justify-content: center; */
                    padding: 0;
                }
                .babe-post-pagination .page-numbers li{
                    text-align: center;
                }
                .babe-post-pagination .page-numbers.current {
                    background-color: #000;
                    color: #fff;
                    width: 40px;
                    height: 40px;
                    justify-content: center;
                    border-radius: 50%;
                    padding-top: 7px;
                }
                .babe-post-pagination .page-numbers li a {
                    color: #333;
                    margin: 0 15px;
                    padding-top: 7px;
                    text-align: center;
                }
                .prev i, .next i  {
                    margin-top: 5px;
                }


                .babe-post-grid {
                    display: grid;
                    grid-template-columns: <?php echo $cols; ?>;
                    gap: 20px;
                    width: 100%;
                }
                .babe-post-grid .babe-item {
                    max-height: 45vh;
                    min-height: 22vh;
                    position: relative;
                }
                .babe-post-grid .babe-item .img-holder {
                    overflow: hidden;
                    position: relative;
                    width: 100%;
                    height: 100%;
                }
                .babe-post-grid .babe-item .img-holder img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    aspect-ratio: 1;
                }
                .babe-post-grid .babe-item .img-holder img {
                    transition-duration: 4s;
                    user-select: none;
                }
                .babe-post-grid .babe-item:hover .img-holder img {
                    transform: scale(1.2);
                }
                
                .babe-post-grid .babe-item .overlay-detail {
                    position: absolute;
                    background: linear-gradient(0deg, rgba(0, 0, 0, 1) 9%, rgba(0, 0, 0, 0) 64%);
                    width: 100%;
                    height: 100%;
                    bottom: 0;
                    z-index: 99;
                    padding: 10px 20px;
                    color: #fff;
                    align-content: end;
                }
                .date {
                    font-size: 12px;
                }
                
                @media screen and (max-device-width: 768px) {
                    .babe-post-grid{
                        grid-template-columns: auto auto;
                    }
                }
                @media screen and (max-device-width: 567px) { 
                
                    .babe-post-grid{
                        grid-template-columns: auto;
                    }
                }
            </style>
            <?php

            

            wp_reset_postdata();
        } else {
            echo '<p>' . __('No posts found', 'babe-addons') . '</p>';
        }
    }

}
