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
		<a href="<?php echo wp_get_attachment_image_src( get_post_thumbnail_id( the_ID() ), 'single-post-thumbnail' ); ?>" class="lightbox" title="Space shouldn't be the final frontier" rel="bookmark">
			<?php the_post_thumbnail( 'your-specified-image-size' ); ?> 
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
				<ul class="post-tags clearfix">

				</ul>
				<div class="share-story-container">
					<h4 class="muted">Share story</h4>
					<ul class="share-story">
						
					</ul>
				</div>
			</footer>
		</div>
	</div>
</article>