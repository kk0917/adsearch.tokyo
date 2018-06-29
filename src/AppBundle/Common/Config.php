<?php
/**
 * Created by PhpStorm.
 * User: kamenashikou
 * Date: 2017/11/06
 * Time: 18:33
 */

namespace AppBundle\Common;

/**
 * Class Config 共通で使用する設定項目の管理
 */
class Config
{
    /**
     * @var array $data データの格納先
     */
    private static $data = array();

    /**
     * 設定を取得する
     *
     * @param string $name 識別名称
     */
    public static function get($name)
    {
        return self::$data[$name];
    }

    /**
     * 設定を登録する
     *
     * @param string $name  識別名称
     * @param mixed  $value データ
     */
    public static function set($name, $value)
    {
        self::$data[$name] = $value;
    }
}