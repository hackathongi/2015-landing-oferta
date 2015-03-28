<?php

    $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $actual_link = $_SERVER['REQUEST_URI'];
    
    $parts = explode('/', $actual_link);
    array_pop($parts);
    $last = end($parts);
 
    $last = 1;
 
    $url = "http://apic.wallyjobs.com/jobs/" . $last;
        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL,$url);
    $result=curl_exec($ch);
    curl_close($ch);

    $job = json_decode($result, true);
    // print_r('<pre>');
    // print_r($job);
    // print_r('</pre>');

?>

<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title><?php echo $job["title"] . ' | WallyJobs'; ?></title>

    <meta property="og:type" content="website">
        <meta property="og:url" content="<?php echo $currentUrl; ?>">
        <meta property="og:title" content="<?php echo $job['title']; ?>">
        <meta property="og:description" content="<?php echo $job['description']; ?>">
        <meta property="og:image" content="<?php echo $job['picture_url']; ?>">

        <meta property="twitter:card" content="summary">
        <meta property="twitter:url" content="<?php echo $currentUrl; ?>">
        <meta property="twitter:title" content="<?php echo $job['title']; ?>">
        <meta property="twitter:description" content="<?php echo $job['description']; ?>">
        <meta property="twitter:image" content="<?php echo $job['picture_url']; ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="css/hackajobs-stylesheet.css" rel="stylesheet">
</head>
<body>

<header>

    <div class="container">
        <div class="wally-logo">
            <img src="img/wallyJobsLogoHor.svg" alt="WallyJobs"/>
        </div>
        <div class="clearfix"></div>
    </div>

</header>

<main>
    <div class="container">
        <article class="job-offer offer">
            <h1 class="offer-title"><?php echo $job['title']; ?></h1>
            <div class="offer-share">
                <a class="share-facebook" href="#">Facebook</a>
                <a class="share-twitter" href="#">Twitter</a>
            </div>
            <div class="offer-image">
                <img src="http://lorempixel.com/g/640/360/" alt="Titol Oferta"/>
            </div>
            <div class="offer-description">
                <p><?php echo $job['description']; ?></p>
            </div>
            <hr/>
            <div class="offer-details">
                <div class="offer-author-image">
                    <img src="http://lorempixel.com/g/240/240/" alt="Joan Vilajoana"/>
                </div>
                <dl class="offer-author">
                    <dt>Author:</dt>
                    <dd>
                        <a href="#" target="_blank"><?php echo $job['owner']['name']; ?></a>
                    </dd>
                </dl>
                <dl class="offer-date-start">
                    <dt>Publicada:</dt>
                    <dd><?php echo date('d-m-Y', strtotime($job['start_date'])); ?></dd>
                </dl>
                <dl class="offer-date-end">
                    <dt>End:</dt>
                    <dd><?php echo date('d-m-Y', strtotime($job['end_date'])); ?></dd>
                </dl>
                <dl class="offer-location">
                    <dt>Ciutat:</dt>
                    <dd><?php echo $job['city']; ?></dd>
                </dl>
            </div>
            <hr/>
            <div class="offer-apply">
                <a class="btn btn-primary btn-lg" href="#">Apply</a>
            </div>
        </article>
    </div>

</main>

<footer>
    <p class="small">©2015 Bla bla bla, ...</p>
</footer>



<script type="text/javascript" src="js/hackajobs-stylesheet-dependencies.js"></script>

</body>
</html>