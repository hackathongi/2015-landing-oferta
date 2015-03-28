<!DOCTYPE html>
<html lang="en" ng-app="hackathonApp" ng-controller="LandingController">
    <head>
	<?php 
	$url="https://demo3532506.mockable.io/items";
	
	//  Initiate curl
	$ch = curl_init();
	// Disable SSL verification
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	// Will return the response, if false it print the response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// Set the url
	curl_setopt($ch, CURLOPT_URL,$url);
	// Execute
	$result=curl_exec($ch);
	// Closing
	curl_close($ch);

	// Will dump a beauty json :3
	$job = json_decode($result, true);

	?>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <meta property="og:type" content="website">
        <meta property="og:url" content="">
        <meta property="og:title" content="{{ job.title }}">
        <meta property="og:description" content="{{ job.description }}">
        <meta property="og:image" content="{{ job.picture_url }}">

        <meta property="twitter:card" content="summary">
        <meta property="twitter:url" content="">
        <meta property="twitter:title" content="{{ job.title }}">
        <meta property="twitter:description" content="{{ job.description }}">
        <meta property="twitter:image" content="{{ job.picture_url }}">

        <title><?= $job["title"] ?></title>

        <link type="text/css" href="css/hackajobs-landing.min.css" rel="stylesheet">
        <script type="text/javascript" src="js/hackajobs-landing-with-dependencies.min.js"></script>
		<script type="text/javascript" src="js/hackajobs-landing.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <div class="container wrap">
            <div class="row header">
                <div class="col-sm-2">
                    <img src="" alt="Job picture" />
                </div>
                <div class="col-sm-10">
                    <h1>{{ job.title }}</h1>
                    <h3>Employer name</h3>
                    <div class="offer-info">
                        <span>Start date: 01/01/1970  –  End date: 31/12/1970  –  City</span>
                    </div>
                </div>
            </div>
            <div class="row content">
                <div class="col-sm-12">
                    Lorem ipsum dolor sit amet...
                </div>
            </div>
            
            <div class="row">
				<div class="col-sm-2 col-sm-offset-3">
					<div class="fb-share-button" 
					data-href="{{ shared_url }}" 
					data-layout="box_count">
					</div>
				</div>
				<div class="col-sm-2 col-sm-offset-2">
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
    </body>
</html>