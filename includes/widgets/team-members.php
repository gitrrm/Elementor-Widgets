<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit;

class Team_Members extends Widget_Base {

    public function get_name() {
        return 'team_members';
    }

    public function get_title() {
        return __( 'Team Members', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'team_members_layout',
            [
                'label' => __( 'Layout', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Add layout control: Slider or Grid
        $this->add_control(
            'layout_type',
            [
                'label' => __( 'Layout Type', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => [
                    'slider' => __( 'Slider', 'babe-addons' ),
                    'grid'   => __( 'Grid', 'babe-addons' ),
                ],
            ]
        );

        $this->end_controls_section();
        $this->start_controls_section(
            'team_members_section',
            [
                'label' => __( 'Team Members', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $repeater = new \Elementor\Repeater();
    
        // Member Image
        $repeater->add_control(
            'team_image',
            [
                'label' => __( 'Member Image', 'babe-addons' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        // Member Name
        $repeater->add_control(
            'team_name',
            [
                'label' => __( 'Member Name', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'John Doe', 'babe-addons' ),
            ]
        );
    
        // Member Designation
        $repeater->add_control(
            'team_designation',
            [
                'label' => __( 'Member Designation', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Designation', 'babe-addons' ),
            ]
        );
    
        // Member Description
        $repeater->add_control(
            'team_description',
            [
                'label' => __( 'Member Description', 'babe-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'This is the team member description.', 'babe-addons' ),
            ]
        );
    
        // Social Media Icons and Links
        $repeater->add_control(
            'social_media_icons',
            [
                'label' => __( 'Social Media Icons', 'babe-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'social_icon',
                        'label' => __( 'Icon', 'babe-addons' ),
                        'type' => Controls_Manager::ICONS,
                        'default' => [
                            'value' => 'fab fa-facebook',
                            'library' => 'fa-brands',
                        ],
                    ],
                    [
                        'name' => 'social_url',
                        'label' => __( 'Link', 'babe-addons' ),
                        'type' => Controls_Manager::URL,
                        'placeholder' => __( 'https://your-link.com', 'babe-addons' ),
                        'default' => [
                            'url' => '',
                        ],
                    ],
                ],
                'default' => [
                    [
                        'social_icon' => [ 'value' => 'fab fa-facebook', 'library' => 'fa-brands' ],
                        'social_url' => [ 'url' => 'https://facebook.com' ],
                    ],
                    [
                        'social_icon' => [ 'value' => 'fab fa-twitter', 'library' => 'fa-brands' ],
                        'social_url' => [ 'url' => 'https://twitter.com' ],
                    ],
                ],
                'title_field' => '<i class="{{ social_icon.value }}"></i> {{{ social_url.url }}}',
            ]
        );
    
        // Add Repeater to Team Members Section
        $this->add_control(
            'team_members',
            [
                'label' => __( 'Team Members', 'babe-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                        'team_name' => __( 'John Doe', 'babe-addons' ),
                        'team_designation' => __( 'Designation', 'babe-addons' ),
                        'team_description' => __( 'This is the team member description.', 'babe-addons' ),
                        'social_media_icons' => [
                            [ 'social_icon' => [ 'value' => 'fab fa-facebook', 'library' => 'fa-brands' ], 'social_url' => [ 'url' => 'https://facebook.com' ] ],
                            [ 'social_icon' => [ 'value' => 'fab fa-twitter', 'library' => 'fa-brands' ], 'social_url' => [ 'url' => 'https://twitter.com' ] ],
                        ],
                    ],
                ],
                'title_field' => '{{{ team_name }}}',
            ]
        );
    
        $this->end_controls_section();
        // Add controls for navigation arrows
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
        // Slider Settings - Javascript Controls
        $this->start_controls_section(
            'team_slider_settings',
            [
                'label' => __( 'Slider Settings', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
			'autoplay',
			[
				'label' => esc_html__( 'Autoplay', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'babe-addons' ),
				'label_off' => esc_html__( 'Off', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'loop',
			[
				'label' => esc_html__( 'Loop', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'babe-addons' ),
				'label_off' => esc_html__( 'Off', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'nav',
			[
				'label' => esc_html__( 'Navigation', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'babe-addons' ),
				'label_off' => esc_html__( 'Off', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
        $this->add_control(
			'autoplay_timeout',
			[
				'label' => esc_html__( 'Autoplay Timeout', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 500,
				'max' => 10000,
				'step' => 100,
				'default' => 5000,
			]
		);
        $this->add_control(
            'dots',
            [
                'label' => esc_html__( 'Show Dots', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'On', 'babe-addons' ),
                'label_off' => esc_html__( 'Off', 'babe-addons' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
			'show_navigation_on_bottom',
			[
				'label' => esc_html__( 'Show Navigation On Bottom', 'babe-addons' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'On', 'babe-addons' ),
				'label_off' => esc_html__( 'Off', 'babe-addons' ),
				'return_value' => 'yes',
				'default' => 'yes',
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

        // Style Tab
        // Container Style
        $this->start_controls_section(
            'container_style_section',
            [
                'label' => __( 'Team Member Container', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'member_container_color',
                'label' => __( 'Container Background', 'babe-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ], // Supports multiple background types
                'selector' => '{{WRAPPER}} .team-members-carousel .team-member', // Apply the background to the container
                'fields_options' => [
                    'background' => [
                        'responsive' => true, 
                    ],
                ],
                'default' => [
                    'background' => 'transparent', 
                ],
            ]
        );
        

        // Margin around the container
       $this->add_responsive_control(
            'container_margin',
            [
                'label' => __( 'Container Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .team-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );      

        // Padding around the container
        $this->add_responsive_control(
            'container_padding',
            [
                'label' => __( 'Container Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .team-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Container Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'label' => __( 'Container Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-members-carousel .team-member',
                'fields_options' => [
                    'border' => [
                        'responsive' => true,  // This allows you to specify border for different devices
                    ],
                ],
            ]
        );
        
        // Container Border Radius
        $this->add_responsive_control(
            'container_border_radius',
            [
                'label' => __( 'Container Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .team-member' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Container shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'container_box_shadow',
                'label' => __( 'Container Box Shadow', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-members-carousel .team-member',
            ]
        );        
        
        $this->end_controls_section();


        // Image Style
        $this->start_controls_section(
            'image_style_section',
            [
                'label' => __( 'Image Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Padding around the images
        $this->add_control(
            'image_padding',
            [
                'label' => __( 'Image Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member .image-wrap img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Responsive Image Height
        $this->add_responsive_control(
            'image_height',
            [
                'label' => __( 'Image Height', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vh' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .team-member img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Image Border
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_border',
                'label' => __( 'Image Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-member .image-wrap img',
            ]
        );
        // Border Radius for Images
        $this->add_control(
            'image_border',
            [
                'label' => __( 'Image Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member .image-wrap img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        // Image shadow
        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'image_box_shadow',
                'label' => __( 'Image Box Shadow', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-member .image-wrap img',
            ]
        ); 
        // Image Filter
        $this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'image_css_filters',
				'selector' => '{{WRAPPER}} .team-member .image-wrap img',
			]
		);  
        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'team_title_section_style',
            [
                'label' => __( 'Title Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Title Style
        $this->add_control(
            'team_title_heading',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'title_alignment',
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
                    '{{WRAPPER}} .team-member-info .member-name' => 'text-align: {{VALUE}};',
                    '{{WRAPPER}} .babe-team-grid-layout .member-name' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'team_title_color',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .babe-team-grid-layout .member-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-member-info .member-name',
                'selector' => '{{WRAPPER}} .babe-team-grid-layout .member-name',
            ]
        );
        
        // Title Spacing (Margin & Padding)
        $this->add_control(
            'team_title_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .babe-team-grid-layout .member-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'team_title_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .babe-team-grid-layout .member-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Sub title - Designation
        $this->start_controls_section(
            'team_designation_section_style',
            [
                'label' => __( 'Designation Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Designation Style
        $this->add_control(
            'team_designation_heading',
            [
                'label' => __( 'Designation', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Designation Alignment
        $this->add_control(
            'designation_alignment',
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
                    '{{WRAPPER}} .team-member-info .member-designation' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'team_designation_color',
            [
                'label' => __( 'Designation Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'designation_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-member-info .member-designation',
            ]
        );
        
        // Designation Spacing (Margin & Padding)
        $this->add_control(
            'team_designation_margin',
            [
                'label' => __( 'Designation Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'team_designation_padding',
            [
                'label' => __( 'Designation Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .member-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
         // Sub title - Designation
         $this->start_controls_section(
            'team_description_section_style',
            [
                'label' => __( 'Description Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Description Style
        $this->add_control(
            'team_description_heading',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Description Alignment
        $this->add_control(
            'description_alignment',
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
                    '{{WRAPPER}} .team-member-info .about-member' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'team_description_color',
            [
                'label' => __( 'Description Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .about-member' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-member-info .about-member',
            ]
        );
        
        // Designation Spacing (Margin & Padding)
        $this->add_control(
            'team_description_margin',
            [
                'label' => __( 'Description Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .about-member' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'team_description_padding',
            [
                'label' => __( 'Description Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-member-info .about-member' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

         // Navigation
         $this->start_controls_section(
            'team_navigation_section_style',
            [
                'label' => __( 'Navigation Elements Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        // Description Style
        $this->add_control(
            'team_navigation_heading',
            [
                'label' => __( 'Navigation', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->add_control(
            'nav_arows_color',
            [
                'label' => __( 'Arrows Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-prev i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-next i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-prev svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-next svg' => 'fill: {{VALUE}};',
                    
                ],
            ]
        );
        $this->add_control(
            'nav_arows_hover_color',
            [
                'label' => __( 'Arrows Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-prev:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-next:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-prev:hover svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .team-members-carousel .owl-next:hover svg' => 'fill: {{VALUE}};',
                    
                ],
            ]
        );
        $this->add_control(
            'nav_background_color',
            [
                'label' => __( 'Navigation Background Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-nav button.owl-next' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .team-members-carousel .owl-nav button.owl-prev' => 'background-color: {{VALUE}} !important;',                
                ],
            ]
        );
        $this->add_control(
            'nav_background_hover_color',
            [
                'label' => __( 'Navigation Background Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-nav button.owl-next:hover' => 'background-color: {{VALUE}} !important;',
                    '{{WRAPPER}} .team-members-carousel .owl-nav button.owl-prev:hover' => 'background-color: {{VALUE}} !important;',                
                ],
            ]
        );
        $this->add_control(
            'nav_dot_color',
            [
                'label' => __( 'Dots Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-carousel .owl-dots button.owl-dot' => 'background-color: {{VALUE}} !important;',            
                ],
            ]
        );
        $this->add_control(
            'nav_dot_hover_color',
            [
                'label' => __( 'Dots Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-carousel .owl-dots button.owl-dot:hover' => 'background-color: {{VALUE}} !important;',              
                ],
            ]
        );
        $this->add_control(
            'nav_dot_active_color',
            [
                'label' => __( 'Dot Active Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-members-carousel .owl-carousel .owl-dots button.owl-dot.active' => 'background-color: {{VALUE}} !important;',              
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $layout_type = $settings['layout_type'];
        
        if ( ! empty( $settings['team_members'] )) {
            if($layout_type == 'slider') {
                echo '<div class="team-members-carousel owl-carousel">';
                foreach ( $settings['team_members'] as $member ) {
                    echo '<div class="team-member">';
                    echo '<div class="image-wrap">';
                    echo '<img src="' . esc_url( $member['team_image']['url'] ) . '" alt="' . esc_attr( $member['team_name'] ) . '" />';
                    echo '</div>';
                    echo '<div class="team-member-info">';
                    echo '<h3 class="member-name">' . esc_html( $member['team_name'] ) . '</h3>';
                    echo '<h4 class="member-designation">' . esc_html( $member['team_designation'] ) . '</h4>';
                    echo '<p class="about-member">' . esc_html( $member['team_description'] ) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>';
            }else{
                echo '<div class="babe-team-grid-layout">';
                    foreach ( $settings['team_members'] as $member ) {
                        echo '<div class="babe-item">';
                            echo '<div class="img-holder">';
                                echo '<img src="' . esc_url( $member['team_image']['url'] ) . '" alt="' . esc_attr( $member['team_name'] ) . '" />';
                            echo '</div>';
                            echo '<div class="deatil-wrap mt-3">';
                                echo '<div class="team-description">';
                                    echo '<h3 class="member-name">' . esc_html( $member['team_name'] ) . '</h3>';
                                    echo '<h4 class="member-designation">' . esc_html( $member['team_designation'] ) . '</h4>';
                                    echo '<p class="about-member">' . esc_html( $member['team_description'] ) . '</p>';
                                echo '</div>';
                            echo '</div>';
                            // Social Media Links
                            if ( ! empty( $member['social_media_icons'] ) ) {
                                echo '<div class="team-social-media">';
                                foreach ( $member['social_media_icons'] as $social ) {
                                    if ( ! empty( $social['social_url']['url'] ) && ! empty( $social['social_icon']['value'] ) ) {
                                        echo '<a href="' . esc_url( $social['social_url']['url'] ) . '" target="_blank">';
                                        echo '<i class="' . esc_attr( $social['social_icon']['value'] ) . '"></i>';
                                        echo '</a>';
                                    }
                                }
                                echo '</div>';
                            }
                        // echo '</div>';

                        
                            
                        echo '</div>';// Close .babe-item
                    }
                    echo '</div>';// Close .babe-team-grid-layout
            }
            

            // Get the navigation arrow icons
            $prev_arrow_icon = $settings['prev_arrow_icon'];
            $next_arrow_icon = $settings['next_arrow_icon'];

            $autoplay = $settings['autoplay'] === 'yes' ? 'true' : 'false';
            $loop = $settings['loop'] === 'yes' ? 'true' : 'false';
            $nav = $settings['nav'] === 'yes' ? 'true' : 'false';
            $autoplay_timeout = $settings['autoplay_timeout'];
            $dots = $settings['dots'] === 'yes' ? 'true' : 'false';
            $show_navigation_on_bottom = $settings['show_navigation_on_bottom'] === 'yes' ? 'true' : 'false';
            $hide_navigation = $settings['hide_navigation'] === 'yes' ? 'true' : 'false';
            // $hide_dots = $settings['hide_dots'] === 'no' ? 'false' : 'true';

            ?>
    <style>
      /* team layout css */
      .babe-team-grid-layout{
        display: grid;
        grid-template-columns: auto auto auto ;
        gap:25px;
        grid-auto-columns: 1fr;  
        width: 100%;
    }
      
      .babe-team-grid-layout .babe-item
      {
        min-height:50vh;
        max-height:50vh;
        position: relative;
        overflow: hidden;
        
        cursor: pointer;
      }
      .babe-team-grid-layout .babe-item .img-holder {
        overflow: hidden;
        position: relative;
        width: 100%;
        height: 100%;
      }
      .babe-team-grid-layout .babe-item .img-holder img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        aspect-ratio: inherit;
      }
      .babe-team-grid-layout .babe-item .img-holder img {
        transition-duration: 2s;
      }
      .babe-team-grid-layout .babe-item:hover .img-holder img {
        transform: scale(1.2);
      }
      
      .babe-team-grid-layout .deatil-wrap {
        position: absolute;
        bottom:0px;
        background-color: #3117ea;
        padding: 20px;
        width:calc(100% - 80px);
        transition: 0.5s 0.25s cubic-bezier(0.17, 0.67, 0.5, 1.03);
      }
      
      .babe-team-grid-layout .deatil-wrap h4 {
        font-size: 1.2rem;
        color: #ffffff;
      }
      .babe-team-grid-layout .deatil-wrap p {
        font-size: 1rem;
        font-weight: 400;
        margin: 0;
      }
      .babe-team-grid-layout .deatil-wrap p {
        color: #ffffff;
      }
      
      .babe-team-grid-layout .team-social-media{
        display: flex;
        gap:8px;
        margin-top:10px;
        background-color: #3117ea;
        width:calc(100% - 80px);
        padding: 20px;
        bottom: 0;
        position: absolute;
        transform: translateY(80px);
        transition: 0.5s 0.25s cubic-bezier(0.17, 0.67, 0.5, 1.03);
      }
      .babe-team-grid-layout .team-social-media a{
        color: #d8d8d8;
        font-size:0.9rem;
        padding:14px;
        height: 24px;
        width:24px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #2b11e2;
        border-radius: 50%;
        border: 1px solid #d8d8d8;
        transition: 0.5s ease;
      }
      .babe-team-grid-layout .babe-item:hover .deatil-wrap {
        transform: translateY(80px);
      }
      .babe-team-grid-layout .babe-item:hover .team-social-media{
        transform: translateY(0px);
      }
      .babe-team-grid-layout .team-social-media a:hover{
        color: #f7f7f7;
        border: 1px solid #f7f7f7;
        background: #220aca;
      }
      @media (max-width:991px){
        .babe-team-grid-layout{
          grid-template-columns: auto auto auto ;
          gap:15px;
        }
      .babe-team-grid-layout .babe-item
        {
          min-height:36vh;
          max-height:36vh;
        }
       
        .babe-team-grid-layout .deatil-wrap, .babe-team-grid-layout .team-social-media {
          width: calc(100% - 20px);
        }
      }
      @media (max-width:767px){
        .babe-team-grid-layout{
          grid-template-columns: auto;
          gap:15px;
        }
        .babe-team-grid-layout .babe-item
        {
          min-height:45vh;
          max-height:45vh;
        }
      }
      
    </style>
            <script>
                jQuery(document).ready(function($) {
                    if ( $('.team-members-carousel').length ) {
                        $('.team-members-carousel').owlCarousel({
                            loop:<?php echo $loop; ?>,
                            margin: 10,
                            nav: <?php echo $nav; ?>,
                            navText: [
                                '<i class="<?php echo esc_attr( $prev_arrow_icon['value'] ); ?>"></i>',
                                '<i class="<?php echo esc_attr( $next_arrow_icon['value'] ); ?>"></i>'
                            ],
                            dots: <?php echo $dots; ?>,
                            autoplay: <?php echo $autoplay; ?>,
                            autoplayTimeout: <?php echo $autoplay_timeout; ?>,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 2
                                },
                                1000: {
                                    items: 3
                                }
                            }
                        });
                    }
                });
            </script>
            
            <style>
                .team-members-carousel .owl-carousel .owl-dots button.owl-dot.active{
                    background-color: blue !important;
                }
                .team-members-carousel .team-member {
                    text-align: center;
                    padding: 0;
                    background-color: transparent;
                    border: none;
                    border-radius: 0;
                    margin: 0;
                    overflow: hidden;
                }
                .team-members-carousel .owl-nav button.owl-next, .team-members-carousel .owl-nav button.owl-prev {
                   
                    width: 40px;
                    height: 40px;
                    border-radius: 50%;
                }
                .team-members-carousel .owl-nav button.owl-next i, .team-members-carousel .owl-nav button.owl-prev i {
                    margin-left: 2px;
                }
                .team-members-carousel .team-member img {
                    max-width: 100%;
                    height: 400px;
                    object-fit: cover;
                }
                .team-member-info h3 {
                    font-size: 1.2rem;
                    margin-top: 10px;
                }
                .team-member-info h4 {
                    font-size: 1rem;
                    margin-bottom: 10px;
                    color: #555;
                }
                .team-member-info p {
                    font-size: 0.9rem;
                    color: #666;
                }
                .owl-carousel {
                    margin-bottom: 60px;
                }
                .owl-nav {
                    position: absolute;
                    top: 50%;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }
                .owl-nav button {
                    background: transparent;
                    border: none;
                    font-size: 2rem;
                    cursor: pointer;
                    color: #000;
                }
                .owl-dots {
                    text-align: center;
                    margin-top: 20px;
                }
                .owl-dot {
                    display: inline-block;
                    width: 10px;
                    height: 10px;
                    background: #ddd;
                    border-radius: 50%;
                    margin: 0 5px;
                    cursor: pointer;
                }
                .owl-dot.active {
                    background: #333;
                }
                .owl-carousel .owl-stage {
                    padding-bottom: 10px;
                }
                
                <?php if( $show_navigation_on_bottom === 'true'): ?>
                    .owl-nav {
                        position: absolute;
                        top: 100%;
                        width: 12%;
                        left: 50%;
                        transform: translateX(-50%);
                        display: flex;
                        justify-content: space-between;
                        margin-top: 15px;
                    }
                    
                    @media (max-width: 1024px){
                        .owl-nav {                        
                            width: 18%;
                        }
                    }
                    @media (max-width: 576px){
                        .owl-nav {                        
                            width: 36%;
                        }
                    }
                <?php endif; ?>

                <?php if( $hide_navigation === 'true' ): ?>
                    .owl-nav{
                        display: none;
                    }
                <?php endif; ?>
            </style>
            <?php
        }
    }

   
}
?>
