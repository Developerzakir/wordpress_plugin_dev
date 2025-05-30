<?php  
$softme_information_options_hide_show = get_theme_mod('softme_information_options_hide_show','1');
$softme_information_option 		= get_theme_mod('softme_information_option4',softme_information_options3_default());
if($softme_information_options_hide_show=='1'):
?>
<section id="dt_service_one" class="dt_service dt_service--nine dt-py-default front-info">
	<div class="dt-container">
		<div class="dt-row dt-g-4 info-wrp">
			<?php
				if ( ! empty( $softme_information_option ) ) {
					$allowed_html = array(
						'br'     => array(),
						'em'     => array(),
						'strong' => array(),
						'span' => array(),
						'b'      => array(),
						'i'      => array(),
						);
				$softme_information_option = json_decode( $softme_information_option );
				foreach ( $softme_information_option as $i => $item ) {
					$title = ! empty( $item->title ) ? apply_filters( 'softme_translate_single_string', $item->title, 'Information section' ) : '';
					$text = ! empty( $item->text ) ? apply_filters( 'softme_translate_single_string', $item->text, 'Information section' ) : '';
					$button = ! empty( $item->text2 ) ? apply_filters( 'softme_translate_single_string', $item->text2, 'Information section' ) : '';
					$link = ! empty( $item->link ) ? apply_filters( 'softme_translate_single_string', $item->link, 'Information section' ) : '';
					$image = ! empty( $item->image_url ) ? apply_filters( 'softme_translate_single_string', $item->image_url, 'Information section' ) : '';
					$icon = ! empty( $item->icon_value ) ? apply_filters( 'softme_translate_single_string', $item->icon_value, 'Information section' ) : '';
			?>
				<div class="dt-col-lg-3 dt-col-md-6 dt-col-12">
					<div class="dt_item_inner wow slideInUp animated" data-wow-delay="<?php echo esc_attr($i*100); ?>ms" data-wow-duration="1500ms">							
						<span class="count"><?php esc_html_e('0','desert-companion'); ?><?php echo esc_html($i+1); ?></span>
						<?php if ( ! empty( $icon ) ) : ?>
						<div class="dt_item_icon">
							<i class="<?php echo esc_attr($icon); ?>" aria-hidden="true"></i>
						</div>
						<?php endif; ?>
						<div class="dt_item_holder">
							<?php if ( ! empty( $title ) ) : ?>
								<h5 class="dt_item_title"><a href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $title ), $allowed_html ); ?></a></h5>
							<?php endif; ?>
							<?php if ( ! empty( $text ) ) : ?>
								<div class="dt_item_content"><?php echo wp_kses( html_entity_decode( $text ), $allowed_html ); ?></div>
							<?php endif; ?>
							<?php if ( ! empty( $button ) ) : ?>
								<div class="dt_item_readmore"><a class="dt-btn-arrow" href="<?php echo esc_url($link); ?>"><?php echo wp_kses( html_entity_decode( $button ), $allowed_html ); ?></a></div>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php } } ?>
		</div>
	</div>
</section>
<?php endif; ?>