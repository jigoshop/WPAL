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
	/** @var null|\WP_Post */
	private $post;
	/** @var string */
	private $pageNow;
	/** @var \WP_Query */
	private $query;
	/** @var \WP_Theme */
	private $theme;

	public function __construct()
	{
		global $wpdb;
		global $wp_query;
		global $menu;
		global $submenu;
		global $current_screen;
		global $post;
		global $pagenow;

		$this->wpdb = &$wpdb;
		$this->menu = &$menu;
		$this->submenu = &$submenu;
		$this->currentScreen = &$current_screen;
		$this->post = &$post;
		$this->pageNow = &$pagenow;
		$this->query = &$wp_query;
		$this->theme = wp_get_theme();
	}

	/** @return \wpdb WPDB instance. */
	public function getWPDB()
	{
		return $this->wpdb;
	}

	/** @return \WP_Query Current query object. */
	public function getWpQuery()
	{
		return $this->query;
	}

	/** @return \WP_Theme Currently used theme. */
	public function wpGetTheme()
	{
		return $this->theme;
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

	/** @return null|\WP_Post Post object. */
	public function getGlobalPost()
	{
		return $this->post;
	}

	/** @return string Page now global value. */
	public function getPageNow()
	{
		return $this->pageNow;
	}

	public function getQueryParameter($parameter, $default = null)
	{
		if(!isset($this->query->query[$parameter])){
			return $default;
		}

		return $this->query->query[$parameter];
	}

	/** @return \WP_Roles Roles object. */
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

	/**
	 * @return string Current displayed type.
	 */
	public function getTypeNow()
	{
		global $typenow;
		return $typenow;
	}

	public function getCurrentScreen()
	{
		return $this->currentScreen;
	}

	public function getPost($post = null, $output = OBJECT, $filter = 'raw')
	{
		return get_post($post, $output, $filter);
	}

	public function getPostMeta($post_id, $key = '', $single = false)
	{
		return get_post_meta($post_id, $key, $single);
	}

	public function getPostField($field, $post, $context = 'display')
	{
		return get_post_field($field, $post, $context);
	}

	public function getPostTypeArchiveLink($post_type)
	{
		return get_post_type_archive_link($post_type);
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

	public function wpDeregisterScript($handle)
	{
		wp_deregister_script($handle);
	}

	public function wpEnqueueStyle($handle, $src = false, $deps = array(), $ver = false, $media = false)
	{
		wp_enqueue_style($handle, $src, $deps, $ver, $media);
	}

	public function addMetaBox($id, $title, $callback, $screen = null, $context = 'advanced', $priority = 'default', $callback_args = null)
	{
		add_meta_box($id, $title, $callback, $screen, $context, $priority, $callback_args);
	}

	public function removeMetaBox($id, $screen, $context)
	{
		remove_meta_box($id, $screen, $context);
	}

	public function wpCountPosts($type = 'post', $perm = '')
	{
		return wp_count_posts($type, $perm);
	}

	public function numberFormatI18n($number, $decimals = 0)
	{
		return number_format_i18n($number, $decimals);
	}

	public function fetchFeed($url)
	{
		return fetch_feed($url);
	}

	public function isWpError($thing)
	{
		return is_wp_error($thing);
	}

	public function wptexturize($text)
	{
		return wptexturize($text);
	}

	public function humanTimeDiff($from, $to = '')
	{
		return human_time_diff($from, $to);
	}

	public function getTerms($taxonomies, $args = '')
	{
		return get_terms($taxonomies, $args);
	}

	public function getTheTerms($post, $taxonomy)
	{
		return get_the_terms($post, $taxonomy);
	}

	public function getTermLink($term, $taxonomy = '')
	{
		return get_term_link($term, $taxonomy);
	}

	public function wpUpdatePost($array = array(), $error = false)
	{
		return wp_update_post($array, $error);
	}

	public function updatePostMeta($id, $meta_key, $meta_value, $previous_value = '')
	{
		return update_post_meta($id, $meta_key, $meta_value, $previous_value);
	}

	public function registerSetting($option_group, $option_name, $sanitize_callback = '')
	{
		return register_setting($option_group, $option_name, $sanitize_callback);
	}

	public function addSettingsSection($id, $title, $callback, $page)
	{
		add_settings_section($id, $title, $callback, $page);
	}

	public function addSettingsField($id, $title, $callback, $page, $section = 'default', $args = array())
	{
		 add_settings_field($id, $title, $callback, $page, $section, $args);
	}

	public function wpParseArgs($args, $defaults = '')
	{
		return wp_parse_args($args, $defaults);
	}

	public function sanitizeTitle($title, $fallback_title = '', $context = 'save')
	{
		return sanitize_title($title, $fallback_title, $context);
	}

	public function wpSafeRedirect($location, $status = 302)
	{
		wp_safe_redirect($location, $status);
		exit;
	}

	public function wpRedirect($location, $status = 302)
	{
		wp_redirect($location, $status);
		exit;
	}

	public function wpautop($pee, $br = true)
	{
		return wpautop($pee, $br);
	}

	public function wpGetAttachmentUrl($post_id = 0)
	{
		return wp_get_attachment_url($post_id);
	}

	public function wpGetAttachmentImage($attachment_id, $size = 'thumbnail', $icon = false, $attr = '')
	{
		return wp_get_attachment_image($attachment_id, $size, $icon, $attr);
	}

	public function wpGetAttachmentImageSrc($attachment_id, $size = 'thumbnail', $icon = false)
	{
		return wp_get_attachment_image_src($attachment_id, $size, $icon);
	}
}
