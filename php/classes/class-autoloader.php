<?php

/**
 * Do not allow direct access
 *
 * @since	1.0.0
 */
if ( !defined( 'ABSPATH' ) ) exit( __('Don\'t try to load this file directly!') );

/**
 * Autoloader class
 *
 * @since	1.0.0
 */
if ( ! class_exists( 'ParadoxMagazineWidgetAutoloader' ) )
{
	class ParadoxMagazineWidgetAutoloader
	{

		/**
		 * Define var for the root path
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $path = '';

		/**
		 * Define var for the folder path
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $folder = '';

		/**
		 * Define var for the class prefix
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $prefix = '';

		/**
		 * Define var for the file suffix
		 *
		 * @since	1.0.0
		 * @var		string
		 */
		private $suffix = '';

		/**
		 * Constructor Function
		 *
		 * @since	1.0.0
		 */
		public function __construct( $path, $folder, $prefix )
		{

			/**
			 * Set the plugin root path
			 *
			 * @since	1.0.0
			 * @var		string
			 */
			$this->path = $path;

			/**
			 * Set the plugin root path
			 *
			 * @since	1.0.0
			 * @var		string
			 */
			$this->folder = $folder;

			/**
			 * Set the plugin root path
			 *
			 * @since	1.0.0
			 * @var		string
			 */
			$this->prefix = $prefix;

			/**
			 * Set the plugin root path
			 *
			 * @since	1.0.0
			 * @var		string
			 */
			$this->suffix = '.php';

			/**
			 * Try and catch autoloader
			 *
			 * @since	1.0.0
			 */
			try
			{
				spl_autoload_register( array( $this, 'autoloader' ), true );
			}
			 catch ( Exception $e )
			{
				function __autoload( $class)
				{
					$this->autoloader( $class );
				}
			} // end try and catch

		}

		/**
		 * Autoloader function
		 *
		 * @since	1.0.0
		 * @param	string	class	String with the searched classname
		 */
		private function autoloader( $class )
		{

			if ( class_exists( $class ) ) return true;

			$file = $this->path . $this->folder . $this->prefix . strtolower( $class ) . $this->suffix;

			$bool = is_file( $file ) ? true : false;

			if ( ! $bool ) return false;

			require_once( $file);

			return true;

		} // end autoloader class
	}
}
