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
	 * @return boolean
	 * @access public
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
	/**
	 *  Uses Curl to retrieve URL
	 * 
	 * @param string 	$uri		URL of the source for the data
	 * @param array  	$posts 		$_POST Variable to Pass
	 * @param array  	$headers	Header Variables to Pass
	 * @param integer  	$timeout	Retievial Timeout
	 * @param integer  	$connectout Connection Timeout
	 * @return string
	 * @access public
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
			curl_setopt($btt, CURLOPT_HEADERS, $headers);
		} 
		if (count($posts)) {
			curl_setopt($btt, CURLOPT_POST, true);
			curl_setopt($btt, CURLOPT_POSTFIELDS, http_build_query($posts));
		} else
			curl_setopt($btt, CURLOPT_POST, 0);
		curl_setopt($btt, CURLOPT_HEADER, false);
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
	 * @param string $file		file and path to retrieve
	 * @param string $bytes 	where to start
	 * @param string $mode		file open mode
	 * @param boolean $force 	If true then the file will be re-opened even if its already opened, otherwise it won't
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
	 * Write to filebase
	 *
	 * @param string $file		file and path of file
	 * @param string $data		data to write
	 * @return boolean
	 * @access public
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
	 * Makes a folder and secures the folder with .htaccess
	 *
	 * @param string $path		folder path
	 * @param string $perm		folder permissions
	 * @param boolean $secure	secure the folder
	 * @return boolean
	 * @access public
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
	 * get file map recursively from a folder
	 *
	 * @param string $path		path to search
	 * @param string $base		base path to remove from array
	 * @return array
	 * @access public
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
	 * get file + folder map recursively from a folder
	 *
	 * @param string $path		path to search
	 * @return array
	 * @access public
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

if (!function_exists("getMapFingering")) {
	/**
	 * Get Folder Map Fingerprints for files
	 *
	 * @param array $map		Folder Map Array
	 * @param string $module	module or theme dirname
	 * @param string $mode		Mode routine is running in
	 * @return array
	 * @access public
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
	 * Get File Forensic Fingerprint
	 *
	 * @param string $filename	file to process fully pathed
	 * @return array
	 * @access public
	 */
	function getFileFingers($filename = '')
	{
		$file = file($filename);
		$strip = false;
		foreach($file as $line => $value)
		{
			if (strpos("aa".$value, "/*", $value))
				$strip = true;
			if ($strip==true)
				unset($file[$line]);
			if (strpos("aa".$value, "*/", $value))
				$strip = false;
		}
		foreach($file as $line => $value)
			if (strpos("aa".$value, "\\\\", $value))
				$file[$line] = substr($value, 0, strpos($value, "\\\\", $value)-1);
		foreach($file as $line => $value)
			if (strpos("aa".$value, "#", $value))
				$file[$line] = substr($value, 0, strpos($value, "#", $value)-1);
		foreach($file as $line => $value)
			foreach(array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "=", "~", "`", "'", '"', "\n", "\R", "\t", "\c", " ", "<?php", '^', '%', '$', '@', '!', '+', '-', '*', '|', ':', ';', '.', ',', '<', '>', '{', '}', '(', ')', '_', '?', '\\', '/') as $metric)
				while(strpos("aa".$value, $metric, $file[$line]))
					$file[$line] = str_replace($metric, '', strtolower(trim($file[$line])));
		foreach($file as $line => $value)
			if (empty($value))
				unset($file[$line]);
		$md5 = array();
		foreach($file as $line => $value)
		{
			$variable = $extended = $function = $class = $private = $public = $static = $reserve = false;
			foreach(array('class', 'function', 'var', 'property', 'static', 'public', 'private', 'extended') as $reserve)
				if (strpos("aa" . $value, $reserve))
					$reserve = true;
			if ($reserve == true)
			{
				if (strpos("aa" . $value, 'var') || strpos("aa" . $value, 'property'))
					$variable = true;
				if (strpos("aa" . $value, 'static'))
					$static = true;
				if (strpos("aa" . $value, 'public'))
					$public = true;
				if (strpos("aa" . $value, 'private'))
					$private = true;
				if (substr($value, 0, 5) == 'class')
					$class = true;
				if (strpos("aa" . $value, 'extended') && $class == true)
					$extended = true;
				if (substr($value, 0, 8) == 'function')
					$function = true;
				if (strpos("aa" . $value, 'function') && ($static == true || $public == true || $private == true))
					$function = true;
			}
			$md5[] = array('finger'=>sha1($value),'bytes'=>strlen($value),'reserve'=>$reserve, 'variable' => $variable, 'extended' => $extended, 'function' => $function, 'class' => $class, 'private' => $private, 'public' => $public, 'static' => $static);
		}
		return $md5;
	}
}

if (!function_exists("getXORKey")) {
	/**
	 * Creates with XOR Functions Cipher Key for Encryption
	 *
	 * @param string $passphrase
	 * @param string $salt
	 * @param integer $key_length
	 * @param boolean $raw_output
	 * @return string
	 * @access public
	 */
	function getXORKey($passphrase = '', $salt = '', $key_length = 128, $raw_output = false)
	{
		if (empty($passphrase) || empty($salt))
			return false;
		if($key_length <= 0)
			$key_length = 128;
		while(strlen($passphrase)<$key_length)
			$passphrase .= (string)implode("", array_reverse(explode("", $passphrase)));
		while(strlen($salt)<$key_length)
			$salt .= (string)implode("", array_reverse(explode("", $salt)));
		$output = '';
		for($rt=1;$rt<=$key_length;$rt++)
			$output .= (string)((string)(substr($passphrase, $rt, 1) ^ substr($salt, strlen($salt)- $rt, 1)) ^ substr($passphrase, strlen($passphrase) - $rt, 1));
		if($raw_output)
			return substr($output, 0, $key_length);
		else
			return base64_encode(substr($output, 0, $key_length));
	}
}