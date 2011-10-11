<?php

	/**
	 * Filter for automatically adding `created` and `modified` dates
	 * to MongoDB collections. Generally you would apply this to your 
	 * model's save() method
	 *
	 * Example: {{{
	 * 	Filters::apply('app\models\Posts', 'save', include LITHIUM_LIBRARY_PATH . '/li3_filters/data/model/MongoDates.php');
	 * }}}
	 *
	 * @author James Fuller <jblotus@gmail.com>
	 */
	return function($self, $params, $chain) {

		$entity = $params['entity'];

		$date   = new \MongoDate();

		if (!$entity->exists()) {
			$entity->created = $date;
		}

		$entity->modified = $date;

		$params['entity'] = $entity;

		return $chain->next($self, $params, $chain);
	};
?>