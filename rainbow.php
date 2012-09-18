<?php
/**
 * Rainbow skin
 *
 * @file
 * @ingroup Skins
 * @author Robert Vogel (http://www.hallowelt.biz)
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if( !defined( 'MEDIAWIKI' ) ) die( "This is an extension to MediaWiki and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array(
	'path'           => __FILE__,
	'name'           => 'Rainbow',
	'url'            => 'http://www.hallowelt.biz',
	'author'         => 'Robert Vogel',
	'descriptionmsg' => 'rainbow-desc',
);

$wgValidSkinNames['rainbow'] = 'Rainbow';
$wgAutoloadClasses['SkinRainbow']    = dirname(__FILE__).'/Rainbow.skin.php';
$wgExtensionMessagesFiles['Rainbow'] = dirname(__FILE__).'/Rainbow.i18n.php';

//http://www.mediawiki.org/wiki/ResourceLoader/Developing_with_ResourceLoader
$wgResourceModules['skins.rainbow'] = array(
	'styles' => array(
		'rainbow/css/screen.css'    => array( 'media' => 'screen' ),
		'rainbow/bootstrap/css/bootstrap.css' => array( 'media' => 'screen' ),
	),
	'scripts' => array( 
		'rainbow/js/main.js',
		'rainbow/bootstrap/js/bootstrap.js'
	),
	'messages' => array( 
		'rainbow-wikitextmsg',
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'], //Important: assign only reference as the value may change after registration
	'localBasePath'  => &$GLOBALS['wgStyleDirectory'],
);