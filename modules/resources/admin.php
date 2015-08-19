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

include 'header.php';

xoops_cp_header();

$error = false;
if ($admintest != 0) {
    if (isset($op) && $op != '') {
        $op = preg_replace("/[^a-z0-9_\-]/i", "", $op);
        if ( file_exists( XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar( 'dirname', 'n' ) . '/admin/' . $op . '/xoops_version.php' ) ) {
            xoops_loadLanguage( $op, $xoopsModule->getVar( 'dirname', 'n' ) );
            require XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar( 'dirname', 'n' ) . '/admin/' . $op . '/xoops_version.php';
            $category = !empty($modversion['category']) ? intval($modversion['category']) : 0;
            unset($modversion);
            if ($category > 0) {
                if ( file_exists( XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar( 'dirname', 'n' ) . '/admin/' . $op . '/main.php' ) ) {
                	include_once XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar( 'dirname', 'n' ) . '/admin/' . $op . '/main.php';
                } else {
                	$error = true;
            	}
            } else {
                $error = true;
            }
        } else {
            $error = true;
        }
    } else {
        $error = true;
    }
}

xoops_cp_footer();