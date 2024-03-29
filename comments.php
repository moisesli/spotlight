<?php
/**
 * The template for displaying comments
 *
 * @package Spotlight
 */

?>

<?php do_action( 'csco_comments_before' ); ?>

<?php
$style = 'post-comments-button';
if ( 'page' === get_post_type() ) {
	if ( get_theme_mod( 'page_comments_simple', false ) ) {
		$style = 'post-comments-simple';
	}
} else {
	if ( get_theme_mod( 'post_comments_simple', false ) ) {
		$style = 'post-comments-simple';
	}
}

if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {
	$style = 'post-comments-simple';
}
?>

<div class="post-comments <?php echo esc_attr( $style ); ?> " id="comments">

	<?php if ( have_comments() ) { ?>

		<?php $tag = apply_filters( 'csco_section_title_tag', 'h5' ); ?>
		<<?php echo esc_html( $tag ); ?> class="title-block">
			<?php
			$comments_number = get_comments_number();
			if ( 1 === $comments_number ) {
				esc_html_e( 'One comment', 'spotlight' );
			} else {
				/* translators: 1: number of comments */
				printf( esc_html( _n( '%s comment', '%s comments', $comments_number, 'spotlight' ) ), esc_html( number_format_i18n( (int) $comments_number ) ) );
			}
			?>
		</<?php echo esc_html( $tag ); ?>>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 60,
				)
			);
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php } ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
	?>
	<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'spotlight' ); ?></p>
	<?php } ?>

	<?php
	$tag = apply_filters( 'csco_section_title_tag', 'h5' );
	comment_form(
		array(
			'title_reply_before' => '<' . $tag . ' id="reply-title" class="title-block title-comment-reply">',
			'title_reply_after'  => '</' . $tag . '>',
		)
	);
	?>

</section><!-- .comments-area -->

<?php if ( 'post-comments-button' === $style ) : ?>
	<div class="post-comments-show">
		<button><?php esc_html_e( 'View Comments', 'spotlight' ); ?> (<?php echo intval( get_comments_number() ); ?>)</button>
	</div>
<?php endif; ?>

<?php do_action( 'csco_comments_after' ); ?>
