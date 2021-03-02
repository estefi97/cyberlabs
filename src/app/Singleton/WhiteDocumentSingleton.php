<?php
namespace App\Singleton;

/**
 * Class WhiteDocumentSingleton
 *
 * @package App\Singleton
 */
class WhiteDocumentSingleton
{
    /**
     * @var array|string
     */
    public static $message = [];

    /**
     * @var WhiteDocumentSingleton|null
     */
    private static $instance = null;

    /**
     * WhiteDocumentSingleton constructor.
     */
    private function __construct()
    {
        self::$instance = $this;
        self::$message[] = 'Instancia creada';
    }

    /**
     * @return WhiteDocumentSingleton
     */
    public static function getInstance(): WhiteDocumentSingleton
    {
        if (self::$instance === null) {
            self::$instance = new static();
        }
        else {
            self::$message[] = 'La instancia ya fue creada';
        }

        return self::$instance;
    }
}