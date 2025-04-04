
<?php

class Repository{
    private $cnx;
    private $tableName;
    private $primaryKey;


    public function __construct($cnx, $tableName, $primaryKey, $columns) {
        $this->cnx = $cnx;
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
    }
    public function findAll() {
        $requette = "SELECT * FROM " . $this->tableName;
        $reponse = $this->cnx->prepare($requette);
        $reponse->execute();
        return $reponse->fetchAll(PDO::FETCH_ASSOC);
    }


    public function findById($id) {
        $requette = "SELECT * FROM " . $this->tableName . " WHERE " . $this->primaryKey . " = :id";
        $stmt = $this->cnx->prepare($requette);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteById($id) {
        $requette = "DELETE FROM " . $this->tableName . " WHERE " . $this->primaryKey . " = :id";
        $reponse = $this->cnx->prepare($requette);
        return $reponse->execute(['id' => $id]);
    }

    public function deleteByColumn($column, $value) {
        $requette = "DELETE FROM " . $this->tableName . " WHERE " . $column . " = :value";
        $reponse = $this->cnx->prepare($requette);
        return $reponse->execute(['value' => $value]);
    }
    
    /* cette fonction permet d'inserer une nouvelle ligne dans la table specifie par $this->tableName elle prend un tableau associatif $data  comme argument
 elle genere dynamiquement la requete sql insert avec des placeholders ensuite elle prepare et execute la requete à l'aide de PDO en utilisant les donnees fournies*/
   
 public function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $requette = "INSERT INTO " . $this->tableName . " ($columns) VALUES ($placeholders)";
        $reponse = $this->cnx->prepare($requette);
        return $reponse->execute($data);
    }

}

?>


