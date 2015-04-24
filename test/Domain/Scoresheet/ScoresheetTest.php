<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

use Broadway\EventSourcing\Testing\AggregateRootScenarioTestCase;
use Broadway\UuidGenerator\Rfc4122\Version4Generator;

class ScoresheetTest extends AggregateRootScenarioTestCase
{
    /**
     * Returns a string representing the aggregate root
     *
     * @return string AggregateRoot
     */
    protected function getAggregateRootClass()
    {
        return Scoresheet::class;
    }

    /**
     * @return string
     */
    protected function uuid()
    {
        return (new Version4Generator)->generate();
    }

    private function date()
    {
        $date =  \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));
        return $date->format('Y-m-d H:i:s');
    }

    /**
     *
     */
    public function testMatchStarted()
    {
        $scoresheetId = $this->uuid();
        $date = $this->date();
        $location = 'Somewhere on planet earth';
        $home = 'team 1';
        $away = 'team 2';

        $this->scenario
            ->when(function() use ($scoresheetId, $date, $location, $home, $away) {
                return Scoresheet::startMatch(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                );
            })
            ->then([
               new MatchStarted(
                   $scoresheetId,
                   $date,
                   $location,
                   $home,
                   $away
               )
            ]);
    }

    public function testMatchedStartFailedMissingTeam()
    {
        $scoresheetId = $this->uuid();
        $date = $this->date();
        $location = 'Somewhere on planet earth';
        $home = 'team 1';
        $away = '';

        $this->scenario
            ->when(function() use ($scoresheetId, $date, $location, $home, $away) {
                return Scoresheet::startMatch(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                );
            })
            ->then([
                new MatchFailedToStart(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away,
                    'Value "" is empty, but non empty value was expected.'
                )
            ]);
    }

    public function testMatchedStartFailedMissingLocation()
    {
        $scoresheetId = $this->uuid();
        $date = $this->date();
        $location = '';
        $home = 'team 1';
        $away = 'team 2';

        $this->scenario
            ->when(function() use ($scoresheetId, $date, $location, $home, $away) {
                return Scoresheet::startMatch(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                );
            })
            ->then([
                new MatchFailedToStart(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away,
                    'Value "" is empty, but non empty value was expected.'
                )
            ]);
    }

    public function testMatchedStartFailedMissinUuid()
    {
        $scoresheetId = '';
        $date = $this->date();
        $location = 'Somewhere on earth';
        $home = 'team 1';
        $away = 'team 2';

        $this->scenario
            ->when(function() use ($scoresheetId, $date, $location, $home, $away) {
                return Scoresheet::startMatch(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                );
            })
            ->then([
                new MatchFailedToStart(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away,
                    'Value "" is not a valid UUID.'
                )
            ]);
    }

    public function testMatchEnded()
    {
        $scoresheetId = $this->uuid();
        $date = $this->date();
        $location = 'Somewhere on earth';
        $home = 'team 1';
        $away = 'team 2';

        $this->scenario
            ->withAggregateId($scoresheetId)
            ->given(array(
                new MatchStarted(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                )
            ))
            ->when(function ($scoresheet) use ($scoresheetId, $date) {
                return $scoresheet->stopMatch(
                    $scoresheetId,
                    $date
                );
            })
            ->then([
                new MatchEnded(
                    $scoresheetId,
                    $date
                )
            ]);
    }

    public function testMatchFailedToEndedDueToMissingUuid()
    {
        $scoresheetId = '';
        $date = $this->date();
        $location = 'Somewhere on earth';
        $home = 'team 1';
        $away = 'team 2';

        $this->scenario
            ->withAggregateId($scoresheetId)
            ->given(array(
                new MatchStarted(
                    $scoresheetId,
                    $date,
                    $location,
                    $home,
                    $away
                )
            ))
            ->when(function ($scoresheet) use ($scoresheetId, $date) {
                return $scoresheet->stopMatch(
                    $scoresheetId,
                    $date
                );
            })
            ->then([
                new MatchFailedToEnd(
                    $scoresheetId,
                    $date,
                    'Value "" is not a valid UUID.'
                )
            ]);
    }

    public function testGoalScored()
    {
        $scoresheetId = $this->uuid();
        $date = $this->date();


        $this->scenario
            ->withAggregateId($scoresheetId)
            ->given(array(new MatchStarted(
                    $scoresheetId,
                    $date,
                    'somewhere',
                    'home',
                    'away'
                )
            ))
            ->when(function ($scoresheet) use ($scoresheetId){

                /** @var \Thul\Scoresheet\Domain\Scoresheet\Scoresheet $scoresheet */
                $scoresheet->addGoal(
                    $scoresheetId,
                    $team = 'some team',
                    $goalScorer = '1',
                    $primaryAssist = '2',
                    $secondaryAssist = '3',
                    $time = '0:13',
                    $period = '1'
                );
            })
            ->then(array(
                new GoalScored(
                    $scoresheetId,
                    $team = 'some team',
                    $goalScorer = '1',
                    $primaryAssist = '2',
                    $secondaryAssist = '3',
                    $period = '1',
                    $time = '0:13'
                )
            ));
    }
}