<?php
 class Etudiant{
    private string $nom;

    private  $notes= array();

    public function __construct(string $nom="",  $notes=[]){
        $this->nom = $nom;
        $this->notes = $notes;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getNotes(): array {
        return $this->notes;
    }
    public function setNom(string $nom): void {
        $this->nom = $nom;
    }
   
  
    
    public function AjouterNote(): void {
        echo "Entrer le nom du la matiere : ";
        $matiere = readline();
        echo "Entrer la note : ";
        $note = readline();
        $this->notes[$matiere] = $note;

    }

    public function AfficherNotes(): void {
        echo "Les notes de l'étudiant ".$this->nom." : \n";
        foreach ($this->notes as $matiere => $note) {
            echo $matiere . ": " . $note . "\n";


            
        }
    }
    public function CalculMoyenne(): float {
        $somme = 0;
        $nbnotes = count($this->notes);
        if ($nbnotes == 0) {
            return 0;
        }
        foreach ($this->notes as $note) {
            $somme += $note;
        }
        return $somme / $nbnotes;
    }
    
    public function admis():bool {
        $moyenne = $this->CalculMoyenne();
        if ($moyenne >= 10) {
  
            return true;
           
        } else {

            return false;
            
        }
    }

}


?>