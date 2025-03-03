<?php

use \Elementor\Widget_Base;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Feature_Slider_Two extends Widget_Base
{

    public function get_name()
    {
        return 'feature-slider-two';
    }

    public function get_title()
    {
        return __('Feature Slider Two', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {
        // Content Section
        $this->start_controls_section('content_section', [
            'label' => __('Content', 'babe-addons'),
            'tab' => Controls_Manager::TAB_CONTENT,
        ]);

        // Fetch post types
        $allowed_post_types = ['post', 'portfolio'];
        $post_type_options = array_filter(get_post_types(['public' => true], 'objects'), function ($post_type) use ($allowed_post_types) {
            return in_array($post_type->name, $allowed_post_types);
        });

        // Select Post Type Control
        $this->add_control('featured_two_post_type', [
            'label' => __('Select Post Type', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'default' => 'portfolio',
            'options' => array_column($post_type_options, 'label', 'name'),
            'update_conditions' => true, // Ensure the options can be updated dynamically
        ]);

        // Populate category options for the selected post type
        $post_type_sub_category_options = $this->get_category_options('portfolio');

        // Category Filter Control
        /* $this->add_control(
            'featured_two_post_category',
            [
                'label' => __('Filter by Category', 'babe-addons'),
                'type' => Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $post_type_sub_category_options,
                'description' => __('Select categories to include in the slider.', 'babe-addons'),
            ]
        ); */

        // Number of Posts Control
        $this->add_control('featured_two_posts_per_page', [
            'label' => __('Number of Posts', 'babe-addons'),
            'type' => Controls_Manager::NUMBER,
            'default' => 6,
        ]);

        // Include Posts Control
        $this->add_control('include_featured_two_by_id_or_slug', [
            'label' => __('Include Posts (ID or Slug)', 'babe-addons'),
            'type' => Controls_Manager::TEXT,
            'description' => __('Enter post IDs or slugs separated by commas', 'babe-addons'),
            'label_block' => true,
        ]);

        // Exclude Posts Control
        $this->add_control('exclude_featured_two_by_id_or_slug', [
            'label' => __('Exclude Posts (ID or Slug)', 'babe-addons'),
            'type' => Controls_Manager::TEXT,
            'description' => __('Enter post IDs or slugs separated by commas to exclude', 'babe-addons'),
            'label_block' => true,
        ]);

        // Order By Control
        $this->add_control('featured_two_primary_order', [
            'label' => __('Primary Order By', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'date' => __('Order By Date', 'babe-addons'),
                'id' => __('Order By ID', 'babe-addons'),
            ],
            'default' => 'date',
        ]);

        // Order Direction Control
        $this->add_control('featured_two_order_direction', [
            'label' => __('Order Direction', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                'asc' => __('Ascending', 'babe-addons'),
                'desc' => __('Descending', 'babe-addons'),
            ],
            'default' => 'desc',
        ]);

        $this->end_controls_section();

        // Image Style Section
        $this->start_controls_section('featured_two_image_section_style', [
            'label' => __('Image', 'babe-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('featured_two_image_heading', [
            'label' => __('Image', 'babe-addons'),
            'type' => Controls_Manager::HEADING,
        ]);

        // Image Border Controls
        $this->add_responsive_control('featured_two_image_border_type', [
            'label' => __('Border Type', 'babe-addons'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => __('None', 'babe-addons'),
                'solid' => __('Solid', 'babe-addons'),
                'dashed' => __('Dashed', 'babe-addons'),
                'dotted' => __('Dotted', 'babe-addons'),
                'double' => __('Double', 'babe-addons'),
            ],
            'default' => 'none',
            'selectors' => [
                '{{WRAPPER}} .img-holder' => 'border-style: {{VALUE}};',
            ],
        ]);

        $this->add_responsive_control('featured_two_image_border_width', [
            'label' => __('Border Width', 'babe-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .img-holder' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
            'condition' => ['featured_two_image_border_type!' => ''],
        ]);

        $this->add_control('featured_two_image_border_color', [
            'label' => __('Border Color', 'babe-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => [
                '{{WRAPPER}} .img-holder' => 'border-color: {{VALUE}};',
            ],
            'condition' => ['featured_two_image_border_type!' => ''],
        ]);

        // Border Radius Control
        $this->add_responsive_control('featured_two_image_border_radius', [
            'label' => __('Border Radius', 'babe-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .img-holder' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        // Image Margin & Padding Controls
        $this->add_responsive_control('featured_two_image_margin', [
            'label' => __('Margin', 'babe-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .img-holder img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->add_responsive_control('featured_two_image_padding', [
            'label' => __('Padding', 'babe-addons'),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => ['px', 'em', '%'],
            'selectors' => [
                '{{WRAPPER}} .img-holder img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]);

        $this->end_controls_section();

        // Title Style Section
        $this->start_controls_section('featured_two_title_section_style', [
            'label' => __('Title', 'babe-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('featured_two_title_heading', [
            'label' => __('Title', 'babe-addons'),
            'type' => Controls_Manager::HEADING,
        ]);

        // Title Alignment Control
        $this->add_control('featured_two_title_alignment', [
            'label' => __('Alignment', 'babe-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => ['title' => __('Left', 'babe-addons'), 'icon' => 'eicon-text-align-left'],
                'center' => ['title' => __('Center', 'babe-addons'), 'icon' => 'eicon-text-align-center'],
                'right' => ['title' => __('Right', 'babe-addons'), 'icon' => 'eicon-text-align-right'],
                'justify' => ['title' => __('Justify', 'babe-addons'), 'icon' => 'eicon-text-align-justify'],
            ],
            'default' => 'left',
            'selectors' => ['{{WRAPPER}} .featured-two-title' => 'text-align: {{VALUE}};'],
        ]);

        $this->add_control('featured_two_title_color', [
            'label' => __('Title Color', 'babe-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .featured-two-title' => 'color: {{VALUE}};'],
        ]);

        // Title Typography Control
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'featured_two_title_typography',
            'selector' => '{{WRAPPER}} .featured-two-title',
        ]);

        $this->end_controls_section();

        // Excerpt Style Section
        $this->start_controls_section('featured_two_excerpt_section_style', [
            'label' => __('Excerpt', 'babe-addons'),
            'tab' => Controls_Manager::TAB_STYLE,
        ]);

        $this->add_control('featured_two_excerpt_heading', [
            'label' => __('Excerpt', 'babe-addons'),
            'type' => Controls_Manager::HEADING,
        ]);

        // Excerpt Alignment Control
        $this->add_control('featured_two_excerpt_alignment', [
            'label' => __('Alignment', 'babe-addons'),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'left' => ['title' => __('Left', 'babe-addons'), 'icon' => 'eicon-text-align-left'],
                'center' => ['title' => __('Center', 'babe-addons'), 'icon' => 'eicon-text-align-center'],
                'right' => ['title' => __('Right', 'babe-addons'), 'icon' => 'eicon-text-align-right'],
                'justify' => ['title' => __('Justify', 'babe-addons'), 'icon' => 'eicon-text-align-justify'],
            ],
            'default' => 'left',
            'selectors' => ['{{WRAPPER}} .featured-two-excerpt' => 'text-align: {{VALUE}};'],
        ]);

        $this->add_control('featured_two_excerpt_color', [
            'label' => __('Excerpt Color', 'babe-addons'),
            'type' => Controls_Manager::COLOR,
            'selectors' => ['{{WRAPPER}} .featured-two-excerpt' => 'color: {{VALUE}};'],
        ]);

        // Excerpt Typography Control
        $this->add_group_control(Group_Control_Typography::get_type(), [
            'name' => 'featured_two_excerpt_typography',
            'selector' => '{{WRAPPER}} .featured-two-excerpt',
        ]);

        $this->end_controls_section();
    }

    protected function get_category_options($post_type)
    {
        $categories = get_terms([
            'taxonomy' => 'category', // Assuming 'category' is the taxonomy for posts
            'hide_empty' => false,
        ]);

        // Prepare the category options
        $options = [];
        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $post_type = $settings['featured_two_post_type'];

        // Query Args
        $args = [
            'post_type' => $post_type,
            'posts_per_page' => $settings['featured_two_posts_per_page'],
            'orderby' => $settings['featured_two_primary_order'],
            'order' => $settings['featured_two_order_direction'],
        ];

        // Include specific posts if provided
        if (!empty($settings['include_featured_two_by_id_or_slug'])) {
            $args['post__in'] = array_map('trim', explode(',', $settings['include_featured_two_by_id_or_slug']));
        }

        // Exclude specific posts if provided
        if (!empty($settings['exclude_featured_two_by_id_or_slug'])) {
            $args['post__not_in'] = array_map('trim', explode(',', $settings['exclude_featured_two_by_id_or_slug']));
        }

        // Filter by category if provided
       /*  if (!empty($settings['featured_two_post_category'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'category', // Assuming 'category' is the taxonomy for posts
                    'field' => 'id',
                    'terms' => array_map('intval', $settings['featured_two_post_category']),
                ]
            ];
        } */

        $query = new WP_Query($args);
        if ($query->have_posts()) {
        ?>
            <div class="feature-slider-wrap-two">
                <div class="feature-slider-two swiper">
                    <div class="swiper-wrapper">
                        <?php while ($query->have_posts()) : $query->the_post(); ?>
                            <div class="swiper-slide">
                                <a href="<?php the_permalink(); ?>" class="detail-holder">
                                    <div class="img-holder">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url('large'); ?>" loading="lazy" />
                                        <?php endif; ?>
                                    </div>
                                    <div class="deatil-wrap">
                                        <h4 class="featured-two-title"><?php the_title(); ?></h4>
                                        <p class="featured-two-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                                        <!-- <button>Read More</button> -->
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>

            
            <script>
                function handleFeaturedSliderTwo(){
                    const featuredSliderTwo = document.querySelector('.feature-slider-two');
                    if(featuredSliderTwo){
                        const featuredTwoCarousel = new Swiper(".feature-slider-two", {
                        // Optional parameters
                        watchSlidesProgress: true,
                        slidesPerView: 2,
                        spaceBetween: 40,
                        // centerInsufficientSlides:true,
                        freeMode: {
                            enabled: true,
                            sticky: true,
                            momentum: false,
                        },
                        pagination: {
                            el: ".swiper-pagination",
                            clickable: true,
                            type: "fraction",
                            renderFraction: function(current, total) {
                                // Helper function to add leading zero if needed
                                function addLeadingZero(number) {
                                    return number < 10 ? '0' + number : number;
                                }

                                let currentFormatted = addLeadingZero(this.activeIndex + 1); // Adjusting current since it's zero-indexed
                                let totalFormatted = addLeadingZero(this.slides.length);

                                return '<span class="currentClass">' + currentFormatted + '</span>' +
                                    ' <span class="pagination-line"></span>' +
                                    '<span class="totalClass">' + totalFormatted + '</span>';
                            },

                        },
                        on: {
                            slideChange: function() {
                                const pagination = this.pagination;
                                pagination.render();
                            },
                        },
                        breakpoints: {
                            320: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            640: {
                                slidesPerView: 1,
                                spaceBetween: 20,
                            },
                            768: {
                                slidesPerView: 2,
                                spaceBetween: 20,
                            },
                            1024: {
                                slidesPerView: 2,
                            },
                        },
                        });
                    }
                }
                handleFeaturedSliderTwo();
                document.addEventListener('DOMContentLoaded', handleFeaturedSliderTwo);
                
                
            </script>
        <?php
        }
        wp_reset_postdata();
    }
}
