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

require_once __DIR__ . DIRECTORY_SEPARATOR . "constants.php";

if (!function_exists("resourcesInstantiateBlowfish"))
{
	/**
	 * Instances Blow Fish Encryption Salts
	 * 
	 */
	function resourcesInstantiateBlowfish()
	{
		/**
		 * Checks for existing Blowfish Salt File
		 */
		$create = false;
		if (!file_exists($salty = __DIR__ . DIRECTORY_SEPARATOR . "salts.php"))
			$create = true;
		elseif (strpos(file_get_contents($salty), "%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%"))
			$create = true;
		if ($create != true)
			return require_once($salty);
		
		if (!is_a($GLOBALS["xoopsUser"], "XoopsUser"))
			return false;
		
		/**
		 * Creates Blowfish Salt File
		 */
		$template = file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . "templates" . DIRECTORY_SEPARATOR . "salts.php.tpl");
		
		// makke blowfish salt
		$salt = '';
		for($t=mt_rand(11, 30); $t<mt_rand(32,75); $t++)
			while(mt_rand(15,95)<= 79)
			$salt .= chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("Z"))) . chr(mt_rand(ord("A"),ord("Z"))) . chr(mt_rand(ord(","),ord("]"))) . chr(mt_rand(ord("a"),ord("z"))) . chr(mt_rand(ord("!"),ord("="))) . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord(chr(185))))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("~"),ord("|")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("a"),ord("z")))  . chr(mt_rand(ord("0"),ord("(")))  . chr(mt_rand(ord("2"),ord("9"))) ;
		
		// fills fields in template
		$template = str_replace("%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%", str_replace('"', '\"', str_replace("'", "\'", $salt)), $template);
		$template = str_replace("%%%%%%%%%%%%%%%%%%%%%%%%%", microtime(true), $template);
		$template = str_replace("%%%%%%%%%%%%%%%%%%%%", XOOPS_URL, $template);
		$template = str_replace("%%%%%%%%%%%%%%%", str_replace('"', '\"', str_replace("'", "\'", json_encode($GLOBALS["xoopsUser"]->toArray()))), $template);
		
		// Writes File for Salts for Blowfish
		if (file_exists($salty = __DIR__ . DIRECTORY_SEPARATOR . "salts.php"))
			unlink($salty);
		writeRawFile($salty, $template);
		chmod($salty,0444);
		
		return require_once($salty);;
	}
}


