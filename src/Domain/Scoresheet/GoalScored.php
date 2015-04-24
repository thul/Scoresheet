<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class GoalScored 
{
    private $scoresheetId;
    private $team;
    private $goalScorer;
    private $primaryAssist;
    private $secondaryAssist;
    private $period;
    private $time;

    public function __construct($scoresheetId, $team, $goalScorer, $primaryAssist, $secondaryAssist, $period, $time)
    {
        $this->scoresheetId = $scoresheetId;
        $this->team = $team;
        $this->goalScorer = $goalScorer;
        $this->primaryAssist = $primaryAssist;
        $this->secondaryAssist = $secondaryAssist;
        $this->period = $period;
        $this->time = $time;
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
    public function team()
    {
        return $this->team;
    }

    /**
     * @return mixed
     */
    public function goalScorer()
    {
        return $this->goalScorer;
    }

    /**
     * @return mixed
     */
    public function primaryAssist()
    {
        return $this->primaryAssist;
    }

    /**
     * @return mixed
     */
    public function secondaryAssist()
    {
        return $this->secondaryAssist;
    }

    /**
     * @return mixed
     */
    public function period()
    {
        return $this->period;
    }

    /**
     * @return mixed
     */
    public function time()
    {
        return $this->time;
    }
    
    

}