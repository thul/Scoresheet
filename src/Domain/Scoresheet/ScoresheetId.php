<?php

namespace Thul\Scoresheet\Domain\Scoresheet;

use Thul\Scoresheet\Domain\Identifier;

class ScoresheetId implements Identifier
{
    private $id;

    public function __construct($id)
    {
        $this->id = (string) $id;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id;
    }


}