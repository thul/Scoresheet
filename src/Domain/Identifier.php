<?php

namespace Thul\Scoresheet\Domain;

interface Identifier
{

    /**
     * @return string
     */
    public function __toString();
}