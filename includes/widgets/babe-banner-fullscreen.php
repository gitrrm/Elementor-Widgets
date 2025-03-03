<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
/** 
 * This class displays the posts in a scrolling animated format
 * 
 * @package babe-addons
*/

class Babe_Banner_Fullscreen_Widget extends Widget_Base {

    public function get_name() {
        return 'babe_banner_fullscreen';
    }

    public function get_title() {
        return __( 'Babe Banner Fullscreen', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-slider-full-screen';
    }

    public function get_categories() {
        return [ 'babe_addons' ]; // Change to your category
    }

    protected function register_controls() {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'babe-addons' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $repeater = new Repeater();
    
        // Slider Image Field
        $repeater->add_control(
            'slider_front_images',
            [
                'label'   => __( 'Slider Front Images', 'babe-addons' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        $repeater->add_control(
            'slider_back_images',
            [
                'label'   => __( 'Slider Background Images', 'babe-addons' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        // Banner Title Field
        $repeater->add_control(
            'banner_title',
            [
                'label' => __( 'Banner Title', 'babe-addons' ),
                'type'  => Controls_Manager::TEXT,
                'default' => __( 'Sample Banner Title', 'babe-addons' ),
            ]
        );
    
        // Banner Subtitle Field
        $repeater->add_control(
            'banner_subtitle',
            [
                'label' => __( 'Banner Subtitle', 'babe-addons' ),
                'type'  => Controls_Manager::TEXT,
                'default' => __( 'Sample Banner Subtitle', 'babe-addons' ),
            ]
        );
    
        // Add Repeater Control to the widget
        $this->add_control(
            'banner_images',
            [
                'label' => __( 'Banner Images', 'babe-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slider_front_images' => ['url' => Utils::get_placeholder_image_src()],
                        'slider_back_images' => ['url' => Utils::get_placeholder_image_src()],
                        'banner_title' => __( 'Sample Title 1', 'babe-addons' ),
                        'banner_subtitle' => __( 'Sample Subtitle 1', 'babe-addons' ),
                    ],
                    [
                        'slider_front_images' => ['url' => Utils::get_placeholder_image_src()],
                        'slider_back_images' => ['url' => Utils::get_placeholder_image_src()],
                        'banner_title' => __( 'Sample Title 2', 'babe-addons' ),
                        'banner_subtitle' => __( 'Sample Subtitle 2', 'babe-addons' ),
                    ],
                ],
                'title_field' => '{{{ banner_title }}}', // Dynamic title in Elementor editor
            ]
        );
    
        $this->end_controls_section();
        $this->start_controls_section(
            'banner_navigation_section',
            [
                'label' => __('Navigation Arrows', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Previous Button Icon Control
        $this->add_control(
            'banner_prev_icon',
            [
                'label' => __('Previous Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'fa-solid',
                ],
            ]
        );

        // Next Button Icon Control
        $this->add_control(
            'banner_next_icon',
            [
                'label' => __('Next Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
        $this->add_control(
            'banner_previous_nav_text',
            [
                'label' => esc_html__('Previous Text', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'PREV', 'babe-addons' ),
				'placeholder' => esc_html__( 'Prev', 'babe-addons' ),
                'description' => 'Priority is given to navigation text, select icon and delete navigation texts to display icon',
            ]
        );
        $this->add_control(
            'banner_next_nav_text',
            [
                'label' => esc_html__('Next Text', 'babe-addons'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'NEXT', 'babe-addons' ),
				'placeholder' => esc_html__( 'Next', 'babe-addons' ),
                'description' => 'Priority is given to navigation text, select icon and delete navigation texts to display icon',
            ]
        );
        $this->add_control(
            'banner_show_nav',
            [
                'label' => esc_html__('Show/Hide Navigation & paginations', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Hide', 'babe-addons'),
                'label_off' => esc_html__('Show', 'babe-addons'),
                'return_value' => 'no',
                'default' => 'no',
            ]
        );
        $this->add_control(
            'banner_nav_on_right',
            [
                'label' => esc_html__('Navigation on right & Pagination on left', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Left', 'babe-addons'),
                'label_off' => esc_html__('Right', 'babe-addons'),
                'return_value' => 'yes', 
                'default' => '', 
            ]
        );
        
        $this->end_controls_section();

        // Style Section starts
        $this->start_controls_section(
            'banner_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'banner_title_alignment',
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
                    '{{WRAPPER}} .banner-detail .banner-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'banner_title_color',
            [
                'label' => __('Date Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'banner_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .banner-detail .banner-title',
            ]
        );
        $this->add_responsive_control(
            'banner_title_margin',
            [
                'label' => __('Date Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'banner_title_padding',
            [
                'label' => __('Date Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'banner_subtitle_section',
            [
                'label' => __('Sub Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'banner_subtitle_alignment',
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
                    '{{WRAPPER}} .banner-detail .banner-title-sub' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'banner_subtitle_color',
            [
                'label' => __('Text Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title-sub' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'banner_subtitle_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .banner-detail .banner-title-sub',
            ]
        );
        $this->add_responsive_control(
            'banner_subtitle_margin',
            [
                'label' => __('Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title-sub' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'banner_subtitle_padding',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-detail .banner-title-sub' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Navigation
        $this->start_controls_section(
            'banner_nav_text_section',
            [
                'label' => __('Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->start_controls_tabs(
            'banner_nav_tabs'
        );
        $this->start_controls_tab(
            'banner_nav_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'banner_nav_color',
            [
                'label' => __('Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-nav-button .prev svg, {{WRAPPER}} .banner-nav-button .next svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'banner_nav_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'banner_nav_hover_color',
            [
                'label' => __('Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev:hover, {{WRAPPER}} .banner-nav-button .next:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .banner-nav-button .prev:hover svg, {{WRAPPER}} .banner-nav-button .next:hover svg' => 'fill: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'banner_nav_text_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next',
            ]
        );
        $this->add_responsive_control(
            'banner_nav_text_margin',
            [
                'label' => __('Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'banner_nav_text_padding',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'banner_nav_dots_heading',
            [
                'label' => __('Pagination Dots', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        $this->start_controls_tabs(
            'banner_pagination_tabs'
        );
        $this->start_controls_tab(
            'banner_pagination_normal_tab',
            [
                'label' => esc_html__('Normal', 'babe-addons'),
            ]
        );
        $this->add_control(
            'banner_pagination_dots_color',
            [
                'label' => __('Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-slider .banner-pagination.swiper-pagination-bullets .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'navigation_icon_hover_tab',
            [
                'label' => esc_html__('Hover', 'babe-addons'),
            ]
        );
        $this->add_control(
            'banner_pagination_dots_hover_color',
            [
                'label' => __('Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-slider .banner-pagination.swiper-pagination-bullets .swiper-pagination-bullet:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->start_controls_tab(
            'navigation_icon_active_tab',
            [
                'label' => esc_html__('Active', 'babe-addons'),
            ]
        );
        $this->add_control(
            'banner_pagination_dots_active_color',
            [
                'label' => __('Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .banner-slider .banner-pagination.swiper-pagination-bullets .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();


        $this->end_controls_section();
        // Image
        $this->start_controls_section(
            'banner_front_image_section',
            [
                'label' => __('Image', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'banner_front_image_border',
                'label' => esc_html__('Image Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .front-banner-image .banner-slider-thumbs .swiper-slide .image-holder img',
            ]
        );  
        $this->add_responsive_control(
            'banner_front_image_border_radius',
            [
                'label' => esc_html__('Border Radius', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .front-banner-image .banner-slider-thumbs .swiper-slide .image-holder img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'banner_front_image_css_filters',
                'label' => esc_html__('Front Image Filters', 'babe-addons'),
                'selector' => '{{WRAPPER}} .front-banner-image .banner-slider-thumbs .swiper-slide .image-holder img',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'banner_front_image_css_filters_hover',
                'label' => esc_html__('Front Image Filters (Hover)', 'babe-addons'),
                'selector' => '{{WRAPPER}} .front-banner-image .banner-slider-thumbs .swiper-slide .image-holder img:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'banner_back_image_css_filters',
                'label' => esc_html__('Background Image Filters', 'babe-addons'),
                'selector' => '{{WRAPPER}} .back-banner-slider .swiper-slide img',
            ]
        );
        
        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name' => 'banner_back_image_css_filters_hover',
                'label' => esc_html__('Background Image Filters (Hover)', 'babe-addons'),
                'selector' => '{{WRAPPER}} .banner-slider:hover .back-banner-slider .swiper-slide img',
            ]
        );
            
        
        
        $this->add_responsive_control(
            'banner_front_image_margin',
            [
                'label' => __('Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'banner_front_image_padding',
            [
                'label' => __('Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .banner-nav-button .prev, {{WRAPPER}} .banner-nav-button .next' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
    }
    
/**
 * Render the widget output on the frontend.
 * 
 * This function outputs the HTML and necessary JavaScript for the posts slider.
 * The posts slider consists of a front image with title and subtitle details, and 
 * navigation buttons (previous/next) if enabled in the widget settings. 
 * The back slider (background) scrolls along with the front posts.
 */
protected function render() {
    // Fetch settings values from the widget settings
    $settings = $this->get_settings_for_display();
    
    // Fetch specific settings for the slider navigation
    $banner_previous_nav_text = $settings['banner_previous_nav_text']; // Text for the previous navigation button
    $banner_next_nav_text = $settings['banner_next_nav_text']; // Text for the next navigation button
    $banner_show_nav = $settings['banner_show_nav']; // Whether to show navigation buttons
    $banner_nav_on_right = $settings['banner_nav_on_right']; // Check if navigation buttons should be on the right
    
    ?>

    <!-- Main banner slider container -->
    <div class="banner-slider">
        
        <!-- Front banner section with image and details -->
        <div class="front-banner-image">
            <div class="swiper-container banner-slider-thumbs">
                <div class="swiper-wrapper">
                    <?php 
                    // Check if banner images are available in the settings
                    if ( !empty( $settings['banner_images'] ) ) :
                        // Loop through each slide (banner image)
                        foreach ( $settings['banner_images'] as $slide ) : ?>
                            <div class="swiper-slide">
                                <a href="#">
                                    <div class="image-holder">
                                        <!-- Display front image of the banner -->
                                        <img src="<?php echo esc_url( $slide['slider_front_images']['url'] ); ?>" alt="<?php echo esc_attr( $slide['banner_title'] ); ?>">
                                    </div>
                                    <!-- Banner details: title and subtitle -->
                                    <div class="banner-detail">
                                        <div class="banner-title"><?php echo esc_html( $slide['banner_title'] ); ?></div>
                                        <div class="banner-title-sub"><?php echo esc_html( $slide['banner_subtitle'] ); ?></div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach;
                    endif; ?>
                </div>
            </div>
        </div>

        <!-- Navigation and pagination controls -->
        <div class="navagition-wrap-area">
            <div class="navagition-wrap">
                <?php if ( isset($banner_show_nav) && $banner_show_nav ): // Check if navigation buttons should be displayed ?>
                    <div class="banner-nav-button">
                        <!-- Previous button -->
                        <div class="prev">
                            <?php if ( isset($banner_previous_nav_text) && $banner_previous_nav_text ): ?>
                                <?php echo esc_html( $banner_previous_nav_text ); ?>
                            <?php else: ?>
                                <?php
                                // Display the previous icon or default arrow if no text is set
                                if ( isset($settings['banner_prev_icon']) && !empty($settings['banner_prev_icon']['value']) ) {
                                    \Elementor\Icons_Manager::render_icon( $settings['banner_prev_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    echo '<i class="fa-solid fa-chevron-left"></i>';
                                }
                                ?>
                            <?php endif; ?>
                        </div>

                        <!-- Next button -->
                        <div class="next">
                            <?php if ( isset($banner_next_nav_text) && $banner_next_nav_text ): ?>
                                <?php echo esc_html( $banner_next_nav_text ); ?>
                            <?php else: ?>
                                <?php
                                // Display the next icon or default arrow if no text is set
                                if ( isset($settings['banner_next_icon']) && !empty($settings['banner_next_icon']['value']) ) {
                                    \Elementor\Icons_Manager::render_icon( $settings['banner_next_icon'], ['aria-hidden' => 'true'] );
                                } else {
                                    echo '<i class="fa-solid fa-chevron-right"></i>';
                                }
                                ?>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Pagination dots for the banner slider -->
                    <div class="banner-pagination"></div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Back banner slider (background images) -->
        <div class="swiper-container back-banner-slider">
            <div class="swiper-wrapper">
                <?php 
                // Check if there are banner images for the background slider
                if ( !empty( $settings['banner_images'] ) ) :
                    // Loop through each banner image for the background
                    foreach ( $settings['banner_images'] as $slide ) : ?>
                        <div class="swiper-slide">
                            <!-- Display back image (background) -->
                            <img src="<?php echo esc_url( $slide['slider_back_images']['url'] ); ?>" alt="<?php echo esc_attr( $slide['banner_title'] ); ?>">
                        </div>
                    <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
    <style>
        .banner-slider .navagition-wrap {
                <?php if ($banner_nav_on_right) {
                    echo 'flex-direction: row-reverse';
                }else{               
                    echo 'flex-direction: row';
                } ?>
            }
    </style>
        <script>
            var bannerSlider = document.querySelector(".back-banner-slider");
            if (bannerSlider) {
                const slider = new Swiper(".back-banner-slider", {
                    slidesPerView: "1",
                    spaceBetween: 0,
                    centeredSlides: false,
                    loop: true,
                    speed: 1100,
                    slideToClickedSlide: true,
                });

                const thumbs = new Swiper(".banner-slider-thumbs", {
                    slidesPerView: 1,
                    loop: true,
                    loopedSlides: 6,
                    noSwiping: true,
                    grabCursor: true,
                    speed: 600,
                    effect: "creative",
                    creativeEffect: {
                        prev: {
                            shadow: true,
                            translate: [0, 0, -400],
                        },
                        next: {
                            translate: ["100%", 0, 0],
                        },
                    },
                    keyboard: {
                        enabled: true,
                    },
                    mousewheel: {
                        thresholdDelta: 70,
                    },
                    noSwipingClass: "swiper-slide",
                    pagination: {
                        el: ".banner-pagination",
                        clickable: true,
                    },
                    navigation: {
                        prevEl: ".prev",
                        nextEl: ".next",
                    },
                });

                slider.controller.control = thumbs;
                thumbs.controller.control = slider;
            }
            
        </script>
    <?php
}

}
