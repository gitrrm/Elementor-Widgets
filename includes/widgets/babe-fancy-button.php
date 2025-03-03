<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Babe_Fancy_Button extends Widget_Base
{
    public function get_name()
    {
        return 'fancy_button';
    }

    public function get_title()
    {
        return __('Fancy Button', 'text-domain');
    }

    public function get_icon()
    {
        return 'eicon-dual-button';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'fancy_button_content',
            [
                'label' => __('Button', 'text-domain'),
            ]
        );

        $this->add_control(
            'fancy_button_styles',
            [
                'label' => __('Button Types', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'fancy-btn-one',
                'options' => [
                    'fancy-btn-one' => __('Style One', 'babe-addons'),
                    'fancy-btn-two' => __('Style Two', 'babe-addons'),
                ],
                'description'  => __('Select a button style', 'babe-addons'),
            ]
        );
        $this->add_control(
            'fancy_button_title',
            [
                'label' => esc_html__('Button Text', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Explore', 'babe-addons'),
                'placeholder' => esc_html__('Type your title here', 'babe-addons'),
            ]
        );
        $this->add_control(
            'fancy_button_link',
            [
                'label' => esc_html__('Link', 'babe-addons'),
                'type' => Controls_Manager::URL,
                'options' => ['url', 'is_external', 'nofollow'],
                'default' => [
                    'url' => 'https://your-link.com',
                    'is_external' => false,
                    'nofollow' => false,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );


        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'fancy_button_style_section',
            [
                'label' => esc_html__('Button', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );





        $this->add_control(
            'fancy_button_border_radius',
            [
                'label' => __('Border Radius', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
            ]
        );
        $this->start_controls_tabs(
            'fancy_button_state_tabs'
        );

        $this->start_controls_tab(
            'fancy_button_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'fancy_button_text_color_normal',
            [
                'label' => __('Text Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one span, {{WRAPPER}} .fancy-btn-two span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fancy_button_bg_color_normal',
            [
                'label' => __('Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#cb0020',
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one::before, {{WRAPPER}} .fancy-btn-two::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fancy_button_bg_width',
            [
                'label' => __('Background Width', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one::before, {{WRAPPER}} .fancy-btn-two::before' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'responsive' => true,
                'render_type' => 'ui', // Enable the UI for the unit switcher
                'size_units' => ['px', '%', 'em'], // Specify the units available for the switcher
            ]
        );
        
        $this->add_control(
            'fancy_button_bg_height',
            [
                'label' => __('Background Height', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one::before, {{WRAPPER}} .fancy-btn-two::before' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'responsive' => true,
                'render_type' => 'ui', // Enable the UI for the unit switcher
                'size_units' => ['px', '%', 'em'], // Specify the units available for the switcher
            ]
        );


        $this->end_controls_tab();

        $this->start_controls_tab(
            'fancy_button_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'fancy_button_text_color_hover',
            [
                'label' => __('Text Color - Hover', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one:hover span, {{WRAPPER}} .fancy-btn-two:hover span' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fancy_button_bg_color_hover',
            [
                'label' => __('Background Color - Hover', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000',
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one.rounded:hover::before, {{WRAPPER}} .fancy-btn-two.rounded:hover::before' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'fancy_button_bg_width_hover',
            [
                'label' => __('Background Width - Hover', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 200,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one::before:hover, {{WRAPPER}} .fancy-btn-two::before:hover' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'responsive' => true,
                'render_type' => 'ui', // Enable the UI for the unit switcher
                'size_units' => ['px', '%', 'em'], // Specify the units available for the switcher
            ]
        );
        
        $this->add_control(
            'fancy_button_bg_height_hover',
            [
                'label' => __('Background Height', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one::before:hover, {{WRAPPER}} .fancy-btn-two::before:hover' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'responsive' => true,
                'render_type' => 'ui', // Enable the UI for the unit switcher
                'size_units' => ['px', '%', 'em'], // Specify the units available for the switcher
            ]
        );

        $this->end_controls_tabs();

        $this->add_control(
            'fancy_button_bg_dimensions',
            [
                'label' => esc_html__('Background Position', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em', 'rem', 'custom'],
                'default' => [
                    'top' => 0,
                    'right' => 0,
                    'bottom' => 0,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .fancy-btn-one.rounded::before' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'fancy_button_styles' => 'fancy-btn-one', 
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $fancy_button_styles = $settings['fancy_button_styles'];
        if (! empty($settings['fancy_button_link']['url'])) {
            $this->add_link_attributes('fancy_button_link', $settings['fancy_button_link']);
        }
?>
        <?php if ($fancy_button_styles === 'fancy-btn-one') : ?>
            <a <?php $this->print_render_attribute_string('fancy_button_link'); ?> class="fancy-btn-one rounded" style="border-radius: <?php echo esc_attr($settings['fancy_button_border_radius']['size']); ?>px;">
                <span><?php echo $settings['fancy_button_title'] ?></span>
            </a>
        <?php endif; ?>
        <?php if ($fancy_button_styles === 'fancy-btn-two') : ?>
            <a <?php $this->print_render_attribute_string('fancy_button_link'); ?> class="fancy-btn-two">
                <span class="fancy-btn-shape" style="background: <?php echo esc_attr($settings['fancy_button_bg_color']); ?>;"></span>
                <span><?php echo $settings['fancy_button_title'] ?></span>
            </a>
        <?php endif; ?>
        <style>
            /* button component */
            a {
                text-decoration: none;
            }

            .fancy-btn-one {
                border: none;
                padding: 8px 44px;
                font-size: 36px;
                position: relative;
                transition: all 0.50s;
                color: #000;
            }

            .fancy-btn-one::before {
                transition: all 0.85s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                transition: all 0.50s;
                content: "";
                width: 50%;
                height: 100%;
                position: absolute;
                top: 0;
                left: 0;
                z-index: -1;
                border-radius: 50%;
            }



            .fancy-btn-one.rounded::before {
                border-radius: 50px;
                width: 26%;
                background-color: #cb0020;
            }

            .fancy-btn-one.rounded:hover::before {
                background-color: #cb0020;
                width: 100%;
            }

            .fancy-btn-one span:hover {
                color: #ffffff;
            }

            .fancy-btn-two {
                border: none;
                padding: 10px 20px;
                font-size: 36px;
                position: relative;
                transition: all 0.50s;
                color: #000;
                display: inline-block;
                transition: 0.5s;
            }

            .fancy-btn-two .fancy-btn-shape {
                content: "";
                width: 40px;
                height: 40px;
                background-color: #cb0020;
                border-radius: 50%;
                position: absolute;
                top: calc(50% - 20px);
                left: 0;
                z-index: -1;
                transition: 0.5s ease-in-out;
            }

            .fancy-btn-two:hover {
                color: #cb0020
            }

            .fancy-btn-two:hover .fancy-btn-shape {
                left: calc(100% - 40px);
                background-color: #201315;
            }
        </style>
<?php
    }
}
