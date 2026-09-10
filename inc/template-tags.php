<?php
if (!defined('ABSPATH')) exit;

/**
 * Facebook's "Page Plugin" iframe embed — the modern, officially-supported
 * replacement for the old deprecated "Like Box" widget. Deliberately just an
 * iframe, not the full Facebook JS SDK: lighter, no third-party script
 * running elsewhere on the page, matches this theme's no-dependency approach.
 * Trade-off: without the SDK, the embed can't truly reflow responsively, so
 * $width is a fixed pixel size chosen to comfortably fit the sidebar column
 * and most mobile viewports once it stacks full-width.
 */
function np_facebook_page_embed($url, $width = 300, $height = 460) {
	$src = 'https://www.facebook.com/plugins/page.php?' . http_build_query(array(
		'href'         => $url,
		'tabs'         => 'timeline',
		'width'        => $width,
		'height'       => $height,
		'small_header' => 'false',
		'hide_cover'   => 'false',
		'show_facepile' => 'true',
	));
	return '<iframe src="' . esc_url($src) . '" width="' . esc_attr($width) . '" height="' . esc_attr($height) . '" style="border:none;overflow:hidden;max-width:100%;" scrolling="no" frameborder="0" allowfullscreen="true" loading="lazy" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share" title="' . esc_attr__('Facebook Page', 'wp-newspaper-theme') . '"></iframe>';
}

/**
 * One article-list row: thumbnail, title, byline/date/category, excerpt.
 * Shared by front-page.php, archive.php, category.php, and search.php so the
 * list markup only lives in one place.
 */
function np_article_card() {
	?>
	<article <?php post_class('article-card'); ?>>
		<?php if (has_post_thumbnail()) : ?>
			<a class="article-card-thumb" href="<?php the_permalink(); ?>">
				<?php the_post_thumbnail('medium_large'); ?>
			</a>
		<?php endif; ?>
		<div class="article-card-body">
			<h2 class="article-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php np_article_meta(); ?>
			<div class="article-card-excerpt"><?php the_excerpt(); ?></div>
			<a class="read-more" href="<?php the_permalink(); ?>"><?php esc_html_e('Read more', 'wp-newspaper-theme'); ?></a>
		</div>
	</article>
	<?php
}
