=== Exchange Rates Widget ===
Contributors: falselight
Tags: currency exchange, exchange rates, widget, dollar, forex
Donate link: https://currencyrate.today/exchangerates-widget
Requires at least: 3.1
Tested up to: 7.0
Requires PHP: 5.3
Stable tag: 1.4.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Beautiful live exchange rates widget for 190+ currencies, crypto, and metals. No API key needed.

== Description ==

Exchange Rates Widget helps visitors compare live exchange rates without leaving your WordPress page.
Add clean live exchange rates to finance articles, tourism and travel guides, news websites, pricing pages, business blogs, and sidebars with a shortcode or classic widget.

Visitors get instant context for 190+ currencies, crypto assets, and metals.
Site owners get a lightweight setup: no API key, no local rate database, and no exchange-rate processing load on WordPress.

= ⭐ What makes it useful =

* 🌍 190+ currencies and assets, including popular cryptocurrencies and metals.
* 🧩 Add rates with a shortcode, the Shortcode block, or a classic WordPress widget.
* ⚡ No API key, local exchange-rate database, or exchange-rate processing load on your WordPress site.
* 📱 Responsive layout for posts, pages, sidebars, and footers.
* 🎨 Multiple color themes for matching different site designs.
* 🌐 Multilingual widget labels for international audiences.
* 🕒 Time zone setting for the displayed update date.
* 🔒 SSL-ready CurrencyRate.Today service URLs.

= 🎯 Where it works best =

* Finance blogs that need a quick EUR, USD, GBP, JPY, or crypto reference.
* Tourism and travel websites where readers compare destination prices in familiar currencies.
* News websites that cover markets, business, travel, inflation, or international stories.
* Pricing and comparison pages that need a simple exchange-rate reference nearby.
* Business websites that want always-visible rates in a sidebar or footer.
* Multilingual sites that need exchange-rate labels in the visitor's language.

= 👀 Demos =

