<?php
$command = escapeshellcmd('python3 code/Query.py ' . $_POST['t'] . ' ' . $_POST['s']);
$output = shell_exec($command);
//$datas = json_decode($output, true);
$contentPart = json_decode($output, true);
for ($i = 0; $i < count($contentPart); $i++) :
    $syntax = shell_exec("cat data/crawling/" . $contentPart[$i]['doc']);
    $datas = explode("\n", $syntax);
    $contentPart[$i]['title'] = $datas[0];
    $contentPart[$i]['content'] = '';
    for ($j = 1; $j < count($datas); $j++) {
        $contentPart[$i]['content'] .= $datas[$j];
    }
endfor;
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/style.css">

    <title>Q-News</title>
</head>

<body>

    <h1 style="color: Red" class="text-center">QAN - News</h1>
    <div class="container">
        <form action="" method="POST">
            <div class="row">
                <div class="form-group col-10 row">
                    <div class="col-10">
                        <input type="text" class="form-control" name="s" placeholder="Cari berita..." value="<?= htmlspecialchars($_POST['s']); ?>">
                    </div>
                    <div class="col-2">
                        <input type="number" class="form-control" name="t" value="<?php echo htmlspecialchars($_POST['t']); ?>">
                    </div>
                </div>
                <div class="col-2">
                    <input type="submit" class="btn btn-success btn-block" value="Cari">
                </div>
            </div>
        </form>

        <?php foreach ($contentPart as $data) : ?>
            <div class="card my-1">
                <div class="card-body">
                    <a class="link" href="<?= $data['url'] ?>"><?= $data['title'] ?></a>
                    <br>
                    <div class="url-link">
                        <?= $data['url'] ?>
                    </div>
                    <div class="content text-dark">
                        <?= $data['content'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>