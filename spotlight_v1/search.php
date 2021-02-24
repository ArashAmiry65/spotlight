<?php session_start(); ?>
<?php include 'dbh.php'; ?>

    <?php require_once './header.php'?>
    <title>Spotlight | Sökning</title>
</head>
<body>
    
    <nav class="navbar navbar-expand-lg ">
        <a class="navbar-brand" href=".">SPOTLIGHT</a>
      
        <div id="navbarTogglerDemo02" class="mx-auto">
          <ul class="navbar-nav mr-auto pt-1 mt-2 mt-lg-0">
            <li class="nav-item">
              <a class="nav-link" href="#">RELEASE</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">INTERVJUER</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">MUSIK</a>
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

            $sqlTrend = "SELECT * FROM trends WHERE trend_tags LIKE '%$search%' OR trend_content_article LIKE '%$search%' OR trend_content_small LIKE '%$search%' OR trend_author LIKE '%$search%'";
            $resultTrend = mysqli_query($conn, $sqlTrend);
            $queryResultsTrend = mysqli_num_rows($resultTrend);

            if($queryResult > 0 || $queryResultsUsers > 0 || $queryResultsTrend > 0){
                echo "<ul class='row image-boxes'>";

            while($row = mysqli_fetch_assoc($result)){
              echo "<a href='article.php?title=".$row['post_title']."&date=".$row['post_date']."'><li><img src='{$row['post_image']}' alt=''><h3>{$row['post_author']}</h3><p>{$row['post_content']}</p></li></a>";
            }

            while($rowUser = mysqli_fetch_assoc($resultUsers)){
                echo "<a href='article.php?title=".$rowUser['title']."&date=".$rowUser['date_post']."'><li><img src='{$rowUser['image']}' alt=''><h3>{$rowUser['author']}</h3><p>{$rowUser['content']}</p></li></a>";
              }

              while($rowTrend = mysqli_fetch_assoc($resultTrend)){
                echo "<a href='article.php?title=".$rowTrend['trend_title']."&date=".$rowTrend['trend_date']."'><li><img src='{$rowTrend['trend_image']}' alt=''><h3>{$rowTrend['trend_author']}</h3><p>{$rowTrend['trend_content_small']}</p></li></a>";
              }
            echo "</ul>";
            }
            else{
                echo "Inga resultat hittades till din sökning.";
            }
        }
        else{
            echo "<h1>Ingen sökning träffades</h1>";
        }

    ?>