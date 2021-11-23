<?php

namespace App;

interface DataSourceInterface
{
    public function getDataFrom(string $source): array;
    public function getCharacter(): array;
}
