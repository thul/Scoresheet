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

    public function testMatchStarted()
    {
        $scoresheetId = $this->uuid();
        $date = \DateTimeImmutable::createFromFormat('y-m-d h:i:s', time());
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

}