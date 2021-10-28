<?php

namespace App\Management\Advanced;

final class Updater
{
    public function __construct(public string $name, public $callback)
    {
    }
}
