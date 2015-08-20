<?php

	require_once dirname(dirname(dirname(dirname(__DIR__)))) . DIRECTORY_SEPARATOR . 'mainfile.php';
	require_once dirname(dirname(__DIR__)) . DIRECTORY_SEPARATOR . 'common.php';
	
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
	
	if ($resourcesConfigsList['harvester'])
		foreach(XoopsLists::getThemesList() as $theme)
		{
			if ($thememap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.theme'.$theme.'.delays'))
				if (!XoopsCache::read(basename(dirname(dirname(__DIR__))).'.theme'.$theme))
				{
					if ($monthmap = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.theme'.$theme.'.old'))
					{
						foreach($monthmap as $key => $values)
						{
							if (isset($thememap[$key]) && $thememap[$key]['is'] == 'file')
								unset($thememap[$key]);
							elseif (isset($thememap[$key]) && $thememap[$key]['is'] == 'folder')
								unset($thememap[$key]);	
						}
						if (count($thememap)>0)
							$thememap = getMapFingering($thememap, $theme, 'theme');
						else
							$thememap = array();
						
						// Get Harvest Comparison Request on Peers API's
						if ($peers = XoopsCache::read(basename(dirname(dirname(__DIR__))).'.available.peers'))
						{
							$uris = $peers['harvest']['themes']['uris'];
							shuffle($uris);
							foreach($uris as $uri)
							{
								$harvest[md5($uri)] = json_decode(getURIData($uri, array('theme'=>$theme, 'url'=>XOOPS_URL, 'salt' => sha1(_RESOURCES_SALT_BLOWFISH), 'thememap' => $thememap, 'mode' => 'theme', 'timezone' => date_default_timezone_get(), 'microtime' => microtime(true))), true);
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
								foreach($values['thememap'] as $key => $file)
								{
									mkdir($buildpath . DIRECTORY_SEPARATOR . $file['path'], 0777, true);
									copyfile($GLOBALS['xoops']->path($file['path'] . DIRECTORY_SEPARATOR . $file['file']), $buildpath . DIRECTORY_SEPARATOR . $file['path'] . DIRECTORY_SEPARATOR . $file['file']);
								}
								$filedata[$values['session']] = array('harvest'=>$values, 'peer' => $peers['harvest'][$key]);
							}
						}
						
						if (!empty($filedata))
							writeRawFile($ffile, json_encode($filedata));
						else
							unlink($ffile);
					} else {
						XoopsCache::write(basename(dirname(dirname(__DIR__))).'.theme'.$theme.'.old', $thememap, 3600 * 24 * 31 * 4);
					}
				}
		}
	
	return true;
	
	