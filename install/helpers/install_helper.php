<?php if ( ! defined('IN_DILICMS')) exit('No direct script access allowed');

/**
 * DiliCMS
 *
 * 一款基于并面向CodeIgniter开发者的开源轻型后端内容管理系统.
 *
 * @package     DiliCMS
 * @author      DiliCMS Team
 * @copyright   Copyright (c) 2011 - 2012, DiliCMS Team.
 * @license     http://www.dilicms.com/license
 * @link        http://www.dilicms.com
 * @since       Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * DiliCMS 安装辅助函数库
 *
 * @package     DiliCMS
 * @subpackage  Helpers
 * @category    Helpers
 * @author      chekun
 * @link        http://www.dilicms.com
 */

// ------------------------------------------------------------------------

/**
 * 检测当前安装环境是否为SAE
 *
 * @access  public 
 * @return  bool
 */
if ( ! function_exists('is_sae'))
{
    function is_sae()
    {
        return defined('SAE_ACCESSKEY') && (substr(SAE_ACCESSKEY, 0, 4 ) != 'kapp');
    }
}

// ------------------------------------------------------------------------

/**
 * 检测SAE下memcache服务是否正常
 *
 * @access  public
 * @return  bool
 */
if ( ! function_exists('is_memcache_ok'))
{
    function is_memcache_ok()
    {
        $mmc = memcache_init();
        if ($mmc == FALSE)
        {
            return FALSE;
        }
        else
        {
            memcache_set($mmc, "dilicms_install_test", "dilicms");
            return memcache_get($mmc, "dilicms_install_test") == 'dilicms';
        }
    }
}

// ------------------------------------------------------------------------

/**
 * 检测SAE下storage服务是否正常
 *
 * @access  public
 * @return  bool
 */
if ( ! function_exists('is_storage_ok'))
{
    function is_storage_ok()
    {
        $s = new SaeStorage();
        $status = $s->write('public', '.dilicms_install_test', '');
        $status AND $s->delete('public', '.dilicms_install_test');
        return $status;
    }
}

// ------------------------------------------------------------------------

/**
 * 检测SAE下mysql服务是否正常
 *
 * @access  public
 * @return  bool
 */
if ( ! function_exists('is_mysql_ok'))
{
    function is_mysql_ok()
    {
        return function_exists('mysql_connect') AND mysql_connect(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT, SAE_MYSQL_USER, SAE_MYSQL_PASS);
    }
}

// ------------------------------------------------------------------------