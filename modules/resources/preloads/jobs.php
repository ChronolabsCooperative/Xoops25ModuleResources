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
class ResourcesJobsPreload extends XoopsPreloadItem
{
	
    /**
     * @param $args
     */
    function eventCoreIncludeCommonEnd($args)
    {
    	xoops_load("XoopsCache");
	    
    	global $resourcesModule, $resourcesConfigsList;
		
		if (empty($resourcesModule))
		{
			if (is_a($resourcesModule = xoops_gethandler('module')->getByDirname(basename(dirname(__DIR__))), "XoopsModule"))
			{
				if (empty($resourcesConfigsList))
				{
					$resourcesConfigsList = xoops_gethandler('config')->getConfigsList($resourcesModule->getVar('mid'));
				}
			}
		}
		
		if ($resourcesConfigsList['scheduling']=='preloader')
	    	if (!$jobs = XoopsCache::read(basename(dirname(__DIR__)).'.cron.jobs'))
	    	{
	    		XoopsCache::write(basename(dirname(__DIR__)).'.cron.jobs', array(	'harvest-modules.php' => microtime(true) + (3600 * 24 * mt_rand(10, 24)),
	    																			'harvest-themes.php' => microtime(true) + (3600 * 24 * mt_rand(10, 24)),
	    																			'send-reports.php' => microtime(true) + (3600 * 24 * mt_rand(2, 6)),
	    																			'harvest-push.php' => microtime(true) + mt_rand(10, 25),
	    																			'updates-pull.php' => microtime(true) + mt_rand(10, 25),
	    																			'find-updates.php' => microtime(true) + 1800 * mt_rand(10, 60)), 3600 * 24);
	    	} else {
	    		$execute = array();
	    		foreach($jobs as $job => $when)
	    			if ($when < microtime(true))
	    			{
	    				switch($job)
	    				{
	    					case "harvest-modules.php":
	    					case "harvest-themes.php":
	    						$jobs[$job] = microtime(true) + (3600 * 24 * mt_rand(10, 24));
	    						break;
	    					case "send-reports.php":
	    						$jobs[$job] = microtime(true) + (3600 * 24 * mt_rand(2, 6));
	    						break;
	    					case "updates-pull.php":
	    					case "harvest-push.php":
	    						$jobs[$job] = microtime(true) + mt_rand(10, 25);
	    						break;
	    					case "find-updates.php":
	    						$jobs[$job] = microtime(true) + 1800 * mt_rand(10, 60);
	    						break;
	    				}
	    				if (file_exists($exec = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'jobs' . DIRECTORY_SEPARATOR . $job ))
	    					$execute[] = $exec;
	    			}
	    		XoopsCache::write(basename(dirname(__DIR__)).'.cron.jobs', $jobs, 3600 * 24);
	    		
	    		// Executes Schedule Tasks on XOOPS Event Handler
	    		if (count($execute)>0)
	    			foreach($execute as $exec)
	    				@include $exec;
	    	}
    	return true;
    }
}
