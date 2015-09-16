<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

class PenaltyAdded
{
    private $scoresheetId;
    private $team;
    private $player;
    private $penalty;
    private $time;
    private $period;
    private $penaltyTime;

    public function __construct($scoresheetId, $team, $player, $penalty, $time, $period, $penaltyTime)
    {
        $this->scoresheetId = $scoresheetId;
        $this->team = $team;
        $this->player = $player;
        $this->penalty = $penalty;
        $this->time = $time;
        $this->period = $period;
        $this->penaltyTime = $penaltyTime;
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
    public function player()
    {
        return $this->player;
    }

    /**
     * @return mixed
     */
    public function penalty()
    {
        return $this->penalty;
    }

    /**
     * @return mixed
     */
    public function time()
    {
        return $this->time;
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
    public function penaltyTime()
    {
        return $this->penaltyTime;
    }


}