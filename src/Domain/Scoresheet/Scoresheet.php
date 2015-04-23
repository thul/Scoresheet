<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

use Assert\Assertion;
use Broadway\EventSourcing\EventSourcedAggregateRoot;

class Scoresheet extends EventSourcedAggregateRoot
{
    private $scoresheetId;

    private $date;

    private $reason;

    /**
     * @return string
     */
    public function getAggregateRootId()
    {
        return (string) $this->scoresheetId;
    }

    /**
     * @param $scoresheetId
     * @param $date
     * @param $location
     * @param $home
     * @param $away
     * @return \Thul\Scoresheet\Domain\Scoresheet\Scoresheet
     */
    public static function startMatch($scoresheetId, $date, $location, $home, $away)
    {
        $scoresheet = new self;

        try {
            Assertion::uuid($scoresheetId);

            Assertion::string($location);
            Assertion::notEmpty($location);

            Assertion::string($home);
            Assertion::notEmpty($home);

            Assertion::string($away);
            Assertion::notEmpty($away);

        } catch (\InvalidArgumentException $e) {
            $scoresheet->apply(
                new MatchFailedToStart(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away,
                    $e->getMessage()
                )
            );

            return $scoresheet;
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
     * @param $scoresheetId
     * @param $date
     */
    public function stopMatch($scoresheetId, $date)
    {
        try {
            Assertion::uuid($scoresheetId);
        } catch (\InvalidArgumentException $e) {
            $this->apply(
                new MatchFailedToEnd(
                    $scoresheetId,
                    $date,
                    $e->getMessage()
                )
            );
            return;
        }
        $this->apply(new MatchEnded(
                $scoresheetId,
                $date
            )
        );


    }

    /**
     * @param \Thul\Scoresheet\Domain\Scoresheet\MatchStarted $event
     */
    protected function applyMatchStarted(MatchStarted $event)
    {
        $this->scoresheetId = $event->scoresheetId();
        $this->date = $event->date();
    }

    /**
     * @param \Thul\Scoresheet\Domain\Scoresheet\MatchEnded $event
     */
    protected function applyMatchEnded(MatchEnded $event)
    {
        $this->scoresheetId = $event->scoresheetId();
        $this->date = $event->date();
    }

    /**
     * @param \Thul\Scoresheet\Domain\Scoresheet\MatchFailedToEnd $event
     */
    protected function applyMatchFailedToEnd(MatchFailedToEnd $event)
    {
        $this->scoresheetId = $event->scoresheetId();
        $this->date = $event->date();
        $this->reason = $event->reason();
    }

    /**
     * @param \Thul\Scoresheet\Domain\Scoresheet\MatchFailedToStart $event
     */
    protected function applyMatchFailedToStart(MatchFailedToStart $event)
    {
        $this->scoresheetId = $event->scoresheetId();
        $this->reason = $event->reason();
    }
}