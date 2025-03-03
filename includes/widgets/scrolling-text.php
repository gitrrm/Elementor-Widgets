<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Class Babe_Scrolling_Text
 *
 * Main class for the Scrolling Text widget.
 */
class Babe_Scrolling_Text extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve the widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'babe_scrolling_text';
    }

    /**
     * Get widget title.
     *
     * Retrieve the widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Scrolling Text', 'babe-addons' );
    }

    /**
     * Get widget icon.
     *
     * Retrieve the widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-form-vertical';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the widget belongs to.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return [ 'babe_addons' ];
    }

    /**
     * Register widget controls.
     *
     * Add input fields to allow the user to customize the widget settings.
     */
    protected function register_controls() {
        // Start the section for scrolling text settings
        $this->start_controls_section(
            'scrolling_text_section',
            [
                'label' => __( 'Scrolling Text Settings', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add control for scrolling text
        $this->add_control(
            'scrolling_text',
            [
                'label' => __( 'Text', 'babe-addons' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Our Works',
            ]
        );

        // Add control for scrolling direction
        $this->add_control(
            'scrolling_direction',
            [
                'label' => __( 'Scroll Direction', 'babe-addons' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'left_to_right',
                'options' => [
                    'left_to_right' => __( 'Scroll to Left', 'babe-addons' ),
                    'right_to_left' => __( 'Scroll to Right', 'babe-addons' ),
                ],
                'description' => 'Choose the direction in which the text should scroll.',
            ]
        );

        // Add control for scroll speed
        $this->add_control(
            'scrolling_text_speed',
            [
                'label' => __( 'Scroll Speed', 'babe-addons' ),
                'type' => Controls_Manager::NUMBER,
                'default' => 1,
                'min' => 1,
                'max' => 10,
                'step' => 0.1,
                'description' => 'Set the speed at which the text scrolls.',
            ]
        );

        // Add responsive control for container height
        $this->add_responsive_control(
            'scrolling_text_height',
            [
                'label' => __( 'Container Height', 'babe-addons' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 2000,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 200,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .scrolling-text' => 'height: {{SIZE}}{{UNIT}};',
                ],
                'devices' => [ 'desktop', 'tablet', 'mobile' ], // Ensure responsive controls for these devices
                'description' => 'Set the height of the scrolling text container as per the font size.',
            ]
        );

        $this->end_controls_section();

        // Start the section for text style settings
        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Text Style', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add heading for scrolling element style
        $this->add_control(
            'scrolling_text_styles',
            [
                'label' => __( 'Scrolling Element', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Add control for text color
        $this->add_control(
            'scrolling_text_color',
            [
                'label' => __( 'Text Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#000000',
                'selectors' => [
                    '{{WRAPPER}} .text-scroll' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .scrolling-text-value' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add control for text hover color
        $this->add_control(
            'scrolling_text_hover_color',
            [
                'label' => __( 'Text Hover Color', 'babe-addons' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#555',
                'selectors' => [
                    '{{WRAPPER}} .text-scroll:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .scrolling-text-value:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Add typography control
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'scrolling_text_typography',
                'label' => __( 'Typography', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .scrolling-text-value',
                'default' => [
                    'typography' => 'custom',
                    'font_size' => [
                        'unit' => 'px',
                        'size' => 32,
                    ],
                ],
            ]
        );

        // Add responsive control for text margin
        $this->add_responsive_control(
            'scrolling_text_margin',
            [
                'label' => __( 'Title Margin', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .text-scroll' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scrolling-text-value' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add responsive control for text padding
        $this->add_responsive_control(
            'scrolling_text_padding',
            [
                'label' => __( 'Title Padding', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .text-scroll' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .scrolling-text-value' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Start the section for background settings
        $this->start_controls_section(
            'scrolling_text_background_section',
            [
                'label' => __( 'Background', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add background control
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'scrolling_text_background',
                'label' => __( 'Background', 'babe-addons' ),
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .scrolling-text-wrapper',
            ]
        );

        $this->end_controls_section();

        // Start the section for background overlay settings
        $this->start_controls_section(
            'scrolling_text_background_overlay_section',
            [
                'label' => __( 'Background Overlay', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add background overlay control
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'scrolling_text_background_overlay',
                'label' => __( 'Background Overlay', 'babe-addons' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .scrolling-text',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        // Start the section for border settings
        $this->start_controls_section(
            'scrolling_text_border_section',
            [
                'label' => __( 'Border', 'babe-addons' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        // Add border control
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'scrolling_text_border',
                'label' => __( 'Border', 'babe-addons' ),
                'selector' => '{{WRAPPER}} .scrolling-text-wrapper',
            ]
        );

        // Add control for border radius
        $this->add_control(
            'scrolling_text_border_radius',
            [
                'label' => __( 'Border Radius', 'babe-addons' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .scrolling-text-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Add heading for box shadow
        $this->add_control(
            'scrolling_text_box_shadow_heading',
            [
                'label' => __( 'Box Shadow', 'babe-addons' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        // Add control for box shadow
        $this->add_control(
            'scrolling_text_box_shadow',
            [
                'label' => esc_html__( 'Box Shadow', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::BOX_SHADOW,
                'selectors' => [
                    '{{WRAPPER}} .scrolling-text-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
                ],
                'default' => [
                    'horizontal' => 0,
                    'vertical'   => 0,
                    'blur'       => 0,
                    'spread'     => 0,
                    'color'      => 'rgba(0,0,0,0)', // Transparent color means no shadow
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     *
     * Generate the final HTML on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id(); // Use Elementor's widget ID

        $scroll_speed = isset($settings['scrolling_text_speed']) ? $settings['scrolling_text_speed'] : 1;
        $scrolling_text = isset($settings['scrolling_text']) ? $settings['scrolling_text'] : '';
        $direction_class = $settings['scrolling_direction'] === 'left_to_right' ? 'scroll-left' : 'scroll-right';
        $text_color = isset($settings['scrolling_text_color']) ? $settings['scrolling_text_color'] : '#000'; // Default color
        $hover_color = isset($settings['scrolling_text_hover_color']) ? $settings['scrolling_text_hover_color'] : '#555'; // Default color

        $font_size = 62; // Default font size
        $font_size_unit = 'px'; // Default font size unit

        // Check and retrieve typography settings
        if ( isset( $settings['scrolling_text_typography'] ) ) {
            $font_size = $settings['scrolling_text_typography']['font_size']['size'] ?? $font_size;
            $font_size_unit = $settings['scrolling_text_typography']['font_size']['unit'] ?? $font_size_unit;
        }
        $text_height = ($font_size + 70) . $font_size_unit;    
        ?>
        <div class="scrolling-text-wrapper scrolling-text-wrapper-<?php echo $widget_id; ?> stage-area">
            <div class="scrolling-text scrolling-text-<?php echo $widget_id; ?> <?php echo esc_attr($direction_class); ?> text-stage-area" data-direction="<?php echo esc_attr($settings['scrolling_direction']); ?>">
                <div class="text-scroll text-scroll-<?php echo $widget_id; ?> scrolling-text-value">
                    <?php echo wp_kses_post($scrolling_text); ?>
                </div>
            </div>
        </div>
        <style>
            .scrolling-text-<?php echo $widget_id; ?> {
                overflow-x: hidden;
                white-space: nowrap;
                width: 100vw;
                height: <?php echo $text_height; ?>; 
                position: relative;
                cursor: grab;
                user-select: none;
                /* padding: 40px 0; */
            }
            .scrolling-text-wrapper-<?php echo $widget_id; ?>  {
                border: none; 
            }
                
            .text-scroll-<?php echo $widget_id; ?> {
                display: inline-block;
                white-space: nowrap;
                position: absolute;
                top: 0;
                left: 0;
            }
            .text-scroll-<?php echo $widget_id; ?>:hover {
                color: <?php echo esc_attr($hover_color); ?>;
            }
    
            .text-scroll-<?php echo $widget_id; ?> h2 {
                display: inline-block;
                margin-right: 50px; /* Space between text elements */
            }
    
            /* Smooth scrolling without scrollbar */
            .scrolling-text-<?php echo $widget_id; ?> {
                overflow-x: hidden;
            }
            .scrolling-text-<?php echo $widget_id; ?> .scrolling-text-value {
                font-size: <?php echo $font_size . $font_size_unit; ?>;
                font-weight: 500;
            }
        </style>
        <script>
            /**
             * Initialize scrolling text widget.
             */
            function scrollingTextWidget<?php echo $widget_id; ?>(){
                const scrollingTextContainer = document.querySelector('.scrolling-text-<?php echo $widget_id; ?>');
                const scrollingText = document.querySelector('.text-scroll-<?php echo $widget_id; ?>');
                let isDragging = false;
                let startX;
                let scrollLeft;

                // Determine direction based on data attribute
                const directionAttr = scrollingTextContainer.getAttribute('data-direction');
                let direction = directionAttr === 'right_to_left' ? -1 : 1;

                // Function to duplicate elements for continuous scrolling
                function duplicateText() {
                    const contentWidth = scrollingText.scrollWidth;
                    const containerWidth = scrollingTextContainer.offsetWidth;

                    // Ensure enough duplication for continuous scrolling
                    while (scrollingText.scrollWidth < containerWidth * 2) {
                        scrollingText.innerHTML += scrollingText.innerHTML;
                    }

                    scrollingText.style.width = `${scrollingText.scrollWidth}px`;
                }

                duplicateText(); // Initial duplication

                let animationFrameId;
                let speed = <?php echo $scroll_speed ?>; // Adjust speed as needed

                // Function to handle scrolling animation
                function animate() {
                    scrollingTextContainer.scrollLeft += speed * direction;

                    if (scrollingTextContainer.scrollLeft >= scrollingText.scrollWidth / 2) {
                        scrollingTextContainer.scrollLeft = 0;
                    } else if (scrollingTextContainer.scrollLeft <= 0) {
                        scrollingTextContainer.scrollLeft = scrollingText.scrollWidth / 2;
                    }

                    animationFrameId = requestAnimationFrame(animate);
                }

                animate(); // Start animation

                // Dragging functionality
                scrollingTextContainer.addEventListener('mousedown', (e) => {
                    isDragging = true;
                    startX = e.pageX - scrollingTextContainer.offsetLeft;
                    scrollLeft = scrollingTextContainer.scrollLeft;
                    scrollingTextContainer.style.cursor = 'grabbing';
                });

                scrollingTextContainer.addEventListener('mouseleave', () => {
                    if (isDragging) {
                        isDragging = false;
                        scrollingTextContainer.style.cursor = 'grab';
                    }
                });

                scrollingTextContainer.addEventListener('mouseup', () => {
                    if (isDragging) {
                        isDragging = false;
                        scrollingTextContainer.style.cursor = 'grab';
                    }
                });

                scrollingTextContainer.addEventListener('mousemove', (e) => {
                    if (!isDragging) return;

                    const x = e.pageX - scrollingTextContainer.offsetLeft;
                    const walk = (x - startX) * 2;
                    scrollingTextContainer.scrollLeft = scrollLeft - walk;

                    // Update direction based on dragging movement
                    direction = walk > 0 ? 1 : -1;
                });

                // Prevent text selection and hide scrollbar
                scrollingTextContainer.style.overflowX = 'hidden';
            }

            // Initialize scrolling text on DOMContentLoaded
            document.addEventListener('DOMContentLoaded', () => {
                scrollingTextWidget<?php echo $widget_id; ?>();
            });

            // Initialize scrolling text on Elementor frontend load
            jQuery(window).on('elementor/frontend/init', () => {
                elementorFrontend.hooks.addAction('frontend/element_ready/babe_scrolling_text.default', scrollingTextWidget<?php echo $widget_id; ?>);
            });
        </script>
        <?php
    }
}