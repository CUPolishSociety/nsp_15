<?php
/**
 * This file control blog block
 *
 * @package    OneEngine
 * @package    EngineThemes
 */

// CLEAR BLOCK
if( ! class_exists( 'OE_Portfolio_Block' ) ) :

class OE_Portfolio_Block extends AQ_Block {

	function __construct() {
		$block_options = array(
			'name' => __( 'ET Portfolio', 'oneengine'),
			'size' => 'span12',
		);
		
		//create the block
		parent::__construct('OE_Portfolio_Block', $block_options);
	}

 	function form($instance) {
		
		$defaults = array(
			'p_number' 		=> '12',
			'animation' 	=> 'None',
			'duration' 		=> '300',
			'delay' 		=> '0',
			'margin_top'	=> '10',
			'margin_bottom' => '10',
			'span_column'	=> 'span4',
			'hide_filter' 	=> '0',
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		global $include_animation ;
		global $include_button_effect;
		?>	
        <p class="description">
            <label for="<?php echo $this->get_field_id('margin_top') ?>">
                <?php _e('Margin top','oneengine' ); ?> 
                <?php echo aq_field_input('margin_top', $block_id, $margin_top, 'min', 'number') ?> px
            </label>&nbsp;-&nbsp;
            <label for="<?php echo $this->get_field_id('margin_bottom') ?>">
                <?php _e('Margin bottom','oneengine' ); ?>
                <?php echo aq_field_input('margin_bottom', $block_id, $margin_bottom, 'min', 'number') ?> px
            </label>
        </p>
		<p class="description">
			<label for="<?php echo $this->get_field_id('p_number') ?>">
				<?php _e('Quantity of porfolio items. ( * Note : with the value \'-1\', all item will be displayed ! )','oneengine' ); ?>
                <?php echo aq_field_input('p_number', $block_id, $p_number, 'min', 'number') ?>
			</label>
		</p>	
        <p class="description">
			<label for="<?php echo $this->get_field_id('hide_filter') ?>">
				<?php _e('Hide filter ?','oneengine' ); ?>
				<?php echo aq_field_checkbox('hide_filter', $block_id, $hide_filter) ?>
			</label>
		</p>	
		<?php
	}

	function block($instance) {
		extract($instance);
		
		global $post;	
		$query = new WP_Query(array(
				'post_type' 	 => 'portfolio',
				'posts_per_page' => $p_number
			));

		if($query->have_posts()){
			$i = 0;
			while($query->have_posts()){
				$query->the_post();
				
			$terms = get_the_terms( $post->ID, 'portfolio_cat' );
			$class = '';

			if(!empty($terms)){
				foreach ($terms as $term) {
					$class .= $term->slug.' ';
				}
			}
		?>	
			<div class="row">
				<div class="col-sm-3 pointer" onclick='show_company("<?php echo $post->post_title ?>", "<?php echo $post->post_content ?>")'>
				<?php the_post_thumbnail( 'portfolio-thumb', array('class' => 'img-responsive') ); ?>
				</div>
			</div>

			<?php 
				if($i == 0){?>
					<script type="text/javascript">
					$(document).ready(function(){
					show_company("<?php echo $post->post_title ?>", "<?php echo $post->post_content ?>");

					});
					</script>
				
				<?php }
			?>


			
		<?php
			}
			$i++;
		}
		wp_reset_query();
 		echo 	'<div id="portfolio_content">
					<div class="container">
						<div class="row">
							<div class="port-control col-md-12">
								<a class="prev" href="#"><span class="arrow-port left"></span>&nbsp;&nbsp;'.__('Prev','oneengine').'</a> 
								<a href="#" class="close-port"><i class="fa fa-times"></i></a> 
								<a href="#" class="next">'.__('Next','oneengine').'&nbsp;&nbsp;<span class="arrow-port right"></span></a>
							</div>
						</div>
						<div class="port-content">	
						</div>
					</div>
 				</div>';				
	}
	
 	function before_block($instance) {
		extract($instance);
		echo '<div id="aq-block-'.$template_id.'-'.$number.'" class="aq-block aq-block-'.$id_base.'">';
		echo 	'<div id="portfolio-page" class="portfolio-wrapper" style="margin:'.$margin_top.'px 0 '.$margin_bottom.'px;">';
	}

	function after_block($instance) {
 		extract($instance);
 		echo 	'</div>';
 		echo '</div><!-- END ET-PORTFOLIO-BLOCK-->';
	}

}

aq_register_block( 'OE_Portfolio_Block' );
endif;