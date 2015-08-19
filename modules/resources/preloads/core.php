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


require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'functions.php';


/**
 * Class SystemCorePreload
 */
class ResourcesCorePreload extends XoopsPreloadItem
{
	
    /**
     * @param $args
     */
    function eventCoreFooterEnd($args)
    {
    	xoops_load("XoopsCache");
    	xoops_load("XoopsLists");
    	if (!$themes = XoopsCache::read(basename(dirname(__DIR__)).'.available.themes'))
    	{
    		$themes = json_decode(getURIData(sprintf(_MI_RESOURCES_THEMES, _RESOURCES_SUPPORTING)), true);
    		if (!empty($themes))
    			XoopsCache::write(basename(dirname(__DIR__)).'.available.themes', $themes, 3600 * mt_rand(2.99999, 12.99999));
    	}
    	if (!$modules = XoopsCache::read(basename(dirname(__DIR__)).'.available.modules'))
    	{
    		$modules = json_decode(getURIData(sprintf(_MI_RESOURCES_MODULES, _RESOURCES_SUPPORTING)), true);
    		if (!empty($themes))
    			XoopsCache::write(basename(dirname(__DIR__)).'.available.modules', $modules, 3600 * mt_rand(2.99999, 12.99999));
    	}
    	if (!$peers = XoopsCache::read(basename(dirname(__DIR__)).'.available.peers'))
    	{
    		$peers = json_decode(getURIData(sprintf(_MI_RESOURCES_PEERS, _RESOURCES_SUPPORTING)), true);
    		if (!empty($themes))
    			XoopsCache::write(basename(dirname(__DIR__)).'.available.peers', $peers, 3600 * 24 * mt_rand(5.99999, 24.99999));
    	}
    	if (!$modules = XoopsCache::read(basename(dirname(__DIR__)).'.modules.delays'))
    	{
    		XoopsCache::write(basename(dirname(__DIR__)).'.modules', true, 3600 * 24 * 29 * 2);
    		XoopsCache::write(basename(dirname(__DIR__)).'.modules.delays', $modules = XoopsLists::getModulesList(), 3600 * 24 * 31 * 2);
    		foreach($modules as $module)
    		{
    			$map = getFolderMap($GLOBALS['xoops']->path('/modules/'.$module));
    			XoopsCache::write(basename(dirname(__DIR__)).'.module'.$module, true, 3600 * 24 * 29 * 2);
    			XoopsCache::write(basename(dirname(__DIR__)).'.module'.$module.'.delays', $map, 3600 * 24 * 31 * 2);
    			if (is_dir(XOOPS_PATH . '/modules/'.$module))
    			{
	    			$map = getFolderMap(XOOPS_PATH . '/modules/'.$module, XOOPS_PATH);
	    			XoopsCache::write(basename(dirname(__DIR__)).'.xoopslib'.$module, true, 3600 * 24 * 29 * 2);
	    			XoopsCache::write(basename(dirname(__DIR__)).'.xoopslib'.$module.'.delays', $map, 3600 * 24 * 31 * 2);
    			}
    		}
    	}
    	if (!$themes = XoopsCache::read(basename(dirname(__DIR__)).'.themes.delays'))
    	{
    		XoopsCache::write(basename(dirname(__DIR__)).'.themes', true, 3600 * 24 * 29 * 2);
    		XoopsCache::write(basename(dirname(__DIR__)).'.themes.delays', $themes = XoopsLists::getThemesList(), 3600 * 24 * 31 * 2);
    		foreach($themes as $theme)
    		{
    			$map = getFolderMap($GLOBALS['xoops']->path('/themes/'.$theme));
    			XoopsCache::write(basename(dirname(__DIR__)).'.theme'.$theme, true, 3600 * 24 * 29 * 2);
    			XoopsCache::write(basename(dirname(__DIR__)).'.theme'.$theme.'.delays', $map, 3600 * 24 * 31 * 2);
    		}
    	}	
    }
}
