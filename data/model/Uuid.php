<?php

	// Retrieve required libraries.
	use lithium\util\String;

	/**
	 * Filter for automatically creating UUIDs for models that employ
	 * them for primary keys.
	 *
	 * @author Joe Beeson <jbeeson@gmail.com>
	 */
	return function($self, $params, $chain) {
		if (!$params['entity']->exists()) {
			if (array_intersect_assoc(
				array('type' => 'string', 'length' => 36),
				$self::schema($self::meta('key'))
			)) {
				$params['data'][$self::meta('key')] = String::uuid();
			}
		}
		return $chain->next($self, $params, $chain);
	};