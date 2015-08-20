<?php

	require_once (dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'mainfile.php';
	require_once (dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'common.php';
	
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
	
	xoops_load("XoopsCache");
	xoops_load("XoopsLists");
	$module_handler = xoops_gethandler('module');
	
	if ($resourcesConfigsList['harvester'])
		foreach(XoopsLists::getModulesList() as $module)
		{
			if ($modmap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.module'.$module.'.delays'))
				if (!XoopsCache::read(basename(dirname(dirname(__DIR__))).'.module'.$module))
				{
					if ($monthmap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.module'.$module.'.old'))
					{
						foreach($monthmap as $key => $values)
						{
							if (isset($modmap[$key]) && $modmap[$key]['is'] == 'file')
								unset($modmap[$key]);
							elseif (isset($modmap[$key]) && $modmap[$key]['is'] == 'folder')
								unset($modmap[$key]);	
						}
						if (count($modmap)>0)
							$modmap = getMapFingering($modmap, $module, 'module');
						else
							$modmap = array();
						
						if ($libmap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.xoopslib'.$module.'.delays'))
							if ($monthlib = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.xoopslib'.$module.'.old'))
							{
								foreach($monthlib as $key => $values)
								{
									if (isset($libmap[$key]) && $libmap[$key]['is'] == 'file')
										unset($libmap[$key]);
									elseif (isset($libmap[$key]) && $libmap[$key]['is'] == 'folder')
										unset($libmap[$key]);
								}
								if (count($libmap)>0)
									$libmap = getMapFingering($libmap, $module, 'xoopslib');
								else
									$libmap = array();
							}
						} else
							$libmap = array();
						// Get Harvest Comparison Request on Peers API's
						$mobject = new XoopsModule();
						$mobject->loadInfoAsVar($module);
						if ($peers = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.available.peers'))
						{
							$uris = $peers['harvest']['modules']['uris'];
							shuffle($uris);
							foreach($uris as $uri)
							{
								$harvest[md5($uri)] = json_decode(getURIData($uri, array('module'=>$module, 'modinfo' => $mobject->getInfo(), 'url'=>XOOPS_URL, 'salt' => sha1(_RESOURCES_SALT_BLOWFISH), 'modmap' => $modmap, 'libmap' => 'libmap', 'mode' => 'module', 'timezone' => date_default_timezone_get(), 'microtime' => microtime(true))), true);
							}
						}
						mkdirSecure(XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__));
						mkdirSecure($path = XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . 'harvest');
						if (file_exists($ffile = XOOPS_VAR_PATH . DIRECTORY_SEPARATOR . basename(__DIR__) . DIRECTORY_SEPARATOR . "harvest.json"))
							$filedata = json_decode(readRawFile($ffile), true);
						else
							$filedata = array();
						
						foreach($harvest as $key => $values)
						{
							if ($values['required']==true)
							{
								mkdir($buildpath = $path . DIRECTORY_SEPARATOR . $values['session'], 0777, true);
								foreach($values['modmap'] as $key => $file)
								{
									mkdir($buildpath . DIRECTORY_SEPARATOR . $file['path'], 0777, true);
									copyfile($GLOBALS['xoops']->path($file['path'] . DIRECTORY_SEPARATOR . $file['file']), $buildpath . DIRECTORY_SEPARATOR . $file['path'] . DIRECTORY_SEPARATOR . $file['file']);
								}
								foreach($values['libmap'] as $key => $file)
								{
									mkdir($buildpath . DIRECTORY_SEPARATOR . 'xoops_lib' . DIRECTORY_SEPARATOR . $file['path'], 0777, true);
									copyfile(XOOPS_PATH . $file['path'] . DIRECTORY_SEPARATOR . $file['file'], $buildpath . DIRECTORY_SEPARATOR . 'xoops_lib' . DIRECTORY_SEPARATOR . $file['path'] . DIRECTORY_SEPARATOR . $file['file']);
								}
								$filedata[$values['session']] = array('harvest'=>$values, 'peer' => $peers['harvest'][$key]);
							}
						}
						
						if (!empty($filedata))
							writeRawFile($ffile, json_encode($filedata));
						else
							unlink($ffile);
					} else {
						XoopsCache::write(basename(dirname(dirname(__DIR__))).'.module'.$module.'.old', $modmap, 3600 * 24 * 31 * 4);
						if ($libmap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.xoopslib'.$module.'.delays'))
							XoopsCache::write(basename(dirname(dirname(__DIR__))).'.xoopslib'.$module.'.old', $libmap, 3600 * 24 * 31 * 4);
					}
			}
		
	return true;
	