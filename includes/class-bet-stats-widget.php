<?php

class Bet_Stats_Widget extends WP_Widget {

	/**
	 * The loader that's responsible for loading template files in plugin.
	 *
	 * @since 1.4
	 *
	 * @var array
	 */
	private $template_loader;

	/**
	 * Sets up the widgets name etc
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/__construct/
	 * @see https://developer.wordpress.org/reference/functions/wp_register_sidebar_widget/
	 *
	 */
	public function __construct( $template_loader ) {

		$this->template_loader = $template_loader;

		$widget_ops = array( 
			'classname' => 'bet_stats',
			'description' => 'A plugin for betting statistics',
		);
		parent::__construct( 'bet_stats', 'Betting Statistics', $widget_ops );

	}
	/**
	 * Outputs the content of the widget on front-end
	 *
	 * @param array $args Widget arguments 
	 * @param array $instance 
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/widget/
	 */
	public function widget( $args, $instance ) {

		$this->template_loader['self']
				->set_template_data( $this->template_loader['data'], 'bMakers' )
				->get_template_part( 'bet-stats-public-display' );

	}
	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/form/
	 */
	public function form( $instance ) {}
	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @link https://developer.wordpress.org/reference/classes/wp_widget/update/
	 */
	public function update( $new_instance, $old_instance ) {}
	
}

?>