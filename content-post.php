<?php
/**
 * The default template for displaying page content
 *
 * Used for pages
 *
 * @package WordPress
 * @subpackage Refuge
 * @since Refuge 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" class="post-<?php the_ID(); ?> post">
	<div class="entry-image" style="">
		<a href="<?php the_permalink(); ?>" class="lightbox" title="<?php the_title(); ?>" rel="bookmark">
			<?php the_post_thumbnail('full', array( 'class' => 'img-responsive' ) ); ?>
		</a>
	</div>
	<div class="entry-container box">
		<div class="post-title ">
			<div class="post-author"></div>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			</h1>
			<div class="post-meta">
				<ol class="breadcrumb">
					<li><time class="entry-date updated" datetime="<?php echo get_the_date('c');?>"><?php echo get_the_date('F jS, Y');?></time></li>
					<li><?php comments_popup_link( 'Leave a Comment', '1 Comment', '% Comments' ); ?></li>
				</ol>
			</div>
		</div>
		<div class="entry-content" style="opacity: 1;">
			<?php the_content(); ?>
			<?php edit_post_link(); ?>
			<footer class="entry-meta clearfix">
				<div class="row">
					<div class="col-md-6 tags">
						<h4 class="muted">Tags</h4>
							<?php
							$posttags = get_the_tags();
							$html = '';
							foreach ( $posttags as $posttag ) {
								$posttag_link = get_tag_link( $posttag->term_id );

								$html .= "<a href='{$posttag_link}' title='{$posttag->name} Tag' class='{$posttag->slug}'>";
								$html .= '<span class="label label-side-tag">';
								$html .= "{$posttag->name}</a>";
							}
							echo $html;
							?>
					</div>
					<div class="col-md-6">
						<h4 class="muted">Share story</h4>
						<ul class="share-story">
							<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a></li>
							<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a></li>
							<li><a href="http://twitter.com/share?text=Check out this article - &url=<?php the_permalink(); ?>" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a></li>
						</ul>
					</div>
				</div>
			</footer>
		</div>
		<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>
	</div>
</article>
