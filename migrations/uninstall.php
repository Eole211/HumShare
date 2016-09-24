<?php

class uninstall extends \humhub\components\Migration
{

    public function up()
    {

        $this->dropTable('share_object');
        $this->dropTable('share_category');
    }

    public function down()
    {
        echo "uninstall does not support migration down.\n";
        return false;
    }

}
