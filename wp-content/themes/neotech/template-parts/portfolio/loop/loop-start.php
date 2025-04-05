<?php
/**
 * Portfolio Loop Start
 *
 */

if (!defined('ABSPATH')) {
    exit;
}

$classe         = ['neotech-portfolio'];
$classe_wrapper = ['neotech-con'];
if (neotech_get_portfolio_loop_prop('enable_carousel', false) == true) {
    $classe_wrapper[] = 'neotech-swiper';
    $classe[]         = 'swiper-wrapper';
} else {
    $classe[] = 'elementor-grid';
}
$classe_wrapper = esc_attr(implode(' ', array_unique($classe_wrapper)));
$classe         = esc_attr(implode(' ', array_unique($classe)));
neotech_set_portfolio_loop_prop('portfolio-class', $classe);
neotech_set_portfolio_loop_prop('portfolio-class-wrapper', $classe_wrapper);
?>

<div class="<?php echo esc_attr(neotech_get_portfolio_loop_prop('portfolio-class-wrapper', 'portfolio-wrapper')); ?>">
    <ul class="<?php echo esc_attr(neotech_get_portfolio_loop_prop('portfolio-class', 'portfolio')); ?>">

