<?php

namespace davidhirtz\yii2\media\s3;

use Aws\Credentials\Credentials;
use Aws\S3\S3Client;
use davidhirtz\yii2\skeleton\modules\ModuleTrait;
use Yii;

/**
 * Class Module
 * @package davidhirtz\yii2\media
 */
class Module extends \yii\base\Module
{
    use ModuleTrait;

    /**
     * @var string
     */
    public $bucket;

    /**
     * @var string
     */
    public $awsAccessKey;

    /**
     * @var string
     */
    public $awsAccessSecret;

    /**
     * @var string
     */
    public $region;

    /**
     * @var bool
     */
    public $useStaticWebsite = false;

    /**
     * @var S3Client
     */
    private $_client;

    /**
     * @inheritDoc
     */
    public function init()
    {
        if($this->bucket === null) {
            $this->bucket = Yii::$app->params['bucket'] ?? null;
        }

        if($this->awsAccessKey === null) {
            $this->awsAccessKey = Yii::$app->params['awsAccessKey'] ?? null;
        }

        if($this->awsAccessSecret === null) {
            $this->awsAccessSecret = Yii::$app->params['awsAccessSecret'] ?? null;
        }

        parent::init();
    }

    /**
     * @return S3Client
     */
    public function getClient()
    {
        if($this->_client === null) {
            $this->_client = new S3Client(array_filter([
                'credentials' => $this->getCredentials(),
                'region' => $this->region,
                'version' => 'latest',
            ]));
        }

        return $this->_client;
    }

    /**
     * @param S3Client $client
     */
    public function setClient(S3Client $client): void
    {
        $this->_client = $client;
    }

    /**
     * @return Credentials|null
     */
    public function getCredentials()
    {
        if($this->awsAccessKey && $this->awsAccessSecret) {
            return new Credentials($this->awsAccessKey, $this->awsAccessSecret);
        }

        return null;
    }
}