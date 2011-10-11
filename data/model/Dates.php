<?php

	/**
	 * Filter for automatically adding `created` and `modified` dates
	 * for records.
	 *
	 * @author Joe Beeson <jbeeson@gmail.com>
	 */
	return function($self, $params, $chain) {
		$schema = $self::schema();
		$string = date('Y-m-d H:i:s');
		if (!$params['entity']->exists() and array_key_exists('created', $schema)) {
			if ($schema['created']['type'] === 'datetime' and empty($params['date']['created'])) {
				$params['data']['created'] = $string;
			}
		}
		if (array_key_exists('modified', $schema)) {
			$params['data']['modified'] = $string;
		}
		return $chain->next($self, $params, $chain);
	};