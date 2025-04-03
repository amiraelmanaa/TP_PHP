<?php
class PokemonFeu extends Pokemon {
    public function attack(Pokemon $p) {
        $attackPts = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        if ($this->attackPokemon->getProbabilitySpecialAttack() > 0.5) {
            $attackPts += $this->attackPokemon->getSpecialAttack();
        }

        if ($p instanceof PokemonPlante) {
            $attackPts *= 2; // Super effective
        } elseif ($p instanceof PokemonEau || $p instanceof PokemonFeu) {
            $attackPts *= 0.5; // Not very effective
        }

        $p->hp -= $attackPts;
        echo "{$this->name} (Feu) attacks {$p->getName()} and deals {$attackPts} damage. <br>";
    }
}
?>