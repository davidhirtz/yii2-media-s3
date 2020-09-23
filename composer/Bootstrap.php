<?php

namespace davidhirtz\yii2\media\s3\composer;

use davidhirtz\yii2\media\s3\Module;
use davidhirtz\yii2\skeleton\composer\BootstrapTrait;
use yii\base\Application;
use yii\base\BootstrapInterface;
use Yii;

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
        $this->extendModule($app, 'media-s3', [
            'class' => 'davidhirtz\yii2\media\s3\Module',
        ]);

        /** @var Module $module */
        $module = Yii::$app->getModule('media-s3');

        if ($module->bucket && $module->region) {
            // Override webroot and disable renaming folders as this is currently not
            // supported by the Amazon S3 stream wrapper.
            $app->setModule('media', array_merge($app->getModules()['media'], [
                'webroot' => "s3://{$module->bucket}/",
                'enableRenameFolders' => false,
            ]));

            $client = $module->getClient();
            $client->registerStreamWrapper();

            stream_context_set_default([
                's3' => [
                    'ACL' => 'private',
                    'seekable' => true,
                ],
            ]);
        }
    }
}