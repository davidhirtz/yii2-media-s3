<?php

namespace davidhirtz\yii2\media\s3;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use davidhirtz\yii2\skeleton\modules\ModuleTrait;
use Yii;

class Module extends \yii\base\Module
{
    use ModuleTrait;

    /**
     * @var string|null the Amazon S3 bucket name
     */
    public ?string $bucket = null;

    /**
     * @var string|null the Amazon S3 region
     */
    public ?string $region = null;

    /**
     * @var string|null the Amazon S3 access key
     */
    public ?string $awsAccessKey = null;

    /**
     * @var string|null the Amazon S3 access secret
     */
    public ?string $awsAccessSecret = null;

    /**
     * @var S3Client|null
     */
    private ?S3Client $_client = null;

    public function init(): void
    {
        $this->bucket ??= Yii::$app->params['awsS3Bucket'] ?? null;
        $this->region ??= Yii::$app->params['awsS3Region'] ?? null;
        $this->awsAccessKey ??= Yii::$app->params['awsS3AccessKey'] ?? null;
        $this->awsAccessSecret ??= Yii::$app->params['awsS3AccessSecret'] ?? null;

        parent::init();
    }

    public function getClient(): S3Client
    {
        $this->_client ??= new S3Client(array_filter([
            'credentials' => $this->getCredentials(),
            'region' => $this->region,
            'version' => 'latest',
        ]));

        return $this->_client;
    }

    /** @noinspection PhpUnused */
    public function setClient(S3Client $client): void
    {
        $this->_client = $client;
    }

    public function getCredentials(): ?Credentials
    {
        if ($this->awsAccessKey && $this->awsAccessSecret) {
            return new Credentials($this->awsAccessKey, $this->awsAccessSecret);
        }

        return null;
    }
}