README
============================

This extension enables the use of Amazon S3 as file system for the [Yii 2](http://www.yiiframework.com/) extension [yii2-media](https://github.com/davidhirtz/yii2-media/) by David Hirtz.

### Configuration

Add following to your application configuration. Both `awsAccessKey` and `awsAccessSecret` can also be set in `config/params.php` or omitted in which case the default [AWS configuration](https://docs.aws.amazon.com/sdk-for-php/v3/developer-guide/guide_configuration.html) will be loaded.

```php
<?php
return [
    'modules' => [
        'media-s3' => [
            'bucket' => 'your-bucket',
            'region' => 'your-region',
            'awsAccessKey' => 'your-key',
            'awsAccessSecret' => 'your-secret',
        ],
    ],
];
```