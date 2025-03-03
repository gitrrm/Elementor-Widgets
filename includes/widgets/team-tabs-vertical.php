<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

class Babe_Team_Tabs_Vertical extends Widget_Base {

    public function get_name() {
        return 'babe_team_tabs_vertical';
    }

    public function get_title() {
        return __('Team Tabs Vertical', 'babe-addons');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['babe_addons'];
    }

    protected function _register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        $repeater = new \Elementor\Repeater();
    
        $repeater->add_control(
            'team_member_name',
            [
                'label' => __('Name', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('John Doe', 'babe-addons'),
                'label_block' => true,
            ]
        );
    
        $repeater->add_control(
            'team_member_designation',
            [
                'label' => __('Designation', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Photographer', 'babe-addons'),
                'label_block' => true,
            ]
        );
    
        $repeater->add_control(
            'team_member_image',
            [
                'label' => __('Image', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );
    
        $this->add_control(
            'team_members_list',
            [
                'label' => __('Team Members', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'team_member_name' => __('Elena', 'babe-addons'),
                        'team_member_designation' => __('Photographer', 'babe-addons'),
                    ],
                    [
                        'team_member_name' => __('Christopher', 'babe-addons'),
                        'team_member_designation' => __('Video', 'babe-addons'),
                    ],
                ],
                'title_field' => '{{{ team_member_name }}}',
            ]
        );
    
        $this->end_controls_section(); // End of Content Section
    
        // Title Style Section
        $this->start_controls_section(
            'teams_vertical_section_style',
            [
                'label' => __( 'Member\'s Name', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'teams_vertical_title',
            [
                'label' => __( 'Name', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
    
        $this->start_controls_tabs('tabs_title_color');
    
        // Normal Tab
        $this->start_controls_tab(
            'tab_title_color_normal',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_title_color_normal',
            [
                'label' => __( 'Title Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Normal Tab
    
        // Hover Tab
        $this->start_controls_tab(
            'tab_title_color_hover',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_title_color_hover',
            [
                'label' => __( 'Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .teams-thumbs .swiper-slide:hover .team-detail .title' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Hover Tab
    
        // Active Tab
        $this->start_controls_tab(
            'tab_title_color_active',
            [
                'label' => __( 'Active', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_title_color_active',
            [
                'label' => __( 'Active Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title.active' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Active Tab
    
        $this->end_controls_tabs();
    
        // Typography Group Control for Title
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'teams_vertical_title_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-detail .title',
            ]
        );
    
        // Title Spacing Controls
        $this->add_control(
            'teams_vertical_title_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_control(
            'teams_vertical_title_padding',
            [
                'label' => __( 'Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section(); // End Title Style Section

        // Designation Style Section
        $this->start_controls_section(
            'teams_vertical_designation_section_style',
            [
                'label' => __( 'Designation', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'teams_vertical_designation',
            [
                'label' => __( 'Designation', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
    
        $this->start_controls_tabs('tabs_designation_color');
    
        // Normal Tab
        $this->start_controls_tab(
            'tab_designation_color_normal',
            [
                'label' => __( 'Normal', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_designation_color_normal',
            [
                'label' => __( 'Designation Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title-designation' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Normal Tab
    
        // Hover Tab
        $this->start_controls_tab(
            'tab_designation_color_hover',
            [
                'label' => __( 'Hover', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_designation_color_hover',
            [
                'label' => __( 'Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .teams-thumbs .swiper-slide:hover .team-detail .title-designation' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Hover Tab
    
        // Active Tab
        $this->start_controls_tab(
            'tab_designation_color_active',
            [
                'label' => __( 'Active', 'babe-addons' ),
            ]
        );
    
        $this->add_control(
            'teams_designation_color_active',
            [
                'label' => __( 'Active Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title-designation.active' => 'color: {{VALUE}};',
                ],
            ]
        );
    
        $this->end_controls_tab(); // End Active Tab
    
        $this->end_controls_tabs();
    
        // Typography Group Control for designation
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'teams_vertical_designation_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .team-detail .title-designation',
            ]
        );
    
        // Title Spacing Controls
        $this->add_control(
            'teams_vertical_designation_margin',
            [
                'label' => __( 'Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title-designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->add_control(
            'teams_vertical_designation_padding',
            [
                'label' => __( 'Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .team-detail .title-designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        $this->end_controls_section(); // End Designation Style Section
    
        // Background color controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Background Color', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->start_controls_tabs('tabs_background_colors');
    
        // Normal state tab
        $this->start_controls_tab(
            'tab_background_normal',
            [
                'label' => __('Normal', 'babe-addons'),
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_normal',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .teams-thumbs .swiper-slide',
            ]
        );
    
        $this->end_controls_tab();
    
        // Hover state tab
        $this->start_controls_tab(
            'tab_background_hover',
            [
                'label' => __('Hover', 'babe-addons'),
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color_hover',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .teams-thumbs .swiper-slide:hover',
            ]
        );
    
        $this->end_controls_tab();
    
        // Active state tab
        $this->start_controls_tab(
            'tab_background_active',
            [
                'label' => __('Active', 'babe-addons'),
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_color_active',
                'label' => __('Background', 'babe-addons'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .teams-thumbs .swiper-slide-thumb-active',
            ]
        );
    
        $this->end_controls_tab();
    
        $this->end_controls_tabs();
        $this->end_controls_section(); // End Background Color Section

        // Border
        $this->start_controls_section(
            'team_tabs_border_section',
            [
                'label' => __('Border', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE, // Add this under the Style tab
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'team_tabs_border',
                'label' => __('Border', 'babe-addons'),
                'selector' => '{{WRAPPER}} .teams-thumbs .swiper-slide',
            ]
        );
        
        $this->add_responsive_control(
            'team_tabs_border_radius',
            [
                'label' => __('Border Radius', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'], // You can allow percentage or pixels
                'selectors' => [
                    '{{WRAPPER}} .teams-thumbs .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->end_controls_section();
        
    }
    

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>

        <section>
            <div class="teams-container-wrapper">
                <!-- Slider thumbnail container -->
                <div class="teams-container teams-thumbs">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['team_members_list'] as $member) : ?>
                            <div class="swiper-slide">
                                <div class="team-detail">
                                    <div class="title"><?php echo esc_html($member['team_member_name']); ?></div>
                                    <div class="title-designation"><?php echo esc_html($member['team_member_designation']); ?></div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Slider main container -->
                <div class="teams-container teams-images">
                    <div class="swiper-wrapper">
                        <?php foreach ($settings['team_members_list'] as $member) : ?>
                            <div class="swiper-slide">
                                <div class="img-holder">
                                    <img src="<?php echo esc_url($member['team_member_image']['url']); ?>" alt="<?php echo esc_attr($member['team_member_name']); ?>">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>

        <style>
            /* teams */


            .teams-container {
            max-height: 60vh;
            }

            .teams-container-wrapper {
            display: flex;
            /* flex-flow: column nowrap; */
            flex-flow: row nowrap;
            overflow: hidden;
            width: 100%;
            margin-left: auto;
            margin-right: auto;
            
            }
            .team-detail{
            display: flex;
            width: 100%;
            justify-content: space-between;
            align-items: center;
            }
            .team-detail .title{
            font-size: 1.8rem;
            font-weight: bold;
            }
            .team-detail .title-designation{
            font-size: 1rem;
            color: #6c6c6c;  
            }
            .img-holder {
            overflow: hidden;
            position: relative;
            width: 100%;
            height: 100%;
            }
            .img-holder img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            aspect-ratio: 1;
            }

            /* .swiper-slide {
            text-align: center;
            background-size: cover;
            background-position: center;
            background-color: #fff;
            display: flex;
            flex-flow: column nowrap;
            justify-content: center;
            align-items: center;
            } */


            .teams-images {
            position: relative;
            width: 100%;
            height: 100vh;
            overflow: hidden;
            }


            .teams-thumbs {
            width: 100%;
            height: 100vh;
            padding-top: 0px;
            }

            .teams-thumbs .swiper-wrapper {
            flex-direction: column;
            }

            .teams-thumbs .swiper-slide {
            flex-flow: row nowrap;
            opacity: 0.75;
            cursor: pointer;
            background-color:#f2f5eb;
            padding: 1rem 3rem;
            border-bottom: 2px solid #6c6c6c;
            }
            .teams-thumbs .swiper-slide:first-child{
            border-top: 2px solid #6c6c6c;
            }

            .teams-thumbs .swiper-slide-thumb-active {
            opacity: 1;
            background: #20bbc9;
            }

            @media (max-width:768px) {
            
                .teams-container-wrapper {
                    display: flex;
                    flex-flow: column nowrap;
                    flex-wrap: wrap;
                }
                .teams-thumbs {
                    height: auto;
                }
                .teams-thumbs .swiper-wrapper{
                    flex-direction:inherit;
                }
                .teams-thumbs .swiper-slide {
                    padding: 0.4rem;
                    border-bottom: 2px solid #6c6c6c;
                    border-top: 2px solid #6c6c6c;
                }
                .team-detail {
                    flex-direction: column;
                    flex-wrap: wrap;
                }
                .team-detail .title {
                    font-size: 1.2rem;
                    font-weight: bold;
                }
                .teams-container {
                    max-height: 45vh;
                }
            }

            @media (max-width:567px) {
                .team-detail .title {
                    font-size: 1rem;
                    font-weight: bold;
                }
                .teams-container {
                    max-height: 35vh;
                }

            }
        </style>
        <script>
            //teams

            var teamsThumbs = new Swiper(".teams-thumbs", {
                centeredSlides: false,
                centeredSlidesBounds: true, 
                direction: "vertical",
                spaceBetween: 0,
                slidesPerView: 5,
                freeMode: false,
                watchSlidesVisibility: true,
                watchSlidesProgress: true,
                watchOverflow: true,
                breakpoints: {
                200: {
                    direction: "horizontal",
                    slidesPerView:2.5
                },
                400: {
                    direction: "horizontal",
                    slidesPerView:3.5
                },
                769: {
                    direction: "vertical",
                    slidesPerView:5
                }
                }
            });
            var teamsImages = new Swiper(".teams-images", {
                direction: "vertical",
                spaceBetween:0,
                // navigation: {
                // nextEl: ".swiper-button-next",
                // prevEl: ".swiper-button-prev"
                // },
                a11y: {
                prevSlideMessage: "Previous slide",
                nextSlideMessage: "Next slide",
                },
                keyboard: {
                enabled: true,
                },
                thumbs: {
                swiper: teamsThumbs
                }
            });
            teamsImages.on("slideChangeTransitionStart", function () {
                teamsThumbs.slideTo(teamsImages.activeIndex);
            });
            teamsThumbs.on("transitionStart", function () {
                teamsImages.slideTo(teamsThumbs.activeIndex);
            });

            const targetNode = document.querySelector('.teams-container-wrapper');
            const config = { childList: true, subtree: true };

            const callback = function (mutationsList, observer) {
                for (const mutation of mutationsList) {
                    if (mutation.type === 'childList') {
                        // Reinitialize Swiper here if DOM changes
                        const swiper = new Swiper('.teams-container', {
                            slidesPerView: 1,
                            spaceBetween: 10,
                            thumbs: {
                                swiper: {
                                    el: '.teams-thumbs',
                                    slidesPerView: 4,
                                },
                            },
                            direction: 'vertical',
                            watchSlidesProgress: true,
                        });
                    }
                }
            };

            const observer = new MutationObserver(callback);
            observer.observe(targetNode, config);

        </script>
        <?php
    }

    
}
