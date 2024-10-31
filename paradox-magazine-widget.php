<?php
/*
Plugin Name: PARADOX Magazine Widget
Plugin URI: http://www.paradox-magazin.com
Description: PARADOX Magazine Widget displays the cover from PARADOX Magazine on your website
Version: 1.0.1
Author: PARADOX
Author URI: http://www.paradox-magazin.com
Author Email: info@paradox-magazin.com
Text Domain: paradox-magazine-widget
Domain Path: /lang/
Network: false
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2016 Bruno Bouyajdad (http://indikator-design.de, info@indikator-design.de)

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( !defined( 'ABSPATH' ) ) exit(__('Don\'t try to load this file directly!'));

/**
 * Define version number
 *
 * @since	1.0.0
 */
if (!defined('PARADOX_VERSION_NUMBER')) { define( 'PARADOX_VERSION_NUMBER', '1.0.0'); }

/**
 * Define widgets absolute dir
 *
 * @since	1.0.0
 */
if (!defined('PARADOX_WIDGET_DIR')) { define( 'PARADOX_WIDGET_DIR', dirname( plugin_basename( __FILE__ ) ) ); }

/**
 * Define widgets absolute dir
 *
 * @since	1.0.0
 */
if (!defined('PARADOX_WIDGET_DIR_ABSOLUT')) { define( 'PARADOX_WIDGET_DIR_ABSOLUT', plugin_dir_path(__FILE__) ); }

/**
 * Define widgets dir url
 *
 * @since	1.0.0
 */
if (!defined('PARADOX_WIDGET_DIR_URL')) { define( 'PARADOX_WIDGET_DIR_URL', plugin_dir_url( __FILE__ ) ); }

/**
 * Get Autoloader Class
 *
 * @since	1.0.0
 * @param	string	class	String with the searched classname
 */
require_once( PARADOX_WIDGET_DIR_ABSOLUT . 'php/classes/class-autoloader.php' );

/**
 * Instantiate Autoloader with absolute path to plugin, folderstructure and class-prefix
 *
 * @since	1.0.0
 */
new ParadoxMagazineWidgetAutoloader( PARADOX_WIDGET_DIR_ABSOLUT, 'php/classes/', 'class-' );

/**
 * Instantiate Categorize Widget
 *
 * @since	1.0.0
 */
new ParadoxMagazineWidget();
