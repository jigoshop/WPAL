<?php

namespace WPAL\Wordpress;

class Helpers
{
	public function stripSlashesDeep($value)
	{
		return stripslashes_deep($value);
	}

	public function numberFormatI18n($number, $decimals = 0)
	{
		return number_format_i18n($number, $decimals);
	}

	public function wptexturize($text)
	{
		return wptexturize($text);
	}

	public function wpParseArgs($args, $defaults = '')
	{
		return wp_parse_args($args, $defaults);
	}

	public function sanitizeTitle($title, $fallback_title = '', $context = 'save')
	{
		return sanitize_title($title, $fallback_title, $context);
	}

	public function wpautop($pee, $br = true)
	{
		return wpautop($pee, $br);
	}
}
