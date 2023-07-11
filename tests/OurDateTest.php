<?php

declare(strict_types=1);

use App\OurDate;
use PHPUnit\Framework\TestCase;

class OurDateTest extends TestCase
{

    public function testIsSameDate()
    {
        $OurDate = DateRepresentation::toOurDate('1789/01/24');
        $sameDay = DateRepresentation::toOurDate('2001/01/24');
        $notSameDay = DateRepresentation::toOurDate('1789/01/25');
        $notSameMonth = DateRepresentation::toOurDate('1789/02/25');

        $this->assertTrue($OurDate->isSameDay($sameDay), 'same');
        $this->assertFalse($OurDate->isSameDay($notSameDay), 'not same day');
        $this->assertFalse($OurDate->isSameDay($notSameMonth), 'not same month');
    }
}
