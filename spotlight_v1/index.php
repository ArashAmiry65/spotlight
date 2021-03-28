<?php session_start(); ?>
<?php include 'dbh.php'; ?>

    <?php require_once './header.php'?>
    <title>Spotlight | Startsida</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="."><b>Spotlight</b></a>
      
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
                  echo "<a class='nav-link' href='#music'>MUSIK</a>";
                }
              }
              else{
                echo "<a class='nav-link' href='#music'>MUSIK</a>";
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
                <img src="./images/travis_scott_2.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./images/travis_scott_1.png" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./images/travis_scott_3.png" class="d-block w-100" alt="...">
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

  <?php require_once './includes/dateDifference.php'; ?>
    <div class="carousel-text-information">
            <h3><?php echo time_elapsed_string('2021-03-26 11:10:35');?> | <span>MUSIK</span></h3>
            <h2>TRAVIS X ASTROWORLD</h2>
            <p>Astroworld är det tredje studioalbumet av den amerikanska rapparen och skivproducenten Travis Scott.</p>
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
              echo "<a href='article.php?title=".$row['post_title']."&date=".$row['post_date']."'><li><img src='{$row['post_image_small']}' alt=''></li></a>";
            }
          }

        ?>
      </div>

      <div class='trending-songs'>
          <h2 id='trend' class='trend-title'>TRENDIGA RELEASE LÅTAR</h2>
          <ul>
            <?php
            $sqlTrend = "SELECT * FROM trends LIMIT 4";
            $resultTrend = mysqli_query($conn, $sqlTrend);

            while($rowTrend = mysqli_fetch_assoc($resultTrend)){
              echo "<a href='article.php?title=".$rowTrend['trend_title']."&date=".$rowTrend['trend_date']."'><li><img src='{$rowTrend['trend_image_small']}'/><p style='white-space: pre-wrap;'><span class='trend-artist'>{$rowTrend['trend_artist']}</span><span class='trend-song-title'>{$rowTrend['trend_index_title']}</span><span class='trend-song-content'>{$rowTrend['trend_content_homepage']}</span></p></li></a>";
            }
            ?>
          </ul>
      </div>

      <div id='interview' class="container-fluid">
      <div class="carousel-text-information carousel-text-information-interview">
            <h3><?php echo time_elapsed_string('2021-03-26 10:32:35');?> | <span>INTERVJU</span></h3>
            <h2>PNL X Deux Fréres</h2>
            <p>Med singeln "Au DD" lyckades de överträffa de enorma förväntningar efter det hyllade albumet Dans la lègende (2016),både musikaliskt och visuellt.</p>
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
                <img src="./images/pnl.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  </div>
              </div>
              <div class="carousel-item">
                <img src="./images/pnl_1.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                  </div>
              </div>
              <div class="carousel-item">
                <img src="./images/pnl_2.png" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>...</h5>
                    <p>...</p>
                  </div>
              </div>
            </div>
          </div>
    </div>
    </div>

    <div id="music" class="artists-music">
      <ul class="list-music">
      <?php
            $sqlMusic = "SELECT * FROM music LIMIT 4";
            $resultMusic = mysqli_query($conn, $sqlMusic);

            while($rowMusic = mysqli_fetch_assoc($resultMusic)){
            echo "<a href='article.php?title=".$rowMusic['music_title']."&date=".$rowMusic['music_date']."'><li><div class='chart-items' style='background-image: linear-gradient(to bottom, rgba(245, 246, 252, 0.32) 44%, rgba(138, 138, 138, 0.77)), url(\"./{$rowMusic['music_image_small']}\");'><h2>{$rowMusic['music_index_title']}</h2></div></li></a>";
            }
      ?>
      </ul>
    </div>
  
    <div class="contact-form-spotlight">
      <form action="contactform.php" method="post" class="contact-form">
        <h2 class="send-us">SKICKA ETT MEJL</h2>
        <div class="info-sender">
          <input type="text" class="form-control" name="name" placeholder="Fullständiga namn...">
          <input type="email" class="form-control" name="mail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="G-mail...">
          <input type="password" class="form-control" name="mailPassword" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="G-mail Password...">
          <input type="text" class="form-control" name="subject" placeholder="Ämne...">
          <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
          <button type="submit" name="submitMail">SKICKA MAIL</button>
          <?php
          if(isset($_GET["mail"])){
            if($_GET['mail'] == "name-error"){
              echo "<p class='sent-mail-msg'>Fullständigt namn krävs.</p>";
            }
            else if($_GET['mail'] == "name-specialchars"){
              echo "<p class='sent-mail-msg'>Inga specialtecken kan användas.</p>";
            }
            else if($_GET['mail'] == "errorsent"){
              echo "<p class='sent-mail-msg'>Kontrollera att G-mail och lösenord är korrekt.</p>";
            }
            else if($_GET['mail'] == "sentsuccessfully"){
              echo "<p class='sent-mail-msg'>Mail skickat!</p>";
            }
            else if($_GET['mail'] == "empty"){
              echo "<p class='sent-mail-msg'>Inget fält får lämnas tomt.</p>";
            }
          }
        ?>  
        </div>
      </form>
      <div class="newsletter">
      <form action="register.php" method="post">
        <h2>NYHETSBREV</h2>
        <p>Registera ett e-mail för att få tillgång till de mest exklusiva nyheterna. Regelbundet skickas notifikationer om det mest relevanta inom musikvärlden.</p>
        <input type="email" class="form-control newsmail" name="newsmail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="E-mail">
        <button type="submit" name="submitNewsMail">REGISTRERA</button>  
      </form>
      </div>
    </div>
  </body>
</html>