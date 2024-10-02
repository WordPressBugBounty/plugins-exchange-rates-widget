<?php
/**
 * @version 1.4.1
 */
/*
    Plugin Name: Exchange Rates Widget
    Plugin URI: https://currencyrate.today/exchangerates-widget
    Description: Simple and powerful currency exchange rates widget for your website or blog. Included <strong>190+ world currencies</strong> with <strong>popular cryptocurrencies</strong>. Updates each hour automatically. Multi Language support: English, Русский, Italiano, Français, Español, Deutsch, 中国.
    Version: 1.4.1
    Author: CurrencyRate.today
    Author URI: https://currencyrate.today
    License: GPLv2 or later
    Text Domain: erw_exchange_rates_widget
*/

/*
    Load functions
*/
require_once 'functions.php';
require_once 'languages.php';

/*
    Init widget
*/
add_action('widgets_init', function () {
    register_widget('erw_exchange_rates_widget');
});

/*
    Shortcode
*/
function callback_erw_exchange_rates_widget($atts, $content = null)
{
    $_lg = erw_return_language_detected();

    extract(shortcode_atts(array(
        'size_width' => '100%',
        'fm' => 'EUR',
        'to' => 'USD,GBP,AUD,CNY,JPY,RUB',
        'st' => 'info',
        'lg' => $_lg,
        'tz' => 0,
        'cd' => 0,
        'am' => 100,
    ), $atts, 'erw_exchange_rates_widget'));

    $lg = (empty($lg)) ? $_lg : ((in_array($lg, array_keys(erw_return_list_languages()))) ? $lg : 'en');
    $fm = (empty($fm)) ? 'EUR' : $fm;
    $to = (empty($to)) ? 'USD,GBP,AUD,CNY,JPY,RUB' : $to;

    $height = (90 + (count(explode(',', $to)) * 37));
    $params = array(
      'fm' => $fm,
      'to' => $to,
      'st' => $st,
      'lg' => $lg,
      'tz' => $tz,
      'cd' => $cd,
      'am' => $am,
      'wp' => 'erw_sc',
    );

    if (!isset($atts['size_width']) || is_valid_size($atts['size_width']) === false) {
        $size_width = '100%';
    } else {
        $size_width = erw_wrap_sanitize_text_field($atts['size_width']);
    }

    $language = erw_widget_language($lg);
    $output = erw_return_iframe($params, $size_width, $height, 1, $language['title']);

    return $output;
}

add_shortcode('erw_exchange_rates_widget', 'callback_erw_exchange_rates_widget');

/*
    Class of widget
*/
class erw_exchange_rates_widget extends WP_Widget
{
    /*
        Register widget with WordPress.
    */
    public function __construct()
    {
        parent::__construct(
            'erw_exchange_rates_widget',
            esc_html__('Exchange Rates Widget', 'erw_exchange_rates_widget'),
            array(
                'description' => esc_html__('Displays an exchange rates online.', 'erw_exchange_rates_widget'),
            )
        );
    }

    /*
        Update the widget settings.
    */
    public function update($new_instance, $old_instance)
    {
        $currency_list = erw_return_currency_list();

        $instance = $old_instance;

        $instance['fm'] = erw_wrap_sanitize_text_field($new_instance['fm']);
        $instance['to'] = erw_wrap_sanitize_text_field($new_instance['to']);
        $instance['lg'] = erw_wrap_sanitize_text_field($new_instance['lg']);
        $instance['tz'] = erw_wrap_sanitize_text_field($new_instance['tz']);
        $instance['st'] = erw_wrap_sanitize_text_field($new_instance['st']);
        $instance['cd'] = erw_wrap_sanitize_text_field($new_instance['cd']);
        $instance['am'] = erw_wrap_sanitize_text_field($new_instance['am']);
        $instance['title'] = erw_wrap_sanitize_text_field($new_instance['title']);
        $instance['signature'] = erw_wrap_sanitize_text_field($new_instance['signature']);
        $instance['size_width'] = erw_wrap_sanitize_text_field($new_instance['size_width']);
        $instance['currency_name'] = (1 == $new_instance['cd']) ? $new_instance['fm'] : $currency_list[$new_instance['fm']];

        return $instance;
    }

