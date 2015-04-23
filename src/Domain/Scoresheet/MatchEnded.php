<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class MatchEnded 
{
    private $scoresheetId;
    private $date;

    public function __construct($scoresheetId, $date)
    {
        $this->scoresheetId = $scoresheetId;
        $this->date = $date;
    }

    public function date()
    {
        return $this->date;
    }

    public function scoresheetId()
    {
        return $this->scoresheetId;
    }

}