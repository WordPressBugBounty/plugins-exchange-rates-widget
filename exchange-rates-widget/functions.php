<?php

/**
 * @version 1.4.1
 */

function erw_return_list_languages()
{
    return array(
        'en' => 'English',
        'ru' => 'Русский',
        'it' => 'Italiano',
        'fr' => 'Français',
        'es' => 'Español',
        'de' => 'Deutsch',
        'pt' => 'Português',
        'id' => 'Bahasa Indonesia',
        'cn' => '中国',
        'hi' => 'हिन्दी',
        'ja' => '日本語',
    );
}

function erw_return_language_detected()
{
    $sl = substr(get_bloginfo('language'), 0, 2);

    return (in_array($sl, array_keys(erw_return_list_languages()))) ? $sl : 'en';
}

function is_valid_size($size) {
    // Check for any pixel value (e.g., "100px", "220px")
    if (preg_match('/^\d+px$/', $size)) {
        return true;
    }

    // Check for percentage values between 0% and 100%
    if (preg_match('/^\d+%$/', $size, $matches)) {
        $percentageValue = intval($matches[0]);
        if ($percentageValue >= 0 && $percentageValue <= 100) {
            return true;
        }
    }

    // If none of the conditions match, return false
    return false;
}

function erw_return_currency_list()
{
    $contents = file_get_contents(plugin_dir_path(__FILE__).'data/currencies_'.erw_return_language_detected().'.json');

    return json_decode($contents, true);
}

function erw_wrap_sanitize_text_field($sanitized_value) {
    $sanitized_value = preg_replace('/[()]/', '', $sanitized_value);
    // Escape the attribute value for safe output
    $escaped_value = esc_attr($sanitized_value);
    return $sanitized_value;
}

function erw_return_iframe($params, $width, $height, $signature = null, $text = null)
{
    if (is_valid_size($width) === false) {
        $width = '100%';
    }

    $target_url = strtolower('https://'.$params['fm'].(('en' != $params['lg']) ? '.'.$params['lg'] : '').'.currencyrate.today');

    $url = 'https://currencyrate.today/load-exchangerates?'.http_build_query($params);
    $output = '<iframe title="'.(($text) ? esc_attr($text).': CurrencyRate.Today' : 'Exchange Rates Widget').'" src="'.esc_url($url).'" height="'.esc_attr($height).'" width="'.esc_attr($width).'" frameborder="0" scrolling="no" class="erw-iframe" name="erw-exchange-rates-widget"></iframe>';
    if ($signature) {
        $output .= '<p>'.(($text) ? esc_html($text).' ' : '').'<a href="'.esc_url($target_url).'" class="erw-base-currency-link">'.esc_html($params['fm']).'</a>: '.date_i18n( 'D, j M', false ).'.</p>';
    } else {
        $output .= '<p><a href="'.esc_url($target_url).'" class="erw-base-currency-link">CurrencyRate</a></p>';
    }

    return $output;
}

function erw_print_timezone_list($code, $arr)
{
    $output_string = '';
    $code = esc_attr($code);
    foreach ($arr as $v) {
        $output_string .= '<option value="'.esc_attr($v[0]).'"'.(($code == esc_attr($v[0])) ? ' selected' : '').'>'.esc_html($v[1]).'</option>'.PHP_EOL;
    }

    echo $output_string;
}

function erw_print_select_options($code, $arr, $o = false)
{
    $output_string = '';
    $code = esc_attr($code);
    foreach ($arr as $k => $v) {
        $output_string .= '<option value="'.esc_attr($k).'"'.(($code == esc_attr($k)) ? ' selected' : '').'>'.((true === $o) ? esc_html($k.' - '.$v) : esc_html($v)).'</option>'.PHP_EOL;
    }

    echo $output_string;
}
