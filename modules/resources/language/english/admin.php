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

define("_AM_RESOURCES_HARVEST_FORCE","Force Havest Now in Session!");
define("_AM_RESOURCES_HARVEST_BACKGROUND","Background Havest (Quiet)!");
define("_AM_RESOURCES_BACKUPS_RESTORE","Restore Backup!");
define("_AM_RESOURCES_BACKUPS_DELETE","Delete Backup!");
define("_AM_RESOURCES_UPGRADES","If your upgrade failes you will be able to goto:&nbsp;&nbsp;<strong>".XOOPS_URL."/modules/resources/panic.php</strong>&nbsp;&nbsp;and restore your backup of the module that was existing on the system that will be <em>backed-up before the upgrade files are applied!</em>");