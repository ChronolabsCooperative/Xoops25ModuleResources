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

if (file_exists(XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . "harvest.json"))
	define("_RESOURCES_HARVEST_PENDING",true);

if (file_exists(XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . "upgrades.json"))
	define("_RESOURCES_UPGRADES_PENDING",true);

if (file_exists(XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . "backups.json"))
	define("_RESOURCES_BACKUPS_EXISTS",true);