    /*
        Update the widget settings.
        Make use of the get_field_id() and get_field_name() function when creating your form elements. This handles the confusing stuff.
    */
    public function form($instance)
    {
        /*
            Default widget settings
        */
        $defaults = array(
            'currency_name' => 'Euro',
            'title' => $this->_lang('title'),
            'size_width' => '100%',
            'signature' => 1,
            'fm' => 'EUR',
            'to' => 'USD,GBP,AUD,CNY,JPY,RUB',
            'lg' => erw_return_language_detected(),
            'st' => 'info',
            'tz' => 0,
            'cd' => 0,
            'am' => 100,
        );

        if (empty($instance)) {
            $instance = $defaults;
        }

        $currency_list = erw_return_currency_list();

        $fm = erw_wrap_sanitize_text_field($instance['fm']);
        $to = erw_wrap_sanitize_text_field($instance['to']);
        $lg = erw_wrap_sanitize_text_field($instance['lg']);
        $tz = erw_wrap_sanitize_text_field($instance['tz']);
        $st = erw_wrap_sanitize_text_field($instance['st']);
        $cd = erw_wrap_sanitize_text_field($instance['cd']);
        $am = erw_wrap_sanitize_text_field($instance['am']);
        $title = erw_wrap_sanitize_text_field($instance['title']);
        $signature = erw_wrap_sanitize_text_field($instance['signature']);
        $size_width = erw_wrap_sanitize_text_field($instance['size_width']);

        echo '<p><label for="',esc_attr($this->get_field_id('title')),'">',esc_html($this->_lang('heading')),':',
             '<input id="',esc_attr($this->get_field_id('title')),'" type="text" name="',esc_attr($this->get_field_name('title')),'" value="',esc_attr($title),'" style="width:100%"></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('fm')),'">',esc_html($this->_lang('base_currency')),':',
             '<select id="',esc_attr($this->get_field_id('fm')),'" name="',esc_attr($this->get_field_name('fm')),'" style="width:100%">',
             erw_print_select_options($fm, $currency_list, true),
             '</select></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('to')),'"><a href="https://currencyrate.today/different-currencies" target="_blank">',$this->_lang('сodes_currencies'),'</a> <small>(',$this->_lang('сodes_currencies_open'),')</small>:',
             '<input id="',esc_attr($this->get_field_id('to')),'" type="text" name="',esc_attr($this->get_field_name('to')),'" value="',esc_attr($to),'" style="width:100%"></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('am')),'">',esc_html($this->_lang('amount')),':',
             '<input id="',esc_attr($this->get_field_id('am')),'" type="text" name="',esc_attr($this->get_field_name('am')),'" value="',esc_attr($am),'" style="width:100%"></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('lg')),'">',esc_html($this->_lang('language')),':',
             '<select id="',esc_attr($this->get_field_id('lg')),'" name="',esc_attr($this->get_field_name('lg')),'" style="width:100%">',
             erw_print_select_options($lg, erw_return_list_languages()),
             '</select></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('tz')),'">',esc_html($this->_lang('timezone')),':',
             '<select id="',esc_attr($this->get_field_id('tz')),'" name="',esc_attr($this->get_field_name('tz')),'" style="width:100%">',
             erw_print_timezone_list($tz, $this->_timezones),
             '</select></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('st')),'">',esc_html($this->_lang('theme')),':',
             '<select id="',esc_attr($this->get_field_id('st')),'" name="',esc_attr($this->get_field_name('st')),'" style="width:100%">',
             erw_print_select_options($st, $this->_lang('themes')),
             '</select></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('size_width')),'">',esc_html($this->_lang('size_width')),':',
             '<select id="',esc_attr($this->get_field_id('size_width')),'" name="',esc_attr($this->get_field_name('size_width')),'" style="width:100%">',
             erw_print_select_options($size_width, $this->_lang('sizes')),
             '</select></label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('cd')),'">',
             '<input type="checkbox" ',checked($cd, 1),' id="',esc_attr($this->get_field_id('cd')),'" name="',esc_attr($this->get_field_name('cd')),'" value="1">',
             esc_html($this->_lang('currency_code')),
             '</label></p>';

        echo '<p><label for="',esc_attr($this->get_field_id('signature')),'">',
             '<input type="checkbox" ',checked($signature, 1),' id="',esc_attr($this->get_field_id('signature')),'" name="',esc_attr($this->get_field_name('signature')),'" value="1">',
             esc_html($this->_lang('signature')),
             '</label></p>';

        $widget_params = array(
            'lg' => $lg,
            'tz' => $tz,
            'fm' => $fm,
            'to' => $to,
            'st' => $st,
            'cd' => $cd,
            'am' => $am,
            'size_width' => $size_width,
            'signature' => $signature,
            'wp' => 'erw',
        );

        echo '<hr>',
             '<div><h3>',esc_html($this->_lang('preview')),'</h3>',
             $this->_output_widget($widget_params, $size_width),
             '</div>';

        $short_attrs = '';
        unset($widget_params['wp']);
        foreach ($widget_params as $key => $value) {
            $short_attrs .= $key.'="'.$value.'" ';
        }

        echo '<hr>',
             '<div><h3>',esc_html($this->_lang('generated_shortcode')),'</h3>',
             '<textarea onclick="this.select()" style="width:100%;height:80px;">[erw_exchange_rates_widget ',trim($short_attrs),'][/erw_exchange_rates_widget]</textarea></div>',
             '<hr>';
    }

