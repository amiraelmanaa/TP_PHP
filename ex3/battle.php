<?php
include 'Pokemon.php';
include 'AttackPokemon.php';

$pokemon1 = new Pokemon("Pikachu", "pika.jpg", 100, new AttackPokemon(10, 20, 5, 0.7));
$pokemon2 = new Pokemon("Bulbasaur", "buu.jpg", 100, new AttackPokemon(8, 15, 3, 0.5));
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(167, 218, 134);
            margin: 0;
            padding: 20px;
        }
        #container {
            display: flex;
            justify-content: space-between;
        }
        #pok1, #pok2, #battle {
            border: 1px solid #ccc;
            padding: 20px;
            margin-bottom: 20px;
            width: 45%;
            background-color: #fff;
        }
        h1 {
            color: #333;
        }
        img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>

    <div id="container">
        <div id="pok1">
            <h1><?php echo $pokemon1->getName(); ?></h1>
            <img src="<?php echo $pokemon1->getUrl(); ?>" alt="Pokemon 1">
            <p>HP: <?php echo $pokemon1->getHp(); ?></p>
            <p>Attack Minimal: <?php echo $pokemon1->getAttackPokemon()->getAttackMinimal(); ?></p>
            <p>Attack Maximal: <?php echo $pokemon1->getAttackPokemon()->getAttackMaximal(); ?></p>
            <p>Special Attack: <?php echo $pokemon1->getAttackPokemon()->getSpecialAttack(); ?></p>
        </div>

        <div id="pok2">
            <h1><?php echo $pokemon2->getName(); ?></h1>
            <img src="<?php echo $pokemon2->getUrl(); ?>" alt="Pokemon 2">
            <p>HP: <?php echo $pokemon2->getHp(); ?></p>
            <p>Attack Minimal: <?php echo $pokemon2->getAttackPokemon()->getAttackMinimal(); ?></p>
            <p>Attack Maximal: <?php echo $pokemon2->getAttackPokemon()->getAttackMaximal(); ?></p>
            <p>Special Attack: <?php echo $pokemon2->getAttackPokemon()->getSpecialAttack(); ?></p>
        </div>
    </div>

    <div>
        <input type="button" value="Start Battle" id="start">
        <form method="post" action="battle.php">
    <br><br>
    <input type="submit" value="restart" name="reset" id="reset">
    
</form>
    </div>

    <div id="battle" style="display: none;">
        <h2>Battle</h2>
        <p id="battle-status"></p> <!-- Affiche les messages de progression -->
        <div id="battle-result" style="display: none;">
            <h3>Battle Result</h3>
            <?php
            while (!$pokemon1->isDead() && !$pokemon2->isDead()) {
                $pokemon1->attack($pokemon2);
                if (!$pokemon2->isDead()) {
                    $pokemon2->attack($pokemon1);
                }
            }
            ?>
            <?php if ($pokemon1->isDead()) { ?>
                <p><?php echo $pokemon1->getName(); ?> is dead!</p>
            <?php } else { ?>
                <p><?php echo $pokemon2->getName(); ?> is dead!</p>
            <?php } ?>
        </div>
    </div>

    <script>
        document.getElementById("start").addEventListener("click", function() {
            let battleDiv = document.getElementById("battle");
            let battleStatus = document.getElementById("battle-status");
            let battleResult = document.getElementById("battle-result");

            // 1️⃣ Afficher la section de combat immédiatement avec "Battle in Progress..."
            battleDiv.style.display = "block";
            battleStatus.innerHTML = "<h2>Battle in Progress...</h2>";

            // 2️⃣ Après 2 secondes, afficher "Battle Finished"
            setTimeout(function() {
                battleStatus.innerHTML = "<h2>Battle Finished</h2>";
            }, 2000);

            // 3️⃣ Après 4 secondes, afficher le résultat du combat en PHP
            setTimeout(function() {
                battleResult.style.display = "block";
            }, 4000);
        });
    </script>
    
<?php
if (isset($_POST["reset"])) {
    // Reload the page to reset the battle
    header("Location: battle.php");
    exit();
}
?>

</body>
</html>
