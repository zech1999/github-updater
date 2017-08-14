<?php
/**
 * GitHub Updater
 *
 * @package   GitHub_Updater
 * @author    Andy Fragen
 * @license   GPL-2.0+
 * @link      https://github.com/afragen/github-updater
 */

namespace Fragen\GitHub_Updater;


/**
 * Class Class_Factory
 *
 * Creates a static proxy for passed class names.
 *
 * @package Fragen\GitHub_Updater
 */
final class Class_Factory {

	/**
	 * @param  string              $class
	 * @param null|array|\stdClass $options
	 *
	 * @return array
	 */
	public static function get_instance( $class, $options = null ) {
		static $instance = null;

		$class = __NAMESPACE__ . '\\' . $class;

		$class_name = isset( $instance[ $class ] ) ? get_class( $instance[ $class ] ) : null;

		if ( null === $instance || $class !== $class_name ) {
			$instance[ $class ] = new $class( $options );
		}

		// Stores calling class for use.
		if ( is_array( $options ) ) {
			$backtrace                  = debug_backtrace();
			$instance[ $class ]->object = $backtrace[1]['object'];
		}

		return $instance[ $class ];
	}

}