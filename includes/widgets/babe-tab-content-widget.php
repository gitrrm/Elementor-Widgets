<?php
/**
 * Babe Tab Content Widget  * 
 */ 

class Babe_Tab_Content_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'babe_tab_content';
    }

    public function get_title() {
        return __( 'Template Tabs', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    public function get_categories() {
        return [ 'babe_addons' ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'tabs_section',
            [
                'label' => __( 'Tabs', 'babe-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => __( 'Tab Title', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Tab Title', 'babe-addons' ),
            ]
        );

        // Add a control for entering a heading title inside the tab content
        $repeater->add_control(
            'tab_heading',
            [
                'label' => __( 'Tab Heading', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Your Heading Here', 'babe-addons' ),
                'label_block' => true,
            ]
        );

        // Add a control to choose an Elementor template to insert inside each tab
        $repeater->add_control(
            'template_id',
            [
                'label' => __( 'Choose Template', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_elementor_templates(), // Function to get templates
                'label_block' => true,
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => __( 'Tabs', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => __( 'Tab 1', 'babe-addons' ),
                    ],
                    [
                        'tab_title' => __( 'Tab 2', 'babe-addons' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();
    }
    protected function get_elementor_templates() {
        $templates = [];

        // Fetch Elementor templates
        $elementor_templates = get_posts([
            'post_type' => 'elementor_library',
            'posts_per_page' => -1,
        ]);

        foreach ( $elementor_templates as $template ) {
            $templates[ $template->ID ] = $template->post_title;
        }

        return $templates;
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if ( ! empty( $settings['tabs'] ) ) {
            echo '<div class="babe-tab-widget">';
            echo '<ul class="babe-tabs-titles">';
            foreach ( $settings['tabs'] as $index => $tab ) {
                echo '<li><a href="#tab-' . $index . '">' . $tab['tab_title'] . '</a></li>';
            }
            echo '</ul>';
            echo '<div class="babe-tabs-content">';
            foreach ( $settings['tabs'] as $index => $tab ) {
                echo '<div id="tab-' . $index . '">';
                
                // Render the heading inside the tab
                if ( ! empty( $tab['tab_heading'] ) ) {
                    echo '<h3 class="babe-tab-heading">' . esc_html( $tab['tab_heading'] ) . '</h3>';
                }
                
                // Render the Elementor template
                if ( ! empty( $tab['template_id'] ) ) {
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $tab['template_id'] );
                }
                
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
        }
        ?>
            <style>
                .babe-tab-widget {
                    width: 100%;
                    margin-bottom: 20px;
                }

                .babe-tabs-titles {
                    list-style: none;
                    padding: 0;
                    display: flex;
                    justify-content: flex-start;
                    border-bottom: 2px solid #ddd;
                }

                .babe-tabs-titles li {
                    margin-right: 10px;
                }

                .babe-tabs-titles a {
                    display: inline-block;
                    padding: 10px 20px;
                    text-decoration: none;
                    background-color: #f5f5f5;
                    color: #333;
                    border-radius: 5px 5px 0 0;
                    border: 1px solid transparent;
                    border-bottom: none;
                    transition: background-color 0.3s, color 0.3s;
                }

                .babe-tabs-titles a:hover,
                .babe-tabs-titles a.active {
                    background-color: #0073e6;
                    color: white;
                    border-color: #0073e6;
                }

                .babe-tabs-content {
                    padding: 20px;
                    border: 1px solid #ddd;
                    border-radius: 0 5px 5px 5px;
                    background-color: #fff;
                }

                .babe-tabs-content > div {
                    display: none;
                    opacity: 0;
                    transition: opacity 0.5s ease-in-out;
                }

                .babe-tabs-content > div.active {
                    display: block;
                    opacity: 1;
                }

            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tabLinks = document.querySelectorAll('.babe-tabs-titles a');
                    const tabContents = document.querySelectorAll('.babe-tabs-content > div');

                    if (tabLinks.length) {
                        tabLinks.forEach(function(link, index) {
                            link.addEventListener('click', function(e) {
                                e.preventDefault();

                                // Remove active class from all links
                                tabLinks.forEach(function(link) {
                                    link.classList.remove('active');
                                });

                                // Add active class to the clicked tab
                                link.classList.add('active');

                                // Fade out the currently active tab content
                                const activeContent = document.querySelector('.babe-tabs-content > div.active');
                                if (activeContent) {
                                    activeContent.style.opacity = 0;
                                    setTimeout(function() {
                                        activeContent.classList.remove('active');
                                        activeContent.style.display = 'none';
                                    }, 500); // Matches the CSS transition duration
                                }

                                // Fade in the new tab content
                                const newContent = tabContents[index];
                                newContent.style.display = 'block';
                                setTimeout(function() {
                                    newContent.classList.add('active');
                                    newContent.style.opacity = 1;
                                }, 50); // Small delay to trigger the transition smoothly
                            });
                        });

                        // Trigger click on the first tab to show it by default
                        tabLinks[0].click();
                    }
                });

            </script>
        <?php
    }
}
