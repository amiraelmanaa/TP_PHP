<?php
class Pokemon {
    protected $name;
    protected $url;
    protected $hp;
    protected $attackPokemon;

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;
    }
    public function getName() { return $this->name; }
    public function getHp() { return $this->hp; }
    public function isDead() { return $this->hp <= 0; }

    public function attack(Pokemon $p) {
        $attackPts = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        if ($this->attackPokemon->getProbabilitySpecialAttack() > 0.5) {
            $attackPts += $this->attackPokemon->getSpecialAttack();
        }
        $p->hp -= $attackPts;
        echo "{$this->name} attacks {$p->getName()} and deals {$attackPts} damage. <br>";
    }
}
?>