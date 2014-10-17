<?php
// Various clean up functions
//require_once('library/cleanup.php');

// Required for Foundation to work properly
require_once('library/breadcrumbs.php');

// Required for Foundation to work properly
require_once('library/foundation.php');

// Register all navigation menus
require_once('library/navigation.php');

// Add menu walker
require_once('library/menu-walker.php');
require_once('library/walker-top-menu.php');

// Second-level menus
require_once('library/navigation-lvl2.php');

// Add standard widgets
require_once('library/widgets.php');

// Return entry meta information for posts
require_once('library/entry-meta.php');

// Enqueue scripts
require_once('library/enqueue-scripts.php');

// Add theme support
require_once('library/theme-support.php');

// Photo functions
require_once('library/photos.php');

// Setting fields for address, phone, social media
require_once('library/admin-setting-fields.php');

// Custom content types
require_once('library/content-types.php');

// Faculty functions
require_once('library/faculty.php');

// Custom taxonomies functions
require_once('library/taxonomies.php');