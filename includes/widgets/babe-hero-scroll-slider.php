<?php
class Babe_Hero_Scroll_Slider extends \Elementor\Widget_Base {

    public function get_name() {
        return 'babe_hero_scroll_slider';
    }

    public function get_title() {
        return __( 'Hero Scroll Slider', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-slider-push';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'hero_section_content',
            [
                'label' => __( 'Content', 'babe-addons' ),
            ]
        );

        $repeater = new \Elementor\Repeater();

        // Image Title Control
        $repeater->add_control(
            'hero_image_title',
            [
                'label' => __( 'Image Title', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Image', 'babe-addons' ),
                'label_block' => true,
            ]
        );

        // Image Control
        $repeater->add_control(
            'hero_section_image',
            [
                'label' => __( 'Choose Image', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        

        // Hero Message Control
        $this->add_control(
            'hero_message',
            [
                'label' => __( 'Hero Message', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Your Hero Message', 'babe-addons' ),
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        ?>

            <div class="banner-animation">
            <div class="banner-animation-images-wraper">
                <div class="animation-images-holder">
                <div class="images-holder">
                    <div class="banner_img ba-images01">
                    <div class="ba-images-holder">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images02">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images03">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images04">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images05">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images06">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="banner_img ba-images07">
                    <div class="ba-images">
                        <img src="http://babes.local/wp-content/uploads/2024/08/wp_dummy_content_generator_67.jpg">
                    </div>
                    </div>
                    <div class="intro_hold_h1">
                    <div class="h2g">
                        Ready to Play!<span class="r"></span>
                    </div>
                    </div>
                </div>

                
                </div>
            </div>

            </div>
        <?php
        
    }
}
