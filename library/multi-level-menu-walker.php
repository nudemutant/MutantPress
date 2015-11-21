<?php
/**
 * Customize the output of menus for Multi Level Menu
 *
 * @package WordPress
 * @subpackage FoundationPress
 * @since FoundationPress 1.0.0
 */

if ( ! class_exists( 'Mutantpress_Multi_Level_Menu_Walker' ) ) :
class Mutantpress_Multi_Level_Menu_Walker extends Walker_Nav_Menu {

  function walk( $elements, $max_depth) {

    $tops = array(); // top level menu items
    $subs = array(); // sub menu items

    foreach ($elements as $element) {
      if (0 == $element->menu_item_parent)
        $tops[] = $element;
      else
        $subs[] = $element;
    }

    // group sub items by their parents
    $real_subs = array();
    foreach ($subs as $item) {
      $real_subs[$item->menu_item_parent][] = $item;
    }

    // show top level elements
    $s = '<ul id="tops">';
    foreach ($tops as $item) {
      $classes = join(' ', $item->classes);
      $s .= $this->display_item($item);
    }
    $s .= "</ul>";

    // show sub menu items
    foreach ($real_subs as $k => $items) {
      $s .= "<ul class='hidden menu-$k'>";
      foreach ($items as $item) {
        $classes = join(' ', $item->classes);
        $s .= $this->display_item($item);
      }
      $s .= '</ul>';
    }

    return $s;
  }

  function display_item($item) {
    $i = '';
    $this->start_el( $i, $item, 0, array() );
    $this->end_el( $i, $item, 0, array() );
    return $i;
  }
}
endif;
?>