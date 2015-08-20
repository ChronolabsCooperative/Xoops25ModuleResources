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


if (!defined('XOOPS_ROOT_PATH')) {
	die('XOOPS root path not defined');
}

if (!defined("_MI_RESOURCES_MODULE_DIRNAME"))
	define('_MI_RESOURCES_MODULE_DIRNAME', basename(__DIR__));
	
if (!defined("_RESOURCES_SUPPORTING") && defined("XOOPS_VERSION"))
{
	$parts = explode(" ", XOOPS_VERSION);
	$versi = explode(".", $parts[1]);
	define("_RESOURCES_SUPPORTING",$versi[0].$versi[1]);
}

global $resourcesModule, $resourcesConfigsList, $resourcesConfigs, $resourcesConfigsOptions;

if (empty($resourcesModule))
{
	if (is_a($resourcesModule = xoops_gethandler('module')->getByDirname(_MI_RESOURCES_MODULE_DIRNAME), "XoopsModule"))
	{
		if (empty($resourcesConfigsList))
		{
			$resourcesConfigsList = xoops_gethandler('config')->getConfigsList($resourcesModule->getVar('mid'));
		}
		if (empty($resourcesConfigs))
		{
			$resourcesConfigs = xoops_gethandler('config')->getConfigs(new Criteria('conf_modid', $resourcesModule->getVar('mid')));
		}
		if (empty($resourcesConfigsOptions) && !empty($resourcesConfigs))
		{
			foreach($resourcesConfigs as $key => $config)
				$resourcesConfigsOptions[$config->getVar('conf_name')] = $config->getConfigOptions(new Criteria('conf_id', $config->getVar('conf_id')));
		}
	}
}

$modversion['dirname'] 					= _MI_RESOURCES_MODULE_DIRNAME;
$modversion['name'] 					= _MI_RESOURCES_MODULE_NAME;
$modversion['version']     				= _MI_RESOURCES_MODULE_VERSION;
$modversion['releasedate'] 				= _MI_RESOURCES_MODULE_RELEASEDATE;
$modversion['status']      				= _MI_RESOURCES_MODULE_STATUS;
$modversion['description'] 				= _MI_RESOURCES_MODULE_DESCRIPTION;
$modversion['credits']     				= _MI_RESOURCES_MODULE_CREDITS;
$modversion['author']      				= _MI_RESOURCES_MODULE_AUTHORALIAS;
$modversion['help']        				= _MI_RESOURCES_MODULE_HELP;
$modversion['license']     				= _MI_RESOURCES_MODULE_LICENCE;
$modversion['official']    				= _MI_RESOURCES_MODULE_OFFICAL;
$modversion['image']       				= _MI_RESOURCES_MODULE_ICON;
$modversion['module_status'] 			= _MI_RESOURCES_MODULE_STATUS;
$modversion['website'] 					= _MI_RESOURCES_MODULE_WEBSITE;
$modversion['dirmoduleadmin'] 			= _MI_RESOURCES_MODULE_ADMINMODDIR;
$modversion['icons16'] 					= _MI_RESOURCES_MODULE_ADMINICON16;
$modversion['icons32'] 					= _MI_RESOURCES_MODULE_ADMINICON32;
$modversion['release_info'] 			= _MI_RESOURCES_MODULE_RELEASEINFO;
$modversion['release_file'] 			= _MI_RESOURCES_MODULE_RELEASEFILE;
$modversion['release_date'] 			= _MI_RESOURCES_MODULE_RELEASEDATE;
$modversion['author_realname'] 			= _MI_RESOURCES_MODULE_AUTHORREALNAME;
$modversion['author_website_url'] 		= _MI_RESOURCES_MODULE_AUTHORWEBSITE;
$modversion['author_website_name'] 		= _MI_RESOURCES_MODULE_AUTHORSITENAME;
$modversion['author_email'] 			= _MI_RESOURCES_MODULE_AUTHOREMAIL;
$modversion['author_word'] 				= _MI_RESOURCES_MODULE_AUTHORWORD;
$modversion['status_version'] 			= _MI_RESOURCES_MODULE_VERSION;
$modversion['warning'] 					= _MI_RESOURCES_MODULE_WARNINGS;
$modversion['demo_site_url'] 			= _MI_RESOURCES_MODULE_DEMO_SITEURL;
$modversion['demo_site_name'] 			= _MI_RESOURCES_MODULE_DEMO_SITENAME;
$modversion['support_site_url'] 		= _MI_RESOURCES_MODULE_SUPPORT_SITEURL;
$modversion['support_site_name'] 		= _MI_RESOURCES_MODULE_SUPPORT_SITENAME;
$modversion['submit_feature'] 			= _MI_RESOURCES_MODULE_SUPPORT_FEATUREREQUEST;
$modversion['submit_bug'] 				= _MI_RESOURCES_MODULE_SUPPORT_BUGREPORTING;
$modversion['people']['developers'] 	= explode("|", _MI_RESOURCES_MODULE_DEVELOPERS);
$modversion['people']['testers']		= explode("|", _MI_RESOURCES_MODULE_TESTERS);
$modversion['people']['translaters']	= explode("|", _MI_RESOURCES_MODULE_TRANSLATERS);
$modversion['people']['documenters']	= explode("|", _MI_RESOURCES_MODULE_DOCUMENTERS);

