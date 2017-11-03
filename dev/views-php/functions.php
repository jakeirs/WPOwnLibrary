<?php


/** Adding theme support */
require_once('library/themeSupport.php');

/** Enqueuing scripts and styles */
require_once('library/enqueue.php');

/** Adding social media section in admin panel */
require_once('library/mainPageSocialMedia.php');

/** Adding breadcrumbs */
require_once('library/breadcrumbs.php');

/** Adding Nav Menu Walker Class */
require_once('library/navMenuWalker.php');

/** Adding social Sharing buttons */
require_once('library/socialSharingButtons.php');

/** Adding our offer custom post type */
require_once('library/ourOfferPostType.php');

/** Adding team member custom post type */
require_once('library/teamMembersPostType.php');

/** Adding team member custom post type */
require_once('library/singlePageContentManagerPostType.php');

/** Adding archive title filter */
require_once('library/archiveTitleFilter.php');

/** Adding archive title filter */
require_once('library/pagination.php');


/** Hooks */
/** Load language translation for theme*/
add_action( 'plugins_loaded', 'ssh_load_textdomain' );

/** Adding advanced custom fields as hardcode plugin
 * 'ACF_LITE': set true to not display ACF options in admin menu
 */
define( 'ACF_LITE', false );
include_once('plugins/advanced-custom-fields/acf.php');

/** Adding customization for ACF for theme */
require_once('library/advancedCustomFieldsForTheme.php');

/** Adding print media gallery editor */
require_once('library/customMediaGalleryEditor.php');

/** Adding print media gallery html output */
require_once('library/customMediaGalleryOutput.php');
