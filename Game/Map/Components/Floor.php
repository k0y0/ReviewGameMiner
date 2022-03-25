<?php

namespace Game\Map\Components;

class Floor
{
    public $level;

    public $stars = 0;
    public $visited;

    public function __construct(int $level, int $step = 0)
    {
        if($step == 0){
            $this->level = $level;
        }else{
            $this->level = "-".$level;
        }
        $this->visit($step);
    }

    public function visit(int $step): void
    {
        $this->visited[] = $step;
    }

    public function treasure(): void
    {
        $this->stars++;
    }

    public function stepsNeeded(): string
    {
        return $this->visited[0];
    }
}