<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Babe_Portfolio_Grid_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'babe_portfolio_grid';
    }

    public function get_title()
    {
        return __('Babe Portfolio Grid', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-posts-grid';
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
                'multiple' => true,
                'options' => $this->get_portfolio_categories(),
                'default' => [],
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
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    '2' => __('2 Columns', 'babe-addons'),
                    '3' => __('3 Columns', 'babe-addons'),
                ],
                'default' => '3',
            ]
        );
        // Include Posts Control
        $this->add_control(
            'babe_portfolio_grid_by_id_or_slug', 
            [
                'label' => __('Include Posts (ID or Slug)', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'description' => __('Enter post IDs or slugs separated by commas', 'babe-addons'),
                'label_block' => true,
            ]
        );

        // Exclude Posts Control
        $this->add_control('exclude_babe_portfolio_grid_by_id_or_slug', [
            'label' => __('Exclude Posts (ID or Slug)', 'babe-addons'),
            'type' => Controls_Manager::TEXT,
            'description' => __('Enter post IDs or slugs separated by commas to exclude', 'babe-addons'),
            'label_block' => true,
        ]);

        // Order By Control
        $this->add_control('babe_portfolio_grid_primary_order', [
            'label' => __('Primary Order By', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => __('Order By Date', 'babe-addons'),
                'id' => __('Order By ID', 'babe-addons'),
            ],
            'default' => 'date',
        ]);

        // Order Direction Control
        $this->add_control('babe_portfolio_grid_order_direction', [
            'label' => __('Order Direction', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'asc' => __('Ascending', 'babe-addons'),
                'desc' => __('Descending', 'babe-addons'),
            ],
            'default' => 'desc',
        ]);
        $this->add_control(
            'babe_portfolio_grid_date_format',
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
            'babe_portfolio_grid_custom_date_format',
            [
                'label' => __('Custom Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'F j, Y',
                'condition' => [
                    'babe_portfolio_grid_date_format' => 'custom',
                ],
                'description' => __('Date format examples: <code>F j, Y</code> => October 14, 2024 | <code>m/d/Y</code> => 10/14/2024. Use: <code>d</code> (01-31), <code>D</code> (Mon-Sun), <code>m</code> (01-12), <code>M</code> (Jan-Dec), <code>y</code> (00-99), <code>Y</code> (2024).', 'babe-addons'),
            ]
        );
        // End Content Controls
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
                'default' => 'Read More',
            ]
        );
        $this->add_responsive_control(
            'read_more_button_icon_size',
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
                    '{{WRAPPER}} .babe-portfolio-widget .action-link svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .babe-portfolio-widget .action-link i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Icon Spacing (Margin)
        $this->add_responsive_control(
            'read_more_button_icon_spacing',
            [
                'label' => __( 'Button Icon Spacing', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 200,
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
                    '{{WRAPPER}} .babe-portfolio-widget .action-link svg, {{WRAPPER}} .babe-portfolio-widget .action-link i' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

       

        // Start Title Controls
        $this->start_controls_section(
            'babe_portfolio_grid_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Title Alignment
        $this->add_control(
            'babe_portfolio_grid_title_alignment',
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
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Start control tabs for normal and hover states
        $this->start_controls_tabs('babe_portfolio_grid_title_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'babe_portfolio_grid_title_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'babe_portfolio_grid_title_color_normal',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a' => 'color: {{VALUE}};',
                ],
                'default' => '#777777',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'babe_portfolio_grid_title_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'babe_portfolio_grid_title_color_hover',
            [
                'label' => __( 'Title Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_portfolio_grid_title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a',
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
            'babe_portfolio_grid_title_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_portfolio_grid_title_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-title a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();

        // Excerpt Controls
        $this->start_controls_section(
            'babe_portfolio_grid_excerpt_section',
            [
                'label' => __('Excerpt', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Excerpt Alignment
        $this->add_control(
            'babe_portfolio_grid_excerpt_alignment',
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
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-excerpt' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'babe_portfolio_grid_excerpt_color',
            [
                'label' => __( 'Excerpt Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-excerpt' => 'color: {{VALUE}};',
                ],
                'default' => '#000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_portfolio_grid_excerpt_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-excerpt',
                'default' => [
                    'font_size' => [
                        'size' => 18,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'normal',
                ],
            ]
        );      
        
        // Excerpt Spacing (Margin & Padding)
        $this->add_control(
            'babe_portfolio_grid_excerpt_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-excerpt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'babe_portfolio_grid_excerpt_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-excerpt' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();

        // Start Date Controls
        $this->start_controls_section(
            'babe_portfolio_grid_date_section',
            [
                'label' => __('Author & Date', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('babe_portfolio_grid_date_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'babe_portfolio_grid_date_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'babe_portfolio_grid_date_color_normal',
            [
                'label' => __( 'Author & Date Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-date, {{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-author' => 'color: {{VALUE}};',
                    
                ],
                'default' => '#000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'babe_portfolio_grid_date_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'babe_portfolio_grid_date_color_hover',
            [
                'label' => __( 'Author & Date Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-date:hover, {{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-author:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#555', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'babe_portfolio_grid_date_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-date, {{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta .portfolio-author',
                'default' => [
                    'font_size' => [
                        'size' => 12,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'normal',
                ],
            ]
        );      
        
        // Meta Spacing (Margin & Padding)
        $this->add_control(
            'babe_portfolio_grid_date_margin',
            [
                'label' => __( 'Margins', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

       
        $this->end_controls_section();

         // Start Category Controls
         $this->start_controls_section(
            'bpg_category_style_section',
            [
                'label' => __('Category', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        // Category Alignment
        $this->add_control(
            'bpg_category_text_alignment',
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
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Start control tabs for normal and hover states
        $this->start_controls_tabs('bpg_category_text_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'bpg_category_text_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        // Category Color Control for Normal State
        $this->add_control(
            'bpg_category_text_color_normal',
            [
                'label' => __( 'Text Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories a' => 'color: {{VALUE}};',
                ],
                'default' => '#777777',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'bpg_category_text_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        
        $this->add_control(
            'bpg_category_text_color_hover',
            [
                'label' => __( 'Title Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories a:hover' => 'color: {{VALUE}};',
                ],
                'default' => '#000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'bpg_category_text_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories a',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );      
        
        // Category Spacing (Margin & Padding)
        $this->add_control(
            'bpg_category_text_margin',
            [
                'label' => __( 'TiCategorytle Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'bpg_category_text_padding',
            [
                'label' => __( 'Category Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .item-content-wrapper .portfolio-categories a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        ); 
        $this->end_controls_section();

        // Read more Button Styles
        $this->start_controls_section(
            'bpg_read_more_button_style_section',
            [
                'label' => __( 'Read More Button', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'bpg_read_more_button_alignment',
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
                    '{{WRAPPER}} .babe-portfolio-widget .action-link' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Button Background Color
        $this->start_controls_tabs('bpg_read_more_btn_bg_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'bpg_read_more_btn_color_normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        
        $this->add_control(
            'bpg_read_more_btn_txt_color_normal',
            [
                'label' => __( 'Text & Icon Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a, {{WRAPPER}} .babe-portfolio-widget .action-link a i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#500079',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'bpg_read_more_btn_bg_color_normal',
            [
                'label' => __( 'Button Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a ' => 'background-color: {{VALUE}};',
                ],
                'default' => '#500079',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'bpg_read_more_btn_color_hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        
        $this->add_control(
            'bpg_read_more_btn_txt_color_hover',
            [
                'label' => __( 'Text & Icon Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a:hover svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'bpg_read_more_btn_bg_color_hover',
            [
                'label' => __( 'Button Background Color (Hover)', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-portfolio-widget .action-link a:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#DDDDDD', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab(); // End Hover State Tab
        $this->end_controls_tabs(); // End Control Tabs

        $this->end_controls_section();
        
        


    }
    private function get_portfolio_categories() {
        $categories = get_terms([
            'taxonomy' => 'portfolio_category', // Use 'portfolio_category' for custom taxonomy
            'hide_empty' => false,
        ]);

        $options = [];
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->term_id] = $category->name;
            }
        }

        return $options;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $number_of_cols = $settings['number_of_cols'];
        $selected_categories = !empty($settings['selected_categories']) ? $settings['selected_categories'] : [];        
        // $hide_babe_portfolio_grid_pagination = $settings['hide_babe_portfolio_grid_pagination'];
        $prev_class = $settings['babe_portfolio_grid_prev_button_icon']['value'];
        $next_class = $settings['babe_portfolio_grid_next_button_icon']['value'];
        $show_on_bottom = $settings['babe_portfolio_grid_navigation_icon_show_bottom'];
        $read_more_button_icon = $settings['read_more_button_icon'] ?? '';
        $read_more_button_text = $settings['read_more_button_text']?? 'View';
    
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
            'post_type' => 'portfolio',
            'posts_per_page' => $settings['posts_per_page'],
            'paged' => $paged,  // Set the current page
            'orderby' => $settings['babe_portfolio_grid_primary_order'],
            'order' => $settings['babe_portfolio_grid_order_direction'],
        ];
    
        // Include specific posts if provided
        if (!empty($settings['babe_portfolio_grid_by_id_or_slug'])) {
            $args['post__in'] = array_map('trim', explode(',', $settings['babe_portfolio_grid_by_id_or_slug']));
        }
    
        // Exclude specific posts if provided
        if (!empty($settings['exclude_babe_portfolio_grid_by_id_or_slug'])) {
            $args['post__not_in'] = array_map('trim', explode(',', $settings['exclude_babe_portfolio_grid_by_id_or_slug']));
        }
    
        // Add category filter if selected
        if (!empty($selected_categories)) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'portfolio_category',
                    'field'    => 'term_id',
                    'terms'    => $selected_categories,
                    'operator' => 'IN', // Select posts in the selected categories
                ],
            ];
        }
    
        $query = new \WP_Query($args);
    
        if ($query->have_posts()) {
    
            // Pagination
            // if ( ! $hide_babe_portfolio_grid_pagination ){
                /* if(!$show_on_bottom){
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
                } */
            // }
    
            echo '<section>';
            echo '<div class="bt-row babe-portfolio-widget">';
            // Date Format
            $date_format = $settings['babe_portfolio_grid_date_format'] === 'custom' ? $settings['babe_post_grid_custom_date_format'] : $settings['babe_portfolio_grid_date_format'];
            $formatted_date = get_the_date($date_format);


    
            while ($query->have_posts()) {
                $query->the_post();
                $categories = get_the_terms(get_the_ID(), 'portfolio_category');
                if($number_of_cols == 3){
                    echo '<div class="bd-three-grid post-item bd-md-two-grid bd-sd-two-grid bd-xsd-one-grid bd-mb-20">';
                }else{
                    echo '<div class="bd-two-grid post-item bd-sd-two-grid bd-xsd-one-grid bd-mb-20">';
                }
                ?>
                    <a href="<?php the_permalink(); ?>" class="portfolio-image">
                        <?php the_post_thumbnail(); ?>
                    </a>
                    <div class="item-content-wrapper">
                        <div class="portfolio-meta">
                            <div class="portfolio-author">
                                <i class="fa-regular fa-user"></i> <?php the_author(); ?>
                            </div>
                            <div class="portfolio-date">
                                <i class="fa-regular fa-calendar"></i> <?php echo esc_html($formatted_date); ?>
                            </div>
                        </div>
                        <div class="portfolio-title">
                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                        </div>
                        <div class="portfolio-excerpt">
                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                        </div>
                        <div class="action-link">
                            <a href="<?php the_permalink(); ?>" class="link">
                                <span> <?php echo $read_more_button_text; ?></span>
                                <span>
                                    <?php
                                        \Elementor\Icons_Manager::render_icon($settings['read_more_button_icon'], ['aria-hidden' => 'true']);
                                    ?>
                                </span>
                            </a>
                        </div>
                        <div class="portfolio-categories my-3">
                            <?php if ($categories && !is_wp_error($categories)) : ?>
                                <?php foreach ($categories as $category) : ?>
                                    <a href="<?php echo esc_url(get_term_link($category)); ?>"><?php echo esc_html($category->name); ?></a>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php
            }
    
            echo '</div>';
            echo '</section>';
    
            // Pagination
            // if ( ! $hide_babe_portfolio_grid_pagination ){
                /* if($show_on_bottom){
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
                } */
            // }
    
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No posts found', 'babe-addons') . '</p>';
        }
    }

}
