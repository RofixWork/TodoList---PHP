<?php

namespace Entities;

class Todo
{
    public int $Id;
    public string $TodoName;
    public readonly string $CreatedDate;

    public function __construct(int $id, string $todoName)
    {
        $this->Id = $id;
        $this->TodoName = $todoName;
        $date = date_create("now");
        $this->CreatedDate = date_format($date, "d-m-Y, h:i:s A");
    }

    function __toString(): string
    {
        return "{$this->Id}, {$this->TodoName} ({$this->CreatedDate})";
    }
}