if (!function_exists("getURIData")) {

	/* function getURIData()
	 *
	* 	Get a supporting domain system for the API
	* @author 		Simon Antony Roberts (Chronolabs) simon@labs.coop
	*
	* @return 		float()
	*/
	function getURIData($uri = '', $posts = array(), $headers = array(), $timeout = 55, $connectout = 55)
	{
		if (!function_exists("curl_init"))
		{
			return file_get_contents($uri);
		}
		if (!$btt = curl_init($uri)) {
			return false;
		}
		if (count($headers)) {
			curl_setopt($btt, CURLOPT_HEADER, true);
			curl_setopt($btt, CURLOPT_HEADERS, $headers);
		} else
			curl_setopt($btt, CURLOPT_HEADER, 0);
		if (count($posts)) {
			curl_setopt($btt, CURLOPT_POST, true);
			curl_setopt($btt, CURLOPT_POSTFIELDS, http_build_query($posts));
		} else
			curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_CONNECTTIMEOUT, $connectout);
		curl_setopt($btt, CURLOPT_TIMEOUT, $timeout);
		curl_setopt($btt, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($btt, CURLOPT_VERBOSE, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($btt, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($btt);
		curl_close($btt);
		return $data;
	}
}


if (!function_exists("readRawFile")) {
	/**
	 * Return the contents of this File as a string.
	 *
	 * @param string $file
	 * @param string $bytes where to start
	 * @param string $mode
	 * @param boolean $force If true then the file will be re-opened even if its already opened, otherwise it won't
	 * @return mixed string on success, false on failure
	 * @access public
	 */
	function readRawFile($file = '', $bytes = false, $mode = 'rb', $force = false)
	{
		$success = false;
		if ($bytes === false) {
			$success = file_get_contents($file);
		} elseif ($fhandle = fopen($file, $mode)) {
			if (is_int($bytes)) {
				$success = fread($fhandle, $bytes);
			} else {
				$data = '';
				while (! feof($fhandle)) {
					$data .= fgets($fhandle, 4096);
				}
				$success = trim($data);
			}
			fclose($fhandle);
		}
		return $success;
	}
}

if (!function_exists("writeRawFile")) {
	/**
	 *
	 * @param string $file
	 * @param string $data
	 */
	function writeRawFile($file = '', $data = '')
	{
		if (!is_dir(dirname($file)))
			mkdir(dirname($file), 0777, true);
		if (is_file($file))
			unlink($file);
		$ff = fopen($file, 'w');
		fwrite($ff, $data, strlen($data));
		return fclose($ff);
	}
}


if (!function_exists("mkdirSecure")) {
	/**
	 *
	 * @param unknown_type $path
	 * @param unknown_type $perm
	 * @param unknown_type $secure
	 */
	function mkdirSecure($path = '', $perm = 0777, $secure = true)
	{
		if (!is_dir($path))
		{
			mkdir($path, $perm, true);
		}
		if ($secure == true && !file_exists($path . DIRECTORY_SEPARATOR . '.htaccess'))
		{
			writeRawFile($path . DIRECTORY_SEPARATOR . '.htaccess', "<Files ~ \"^.*$\">\n\tdeny from all\n</Files>");
		}
		return true;
	}
}



if (!function_exists("getFolderMap")) {
	/**
	 *
	 * @param string $path
	 * @param string $root
	 */
	function getFolderMap($path = '', $base = '')
	{
		if (empty($base))
			$base = XOOPS_ROOT_PATH;
		$ret = array();
		xoops_load("XoopsList");
		foreach(XoopsList::getDirListAsArray($path) as $folder)
			foreach(getFolderMap($path . DIRECTORY_SEPARATOR . $folder, $base) as $key => $values)
				$ret[$key] = $values;
		$ret[sha1(_RESOURCES_SALT_BLOWFISH.$path)] = array('is' => 'folder', 'path' => str_replace($base, "", $path), 'files' => count($files = XoopsList::getFileListAsArray($path)));
		foreach($files as $file)
			if (substr($file, strlen($file)-1)!='~')
				$ret[sha1(_RESOURCES_SALT_BLOWFISH.($md5 = md5_file($path . DIRECTORY_SEPARATOR . $file)))] = array('is' => 'file', 'file' => $file, 'path' => str_replace($base, "", $path), 'bytes' => filesize($path . DIRECTORY_SEPARATOR . $file));
		return $ret;
	}
}

if (!function_exists("getFolderList")) {
	/**
	 *
	 * @param string $path
	 * @param string $root
	 */
	function getFolderList($path = '')
	{
		$ret = array();
		xoops_load("XoopsList");
		foreach(XoopsList::getDirListAsArray($path) as $folder)
			foreach(getFolderList($path . DIRECTORY_SEPARATOR . $folder) as $key => $values)
				$ret[$key] = $values;
		$ret[sha1(_RESOURCES_SALT_BLOWFISH.$path)] = array('is' => 'folder', 'path' => $path, 'files' => count($files = XoopsList::getFileListAsArray($path)));
		foreach($files as $file)
			$ret[sha1(_RESOURCES_SALT_BLOWFISH.($md5 = md5_file($path . DIRECTORY_SEPARATOR . $file)))] = array('is' => 'file', 'file' => $file, 'path' => $path, 'bytes' => filesize($path . DIRECTORY_SEPARATOR . $file));
		return $ret;
	}
}

if (!function_exists("simplioKey")) {
	/**
	 *
	 * @param unknown_type $passphrase
	 * @param unknown_type $salt
	 * @param unknown_type $key_length
	 * @param unknown_type $raw_output
	 * @return string
	 */
	function getMapFingering($map = array(), $module = '', $mode = 'module')
	{
		foreach($map as $key => $values)
		{
			if ($value['is'] == 'file')
				switch($mode)
				{
					case "theme":
					case "module":
						$map[$key]['fingers'] = getFileFingers($GLOBALS['xoops']->path($value['path'] . DIRECTORY_SEPERATOR . $value['file']));
						break;
					case "xoopslib":
						$map[$key]['fingers'] = getFileFingers(XOOPS_PATH . $value['path'] . DIRECTORY_SEPERATOR . $value['file']);
						break;
				}
		}
		return $map;
	}
}


if (!function_exists("getFileFingers")) {
	/**
	 *
	 * @param unknown_type $passphrase
	 * @param unknown_type $salt
	 * @param unknown_type $key_length
	 * @param unknown_type $raw_output
	 * @return string
	 */
	function getFileFingers($filename = '')
	{
		$file = explode("\n", str_replace(array("\R\n", "\n\R", "\n\n\n\n", "\n\n\n", "\n\n"), "\n", file_get_contents($filename)));
		foreach($file as $line => $value)
			if (strpos($value, "\\\\", $value))
				$file[$line] = substr($value, 0, strpos($value, "\\\\", $value)-1);
		foreach($file as $line => $value)
			if (strpos($value, "#", $value))
				$file[$line] = substr($value, 0, strpos($value, "#", $value)-1);
		foreach($file as $line => $value)
			foreach(array("\n", "\R", "\t", " ", "<?php", "?>", "<?", '^', '%', '$', '@', '!', '=', '+', '-', '*', '|', ':', ';', '.', ',', '<', '>', '{', '}', '(', ')', '`', '~', '_') as $metric)
				while(strpos($value, $metric, $file[$line]))
					$file[$line] = str_replace($value, '', $file[$line]);
		foreach($file as $line => $value)
			if (empty($value))
				unset($file);
		$md5 = array();
		foreach($file as $line => $value)
			$md5[] = sha1($value);
		return $md5;
	}
}

if (!function_exists("simplioKey")) {
	/**
	 *
	 * @param unknown_type $passphrase
	 * @param unknown_type $salt
	 * @param unknown_type $key_length
	 * @param unknown_type $raw_output
	 * @return string
	 */
	function simplioKey($passphrase = '', $salt = '', $key_length = 128, $raw_output = false)
	{

		if (empty($passphrase) || empty($salt))
			return false;
	
		if($key_length <= 0) {
			$key_length = 128;
		}
	
		while(strlen($passphrase)<$key_length)
			$passphrase = $passphrase . $passphrase;
	
		while(strlen($salt)<$key_length)
			$salt = $salt . $salt;
	
		$output = '';
		for($rt=1;$rt<=$key_length;$rt++)
		{
			$output = $output . (substr($passphrase, $rt, 1) ^ substr($salt, strlen($salt)- $rt, 1) ^ substr($passphrase, strlen($passphrase) - $rt, 1));
		}
	
		if($raw_output) {
			return substr($output, 0, $key_length);
		} else {
			return base64_encode(substr($output, 0, $key_length));
		}
	}
}