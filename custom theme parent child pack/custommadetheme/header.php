<?php
/*
 * Header For Custom Theme.
 */
$custom_options = get_option('custom_theme_options');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>
<?php wp_title('|', true, 'right'); ?>
</title>
<?php if (!empty($custom_options['favicon'])) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($custom_options['favicon']); ?>">
<?php } ?>
<?php wp_head(); ?>
</head>
<body>
