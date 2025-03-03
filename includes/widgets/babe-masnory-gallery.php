<?php
if (!defined('ABSPATH')) {
    exit;
}

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Babe_Masonry_Gallery extends Widget_Base
{

    public function get_name()
    {
        return 'babe_masonry_gallery';
    }

    public function get_title()
    {
        return __('Masonry Gallery', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-gallery-masonry';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Gallery Images', 'babe-addons'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'gallery_images',
            [
                'label' => __('Add Images', 'babe-addons'),
                'type' => Controls_Manager::GALLERY,
                'default' => [],
            ]
        );

      

        // Columns Control
        $this->add_control(
            'masnory_cols',
            [
                'label' => __('Columns', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '2' => __('2 Columns', 'babe-addons'),
                    '3' => __('3 Columns', 'babe-addons'),
                ],
            ]
        );
        // Lightbox Toggle
        $this->add_control(
            'enable_lightbox',
            [
                'label' => __('Enable Lightbox', 'babe-addons'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'babe-addons'),
                'label_off' => __('No', 'babe-addons'),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        // Image Border Radius Control
        $this->add_control(
            'image_border_radius',
            [
                'label' => __('Image Border Radius', 'babe-addons'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 12,
                ],
                'selectors' => [
                    '{{WRAPPER}} .photos-grid-container img, {{WRAPPER}} .photos-grid-container2 img, {{WRAPPER}} .photos-grid-container .img-box .transparent-box, {{WRAPPER}} .photos-grid-container2 .img-box .transparent-box' => 'border-radius: {{SIZE}}px;',
                ],
            ]
        );

        // Image Size Control
        $this->add_control(
            'image_size',
            [
                'label' => __('Image Size', 'babe-addons'),
                'type' => Controls_Manager::SELECT,
                'default' => 'full',
                'options' => [
                    'thumbnail' => __('Thumbnail', 'babe-addons'),
                    'medium' => __('Medium', 'babe-addons'),
                    'large' => __('Large', 'babe-addons'),
                    'full' => __('Full', 'babe-addons'),
                ],
            ]
        );

        $this->end_controls_section();
    }


    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $enable_lightbox = $settings['enable_lightbox'];
        $masnory_cols = $settings['masnory_cols'];
        if (!empty($settings['gallery_images'])):
        ?>
            
            
            <?php if($settings['masnory_cols'] === '3') : ?>
            <div id="gallery" class="photos-grid-container gallery">            
                <?php foreach ($settings['gallery_images'] as $index => $image): ?>
                    <?php if( $index == 0 ) : ?>
                        <div class="main-photo img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                            <?php if ( isset( $image['url'] ) && ! empty( $image['url'] ) ) : ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>" 
                                    alt="<?php echo isset( $image['caption'] ) ? esc_attr( $image['caption'] ) : ''; ?>" />
                            <?php endif; ?>
                            </a>
                        </div>
                        <div class="small-grid-images">
                            <div class="sub">
                    <?php elseif($index <= 3) : ?>
                        <div class="img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                            </a>
                        </div>
                    <?php elseif($index == 4) : ?>
                        <div id="multi-link" class="img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                                <?php  $plus_img = count($settings['gallery_images']) - 5; ?>
                                <?php if($enable_lightbox === 'yes' ) : ?>
                                    <?php if($plus_img > 0) : ?>
                                    <div class="transparent-box">
                                        <div class="caption">
                                            <?php echo '+ ' . $plus_img; ?>
                                        </div>                                        
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
                <div id="more-img" class="extra-images-container hide-element">
                    <?php foreach ($settings['gallery_images'] as $index => $image): ?>
                        
                        <?php if($index > 4) : ?>                           
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                            </a>   
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php else: ?>
                <div id="gallery" class="photos-grid-container2 gallery">            
                <?php foreach ($settings['gallery_images'] as $index => $image): ?>
                    <?php if( $index == 0 ) : ?>
                        <div class="main-photo img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                            <?php if ( isset( $image['url'] ) && ! empty( $image['url'] ) ) : ?>
                                <img src="<?php echo esc_url( $image['url'] ); ?>" 
                                    alt="<?php echo isset( $image['caption'] ) ? esc_attr( $image['caption'] ) : ''; ?>" />
                            <?php endif; ?>
                            </a>
                        </div>
                        <div class="small-grid-images2">
                            <div class="sub2">
                    <?php elseif($index < 2) : ?>
                        <div class="img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                            </a>
                        </div>
                    <?php elseif($index == 2) : ?>
                        <div id="multi-link" class="img-box">
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                                
                                <?php  $plus_img = count($settings['gallery_images']) - 3; ?>
                                <?php if($enable_lightbox === 'yes' ) : ?>
                                    <?php if($plus_img > 0) : ?>
                                    <div class="transparent-box">
                                        <div class="caption">
                                            <?php echo '+ ' . $plus_img; ?>
                                        </div>                                        
                                    </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </a>
                        </div>
                    </div>
                    <?php endif; ?>
                <?php endforeach; ?>
                </div>
                <div id="more-img" class="extra-images-container hide-element">
                    <?php foreach ($settings['gallery_images'] as $index => $image): ?>
                        <?php if($index > 2) : ?>                           
                            <a href="<?php echo esc_url($image['url']); ?>" class="glightbox" data-glightbox="type: image">
                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['id']); ?>" />
                            </a>   
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php if($enable_lightbox === 'yes') : ?>
            <script id="babe-glightbox">
                function babeLightBox(){
                    const lightbox = GLightbox({
                        touchNavigation: true,
                        loop: true,
                        width: "90vw",
                        height: "90vh"
                    });
                }
                
                document.addEventListener("DOMContentLoaded", function() {
                    babeLightBox();
                });

                setTimeout(babeLightBox, 3000);
            </script>
        <?php endif; ?>
        <?php
        endif;
    }

}
