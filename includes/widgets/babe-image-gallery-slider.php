<?php
if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Babe_Image_Gallery_Widget extends Widget_Base
{

    public function get_name()
    {
        return 'babe_image_gallery';
    }

    public function get_title()
    {
        return __('Image Gallery', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-gallery-slide';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function _register_controls()
    {
        // Start section
        $this->start_controls_section(
            'image_gallery_content_section',
            [
                'label' => __('Gallery', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'image_gallery_images',
            [
                'label' => __('Gallery Images', 'babe-addons'),
                'type' => Controls_Manager::GALLERY,
                'default' => [
                    [
                        'id' => \Elementor\Utils::get_placeholder_image_src(),
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        'id' => \Elementor\Utils::get_placeholder_image_src(),
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        'id' => \Elementor\Utils::get_placeholder_image_src(),
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                    [
                        'id' => \Elementor\Utils::get_placeholder_image_src(),
                        'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
                ],
            ]
        );

        $this->end_controls_section();

        // Settings
        $this->start_controls_section(
            'image_gallery_setting_section',
            [
                'label' => __('Settings', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        // Previous Arrow Icon
        $this->add_control(
            'image_gallery_prev_arrow_icon',
            [
                'label' => __('Previous Arrow Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // Next Arrow Icon
        $this->add_control(
            'image_gallery_next_arrow_icon',
            [
                'label' => __('Next Arrow Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'image_gallery_show_nav',
            [
                'label' => esc_html__('Show Navigation', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('No', 'babe-addons'),
                'label_off' => esc_html__('Yes', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'image_gallery_autoplay',
            [
                'label' => __('Autoplay', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('On', 'babe-addons'),
                'label_off' => __('Off', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        // Autoplay Speed Control
        $this->add_control(
            'image_gallery_autoplay_speed',
            [
                'label' => __('Autoplay Speed (ms)', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['ms'],
                'range' => [
                    'ms' => [
                        'min' => 1000,
                        'max' => 10000,
                        'step' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'ms',
                    'size' => 5000,
                ],
            ]
        );

        // Slides Per View Control
        $this->add_responsive_control(
            'image_gallery_slides_per_view',
            [
                'label' => __('Slides Per View', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 10,
                        'step' => 1,
                    ],
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'desktop_default' => [
                    'size' => 3,
                    'unit' => 'px',
                ],
                'tablet_default' => [
                    'size' => 2,
                    'unit' => 'px',
                ],
                'mobile_default' => [
                    'size' => 1,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide' => 'width: calc(100% / {{SIZE}});',
                ],
            ]
        );

        // Slide Spacing Control
        $this->add_responsive_control(
            'image_gallery_slide_spacing',
            [
                'label' => __('Slide Spacing (px)', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
            ]
        );

        // Border Radius Control
        $this->add_control(
            'image_gallery_border_radius',
            [
                'label' => __('Border Radius (px)', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 5,
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-gallery .swiper-slide img' => 'border-radius: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // New Style Section - Navigation Arrows
        $this->start_controls_section(
            'image_gallery_style_section',
            [
                'label' => __('Navigation Style', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Navigation Arrow Color
        $this->add_control(
            'image_gallery_nav_color',
            [
                'label' => __('Icon Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000', 
                'selectors' => [
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-next::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-prev::after' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-next svg' => 'fill: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-prev svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        // Navigation Arrow Background Color
        $this->add_control(
            'image_gallery_nav_bg_color',
            [
                'label' => __('Icon Background Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff', 
                'selectors' => [
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-next' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-prev' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        // Navigation Arrow Size (Desktop)
        $this->add_responsive_control(
            'image_gallery_nav_size',
            [
                'label' => __('Icon Size (px)', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 10,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-prev' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}} .portfolio-gallery .swiper-button-next::after' => 'font-size: {{SIZE}}{{UNIT}};',
                    // '{{WRAPPER}} .portfolio-gallery .swiper-button-prev::after' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        

        // Padding and Margin for Arrows
        $this->add_responsive_control(
            'image_gallery_nav_padding',
            [
                'label' => __('Arrow Padding (px)', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .portfolio-gallery .swiper-button-prev' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $prev_arrow_icon = $settings['image_gallery_prev_arrow_icon'];
        $next_arrow_icon = $settings['image_gallery_next_arrow_icon'];
        $image_gallery_show_nav = $settings['image_gallery_show_nav'];

        $image_gallery_autoplay = $settings['image_gallery_autoplay'];
        $autoplay_speed = !empty($settings['image_gallery_autoplay_speed']['size']) ? $settings['image_gallery_autoplay_speed']['size'] : 5000;
        $slides_per_view = $settings['image_gallery_slides_per_view'] ?: 3;
        $slide_spacing = $settings['image_gallery_slide_spacing']['size'] ?: 10;
      
        echo '<div class="portfolio-gallery">';
        echo '<div class="swiper-wrapper">';

        // Loop through images and render them
        foreach ($settings['image_gallery_images'] as $image) {
            $img_url = $image['url'];
            echo '<div class="swiper-slide">';
            echo '<div class="swiper-image">';
            echo '<div class="image">';
            echo '<img src="' . esc_url($img_url) . '" />';
            echo '</div></div></div>';
        }

        echo '</div>'; // End of swiper-wrapper

        // Navigation buttons
        if ($image_gallery_show_nav === 'yes') {
            // echo '<div class="swiper-navigation" style="margin-top: 30px">';
            echo '<div class="swiper-button-prev">';
            if (isset($settings['image_gallery_prev_arrow_icon']) && !empty($settings['image_gallery_prev_arrow_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($settings['image_gallery_prev_arrow_icon'], ['aria-hidden' => 'true']);
            } else {
                echo '<i class="fa-solid fa-chevron-left"></i>'; // Fallback icon
            }
            echo '</div>';
            echo '<div class="swiper-button-next">';
            if (isset($settings['image_gallery_next_arrow_icon']) && !empty($settings['image_gallery_next_arrow_icon']['value'])) {
                \Elementor\Icons_Manager::render_icon($settings['image_gallery_next_arrow_icon'], ['aria-hidden' => 'true']);
            } else {
                echo '<i class="fa-solid fa-chevron-right"></i>'; // Fallback icon
            }
            echo '</div>';
            // echo '</div>'; // swiper-navigation
        }

        echo '</div>'; // End of portfolio-gallery
        ?>
            <script>
                  function imageGallerySlider() {
                        const portfolioGallery = new Swiper(".portfolio-gallery", {
                              loop: true,
                              slidesPerView: <?php echo esc_js($slides_per_view); ?>,
                              spaceBetween: <?php echo esc_js($slide_spacing); ?>,
                              grabCursor: true,
                              <?php if($image_gallery_autoplay === 'yes'): ?>
                              autoplay: {
                                    delay: <?php echo esc_js($autoplay_speed); ?>,
                                    disableOnInteraction: false,
                              },
                              <?php endif; ?>
                              centeredSlides: true,
                              navigation: {
                                    nextEl: ".swiper-button-next",
                                    prevEl: ".swiper-button-prev",
                              },
                        });
                        
                  }
                  document.addEventListener("DOMContentLoaded", function() {
                    imageGallerySlider();
                  });
                  imageGallerySlider();
            </script>
<?php
}
}
