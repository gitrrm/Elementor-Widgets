<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Work_Masonry_Widget extends \Elementor\Widget_Base
{

    public function get_name()
    {
        return 'work_masonry_widget';
    }

    public function get_title()
    {
        return __('Portfolio Masonry', 'babe-addons');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return ['babe_addons'];
    }

    protected function _register_controls()
    {
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Items', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'description' => __('Set the number of portfolio items to display.', 'babe-addons'),
            ]
        );

        $this->add_control(
            'order',
            [
                'label' => __('Order', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'ASC' => __('Ascending', 'babe-addons'),
                    'DESC' => __('Descending', 'babe-addons'),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab for Title Styling
        $this->start_controls_section(
            'title_style_section',
            [
                'label' => __('Title', 'babe-addons'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        // Title Color Control
        $this->add_control(
            'title_color',
            [
                'label' => __('Title Color', 'babe-addons'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .detail-holder h4' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Title Typography Control
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'babe-addons'),
                'selector' => '{{WRAPPER}} .detail-holder h4',
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        // Setup WP Query
        $query_args = [
            'post_type' => 'portfolio',
            'posts_per_page' => $settings['posts_per_page'],
            'order' => $settings['order'],
        ];

        $query = new WP_Query($query_args);
        $count = 0;

        if ($query->have_posts()):
        ?>
            <div class="work-masonry-layout">
                <div class="container">
                    <?php
// Start the while loop to display the portfolio items
        while ($query->have_posts()): $query->the_post();

            // Get post content and generate excerpt dynamically
            $excerpt_word_count = !empty($settings['excerpt_word_count']) ? $settings['excerpt_word_count'] : 20;
            $content = get_the_content(); // Get full post content for current post
            $excerpt = wp_trim_words(strip_shortcodes($content), $excerpt_word_count); // Trim content and remove shortcodes

            // Display different layout based on $count
            if ($count === 0 || $count === 1): ?>
	                            <div class="img-container-grid-one">
	                                <a href="<?php the_permalink();?>" class="work-detail">
	                                    <img class="img-grid-c" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute();?>" />
	                                    <div class="overlay-detail">
	                                        <div class="detail-holder">
	                                            <h4 class="title"><?php the_title();?></h4>
	                                            <p class="excerpt"><?php echo esc_html($excerpt); ?></p>
	                                        </div>
	                                    </div>
	                                </a>
	                            </div>
	                        <?php endif;?>

                        <?php if ($count === 2 || $count === 3): ?>
                            <div class="img-container-grid-two">
                                <a href="<?php the_permalink();?>" class="work-detail">
                                    <img class="img-grid-c" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute();?>" />
                                    <div class="overlay-detail">
                                        <div class="detail-holder">
                                            <h4 class="title"><?php the_title();?></h4>
                                            <p class="excerpt"><?php echo esc_html($excerpt); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif;?>

                        <?php if ($count === 4): ?>
                            <div class="img-container-grid-three">
                                <a href="<?php the_permalink();?>" class="work-detail">
                                    <img class="img-grid-c" src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'full')); ?>" alt="<?php the_title_attribute();?>" />
                                    <div class="overlay-detail">
                                        <div class="detail-holder">
                                            <h4 class="title"><?php the_title();?></h4>
                                            <p class="excerpt"><?php echo esc_html($excerpt); ?></p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endif;

        $count++;
        endwhile;
        ?>
                </div>
            </div><!-- //.container -->
        <?php
wp_reset_postdata(); // Reset post data after the loop
        else:
            echo '<p>' . esc_html__('No portfolio items found.', 'babe-addons') . '</p>';
        endif;
        ?>
        <style>

.work-masonry-layout {
  display: block;
  height: 100%;
}
.work-masonry-layout .left, .work-masonry-layout .right
{

  display: grid;
  grid-template-columns: 1fr ;
  grid-template-rows: 1fr;
  grid-gap: 1rem;
}
.img-container-grid-one {
  width:49%;
  display:inline-block;
  height: 400px;
}
.img-container-grid-two {

  display:inline-block;
  height:250px;
  width: 24.4%;
}
.img-container-grid-three {

display:inline-block;
height:250px;
width:48.9%;
}
.img-grid-c{
  width:100%;
  height:100%;
  object-fit:cover;
}
.img-container-grid-one a, .img-container-grid-two a, .img-container-grid-three a {
  position: relative;
  width: 100%;
  height: 100%;
  display: block;
}
.work-detail{
  overflow: hidden;
}
.overlay-detail{
  position: absolute;
  width: 100%;
  background: rgba(0,0,0,0.6);
  padding: 20px;
  height: 100%;
  top: 0;
  display: flex;
  justify-content: start;
  align-items: end;
  transform: translateY(80%);
  transition: all .50s cubic-bezier(.165,.84,.44,1);
  opacity: 0;
}
.detail-holder{
  transition: all .90s cubic-bezier(.100,.10,.44,1);
  transform: translateY(70%);
  opacity: 0;
}
.overlay-detail h4{ color: #ffffff; line-height: 21px;}
.overlay-detail p{ color: #ffffff; line-height: 20px;}
.work-detail:hover .overlay-detail{
  opacity: 1;
  transform: translateY(0);
}

.work-detail .overlay-detail:hover .detail-holder{
  opacity:1;
  transform: translateY(20%);
}
@media (max-width: 992px){
  .img-container-grid-one {
  height: 300px;
}
.img-container-grid-two, .img-container-grid-three {
  height:160px;
}
}
@media (max-width:767px){
  .img-container-grid-one {
  height: 200px;
}
.img-container-grid-two, .img-container-grid-three{
  height:130px;
}
}
@media (max-width:567px){
  .work-masonry-layout {
  grid-template-columns: 1fr ;
  grid-template-rows: 1fr;
}
.img-container-grid-one{
  height: auto;
  width: 100%;
}
.img-container-grid-two, .img-container-grid-three {
  height:auto;
  width: 100%;
}
.overlay-detail{
  background: rgba(0,0,0,0.3);
  transform: translateY(0);
  opacity: 1;
}
.detail-holder{
  transition: all .90s cubic-bezier(.100,.10,.44,1);
  transform: translateY(0%);
  opacity: 1;
}
}
</style>
        <?php
}
}
