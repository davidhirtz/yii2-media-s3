<?php

namespace davidhirtz\yii2\media\composer;

use davidhirtz\yii2\skeleton\composer\BootstrapTrait;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Yii;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\media\bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    use BootstrapTrait;

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
//        $this->extendModules($app, [
//            'media' => [
//                'class' => 'davidhirtz\yii2\media\Module',
//                'uploadPath' => 'uploads'
//            ],
//        ]);
        Yii::debug('S3 Bootstrap');
    }
}