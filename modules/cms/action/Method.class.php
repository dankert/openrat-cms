<?php


namespace cms\action;

/**
 * Method.
 *
 * A Method is divided into
 * - a view and
 * - a post action.
 *
 * Every Method must implement this interface.
 *
 * @package cms\action
 */
interface Method
{
	/**
	 * View.
	 *
	 * View action for displaying data.
	 * Normally this is called after a HTTP GET.
	 * This method needs to be idempotent, this usually means that no data is written to the model.
	 * This method should be readonly, but may write data to the session.
	 *
	 * @return void
	 */
	public function view();

	/**
	 * Post action.
	 *
	 * Post action for writing data to the model (and the database).
	 *
	 * Normally this is called after a HTTP POST.
	 *
 	 * @return void
	 */
	public function post();
}