<?php

use yii\db\Migration;
use yii\db\Schema;

use app\models\PostsManager\model\schema\TablesList;
use app\models\PostsManager\model\schema\PostTypes;

/**
 * Class m181211_165923_base
 */
class m181211_165923_base extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        //
        // POSTS TABLE
        //
        $this->createTable(TablesList::posts, [
            'id' => Schema::TYPE_PK,
            'company_name' => Schema::TYPE_STRING . ' NOT NULL',
            'position' => Schema::TYPE_STRING . ' NOT NULL',
            'type' => 'ENUM ('.implode(',', array_map(function($item) { return "'$item'";}, PostTypes::getAll())).')',
        ]);


        //
        // POSTS DESCRIPTIVE TABLE
        //
        $this->createTable(TablesList::posts_descriptive, [
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'position_description' => Schema::TYPE_TEXT,
            'salary' => Schema::TYPE_INTEGER . ' NOT NULL',
            'starts_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'ends_at' => Schema::TYPE_DATETIME . ' NOT NULL'
        ]);

        $this->createIndex(
            'idx-post-id',
            TablesList::posts_descriptive,
            'post_id'
        );


        $this->addForeignKey(
            TablesList::posts_descriptive.'fk-post-id',
            TablesList::posts_descriptive,
            'post_id',
            TablesList::posts,
            'id',
            'CASCADE'
        );

        //
        // POSTS_CONTACT TABLE
        //
        $this->createTable(TablesList::posts_contact, [
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'contact_name' => Schema::TYPE_STRING,
            'contact_email' => Schema::TYPE_STRING. ' NOT NULL',
        ]);

        $this->createIndex(
            'idx-post-id',
            TablesList::posts_contact,
            'post_id'
        );


        $this->addForeignKey(
            TablesList::posts_contact.'fk-post-id',
            TablesList::posts_contact,
            'post_id',
            TablesList::posts,
            'id',
            'CASCADE'
        );

        //
        // POSTS_QUEUE TABLE
        //
        $this->createTable(TablesList::posts_queue, [
            'post_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'place_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'notification_sent_at' => Schema::TYPE_DATETIME
        ]);

        $this->createIndex(
            'idx-post-id',
            TablesList::posts_queue,
            'post_id'
        );

        $this->addForeignKey(
            TablesList::posts_queue.'fk-post-id',
            TablesList::posts_queue,
            'post_id',
            TablesList::posts,
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable(TablesList::posts_queue);
        $this->dropTable(TablesList::posts_descriptive);
        $this->dropTable(TablesList::posts_contact);
        $this->dropTable(TablesList::posts);

        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181211_165922_base cannot be reverted.\n";

        return false;
    }
    */
}
