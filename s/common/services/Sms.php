<?php

namespace common\services;

use common\services\Sms\KazInfoTech;
use common\services\Sms\MockProvider;

/**
 * Сервис для отправки SMS
 *
 * @package Services
 */
class Sms
{
    /**
     * @var self
     */
    protected static $instance;

    /**
     * @var \common\Services\Sms\SmsProvider
     */
    protected $provider;

    private function __construct()
    {
        $this->provider =/* YII_ENV_DEV ? new MockProvider() : */new KazInfoTech();
    }

    /**
     * Возвращает инстанс для синглтона
     *
     * @return \Services\Sms
     */
    public static function getInstance(): self
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Отправляет SMS
     *
     * @param string $phoneNumber
     * @param string $message
     * @throws \common\exceptions\SmsException
     */
    public function send(string $phoneNumber, string $message)
    {
        $this->provider->send($phoneNumber, $message);
    }
}
