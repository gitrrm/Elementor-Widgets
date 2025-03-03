<?php
if (!defined('ABSPATH')) exit; // Exit if accessed directly

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;


class Services_Circle_Widget extends Widget_Base
{

  public function get_name()
  {
    return 'services_circle_widget';
  }

  public function get_title()
  {
    return __('Services Circle', 'babe_addons');
  }

  public function get_icon()
  {
    return 'eicon-circle-o';
  }

  public function get_categories()
  {
    return ['babe_addons'];
  }

  protected function register_controls()
  {
    // Start section
    $this->start_controls_section(
      'content_section',
      [
        'label' => __('Content', 'babe-addons'),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    // Repeater control
    $repeater = new Repeater();

    // Service Name
    $repeater->add_control(
      'service_name',
      [
        'label' => __('Service Name', 'babe-addons'),
        'type' => Controls_Manager::TEXT,
        'default' => __('Service Name', 'babe-addons'),
        'label_block' => true,
      ]
    );

    // Service Description
    $repeater->add_control(
      'service_description',
      [
        'label' => __('Service Description', 'babe-addons'),
        'type' => Controls_Manager::TEXTAREA,
        'default' => __('Service description goes here.', 'babe-addons'),
        'label_block' => true,
      ]
    );


    // Service Icon
    $repeater->add_control(
      'service_icon',
      [
        'label' => __('Service Icon', 'babe-addons'),
        'type' => \Elementor\Controls_Manager::ICONS, // Use ICONS for the icon library
        'default' => [
          'value' => 'eicon-settings',
          'library' => 'elementor-icons', // library for Elementor icons
        ],
        'label_block' => true,
      ]
    );



    // Service Link
    $repeater->add_control(
      'service_link',
      [
        'label' => __('Service Link', 'babe-addons'),
        'type' => Controls_Manager::URL,
        'placeholder' => __('https://your-link.com', 'babe-addons'),
        'label_block' => true,
      ]
    );

    // Circle Background Control
    $repeater->add_control(
      'circle_background',
      [
        'label' => __('Background Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'default' => 'rgba(204, 204, 204, 0.5)', // Default color in RGBA format
        'selectors' => [
          '{{WRAPPER}} .circle' => 'background-color: {{VALUE}};',
        ],
      ]
    ); 
    

    // Add the repeater control to the widget
    $this->add_control(
      'services_list',
      [
        'label' => __('Services List', 'babe-addons'),
        'type' => Controls_Manager::REPEATER,
        'fields' => $repeater->get_controls(),
        'default' => [
          [
            'service_name' => __('Business Plan', 'babe-addons'),
            'service_description' => __('Description for Business Plan', 'babe-addons'),
          ],
          [
            'service_name' => __('Information', 'babe-addons'),
            'service_description' => __('Description for Information', 'babe-addons'),
          ],
          [
            'service_name' => __('Designs', 'babe-addons'),
            'service_description' => __('Description for Designs', 'babe-addons'),
          ],
        ],
        'title_field' => '{{{ service_name }}}',
      ]
    );
    $this->start_controls_tabs('sc_shape_opacity_tabs');

    // Normal State Tab
    $this->start_controls_tab(
      'sc_shape_opacity_normal_tab',
      [
        'label' => __('Normal', 'babe-addons'),
      ]
    );

    // Opacity for Normal State
    $this->add_control(
      'sc_shape_opacity_normal',
      [
        'label' => __('Opacity', 'babe-addons'),
        'type' => Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 1,
        'step' => 0.01,
        'default' => 0.5,
        // 'selectors' => [
        //   '{{WRAPPER}} .circle' => 'opacity: {{VALUE}};', // Uncomment to apply opacity to .circle
        // ],
      ]
    );
    $this->end_controls_tab(); // End Normal State Tab

    // Hover State Tab
    $this->start_controls_tab(
      'sc_shape_opacity_hover_tab',
      [
        'label' => __('Hover', 'babe-addons'),
      ]
    );

    // Opacity for Hover State
    $this->add_control(
      'sc_shape_opacity_hover',
      [
        'label' => __('Opacity (Hover)', 'babe-addons'),
        'type' => Controls_Manager::NUMBER,
        'min' => 0,
        'max' => 1,
        'step' => 0.01,
        'default' => 0.85,
        // 'selectors' => [
        //   '{{WRAPPER}} .circle' => 'opacity: {{VALUE}};', 
        // ],
      ]
    );
    $this->end_controls_tab(); // End Hover State Tab

    $this->end_controls_tabs(); // End Control Tabs
    
    $this->end_controls_section();

    // Button Icon content tab
    $this->start_controls_section(
      'button_content_section',
      [
        'label' => __('Button', 'babe-addons'),
        'tab' => Controls_Manager::TAB_CONTENT,
      ]
    );

    // Add Button icon control
    $this->add_control(
      'sc_button_icon',
      [
        'label' => __('Button Icon', 'babe-addons'),
        'type' => Controls_Manager::ICONS, // Use ICONS type for icon explorer
        'default' => [
          'value' => 'fa-solid fa-arrow-right',
          'library' => 'fa-solid',
        ],
      ]
    );
    $this->add_control(
      'show_sc_button_text',
      [
        'label' => esc_html__('Show Text', 'babe-addons'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('No', 'babe-addons'),
        'label_off' => esc_html__('Yes', 'babe-addons'),
        'return_value' => 'yes',
        'default' => 'no',
        // 'condition' => [
        //   'service_link!' => '',
        // ],
      ]
    );
    $this->add_control(
      'show_sc_button_text_icon',
      [
        'label' => esc_html__('Show Text & Icon', 'babe-addons'),
        'type' => Controls_Manager::SWITCHER,
        'label_on' => esc_html__('No', 'babe-addons'),
        'label_off' => esc_html__('Yes', 'babe-addons'),
        'return_value' => 'yes',
        'default' => 'no',
        // 'condition' => [
        //   'service_link!' => '',
        // ],
      ]
    );
    

    $this->end_controls_section();


    // Title Style
    $this->start_controls_section(
      'service_circle_section_style',
      [
        'label' => __('Title', 'babe-addons'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    

    // Start control tabs for normal and hover states
    $this->start_controls_tabs('service_circle_title_color_tabs');

    // Normal State Tab
    $this->start_controls_tab(
      'service_circle_title_color_normal_tab',
      [
        'label' => __('Normal', 'babe-addons'),
      ]
    );

    // Icon Color Control for Normal State
    $this->add_control(
      'service_circle_title_color_normal',
      [
        'label' => __('Title Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .circle-service-title' => 'color: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );
    $this->end_controls_tab(); // End Normal State Tab

    // Hover State Tab
    $this->start_controls_tab(
      'service_circle_title_color_hover_tab',
      [
        'label' => __('Hover', 'babe-addons'),
      ]
    );

    // Title Color Control for Hover State
    $this->add_control(
      'service_circle_title_color_hover',
      [
        'label' => __('Title Color (Hover)', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .circle:hover .circle-service-title' => 'color: {{VALUE}};',
        ],
        'default' => '#ff0000', // Default hover color
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );



    $this->end_controls_tab(); // End Hover State Tab

    $this->end_controls_tabs(); // End Control Tabs

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'service_circle_title_typography',
        'label' => __('Typography', 'babe-addons'),
        'selector' => '{{WRAPPER}} .circle-service-title',
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
      'service_circle_title_margin',
      [
        'label' => __('Title Margin', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .circle-service-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'service_circle_title_padding',
      [
        'label' => __('Title Padding', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .circle-service-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();
    // Description Style
    $this->start_controls_section(
      'sc_description_section_style',
      [
        'label' => __('Description', 'babe-addons'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );
    /* $this->add_control(
        'service_circle_title',
        [
            'label' => __('Description', 'babe-addons'),
            'type' => Controls_Manager::HEADING,
        ]
    ); */
    // Description Alignment
    /* $this->add_control(
      'sc_description_alignment',
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
            'title' => __('Justify', 'babe-addons'),
            'icon' => 'eicon-text-align-justify',
          ],
        ],
        'default' => 'left',
        'selectors' => [
          '{{WRAPPER}} .circle-service-description' => 'text-align: {{VALUE}};',
        ],
      ]
    ); */

    // Start control tabs for normal and hover states
    $this->start_controls_tabs('sc_description_color_tabs');

    // Normal State Tab
    $this->start_controls_tab(
      'sc_description_color_normal_tab',
      [
        'label' => __('Normal', 'babe-addons'),
      ]
    );

    // Description Color Control for Normal State
    $this->add_control(
      'sc_description_color_normal',
      [
        'label' => __('Description Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .circle-service-description' => 'color: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );



    $this->end_controls_tab(); // End Normal State Tab

    // Hover State Tab
    $this->start_controls_tab(
      'sc_description_color_hover_tab',
      [
        'label' => __('Hover', 'babe-addons'),
      ]
    );

    // Description Color Control for Hover State
    $this->add_control(
      'sc_description_color_hover',
      [
        'label' => __('Description Color (Hover)', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .circle:hover .circle-service-description' => 'color: {{VALUE}};',
        ],
        'default' => '#ff0000', // Default hover color
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );



    $this->end_controls_tab(); // End Hover State Tab

    $this->end_controls_tabs(); // End Control Tabs

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'sc_description_typography',
        'label' => __('Typography', 'babe-addons'),
        'selector' => '{{WRAPPER}} .circle-service-description',
        'default' => [
          'font_size' => [
            'size' => 24,
            'unit' => 'px',
          ],
          'font_weight' => 'bold',
        ],
      ]
    );


    // Description Spacing (Margin & Padding)
    $this->add_control(
      'sc_description_margin',
      [
        'label' => __('Description Margin', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .circle-service-description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'sc_description_padding',
      [
        'label' => __('Description Padding', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .circle-service-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();

    // Button Style
    $this->start_controls_section(
      'sc_button_section_style',
      [
        'label' => __('Button', 'babe-addons'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    // Start control tabs for normal and hover states
    $this->start_controls_tabs('sc_button_color_tabs');

    // Normal State Tab
    $this->start_controls_tab(
      'sc_button_color_normal_tab',
      [
        'label' => __('Normal', 'babe-addons'),
      ]
    );

    // Button Color Control for Normal State
    $this->add_control(
      'sc_button_color_normal',
      [
        'label' => __('Text Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn' => 'color: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        // 'separator' => 'before',
      ]
    );
    $this->add_control(
      'sc_button_icon_color_normal',
      [
        'label' => __('Icon Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn i' => 'color: {{VALUE}};',
          '{{WRAPPER}} .service-link-btn svg' => 'fill: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        // 'separator' => 'before',
      ]
    );
    $this->add_control(
      'sc_button_bgcolor_normal',
      [
        'label' => __('Background Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn' => 'background-color: {{VALUE}};',
        ],
        'default' => '#cccccc',
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );



    $this->end_controls_tab(); // End Normal State Tab

    // Hover State Tab
    $this->start_controls_tab(
      'sc_button_color_hover_tab',
      [
        'label' => __('Hover', 'babe-addons'),
      ]
    );

    // Button Color Control for Hover State
    $this->add_control(
      'sc_button_color_hover',
      [
        'label' => __('Text Color (Hover)', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn:hover' => 'color: {{VALUE}};',
        ],
        'default' => '#ffffff', // Default hover color
        'frontend_available' => true,
        // 'separator' => 'before',
      ]
    );
    $this->add_control(
      'sc_button_icon_color_hover',
      [
        'label' => __('Icon Color', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn:hover i' => 'color: {{VALUE}};',
          '{{WRAPPER}} .service-link-btn:hover svg' => 'fill: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        // 'separator' => 'before',
      ]
    );
    $this->add_control(
      'sc_button_bgcolor_hover',
      [
        'label' => __('Background Color (Hover)', 'babe-addons'),
        'type' => Controls_Manager::COLOR,
        'selectors' => [
          '{{WRAPPER}} .service-link-btn:hover' => 'background-color: {{VALUE}};',
        ],
        'default' => '#000000',
        'frontend_available' => true,
        'separator' => 'after',
      ]
    );



    $this->end_controls_tab(); // End Hover State Tab

    $this->end_controls_tabs(); // End Control Tabs

    $this->add_group_control(
      Group_Control_Typography::get_type(),
      [
        'name' => 'sc_button_typography',
        'label' => __('Typography', 'babe-addons'),
        'selector' => '{{WRAPPER}} .service-link-btn',
        'default' => [
          'font_size' => [
            'size' => 24,
            'unit' => 'px',
          ],
          'font_weight' => 'bold',
        ],
      ]
    );


    // Button Spacing (Margin & Padding)
    $this->add_control(
      'sc_button_margin',
      [
        'label' => __('Button Margin', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'sc_button_padding',
      [
        'label' => __('Button Padding', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_control(
      'sc_button_icon_heading',
      [
        'label' => __('Icon', 'babe-addons'),
        'type' => Controls_Manager::HEADING,
      ]
    );
    $this->add_responsive_control(
      'sc_button_icon_width',
      [
        'label' => __('Icon Size', 'babe-addons'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px', 'vw'], // Allowed units
        'range' => [
          'px' => [
            'min' => 10,
            'max' => 50,
          ],
          'vw' => [
            'min' => 1,
            'max' => 10,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 16,
        ],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn svg' => 'width: {{SIZE}}{{UNIT}};', // Square control
          '{{WRAPPER}} .service-link-btn i' => 'font-size: {{SIZE}}{{UNIT}};', // Square control
        ],
      ]
    );
    $this->add_responsive_control(
      'sc_button_icon_gap',
      [
        'label' => __('Gap Between', 'babe-addons'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['px', 'em'], // Allowed units
        'range' => [
          'px' => [
            'min' => 1,
            'max' => 50,
          ],
          'em' => [
            'min' => 1,
            'max' => 10,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => 15,
        ],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn svg' => 'margin-left: {{SIZE}}{{UNIT}};', // Square control
          '{{WRAPPER}} .service-link-btn i' => 'margin-left: {{SIZE}}{{UNIT}};', // Square control
        ],
      ]
    );
    $this->add_control(
      'sc_button_icon_margin',
      [
        'label' => __('Icon Margin', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn svg, {{WRAPPER}} .service-link-btn i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );

    $this->add_control(
      'sc_button_icon_padding',
      [
        'label' => __('Icon Padding', 'babe-addons'),
        'type' => Controls_Manager::DIMENSIONS,
        'size_units' => ['px', 'em', '%'],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn svg, {{WRAPPER}} .service-link-btn i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
        ],
      ]
    );
    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name' => 'sc_button_border',
        'label' => __('Button Border', 'babe-addons'),
        'selector' => '{{WRAPPER}} .service-link-btn',
      ]
    );

    $this->add_responsive_control(
      'sc_button_border_radius',
      [
        'label' => __('Border Radius', 'babe-addons'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['%', 'px'], // Allowed units
        'range' => [
          '%' => [
            'min' => 1,
            'max' => 100,
          ],
          'px' => [
            'min' => 1,
            'max' => 500,
          ],
          'em' => [
            'min' => 1,
            'max' => 20,
          ],
        ],
        'default' => [
          'unit' => '%',
          'size' => 50,
        ],
        'selectors' => [
          '{{WRAPPER}} .service-link-btn' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->end_controls_section();
    // Box Style
    $this->start_controls_section(
      'sc_circle_section_style',
      [
        'label' => __('Box', 'babe-addons'),
        'tab' => Controls_Manager::TAB_STYLE,
      ]
    );

    $this->add_group_control(
      Group_Control_Border::get_type(),
      [
        'name' => 'sc_shape_border',
        'label' => __('Box Border', 'babe-addons'),
        'selector' => '{{WRAPPER}} .circle',
      ]
    );

    $this->add_responsive_control(
      'sc_shape_border_radius',
      [
        'label' => __('Border Radius', 'babe-addons'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['%', 'px'], // Allowed units
        'range' => [
          '%' => [
            'min' => 1,
            'max' => 100,
          ],
          'px' => [
            'min' => 1,
            'max' => 500,
          ],
          'em' => [
            'min' => 1,
            'max' => 20,
          ],
        ],
        'default' => [
          'unit' => '%',
          'size' => 50,
        ],
        'selectors' => [
          '{{WRAPPER}} .circle' => 'border-radius: {{SIZE}}{{UNIT}};',
        ],
      ]
    );
    $this->add_responsive_control(
      'sc_shape_gap_between',
      [
        'label' => __('Gap Between', 'babe-addons'),
        'type' => Controls_Manager::SLIDER,
        'size_units' => ['%', 'px'], // Allowed units
        'range' => [
          '%' => [
            'min' => -100,
            'max' => 100,
          ],
          'px' => [
            'min' => -125,
            'max' => 200,
          ],
          'em' => [
            'min' => -10,
            'max' => 10,
          ],
        ],
        'default' => [
          'unit' => 'px',
          'size' => -15,
        ],
        'selectors' => [
          '{{WRAPPER}} .circle' => 'margin: {{SIZE}}{{UNIT}};', // Square control
        ],
      ]
    );
    $this->add_control(
      'sc_shape_opacity_heading',
      [
        'label' => __('Opacity', 'babe-addons'),
        'type' => Controls_Manager::HEADING,
      ]
    );




    $this->end_controls_section();
  }

  protected function render()
  {
    $settings = $this->get_settings_for_display();
    $widget = $this->get_data();
    $unique_id = $widget['id'];
    $services_list = $settings['services_list'];
    $show_sc_button_text = $settings['show_sc_button_text'];
    $sc_shape_opacity_normal = $settings['sc_shape_opacity_normal'];
    $sc_shape_opacity_hover = $settings['sc_shape_opacity_hover'];

?>
    <style>
      .circle-container-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        margin: 0;
        padding: 50px 0;
      }

      .circle-container {
        display: flex;
        align-items: center;
      }

      .circle {
        width: 250px;
        height: 250px;
        min-width: 250px;
        min-height: 250px;
        border-radius: 50%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-left: -30px;
        padding: 20px;
        position: relative;
        transition: all 0.3s ease-in;
      }

      /* .circle:hover {
        transform: scale(1.2);
        z-index: 999;
      } */

      .circle h3 {
        color: #5c1f99;
        margin-bottom: 10px;
        font-weight: bold;
      }

      .circle p {
        font-size: 14px;
        color: #333;
        margin: 0;
      }

      .circle img {
        width: 100%;
        max-width: 90px;
        ;
      }

      .service-link-btn {
        display: inline-block;
        margin-top: 10px;
        padding: 10px 15px;
        background: #5c1f99;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
      }

      .service-link-btn i {
        font-size: 32px;
        color: #000;
      }

      .service-link-btn svg {
        width: 32px;
      }

      .circle-service-title,
      .circle-service-description {
        width: 100%;
      }

      .service-icon i,
      .service-icon svg {
        font-size: 32px;
        width: 32px;
        color: #000;
      }
    </style>

    <?php


    echo '<div class="circle-container-wrapper">';
    echo '<div class="circle-container">';

    // Loop through each service
    if ($services_list) {
      foreach ($services_list as $index => $service) {
        // Safely get the background color
        $circle_background = isset($service['circle_background_normal']) ? $service['circle_background_normal'] : '#cccccc50'; // Default to the color you want

        echo '<div class="object circle" style="background: ' . esc_attr($circle_background) . ';">';

        // Output Icon
        if (!empty($service['service_icon']['value']) && \Elementor\Icons_Manager::is_migration_allowed()) {
          echo '<div class="service-icon">';
          \Elementor\Icons_Manager::render_icon($service['service_icon'], ['aria-hidden' => 'true']);
          echo '</div>';
        }

        // Output Service Name
        if (!empty($service['service_name'])) {
          echo '<h3 class="circle-service-title">' . esc_html($service['service_name']) . '</h3>';
        }

        // Output Service Description
        if (!empty($service['service_description'])) {
          echo '<p class="circle-service-description">' . esc_html($service['service_description']) . '</p>';
        }

        // Output Link Button
        if (!empty($service['service_link']['url'])) {
          $target = !empty($service['service_link']['is_external']) ? ' target="_blank"' : '';
          echo '<a href="' . esc_url($service['service_link']['url']) . '"' . $target . ' class="service-link-btn">';

          // If both button text and icon should be shown
          if (!empty($settings['show_sc_button_text_icon'])) {
            echo 'Read More';
            \Elementor\Icons_Manager::render_icon($settings['sc_button_icon'], ['aria-hidden' => 'true']);
          }
          // Show only button text
          elseif ($show_sc_button_text) {
            echo 'Read More';
          }
          // Show only the icon if text is not required
          elseif (!empty($settings['sc_button_icon']) && !empty($settings['sc_button_icon']['value'])) {
            \Elementor\Icons_Manager::render_icon($settings['sc_button_icon'], ['aria-hidden' => 'true']);
          }

          echo '</a>';
        }



        echo '</div>'; // End .circle
      }
    }

    echo '</div>'; // End .circle-container
    echo '</div>'; // End .circle-container-wrapper

    ?>
    <script>
      function servicesCircleWidget() {
        const noOfCircles = document.querySelectorAll(".circle-container<?php echo $unique_id; ?> .circle").length;
        let circleWidth = 100 / noOfCircles;
        document.querySelectorAll(".circle").forEach((circle) => {
          circle.style.width = circleWidth + '%';
          circle.style.height = circleWidth + '%';
          circle.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.2)';
            this.style.zIndex = 999;
            let currentColor = window.getComputedStyle(this).backgroundColor;
            let rgbaColor = currentColor.replace(/rgba?\((\d+), (\d+), (\d+)(?:, [\d.]+)?\)/, 'rgba($1, $2, $3, <?php echo $sc_shape_opacity_hover; ?>)');
            this.style.backgroundColor = rgbaColor; 
          });
          
          circle.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
            this.style.zIndex = 0;
            // Revert to the original background color
            let originalColor = window.getComputedStyle(this).backgroundColor;
            let rgbaColor = originalColor.replace(/rgba?\((\d+), (\d+), (\d+)(?:, [\d.]+)?\)/, 'rgba($1, $2, $3, <?php echo $sc_shape_opacity_normal; ?>)'); 
            this.style.backgroundColor = rgbaColor;
          });
        });
      }
      document.addEventListener("DOMContentLoaded", function() {
        servicesCircleWidget();
      });
      servicesCircleWidget();
    </script>

<?php
  }
}
