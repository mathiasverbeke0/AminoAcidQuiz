<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Amino Acids</title>

    <style>
        <?php

            # If the user has submitted the form
            if(isset($_POST["submitAnswer"])){
                # Get the score
                $score = (int)$_POST["score"] ?? 0;

                if(strtolower($_POST["yourAnswer"]) == strtolower($_POST["correctAnswer"])){
                    echo "body {background: #A7D7C5;}";
                    $score += 1;
                }
                else{
                    echo "body {background: #F7B3A3;}";
                }
            }
        ?>
    </style>
</head>
<body>

<?php
    # If the given and answer types are the same, the quiz is over
    if($_GET["given"] == $_GET["answer"]){
        echo "<div class='finish'>";
        echo "<h1>Nice try</h1>";
        echo "What's given and what you answer cannot be the same thing.<br><br>";
        echo "<a href=\"index.php\">Start Over</a>";
        echo "</div>";
        die();
    }

    # List of amino acids (full name => [1-letter code, 3-letter code, full name, image])
    $amino_acids = [
        "Alanine" => ["A", "Ala", "Alanine", "Images/ala.gif"],
        "Arginine" => ["R", "Arg", "Arginine", "Images/arg.gif"],
        "Asparagine" => ["N", "Asn", "Asparagine", "Images/asn.gif"],
        "Aspartic Acid" => ["D", "Asp", "Aspartic Acid", "Images/asp.gif"],
        "Cysteine" => ["C", "Cys", "Cysteine", "Images/cys.gif"],
        "Glutamic Acid" => ["E", "Glu", "Glutamic Acid", "Images/glu.gif"],
        "Glutamine" => ["Q", "Gln", "Glutamine", "Images/gln.gif"],
        "Glycine" => ["G", "Gly", "Glycine", "Images/gly.gif"],
        "Histidine" => ["H", "His", "Histidine", "Images/his.gif"],
        "Isoleucine" => ["I", "Ile", "Isoleucine", "Images/ile.gif"],
        "Leucine" => ["L", "Leu", "Leucine", "Images/leu.gif"],
        "Lysine" => ["K", "Lys", "Lysine", "Images/lys.gif"],
        "Methionine" => ["M", "Met", "Methionine", "Images/met.gif"],
        "Phenylalanine" => ["F", "Phe", "Phenylalanine", "Images/phe.gif"],
        "Proline" => ["P", "Pro", "Proline", "Images/pro.gif"],
        "Serine" => ["S", "Ser", "Serine", "Images/ser.gif"],
        "Threonine" => ["T", "Thr", "Threonine", "Images/thr.gif"],
        "Tryptophan" => ["W", "Trp", "Tryptophan", "Images/trp.gif"],
        "Tyrosine" => ["Y", "Tyr", "Tyrosine", "Images/tyr.gif"],
        "Valine" => ["V", "Val", "Valine", "Images/val.gif"]
    ];

    # List of questions (question => answer)
    $questions = [
    "1" => "What is the one-letter code for ",
    "3" => "What is the three-letter code for ",
    "full" => "What is the full name for ",
    ];

    # Q&A locations in the amino acid array
    $locations = [
        "1" => 0,
        "3" => 1,
        "full" => 2,
        "image" => 3
    ];

    # If the user has submitted the form
    if ((isset($_GET["given"]) && isset($_GET["answer"])) || isset($_POST["submitAnswer"])) {
          
        # Get the question and answer types
        $given_code = $_GET["given"] ?? $_POST["given"];
        $answer_code = $_GET["answer"] ?? $_POST["answer"];

        # Set a variable that keeps track of all amino acids that have already been used
        $usedAcids = $_POST["usedAcids"] ?? [];

        # Remove all acids from the list that have already been used
        foreach($usedAcids as $acid){
            if(in_array($acid, $usedAcids)){
                unset($amino_acids[$acid]);
            }
        }

        # If there are no more acids left, the quiz is over
        if(count($amino_acids) == 0){
            echo "<div class='finish'>";
            echo "<h1>Quiz Over</h1>";
            echo "<h2>You scored $score/20</h2>";
            echo "<a href=\"index.php\">Start Over</a>";
            echo "</div>";
            die();
        }

        # Get all remaining amino acids
        $allAcids = array_keys($amino_acids);

        # Get a random amino acid
        $amino_acid = $allAcids[rand(0, count($allAcids) - 1)];

        # Get the correct amino acid format for the question
        $givenAcid = $amino_acids[$amino_acid][$locations[$given_code]];
        
        # Get the fist amino acid correct answer
        $correctAnswer = $amino_acids[$amino_acid][$locations[$answer_code]];
        
        # Construct the question
        if($given_code == "image"){
            $question = $questions[$answer_code] . "<br>" . "<img src=\"" . $amino_acids[$amino_acid][$locations[$given_code]] . "\" alt=\"Image of " . $amino_acid . "\" width= 100%>";
        }
        else{
            $question = $questions[$answer_code] . $givenAcid . "?";
        }

        # Print the question
        echo "
        <form action=\"#\" method=\"POST\">
            <label>$question</label>
            <br><br>
            <label for=\"yourAnswer\">Your answer</label><br>
            <input name= \"yourAnswer\" type=\"text\">
            <br><br>
            <input name=\"score\" type=\"hidden\" value=\"$score\">
            <input name=\"answer\" type=\"hidden\" value=\"$question_code\">
            <input name=\"question\" type=\"hidden\" value=\"$answer_code\">
            <input name=\"correctAnswer\" type=\"hidden\" value=\"$correctAnswer\">";

        # Send the list of used acids via POST
        if(isset($_POST["usedAcids"])){
            foreach($_POST["usedAcids"] as $acid){
                echo "<input name=\"usedAcids[]\" type=\"hidden\" value=\"$acid\">";
            }
        }
        echo "
            <input name=\"usedAcids[]\" type=\"hidden\" value=\"$amino_acid\">
            <input name=\"submitAnswer\" type=\"submit\" value = \"Submit Answer\">
        </form>";

        echo "<br><br>";

        # Print the answer if the user has submitted the form and the answer is incorrect
        if(isset($_POST["submitAnswer"]) && strtolower($_POST["yourAnswer"]) != strtolower($_POST["correctAnswer"])){
            echo "<div style='margin-top: 5px;'>The correct answer was " . $_POST["correctAnswer"] ."</div>";
        }
    }
    ?>
</body>
</html>


