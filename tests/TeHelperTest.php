<?php

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;

class TeHelperTest extends TestCase
{
    public function testWillExpireAt()
    {
        $created_at = '2023-04-20 12:00:00';
        $due_time = '2023-04-20 14:00:00';

        $expectedResult = '2023-04-20 14:00:00';

        $result = \DTApi\Helpers\TeHelper::willExpireAt($due_time, $created_at);

        $this->assertEquals($expectedResult, $result);
    }
}
