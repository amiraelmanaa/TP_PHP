<?php
class Pokemon{
    private $name;
    private $url;
    private $hp;
    private $attackPokemon;

   

    public function __construct($name, $url, $hp, AttackPokemon $attackPokemon) {
        $this->name = $name;
        $this->url = $url;
        $this->hp = $hp;
        $this->attackPokemon = $attackPokemon;   
    }

    public function getName() {
        return $this->name;
    }
    public function getUrl() {
        return $this->url;
    }
    public function getHp() {
        return $this->hp;
    }
    public function getAttackPokemon() {
        return $this->attackPokemon;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setUrl($url) {
        $this->url = $url;
    }
    public function setHp($hp) {
        $this->hp = $hp;
    }
    public function setAttackPokemon($attackPokemon) {
        $this->attackPokemon = $attackPokemon;
    }
    
    public function isDead(): bool{
        if($this->hp <= 0){
            return true;
        }else{
            return false;
        }

    }
    public function attack(Pokemon $p){
        // nakhtar nombre random bin min w max
        $attackpts = rand($this->attackPokemon->getAttackMinimal(),$this->attackPokemon->getAttackMaximal());
        if( $this->attackPokemon->getProbabilitySpecialAttack() > 0.5){
            $attackpts += $this->attackPokemon->getSpecialAttack();
        }
        $p->setHp($p->getHp() - $attackpts);
        if(($p->getHp()) > $this->hp){
            $p->setHp(0);
        }
        if($p->isDead()){
            echo $this->name . " has killed " . $p->getName() . "<br>";
        }else{
            echo $this->name . " has attacked " . $p->getName() . " and caused " . $attackpts . " damage. <br>";
        }
        echo $p->getName() . " has " . $p->getHp() . " HP left. <br>";


    }



    public function whoAmI(){
        return "Name: " . $this->name . ", URL: " . $this->url . ", HP: " . $this->hp . ", AttackPokemon: " . $this->attackPokemon::info();
    }


}



?>