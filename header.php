<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php if(defined(WPLANG)) { language_attributes(); } else { echo 'xml:lang="en" lang="en"'; } ?>>

<head><title><?php tarski_doctitle(); ?></title>

	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" />
	<meta name="robots" content="all" />
	<meta name="description" content="<?php bloginfo('description'); ?>" />

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen,projection" />
<?php if(get_bloginfo('text_direction') == 'rtl') { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/library/rtl.css" type="text/css" media="screen,projection" />
<?php } ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/library/print.css" type="text/css" media="print" />
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/library/mobile.css" type="text/css" media="handheld" />
<?php if(get_tarski_option('style')) { ?>
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/styles/<?php tarski_option('style'); ?>" type="text/css" media="screen,projection" />
<?php } ?>

	<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/tarski-js.php"></script>

<?php if(is_single() || (is_page() && ($comments || ($post->comment_status == 'open')))) { ?>
	<link rel="alternate" type="application/rss+xml" title="<?php __('Comments feed','tarski'); ?>" href="<?php echo get_post_comments_feed_link($post->ID); ?>" />
<?php } ?>
	<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> feed" href="<?php bloginfo('rss2_url'); ?>" />

	<?php wp_head(); ?>

</head>

<body id="<?php tarski_bodyid(); ?>" class="<?php tarski_bodyclass(); ?>"><div id="wrapper">

<div id="header" class="<?php tarski_header_status(); ?>">

	<?php th_header(); ?>

	<div id="navigation">
		<?php th_navbar(); ?>
	</div>

</div>

<div id="content">