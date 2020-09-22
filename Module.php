<?php

namespace davidhirtz\yii2\media\s3;

use davidhirtz\yii2\skeleton\modules\ModuleTrait;

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
     * @inheritDoc
     */
    public function init()
    {
        parent::init();
    }
}