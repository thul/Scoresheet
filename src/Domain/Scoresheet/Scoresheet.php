<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

use Assert\Assertion;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Scoresheet extends EventSourcedAggregateRoot
{
    private $scoresheetId;

    private $date;

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return (string) $this->scoresheetId;
    }


    public static function startMatch($scoresheetId, $date, $location, $home, $away)
    {
        $scoresheet = new self;

        try {
            Assertion::uuid($scoresheetId);
            Assertion::string($location);
            Assertion::string($home);
            Assertion::string($away);
        } catch (\InvalidArgumentException $e) {
            die(':(');
        }

        $scoresheet->apply(
            new MatchStarted(
                $scoresheetId,
                $date,
                $location,
                $home,
                $away
            )
        );

        return $scoresheet;
    }

    /**
     * @param \Thul\Scoresheet\Domain\Scoresheet\MatchStarted $event
     */
    protected function applyMatchStarted(MatchStarted $event)
    {
        $this->scoresheetId = $event->scoresheetId();
        $this->date = $event->date();
        $this->location = $event->location();
        $this->home = $event->home();
        $this->away = $event->away();
    }
}