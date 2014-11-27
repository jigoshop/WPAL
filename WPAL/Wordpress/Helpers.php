<?php

namespace WPAL\Wordpress;

class Helpers
{
	public function createNonce($action = -1)
	{
		return wp_create_nonce($action);
	}

	public function verifyNonce($nonce, $action = -1)
	{
		return wp_verify_nonce($nonce, $action);
	}

	public function stripSlashesDeep($value)
	{
		return stripslashes_deep($value);
	}

	public function mysql2date($format, $date, $translate = true)
	{
		return mysql2date($format, $date, $translate);
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

	/**
	 * Parses post body with HTML parser.
	 *
	 * Calls `wptexturize` and `wpautop` functions.
	 *
	 * @param $text string Text to parse.
	 * @return string HTML result.
	 */
	public function parsePostBody($text)
	{
		return $this->wpautop($this->wptexturize($text));
	}
}
