<?php
namespace common\services\Sms;

use Yii;
use yii\log\Logger;

/**
 * Мок провайдер для режима разработки
 *
 * @package common\Services\Sms
 */
class MockProvider implements SmsProvider
{
    /**
     * MockProvider constructor.
     */
    public function __construct()
    {
        Yii::getLogger()->log('Инициализирован мок провайдер для отправки SMS', Logger::LEVEL_INFO);
    }

    /**
     * Отправка SMS
     *
     * @param string $phoneNumber
     * @param string $message
     */
    public function send(string $phoneNumber, string $message)
    {
        Yii::getLogger()->log(compact('phoneNumber', 'message'), Logger::LEVEL_INFO);
    }
}
