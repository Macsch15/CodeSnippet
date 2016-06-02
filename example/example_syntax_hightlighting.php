<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CodeSnippet Example</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/prism.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <?php
        require '../vendor/autoload.php';

        use CodeSnippet\Snippet;

        $snippet = new Snippet();
        $lines = $snippet
            ->file(__DIR__ . '/stubs/example.stub')
            ->start(23)
            ->length(8)
            ->toString('<br />');
        ?>

        <h1 class="text-center">CodeSnippet Example</h1>
        <h3 class="text-center">Snippet from file: <?= $snippet->getFilename() ?></h3>

        <div class="container">
            <pre data-start="<?= $snippet->startsFrom() ?>"><code class="language-js line-numbers"><?= $lines ?></code></pre>
        </div>

        <script src="assets/js/prism.js"></script>
    </body>
</html>
