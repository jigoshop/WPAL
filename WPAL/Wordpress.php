<?php

namespace WPAL;

/**
 * Provides abstraction for WordPress calls.
 *
 * @package WPAL
 * @author Amadeusz Starzykiewicz
 */
class Wordpress
{
	/** @var \wpdb */
	private $wpdb;
	/** @var array */
	private $menu;
	/** @var array */
	private $submenu;
	/** @var mixed */
	private $currentScreen;
	/** @var \WP_Roles */
	private $roles;

	public function __construct()
	{
		global $wpdb;
		global $menu;
		global $submenu;
		global $current_screen;

		$this->wpdb = &$wpdb;
		$this->menu = &$menu;
		$this->submenu = &$submenu;
		$this->currentScreen = &$current_screen;
	}

	/** @return \wpdb WPDB instance. */
	public function getWPDB()
	{
		return $this->wpdb;
	}

	/** @return array Menu data. */
	public function getMenu()
	{
		return $this->menu;
	}

	/** @return array Submenu data. */
	public function getSubmenu()
	{
		return $this->submenu;
	}

	public function getRoles()
	{
		if($this->roles === null){
			global $wp_roles;
			if (class_exists('WP_Roles') && !($wp_roles instanceof \WP_Roles)) {
				$wp_roles = new \WP_Roles();
			}
			$this->roles = &$wp_roles;
		}
		return $this->roles;
	}

	public function getCurrentScreen()
	{
		return $this->currentScreen;
	}

	public function addRole($role, $display_name, $capabilities = array())
	{
		return add_role($role, $display_name, $capabilities);
	}

	public function addAction($tag, $function_to_add, $priority = 10, $accepted_args = 1)
	{
		return add_action($tag, $function_to_add, $priority, $accepted_args);
	}

	public function removeAction($tag, $function_to_remove, $priority = 10)
	{
		return remove_action($tag, $function_to_remove, $priority);
	}

	public function doAction($tag, $arg = '')
	{
		return do_action($tag, $arg);
	}

	public function addFilter($tag, $function_to_add, $priority = 10, $accepted_args = 1)
	{
		return add_filter($tag, $function_to_add, $priority, $accepted_args);
	}

	public function removeFilter($tag, $function_to_remove, $priority = 10)
	{
		return remove_filter($tag, $function_to_remove, $priority);
	}

	public function clearScheduledHook($hook, $args = array())
	{
		wp_clear_scheduled_hook($hook, $args);
	}

	public function nextScheduled($hook, $args = array())
	{
		return wp_next_scheduled($hook, $args);
	}

	public function scheduleEvent($timestamp, $recurrence, $hook, $args = array())
	{
		return wp_schedule_event($timestamp, $recurrence, $hook, $args);
	}

	public function applyFilters($tag, $args)
	{
		return apply_filters($tag, $args);
	}

	public function addImageSize($size, $width = 0, $height = 0, $crop = false)
	{
		return add_image_size($size, $width, $height, $crop);
	}

	public function updateOption($option, $options)
	{
		return update_option($option, $options);
	}

	public function getOption($option, $default = false)
	{
		return get_option($option, $default);
	}

	public function isAdmin()
	{
		return is_admin();
	}

	public function currentUserCan($capability)
	{
		return current_user_can($capability);
	}

	public function addMenuPage($page_title, $menu_title, $capability, $menu_slug, $function = '', $icon_url = '', $position = null)
	{
		return add_menu_page($page_title, $menu_title, $capability, $menu_slug, $function, $icon_url, $position);
	}

	public function addSubmenuPage($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '')
	{
		return add_submenu_page($parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function);
	}

	public function getStylesheetDirectory()
	{
		return get_stylesheet_directory();
	}

	public function getStylesheetDirectoryUri()
	{
		return get_stylesheet_directory_uri();
	}

	public function registerPostType($post_type, $args = array())
	{
		return register_post_type($post_type, $args);
	}

	public function registerTaxonomy($taxonomy, $object_type, $args = array())
	{
		return register_taxonomy($taxonomy, $object_type, $args);
	}

	public function isPostTypeArchive($post_types = '')
	{
		return is_post_type_archive($post_types);
	}

	public function isPage($page = '')
	{
		return is_page($page);
	}

	public function isTax($taxonomy = '', $term = '')
	{
		return is_tax($taxonomy, $term);
	}

	public function isSingular($post_types = '')
	{
		return is_singular($post_types);
	}

	public function wpEnqueueScript($handle, $src = false, $deps = array(), $ver = false, $in_footer = false)
	{
		wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
	}

	public function wpEnqueueStyle($handle, $src = false, $deps = array(), $ver = false, $media = false)
	{
		wp_enqueue_style($handle, $src, $deps, $ver, $media);
	}
}