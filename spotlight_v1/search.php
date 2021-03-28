<?php session_start(); ?>
<?php require 'dbh.php'; ?>

    <?php require_once './header.php'?>
    <title>Spotlight | Sökning</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href="."><b>Spotlight</b></a>
      
        <div id="navbarTogglerDemo02" class="mx-auto">
          <ul class="navbar-nav mr-auto pt-1 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="./#trend">RELEASE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./#interview">INTERVJUER</a>
            </li>
            <li class="nav-item">
              <?php
              if(isset($_SESSION["useruid"])){
                if($_SESSION["useruid"] == "admin"){
                  echo "<a class='nav-link' href='#'>ADMIN</a>";
                }
                else{
                  echo "<a class='nav-link' href='./#music'>MUSIK</a>";
                }
              }
              else{
                echo "<a class='nav-link' href='./#music'>MUSIK</a>";
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

    <?php
        
        if(isset($_GET['search'])){
            $search = mysqli_real_escape_string($conn, $_GET['search']);
            $sql = "SELECT * FROM articles WHERE post_tags LIKE '%$search%' OR post_content_article LIKE '%$search%' OR post_content LIKE '%$search%' OR post_author LIKE '%$search%'";
            $result = mysqli_query($conn, $sql);
            $queryResult = mysqli_num_rows($result);

            $sqlUsers = "SELECT * FROM posts WHERE tags LIKE '%$search%' OR article_content LIKE '%$search%' OR content LIKE '%$search%' OR author LIKE '%$search%'";
            $resultUsers = mysqli_query($conn, $sqlUsers);
            $queryResultsUsers = mysqli_num_rows($resultUsers);

            $sqlTrend = "SELECT * FROM trends WHERE trend_tags LIKE '%$search%' OR trend_content_article LIKE '%$search%' OR trend_author LIKE '%$search%'";
            $resultTrend = mysqli_query($conn, $sqlTrend);
            $queryResultsTrend = mysqli_num_rows($resultTrend);

            $sqlMusic = "SELECT * FROM music WHERE music_tags LIKE '%$search%' OR music_content_article LIKE '%$search%' OR music_author LIKE '%$search%'";
            $resultMusic = mysqli_query($conn, $sqlMusic);
            $queryResultsMusic = mysqli_num_rows($resultMusic);

            if($queryResult > 0 || $queryResultsUsers > 0 || $queryResultsTrend > 0 || $queryResultsMusic > 0){
              $countresult = $queryResult + $queryResultsTrend + $queryResultsUsers + $queryResultsMusic;

                echo "<h1 class='showing-results'>Showing <span style='color:white;'>$countresult</span> results for <span style='color:white;'>\"$search\"</span></h1>";
                echo "<ul class='row image-boxes-search'>";

            while($row = mysqli_fetch_assoc($result)){
              echo "<a href='article.php?title=".$row['post_title']."&date=".$row['post_date']."'><li><img src='{$row['post_image_small']}' alt=''><h3>{$row['post_artist']}</h3><p><i>{$row['post_title']}</i></p><h5>Skribent: {$row['post_author']}</h5></li></a>";
            }

            while($rowUser = mysqli_fetch_assoc($resultUsers)){
                echo "<a href='article.php?title=".$rowUser['title']."&date=".$rowUser['date_post']."'><li><img src='{$rowUser['image_small']}' alt=''><h3>{$rowUser['artist']}</h3><p><i>{$rowUser['title']}</i></p><h5>Skribent: {$rowUser['author']}</li></a>";
              }

            while($rowTrend = mysqli_fetch_assoc($resultTrend)){
                echo "<a href='article.php?title=".$rowTrend['trend_title']."&date=".$rowTrend['trend_date']."'><li><img src='{$rowTrend['trend_image_small']}' alt=''><h3>{$rowTrend['trend_artist']}</h3><p><i>{$rowTrend['trend_title']}</i></p><h5>Skribent: {$rowTrend['trend_author']}</li></a>";
              }
            
            while($rowMusic = mysqli_fetch_assoc($resultMusic)){
                echo "<a href='article.php?title=".$rowMusic['music_title']."&date=".$rowMusic['music_date']."'><li><img src='{$rowMusic['music_image_small']}' alt=''><h3>{$rowMusic['music_artist']}</h3><p><i>{$rowMusic['music_title']}</i></p><h5>Skribent: {$rowMusic['music_author']}</h5></li></a>";
              }
            echo "</ul>";
            }
            else{
                echo "<p class='no-search-result'>Inga resultat hittades till sökningen.</p>";
            }
        }
        else{
          header("location: ./index.php");
          exit();
        }

    ?>