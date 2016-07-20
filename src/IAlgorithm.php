<?php

namespace Algorithm;

interface IAlgorithm
{
    /**
     * I want to provide a standard interface to the algorithm, but different algorithms may take
     * different parameter counts, etc.  For flexibility, I'm typehinting the param as a stdClass
     * so that future developers can customize how many parameters and how they are passed to the 
     * algorithm.  It is up to the developer to tell the IAlgorithm what to do with $data
     */
    public function calculate( \stdClass $data );
}
