<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class MatchStarted
{

    private $scoresheetId;
    private $date;
    private $location;
    private $home;
    private $away;
    
    public function __construct($scoresheetId, $date, $location, $home, $away)
    {
        $this->scoresheetId = $scoresheetId;
        $this->date = $date;
        $this->location = (string) $location;
        $this->home = (string) $home;
        $this->away = (string) $away;
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
    
    
}