* Official demo: [Exchange Rates Widget](https://currencyrate.today/exchangerates-widget)
* Product demo: [Exchange Rates Widget on Yuri.ws](https://yuri.ws/wordpress-plugins/exchange-rate-widget/)

= 🚀 Quick start =

1. Install and activate Exchange Rates Widget.
2. Paste the shortcode into a post, page, or Shortcode block.
3. Choose the base currency, target currencies, language, theme, and amount.
4. Optionally add the classic widget to a sidebar or footer.

Important: this plugin provides a classic `WP_Widget`.
On modern WordPress installations with the block-based widget screen, install and activate Classic Widgets to manage the widget in Appearance > Widgets.
Shortcodes work without Classic Widgets.

= 🧩 Shortcode examples =

Market widget example:

`[erw_exchange_rates_widget lg="en" tz="0" fm="EUR" to="USD,GBP,AUD,CNY,JPY,RUB" st="info" cd="0" am="100" size_width="100%"][/erw_exchange_rates_widget]`

Travel widget example:

`[erw_exchange_rates_widget lg="en" tz="0" fm="USD" to="EUR,JPY,GBP" st="success" cd="1" am="100" size_width="100%"][/erw_exchange_rates_widget]`

= 🔧 Shortcode attributes =

* `lg` - language. Supported values: `en`, `ru`, `it`, `fr`, `es`, `de`, `cn`, `pt`, `ja`, `id`, `hi`.
* `tz` - time zone offset.
* `fm` - base currency code, for example `EUR`.
* `to` - comma-separated target currency codes, for example `USD,GBP,AUD,CNY,JPY,RUB`.
* `st` - theme. Supported values: `primary`, `info`, `danger`, `warning`, `default`, `success`.
* `cd` - display mode. Use `1` to show currency codes only or `0` to show currency names.
* `am` - amount shown by the rates widget, for example `100`.
* `size_width` - widget width, for example `100%`, `240px`, or `300px`.

Currency codes are listed at [https://currencyrate.today/different-currencies](https://currencyrate.today/different-currencies).

== Installation ==

= From your WordPress dashboard =

1. Go to Plugins > Add New.
2. Search for "Exchange Rates Widget".
3. Install and activate the plugin.
4. Add the shortcode to a page or post, or add the classic widget under Appearance > Widgets.

= From WordPress.org =

1. Download Exchange Rates Widget.
2. Upload the `exchange-rates-widget` folder to `/wp-content/plugins/`.
3. Activate the plugin from Plugins > Installed Plugins.
4. Add the shortcode to a page or post, or add the classic widget under Appearance > Widgets.

= Classic widget setup =

1. Install and activate the [Classic Widgets plugin](https://wordpress.org/plugins/classic-widgets/) if your site uses the block-based widget screen.
2. Go to Appearance > Widgets.
3. Add "Exchange Rates Widget" to a widget area.
4. Choose currencies, language, theme, amount, and display options, then save.

== Frequently Asked Questions ==

= How do I add exchange rates to a page or post? =

Use a shortcode or paste it into a Shortcode block:

`[erw_exchange_rates_widget lg="en" tz="0" fm="EUR" to="USD,GBP,AUD,CNY,JPY,RUB" st="info" cd="0" am="100" size_width="100%"][/erw_exchange_rates_widget]`

= Can I show exchange rates in a sidebar? =

Yes. Add "Exchange Rates Widget" under Appearance > Widgets.
If your WordPress site uses the block-based widget screen, install and activate Classic Widgets first.

= Do visitors leave my website to view rates? =

No. The widget is embedded directly on your page, post, sidebar, or footer.

= Does the plugin require an API key? =

No. Exchange-rate lookup and display are handled by the embedded CurrencyRate.Today service, so you do not need an API key or local rate database.

= Can I choose currencies, language, and theme? =

Yes. You can choose the base currency, target currencies, language, time zone, color theme, amount, and display mode.

= Which shortcode attributes are available? =

The main attributes are `lg`, `tz`, `fm`, `to`, `st`, `cd`, `am`, and `size_width`.
See the shortcode attributes section above for the full list.

= External service and privacy =

Yes. The plugin embeds an iframe from CurrencyRate.Today.
When a page containing the widget is viewed, the visitor's browser requests `https://currencyrate.today/load-exchangerates`.

The request includes display settings such as base currency, target currencies, language, theme, time zone, display mode, amount, and a WordPress plugin marker.
These values come from the shortcode or widget settings.

The plugin does not send WordPress usernames, passwords, admin settings, or private site data to the service.

Service provider: CurrencyRate.Today

* Service website: [https://currencyrate.today/](https://currencyrate.today/)
* Privacy policy: [https://currencyrate.today/page/privacy](https://currencyrate.today/page/privacy)
* Disclaimer: [https://currencyrate.today/page/disclaimer](https://currencyrate.today/page/disclaimer)

= Does the plugin include a Gutenberg block? =

No. The plugin currently supports shortcodes and classic widgets. In the block editor, use a Shortcode block.

== Screenshots ==

1. screenshot-1.jpg: Widget settings.
2. screenshot-2.jpg: Example frontend exchange rates widget.
3. screenshot-3.png: Dark blue theme.
4. screenshot-4.png: Gray theme.
5. screenshot-5.png: Green theme.
6. screenshot-6.png: Yellow theme.
7. screenshot-7.png: Red theme.
8. screenshot-8.png: Blue theme.

== Upgrade Notice ==

= 1.4.2 =
WordPress 7 compatibility metadata and runtime safety cleanup. Existing shortcodes and classic widget settings continue to work.

== Changelog ==

= 1.4.2 =
* Verified WordPress 7 compatibility with Classic Widgets.
* Improved PHP 8.x runtime safety for shortcode and classic widget handling.
* Cleaned up plugin metadata, readme wording, installation instructions, and external-service disclosure.
* Refreshed bundled currency lists with BNB, XCG, and ZWG labels.

= 1.4.1 =
* Security fixed.
* Minor bug fixed.

= 1.4.0 =
* Language fix.
* Minor bug fixed.

= 1.3.8 =
* Minor bug fixed.

= 1.3.7 =
* Minor bug fixed.

= 1.3.6 =
* Minor bug fixed.

= 1.3.5 =
* Minor bug fixed.
* Language fix, add: id, hi, ja, pt.

= 1.3.0 =
* Minor bug fixed.
* Added accessibility improvements.

= 1.2.2 =
* Important fix.
* Minor fix.

= 1.2.1 =
* Minor bug fixed.

= 1.1.2 =
* Minor bug fixed.

= 1.1.1 =
* Fixed generated shortcode parameters with empty values.

= 1.1.0 =
* Added support for shortcodes.

= 1.0.0 =
* First release.

== Donations ==

Official website and data source: [CurrencyRate.Today](https://currencyrate.today/)

You may also like these plugins:

* [Currency Converter Calculator](https://wordpress.org/plugins/currency-converter-calculator/)
* [Crypto Converter Widget](https://wordpress.org/plugins/crypto-converter-widget/)
* [Cryptocurrency Price Widget](https://wordpress.org/plugins/cryptocurrency-price-widget/)
* [Currency Converter Widget PRO](https://wordpress.org/plugins/currency-converter-widget-pro/)
* [CurrencyRate.Today - Currency Blocks and Widgets](https://wordpress.org/plugins/currencyrate-today-currency-blocks/)
* [Exchange Rates](https://wordpress.org/plugins/exchange-rates/)
* [FX Currency Converter](https://wordpress.org/plugins/fx-currency-converter/)