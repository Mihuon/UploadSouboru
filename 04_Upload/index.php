<!DOCTYPE html>
<html lang="cs">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload souborů</title>
</head>
<body>
    <?php 
    if($_FILES)
    {
        $dir = 'uploads/';
        $file = $dir . basename($_FILES['Uname']['name']);
        $type = strtolower( pathinfo($file, PATHINFO_EXTENSION));

        echo $type;

        $fine = true;

        if($_FILES['Uname']['error'] != 0)
        {
            echo("Chyba při vkládání souboru<br>");
            $fine = false;
        }
        else if(file_exists($file))
        {
            echo("Soubor byl již vložen<br>");
            $fine = false;
        }
        else if($_FILES['Uname']['size'] >  8000000)
        {
            echo("Soubor je příliš velký<br>");
            $fine = false;
        }
        if(!$fine)
        {
            echo("Chyba při vkládání souboru<br>");
        }
        else
        {
            if(move_uploaded_file($_FILES['Uname']['tmp_name'], $file))
            {
                echo "Soubor " . basename($_FILES['Uname']['name']) . " byl úspěšně uložen<br>";
            }
            else
            { 
                echo "Chyba při ukládání souboru<br>";
            }
        }

        $t = explode("/", $_FILES['Uname']['type']);
        switch($t[0])
        {
            case "image":
                echo '<img src="'.$file.'" alt="Nahrany obrazek" width="50%">';
                break;
            case "audio":
                echo "jo";
                echo '<audio controls>
                <source src="'.$file.'">
              Your browser does not support the audio element.
              </audio>';
                break;
            case "video":
                echo '<video width="50%" controls>
                <source src="'.$type.'">
              Your browser does not support the video tag.
              </video>';
                break;
        }

    
    
    }
    ?>
    <div class="container">
        <form method='POST' action='' enctype='multipart/form-data' class="row g-3">
            <div class="mb-3">
            <label for='name' class="form-label"></label>
            <input type='file' name = 'Uname' id ='name' accept = 'image/*,audio/*,video/*' class="form-control"/>
            </div>
            <div class="mb-3">
            <input type = 'submit' value ='Nahrát' name ='submit' class="btn btn-primary mb-3"/>
            </div>
        </form>
        </div>
</body>
</html>