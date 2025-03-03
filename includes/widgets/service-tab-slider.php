<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class Service_Tab_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'service_tab_slider';
    }

    public function get_title()
    {
        return __('Services Tab Slider', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-slider-layout';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {
        // Start the content section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Create a new repeater instance
        $repeater = new Repeater();

        // Add service title control to the repeater
        $repeater->add_control(
            'service_title',
            [
                'label' => __('Service Title', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Branding', 'babe-addons'),
                'label_block' => true,
            ]
        );

        // Add service icon control to the repeater
        $repeater->add_control(
            'service_icon',
            [
                'label' => __('Service Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS, // Use ICONS type for icon explorer
                'default' => [
                    'value' => 'fa fa-star', // Default Font Awesome icon
                    'library' => 'fa', // Set the icon library (Font Awesome)
                ],
                'options' => [
                    'fa' => 'Font Awesome',
                    'custom' => 'Custom Icons',
                ],
                'description' => 'If Icon & image are present Then icon will be displayed, if icon is not present and image is available then image will be displayed.',
            ]
        );


        // Add service image control to the repeater
        $repeater->add_control(
            'service_image',
            [
                'label' => __('Service Image', 'babe-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(), // Placeholder image
                ],
            ]
        );

        // Add service description control to the repeater
        $repeater->add_control(
            'service_description',
            [
                'label' => __('Service Description', 'babe-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'babe-addons'),
                'rows' => 5,
            ]
        );

        // Add service link control to the repeater
        $repeater->add_control(
            'service_link',
            [
                'label' => __('Service Link', 'babe-addons'),
                'type' => Controls_Manager::URL,
                'default' => [
                    'url' => '#',
                ],
                'placeholder' => __('https://your-link.com', 'babe-addons'),
            ]
        );

        // Register the repeater control
        $this->add_control(
            'services_repeater',
            [
                'label' => __('Services', 'babe-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'service_title' => __('Branding', 'babe-addons'),
                        'service_icon' => 'fa fa-star', // Default icon
                        'service_description' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'babe-addons'),
                        'service_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'service_title' => __('Web Design', 'babe-addons'),
                        'service_icon' => 'fa fa-paint-brush', // Another default icon
                        'service_description' => __('High-quality web design services.', 'babe-addons'),
                        'service_link' => [
                            'url' => '#',
                        ],
                    ],
                    [
                        'service_title' => __('SEO Optimization', 'babe-addons'),
                        'service_icon' => 'fa fa-search', // Another default icon
                        'service_description' => __('Improve your search engine rankings.', 'babe-addons'),
                        'service_link' => [
                            'url' => '#',
                        ],
                    ],
                ],
                'title_field' => '{{{ service_title }}}',
            ]
        );

        $this->end_controls_section(); // End of Content Section
        // Add a section for Layout controls
        $this->start_controls_section(
            'services_Layout_section',
            [
                'label' => __('Services Layout', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'services_layout_type',
            [
                'label' => __('Layout Type', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slide', 'babe-addons'),
                    'grid' => __('Grid', 'babe-addons'),
                ],
            ]
        );

        $this->end_controls_section();
        // Add a section for navigation controls
        $this->start_controls_section(
            'services_navigation_section',
            [
                'label' => __('Services Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add control for Previous Button Icon
        $this->add_control(
            'prev_button_icon',
            [
                'label' => __('Previous Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS, // Use the ICONS control for icon selection
                'default' => [
                    'value' => 'fas fa-chevron-left', // Default to a left arrow
                    'library' => 'solid',
                ],
            ]
        );

        // Add control for Next Button Icon
        $this->add_control(
            'next_button_icon',
            [
                'label' => __('Next Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS, // Use the ICONS control for icon selection
                'default' => [
                    'value' => 'fas fa-chevron-right', // Default to a right arrow
                    'library' => 'solid',
                ],
            ]
        );
        $this->add_control(
            'service_navigation_icon_show_bottom',
            [
                'label' => esc_html__('Show Navigation on Bottom', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Top', 'babe-addons'),
                'label_off' => esc_html__('Bottom', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'hide_service_navigation',
            [
                'label' => esc_html__('Hide Navigation', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'babe-addons'),
                'label_off' => esc_html__('Hide', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'service_nav_alignment',
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
                    '{{WRAPPER}} .services-navigation-wrap' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Add Controls for Pagination
        $this->start_controls_section(
            'services_pagination_section',
            [
                'label' => __('Pagination', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'show_services_pagination',
            [
                'label' => esc_html__('Show Pagination', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Hide', 'babe-addons'),
                'label_off' => esc_html__('Show', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'services_pagination_alignment',
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
                'condition' => [
                    'show_services_pagination' => 'yes',
                ],
                'selectors' => [
                    '{{WRAPPER}} .service-pagination' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Title Style
        $this->start_controls_section(
            'service_section_style',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'service_title',
            [
                'label' => __('Title', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'service_title_alignment',
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
                    '{{WRAPPER}} .service-title .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        /* $this->add_control(
            'service_title_color',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-title .title' => 'color: {{VALUE}};',
                ],
            ]
        ); */
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('service_title_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'service_title_color_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'service_title_color_normal',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-title .title' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'service_title_color_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'service_title_color_hover',
            [
                'label' => __('Title Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-box:hover .service-title .title' => 'color: {{VALUE}};',
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
                'name' => 'service_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .service-title .title',
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
            'service_title_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-title .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'service_title_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .service-title .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Description Style
        $this->start_controls_section(
            'service_description_section_style',
            [
                'label' => __('Description', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'service_description',
            [
                'label' => __('Description', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Description Alignment
        $this->add_control(
            'service_description_alignment',
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
                    '{{WRAPPER}} .desc-text' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        /* $this->add_control(
            'service_description_color',
            [
                'label' => __( 'Description Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc-text' => 'color: {{VALUE}};',
                ],
            ]
        ); */
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('service_description_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'service_description_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'service_description_color_normal',
            [
                'label' => __('Description Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .desc-text' => 'color: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'service_description_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'service_description_color_hover',
            [
                'label' => __('Description Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-box:hover .desc-text' => 'color: {{VALUE}};',
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
                'name' => 'service_description_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .desc-text',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );


        // description Spacing (Margin & Padding)
        $this->add_control(
            'service_description_margin',
            [
                'label' => __('Description Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'service_description_padding',
            [
                'label' => __('Description Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .desc-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Icon Style
        $this->start_controls_section(
            'service_icon_style_section',
            [
                'label' => __('Icon & Image', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'service_icon_alignment',
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
                    '{{WRAPPER}} .services-icon' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // icon colors
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('service_icon_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'service_icon_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'service_icon_color_normal',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .services-icon svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'service_icon_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'service_icon_color_hover',
            [
                'label' => __('Icon Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .services-box:hover .services-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .services-box:hover .services-icon svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs


        // Icon Size Control
        $this->add_responsive_control(
            'service_icon_size',
            [
                'label' => __('Icon Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'], // Allow px, em, or rem units
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                    'rem' => [
                        'min' => 1,
                        'max' => 10,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 48, // Default icon size
                ],
                'selectors' => [
                    '{{WRAPPER}} .services-icon i' => 'font-size: {{SIZE}}{{UNIT}};', // Apply size to icon
                ],
            ]
        );
        // Icon Spacing (Margin & Padding)
        $this->add_control(
            'service_icon_margin',
            [
                'label' => __('Icon Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-icon i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'service_icon_padding',
            [
                'label' => __('Icon Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-icon i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'service_img_heading',
            [
                'label' => __('Image', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Image Spacing (Margin & Padding)
        $this->add_control(
            'service_img_margin',
            [
                'label' => __('Image Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-icon img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'service_img_padding',
            [
                'label' => __('Image Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-icon img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'service_section_card_style',
            [
                'label' => __('Card Style', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Tabs for Normal and Hover states
        $this->start_controls_tabs('service_card_tabs');

        // Normal Tab
        $this->start_controls_tab(
            'service_card_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Background Color Control for Normal State
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'service_card_background_normal',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient'], // Add 'video' if needed
                'selector' => '{{WRAPPER}} .services-box',
                'fields_options' => [
                    'background' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        // Border Control for Normal State
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'service_card_border_normal',
                'label' => __('Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .services-box',
            ]
        );

        // Border Radius Control (Responsive) for Normal State
        $this->add_responsive_control(
            'service_card_border_radius_normal',
            [
                'label' => __('Border Radius', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control for Normal State
        $this->add_responsive_control(
            'service_card_padding_normal',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End of Normal Tab

        // Hover Tab
        $this->start_controls_tab(
            'service_card_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Background Color Control for Hover State
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'service_card_background_hover',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .services-box:hover',
                'fields_options' => [
                    'background' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        // Border Control for Hover State
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'service_card_border_hover',
                'label' => __('Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .services-box:hover',
            ]
        );

        // Border Radius Control (Responsive) for Hover State
        $this->add_responsive_control(
            'service_card_border_radius_hover',
            [
                'label' => __('Border Radius', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .services-box:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Padding Control for Hover State
        $this->add_responsive_control(
            'service_card_padding_hover',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .services-box:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End of Hover Tab

        $this->end_controls_tabs(); // End of Control Tabs

        $this->end_controls_section();

        // Navigation
        $this->start_controls_section(
            'service_navigation_section',
            [
                'label' => __('Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );



        // Start control tabs for normal and hover states
        $this->start_controls_tabs('service_navigation_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'service_navigation_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'service_navigation_icon_color_normal',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-next svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );

        // Background Color Control for Normal State
        $this->add_control(
            'service_navigation_background_color_normal',
            [
                'label' => __('Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
                'default' => '#12163a',
                'frontend_available' => true,
            ]
        );

        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'service_navigation_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'service_navigation_icon_color_hover',
            [
                'label' => __('Icon Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-next:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .swiper-button-prev:hover svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );

        // Background Color Control for Hover State
        $this->add_control(
            'service_navigation_background_color_hover',
            [
                'label' => __('Background Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next:hover, {{WRAPPER}} .swiper-button-prev:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#0a0a0a', // Default hover background color
                'frontend_available' => true,
            ]
        );

        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs

        // Responsive Icon Size Control
        $this->add_responsive_control(
            'service_navigation_icon_size',
            [
                'label' => __('Icon Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', '%'],
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
                    '{{WRAPPER}} .swiper-button-next, {{WRAPPER}} .swiper-button-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
            ]
        );


        $this->end_controls_section(); // End Service Navigation Section

        // Pagination
        $this->start_controls_section(
            'service_pagination_style_section',
            [
                'label' => __('Pagination', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'service_pagination_typography',
                'selector' => '{{WRAPPER}} .service-pagination',
            ]
        );
        $this->add_control(
            'service_pagination_text_color',
            [
                'label' => esc_html__('Text Color', 'textdomain'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-pagination' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section(); // End Service Pagination Section


    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $show_nav_on_bottom = $settings['service_navigation_icon_show_bottom'];
        $hide_service_navigation = $settings['hide_service_navigation'];
        $services_layout_type = $settings['services_layout_type'];
        $show_pagination =  $settings['show_services_pagination'];

        // Ensure services_repeater is set and is an array before rendering

        if (isset($settings['services_repeater']) && is_array($settings['services_repeater'])) {
            if ($services_layout_type == 'slide'):
?>
                <div class="service-slider-wrap">
                    

                    <?php if ($hide_service_navigation !== 'yes') : ?>
                        <?php if ($show_nav_on_bottom !== 'yes') : ?>
                            <div class="services-navigation-wrap">
                                <div class="swiper-navigation">
                                        <div class="swiper-button-prev service-button-prev">

                                            <?php
                                            // Render the Previous Button Icon
                                            if (!empty($settings['prev_button_icon']['value'])) {
                                                Icons_Manager::render_icon($settings['prev_button_icon'], ['aria-hidden' => 'true']);
                                            } else {
                                                echo '<i class="fa-solid fa-chevron-left"></i>';
                                            }
                                            ?>
                                        </div>
                                        <div class="swiper-button-next service-button-next">
                                            <?php
                                            // Render the Next Button Icon
                                            if (!empty($settings['next_button_icon']['value'])) {
                                                Icons_Manager::render_icon($settings['next_button_icon'], ['aria-hidden' => 'true']);
                                            } else {
                                                echo '<i class="fa-solid fa-chevron-right"></i>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- <?php // if($services_layout_type == 'slide'): 
                            ?> -->
                    <div class="servicesSlider">
                        <div class="swiper-wrapper">
                            <?php foreach ($settings['services_repeater'] as $service) : ?>
                                <div class="swiper-slide">
                                    <a href="<?php echo esc_url($service['service_link']['url']); ?>" class="services-box">
                                        <div class="service-title">
                                            <div class="title">
                                                <?php echo esc_html($service['service_title']); ?>
                                            </div>
                                        </div>
                                        <div class="Services-deatil-wrap">
                                            <div class="services-icon">
                                                <?php
                                                // Render service icon or image
                                                if (!empty($service['service_icon']['value'])) {
                                                    Icons_Manager::render_icon($service['service_icon'], ['aria-hidden' => 'true']);
                                                } elseif (!empty($service['service_image']['url'])) {
                                                    echo '<img src="' . esc_url($service['service_image']['url']) . '" alt="' . esc_attr__('Service Image', 'babe-addons') . '">';
                                                }
                                                ?>
                                            </div>
                                            <p class="desc-text"><?php echo esc_html($service['service_description']); ?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <!-- <?php echo $show_pagination; ?> -->
                        <?php if ($show_pagination == 'yes'): ?>
                            <div class="swiper-pagination service-pagination"></div>
                        <?php endif; ?>
                    </div>
                    <!-- <?php // endif; 
                            ?> -->

                   
                    <?php if ($hide_service_navigation !== 'yes') : ?>
                        <?php if ($show_nav_on_bottom === 'yes') : ?>
                            <div class="services-navigation-wrap">
                                <div class="swiper-navigation">
                                    <div class="swiper-button-prev service-button-prev">

                                        <?php
                                        // Render the Previous Button Icon
                                        if (!empty($settings['prev_button_icon']['value'])) {
                                            Icons_Manager::render_icon($settings['prev_button_icon'], ['aria-hidden' => 'true']);
                                        } else {
                                            echo '<i class="fa-solid fa-chevron-left"></i>';
                                        }
                                        ?>
                                    </div>
                                    <div class="swiper-button-next service-button-next">
                                        <?php
                                        // Render the Next Button Icon
                                        if (!empty($settings['next_button_icon']['value'])) {
                                            Icons_Manager::render_icon($settings['next_button_icon'], ['aria-hidden' => 'true']);
                                        } else {
                                            echo '<i class="fa-solid fa-chevron-right"></i>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php else: ?>
                <div class="service-slider-wrap">
                    <div class="servicesSlider-grid">                        
                        <?php foreach ($settings['services_repeater'] as $service) : ?>
                            <a href="<?php echo esc_url($service['service_link']['url']); ?>" class="services-box">
                                    <div class="service-title">
                                        <div class="title">
                                            <?php echo esc_html($service['service_title']); ?>
                                        </div>
                                    </div>
                                    <div class="Services-deatil-wrap">
                                        <div class="services-icon">
                                            <?php
                                                // Render service icon or image
                                                if ( ! empty( $service['service_icon']['value'] ) ) {
                                                    // Render the icon if it's available
                                                    \Elementor\Icons_Manager::render_icon( $service['service_icon'], [ 'aria-hidden' => 'true' ] );
                                                } elseif ( ! empty( $service['service_image']['url'] ) ) {
                                                    // Render the image if an icon is not available
                                                    echo '<img src="' . esc_url( $service['service_image']['url'] ) . '" alt="' . esc_attr__( 'Service Image', 'babe-addons' ) . '">';
                                                }
                                            ?>
                                        </div>
                                        <p class="desc-text"><?php echo esc_html($service['service_description']); ?></p>
                                    </div>
                                </a>
                        <?php endforeach; ?>                        
                    </div>



                </div>
            <?php endif; ?>
            <style>
                /* grid css */
                /* .servicesSlider-grid {
                    display: grid;
                    grid-template-columns: auto auto auto auto;
                    gap: 15px;
                } */

                .servicesSlider-grid {
                    display: flex;
                    gap: 15px;
                    flex-wrap: wrap;
                    justify-content:flex-start
                }

                /* For slider */
                .service-slider-wrap {
                    overflow: hidden;
                }

                .services-box {
                    background-color: #12163a;
                    padding: 1rem;
                    display: flex;
                    flex-direction: column;
                    justify-content: space-between;
                    align-content: space-evenly;
                    min-height: 40vh;
                    color: #ffffff;
                    text-align: left;
                    text-decoration: none;
                    flex-basis: 24%;
                }

                .services-icon {
                    font-size: 70px;
                    color: #fff;
                    text-align: left;
                }

                .services-icon img {
                    max-width: 100%;
                }
                .services-icon svg {
                    max-width: 70px;
                }

                .service-title .title {
                    text-transform: uppercase;
                    font-size: 1rem;
                }

                .services-navigation-wrap {
                    position: relative;
                    display: flex;
                    justify-content: end;
                    padding: 1rem;
                }

                .services-navigation-wrap .swiper-navigation {
                    width: 110px;
                    position: relative;
                    height: 40px;
                }

                .swiper-button-next,
                .swiper-button-prev {
                    color: #fff !important;
                    width: 40px;
                    height: 40px;
                    background-color: #000;
                    padding: 10px;
                    border-radius: 50%;
                }

                .swiper-button-next:after,
                .swiper-button-prev:after {
                    font-size: 1.1rem;
                    content: "";
                }

                .service-pagination {
                    width: 85%;
                    justify-content: left;
                    margin-top: 20px;
                    display: flex;
                    line-height: 40px;
                    padding: 0 1rem;
                    user-select: none;
                }
                .service-pagination .pagination-line {
                    position: relative;
                    display: inline-block;
                    width: 5%;
                    border-bottom: 1.2px solid #bcbcbc;
                    margin: 0px 5px;
                    height: 26px;
                }
                
                @media (max-width:1600px) and (min-width:1024px) {
                
                .services-box {
                    max-height: 32vh;
                    min-height: 32vh;
                    flex-basis: 23%;
                }
                }
                @media (max-width:1280px) {
                    
                    .services-box {
                        flex-basis: 32.2222%;
                        max-height: 32vh;
                        min-height: 32vh;
                    }
                }
                @media (max-width:992px) {
                    
                    .services-box {
                        flex-basis: 48.9%;
                    }
                }
                @media (max-width:992px) {
                    
                    .services-box {
                        flex-basis: 48.88888%;
                    }
                }
                @media (max-width:768px) {
                    .services-box {
                        flex-basis: 48.9%;
                    }
                }
                
                @media (max-width:567px) {
                    .services-box {
                        flex-basis: 100%;
                    }
                }
            </style>
            <script>
                // Function to initialize Swiper
                function initializeServicesSlider() {
                    let servicesSlider = document.querySelector('.servicesSlider');
                    if (servicesSlider) {
                        const servicesCarousel = new Swiper(".servicesSlider", {
                            watchSlidesProgress: true,
                            slidesPerView: 3.5,
                            spaceBetween: 20,
                            freeMode: {
                                enabled: true,
                                sticky: true,
                                momentum: false
                            },
                            navigation: {
                                nextEl: ".service-button-next",
                                prevEl: ".service-button-prev"
                            },
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
                                        ' <span class="pagination-line"></span>' +
                                        '<span class="totalClass">' + totalFormatted + '</span>';
                                },
                                
                            },
                            on: {
                                slideChange: function() {
                                    const pagination = this.pagination; 
                                    pagination.render();
                                },
                            },
                            breakpoints: {
                                320: {
                                    slidesPerView: 1.2,
                                    spaceBetween: 20,
                                    centeredSlides: true,
                                },
                                640: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                768: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                1024: {
                                    slidesPerView: 3.5,
                                },
                            }
                        });
                    }
                }
                window.addEventListener('elementor/frontend/init', function() {
                    elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
                        initializeServicesSlider();
                    });
                });
                document.addEventListener("DOMContentLoaded", function() {
                    initializeServicesSlider();
                });
                initializeServicesSlider();
            </script>
        <?php
        } else {
            echo '<p>' . __('No services found', 'babe-addons') . '</p>';
        }
    }
}
