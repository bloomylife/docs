<?php
define('_VERSION_', '1.2');
define('_ROOT_', dirname(dirname(__FILE__)));
define('_MODULE_', _ROOT_ . DIRECTORY_SEPARATOR . 'module');

final class lib {

    /**
     * load config.php file
     *
     * @param $m
     */
    public static function getConfig($m) {
        $configFilePath = self::getPath($m, 'config') . 'config.php';
        if (is_file($configFilePath)) {
            return include $configFilePath;
        } else {
            return false;
        }
    }

    /**
     * load docs/config.php file
     *
     * @param $m
     */
    public static function getDocs($m, $f) {
		self::resolveMethod($m, $f);
        $docsFilePath = self::getPath($m, 'docs') . $f . '.config.php'; 
        if (is_file($docsFilePath)) {
            return include $docsFilePath;
        } else {
            return false;
        }
    }

	public static function resolveMethod(&$m, &$f) {
		if (stripos($f, '-') > 0) {
			$mf = explode('-', $f);
			$m = $mf[0];
			$f = $mf[1];
		} else {
			$m = $m;
			$f = str_replace('-', '', $f);
		}
	}

    /**
     * get file content by type XML/JSON.
     * @param $m
     * @param $f
     * @param string $type
     */
    public static function getFileByType($m, $file) {
        $filePath =  self::getPath($m, 'docs') . $file;
        if (is_file($filePath)) {
            return file_get_contents($filePath);
        } else {
            return false;
        }
    }

    private static function getPath($m, $subDir) {
        return _MODULE_. DIRECTORY_SEPARATOR. $m . DIRECTORY_SEPARATOR . $subDir . DIRECTORY_SEPARATOR;
    }
}

