<?php

class uninstall extends \humhub\components\Migration
{

    public function up()
    {

        $this->dropTable('share_object');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}
