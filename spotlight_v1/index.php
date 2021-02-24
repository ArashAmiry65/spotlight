<?php session_start(); ?>
<?php include 'dbh.php'; ?>

    <?php require_once './header.php'?>
    <title>Spotlight | Startsida</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href=".">SPOTLIGHT</a>
      
        <div id="navbarTogglerDemo02" class="mx-auto">
          <ul class="navbar-nav mr-auto pt-1 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#trend">RELEASE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#interview">INTERVJUER</a>
            </li>
            <li class="nav-item">
              <?php
              if(isset($_SESSION["useruid"])){
                if($_SESSION["useruid"] == "admin"){
                  echo "<a class='nav-link' href='#'>ADMIN</a>";
                }
                else{
                  echo "<a class='nav-link' href='#'>MUSIK</a>";
                }
              }
              else{
                echo "<a class='nav-link' href='#'>MUSIK</a>";
              }
              ?>
            </li>
            <?php
              if(isset($_SESSION["useruid"])){
                echo "<li class='nav-item'>
                <a class='nav-link' href='logout.php'>UTLOGGNING</a>
              </li>";
              }
              else{
                echo "<li class='nav-item'>
                <a class='nav-link' href='login.php'>INLOGGNING</a>
              </li>";
              }
            ?>
          </ul>
        </div>
        
      </nav>
      <div class="search-engine">
      <form class="search-engine-form" action="search.php" method="get">
        <input class="search-engine-input" type="search" name="search">
        <i class="fa fa-search"></i>
      </form>
      </div>

      <div class="container-fluid">
      <div class="slide-show">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>...</h5>
                    <p>...</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h6>AMERIKANSKA RAPPARE</h6>
                    <p>Under söndagen var rapparna i Stockholm.</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>...</h5>
                    <p>...</p>
                  </div>
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
    </div>

    <div class="carousel-text-information">
            <h3>2 DAGAR SEDAN | <span>MUSIK</span></h3>
            <h2>DRAKE X THE WEEKND</h2>
            <p>Drake har nu släppt en officiell trailer till hans kommande album Certified Lover Boy. I sin musikvideo fick vi en glimt av <i>The Weeknd</i>.</p>
    </div>
</div>

      <div class="articles-container">
        <?php
          $sql = "SELECT * FROM articles LIMIT 4";
          $result = mysqli_query($conn, $sql);
          $queryResults = mysqli_num_rows($result);

          if($queryResults > 0){
            echo "<ul class='row image-boxes image-boxes-carousel'>";
            while($row = mysqli_fetch_assoc($result)){
              echo "<a href='article.php?title=".$row['post_title']."&date=".$row['post_date']."'><li><img src='{$row['post_image']}' alt=''><h3>{$row['post_author']}</h3><p>{$row['post_content']}</p></li></a>";
            }
          }

        ?>
      </div>

      <div class='trending-songs'>
          <h2 id='trend' class='trend-title'>TRENDIGA RELEASE LÅTAR</h2>
          <ul>
            <?php
            $sqlTrend = "SELECT * FROM trends LIMIT 5";
            $resultTrend = mysqli_query($conn, $sqlTrend);

            while($rowTrend = mysqli_fetch_assoc($resultTrend)){
              echo "<a href='article.php?title=".$rowTrend['trend_title']."&date=".$rowTrend['trend_date']."'><li><img src='{$rowTrend['trend_image_small']}'/><p style='white-space: pre-wrap;'><span class='trend-artist'>{$rowTrend['trend_artist']}</span><span class='trend-song-title'>{$rowTrend['trend_title']}</span><span class='trend-song-content'>{$rowTrend['trend_content_homepage']}</span></p></li></a>";
            }
            ?>
          </ul>
      </div>

      <div id='interview' class="container-fluid">
      <div class="carousel-text-information carousel-text-information-interview">
            <h3>5 DAGAR SEDAN | <span>INTERVJU</span></h3>
            <h2>Antwan Koppling</h2>
            <p>Drake har nu släppt en officiell trailer till hans kommande album Certified Lover Boy. I sin musikvideo fick vi en glimt av <i>The Weeknd</i>.</p>
    </div>
      <div class="slide-show slide-show-interview">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>...</h5>
                    <p>...</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h6>AMERIKANSKA RAPPARE</h6>
                    <p>Under söndagen var rapparna i Stockholm.</p>
                  </div>
              </div>
              <div class="carousel-item">
                <img src="first_photo.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>...</h5>
                    <p>...</p>
                  </div>
              </div>
            </div>
          </div>
    </div>
    </div>

    <div class="artists-music">
      <ul class="list-music">
        <li><div class="chart-items"><h2>meet the woo</h2></div></li>
        <li><div class="chart-items"><h2>meet the woo</h2></div></li>
        <li><div class="chart-items"><h2>meet the woo</h2></div></li>
        <li><div class="chart-items"><h2>meet the woo</h2></div></li>

      </ul>
    </div>
  
  </body>
</html>