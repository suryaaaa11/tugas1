<?php
class Database {
    private static ?PDO $pdo = null;

    /**
     * @param array $cfg config db dari config.php['db']
     * @return PDO
     */
    public static function getConnection(array $cfg): PDO {
        if (self::$pdo === null) {
            $dsn = "mysql:host={$cfg['host']};dbname={$cfg['dbname']};charset={$cfg['charset']}";
            self::$pdo = new PDO($dsn, $cfg['user'], $cfg['pass'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        }
        return self::$pdo;
    }
}