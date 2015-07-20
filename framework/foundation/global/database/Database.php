<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2015/7/20
 * Time: 下午 12:33
 */
class DB
{
    /**
     * @var PDO
     */
    private static $pdo;

    public static function setPDO(PDO $pdo)
    {
        static::$pdo = $pdo;
    }

    public static function select($prepareSql, $parameters = null)
    {
        if (!$prepareSql) {
            //throw exception and log
        }
        $result = null;
        try {
            $query = static::$pdo->prepare($prepareSql);
            $query->execute($parameters);
            $result = $query->fetchAll();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            die();
        }
        return $result;
    }

    public static function insert($prepareSql, $parameters = null)
    {
        return static::execute($prepareSql, $parameters);
    }

    public static function update($prepareSql, $parameters = null)
    {
        return static::execute($prepareSql, $parameters);
    }

    public static function delete($prepareSql, $parameters = null)
    {
        return static::execute($prepareSql, $parameters);
    }

    private static function execute($prepareSql, $parameters = null)
    {
        if (!$prepareSql) {
            //throw exception and log
        }
        $isSuccess = false;
        $sth = null;
        $affected = 0;
        try {
            $sth = static::$pdo->prepare($prepareSql);
            $isSuccess = $sth->execute($parameters);
        } catch (Exception $e) {
            //log here
            Log::error($e->getMessage());
            die();
        }
        if (!is_null($sth)) {
            $affected = $sth->rowCount();
        }
        return $affected;
    }

    public static function transaction($function)
    {
        try {
            static::$pdo->beginTransaction();
            $function();
            static::$pdo->commit();
        } catch (Exception $e) {
            Log::error($e->getMessage());
            static::$pdo->rollBack();
            die();
        }
    }


    public static function beginTransaction()
    {
        static::$pdo->beginTransaction();
    }

    public static function rollBack()
    {
        static::$pdo->rollBack();
    }

    public static function commit()
    {
        static::$pdo->commit();
    }

    public static function getPDO()
    {
        return static::$pdo;
    }
}