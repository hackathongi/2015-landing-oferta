<?php

    $currentUrl = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $actual_link = $_SERVER['REQUEST_URI'];
    
    $parts = explode('/', $actual_link);

    $hash = '';
    if(preg_match('|/([^/]+)/?$|', $actual_link, $parts)) {
        $hash = $parts[1];
    }

    // $hash = 1;
 
    $url = "https://api.wallyjobs.com/jobs/" . $hash;
        
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERSION, 3);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_HEADER, 1);
    // curl_setopt($ch, CURLOPT_VERBOSE, true);
    $result = curl_exec($ch);
    curl_close($ch);

    print_r('<pre>');
    print_r($result);
    print_r('</pre>');

    $job = json_decode($result, true);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_URL, "https://graph.facebook.com/v2.3/" . $job['owner']['facebook_id'] . "/picture?width=120");
    curl_exec($ch);
    $header = curl_getinfo($ch);
    curl_close($ch);

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
    <link type="text/css" href="/css/hackajobs-landing.css" rel="stylesheet">
</head>
<body>

<header>

    <div class="container">
        <div class="wally-logo">
            <img src="/img/wallyJobsLogoHor.svg" alt="WallyJobs"/>
        </div>
        <div class="clearfix"></div>
    </div>

</header>

<main>
    <div class="container">
        <article class="job-offer offer">
            <h1 class="offer-title"><?php echo $job['title']; ?></h1>
            <div class="offer-share">
                <a class="share-facebook" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $currentUrl; ?>">Facebook</a>
                <a class="share-twitter" target="_blank" href="https://twitter.com/home?status=<?php echo $currentUrl; ?>">Twitter</a>
            </div>
            <div class="offer-image">
                <img src="<?php echo $job['picture_url']; ?>" alt="<?php echo $job['title']; ?>"/>
            </div>
            <div class="offer-description">
                <p><?php echo $job['description']; ?></p>
            </div>
            <hr/>
            <div class="offer-details">
                <div class="offer-author-image">
                    <img src="<?php echo $header['url']; ?>" alt="<?php echo $job['owner']['name']; ?>"/>
                </div>
                <dl class="offer-author">
                    <dt>Autor:</dt>
                    <dd>
                        <a href="https://www.facebook.com/profile.php?id=<?php echo $job['owner']['facebook_id']; ?>" target="_blank"><?php echo $job['owner']['name']; ?></a>
                    </dd>
                </dl>
                <dl class="offer-date-start">
                    <dt>Publicada:</dt>
                    <dd><?php echo date('d-m-Y', strtotime($job['start_date'])); ?></dd>
                </dl>
                <dl class="offer-date-end">
                    <dt>Finalitza:</dt>
                    <dd><?php echo date('d-m-Y', strtotime($job['end_date'])); ?></dd>
                </dl>
                <dl class="offer-location">
                    <dt>Ciutat:</dt>
                    <dd><?php echo $job['city']; ?></dd>
                </dl>
            </div>
            <hr/>
            <div class="offer-apply">
                <a class="btn btn-primary btn-lg" href="<?php echo 'https://apisocial.wallyjobs.com/login/facebook?urlOK=' . urlencode('http://applicant.wallyjobs.com/login/' . $hash) . '&urlKO="' . urlencode($currentUrl); ?>">Apunta't</a>
            </div>
        </article>
    </div>

    <div class="wrap-bottom container">
        <div class="row">
            <div class="share-title col-xs-24">
                <h2>Compartir</h2>
            </div>
        </div>
        <div class="row">
            <div class="share col-xs-24">
                <div class="fb-share-button" 
                    data-href="{{ shared_url }}" 
                    data-layout="box_count">
                </div>
                <a class="twitter-share-button" href=" {{ shared_url }}"
                  data-related="twitterdev"
                  data-count="vertical">
                Tweet
                </a>
            </div>
        </div>
    </div>

    <div id="fb-root"></div>
    <!-- Facebook -->
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    <!-- Twitter -->
    <script>
    window.twttr=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.twttr||{};if(d.getElementById(id))return t;js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","twitter-wjs"));
    </script>

</main>

<footer>
    <p class="small">©2015 Bla bla bla, ...</p>
</footer>



<script type="text/javascript" src="/js/hackajobs-stylesheet-dependencies.js"></script>

</body>
</html>