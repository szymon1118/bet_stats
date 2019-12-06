<?php

//maybe change to an interface if no method implementation
abstract class Bookmaker {

	abstract protected static function loadData();
	abstract public static function getMatches();

}

?>