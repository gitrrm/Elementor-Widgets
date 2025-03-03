<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Insights_Slider_Two extends Widget_Base {

   /*  public function __construct() {
        parent::__construct(); // Call the parent constructor
        add_action('wp_ajax_get_subcategories', [$this, 'get_subcategories_callback']);
        add_action('wp_ajax_nopriv_get_subcategories', [$this, 'get_subcategories_callback']);
    } */

    public function get_name() {
        return 'insights_blog_slider_two';
    }

    public function get_title() {
        return __( 'Insights Blog Slider Two', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-slider-3'; // Change to your desired icon
    }

    public function get_categories() {
        return [ 'babe-addons' ];
    }

    protected function _register_controls() {
        // Control for selecting post type
        $this->add_control(
            'post_type',
            [
                'label' => __( 'Select Post Type', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'post' => __( 'Posts', 'babe-addons' ),
                    'portfolio' => __( 'Portfolio', 'babe-addons' ),
                ],
                'default' => 'post',
            ]
        );

        // Control for selecting subcategories
        $this->add_control(
            'sub_category',
            [
                'label' => __( 'Select Subcategory', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'options' => [], // Options will be populated with JS
                'default' => '',
            ]
        );
    }

    protected function render() {
        // You will fetch and render posts/portfolio items based on selected options here.
        ?>
        <div class="recent-post-one">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="inshghtsItem">
                        <div class="inshghtsItem-image-div">
                            <div class="inshghtsItem-image-holder">
                                <img src="./assets/images/img1.jpg" alt="" title="" />
                            </div>
                        </div>
                        <div class="deatil-wrap mt-3 mb-lg-0 mb-md-0 mb-sm-3 mb-3 py-lg-5 py-md-5 py-sm-5 py-2 px-lg-4 px-md-4 px-sm-4 px-3">
                            <div>
                                <div class="mb-2">16.08.2024</div>
                                <h4 class="mb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</h4>
                                <p>orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
                                <a href="#"><span>READ MORE</span> <span><i class="fa-solid fa-arrow-right-long"></i></span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-navigation-wrap">
            <div class="swiper-navigation">
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev">
                    <i class="fa-solid fa-arrow-left-long"></i>
                </div>
                <div class="swiper-button-next">
                    <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        </div>

        <!-- Include styles and scripts properly -->
        <style>
            
            /* Swiper JS */
            .recent-post-one {
            width: 100%;
            height: 100%;
            overflow: hidden;
            }
            .recent-post-one .swiper-slide {
            
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 56%;
            height:35rem;
            }
            .inshghtsItem {
                height: 100%;
                width: 100%;
                background-color: #ededed;
                display: flex;
            }
            .inshghtsItem-image-div{
                width: 50%;
            }
            .inshghtsItem .deatil-wrap{
                width: 50%;
                display: flex;
                align-items: center;
                justify-content: start;
            }
            .inshghtsItem-image-holder{
                height: 100%;
                width: 100%;
            }
            .inshghtsItem-image-holder img{
                height: 100%;
                width: 100%;
                object-fit: cover;
            }
            .swiper-navigation-wrap{
            display: flex;
            justify-content: center;
            width: 100%;
            margin-top: 20px;
            }
            .swiper-navigation{
            width:150px;
            position: relative;
            }
            .swiper-navigation-wrap .swiper-button-next,
            .swiper-navigation-wrap .swiper-button-prev {
            color: #000000;
            }
            .swiper-navigation .swiper-pagination {
            position: relative;
            }
            .swiper-button-next::after, .swiper-button-prev::after {
            font-family:inherit;
            font-size: inherit;
            text-transform: none !important;
            letter-spacing: 0;
            font-variant: initial;
            line-height: 1;
            }
            .swiper-button-next::after, .swiper-rtl .swiper-button-prev::after {
            content: '';
            }
            .swiper-button-prev::after, .swiper-rtl .swiper-button-next::after {
            content: '';
            }
            .swiper-pagination-fraction {
            bottom: inherit;
            }
            
            
            @media (max-width:576px) {
            .recent-post-one .swiper-slide {
            height: auto;
            }
            .inshghtsItem .deatil-wrap{width: 100%;}
            .inshghtsItem {
                height: 100%;
                width: 100%;
                background-color: #ededed;
                display: flex;
                flex-wrap: wrap;
            }
            .inshghtsItem-image-div {
                height:250px;
                width: 100%;
            }
            
            }
            @media screen and (max-width: 990px) {
            .recent-post-one .swiper-slide {
                width: 88%;
            }
            }
            .recent-post-one .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            }
            
            
            
            @media screen and (max-width: 990px) {
            .recent-post-one .swiper-button-next,
            .recent-post-one .swiper-button-prev {
                display: none;
            }
            }
            .recent-post-one .swiper-button-prev {
            left:inherit;
            }
            
            
        </style>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const swiperFull = new Swiper(".recent-post-one", {
                    slidesPerView: "auto",
                    centeredSlides: true,
                    spaceBetween: 32,
                    loop: true,
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true,
                        type: 'fraction',
                        renderFraction: function (currentClass, totalClass) {
                            return '<span class="count-class">0</span>' + '<span class="' + currentClass + '"></span>' +
                                ' <span class="pagination-line">- </span>' +  '<span class="red-count">0</span>' + 
                                '<span class="' + (totalClass) + '"></span>';
                        },
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev"
                    }
                });
            });
        </script>
        <?php
    }

    public function get_subcategories_callback() {
        // Make sure to validate and sanitize input
        $post_type = sanitize_text_field($_POST['post_type']);
        $categories = get_terms(array('taxonomy' => "{$post_type}_category", 'hide_empty' => false));

        $result = array();
        foreach ($categories as $category) {
            $result[$category->term_id] = $category->name;
        }

        wp_send_json($result);
    }

    // Register the widget
    // public static function register() {
    //     \Elementor\Plugin::instance()->widgets_manager->register_widget_type(new self());

    // }
}

