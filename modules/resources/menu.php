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


defined('XOOPS_ROOT_PATH') || die('XOOPS root path not defined');

xoops_loadLanguage('menus', _MI_RESOURCES_MODULE_DIRNAME);


$index=1;
$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_DASHBOARD;
$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_DASHBOARD;
$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_DASHBOARD;
if (defined("_RESOURCES_HARVEST_PENDING"))
{
	$index++;
	$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_HARVEST;
	$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_HARVEST;
	$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_HARVEST;
}
if (defined("_RESOURCES_UPGRADES_PENDING"))
{
	$index++;
	$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_UPGRADES;
	$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_UPGRADES;
	$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_UPGRADES;
}
if (defined("_RESOURCES_BACKUPS_EXISTS"))
{
	$index++;
	$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_BACKUPS;
	$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_BACKUPS;
	$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_BACKUPS;
}
$index++;
$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_MODULES;
$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_MODULES;
$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_MODULES;
$index++;
$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_THEMES;
$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_THEMES;
$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_THEMES;
$index++;
$adminmenu[$index]['title'] = _MU_RESOUCES_ADMINMNU_TITLE_ABOUT;
$adminmenu[$index]['link']  = _MU_RESOUCES_ADMINMNU_LINKD_ABOUT;
$adminmenu[$index]['image'] = _MU_RESOUCES_ADMINMNU_IMAGE_ABOUT;
