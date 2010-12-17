<?php defined('SYSPATH') or die('No direct script access.');

//-- Environment setup --------------------------------------------------------

/**
 * Set the default time zone.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Asia/Yekaterinburg');

/**
 * Set the default locale.
 *
 * @see  http://kohanaframework.org/guide/using.configuration
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/**
 * Enable the Kohana auto-loader.
 *
 * @see  http://kohanaframework.org/guide/using.autoloading
 * @see  http://php.net/spl_autoload_register
 */
spl_autoload_register(array('Kohana', 'auto_load'));

/**
 * Enable the Kohana auto-loader for unserialization.
 *
 * @see  http://php.net/spl_autoload_call
 * @see  http://php.net/manual/var.configuration.php#unserialize-callback-func
 */
ini_set('unserialize_callback_func', 'spl_autoload_call');

//-- Configuration and initialization -----------------------------------------

/**
 * Set Kohana::$environment if $_ENV['KOHANA_ENV'] has been supplied.
 * 
 */
if (isset($_ENV['KOHANA_ENV']))
{
	Kohana::$environment = $_ENV['KOHANA_ENV'];
}

/**
 * Initialize Kohana, setting the default options.
 *
 * The following options are available:
 *
 * - string   base_url    path, and optionally domain, of your application   NULL
 * - string   index_file  name of your index file, usually "index.php"       index.php
 * - string   charset     internal character set used for input and output   utf-8
 * - string   cache_dir   set the internal cache directory                   APPPATH/cache
 * - boolean  errors      enable or disable error handling                   TRUE
 * - boolean  profile     enable or disable internal profiling               TRUE
 * - boolean  caching     enable or disable internal caching                 FALSE
 */
//define('IN_PRODUCTION', $_SERVER['SERVER_ADDR'] !== '127.0.0.1');//Если локалхост то режим продакшн не включаетсся
define('IN_PRODUCTION', FAlSE);//Если локалхост то режим продакшн не включаетсся
 
if (IN_PRODUCTION){	error_reporting(0);} //Отключение вывода ошибок в Продакшн режиме
 
Kohana::init(array(
	'base_url'   	=>	'/dapsite/',
	'index_file'	=>	'',
	'profiling'  => ! IN_PRODUCTION,//Отключение профилирования в продакшн
	'caching'    => IN_PRODUCTION,//Включение кэширования в продакшн
	'errors'	=> ! IN_PRODUCTION,//Отключение вывода ошибок в Продакшн режиме Kohana
));

/**
 * Attach the file write to logging. Multiple writers are supported.
 */
Kohana::$log->attach(new Kohana_Log_File(APPPATH.'logs'));

/**
 * Attach a file reader to config. Multiple readers are supported.
 */
Kohana::$config->attach(new Kohana_Config_File);

/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'jelly'      => MODPATH.'jelly',//ORM
	'comhtml'    => MODPATH.'comhtml',//Дополнительные функции для вывода html элементов
	'articles'   => MODPATH.'articles',//Компонент  статьи
	'backend'    => MODPATH.'backend',	//Компонент  административной панели
	'bereview'   => MODPATH.'bereview',	//Компонент главная страница  административной панели
	'permisions' => MODPATH.'permisions',	//Компонент разделения прав
	'news' 		 => MODPATH.'news',	//Компонент - новости
	'mainpage'   => MODPATH.'mainpage',	//Компонент - главная страница сайта
	'components' => MODPATH.'components',	//Компонентная система
	'exrequest'  => MODPATH.'exrequest',	//Удобный вызов URL через factory
	'login'      => MODPATH.'login',	//Логин
	'loadlib'    => MODPATH.'loadlib',	//Загрузка css и js
	'seo'    	 => MODPATH.'seo',		//Сео модуль
	'auth'       => MODPATH.'auth',       // Basic authentication
	'templates'  => MODPATH.'templates',
	'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	'database'   => MODPATH.'database',   // Database access
	'image'      => MODPATH.'image',      // Image manipulation
	'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'oauth'      => MODPATH.'oauth',      // OAuth authentication
	//'pagination' => MODPATH.'pagination', // Paging of results
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	'userguide'  => MODPATH.'userguide',  // User guide and API documentation
	));

/**
 * Set the routes. Each route must have a minimum of a name, a URI and a set of
 * defaults for the URI.
 */
if ( ! Route::cache())
{ 
	Route::set('lang', '(<lang>)(/<controller>(/<action>(/<com>)))',
    array(
        'lang' => '[a-zA-Z]{2}',
    ))
    ->defaults(array(
        'controller' => 'frontend',
        'action'     => 'index',
		'com'		 => 'mainpage',
    ));
	
	Route::set('error', 'error/<action>')
		->defaults(array(
			'controller' => 'error',
			'action'     => '404',
		));	
	
	Route::set('backend', 'backend(/<action>(/<com>))')
		->defaults(array(
			'controller' => 'backend',
			'action'     => 'index',
			'com'		 => 'bereview',
		));	
	
	Route::set('default', '(<controller>(/<action>(/<com>)))')
		->defaults(array(
			'controller' => 'frontend',
			'action'     => 'index',
			'com'		 => 'mainpage',
		));
	
	Route::cache(IN_PRODUCTION);
}
	
$request = Request::instance();

if (!IN_PRODUCTION){
	$request->execute();
}
else{ 
	try
	{
		$request->execute();
	}
	catch (Kohana_Exception404 $e)
	{
	   $request = Request::factory('error/404')->execute();
	}
	catch (Kohana_Exception403 $e)
	{
	   $request = Request::factory('error/403')->execute();
	}
	catch (ReflectionException $e)
	{
		$request = Request::factory('error/404')->execute();
	}
	catch (Exception $e)
	{
		$request = Request::factory('error/500')->execute();
	}
}	 
echo $request->send_headers()->response;

