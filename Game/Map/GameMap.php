<?php

namespace Game\Map;

use Game\Map\Components\Floor;
use Game\Map\Exception\MapException;

class GameMap
{
    protected const MOVE_TREASURE = "*";
    protected const MOVE_LADDER_UP = ")";
    protected const MOVE_LADDER_DOWN = "(";

    private const AllowedMapFields = array(
        "*",
        "(",
        ")"
    );

    public $map;
    public $floors;

    public $treasures;

    private $stepCounter;
    private $currentFloor;

    public function __construct(string $map)
    {
        try {
            $this->map = $this->validateMap($map);
        }catch (MapException $e){
            echo $e;
        }

        $this->stepCounter = 0;
        $this->currentFloor = 0;
        $startingFloor = new Floor($this->getStep());
        $this->nextStep();
        $this->floors = array(0 => $startingFloor);
        $this->makeFloors();

    }

    private function makeFloors(): void
    {
        $map = $this->map;

        foreach ($map as $step){
            $it = $this->getStep();
            switch ($step){
                case self::MOVE_LADDER_UP:
                    $this->makeMove(1);
                    break;
                case self::MOVE_LADDER_DOWN:
                    $this->makeMove(-1);
                    break;
                case self::MOVE_TREASURE:
                    $this->makeMove(0);
                    break;
            }
            $this->nextStep();
        }
    }

    private function makeMove(int $move): void
    {
        $step = $this->getStep();
        $floor = $this->currentFloor;
        if($move === 1){
            $floor -= 1;
            if($floor < 0){
                throw new MapException("dig above groud? LOL its stupid");
            }
            if($this->floorExists($floor)) {
                $this->floors[$floor]->visit($step);
            }
        }elseif ($move === -1){
            $floor += 1;
            if($this->floorExists($floor)){
                $this->floors[$floor]->visit($step);
            }else{
                $this->floors[$floor] = new Floor($floor, $step);
            }
        }else{
            $this->floors[$floor]->visit($step);
            $this->floors[$floor]->treasure();
            $this->treasures++;
        }
        $this->currentFloor = $floor;
    }

    public function showStats(): string
    {
        $str = "Mapa zawiera ".PHP_EOL;
        $str .= "- ".sizeof($this->map)." kroków.".PHP_EOL;
        $str .= "- ".$this->treasures." skarbów.".PHP_EOL;
        $str .= "---- ".PHP_EOL;
        $bestFloor = $this->findMostEfficientFloor();
        $str .= "Najwięcej skarbów jest na piętrze: ".$bestFloor["floor"].PHP_EOL;
        $str .= "bo aż: ".$bestFloor["stars"].PHP_EOL;
        $str .= "kroki potrzebne by tam dotrzeć to: ".$bestFloor["steps"].PHP_EOL;
        $str .= "---- ".PHP_EOL;
        $str .= "Wojtek Sarzec ©".PHP_EOL;

        return $str;
    }

    public function findMostEfficientFloor(): array
    {
        $maxStars = 0;
        $atFloor = 0;
        $stepsNeeded = 0;
        foreach ($this->floors as $floor) {
            if($floor->stars > $maxStars){
                $maxStars = $floor->stars;
                $atFloor = $floor->level;
                $stepsNeeded = $floor->stepsNeeded();
            }
        }

        return array(
            "floor" => $atFloor,
            "stars" => $maxStars,
            "steps" => $stepsNeeded
        );
    }
    private function floorExists(int $test): bool
    {
        foreach($this->floors as $floor => $obj){
            if($floor === $test){
                return true;
            }
        }
        return false;
    }
    public function nextStep(): void
    {
        $this->stepCounter++;
    }
    public function getStep(): int
    {
        return $this->stepCounter;
    }

    /**
     * @param string $map
     * @return array
     * @throws MapException
     * validates map, throws error on failed validation.
     */
    private function validateMap(string $world): array
    {
        $allowedChars = array(
            "*",
            "(",
            ")"
        );

        if(empty($world)){
            throw new MapException("provided empty map");
        }

        $a = str_split($world);
        $t = array_flip($a);
        foreach ($t as $char => $count){
            foreach ($allowedChars as $allowed){
                if($char == $allowed){
                    continue 2;
                }
            }
            throw new MapException("provided map contains un allowed characters ");
        }

        return $a;
    }

}

