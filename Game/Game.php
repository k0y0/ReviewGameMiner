<?php

namespace Game;

use Game\Map\GameMap;

class Game
{

    private $stringMap;     //map provided by user;
    private $game;           //GameMap::class

    public function __construct(string $map)
    {
        $this->game = new GameMap($map);
        echo $this->game->showStats();
    }


}
