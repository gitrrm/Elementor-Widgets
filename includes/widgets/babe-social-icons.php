<?php
/**
 * Babe Social Icons Widget
 */
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

class Babe_Social_Icons_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'babe_social_icons';
    }

    public function get_title() {
        return __( 'Babe Social Icons', 'babe-addons' );
    }

    public function get_icon() {
        return 'fa fa-share-alt';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_social_icons',
            [
                'label' => __( 'Social Icons', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'social_icons',
            [
                'label' => __( 'Social Icons', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'icon',
                        'label' => __( 'Icon', 'babe-addons' ),
                        'type' => \Elementor\Controls_Manager::ICONS,
                        'label_block' => true,
                        'default' => [
                            'value' => 'fa fa-facebook',
                            'library' => 'fa-solid',
                        ],
                    ],
                    [
                        'name' => 'name',
                        'label' => __( 'Name', 'babe-addons' ),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'placeholder' => __( 'Facebook', 'babe-addons' ),
                        'label_block' => true,
                    ],
                    [
                        'name' => 'link',
                        'label' => __( 'Link', 'babe-addons' ),
                        'type' => \Elementor\Controls_Manager::URL,
                        'placeholder' => __( 'https://example.com', 'babe-addons' ),
                        'label_block' => true,
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();

        // Add a new control for display direction
        $this->start_controls_section(
            'section_display_settings',
            [
                'label' => __( 'Display Settings', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'icon_display',
            [
                'label' => __( 'Display Direction', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => __( 'Horizontal', 'babe-addons' ),
                    'vertical' => __( 'Vertical', 'babe-addons' ),
                ],
            ]
        );

        $this->end_controls_section();

        // Style section for icon color, background color, and border
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Designs', 'babe-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'babe_social_icon_alignment',
            [
                'label' => __( 'Alignment', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Left', 'babe-addons' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'babe-addons' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'Right', 'babe-addons' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'flex-start',
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icons' . $this->get_id() => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        // Normal Color and Background Color
        $this->start_controls_tabs( 'color_tabs' );

        // Normal Tab
        $this->start_controls_tab(
            'normal_tab',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => __( 'Icon Color', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => __( 'Background Color', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b5998',
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Normal Tab

        // Hover Tab
        $this->start_controls_tab(
            'hover_tab',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'hover_icon_color',
            [
                'label' => __( 'Hover Icon Color', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon:hover i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_bg_color',
            [
                'label' => __( 'Hover Background Color', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#3b5998',
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab(); // End Hover Tab

        $this->end_controls_tabs(); // End Color Tabs

        // Group Border Control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'babe_social_icon_border', // Unique name for the border control
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .babe-social-icon',
                'separator' => 'before',
            ]
        );

        // Radius control
        $this->add_responsive_control(
            'babe_social_icon_border_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'rem' ],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Height Control
        $this->add_responsive_control(
            'babe_social_icon_height',
            [
                'label' => __( 'Height', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'default' => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Width Control
        $this->add_responsive_control(
            'babe_social_icon_width',
            [
                'label' => __( 'Width', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'default' => [
                    'size' => 50,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Icon Size Control
        $this->add_responsive_control(
            'babe_social_icon_size',
            [
                'label' => __( 'Icon Size', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', 'rem' ],
                'default' => [
                    'size' => 20,
                    'unit' => 'px',
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        // Add gap between items control
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
                    'size' => 15, 
                    'unit' => 'px', 
                ],
                'tablet_default' => [
                    'size' => 15, 
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 15, 
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-social-icons'. $this->get_id() => 'gap: {{SIZE}}{{UNIT}};', 
                ],
            ]
        );

        $this->end_controls_section(); // End Style Section
    }



    protected function render() {
        $settings = $this->get_settings_for_display();
        $social_icons = $settings['social_icons'];
        $display_direction = $settings['icon_display'];
        $icon_alignment = isset( $settings['babe_social_icon_alignment'] ) ? $settings['babe_social_icon_alignment'] : 'flex-start'; // Default to 'flex-start'
        $widget = $this->get_data();
        $unique_id = $widget['id'];
        ?>
        <style>
            .babe-social-icons<?php echo $unique_id; ?> {
                justify-content: <?php echo esc_attr( $icon_alignment ); ?>
            }
        </style>
        <?php

        if ( ! empty( $social_icons ) ) {
            echo '<div class="babe-social-icons" style="display: flex; flex-direction: ' . ($display_direction === 'vertical' ? 'column' : 'row') . '; justify-content: ' . esc_attr( $icon_alignment ) . ';">';

            foreach ( $social_icons as $icon ) {
                $icon_link = ! empty( $icon['link']['url'] ) ? $icon['link']['url'] : '#';
                echo '<div class="babe-social-icon" style="margin: 5px;">';
                if ( ! empty( $icon['icon']['value'] ) ) {
                    echo '<a href="' . esc_url( $icon_link ) . '" target="_blank" rel="noopener noreferrer"><i class="' . esc_attr( $icon['icon']['value'] ) . '"></i></a>';
                }
                echo '</div>';
            }

            echo '</div>';
        }
        ?>
        
        <?php
    }

    

   
    
}


