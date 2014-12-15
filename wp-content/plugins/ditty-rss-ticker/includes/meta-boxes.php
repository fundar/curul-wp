<?php

/* --------------------------------------------------------- */
/* !Create the RSS data metabox - 1.0.0 */
/* --------------------------------------------------------- */

function mtphr_dnt_rss_metaboxes() {

	/* --------------------------------------------------------- */
	/* !Create a display array - 1.0.0 */
	/* --------------------------------------------------------- */

	$display = array();
	$display['title'] = array(
		'id' => '_mtphr_dnt_rss_title',
		'type' => 'checkbox',
		'name' => __('Item title', 'ditty-rss-ticker'),
		'append' => array(
			'_mtphr_dnt_rss_title_link' => array(
				'type' => 'checkbox',
				'label' => __('Link to rss', 'ditty-rss-ticker')
			)
		)
	);
	$display['author'] = array(
		'id' => '_mtphr_dnt_rss_author',
		'type' => 'checkbox',
		'name' => __('Item author', 'ditty-rss-ticker'),
		'append' => array(
			'_mtphr_dnt_rss_author_before' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('Before', 'ditty-rss-ticker'),
				'default' => __('By', 'ditty-rss-ticker')
			),
			'_mtphr_dnt_rss_author_after' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('After', 'ditty-rss-ticker'),
				'default' => ''
			)
		)
	);
	$display['date'] = array(
		'id' => '_mtphr_dnt_rss_date',
		'type' => 'checkbox',
		'name' => __('Item date', 'ditty-rss-ticker'),
		'append' => array(
			'_mtphr_dnt_rss_date_format' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('Format', 'ditty-rss-ticker'),
				'default' => get_option('date_format')
			),
			'_mtphr_dnt_rss_date_before' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('Before', 'ditty-rss-ticker'),
				'default' => __('On', 'ditty-rss-ticker')
			),
			'_mtphr_dnt_rss_date_after' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('After', 'ditty-rss-ticker'),
				'default' => ''
			)
		)
	);
	$display['excerpt'] = array(
		'id' => '_mtphr_dnt_rss_excerpt',
		'type' => 'checkbox',
		'name' => __('Item Excerpt', 'ditty-rss-ticker'),
		'append' => array(
			'_mtphr_dnt_rss_excerpt_length' => array(
				'type' => 'number',
				'size' => 8,
				'before' => __('Excerpt length', 'ditty-rss-ticker'),
				'default' => 40
			),
			'_mtphr_dnt_rss_excerpt_more' => array(
				'type' => 'text',
				'size' => 8,
				'before' => __('Excerpt more', 'ditty-rss-ticker'),
				'default' => ' &hellip; {Read more}'
			)
		)
	);



	/* --------------------------------------------------------- */
	/* !Create a fields array - 1.0.0 */
	/* --------------------------------------------------------- */

	$fields = array();
	$fields['feed'] = array(
		'id' => '_mtphr_dnt_rss_feeds',
		'type' => 'list',
		'name' => __('Feed URLs', 'ditty-rss-ticker'),
		'structure' => array(
			'url' => array(
				'type' => 'text'
			)
		),
		'description' => __('Add an unlimited number of feeds to display.', 'ditty-rss-ticker')
	);
	$fields['limit'] = array(
		'id' => '_mtphr_dnt_rss_limit',
		'type' => 'number',
		'name' => __('Feed options', 'ditty-rss-ticker'),
		'default' => 10,
		'after' => __('Items per feed', 'ditty-rss-ticker'),
		'description' => __('Limit the number of tweets to show and set additional options.', 'ditty-rss-ticker'),
		'append' => array(
			'_mtphr_dnt_rss_target' => array(
				'type' => 'checkbox',
				'label' => __('Open links in new window', 'ditty-rss-ticker'),
			)
		)
	);
	$fields['rss_display'] = array(
		'id' => '_mtphr_dnt_rss_display_order',
		'type' => 'sort',
		'name' => __('Feed item arrangement', 'ditty-rss-ticker'),
		'description' => __('Set the RSS assets and order.', 'ditty-rss-ticker'),
		'rows' => apply_filters('mtphr_dnt_rss_display_rows', $display)
	);



	/* --------------------------------------------------------- */
	/* !Create the metabox - 1.0.0 */
	/* --------------------------------------------------------- */

	$dnt_rsss_data = array(
		'id' => 'mtphr_dnt_rss_data',
		'title' => __('RSS Ticker Data', 'ditty-rss-ticker'),
		'page' => array( 'ditty_news_ticker' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => apply_filters('mtphr_dnt_rss_data_fields', $fields)
	);
	new MTPHR_DNT_MetaBoxer( $dnt_rsss_data );
}
add_action( 'admin_init', 'mtphr_dnt_rss_metaboxes' );

