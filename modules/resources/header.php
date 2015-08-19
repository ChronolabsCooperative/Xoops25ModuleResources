<?php
/**
 * Module & Theme Resource Download Harvester and Loader
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright   	The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license     	GNU GPL 3 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @author      	Simon Antony Roberts (wishcraft) <wishcraft@users.sourceforge.net>
 * @category  		resources
 * @description 	Module & Theme Resource Download Harvester and Loader
 * @version			1.0.1
 * @see				1.0.1
 * @link        	https://github.com/ChronolabsCooperative/Xoops25ModuleResources
 * @link        	https://github.com/ChronolabsCooperative/Xoops26ModuleResources
 * @see				http://internetfounder.wordpress.com
 */

// Include XOOPS control panel header
include_once dirname( dirname( dirname( __FILE__ ) ) ) . '/include/cp_header.php';

// Check user rights
if (is_object($xoopsUser)) {
    $admintest = 0;
    $xoopsModule =& XoopsModule::getByDirname( basename(__DIR__) );
    if ( !$xoopsUser->isAdmin( $xoopsModule->mid() ) ) {
        redirect_header( XOOPS_URL, 3, _NOPERM );
        exit();
    }
    $admintest = 1;
} else {
    redirect_header( XOOPS_URL, 3, _NOPERM );
    exit();
}
// XOOPS Class
include_once $GLOBALS['xoops']->path( '/class/pagenav.php' );
include_once $GLOBALS['xoops']->path( '/class/template.php' );
include_once $GLOBALS['xoops']->path( '/class/xoopsformloader.php' );
include_once $GLOBALS['xoops']->path( '/class/xoopslists.php' );
include_once $GLOBALS['xoops']->path( '/class/xoopsrequest.php' );

if ( !isset($GLOBALS['xoopsTpl']) || !is_object($GLOBALS['xoopsTpl'])  ) {
	$GLOBALS['xoopsTpl'] = new XoopsTpl();
}

// System Presets
xoops_loadLanguage('admin', basename(__DIR__));
include_once $GLOBALS['xoops']->path( '/modules/'.basename(__DIR__).'/common.php' );
include_once $GLOBALS['xoops']->path( '/modules/'.basename(__DIR__).'/constants.php' );

// Get request variable
$op = XoopsRequest::getVar ( 'op', 'dashboard', 'GET' );
$fct = XoopsRequest::getVar ( 'fct', 'confirm', 'GET' );
$key = XoopsRequest::getVar ( 'key', md5(NULL), 'GET' );
$myts =& MyTextSanitizer::getInstance();