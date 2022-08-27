<?php
namespace common\services\Sms;

/**
 * Интерфейс для провайдеров SMS
 *
 * @package common\Services\Sms
 */
interface SmsProvider
{
    /**
     * Отправка SMS
     *
     * @param string $phoneNumber
     * @param string $message
     * @throws \common\exceptions\SmsException
     */
    public function send(string $phoneNumber, string $message);
}
