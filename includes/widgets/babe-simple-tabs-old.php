<?php


if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Babe_Simple_Tab_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'babe_simple_tab';
    }

    public function get_title() {
        return __( 'Babe Simple Tab', 'babe-addons' );
    }

    public function get_icon() {
        return 'eicon-tab';
    }

    public function get_categories() {
        return [ 'babe_addons' ]; // Ensure this matches the category in the main plugin file.
    }

    protected function _register_controls() {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'babe-addons' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Branding', 'babe-addons' ),
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => __( 'Crafting identities that stick', 'babe-addons' ),
            ]
        );

        // Add the icon control.
        $this->add_control(
            'selected_icon',
            [
                'label' => __( 'Icon', 'babe-addons' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fa-solid fa-circle-arrow-right',
                    'library' => 'fa-solid',
                    'font-size'  => '24px',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        ?>
        <div class="col">
            <div class="deatil-wrap d-flex w-auto p-3 align-items-center justify-content-between">
                <div>
                    <a href="#">
                        <h3><?php echo esc_html( $settings['title'] ); ?></h3>
                        <p class="mb-0"><?php echo esc_html( $settings['description'] ); ?></p>
                    </a>
                </div>
                <div class="my-icon-wrapper">
                    <?php
                    if ( ! empty( $settings['selected_icon']['value'] ) ) {
                        echo \Elementor\Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] );
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }
   /*  protected function content_template() {
		?>
		<#
		const iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i' , 'object' );
		#>
		<div class="my-icon-wrapper">
			{{{ iconHTML.value }}}
		</div>
		<?php
	} */

    
}
