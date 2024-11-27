<?php
declare(strict_types=1);

use Migrations\AbstractSeed;

class DatabaseSeed extends AbstractSeed
{
    public function run(): void
    {
        $this->call('AcResultsSeed');
        $this->call('AcStatusesSeed');
        $this->call('AcTypessSeed');
        $this->call('ConfigsSeed');
        $this->call('DocInternalTypesSeed');
        $this->call('DocMethodsSeed');
        $this->call('DocSecLevelsSeed');
        $this->call('DocStatusesSeed');
        $this->call('DocTypesSeed');
        $this->call('EmpTypesSeed');
        $this->call('RolesSeed');
        $this->call('UserTitlesSeed');
    }
}

?>