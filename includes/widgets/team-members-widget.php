<?php
// namespace Babe_Addons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class Team_Members extends Widget_Base {

    public function get_name() {
        return 'team_members';
    }

    public function get_title() {
        return __( 'Team Members', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'team_members_section',
            [
                'label' => __( 'Team Members', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'team_members',
            [
                'label' => __( 'Team Members', 'babe-addons' ),
                'type' => Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'team_image',
                        'label' => __( 'Member Image', 'babe-addons' ),
                        'type' => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'name' => 'team_name',
                        'label' => __( 'Member Name', 'babe-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'John Doe', 'babe-addons' ),
                    ],
                    [
                        'name' => 'team_designation',
                        'label' => __( 'Member Designation', 'babe-addons' ),
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Designation', 'babe-addons' ),
                    ],
                    [
                        'name' => 'team_description',
                        'label' => __( 'Member Description', 'babe-addons' ),
                        'type' => Controls_Manager::TEXTAREA,
                        'default' => __( 'This is the team member description.', 'babe-addons' ),
                    ],
                ],
                'default' => [
                    [
                        'team_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                        'team_name' => __( 'John Doe', 'babe-addons' ),
                        'team_designation' => __( 'Designation', 'babe-addons' ),
                        'team_description' => __( 'This is the team member description.', 'babe-addons' ),
                    ],
                    [
                        'team_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                        'team_name' => __( 'Jane Smith', 'babe-addons' ),
                        'team_designation' => __( 'Lead Designer', 'babe-addons' ),
                        'team_description' => __( 'This is the second team member description.', 'babe-addons' ),
                    ],
                    [
                        'team_image' => [ 'url' => \Elementor\Utils::get_placeholder_image_src() ],
                        'team_name' => __( 'Mike Brown', 'babe-addons' ),
                        'team_designation' => __( 'Developer', 'babe-addons' ),
                        'team_description' => __( 'This is the third team member description.', 'babe-addons' ),
                    ],
                ],
                'title_field' => '{{{ team_name }}}',
            ]
        );

        $this->end_controls_section();

       

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['team_members'] ) ) {
            echo '<div class="team-members-carousel owl-carousel">';
            foreach ( $settings['team_members'] as $member ) {
                echo '<div class="team-member">';
                echo '<div class="image-wrap">';
                echo '<img src="' . esc_url( $member['team_image']['url'] ) . '" alt="' . esc_attr( $member['team_name'] ) . '" />';
                echo '</div>';
                echo '<div class="team-member-info">';
                echo '<h3 class="member-name">' . esc_html( $member['team_name'] ) . '</h3>';
                echo '<h4 class="member-designation">' . esc_html( $member['team_designation'] ) . '</h4>';
                echo '<p class="about-member">' . esc_html( $member['team_description'] ) . '</p>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';

            
            
            ?>
            <script>
                jQuery(document).ready(function($) {
                    if ( $('.team-members-carousel').length ) {
                        $('.team-members-carousel').owlCarousel({
                            loop: "{{ settings.loop ? 'true' : 'false' }}",
                            margin: 10,
                            nav: true,
                            // navText: [
                            //     '<i class="{{ settings.prev_arrow_icon.value }}"></i>',
                            //     '<i class="{{ settings.next_arrow_icon.value }}"></i>'
                            // ],
                            dots: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 2
                                },
                                1000: {
                                    items: 3
                                }
                            }
                        });
                    }
                });
                
            </script>
            
            <style>
                
                .owl-carousel {
                    margin-bottom: 50px;
                }
                .team-members-carousel .team-member img {
                    width: 100%;
                    object-fit: cover;
                }
                .owl-nav {
                    position: absolute;
                    top: 50%;
                    width: 100%;
                    display: flex;
                    justify-content: space-between;
                }
                .owl-nav button {
                    background: transparent;
                    border: none;
                    font-size: 2rem;
                    cursor: pointer;
                    color: #000;
                }
                .owl-dots {
                    text-align: center;
                    margin-top: 20px;
                }
                .owl-dot {
                    display: inline-block;
                    width: 10px;
                    height: 10px;
                    background: #ddd;
                    border-radius: 50%;
                    margin: 0 5px;
                    cursor: pointer;
                }
                .owl-dot.active {
                    background: #333;
                }
                
            </style>
            <?php
        }
    }

    protected function content_template() {
        ?>
            <# if (settings.team_members.length) { #>
                <div class="team-members-carousel owl-carousel">
                    <# _.each(settings.team_members, function(item) { #>
                        <div class="team-member">
                            <div class="image-wrap">
                                <img src="{{ item.team_image.url }}" alt="{{ item.team_name }}">
                            </div>
                            <div class="team-member-info">
                                <h3 class="member-name">{{{ item.team_name }}}</h3>
                                <h4 class="member-designation">{{{ item.team_designation }}}</h4>
                                <p class="about-member">{{{ item.team_description }}}</p>
                            </div> 
                        </div>
                    <# }); #>
                </div>
            <# } #>
            
          
        
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    if ( $('.team-members-carousel').length ) {
                        $('.team-members-carousel').owlCarousel({
                            loop: "{{ settings.loop ? 'true' : 'false' }}",
                            margin: 10,
                            nav: true,
                            navText: [
                                '<i class="{{ settings.prev_arrow_icon.value }}"></i>',
                                '<i class="{{ settings.next_arrow_icon.value }}"></i>'
                            ],
                            dots: true,
                            autoplay: true,
                            autoplayTimeout: 5000,
                            responsive: {
                                0: {
                                    items: 1
                                },
                                600: {
                                    items: 2
                                },
                                1000: {
                                    items: 3
                                }
                            }
                        });
                    }
                });
            </script>
        
        <?php
    }
}
?>
