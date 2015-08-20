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


// Module Definitions
define("_MI_RESOURCES_MODULE_NAME","Resources Loader");
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
define("_MI_RESOURCES_MODULE_PAYPAL_CATELOGUENUM","XXXXXXA0");
define("_MI_RESOURCES_MODULE_HASSEARCH",false);
define("_MI_RESOURCES_MODULE_HASMAIN",false);
define("_MI_RESOURCES_MODULE_HASADMIN",true);
define("_MI_RESOURCES_MODULE_SYSTEMMENU",true);
define("_MI_RESOURCES_MODULE_ADMININDEX","admin.php");
define("_MI_RESOURCES_MODULE_ADMINMENU","menu.php");

// Preference Constants
define("_MI_RESOURCES_CONFCAT_EMAIL","Email & Report Options");
define("_MI_RESOURCES_CONFCAT_EMAIL_DESC","This is the preferences for emails to the webmaster group!"); 
define("_MI_RESOURCES_CONFCAT_METHODS","Module methods");
define("_MI_RESOURCES_CONFCAT_METHODS_DESC","The methods and control for the module");
define("_MI_RESOURCES_EMAIL_FREQUENCY","Email Frequency");
define("_MI_RESOURCES_EMAIL_FREQUENCY_DESC","How often you will recieve in the webmaster group emails from this module!");
define("_MI_RESOURCES_EMAIL_FREQUENCY_7DAYS","Every 7 Days");
define("_MI_RESOURCES_EMAIL_FREQUENCY_14DAYS","Every 14 Days");
define("_MI_RESOURCES_EMAIL_FREQUENCY_1MONTH","Once a Month");
define("_MI_RESOURCES_EMAIL_REPORTS","Reports Supported");
define("_MI_RESOURCES_EMAIL_REPORTS_DESC","This is the reports you will recieve");
define("_MI_RESOURCES_EMAIL_REPORTS_NEW","New Items Available");
define("_MI_RESOURCES_EMAIL_REPORTS_ACTION","Update & Action Items");
define("_MI_RESOURCES_EMAIL_MODULES","Recieve Email About Modules");
define("_MI_RESOURCES_EMAIL_MODULES_DESC","");
define("_MI_RESOURCES_EMAIL_THEMES","Recieve Email About Themes");
define("_MI_RESOURCES_EMAIL_THEMES_DESC","");
define("_MI_RESOURCES_EMAIL_UPGRADES","Recieve Emails About Updates");
define("_MI_RESOURCES_EMAIL_UPGRADES_DESC","");
define("_MI_RESOURCES_EMAIL_HARVEST","Recieve Emails about Harvesting");
define("_MI_RESOURCES_EMAIL_HARVEST_DESC","");
define("_MI_RESOURCES_HARVESTER","Support Theme & Module Harvesting");
define("_MI_RESOURCES_HARVESTER_DESC","When this is enabled if our cloud recognises you have by tollerence files that are required such as language files you will have the option to send this to us; as a background task!");
define("_MI_RESOURCES_SCHEDULING","Schedule Event Handler");
define("_MI_RESOURCES_SCHEDULING_DESC","This is how the repeative tasks are managed they can either background in the runtime or use a cron job scheduler!");
define("_MI_RESOURCES_SCHEDULING_PRELOADER","XOOPS Events Handler");
define("_MI_RESOURCES_SCHEDULING_CRONJOB","CronJob or Scheduled Tasks");

//Resources URIs Constants
define("_MI_RESOURCES_MODULES","https://raw.githubusercontent.com/ChronolabsCooperative/ResourcesXoops%sModules/master/xoops-modules-resources.json");
define("_MI_RESOURCES_THEMES","https://raw.githubusercontent.com/ChronolabsCooperative/ResourcesXoops%sThemes/master/xoops-themes-resources.json");
define("_MI_RESOURCES_PEERS","https://raw.githubusercontent.com/ChronolabsCooperative/Xoops%sModuleResources/master/modules/resources/api-peers.json");