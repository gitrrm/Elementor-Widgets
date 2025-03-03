<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly

class Babe_Post_Slider extends Widget_Base
{

    public function get_name()
    {
        return 'babe_post_slider';
    }

    public function get_title()
    {
        return __('Babe Post Slider', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-slider';
    }

    public function get_categories()
    {
        return ['babe_addons']; // Define the category
    }

    protected function register_controls()
    {

        // Section: Content Settings
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Control: Post Category Selection
        $this->add_control(
            'post_category',
            [
                'label' => __('Select Category', 'babe-addons'),
                'type' => Controls_Manager::SELECT2,
                'options' => $this->get_categories_options(),
                'multiple' => false,
                'default' => 'all',
            ]
        );

        // Control: Number of Posts
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'babe-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );

        // Control: Image Size
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'image_size',
                'default' => 'medium',
            ]
        );

        // Control: Default Image
        $this->add_control(
            'default_image',
            [
                'label' => __('Default Image', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'description' => __('Select a default image to display when a post does not have a featured image.'),
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(), // Use Elementor's built-in placeholder image
                ],
            ]
        );

        $this->add_control(
            'post_id_or_slug',
            [
                'label' => __('Post ID or Slug', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => __('Enter post ID or slug', 'babe-addons'),
                'label_block' => true,
                'description' => __('Enter the post ID or slug to display in the slider.', 'babe-addons'),
            ]
        );
        $this->add_control(
            'date_format',
            [
                'label' => __('Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'F j, Y' => 'October 14, 2024',
                    'm/d/Y' => '10/14/2024',
                    'd/m/Y' => '14/10/2024',
                    'Y-m-d' => '2024-10-14',
                    'custom' => __('Custom', 'babe-addons'),
                ],
                'default' => 'd-m-Y',

            ]
        );
        $this->add_control(
            'custom_date_format',
            [
                'label' => __('Custom Date Format', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'F j, Y',
                'condition' => [
                    'date_format' => 'custom',
                ],
                'description' => __('Date format examples: <code>F j, Y</code> => October 14, 2024 | <code>m/d/Y</code> => 10/14/2024. Use: <code>d</code> (01-31), <code>D</code> (Mon-Sun), <code>m</code> (01-12), <code>M</code> (Jan-Dec), <code>y</code> (00-99), <code>Y</code> (2024).', 'babe-addons'),
            ]
        );
        $this->end_controls_section();
        
        // Section: Navigation Settings
        $this->start_controls_section(
            'bps_navigation_section',
            [
                'label' => __('Navigation', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'bps_show_pagination',
            [
                'label' => __('Show Pagination', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'babe-addons'),
                'label_off' => __('Hide', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        $this->add_control(
            'bps_show_navigation',
            [
                'label' => __('Show Navigation Arrows', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'babe-addons'),
                'label_off' => __('Hide', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

         // Previous Button Icon Control
         $this->add_control(
            'bps_prev_icon',
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
            'bps_next_icon',
            [
                'label' => __('Next Button Icon', 'babe-addons'),
                'type' => Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'fa-solid',
                ],
            ]
        );
       


        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'post_slider_section_style',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_slider_title',
            [
                'label' => __('Title', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Title Alignment
        $this->add_control(
            'post_slider_title_alignment',
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
                    'justify' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .title' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'post_slider_title_color',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_slider_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .overlay-detail-post .title',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );

        // Title Spacing (Margin & Padding)
        $this->add_control(
            'post_slider_title_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_slider_title_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Date Style
        $this->start_controls_section(
            'post_slider_date_section_style',
            [
                'label' => __('Date', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'post_slider_date',
            [
                'label' => __('Title', 'babe-addons'),
                'type' => Controls_Manager::HEADING,
            ]
        );
        // Date Alignment
        $this->add_control(
            'post_slider_date_alignment',
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
                    'justify' => [
                        'title' => __('Right', 'babe-addons'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .date' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'post_slider_date_color',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .date' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'post_slider_date_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .overlay-detail-post .date',
                'default' => [
                    'font_size' => [
                        'size' => 24,
                        'unit' => 'px',
                    ],
                    'font_weight' => 'bold',
                ],
            ]
        );

        // Date Spacing (Margin & Padding)
        $this->add_control(
            'post_slider_date_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'post_slider_date_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail-post .date' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Text Background Style Section
        $this->start_controls_section(
            'textbg_section_style',
            [
                'label' => __('Text Background', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay',
                'label' => __('Background Overlay', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .overlay-detail-post',
                'fields_options' => [
                    'background' => [
                        'label' => __('Background', 'babe-addons'),
                    ],
                    'color' => [
                        'responsive' => true,
                    ],
                    'background_image' => [
                        'responsive' => true,
                    ],
                    'background_size' => [
                        'responsive' => true,
                    ],
                    'background_position' => [
                        'responsive' => true,
                    ],
                    'background_repeat' => [
                        'responsive' => true,
                    ],
                    'background_attachment' => [
                        'responsive' => true,
                    ],
                ],
            ]
        );

        $this->end_controls_section();
    }

    private function get_categories_options()
    {
        $categories = get_categories();
        $options = ['all' => __('All Categories', 'babe-addons')];

        foreach ($categories as $category) {
            $options[$category->term_id] = $category->name;
        }

        return $options;
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $category = $settings['post_category'];
        $posts_per_page = $settings['posts_per_page'];
        $default_image = $settings['default_image']['url'];
        $post_id_or_slug = $settings['post_id_or_slug'];

        $bps_prev_icon = $settings['bps_prev_icon'] ?? ''; 
        $bps_next_icon = $settings['bps_next_icon'] ?? '';
        $bps_show_navigation = $settings['bps_show_navigation'];
        $bps_show_pagination = $settings['bps_show_pagination'];
        
        // Prepare the query arguments
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $posts_per_page,
        ];

        // Check if post ID or slug is provided
        if (!empty($post_id_or_slug)) {
            // Split the input into an array using commas as the delimiter
            $ids_or_slugs = array_map('trim', explode(',', $post_id_or_slug));

            // Initialize an empty array for the query
            $post_ids = [];

            // Loop through each item and determine if it's an ID or slug
            foreach ($ids_or_slugs as $id_or_slug) {
                if (is_numeric($id_or_slug)) {
                    // If it's a numeric ID, add it to the array
                    $post_ids[] = intval($id_or_slug);
                } else {
                    // If it's a slug, use 'name' to fetch the post ID
                    $post = get_page_by_path(sanitize_title($id_or_slug), OBJECT, 'post');
                    if ($post) {
                        $post_ids[] = $post->ID; // Get the ID of the post
                    }
                }
            }

            // If we found any post IDs, add them to the query
            if (!empty($post_ids)) {
                $args['post__in'] = $post_ids; // Include specific posts
                $args['orderby'] = 'post__in'; // Maintain the order of the provided IDs
            } else {
                // If no valid post IDs were found, return early
                echo '<p>' . __('No posts found', 'babe-addons') . '</p>';
                return;
            }
        }

        // Filter by category if selected
        if ($category !== 'all') {
            $args['cat'] = $category;
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ?>
            <section class="babe-post-slider">
                <div class="swiper-container postSlider">
                    <div class="swiper-wrapper">
                        <?php

            while ($query->have_posts()): $query->the_post();
                $image_url = get_the_post_thumbnail_url(get_the_ID(), $settings['image_size_size']);

                // Use default image if no featured image is found
                if (!$image_url) {
                    $image_url = esc_url($default_image);
                }

                // Date Format
                $date_format = $settings['date_format'] === 'custom' ? $settings['custom_date_format'] : $settings['date_format'];
                $formatted_date = get_the_date($date_format);
                // widget Unique id
                $widget = $this->get_data();
                $unique_id = $widget['id'];
                ?>
                    <div class="swiper-slide">
                        <a href="<?php the_permalink();?>" class="babe-item">
                            <div class="img-holder">
                                <img src="<?php echo $image_url; ?>" alt="<?php the_title_attribute();?>" />
                            </div>
                            <div class="overlay-detail-post">
                                <div class="date"><?php echo esc_html($formatted_date); ?></div>
                                <h4 class="title"><?php echo the_title(); ?></h4>
                            </div>
                        </a>
                    </div>
                <?php endwhile;?>
                    </div>
                </div>

                <!-- Swiper Navigation and Pagination -->
                <div class="swiper-navigation-wrap">
                    <div class="swiper-navigation" style="margin-top:20px;">
                        <?php if($bps_show_pagination === 'yes') : ?>
                            <div class="swiper-pagination"></div>
                        <?php endif; ?>
                        <?php if($bps_show_navigation === 'yes') : ?>
                            <div class="swiper-button-prev babe-post-slider-prev"><i class="<?php echo esc_attr( $bps_prev_icon['value'] ); ?>"></i></div>
                            <div class="swiper-button-next babe-post-slider-next"><i class="<?php echo esc_attr( $bps_next_icon['value'] ); ?>"></i></div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
            <script>
                function babePostSlider(){
                    const babePostSlider =  document.querySelector('.babe-post-slider');
                    if(babePostSlider){
                        const postSlider = new Swiper(".babe-post-slider .postSlider", {
                        slidesPerView: 5,
                        centeredSlides: true,
                        spaceBetween: 30,
                        loop: true,
                        pagination: {
                            el: ".babe-post-slider .swiper-pagination",
                            clickable: true,
                            type: 'fraction',
                        },
                        navigation: {
                            nextEl: ".babe-post-slider-next",
                            prevEl: ".babe-post-slider-prev"
                        },
                        breakpoints: {
                                200: {
                                    slidesPerView: 1.2,
                                    spaceBetween: 20,
                                },
                                640: {
                                    slidesPerView: 1.4,
                                    spaceBetween: 20,
                                },
                                768: {
                                    slidesPerView: 2.5,
                                    spaceBetween: 20,
                                },
                                1024: {
                                    slidesPerView: 3,
                                }
                            }
                        });
                    }

                }
                // Elementor Preview Mode
                window.addEventListener('elementor/frontend/init', function() {
                    elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
                        babePostSlider();
                    });
                });

                // Frontend Mode
                document.addEventListener("DOMContentLoaded", function() {
                    babePostSlider();
                });

                babePostSlider();
            </script>
            <?php
            } else {
                    echo '<p>' . __('No posts found', 'babe-addons') . '</p>';
                }

                wp_reset_postdata();
            }

}
