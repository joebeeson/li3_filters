<?php

	// Required libraries.
	use lithium\util\Inflector;

	/**
	 * Filter for automatically adding `slug` to the records. Uses
	 * the display name for a record to create the slug.
	 *
	 * @author Joe Beeson <jbeeson@gmail.com>
	 */
	return function($self, $params, $chain) {

		// Convenience function for checking for colliding slugs.
		$hasCollision = function($model, $slug) {
			return (bool) $model::count(
				array(
					'conditions' => compact('slug')
				)
			);
		};
		if (!empty($params['data'][$self::meta('title')])) {
			$slug = strtolower(Inflector::slug($params['data'][$self::meta('title')]));
			if ($hasCollision($self, $slug)) {
				$count = 1;
				while ($hasCollision($self, $slug . '-' . $count)) {
					$count++;
				}
				$slug = $slug . '-' . $count;
			}
			$params['data']['slug'] = $slug;
		}
		return $chain->next($self, $params, $chain);
	};