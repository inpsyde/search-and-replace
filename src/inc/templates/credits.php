<?php
/**
 * Template for displaying sql export page
 */
// Prevent direct access.
if ( ! defined( 'INSR_DIR' ) ) {
	//exit;
}
?>
<div class="wrap">

	<h1 id="title"><?php esc_html_e( 'Search & Replace', 'insr' ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a class="nav-tab" href="<?php echo admin_url() ?>tools.php?page=db_backup"><?php esc_html_e( 'Backup Database', 'insr' ); ?></a>
		<a class="nav-tab" href="<?php echo admin_url() ?>tools.php?page=replace_domain"><?php esc_html_e( 'Replace Domain/URL', 'insr' ); ?></a>
		<a class="nav-tab" href="<?php echo admin_url() ?>tools.php?page=inpsyde_search_replace"><?php esc_html_e( 'Search and replace', 'insr' ); ?></a>
		<a class="nav-tab" href="<?php echo admin_url() ?>tools.php?page=sql_import"><?php esc_html_e( 'Import SQL file', 'insr' ); ?></a>
		<a class="nav-tab nav-tab-active" href="<?php echo admin_url() ?>tools.php?page=credits"><?php esc_html_e( 'Credits', 'insr' ); ?></a>
	</h2>

	<h2><?php _e( "Hey nice to have you here!", 'insr' ); ?></h2>
	<p><?php _e( 'Search and Replace is refactored by <a href="http://inpsyde.com/en/">Inpsyde GmbH</a> and based on the original from <a href="http://thedeadone.net">Mark Cunningham</a> ', 'insr' ); ?> </p>

	<h2><?php _e( "We are Inpsyde", 'insr' ); ?></h2>
	<p><?php _e( "Inpsyde has developed enterprise solutions with the world's most popular open-source CMS since it was a kitten. Still do, inconvincibly convinced.", 'insr' ); ?> </p>
	<p><?php _e( "Inpsyde is a WordPress <a href='https://vip.wordpress.com/partner/inpsyde/'>VIP Service Partner</a> and <a href='https://www.woothemes.com/experts/inpsyde-gmbh/'>WooCommerce Experten</a>.", 'insr' ); ?> </p>
	<p><?php _e( "<a href='https://profiles.wordpress.org/inpsyde/#content-plugins'>Look at our other WordPress plugins</a>", 'insr' ); ?> </p>


	<h2><?php _e( "Working at Inpsyde", 'insr' ); ?></h2>
	<p><?php _e( "s the biggest WordPress enterprise in Europe we’re dynamically growing and constantly looking for new employees. So do you want to shape WordPress in an interesting and exciting working environment? Here we are!", 'insr' ); ?> </p>
	<p><?php _e( "At the moment we’re looking for developers for WordPress based products and services. If you’re not a developer and want to be part of us, we’d be happy to recieve your unsolicited application. At Inpsyde you can expect an open, modern and lively company culture:", 'insr' ); ?> </p>
	<ol>
		<li><?php _e( "challenging and exciting projects", 'insr' ); ?></li>
		<li><?php _e( "flexible working hours in remote office", 'insr' ); ?></li>
		<li><?php _e( "deliberately flat hierarchies and short decision paths", 'insr' ); ?></li>
		<li><?php _e( "a wide variety of tasks", 'insr' ); ?></li>
		<li><?php _e( "freedom for personal development and responsible, self-reliant action", 'insr' ); ?></li>

	</ol>
	<p><?php _e( "If you love open source and especially WordPress, if you love to organize your working days by yourself and want to use your pragmatic problem-solving skills and result-oriented work methods: <a href='mailto:jobs@inpsyde.com'>join our team</a>!", 'insr' ); ?> </p>

