<?php
// Ensure Elementor is active
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

class Babe_Simple_Tabs extends Widget_Base {

    public function get_name() {
        return 'babe_simple_tab_widget';
    }

    public function get_title() {
        return __( 'Simple Tab Button', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    public function register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Title control
        $this->add_control(
            'babe_title',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Title',
            ]
        );

        // Sub Title control
        $this->add_control(
            'babe_sub_title',
            [
                'label' => __( 'Sub Title', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Sub Title',
            ]
        );

        // Description control
        $this->add_control(
            'babe_description',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Description',
            ]
        );

        // Icon control
        $this->add_control(
            'icon',
            [
                'label' => esc_html__( 'Icon', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'far fa-arrow-alt-circle-right',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );
        // Hyperlink control
        $this->add_control(
            'link',
            [
                'label' => __( 'Tab Link', 'babe-addons' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'babe-addons' ),
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'title_section',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Style
        $this->add_control(
            'title_heading',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000', // Default color set to black
                'selectors' => [
                    '{{WRAPPER}} h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Title Hover Color
        $this->add_control(
            'title_hover_color',
            [
                'label' => __( 'Title Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-simple-tab:hover h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} h2',
            ]
        );

        // Title Spacing (Margin & Padding)
        $this->add_control(
            'title_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Subtitle Style
        $this->start_controls_section(
            'subtitle_section',
            [
                'label' => __( 'Sub Title', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'sub_title_heading',
            [
                'label' => __( 'Sub Title', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label' => __( 'Sub Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000', // Default color set to black
                'selectors' => [
                    '{{WRAPPER}} h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        // Sub Title Hover Color
        $this->add_control(
            'sub_title_hover_color',
            [
                'label' => __( 'Sub Title Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-simple-tab:hover h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} h3',
            ]
        );

        // Subtitle Spacing (Margin & Padding)
        $this->add_control(
            'sub_title_margin',
            [
                'label' => __( 'Sub Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h3' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_padding',
            [
                'label' => __( 'Sub Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} h3' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Description Style
        $this->start_controls_section(
            'description_section',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_control(
            'description_heading',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => __( 'Description Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000', // Default color set to black
                'selectors' => [
                    '{{WRAPPER}} .tab-desc' => 'color: {{VALUE}};',
                ],
            ]
        );
         
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .tab-desc',
            ]
        );

        $this->end_controls_section();

         // Icon Style
        $this->start_controls_section(
            'icon_section',
            [
                'label' => __( 'Icon', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

       
        $this->add_control(
            'icon_heading',
            [
                'label' => __( 'Icon', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-icon-wrapper i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .babe-icon-wrapper svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        
        $this->add_control(
            'icon_hover_color_heading',
            [
                'label' => __( 'Icon Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'icon_hover_color',
            [
                'label' => __( 'Icon Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .babe-simple-tab:hover i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .babe-simple-tab:hover svg' => 'fill: {{VALUE}};',
                    
                ],
            ]
        );
       
        $this->add_control(
            'icon_size',
            [
                'label' => __( 'Icon Size', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                    'rem' => [
                        'min' => 0,
                        'max' => 10,
                        'step' => 0.1,
                    ],
                ],
                'default' => [
                    'size' => 18,    // Default value set to 18px
                    'unit' => 'px',  // Default unit is set to 'px'
                ],
                'size_units' => [ 'px', '%', 'em', 'rem' ], // Add supported units
                'selectors' => [
                    '{{WRAPPER}} .babe-icon-wrapper i' => 'font-size: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .babe-icon-wrapper svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        
        $this->end_controls_section();

        // Background Style
        $this->start_controls_section(
            'background_section',
            [
                'label' => __( 'Background', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // Background Control (Normal and Hover)
        $this->add_control(
            'background_normal_color_heading',
            [
                'label' => __( 'Tab Background Normal', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'babe-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .babe-simple-tab',
                'fields_options' => [
                    'background' => [
                        'default' => 'classic',
                    ],
                    'color' => [
                        'default' => '#A51FF3', // Default background color set to white
                    ],
                ],
            ]
        );
        
        $this->add_control(
            'background_hover_color_heading',
            [
                'label' => __( 'Tab Background Hover', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        // Background Hover Control
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'background_hover',
                'label' => __( 'Background Hover', 'babe-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .babe-simple-tab:hover',
            ]
        );
        
        // Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'border',
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-simple-tab',
            ]
        );

        // Border Radius Control
        $this->add_control(
            'border_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-simple-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'custom_box_shadow',
            [
                'label' => esc_html__( 'Box Shadow', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::BOX_SHADOW,
                'selectors' => [
                    '{{WRAPPER}} .babe-simple-tab' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
                ],
                'default' => [
                    'horizontal' => 0,
                    'vertical'   => 0,
                    'blur'       => 0,
                    'spread'     => 0,
                    'color'      => 'rgba(0,0,0,0)', // Transparent color for no shadow
                ],
            ]
        );
        
        

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        // Ensure there's a valid link
        $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
        if ( $settings['link']['is_external'] ) {
            $this->add_render_attribute( 'link', 'target', '_blank' );
        }
        if ( $settings['link']['nofollow'] ) {
            $this->add_render_attribute( 'link', 'rel', 'nofollow' );
        }
        ?>
            <div class="col babe-simple-tab">
                <div class="deatil-wrap d-flex w-auto p-3 align-items-center justify-content-between">                    
                    <div>                            
                    <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
                            <h2><?php echo $settings['babe_title']; ?></h2>
                            <h3 class="mb-0"><?php echo $settings['babe_sub_title']; ?></h3>
                            <p class="tab-desc"><?php echo $settings['babe_description']; ?></p>   
                        </a>                        
                    </div>
                    <a <?php echo $this->get_render_attribute_string( 'link' ); ?>>
                    <div class="babe-icon-wrapper">
                        
                            <?php 
                                \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                        
                    </div> 
                    </a>                   
                </div>
            </div>
            
        <?php
    }

   
}
