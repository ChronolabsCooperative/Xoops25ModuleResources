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


if (!defined("_MI_RESOURCES_MODULE_DIRNAME"))
	define("_MI_RESOURCES_MODULE_DIRNAME", basename(dirname(dirname(__DIR__))));

define("_MI_RESOURCES_MODULE_NAME","Modules & Themes");
define("_MI_RESOURCES_MODULE_VERSION","1.01");
define("_MI_RESOURCES_MODULE_RELEASEDATE","20-08-2015");
define("_MI_RESOURCES_MODULE_STATUS","Final");
define("_MI_RESOURCES_MODULE_DESCRIPTION","Modules & Themes Resource Locator and Downloader + Upgrader");
define("_MI_RESOURCES_MODULE_CREDITS","Simon Antony Roberts <wishcraft@users.sourceforge.net>");
define("_MI_RESOURCES_MODULE_AUTHORALIAS","Wishcraft");
define("_MI_RESOURCES_MODULE_HELP","help.php");
define("_MI_RESOURCES_MODULE_LICENCE","GPL3");
define("_MI_RESOURCES_MODULE_OFFICAL","1");
define("_MI_RESOURCES_MODULE_ICON","images/resources-icon.png");
define("_MI_RESOURCES_MODULE_STATUS","Final");
define("_MI_RESOURCES_MODULE_WEBSITE","http://au.syd.labs.coop");
define("_MI_RESOURCES_MODULE_ADMINMODDIR","/Frameworks/moduleclasses/moduleadmin");
define("_MI_RESOURCES_MODULE_ADMINICON16","images/icons/16");
define("_MI_RESOURCES_MODULE_ADMINICON32","images/icons/32");
define("_MI_RESOURCES_MODULE_RELEASEINFO","Written for the XOOPS Community");
define("_MI_RESOURCES_MODULE_RELEASEFILE","changeinfo.txt");
define("_MI_RESOURCES_MODULE_AUTHORREALNAME","Simon Antony Roberts");
define("_MI_RESOURCES_MODULE_AUTHORWEBSITE","http://cipher.labs.coop");
define("_MI_RESOURCES_MODULE_AUTHORSITENAME","Chronolabs Cooperative");
define("_MI_RESOURCES_MODULE_AUTHOREMAIL","wishcraft@users.sourceforge.net");
define("_MI_RESOURCES_MODULE_AUTHORWORD","");
define("_MI_RESOURCES_MODULE_WARNINGS","");
define("_MI_RESOURCES_MODULE_DEMO_SITEURL","");
define("_MI_RESOURCES_MODULE_DEMO_SITENAME","");
define("_MI_RESOURCES_MODULE_SUPPORT_SITEURL","https://github.com/ChronolabsCooperative/Xoops26ModuleResources");
define("_MI_RESOURCES_MODULE_SUPPORT_SITENAME","Github.com");
define("_MI_RESOURCES_MODULE_SUPPORT_FEATUREREQUEST","mailto:"._MI_RESOURCES_MODULE_AUTHOREMAIL."?subject="._MI_RESOURCES_MODULE_NAME." feature requests!");
define("_MI_RESOURCES_MODULE_SUPPORT_BUGREPORTING","https://github.com/ChronolabsCooperative/Xoops"._RESOURCES_SUPPORTING."ModuleResources/issues");
define("_MI_RESOURCES_MODULE_DEVELOPERS","Wishcraft");
define("_MI_RESOURCES_MODULE_TESTERS","");
define("_MI_RESOURCES_MODULE_TRANSLATERS","");
define("_MI_RESOURCES_MODULE_DOCUMENTERS","");
define("_MI_RESOURCES_MODULE_PAYPAL_CATELOGUENUM", "XXXXXXA0");
define("_MI_RESOURCES_MODULE_HASSEARCH",false);
define("_MI_RESOURCES_MODULE_HASMAIN",false);
define("_MI_RESOURCES_MODULE_HASADMIN",true);
define("_MI_RESOURCES_MODULE_SYSTEMMENU",true);
define("_MI_RESOURCES_MODULE_ADMININDEX","admin.php");
define("_MI_RESOURCES_MODULE_ADMINMENU","menu.php");


//Resources URIs Constants
define("_MI_RESOURCES_MODULES", "https://raw.githubusercontent.com/ChronolabsCooperative/ResourcesXoops%sModules/master/xoops-modules-resources.json");
define("_MI_RESOURCES_THEMES", "https://raw.githubusercontent.com/ChronolabsCooperative/ResourcesXoops%sThemes/master/xoops-themes-resources.json");
define("_MI_RESOURCES_PEERS", "https://raw.githubusercontent.com/ChronolabsCooperative/Xoops%sModuleResources/master/modules/resources/api-peers.json");