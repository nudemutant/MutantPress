<?php
/**
 * Template part for Multi Level Menu
 *
 * @link https://github.com/codrops/MultiLevelMenu
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

?>

<button class="action action--open" aria-label="Open Menu"><span class="icon icon--menu"></span></button>
<nav id="ml-menu" class="menu">
    <button class="action action--close" aria-label="Close Menu"><span class="icon icon--cross"></span></button>
    <?php multi_level_menu(); ?>
</nav>