<?php



class Babe_Clients_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'babe_clients';
    }

    public function get_title()
    {
        return __('Babe Clients', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-image';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {

        // Start Section for Client Logos
        $this->start_controls_section(
            'clients_section',
            [
                'label' => __('Clients', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
        // Add Layout Selector
        $this->add_control(
            'layout_type',
            [
                'label' => __('Layout Type', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => [
                    'slide' => __('Slide', 'babe-addons'),
                    'grid' => __('Grid', 'babe-addons'),
                ],
            ]
        );

        // Client Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'client_logo',
            [
                'label' => __('Client Logo', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'client_title',
            [
                'label' => __('Client Title', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Client Name', 'babe-addons'),
                'label_block' => true,
            ]
        );

        // Add Repeater Control
        $this->add_control(
            'clients_list',
            [
                'label' => __('Client Logos', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'client_title' => __('Google', 'babe-addons'),
                        'client_logo' => ['url' => './assets/images/google.png'],
                    ],
                    [
                        'client_title' => __('Tinder', 'babe-addons'),
                        'client_logo' => ['url' => './assets/images/tinder.png'],
                    ],
                ],
                'title_field' => '{{{ client_title }}}',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $layout_type = $settings['layout_type'];
        ?>
        <?php if($layout_type == 'slide'): ?>
        <div class="clients clients-container is-slide">
            <div class="swiper-wrapper">
                <?php foreach ($settings['clients_list'] as $client) : ?>
                    <div class="swiper-slide">
                        <img src="<?php echo esc_url($client['client_logo']['url']); ?>" alt="<?php echo esc_attr($client['client_title']); ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div class="clients-grid-container">            
                <?php foreach ($settings['clients_list'] as $client) : ?>
                    <div class="grid-item">
                        <img src="<?php echo esc_url($client['client_logo']['url']); ?>" alt="<?php echo esc_attr($client['client_title']); ?>" />
                    </div>
                <?php endforeach; ?>            
            </div>
        <?php endif; ?>

        
        <script>
            var isSlider = document.querySelector('.is-slide');
            if(isSlider){
                var clientsSlider = new Swiper(".clients", {
                spaceBetween: 0,
                centeredSlides: true,
                speed: 6000,
                autoplay: {
                    delay: 0,
                },
                loop: true,
                slidesPerView:'auto',
                allowTouchMove: false,
                disableOnInteraction: true
                });
            }
        </script>

    <?php
    }
}
