<?php

	/**
	 * Authentication check and automatic redirect. Checks if the requested action
	 * is allowed for the user's current state. Failing the appropriate authentication
	 * we will send them to the login page.
	 *
	 * You should create a method in your controller(s) called `_isAllowedAction` which
	 * should return boolean to indicate if the user is cleared to access the page.
	 *
	 * Make sure that your login location (Users::login here) is allowed through by
	 * the `_isAllowedAction` method or else you'll end up with redirect loops.
	 *
	 * @author Joe Beeson <jbeeson@gmail.com>
	 */
	return function($self, $params, $chain) {
		$controller = $chain->next($self, $params, $chain);
		if (lithium\security\Auth::check('user') or $controller->invokeMethod('_isAllowedAction')) {

			// Action is cleared for the user, cheers.
			return $controller;
		} else {

			/**
			 * Here we write out the current request URL so that we can automatically
			 * redirect them after they've successfully been authenticated.
			 */
			lithium\storage\Session::write(
				'AuthRedirect',
				$controller->request->url
			);

			// Return a different `Response` object with our login location.
			return function() {
				return new lithium\action\Response(array('location' => 'Users::login'));
			};
		}
	};