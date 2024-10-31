<?php

/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( !defined( 'ABSPATH' ) ) exit( __('Don\'t try to load this file directly!') );

/**
 * PARADOX Magazine Widget class
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'ParadoxMagazineWidget' ) )
{
	class ParadoxMagazineWidget extends WP_Widget
	{

		/**
		 * Identifier
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $plugSlug = '';

		/**
		 * Version
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $plugVersion = '';

		/**
		 * Widget Name
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $plugName = '';

		/**
		 * Widget Description
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $plugDesc = '';

		/**
		 * Check, if widget or shortcode
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $widget = '';

		/**
		 * Constructor Function
		 *
		 * @since	1.0.0
		 */
		public function __construct()
		{

			/**
			 * Initialize Categorize Widget
			 * @since 1.0.0
			 */
			add_action( 'widgets_init', function()
			{
				register_widget('ParadoxMagazineWidget');
			});

			/**
			 * Load textdomain
			 * @since 1.0.0
			 */
			add_action( 'init', array( $this, 'load_textdomain' ) );

			/**
			 * Enqueue Frontend Style and Script
			 * @since 1.0.0
			 */
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_frontend' ) );

			/**
			 * Add Shortcode
			 * @since 1.0.0
			 */
			add_shortcode( 'paradox-magazine', array( $this, 'shortcode' ) );

			/**
			 * Add defaults to the pre-defined vars
			 * @since 1.0.0
			 */
			$this->plugVersion 	= PARADOX_VERSION_NUMBER;
			$this->plugSlug 	= 'paradox-magazine-widget';
			$this->plugName 	= __( 'PARADOX Magazine Widget', $this->plugSlug );
			$this->plugDesc 	= __('A Widget to display the cover of PARADOX Music Magazine on your website', $this->plugSlug);
			$this->widget 		= false;

			$params = array(
				'classname' 	=> $this->plugSlug,
				'description' 	=> $this->plugDesc
			);

			parent::__construct( $this->plugSlug, $this->plugName, $params );

		} // end constructor

		/**
		 * Generate the widget form inside the admin-area
		 *
		 * @since	1.0.0
		 */
		public function form( $instance )
		{

			/**
			 * Get Settings from DB or set defaults
			 *
			 * @since	1.0.0
			 */
			$title = isset( $instance['title'] ) ? sanitize_text_field( $instance['title'] ) : __( 'PARADOX Music Magazine', $this->plugSlug );

			/**
			 * Set title for the admin form
			 *
			 * @since	1.0.0
			 */
			$widTitle	= __( 'Widget title', $this->plugSlug );

			/**
			 * Include the form for widget area
			 *
			 * @since	1.0.0
			 */
			include( PARADOX_WIDGET_DIR_ABSOLUT . 'php/views/widget-form-admin.php' );

		} // end form

		/**
		 * Output the content of the widget at front-end
		 *
		 * @since	1.0.0
		 */
		public function widget( $args, $instance )
		{

			/**
			 * Set widget to true
			 *
			 * @since	1.0.0
			 */
			$this->widget = true;

			/**
			 * Render the widget
			 *
			 * @since	1.0.0
			 */
			$this->render( $args, $instance, $this->widget );

		} // end widget

		/**
		 * Update the widget settings
		 *
		 * @since	1.0.0
		 */
		public function update( $new_instance, $old_instance )
		{

			$instance = $old_instance;

			$instance['title'] = sanitize_text_field( $new_instance['title'] );

			return $instance;

		} // end update

		/**
		 * Enqueue Frontend Styles and register Scripts
		 *
		 * @since	1.0.0
		 */
		public function enqueue_frontend()
		{

			if( is_active_widget( false, $this->id, $this->id_base, true ) )
			{

				wp_enqueue_style( 'paradox-magazine-frontend-style', PARADOX_WIDGET_DIR_URL . 'css/paradox-magazine-frontend-min.css', false, $this->plugVersion );

			}

		}

		/**
		 * Render Frontend Form
		 *
		 * @since	1.0.0
		 */
		public function render( $args = '', $instance = '', $widget = false )
		{

			/**
			 * Get Settings from DB and create the header
			 *
			 * @since	1.0.0
			 */
			if ( $widget )
			{
				$title = sanitize_text_field( $instance['title'] ); // title from widget area
				echo $args['before_widget'];
				echo $args['before_title'] . $title . $args['after_title'];
			}
			 else
			{
				ob_start();

			  	$title = sanitize_text_field( $args['title'] ); // title from shortcode
			  	echo '<div class="paradox-mw-element">';
				echo '<h3 class="paradox-mw-title">' . $title . '</h3>';
			}

			$imgVersion = str_replace( '.', '-', $this->plugVersion );

			/**
			 * Include the widget
			 *
			 * @since	1.0.0
			 */
			include( PARADOX_WIDGET_DIR_ABSOLUT . 'php/views/widget-form-frontend.php' );

			/**
			 * Create the footer
			 *
			 * @since	1.0.0
			 */
			if ( $widget )
			{
				echo $args['after_widget'];
			}
			 else
			{
			  	echo '</div>';

				return ob_get_clean();
			}

		}

		/**
		 * Render Shortcode
		 *
		 * @since	1.0.0
		 */
		public function shortcode( $atts )
		{

			/**
			 * Get the title attribute
			 *
			 * @since	1.0.0
			 */
			$args = shortcode_atts( array(
		        'title' => __( 'PARADOX Music Magazine', $this->plugSlug )
		    ), $atts );

			/**
			 * Render the shortcode
			 *
			 * @since	1.0.0
			 */
			return $this->render( $args );

		}

		/**
		 * Load text domain for localization and translation
		 *
		 * @since	1.0.0
		 */
		public function load_textdomain()
		{

			$locale = apply_filters( 'paradox_magazine_locale', get_locale(), $this->plugSlug );
			load_textdomain( $this->plugSlug, WP_LANG_DIR . '/' . 'plugins' . '/' . $this->plugSlug . '-' . $locale . '.mo' );
			load_plugin_textdomain( $this->plugSlug, false, PARADOX_WIDGET_DIR . '/lang/' );

		} // end load_textdomain

	} // end class CategorizeWidget
}
