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


if (!defined(_MI_PLEASE_MODULE_DIRNAME))
	define('_MI_PLEASE_MODULE_DIRNAME', basename(dirname(__DIR__)));

/**
 * Include Required Control Files
 */
require_once __DIR__ . DIRECTORY_SEPARATOR . "functions.php";


/**
 * Include Required Language Files
 */
xoops_loadLanguage('errors', _MI_PLEASE_MODULE_DIRNAME);

/**
 * Instantiate Blowfish Encryption Salts
 */
if (!resourcesInstantiateBlowfish())
	die("Restricted Access ~ Encryption Salts missing or not loaded!");

/**
 * Sets Global Variables for Please
 */
global $resourcesModule, $resourcesConfig;

/**
 * Get Config Values for Please
 */
$module_handler = xoops_gethandler("module");
$config_handler = xoops_gethandler("config");
$resourcesModule = $module_handler->getByDirname(_MI_PLEASE_MODULE_DIRNAME);
if (is_a($resourcesModule, "XoopsModule"))
	$resourcesConfig = $config_handler->getConfigByList($resourcesModule->getVar('mid'));
else
	die("Xoops Module & Theme Download Harvester Module: resources ~ not found!");