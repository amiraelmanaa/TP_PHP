<?php 
class PokemonPlante extends Pokemon {
    public function attack(Pokemon $p) {
        $attackPts = rand($this->attackPokemon->getAttackMinimal(), $this->attackPokemon->getAttackMaximal());
        if ($this->attackPokemon->getProbabilitySpecialAttack() > 0.5) {
            $attackPts += $this->attackPokemon->getSpecialAttack();
        }

        if ($p instanceof PokemonEau) {
            $attackPts *= 2;
        } elseif ($p instanceof PokemonPlante || $p instanceof PokemonFeu) {
            $attackPts *= 0.5;
        }

        $p->hp -= $attackPts;
        echo "{$this->name} (Plante) attacks {$p->getName()} and deals {$attackPts} damage. <br>";
    }
}
?>