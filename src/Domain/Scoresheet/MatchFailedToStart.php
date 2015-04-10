<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class MatchFailedToStart 
{
    private $scoresheetId;
    private $date;
    private $location;
    private $home;
    private $away;
    private $reason;

    public function __construct($scoresheetId, $date, $location, $home, $away, $reason)
    {
        $this->scoresheetId = $scoresheetId;
        $this->date = $date;
        $this->location = (string) $location;
        $this->home = (string) $home;
        $this->away = (string) $away;
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
     * @return mixed
     */
    public function location()
    {
        return $this->location;
    }

    /**
     * @return mixed
     */
    public function home()
    {
        return $this->home;
    }

    /**
     * @return mixed
     */
    public function away()
    {
        return $this->away;
    }

    public function reason()
    {
        return $this->reason;
    }
}