<?php
namespace common\services\Sms;

use common\exceptions\SmsException;
use Yii;

/**
 * Класс для работы с провайдером SMS КазИнфоТех
 *
 * @package common\Services\Sms
 */
class KazInfoTech implements SmsProvider
{
    /**
     * Настройки подключения
     *
     * @var array
     */
    protected $config = [
        'host'     => 'http://212.124.121.186:9507/api',
        'user'     => 'markhar1',
        'password' => 'EGUfNaxfy',
    ];

    /**
     * Отправляет SMS
     *
     * @param string $phoneNumber
     * @param string $message
     * @throws \common\exceptions\SmsException
     */
    public function send(string $phoneNumber, string $message)
    {
        $query  = [
            'action'      => 'sendmessage',
            'messagetype' => 'SMS:TEXT',
            'username'    => $this->config['user'],
            'password'    => $this->config['password'],
            'originator'  => $this->getSenderName($phoneNumber),
            'messagedata' => $message,
            'recipient'   => $phoneNumber,
        ];

        $url = $this->config['host'] . '?' . http_build_query($query);

        $result = file_get_contents($url);

        if ($result === false) {
            Yii::getLogger()->log('Не удалось отправить SMS', Yii::getLogger()::LEVEL_INFO);

            throw new SmsException('Не удалось отправить SMS. Пожалуйста, попробуйте повторить попытку');
        }
    }

    /**
     * @param string $phoneNumber
     * @return string
     */
    protected function getSenderName(string $phoneNumber): string
    {
        return (preg_match('/^7(?:701|702|775)/', $phoneNumber)) ? 'KiT_Notify' : 'HalalCredit';
    }
}
