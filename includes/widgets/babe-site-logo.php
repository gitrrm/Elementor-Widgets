<?php
/**
 * Babe Site Logo 
 */
class Babe_Site_Logo_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'babe_site_logo';
    }

    public function get_title() {
        return __( 'Site Logo', 'babe-addons' );
    }

    public function get_icon() {
        return 'fa fa-image';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function _register_controls() {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $custom_logo_url = ( $custom_logo_id ) ? wp_get_attachment_image_url( $custom_logo_id, 'full' ) : '';

        // Content section for uploading logo
        $this->start_controls_section(
            'section_logo',
            [
                'label' => __( 'Site Logo', 'babe-addons' ),
            ]
        );

        // Logo upload control
        $this->add_control(
            'site_logo',
            [
                'label' => __( 'Logo', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => $custom_logo_url, // Display current site logo if set
                ],
            ]
        );

        // Logo width control
        $this->add_control(
            'logo_width',
            [
                'label' => __( 'Logo Width', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-site-logo' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style section for alignment, padding, margin
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Style', 'babe-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Alignment control
        $this->add_responsive_control(
            'logo_alignment',
            [
                'label' => __( 'Alignment', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .site-logo-container' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        // Padding control
        $this->add_responsive_control(
            'logo_padding',
            [
                'label' => __( 'Padding', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-site-logo' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Margin control
        $this->add_responsive_control(
            'logo_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .babe-site-logo' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Check if a logo is uploaded in the widget or fallback to site logo
        if ( $settings['site_logo']['id'] ) {
            // Update the custom logo in the WordPress database so it's reflected site-wide
            set_theme_mod( 'custom_logo', $settings['site_logo']['id'] );
        }

        // Get the custom logo after updating
        if ( has_custom_logo() ) {
            $logo_url = wp_get_attachment_image_url( get_theme_mod( 'custom_logo' ), 'full' );
        } else {
            $logo_url = '';
        }

        if ( $logo_url ) {
            echo '<div class="site-logo-container">';
            echo '<a href="' . esc_url( home_url( '/' ) ) . '">';
            echo '<img class="babe-site-logo" src="' . esc_url( $logo_url ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
            echo '</a>';
            echo '</div>';
        } else {
            echo '<p>' . __( 'No logo set.', 'babe-addons' ) . '</p>';
        }
    }
}
