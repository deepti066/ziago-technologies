<?php
$sidebar = apply_filters('neotech_theme_sidebar', '');
if (!$sidebar) {
    return;
}

$classSidebar = apply_filters('neotech_sidebar_class', ['widget-area']);
?>

<div id="secondary" class="<?php echo implode(' ', $classSidebar) ?>" role="complementary">
    <?php dynamic_sidebar($sidebar); ?>
</div><!-- #secondary -->
