<?php
    use Yii;

    Yii::$app
            ->mailer
            ->compose(
                ['html' => '<h1>111</h1>', 'text' => '111']
            )
            ->setFrom(['admin@marqar.kz'])
            ->setTo('bernur@mail.ru')
            ->setSubject('test')
            ->send();

?>