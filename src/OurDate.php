<?php

declare(strict_types=1);


namespace App;


use DateTime;

class OurDate
{

    private DateTime $date;
    private ?DateTime $dateTime;

    public function __construct(string $yyyyMMdd, DateTime $dateTime = null)
    {
        try {
            $this->date = DateTime::createFromFormat('Y/m/d H:i:s', $yyyyMMdd . ' 00:00:00');
        } catch (\Throwable $e) {
            throw new \InvalidArgumentException('ParseException');
        }
        $this->dateTime = $dateTime;
    }

    public function isSameDay($anotherDate): bool
    {
        return
            $anotherDate->getDay() === $this->getDay()
            && $anotherDate->getMonth() === $this->getMonth();
    }

    private function getDay(): int
    {
        return (int)$this->date->format('d');
    }

    private function getMonth(): int
    {
        return (int)$this->date->format('m');
    }

}
