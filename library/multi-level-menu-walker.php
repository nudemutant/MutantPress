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
    $s = '<ul data-menu="main">';
    foreach ($tops as $item) {
      $s .= "<li class='menu__item'><a class='menu__link' datasubmenu='submenu-{$item->db_id}' href='{$item->url}'>{$item->title}</a></li>";
    }
    $s .= "</ul>";

    // show sub menu items
    foreach ($real_subs as $k => $items) {
      $s .= "<ul datamenu='submenu-$k'>";
      foreach ($items as $item) {
        $s .= "<li class='menu__item'><a class='menu__link' datasubmenu='submenu-{$item->db_id}' href='{$item->url}'>{$item->title}</a></li>";
      }
      $s .= '</ul>';
    }
    return $s;
  }
}
endif;
?>