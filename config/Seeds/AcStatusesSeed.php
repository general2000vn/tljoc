<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

/**
 * AcStatuses seed.
 */
class AcStatusesSeed extends AbstractSeed
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

        $table = $this->table('ac_statuses');
        $table->insert($data)->save();
    }
}
