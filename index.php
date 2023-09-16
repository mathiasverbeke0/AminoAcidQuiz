<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheet.css">
    <title>Amino Acids</title>
</head>
<body>

    <h1>Amino Acid Quiz</h1>

    <form action="quiz.php" method="GET">
        
        <label for="given">We give</label>
        <select name="given" id="given">
            <option value="1">One Letter Code</option>
            <option value="3">Three Letter Code</option>
            <option value="full" selected>Full Name</option>
            <option value="image">Image</option>
        </select>
        <br><br>
        
        <label for="answer">You answer</label>
        <select name="answer" id="answer">
            <option value="1">One Letter Code</option>
            <option value="3">Three Letter Code</option>
            <option value="full">Full Name</option>
        </select>
        <br>
        <input type="submit" value="Start Quiz">
    </form>

    <div class="footer">
        <a href="https://github.com/mathiasverbeke0" target="_blank">About</a>
        <a href="mailto:mathias.verbeke@howest.be">Contact</a>
    </div>

</body>
</html>