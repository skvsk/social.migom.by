<?php

class YiiBaseEx extends YiiBase
{

    /**
     * Class autoload loader.
     * This method is provided to be invoked within an __autoload() magic method.
     * @param string $className class name
     * @return boolean whether the class has been loaded successfully
     */
    public static function autoload($className)
    {
        // use include so that the error PHP file may appear
        if (isset(self::$classMap[$className]))
            include(self::$classMap[$className]);
        else {
            // include class file relying on include_path
            if (strpos($className, '\\') === false) {  // class without namespace
                if (self::$enableIncludePath === false) {
                    foreach (self::$_includePaths as $path) {
                        $classFile = $path . DIRECTORY_SEPARATOR . $className . '.php';
                        if (is_file($classFile)) {
                            include($classFile);
                            if (YII_DEBUG && basename(realpath($classFile)) !== $className . '.php')
                                throw new CException(Yii::t('yii', 'Class name "{class}" does not match class file "{file}".', array(
                                            '{class}' => $className,
                                            '{file}' => $classFile,
                                        )));
                            break;
                        }
                    }
                } else {
                    @include($className . '.php');
                    if (!(class_exists($className, false) || interface_exists($className, false)) && strpos($className, '_') !== false) {
                        // Try namespaced version of class name
                        $aClassName = explode('_', $className);
                        $file = array_pop($aClassName);
                        
                        include(strtolower(implode(DIRECTORY_SEPARATOR, $aClassName)) . DIRECTORY_SEPARATOR . $file . '.php');
                    }
                }
            } else {  // class name with namespace in PHP 5.3
                $namespace = str_replace(array('\\', '_'), '.', ltrim($className, '\\'));
                if (($path = self::getPathOfAlias($namespace)) !== false)
                    include($path . '.php');
                else
                    return false;
            }
            $res = class_exists($className, false) || interface_exists($className, false);
            if ($res) {
                return $res;
            } else {
                return YiiBase::autoload($className);
            }
        }
    }

}