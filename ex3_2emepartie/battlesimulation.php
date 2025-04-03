<?php
if (isset($_POST['replay'])) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
include 'pokemons.php';
include 'attack.php';
include 'pokemoneau.php';
include 'pokemonplante.php';
include 'pokemon_feu.php';
$effectiveness = [
    "Feu" => ["Plante" => 2, "Eau" => 0.5, "Feu" => 0.5, "Normal" => 1],
    "Eau" => ["Feu" => 2, "Plante" => 0.5, "Eau" => 0.5, "Normal" => 1],
    "Plante" => ["Eau" => 2, "Feu" => 0.5, "Plante" => 0.5, "Normal" => 1],
    "Normal" => ["Feu" => 1, "Eau" => 1, "Plante" => 1, "Normal" => 1]
];

$pokemonEmojis = [
    "Feu" => "🔥",
    "Eau" => "💧",
    "Plante" => "🌿",
    "Normal" => "⭐"
];
$battleLog = "";
$winner = "";
$showBattle = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pokemon1'], $_POST['pokemon2'])) {
    $pokemon1Type = $_POST['pokemon1'];
    $pokemon2Type = $_POST['pokemon2'];
    $hp1 = 100;
    $hp2 = 100;
    $attackMin = 10;
    $attackMax = 20;
    while ($hp1 > 0 && $hp2 > 0) {
        $attack = rand($attackMin, $attackMax) * $effectiveness[$pokemon1Type][$pokemon2Type];
        $hp2 -= $attack;
        $battleLog .= "🗡️ $pokemon1Type attacks $pokemon2Type for $attack damage!<br>";

        if ($hp2 <= 0) break;

        $attack = rand($attackMin, $attackMax) * $effectiveness[$pokemon2Type][$pokemon1Type];
        $hp1 -= $attack;
        $battleLog .= "🗡️ $pokemon2Type attacks $pokemon1Type for $attack damage!<br>";
    }

    $winner = ($hp1 > 0) ? $pokemon1Type : $pokemon2Type;
    $showBattle = true;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokemon Battle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f8f8;
        }
        .container {
            margin: 50px auto;
            width: 50%;
            padding: 20px;
            background: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .battle-area {
            display: <?= $showBattle ? "block" : "none" ?>;
            margin-top: 20px;
        }
        .pokemon {
            font-size: 50px;
            margin: 20px;
        }
        .vs {
            font-size: 30px;
            margin: 20px;
        }
        .battle-button, .replay-button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
            margin-top: 20px;
        }
        .battle-button:hover, .replay-button:hover {
            background-color: #45a049;
        }
        .result-area {
            display: <?= $showBattle ? "block" : "none" ?>;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Pokémon Battle Arena</h1>
    <div id="selection" <?= $showBattle ? 'style="display:none;"' : '' ?>>
        <label>Choose Pokémon 1:</label>
        <select id="pokemon1">
            <option value="Feu">🔥 Feu</option>
            <option value="Eau">💧 Eau</option>
            <option value="Plante">🌿 Plante</option>
            <option value="Normal">⭐ Normal</option>
        </select>

        <label>Choose Pokémon 2:</label>
        <select id="pokemon2">
            <option value="Feu">🔥 Feu</option>
            <option value="Eau">💧 Eau</option>
            <option value="Plante">🌿 Plante</option>
            <option value="Normal">⭐ Normal</option>
        </select>

        <button class="battle-button" onclick="startBattle()">Start Battle</button>
    </div>
    <div id="battle-area" class="battle-area">
        <div class="pokemon" id="pokemon1-display"><?= $showBattle ? $pokemonEmojis[$_POST['pokemon1']] : "" ?></div>
        <div class="vs">⚔️</div>
        <div class="pokemon" id="pokemon2-display"><?= $showBattle ? $pokemonEmojis[$_POST['pokemon2']] : "" ?></div>
        <form method="post" id="battle-form">
            <input type="hidden" name="pokemon1" id="pokemon1-hidden" value="<?= $_POST['pokemon1'] ?? '' ?>">
            <input type="hidden" name="pokemon2" id="pokemon2-hidden" value="<?= $_POST['pokemon2'] ?? '' ?>">
            <button type="submit" class="battle-button">Battle!</button>
        </form>
    </div>
    <?php if ($showBattle): ?>
        <div id="result-area" class="result-area">
            <h2>🏆 Winner: <?= $winner ?>!</h2>
            <p><?= $battleLog ?></p>
            <form method="post">
                <button type="submit" name="replay" class="replay-button">Replay</button>
            </form>
        </div>
    <?php endif; ?>
</div>
<script>
function startBattle() {
    let pokemon1 = document.getElementById("pokemon1").value;
    let pokemon2 = document.getElementById("pokemon2").value;
    
    let emojiMap = {
        "Feu": "🔥",
        "Eau": "💧",
        "Plante": "🌿",
        "Normal": "⭐"
    };
    document.getElementById("pokemon1-display").innerHTML = emojiMap[pokemon1];
    document.getElementById("pokemon2-display").innerHTML = emojiMap[pokemon2];
    document.getElementById("pokemon1-hidden").value = pokemon1;
    document.getElementById("pokemon2-hidden").value = pokemon2;
    document.getElementById("selection").style.display = "none";
    document.getElementById("battle-area").style.display = "block";
}
</script>
</body>
</html>
