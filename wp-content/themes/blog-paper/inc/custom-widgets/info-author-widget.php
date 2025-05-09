<?php
if ( ! class_exists( 'Blog_Paper_Author_Info_Widget' ) ) {
	/**
	 * Adds Blog Paper Author Info Widget.
	 */
	class Blog_Paper_Author_Info_Widget extends WP_Widget {

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$blog_paper_author_info_widget = array(
				'classname'   => 'widget blog-paper-widget author-widget',
				'description' => __( 'Retrive Author Information Widget', 'blog-paper' ),
			);
			parent::__construct(
				'blog_paper_author_info_widget',
				__( 'Artify Widget: Author Info Widget', 'blog-paper' ),
				$blog_paper_author_info_widget
			);
		}

		/**
		 * Front-end display of widget.

		 * @see WP_Widget::widget()

		 * @param array $args     Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {
			if ( ! isset( $args['widget_id'] ) ) {
				$args['widget_id'] = $this->id;
			}
			$section_title      = ! empty( $instance['title'] ) ? $instance['title'] : '';
			$section_title      = apply_filters( 'widget_title', $section_title, $instance, $this->id_base );
			$author_name        = ! empty( $instance['name'] ) ? $instance['name'] : '';
			$author_designation = ! empty( $instance['designation'] ) ? $instance['designation'] : '';
			$author_description = ! empty( $instance['description'] ) ? $instance['description'] : '';
			$author_image_url   = ! empty( $instance['author_image_url'] ) ? $instance['author_image_url'] : '';

			echo $args['before_widget'];
			if ( ! empty( $section_title ) ) {
				echo $args['before_title'] . esc_html( $section_title ) . $args['after_title'];
			}
			?>

			<div class="widget-content-area">
				<div class="author-part">
					<div class="author-img">
						<?php
						if ( ! empty( $author_image_url ) ) {
							$sizes = array();
							echo '<img src="' . esc_url( $author_image_url ) . '" alt="' . esc_attr( $author_name ) . '"  />';
						}
						?>
					</div>
					<div class="author-name-part">
						<h3 class="author-name">
							<?php echo esc_html( $author_name ); ?>
						</h3>
						<p class="author-position"><?php echo wp_kses_post( $author_designation ); ?></p>
					</div>
				</div>
				<div class="author-details">
					<p class="author-description"><?php echo wp_kses_post( $author_description ); ?></p>
				</div>
				<div class="author-social-contacts">
					<?php
					for ( $i = 1; $i <= 4; $i++ ) {
						$link = ( ! empty( $instance[ 'link-' . $i ] ) ) ? $instance[ 'link-' . $i ] : '';
						if ( ! empty( $link ) ) :
							?>
							<a href="<?php echo esc_url( $link ); ?>"></a>
							<?php
						endif;
					}
					?>
				</div>
			</div>

			<?php
			echo $args['after_widget'];
		}

		/**
		 * Back-end widget form.

		 * @see WP_Widget::form()

		 * @param array $instance Previously saved values from database.
		 */
		public function form( $instance ) {
			$section_title      = isset( $instance['title'] ) ? $instance['title'] : '';
			$author_name        = isset( $instance['name'] ) ? $instance['name'] : '';
			$author_designation = isset( $instance['designation'] ) ? $instance['designation'] : '';
			$author_description = isset( $instance['description'] ) ? $instance['description'] : '';
			$author_image_url   = isset( $instance['author_image_url'] ) ? $instance['author_image_url'] : '';
			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Section Title:', 'blog-paper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $section_title ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>"><?php esc_html_e( 'Author Name:', 'blog-paper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'name' ) ); ?>" type="text" value="<?php echo esc_attr( $author_name ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'designation' ) ); ?>"><?php esc_html_e( 'Author Designation:', 'blog-paper' ); ?></label>
				<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'designation' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'designation' ) ); ?>" type="text" value="<?php echo esc_attr( $author_designation ); ?>" />
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description :', 'blog-paper' ); ?></label>
				<textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>" value="<?php echo esc_attr( $author_description ); ?>"><?php echo wp_kses_post( $author_description ); ?></textarea>
			</p>
			<div>
				<label for="<?php echo esc_attr( $this->get_field_id( 'author_image_url' ) ); ?>"><?php esc_html_e( 'Author Image URL', 'blog-paper' ); ?></label>:<br />
				<input type="url" class="img widefat" name="<?php echo esc_attr( $this->get_field_name( 'author_image_url' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'author_image_url' ) ); ?>" value="<?php echo esc_url( $author_image_url ); ?>" /><br />
				<?php
				$image_url = '';
				if ( ! empty( $author_image_url ) ) {
					$image_url = $author_image_url;
				}
				$style_attr = '';
				if ( empty( $image_url ) ) {
					$style_attr = 'display:none;';
				}
				?>
				<div class="image-preview" style="<?php echo esc_attr( $style_attr ); ?>">
					<img src="<?php echo esc_url( $image_url ); ?>" alt="<?php esc_attr_e( 'Preview', 'blog-paper' ); ?>" style="width: 200px;"/>
				</div><!-- .image-preview -->
				<input type="button" class="select-img button" value="<?php esc_attr_e( 'Upload', 'blog-paper' ); ?>" data-uploader_title="<?php esc_attr_e( 'Select Image', 'blog-paper' ); ?>" data-uploader_button_text="<?php esc_attr_e( 'Choose Image', 'blog-paper' ); ?>" style="margin-top:5px;" /><br/>
			</div>
			<?php
			for ( $i = 1; $i <= 4; $i++ ) {
				$link = isset( $instance[ 'link-' . $i ] ) ? $instance[ 'link-' . $i ] : '';
				?>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'link-' . $i ) ); ?>"><?php sprintf( esc_html__( 'Link %s :', 'blog-paper' ), $i ); ?></label>
				<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link-' . $i ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link-' . $i ) ); ?>" value="<?php echo esc_url( $link ); ?>"/>
			</p>
			<?php } ?>

			<?php
		}

		/**
		 * Sanitize widget form values as they are saved.

		 * @see WP_Widget::update()

		 * @param array $new_instance Values just sent to be saved.
		 * @param array $old_instance Previously saved values from database.

		 * @return array Updated safe values to be saved.
		 */
		public function update( $new_instance, $old_instance ) {

			$instance                     = $old_instance;
			$instance['title']            = sanitize_text_field( $new_instance['title'] );
			$instance['name']             = sanitize_text_field( $new_instance['name'] );
			$instance['designation']      = wp_kses_post( $new_instance['designation'] );
			$instance['description']      = wp_kses_post( $new_instance['description'] );
			$instance['author_image_url'] = esc_url_raw( $new_instance['author_image_url'] );
			for ( $i = 1; $i <= 4; $i++ ) {
				$instance[ 'link-' . $i ] = esc_url_raw( $new_instance[ 'link-' . $i ] );
			}

			return $instance;
		}

	}
}

/**
 * Enqueue admin scripts for Image Widget
 *
 * @since Blog Paper 1.0
 **/
function blog_paper_author_info_widget_image_upload_enqueue( $hook ) {

	if ( 'widgets.php' !== $hook ) {
		return;
	}

	wp_enqueue_media();
	wp_enqueue_script( 'author-info-widget-image-upload-script', get_template_directory_uri() . '/assets/js/upload.min.js', array( 'jquery' ), BLOG_PAPER_VERSION, true );
}

add_action( 'admin_enqueue_scripts', 'blog_paper_author_info_widget_image_upload_enqueue' );
