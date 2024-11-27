<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * DocSecLevels seed.
 */
class DocSecLevelsSeed extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeds is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     *
     * @return void
     */
    public function run()
    {
        $data = [];

        $table = $this->table('doc_sec_levels');
        $table->insert($data)->save();
    }
}
