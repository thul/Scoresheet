<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class MatchFailedToEnd 
{
    private $scoresheetId;
    private $date;
    private $reason;

    public function __construct($scoresheetId, $date, $reason)
    {
        $this->scoresheetId = $scoresheetId;
        $this->date = $date;
        $this->reason = (string) $reason;
    }

    /**
     * @return mixed
     */
    public function scoresheetId()
    {
        return $this->scoresheetId;
    }

    /**
     * @return mixed
     */
    public function date()
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function reason()
    {
        return $this->reason;
    }
}