    /*
        Output widget
    */
    public function widget($args, $instance)
    {
        // Register style
        wp_register_style('erw-exchange-rates-widget', plugin_dir_url(__FILE__).'assets/frontend.css');
        wp_enqueue_style('erw-exchange-rates-widget', plugin_dir_url(__FILE__).'assets/frontend.css');

        // Get values
        extract($args);

        $currency_list = erw_return_currency_list();

        $lg = erw_wrap_sanitize_text_field($instance['lg']);
        $tz = erw_wrap_sanitize_text_field($instance['tz']);
        $fm = erw_wrap_sanitize_text_field($instance['fm']);
        $to = erw_wrap_sanitize_text_field($instance['to']);
        $st = erw_wrap_sanitize_text_field($instance['st']);
        $cd = erw_wrap_sanitize_text_field($instance['cd']);
        $am = erw_wrap_sanitize_text_field($instance['am']);
        $title = erw_wrap_sanitize_text_field($instance['title']);
        $signature = erw_wrap_sanitize_text_field($instance['signature']);
        $size_width = erw_wrap_sanitize_text_field($instance['size_width']);

        //$target_url = strtolower('http://'.$fm.(('en' != $lg) ? '.'.$lg : '').'.currencyrate.today');
        echo $args['before_widget'];

        // Title
        echo $args['before_title'].$title.$args['after_title'];

        // Load language
        $_langs = ['en'=>'en', 'fr'=>'fr', 'ru'=>'ru', 'id'=>'id', 'it'=>'it', 'de'=>'de', 'hi'=>'hi', 'pt'=>'pt', 'ja'=>'ja', 'es'=>'es', 'zh'=>'cn'];
		$_lg = strstr(get_locale(), '_', true);
		$_lg = (isset($_langs[$_lg])) ? $_langs[$_lg] : 'en';
        $language = erw_widget_language($_lg);

        // Output
        echo $this->_output_widget(array(
            'lg' => $lg,
            'tz' => $tz,
            'fm' => $fm,
            'to' => $to,
            'st' => $st,
            'cd' => $cd,
            'am' => $am,
            'wp' => 'erw',
        ), $size_width, $signature, $language['title']);

        echo $args['after_widget'];
    }

    // Private

    /*
        Timezone list
    */
    private $_timezones = array(
      array('-12', '(GMT -12:00) Eniwetok, Kwajalein'),
      array('-11', '(GMT -11:00) Midway Island, Samoa'),
      array('-10', '(GMT -10:00) Hawaii'),
      array('-9', '(GMT -9:00) Alaska'),
      array('-8', '(GMT -8:00) Pacific Time (US &amp; Canada)'),
      array('-7', '(GMT -7:00) Mountain Time (US &amp; Canada)'),
      array('-6', '(GMT -6:00) Central Time (US &amp; Canada), Mexico City'),
      array('-5', '(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima'),
      array('-4', '(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz'),
      array('-3.5', '(GMT -3:30) Newfoundland'),
      array('-3', '(GMT -3:00) Brazil, Buenos Aires, Georgetown'),
      array('-2', '(GMT -2:00) Mid-Atlantic'),
      array('-1', '(GMT -1:00 hour) Azores, Cape Verde Islands'),
      array('0', '(GMT) Western Europe Time, London, Lisbon, Casablanca'),
      array('1', '(GMT +1:00 hour) Brussels, Copenhagen, Madrid, Paris'),
      array('2', '(GMT +2:00) Kaliningrad, South Africa'),
      array('3', '(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg'),
      array('3.5', '(GMT +3:30) Tehran'),
      array('4', '(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi'),
      array('4.5', '(GMT +4:30) Kabul'),
      array('5', '(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent'),
      array('5.5', '(GMT +5:30) Bombay, Calcutta, Madras, New Delhi'),
      array('6', '(GMT +6:00) Almaty, Dhaka, Colombo'),
      array('7', '(GMT +7:00) Bangkok, Hanoi, Jakarta'),
      array('8', '(GMT +8:00) Beijing, Perth, Singapore, Hong Kong'),
      array('9', '(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk'),
      array('9.5', '(GMT +9:30) Adelaide, Darwin'),
      array('10', '(GMT +10:00) Eastern Australia, Guam, Vladivostok'),
      array('11', '(GMT +11:00) Magadan, Solomon Islands, New Caledonia'),
      array('12', '(GMT +12:00) Wellington, Auckland, New Zealand'),
    );

    /*
        Output widget
    */
    private function _output_widget($params, $width, $signature = null, $text = null)
    {   
        // 
        $height = (90 + (count(explode(',', $params['to'])) * 37));
        $output = erw_return_iframe($params, $width, $height, $signature, $text);

        return $output;
    }

    /*
        Load languages text
    */
    private function _lang($value)
    {
        $_erw_widget_language = erw_widget_language(erw_return_language_detected());

        return $_erw_widget_language[$value];
    }
}
