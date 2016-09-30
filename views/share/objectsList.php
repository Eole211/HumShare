<?php

use yii\helpers\Html;
use yii\helpers\Url;
use humhub\modules\share\models\Object;
use humhub\modules\user\models\User;
use humhub\modules\user\models\Profile;

/**
 *
 * @uses $accesslevel the access level of the user currently logged in.
 *
 * @var Object[] $objects
 * @var ContentContainer $contentContainer
 * @var User $user
 */

humhub\modules\share\Assets::register($this);