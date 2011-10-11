# li3_filters library for Lithium

A collection of reusable, generic filters for Lithium applications.

## Installation

* Download the plugin

        $ cd /path/to/your/libraries && git clone git://github.com/joebeeson/li3_filters.git

* Begin using the filters by applying them to classes

        Filters::apply('app\models\Users', 'save', include LITHIUM_LIBRARY_PATH . '/li3_filters/data/model/Dates.php');

## Notes

All filter files work by returning a function. This allows for you to `include` the file to apply a filter.

## Help!

Feel free to fork and help commit filters, fixes, etc. If you have an idea for a filter, open an issue.
