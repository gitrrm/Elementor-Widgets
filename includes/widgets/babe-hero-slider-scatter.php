<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
  exit;
}

class Babe_Hero_Slider_Scatter extends \Elementor\Widget_Base {

	// Your widget's name, title, icon and category
    public function get_name() {
        return 'babe_hero_slider_scatter';
    }

    public function get_title() {
        return __( 'Babe Hero Slider Scatter', 'wp-maker-image' );
    }

    public function get_icon() {
        return 'eicon-slider-3d';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }


    

	// Your widget's sidebar settings
    protected function _register_controls() {
        $this->start_controls_section(
            'section_main_title',
            [
            'label' => __( 'Scattered Image Settings', 'babe-addons' ),
            
            ]
        );
        $this->add_control(
            'main_title',
            [
            'label' => __( 'Main Title', 'babe-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Main Title', 'babe-addons' ),
            'placeholder' => __( 'Enter main title', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'sub_title',
            [
            'label' => __( 'Sub Title', 'babe-addons' ),
            'type' => \Elementor\Controls_Manager::TEXT,
            'default' => __( 'Sub Title', 'babe-addons' ),
            'placeholder' => __( 'Enter sub title', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'description',
            [
            'label' => __( 'Description', 'babe-addons' ),
            'type' => \Elementor\Controls_Manager::TEXTAREA,
            'default' => __( 'This is the description', 'babe-addons' ),
            'placeholder' => __( 'Enter description', 'babe-addons' ),
            ]
        );
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Choose Image', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Heading', 'babe-addons' ),
                'placeholder' => __( 'Enter heading', 'babe-addons' ),
            ]
        );

        $repeater->add_control(
            'sub_heading',
            [
                'label' => __( 'Sub Heading', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Sub Heading', 'babe-addons' ),
                'placeholder' => __( 'Enter sub heading', 'babe-addons' ),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'This is the description', 'babe-addons' ),
                'placeholder' => __( 'Enter description', 'babe-addons' ),
            ]
        );
        // Adding Width control
        $repeater->add_control(
            'width',
            [
                'label' => __( 'Width (%)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'percent' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],
            ]
        );

        // Adding Horizontal Position control
        $repeater->add_control(
            'horizontal_position',
            [
                'label' => __( 'Horizontal Position (%)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'percent' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
            ]
        );

        // Adding Vertical Position control
        $repeater->add_control(
            'vertical_position',
            [
                'label' => __( 'Vertical Position (%)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'percent' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 0,
                ],
            ]
        );

        $this->add_control(
            'image_list',
            [
                'label' => __( 'Image List', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'heading' => __( 'Heading #1', 'babe-addons' ),
                        'sub_heading' => __( 'Sub Heading #1', 'babe-addons' ),
                        'description' => __( 'Description #1', 'babe-addons' ),
                    ],
                    [
                        'heading' => __( 'Heading #2', 'babe-addons' ),
                        'sub_heading' => __( 'Sub Heading #2', 'babe-addons' ),
                        'description' => __( 'Description #2', 'babe-addons' ),
                    ],
                ],
                'title_field' => '{{{ heading }}}',
            ]
        );
        $this->end_controls_section(); 

        $this->start_controls_section(
            'hero_container',
            [
            'label' => __( 'Hero Container', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'hero_width',
            [
                'label' => __( 'Container Width (%)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'range' => [
                    'percent' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 100,
                ],
            ]
        );  

        $this->end_controls_section();

        // Start Style Tab
        $this->start_controls_section(
            'hero_container_style',
            [
                'label' => __( 'Hero Container Style', 'babe-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE, // Specify the Style tab
            ]
        );

         
        // Add Background Color control
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'hero_background',
                'label' => __( 'Background', 'babe-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ], // Supports color, gradient, or video background
                'selector' => '{{WRAPPER}} #babe-scatter-hero-wrapper',
            ]
        );

        // Padding Control
        $this->add_responsive_control(
            'hero_padding',
            [
                'label' => __( 'Padding', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} #babe-scatter-hero-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Border Control
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'hero_border',
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} #babe-scatter-hero-wrapper',
            ]
        );

        

        // Add this within the hero_container section
        $this->add_control(
            'animate_background',
            [
                'label' => __( 'Animate Background Gradient', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'babe-addons' ),
                'label_off' => __( 'No', 'babe-addons' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->add_control(
            'gradient_animation_speed',
            [
                'label' => __( 'Animation Speed (s)', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 10,
                'min' => 1,
                'max' => 30,
                'step' => 1,
                'condition' => [
                    'animate_background' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
       
        
    }

	// What your widget displays on the front-end
    protected function render() {
        $settings = $this->get_settings_for_display();
        $main_title = $settings['main_title'];
        $sub_title = $settings['sub_title'];
        $description = $settings['description'];
        $animate_background = $settings['animate_background'] === 'yes' ? 'yes' : 'no';
        $animation_speed = !empty($settings['gradient_animation_speed']) ? $settings['gradient_animation_speed'] : 10;
        


        if ( $settings['image_list'] ) {
            echo '<div id="babe-scatter-hero-wrapper">';
            echo '<div class="main-heading">';
            echo '<h1>'.$main_title.'</h1>';
            echo '<h2>'.$sub_title.'</h2>';
            echo '<p>'.$description.'</p>';
            echo '</div>';

            
        
            foreach ( $settings['image_list'] as $index => $item ) {
                $image_url = $item['image']['url'];
                $heading = $item['heading'];
                $sub_heading = $item['sub_heading'];
                $description = $item['description'];
                $width = $item['width']['size'] . '%';
                $horizontal_position = $item['horizontal_position']['size'] . '%';
                $vertical_position = $item['vertical_position']['size'] . '%';
        
                // Generate the HTML structure for each image
                echo '<div id="babe-scatter-img-wrapper-' . $index . '" class="ba-img-card">';
                echo '<a href=""><img src="' . esc_url($image_url) . '" alt="' . esc_attr($heading) . '">';
                echo '<div class="babe-hero-text">';
                echo '<h3>' . esc_html($heading) . '</h3>';
                echo '<h4>' . esc_html($sub_heading) . '</h4>';
                echo '<p>' . esc_html($description) . '</p>';
                echo '</div></a>';
                echo '</div>';
        
                // Inline CSS for each image wrapper
                echo '<style>';
                echo '#babe-scatter-img-wrapper-' . $index . ' {';
                echo 'z-index: ' . $index . ';';
                echo 'width: ' . $width . ';';
                echo 'left: ' . $horizontal_position . ';';
                echo 'top: ' . $vertical_position . ';';
                echo 'position: absolute;';
                echo '}';
                echo '</style>';
            }
        
            echo '</div>';
        }
        ?>

		<style>
            .main-heading {
                height: fit-content;
                width: 100%;
                text-align: center;
                pointer-events: none;
                z-index: 999;
                margin-top: 0;
            }
            #babe-scatter-hero-wrapper {
                width: 100%;
                height: 100vh;
                overflow: hidden;
                display: flex;
                position: relative;
                <?php if ($animate_background === 'yes') : ?>
                    background: linear-gradient(45deg, #ff0000, #0000ff);
                    background-size: 400% 400%;
                    animation: gradientAnimation <?php echo esc_attr($animation_speed); ?>s ease infinite;
                <?php else : ?>
                    background: aqua;
                <?php endif; ?>
            }
        #babe-scatter-hero-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            /* background-color: <?php //echo esc_attr($overlay_color); ?>; */
            /* opacity: <?php // echo esc_attr($overlay_opacity); ?>; */
            pointer-events: none; 
            z-index: 1;
        }
        #ba-bg-canvas {
            position: relative;
            z-index: 0;
            width: 100%;
            height: 100%;
        }
        .ba-img-card {
            position: absolute;
            scale: 1;
            transition: all 0.5s ease-in;
        }
        .ba-img-card:hover {
            z-index: 99 !important;
            scale: 1.2;
        }
        .babe-hero-text {
            display: none;
            transition: all 0.5s ease-in;
        }
        .ba-img-card a:hover .babe-hero-text {
            margin-top: -140px;
            margin-left: 10px;
            color: #fff;
            display: block;
        }
        .ba-img-card img {
            width: 100%;
        }

        @keyframes gradientAnimation {
            0% { background-position: 0% 0%; }
            50% { background-position: 100% 100%; }
            100% { background-position: 0% 0%; }
        }
		</style>
       
        <script>
          
        </script>

		<?php
    }

}
