<?php

namespace davidhirtz\yii2\media\s3\composer;

use davidhirtz\yii2\skeleton\composer\BootstrapTrait;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Class Bootstrap
 * @package davidhirtz\yii2\media\s3\bootstrap
 */
class Bootstrap implements BootstrapInterface
{
    use BootstrapTrait;

    /**
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if(!$bucket = ($app->getModules()['media-s3']['bucket'] ?? false)) {
            throw new InvalidConfigException("Please specify an S3 bucket name.");
        }

        $this->extendModules($app, [
            'media' => [
                'uploadPath' => "s3://{$bucket}/",
            ],
            'media-s3' => [
                'class' => 'davidhirtz\yii2\media\s3\Module',
            ],
        ]);
    }
}