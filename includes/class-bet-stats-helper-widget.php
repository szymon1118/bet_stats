<?php

class Bet_Stats_Helper_Widget extends Bet_Stats_Widget {

	public function __construct( $template_loader ) {

        $this->template_loader = $template_loader;
        parent::__construct( $this->template_loader );

    }

}
