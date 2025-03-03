<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (! defined('ABSPATH')) exit; // Exit if accessed directly

class Babe_Blog_Grid extends Widget_Base
{

    public function get_name()
    {
        return 'babe_blog_grid';
    }

    public function get_title()
    {
        return __('Babe Work Grid', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-post-slider'; // Elementor icon
    }

    public function get_categories()
    {
        return ['babe_addons']; // Custom category for widgets
    }

    protected function register_controls()
    {

        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Settings', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Select post type to display
        $this->add_control(
            'post_type',
            [
                'label' => __('Select Post Type', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post' => __('Posts', 'babe-addons'),
                    'portfolio' => __('Portfolio', 'babe-addons'),
                ],
                'default' => 'post',
            ]
        );

        // Number of posts to display
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'babe-addons'),
                'type' => Controls_Manager::NUMBER,
                'default' => 4,
            ]
        );
        $this->add_control(
            'include_posts_by_id_or_slug',
            [
                'label' => __('Include Posts (ID or Slug)', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'description' => __('Enter post IDs or slugs separated by commas', 'babe-addons'),
                'label_block' => true,
            ]
        );

        $this->end_controls_section();
        // Title Style Section
        $this->start_controls_section(
            'title_section_style',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_grid_title_color',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_grid_title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .overlay-detail .title',
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
            'blog_grid_title_margin',
            [
                'label' => __('Title Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'blog_grid_title_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Category Style Section
        $this->start_controls_section(
            'category_section_style',
            [
                'label' => __('Category', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'blog_grid_category_color',
            [
                'label' => __('Category Color', 'babe-addons'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .cat-name' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'blog_grid_category_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .overlay-detail .cat-name',
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
        $this->add_responsive_control(
            'blog_grid_category_margin',
            [
                'label' => __('Category Margin', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .cat-name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'blog_grid_category_padding',
            [
                'label' => __('Title Padding', 'babe-addons'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .overlay-detail .cat-name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Text Background Style Section
        $this->start_controls_section(
            'textbg_section_style',
            [
                'label' => __('Background Colors', 'babe-addons'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_overlay',
                'label' => __('Background Overlay', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .image-div .img-overlay',
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
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'title_bg_color',
                'label' => __('Title Background Color', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .babe-work-grid .overlay-detail',
                'fields_options' => [
                    'background' => [
                        'label' => __('Title Background Color', 'babe-addons'),
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
        /*  $this->add_control(
            'detail_text_bg_width',
            [
                'label' => __('Title Background Width', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'], // You can use 'px' and '%' units
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
                ],
                'default' => [
                    'unit' => '%', // Default unit
                    'size' => 50,   // Default value is 50%
                ],
                'selectors' => [
                    '{{WRAPPER}} .babe-work-grid .overlay-detail' => 'width: {{SIZE}}{{UNIT}};', // Apply width dynamically
                ],
                'responsive' => true, // Enable responsive controls
                'tablet_default' => [
                    'size' => '100%',
                ],
                'mobile_default' => [
                    'size' => '100%',
                ],
            ]
        ); */

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $post_type = $settings['post_type'];
        $posts_per_page = $settings['posts_per_page'];
        $include_posts_input = $settings['include_posts_by_id_or_slug'];
        // $detail_text_bg_width = $settings['detail_text_bg_width']['size'] . $settings['detail_text_bg_width']['unit'];

        // Check if user entered anything
        if (! empty($include_posts_input)) {
            $include_posts = array_map('trim', explode(',', $include_posts_input));

            foreach ($include_posts as $post_identifier) {
                // If it's numeric, treat it as an ID
                if (is_numeric($post_identifier)) {
                    $post_ids[] = (int) $post_identifier;
                } else {
                    // Otherwise, treat it as a slug
                    $post_slugs[] = $post_identifier;
                }
            }
        }

        // Query to fetch posts
        $args = [
            'post_type'      => $post_type,
            'posts_per_page' => $posts_per_page,
        ];

        // Modify query to include posts by ID or slug
        if (! empty($post_ids) || ! empty($post_slugs)) {
            $args['post__in'] = $post_ids;

            if (! empty($post_slugs)) {
                $args['name__in'] = $post_slugs;
            }
        }
        $query = new \WP_Query($args);

        if ($query->have_posts()) {
           
            echo '<div class="babe-work-grid">';

            while ($query->have_posts()) {
                $query->the_post();

                // Check if post has a thumbnail, otherwise provide a fallback image.
                $post_thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                if (!$post_thumbnail) {
                    $post_thumbnail = 'https://via.placeholder.com/600x400'; // Add a fallback image URL here.
                }

                $post_title = get_the_title();
                $post_permalink = get_permalink();
                $post_category = get_the_category_list(', ');

                $post_categories = get_categories(); // Get all categories
                if ($post_categories) {
                    $random_category = $post_categories[array_rand($post_categories)]; // Get a random category
                    $post_category = $random_category->name; // Get the category name
                } else {
                    $post_category = __('No Categories Available', 'babe-addons'); // Fallback if no categories exist
                }

                echo '<div class="babe-item">
                        <div class="image-div"><a href="' . esc_url($post_permalink) . '"><img src="' . esc_url($post_thumbnail) . '" alt="' . esc_attr($post_title) . '" /></a><div class="img-overlay"></div>        
                        </div>
                         <div class="overlay-detail">
                            <a href="' . esc_url($post_permalink) . '"><h4 class="title">' . esc_html($post_title) . '</h4></a>
                            <a href="' . esc_url($post_permalink) . '"><h5 class="cat-name">' . wp_kses_post($post_category) . '</h5></a>
                        </div>
                        
                    </div>';
            }

            echo '</div>';
            
?>
            <style>
                * {
                    margin: 0px;
                    padding: 0px
                }

                .babe-work-grid {
                    display: grid;
                    grid-template-columns: auto auto;
                }

                .babe-work-grid .babe-item {
                    position: relative;
                    max-height: 60vh;
                    min-height: 22vh;

                }

                .babe-work-grid .babe-item .image-div {
                    height: 100%;
                    width: 100%;
                }

                .babe-work-grid .babe-item img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    aspect-ratio: 1;
                }

                .babe-work-grid .overlay-detail {
                    position: absolute;
                    background: rgb(0, 0, 0);
                    /* background: linear-gradient(0deg, rgba(0,0,0,1) 9%, rgba(0,0,0,0) 64%); */
                    background: #000;
                    width: 50%;
                    height: auto;
                    bottom: 0;
                    z-index: 99;
                    padding: 10px 20px;
                    color: #fff;
                    display: flex;
                    align-items: start;
                    flex-wrap: wrap;
                    align-content: start;
                    flex-direction: column;
                    /* justify-content: end; */
                    /* text-align: right; */
                    padding: 20px;
                }

                .babe-work-grid .babe-item:nth-child(even) .overlay-detail {
                    align-content: start;
                    align-items: start;
                    text-align: left;
                }

                .title h4 {
                    font-size: 1.4rem;
                }

                .cat-name {
                    font-size: 20px;
                }

                @media screen and (max-device-width:1280px) {
                    .babe-work-grid .overlay-detail {
                        width: 55%;
                    }
                }

                @media screen and (max-device-width:992px) {
                    .babe-work-grid .overlay-detail {
                        width: 70%;
                    }
                }

                @media screen and (max-device-width:768px) {
                    .babe-work-grid .overlay-detail {
                        width: 75%;
                    }
                }

                @media screen and (max-device-width:600px) {

                    .babe-work-grid {
                        display: grid;
                        grid-template-columns: auto;
                    }

                    .babe-work-grid .overlay-detail {
                        align-items: start;
                        align-content: start;
                    }
                }

                @media screen and (max-device-width:567px) {

                    .babe-work-grid {
                        display: grid;
                        grid-template-columns: auto;
                    }

                    .babe-work-grid .overlay-detail {
                        align-items: start;
                        align-content: start;
                    }

                    .title h4 {
                        font-size: 1.1rem;
                    }

                    .cat-name {
                        font-size: 16px;
                    }
                }
            </style>
<?php

            // Reset post data
            wp_reset_postdata();
        } else {
            echo '<p>' . __('No posts found', 'babe-addons') . '</p>';
        }
    }
}