// About Screen
$modversion['paypal-catno']				= _MI_RESOURCES_MODULE_PAYPAL_CATELOGUENUM;

// Requirements
$modversion['min_php']        			= '5.3.7';
$modversion['min_xoops']      			= '2.5.7';
$modversion['min_db']         			= array('mysql' => '5.0.7', 'mysqli' => '5.0.7');
$modversion['min_admin']      			= '1.1';

// Database SQL File and Tables
$modversion['sqlfile']['mysql'] 		= "sql/mysqli.sql";
$modversion['tables']	 				= explode("\n", str_replace(array("\R\n", "\n\R", "\n\n\n", "\n\n"), "\n",file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . 'sql' . DIRECTORY_SEPARATOR . 'tables.diz')));

//Search
$modversion['hasSearch'] 				= _MI_RESOURCES_MODULE_HASSEARCH;
//$modversion['search']['file'] 		= "include/search.inc.php";
//$modversion['search']['func'] 		= "publisher_search";

// Main
$modversion['hasMain'] 					= _MI_RESOURCES_MODULE_HASMAIN;
	
// Admin
$modversion['hasAdmin'] 				= _MI_RESOURCES_MODULE_HASADMIN;
$modversion['adminindex']  				= _MI_RESOURCES_MODULE_ADMININDEX; 		//"admin.php";
$modversion['adminmenu']   				= _MI_RESOURCES_MODULE_ADMINMENU; 		//"menu.php";
$modversion['system_menu'] 				= _MI_RESOURCES_MODULE_SYSTEMMENU;

// Config categories
$modversion['configcat']['email']['name']        = _MI_RESOURCES_CONFCAT_EMAIL;
$modversion['configcat']['email']['description'] = _MI_RESOURCES_CONFCAT_EMAIL_DESC;
$modversion['configcat']['methods']['name']        = _MI_RESOURCES_CONFCAT_METHODS;
$modversion['configcat']['methods']['description'] = _MI_RESOURCES_CONFCAT_METHODS_DESC;

// Config categories
$i=0;
++$i;
$modversion['config'][$i]['name']        = 'frequency';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_FREQUENCY';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_FREQUENCY_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 3600 *24 * 7;
$modversion['config'][$i]['options']     = array(_MI_RESOURCES_EMAIL_FREQUENCY_7DAYS => 3600 * 24 * 7, _MI_RESOURCES_EMAIL_FREQUENCY_14DAYS => 3600 * 24 * 14, _MI_RESOURCES_EMAIL_FREQUENCY_1MONTH => 3600 * 24 * 7 * 4);
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'reports';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_REPORTS';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_REPORTS_DESC';
$modversion['config'][$i]['formtype']    = 'select_multi';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = array('new'=>'new','action'=>'action');
$modversion['config'][$i]['options']     = array(_MI_RESOURCES_EMAIL_REPORTS_NEW => 'new', _MI_RESOURCES_EMAIL_REPORTS_ACTION => 'action');
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'modules';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_MODULES';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_MODULES_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = true;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'themes';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_THEMES';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_THEMES_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = true;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'upgrades';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_UPGRADES';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_UPGRADES_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = true;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'harvest';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_EMAIL_HARVEST';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_EMAIL_HARVEST_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = true;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'email';
++$i;
$modversion['config'][$i]['name']        = 'harvester';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_HARVESTER';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_HARVESTER_DESC';
$modversion['config'][$i]['formtype']    = 'yesno';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = true;
$modversion['config'][$i]['options']     = array();
$modversion['config'][$i]['category']    = 'methods';
++$i;
$modversion['config'][$i]['name']        = 'scheduling';
$modversion['config'][$i]['title']       = '_MI_RESOURCES_SCHEDULING';
$modversion['config'][$i]['description'] = '_MI_RESOURCES_SCHEDULING_DESC';
$modversion['config'][$i]['formtype']    = 'select';
$modversion['config'][$i]['valuetype']   = 'text';
$modversion['config'][$i]['default']     = 'preloader';
$modversion['config'][$i]['options']     = array(_MI_RESOURCES_SCHEDULING_PRELOADER => 'preloader', _MI_RESOURCES_SCHEDULING_CRONJOB => 'cronjob');
$modversion['config'][$i]['category']    = 'methods';