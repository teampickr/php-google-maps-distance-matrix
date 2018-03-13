<?php

namespace TeamPickr\DistanceMatrix\Response;

class Row
{
    /**
     * @var array
     */
    protected $row;

    /**
     * Row constructor.
     *
     * @param array $row
     */
    public function __construct(array $row)
    {
        $this->row = $row;
    }

    /**
     * @return array
     */
    public function elements()
    {
        $elements = $this->row['elements'];

        if(!count($elements)) {
            return [];
        }

        return array_map(function($element) {
            return new Element($element);
        }, $elements);
    }
}