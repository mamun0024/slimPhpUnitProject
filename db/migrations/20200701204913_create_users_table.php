<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUsersTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        // create the table
        $channels = $this->table('users');
        $channels->addColumn('name', 'string', ['limit' => 150, 'null' => true, 'comment' => 'User name'])
            ->addColumn('email', 'string', ['limit' => 255, 'null' => false, 'comment' => 'User email address'])
            ->addColumn('pass', 'string', ['limit' => 255, 'null' => false, 'comment' => 'User password'])
            ->addColumn('created', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('modified', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['unique' => true, 'name' => 'user_email_unique'])
            ->create();

        $this->execute("ALTER TABLE `users` CHANGE `id` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT");
    }
}
