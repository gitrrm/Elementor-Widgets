<?php
// Ensure Elementor is active
if (! defined('ABSPATH')) exit; // Exit if accessed directly
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;

class Testimonial_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'babe_testimonial_widget';
    }

    public function get_title()
    {
        return __('Babe Testimonials', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-testimonial';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Testimonials', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Create a Repeater control
        $repeater = new Repeater();

        // Image control inside repeater
        $repeater->add_control(
            'testimonial_image',
            [
                'label' => __('Choose Image', 'babe-addons'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        // Name control inside repeater
        $repeater->add_control(
            'testimonial_name',
            [
                'label' => __('Name', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Client Name', 'babe-addons'),
            ]
        );

        // Designation control inside repeater
        $repeater->add_control(
            'testimonial_designation',
            [
                'label' => __('Designation', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Client Designation', 'babe-addons'),
            ]
        );
        $repeater->add_control(
            'testimonial_rating',
            [
                'label' => __('Rating', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [], // No size units required for a rating
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 5,
                        'step' => 0.1, // Allow decimal values for ratings (e.g., 4.5)
                    ],
                ],
                'default' => [
                    'size' => 5, // Default rating is 5 stars
                ],
            ]
        );

        // Testimonial Text control inside repeater
        $repeater->add_control(
            'testimonial_text',
            [
                'label' => __('Testimonial', 'babe-addons'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'babe-addons'),
            ]
        );

        // Adding repeater control to the widget
        $this->add_control(
            'testimonials_list',
            [
                'label' => __('Testimonials List', 'babe-addons'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'testimonial_name' => __('Client Name #1', 'babe-addons'),
                        'testimonial_designation' => __('Client Designation', 'babe-addons'),
                        'testimonial_text' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'babe-addons'),
                        'testimonial_rating' => __('5', 'babe-addons'),
                    ],
                    [
                        'testimonial_name' => __('Client Name #2', 'babe-addons'),
                        'testimonial_designation' => __('Client Designation', 'babe-addons'),
                        'testimonial_text' => __('Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'babe-addons'),
                        'testimonial_rating' => __('4', 'babe-addons'),
                    ],
                ],
                'title_field' => '{{{ testimonial_name }}}',
            ]
        );

        $this->end_controls_section();
        // Add a section for Layout controls
        $this->start_controls_section(
            'testimonial_layout_section',
            [
                'label' => __('Layout', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'testimonial_layout_type',
            [
                'label' => __('Layout Type', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'layout_two',
                'options' => [
                    'layout_one' => __('Layout One - no profile image', 'babe-addons'),
                    'layout_two' => __('Layout Two', 'babe-addons'),
                    'layout_three' => __('Layout Three', 'babe-addons'),
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'testimonial_next_prev_icon_section',
            [
                'label' => __('Navigation & Icons', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Add control for Previous Button Icon
        $this->add_control(
            'testimonial_prev_button_icon',
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
            'testimonial_next_button_icon',
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
            'show_testimonial_navigations',
            [
                'label' => esc_html__('Show Navigation', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        // Pagination Content
        $this->start_controls_section(
            'testimonial_pagination_content_section',
            [
                'label' => __('Pagination', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_pagination_dots',
            [
                'label' => esc_html__('Show Dots', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->end_controls_section();
        // Rating Content
        $this->start_controls_section(
            'testimonial_rating_content_section',
            [
                'label' => __('Rating', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_testimonial_rating',
            [
                'label' => esc_html__('Show Rating', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'show_rating_text',
            [
                'label' => esc_html__('Show Rating Text', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->end_controls_section();

        // The Quote image 
        $this->start_controls_section(
            'testimonial_quote_img_section',
            [
                'label' => __('Quote Image/Icon', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'hide_testimonial_default_quote_img',
            [
                'label' => esc_html__('Hide Default Quote Image', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

       
        $this->add_control(
            'testimonial_quote_img',
            [
                'label' => __('Custom Quote Image', 'babe-addons'),
                'type' => Controls_Manager::MEDIA,
                // 'default' => [
                //     'url' => plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote3.png',
                // ],
            ]
        );
        
       
        $this->add_control(
            'show_testimonial_quote_img',
            [
                'label' => esc_html__('Show/Hide Custom Quote Image', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
                'description' => 'Switch on to display selected custom Image. And if you want to show the icon, then select an Icon using the Select Quote Icon control and switch OFF this control.'
            ]
        );
        
        $this->add_control(
            'testimonial_quote_icon',
            [
                'label' => __('Select Quote Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'description' => 'Select an Icon from the media library and switch OFF the "Show/Hide Custom Quote Image" for displaying the icon.<br><br>For displaying the default quote png image, switch off the "Show/Hide Custom Quote Image" control and remove/delete the Icon.',
            ]
        );

        
        
        $this->end_controls_section(); 

        // Title Style
        $this->start_controls_section(
            'testimonial_section_style',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_title',
            [
                'label' => __('Title', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Start control tabs for normal and hover states
        $this->start_controls_tabs('testimonial_title_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'testimonial_title_color_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'testimonial_title_color_normal',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .name-designation' => 'color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                // 'separator' => 'before',
            ]
        );
        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'testimonial_title_color_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_title_color_hover',
            [
                'label' => __('Title Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap:hover .name-designation' => 'color: {{VALUE}};',
                ],
                'default' => '#cccccc', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .deatil-wrap .name-designation',
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
            'service_testimonial_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .name-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_title_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .name-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Description Style
        $this->start_controls_section(
            'testimonial_description_section_style',
            [
                'label' => __('Description', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_description',
            [
                'label' => __('Description', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Start control tabs for normal and hover states
        $this->start_controls_tabs('testimonial_description_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'testimonial_description_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'testimonial_description_color_normal',
            [
                'label' => __('Description Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .description' => 'color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'testimonial_description_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_description_color_hover',
            [
                'label' => __('Description Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap:hover .description' => 'color: {{VALUE}};',
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
                'name' => 'testimonial_description_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .deatil-wrap .description',
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
            'testimonial_description_margin',
            [
                'label' => __('Description Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_description_padding',
            [
                'label' => __('Description Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .deatil-wrap .description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Image Style
        $this->start_controls_section(
            'testimonial_image_style_section',
            [
                'label' => __('Image', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_image',
            [
                'label' => __('Image', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Responsive Image Width control
        $this->add_responsive_control(
            'testimonial_image_width',
            [
                'label' => __('Image Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'], // Allowed units
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 75,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testi-profile-img' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};', // Square control
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_image_border',
                'label' => __('Image Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .testi-profile-img img',
            ]
        );



        $this->end_controls_section();
        // Pagination Style
        $this->start_controls_section(
            'testimonial_pagination_style_section',
            [
                'label' => __('Pagination', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_pagination',
            [
                'label' => __('Pagination', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Responsive dots Width control
        $this->add_responsive_control(
            'testimonial_pagination_dots_width',
            [
                'label' => __('Dots Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px', 'vw'], // Allowed units
                'range' => [
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 5,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} #customDots .owl-dot, {{WRAPPER}}  #customDots2 .owl-dot, {{WRAPPER}}  #customDots3 .owl-dot' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_pagination_border',
                'label' => __('Dots Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} #customDots .owl-dot, {{WRAPPER}}  #customDots2 .owl-dot, {{WRAPPER}}  #customDots3 .owl-dot',
            ]
        );
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('testimonial_pagination_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'testimonial_pagination_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'testimonial_pagination_color_normal',
            [
                'label' => __('Dots Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #customDots .owl-dot, {{WRAPPER}}  #customDots2 .owl-dot, {{WRAPPER}}  #customDots3 .owl-dot' => 'background-color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'testimonial_pagination_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_pagination_color_hover',
            [
                'label' => __('Description Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #customDots .owl-dot:hover, {{WRAPPER}}  #customDots2 .owl-dot:hover, {{WRAPPER}}  #customDots3 .owl-dot:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab
        // Active State Tab
        $this->start_controls_tab(
            'testimonial_pagination_active_tab',
            [
                'label' => __('Active', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_pagination_color_active',
            [
                'label' => __('Dots Color (Active)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} #customDots .owl-dot.active, {{WRAPPER}}  #customDots2 .owl-dot.active, {{WRAPPER}}  #customDots3 .owl-dot.active' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );



        $this->end_controls_tab(); // End Hover State Tab

        $this->end_controls_tabs(); // End Control Tabs

        $this->end_controls_section();

        // Navigation Style
        $this->start_controls_section(
            'testimonial_navigation_style_section',
            [
                'label' => __('Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_navigation',
            [
                'label' => __('Navigation', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        
        $this->add_responsive_control(
            'testimonial_navigation_icon_size',
            [
                'label' => __('Prev/Next Button Sizes', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'], // Allowed units
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 20,
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev svg, {{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-next svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev svg, {{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme  .owl-next svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev i, {{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-next i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_navigation_padding',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'], // Allowed units
                'default' => [
                    'top' => '10',
                    'right' => '16',
                    'bottom' => '10',
                    'left' => '16',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme.layout-one .owl-prev, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme.layout-one .owl-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'testimonial_navigation_icon_border',
                'label' => __('Prev/Next Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next',
            ]
        );
        // add a border radius control
        $this->add_responsive_control(
            'testimonial_navigation_border_radius',
            [
                'label' => __('Border Radius', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'], // Allowed units
                'default' => [
                    'top' => '5',
                    'right' => '5',
                    'bottom' => '5',
                    'left' => '5',
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme.layout-one .owl-prev, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme.layout-one .owl-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('testimonial_navigation_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'testimonial_navigation_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'testimonial_navigation_icon_color_normal',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev i, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev svg, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ffffff',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testimonial_navigation_icon_bgcolor_normal',
            [
                'label' => __('Icon Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next' => 'background-color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'testimonial_navigation_icon_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_navigation_icon_color_hover',
            [
                'label' => __('Icon Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev:hover i, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev:hover svg, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next:hover svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#ffffff', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testimonial_navigation_bgcolor_hover',
            [
                'label' => __('Icon Background Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .owl-theme .owl-prev:hover, {{WRAPPER}}  .testimonialsWrap{{ID}} .owl-theme .owl-next:hover' => 'background-color: {{VALUE}};',
                ],
                'default' => '#ff0000', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_tab(); // End Hover State Tab
        $this->end_controls_tabs(); // End Control Tabs      


        $this->end_controls_section();

        // Rating Style
        $this->start_controls_section(
            'testimonial_rating_style_section',
            [
                'label' => __('Rating', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_rating',
            [
                'label' => __('Rating icon and text colors', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        
        // Start control tabs for normal and hover states
        $this->start_controls_tabs('testimonial_rating_color_tabs');

        // Normal State Tab
        $this->start_controls_tab(
            'testimonial_rating_normal_tab',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );

        // Icon Color Control for Normal State
        $this->add_control(
            'testimonial_rating_icon_color_normal',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-items .testimonial-rating .rating i' => 'color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testimonial_rating_text_color_normal',
            [
                'label' => __('Text Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-items .rating-text' => 'color: {{VALUE}};',
                ],
                'default' => '#000000',
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        

        $this->end_controls_tab(); // End Normal State Tab

        // Hover State Tab
        $this->start_controls_tab(
            'testimonial_rating_icon_hover_tab',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );

        // Icon Color Control for Hover State
        $this->add_control(
            'testimonial_rating_icon_color_hover',
            [
                'label' => __('Icon Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .testimonials-items:hover .testimonial-rating .rating i' => 'color: {{VALUE}};',
                ],
                'default' => '#777', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'testimonial_rating_text_color_hover',
            [
                'label' => __('Text Color (Hover)', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .testimonials-items:hover .rating-text' => 'color: {{VALUE}};',
                ],
                'default' => '#777', // Default hover color
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        
        $this->end_controls_tab(); // End Hover State Tab
        $this->end_controls_tabs(); // End Control Tabs    


        // Rating Icons (Margin & Padding)
        $this->add_control(
            'testimonial_rating_icon_margin',
            [
                'label' => __('Icon Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-items .testimonial-rating .rating' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'testimonial_rating_text_typography',
                'label' => __('Rating Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .testimonials-items .rating-text',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );
        $this->add_control(
            'testimonial_rating_text_margin',
            [
                'label' => __('Text Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-items .rating-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

  


        $this->end_controls_section();
        // The Quote image 
        $this->start_controls_section(
            'testimonial_quote_img_style',
            [
                'label' => __('Quote Image/Icon', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'testimonial_quote_icon_size',
            [
                'label' => __('Icon Size', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px', 'em', 'rem'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0.5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0.5,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .quote-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .quote-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'quote_icon_color',
            [
                'label' => __('Quote Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .quote-icon i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .quote-icon svg' => 'fill: {{VALUE}};',
                ],
                'default' => '#777', 
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->add_responsive_control(
            'quote_icon_margin',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'], 
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .quote-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section(); 
        // Background 
        $this->start_controls_section(
            'testimonial_background',
            [
                'label' => __('Background', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'testimonial_layout_type' => 'layout_three',
                ],
            ]
        );
        $this->add_control(
            'testimonial_bg_color',
            [
                'label' => __('Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonialsWrap{{ID}} .testimonial-layout-three .owl-item.active::after' => 'background-color: {{VALUE}};',
                ],
                'default' => '#f2f5eb', 
                'frontend_available' => true,
                'separator' => 'before',
            ]
        );
        $this->end_controls_section(); 

    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $widget = $this->get_data();
        $unique_id = $widget['id'];
        
        $testimonial_layout_type = isset($settings['testimonial_layout_type']) ? $settings['testimonial_layout_type'] : 'layout_two';
        $show_testimonial_navigations = $settings['show_testimonial_navigations'];
        $show_pagination_dots = $settings['show_pagination_dots'];
        $show_testimonial_rating = $settings['show_testimonial_rating'];
        $show_rating_text = $settings['show_rating_text'];
        $show_testimonial_quote_img = $settings['show_testimonial_quote_img'];
        // $testimonial_quote_icon = $settings['testimonial_quote_icon'];

        // Determine the default image URL based on the selected layout
        $default_quote_img_url = plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote1.png';
        if ($testimonial_layout_type === 'layout_two') {
            $default_quote_img_url = plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote2.png';
        } elseif ($testimonial_layout_type === 'layout_three') {
            $default_quote_img_url = plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote3.png';
        }
        // Use the custom image URL if provided, otherwise use the default based on layout
        $quote_img_url = !empty($settings['testimonial_quote_img']['url']) ? $settings['testimonial_quote_img']['url'] : $default_quote_img_url;

       
        

        // For using in javascript
        $carousel_class = "";
        $navContainer = '';
        $dotsContainer = '';
        if ($testimonial_layout_type === 'layout_one') {
            $carousel_class = '.testimonial-layout-one';
            $navContainer = '.testimonialsWrap'. $unique_id .' .custom-nav';
            $dotsContainer = '#customDots';
        } elseif ($testimonial_layout_type === 'layout_two') {
            $carousel_class = '.testimonial-layout-two';
            $navContainer = '.testimonialsWrap'. $unique_id .' .custom-nav2';
            $dotsContainer = '#customDots2';
        } else {
            $carousel_class = '.testimonial-layout-three';
            $navContainer = '.testimonialsWrap'. $unique_id .' .custom-nav3';
            $dotsContainer = '#customDots3';
        }

        if (! empty($settings['testimonials_list'])) {
            // var_dump($testimonial_layout_type);
            if ('layout_two' === $testimonial_layout_type) {
                echo '<div class="testimonialsWrap' . $unique_id . '">'; // Add unique ID to the wrapper
                echo '<div class="testimonial-layout-two layout-two owl-carousel owl-theme">';

                foreach ($settings['testimonials_list'] as $testimonial) {
                    ?>
                    <div class="item">
                        <div class="testimonials-items testimonials-items-width">
                        
                        <div class="testi-profile-img">
                            <img src="<?php echo esc_url($testimonial['testimonial_image']['url']); ?>" alt="<?php echo esc_attr($testimonial['testimonial_name']); ?>">
                        </div>
                        <!-- Render Rating as Stars -->
                        <?php $rating = floatval( $testimonial['testimonial_rating']['size'] ); ?>  
                        <?php if($show_testimonial_rating === 'yes') : ?> 
                            <?php if($show_rating_text === 'yes') : ?>
                                <div class="rating-text"><?php echo '<i class="fa fa-star" aria-hidden="true"></i> <span> '. $rating . ' </span>'; ?> </div>
                            <?php else: ?>                        
                                <div class="testimonial-rating">
                                    <div class="rating"  style="width: <?php echo $rating * 18; ?>px;">
                                        <?php
                                            for ( $i = 1; $i <= 5; $i++ ) {                                
                                                echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            <?php endif; ?>                                     
                        <?php endif; ?>
                        <div class="deatil-wrap">
                        <?php if($show_testimonial_quote_img !== 'yes' && !empty($settings['testimonial_quote_icon']['value'])) : ?> 
                            <span class="quote-icon">
                                <?php
                                    // Display the quote icon
                                    if ( isset($settings['testimonial_quote_icon']) && !empty($settings['testimonial_quote_icon']['value']) ) {
                                        \Elementor\Icons_Manager::render_icon( $settings['testimonial_quote_icon'], ['aria-hidden' => 'true'] );
                                    }
                                ?>
                            </span>
                        <?php endif; ?>
                        
                            <p class="description">
                                <?php echo esc_html($testimonial['testimonial_text']); ?>
                            </p>
                            <h5 class="name-designation"><?php echo esc_html($testimonial['testimonial_name']); ?>, <?php echo esc_html($testimonial['testimonial_designation']); ?></h5>
                        </div>

                    </div>
                </div>
                <?php
                }

                echo '</div>';
                if ($show_pagination_dots === 'yes') {
                    echo '<div class="customDots"><div id="customDots2" class="owl-dots"></div></div>';
                }
                if ($show_testimonial_navigations === 'yes') {
                    echo '<div class="owl-theme"><div class="owl-controls"><div class="custom-nav2 owl-nav"></div></div></div>';
                }
                
                echo '</div>';
            } elseif ($testimonial_layout_type === 'layout_one') {
                echo '<div class="testimonialsWrap' . $unique_id . '">'; // Add unique ID to the wrapper
                echo '<div class="testimonial-layout-one layout-one owl-carousel owl-theme">';

                foreach ($settings['testimonials_list'] as $testimonial) {
                ?>
                    <div class="item">
                        <div class="testimonials-items testimonials-items-width">
                            <?php if($show_testimonial_quote_img !== 'yes' && !empty($settings['testimonial_quote_icon']['value'])) : ?> 
                                <div class="quote-icon">
                                <?php
                                    // Display the quote icon
                                    if ( isset($settings['testimonial_quote_icon']) && !empty($settings['testimonial_quote_icon']['value']) ) {
                                        \Elementor\Icons_Manager::render_icon( $settings['testimonial_quote_icon'], ['aria-hidden' => 'true'] );
                                    }
                                ?>
                                </div>
                            <?php endif; ?>


                            <div class="deatil-wrap">
                                <!-- Render Rating as Stars -->
                                <?php $rating = floatval( $testimonial['testimonial_rating']['size'] ); ?>  
                                                    
                                <?php if($show_testimonial_rating === 'yes') : ?> 
                                    <?php if($show_rating_text === 'yes') : ?>
                                        <div class="rating-text"><?php echo '<i class="fa fa-star" aria-hidden="true"></i> <span> '. $rating . ' </span>'; ?> </div>
                                    <?php else: ?>                        
                                        <div class="testimonial-rating">
                                            <div class="rating"  style="width: <?php echo $rating * 18; ?>px;">
                                                <?php
                                                    for ( $i = 1; $i <= 5; $i++ ) {                                
                                                        echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>                                     
                                <?php endif; ?>
                                
                                <p class="description"><?php echo esc_html($testimonial['testimonial_text']); ?></p>
                                <h5 class="name-designation"><?php echo esc_html($testimonial['testimonial_name']); ?>, <?php echo esc_html($testimonial['testimonial_designation']); ?></h5>
                            </div>
                            
                        </div>
                    </div>
                <?php
                }

                echo '</div>';
                if ($show_pagination_dots === 'yes') {
                    echo '<div class="customDots"><div id="customDots" class="owl-dots"></div></div>';
                }
                if ($show_testimonial_navigations === 'yes') {
                    echo '<div class="owl-theme layout-one"><div class="owl-controls"><div class="custom-nav owl-nav"></div></div></div>';
                }
                echo '</div>';
            } else {
                echo '<div class="testimonialsWrap' . $unique_id . '">'; // Add unique ID to the wrapper
                echo '<div class="testimonial-layout-three layout-three owl-carousel owl-theme">';

                foreach ($settings['testimonials_list'] as $testimonial) {
                ?>
                    <div class="item">
                        <div class="testimonials-items testimonials-items-width">
                            <div>
                                <?php if($show_testimonial_quote_img !== 'yes' && !empty($settings['testimonial_quote_icon']['value'])) : ?> 
                                    <div class="quote-icon">
                                    <?php
                                        // Display the quote icon
                                        if ( isset($settings['testimonial_quote_icon']) && !empty($settings['testimonial_quote_icon']['value']) ) {
                                            \Elementor\Icons_Manager::render_icon( $settings['testimonial_quote_icon'], ['aria-hidden' => 'true'] );
                                        }
                                    ?>
                                    </div>
                                <?php endif; ?>
                                <div class="testi-profile-img">
                                    <img src="<?php echo esc_url($testimonial['testimonial_image']['url']); ?>" alt="<?php echo esc_attr($testimonial['testimonial_name']); ?>">
                                </div> 
                            </div>
                            <div class="deatil-wrap">
                                <!-- Render Rating as Stars -->
                                <?php $rating = floatval( $testimonial['testimonial_rating']['size'] ); ?>                           
                                <?php if($show_testimonial_rating === 'yes') : ?> 
                                    <?php if($show_rating_text === 'yes') : ?>
                                        <div class="rating-text"><?php echo '<i class="fa fa-star" aria-hidden="true"></i> <span> '. $rating . ' </span>'; ?> </div>
                                    <?php else: ?>                        
                                        <div class="testimonial-rating">
                                            <div class="rating"  style="width: <?php echo $rating * 18; ?>px;">
                                                <?php
                                                    for ( $i = 1; $i <= 5; $i++ ) {                                
                                                        echo '<i class="fa fa-star" aria-hidden="true"></i>';
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>                                     
                                <?php endif; ?>
                                <p class="description"><?php echo esc_html($testimonial['testimonial_text']); ?></p>
                                <h5 class="name-designation"><?php echo esc_html($testimonial['testimonial_name']); ?>, <?php echo esc_html($testimonial['testimonial_designation']); ?></h5>
                                
                            </div>
                            
                        </div>
                    </div>
            <?php
                }

                echo '</div>';
                if ($show_testimonial_navigations === 'yes') {
                    echo '<div class="owl-theme"><div class="owl-controls"><div class="custom-nav3 owl-nav"></div></div></div>';
                }
                if ($show_pagination_dots === 'yes') {
                    echo '<div class="customDots"><div id="customDots3" class="owl-dots"></div></div>';
                }
                echo '</div>';
            }
            ?>

            <?php if ($show_testimonial_quote_img === 'yes') : ?>
                <style id="testimonial_quote_img_owl">
                    <?php if (!empty($settings['testimonial_quote_img']['url'])) : ?>
                        
                        .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-one .testimonials-items p::before {
                            content: url('<?php echo esc_url($settings['testimonial_quote_img']['url']); ?>');
                        }
                        .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testimonials-items .testi-profile-img::before {
                            content: url('<?php echo esc_url($settings['testimonial_quote_img']['url']); ?>');
                        }
                        .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items .testi-profile-img::before {
                            content: url('<?php echo esc_url($settings['testimonial_quote_img']['url']); ?>');
                        }
                    <?php endif; ?>
                </style>
            <?php elseif (!empty($settings['testimonial_quote_icon']['value']) && $show_testimonial_quote_img !== 'yes'): ?>
                <style id="testimonial_quote_img_owl">
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-one .testimonials-items p::before {
                        content: '';
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testimonials-items .testi-profile-img::before {
                        content: '';
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items .testi-profile-img::before {
                        content: '';
                    }
                </style>
            <?php elseif ($settings['hide_testimonial_default_quote_img'] === 'yes'): ?>
                <style id="testimonial_quote_img_owl">
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-one .testimonials-items p::before {
                        content: '';
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testimonials-items .testi-profile-img::before {
                        content: '';
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items .testi-profile-img::before {
                        content: '';
                    }
                </style>
            <?php else : ?>
                <style id="testimonial_quote_img_owl">
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-one .testimonials-items p::before {
                        content: url('<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote.png'); ?>');
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testimonials-items .testi-profile-img::before {
                        content: url('<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote2.png'); ?>');
                    }
                    .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items .testi-profile-img::before {
                        content: url('<?php echo esc_url(plugin_dir_url(dirname(__FILE__)) . '../assets/images/quote3.png'); ?>');
                    }
                </style>
            <?php endif; ?>
            <style id="babe_testimonial_widget">                
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> {
                    position: relative;
                }


                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav {
                    position: absolute;
                    top: 20%;
                    left: 0;
                    right: 0;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-prev,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-next {
                    position: absolute;
                    /* height: 100px; */
                    color: inherit;
                    background: none;
                    border: none;
                    z-index: 9999;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-prev i,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-next i {
                    font-size: 2rem;
                    color: #030326;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-prev {
                    left: 0;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-next {
                    right: 0;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .owl-next,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .owl-prev {
                    top: 10px;
                }


                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testi-profile-img,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testi-profile-img {
                    display: block;
                    width: 75px;
                    height: 75px;
                    position: relative;
                    margin: 20px auto;
                }



                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testi-profile-img {
                    display: block;
                    width: 150px;
                    height: 150px;
                    position: relative;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-two .testi-profile-img img,
                .testimonial-layout-three .testi-profile-img img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 50%;
                    margin: 0 auto;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items {
                    display: flex;
                    align-items: center;
                    gap: 40px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?>
                .testimonial-layout-two
                .testimonials-items
                .testi-profile-img::before {
                    position: absolute;
                    top: -12px;
                    z-index: -1;
                    left: -53px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?>
                .testimonial-layout-three
                .testimonials-items
                .testi-profile-img::before {
                    position: absolute;
                    top: -30px;
                    z-index: 1;
                    left: inherit;
                    right: -34px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav2 .owl-prev,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav2 .owl-next,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-prev,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-next {
                    width: 40px;
                    height: 40px;
                    color: #fff;
                    border-radius: 50%;
                    background: #cb0020;
                    border: none;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-prev,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-next {
                    background: #c5c9bc;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-prev svg,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav .owl-next svg,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav2 .owl-prev svg,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav2 .owl-next svg,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-prev svg,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .custom-nav3 .owl-next svg {
                    width: 20px;
                    height: 20px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-theme .owl-controls {
                    position: relative;
                    z-index: 1;
                    margin-top: 0px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .item {
                    padding: 2rem;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .owl-item.active::after {
                    background: #f2f5eb;
                    content: ".";
                    height: 100%;
                    display: block;
                    position: absolute;
                    top: 0;
                    right: -110px;
                    z-index: -1;
                    width: 88%;
                    transform: skew(-21deg, -0deg);
                    visibility: inherit;
                    padding: 2rem 0;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .deatil-wrap p {
                    font-size: 18px;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-prev i,
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-next i {
                    font-size: 16px;
                    top: 12px;
                    position: unset;
                }
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .owl-dots{
                    text-align: center;
                }
                @media screen and (max-width: 576px) {
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .item {
                    padding: 1rem;
                }
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .testimonials-items {
                    display: block;
                    text-align: center;
                }

                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .owl-item.active::after {
                    right: -153px;
                }
                }

                @media screen and (max-width: 480px) {
                .testimonialsWrap<?php echo esc_attr($unique_id); ?> .testimonial-layout-three .owl-item.active::after {
                    right: -100px;
                }
                }
            </style>
            <script id="babe_testimonials<?php echo esc_attr($unique_id); ?>">                
                    function testimonialSlider() {
                        
                        let unique_id = '.testimonialsWrap' + '<?php echo esc_attr($unique_id); ?>' + ' ';                        
                        let babeTestimonial = document.querySelector(unique_id + '<?php echo $carousel_class; ?>');
                        
                        if (babeTestimonial) {
                            jQuery(babeTestimonial).owlCarousel({
                                stagePadding: 0,
                                loop: true,
                                margin: 10,
                                nav: true,
                                navContainer: '<?php echo $navContainer; ?>',
                                // navText: ["<i class='fa-solid fa-chevron-left'></i>", "<i class='fa-solid fa-chevron-right'></i>"],
                                navText: [
                                    '<?php
                                        // Render the Previous Button Icon
                                        if (!empty($settings['testimonial_prev_button_icon']['value'])) {
                                            Icons_Manager::render_icon($settings['testimonial_prev_button_icon'], ['aria-hidden' => 'true']);
                                        } else {
                                            echo '<i class="fa-solid fa-chevron-left"></i>';
                                        }
                                        ?>',
                                    '<?php
                                        // Render the Previous Button Icon
                                        if (!empty($settings['testimonial_next_button_icon']['value'])) {
                                            Icons_Manager::render_icon($settings['testimonial_next_button_icon'], ['aria-hidden' => 'true']);
                                        } else {
                                            echo '<i class="fa-solid fa-chevron-right"></i>';
                                        }
                                        ?>'

                                ],
                                dots: true,
                                dotsContainer: '<?php echo $dotsContainer; ?>',
                                // dotsClass:'customDots',
                                responsive: {
                                    0: {
                                        items: 1,
                                        // nav: true
                                    },
                                    600: {
                                        items: 1,
                                        // nav: true
                                    },
                                    1000: {
                                        items: 1,
                                        // nav: true,
                                        // loop: true
                                    }
                                }
                            });
                        }
                    }
                    // testimonialSlider();
                
                // Elementor Preview Mode
                window.addEventListener('elementor/frontend/init', function() {
                    elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
                        testimonialSlider();
                    });
                });

                // Frontend Mode
                document.addEventListener("DOMContentLoaded", function() {
                    testimonialSlider();
                });

                testimonialSlider();
                
            </script>
    <?php
        }
    }
}
