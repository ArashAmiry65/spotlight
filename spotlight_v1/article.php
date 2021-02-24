<?php session_start();?>
<?php include 'dbh.php';?>

    <?php require_once './header.php'?>
    <title>Spotlight | Artikel</title>
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
      <form action="search.php" method="get">
        <input type="search" name="search">
        <i class="fa fa-search"></i>
      </form>
      </div>

      <?php
      if(isset($_GET['title']) && isset($_GET['date'])){
        $title = mysqli_real_escape_string($conn, $_GET['title']);
        $date = mysqli_real_escape_string($conn, $_GET['date']);

        $_SESSION['currentSite'] = $title;
        $_SESSION['currentSiteDate'] = $date;

        $sql = "SELECT * FROM articles WHERE post_title='$title' AND post_date='$date'";
        $result = mysqli_query($conn, $sql);
        $queryResults = mysqli_num_rows($result);

        $sqlUsers = "SELECT * FROM posts WHERE title='$title' AND date_post='$date'";
        $resultUsers = mysqli_query($conn, $sqlUsers);
        $queryResultsUsers = mysqli_num_rows($resultUsers);

        $sqlTrend = "SELECT * FROM trends WHERE trend_title='$title' AND trend_date='$date'";
        $resultTrend = mysqli_query($conn, $sqlTrend);
        $queryResultsTrend = mysqli_num_rows($resultTrend);

        if($queryResults > 0){
            $sqlRelated = "SELECT * FROM posts ORDER BY RAND() LIMIT 5";
            $resultRelated = mysqli_query($conn, $sqlRelated);
            $queryResultsRelated = mysqli_num_rows($resultRelated);

         while($row = mysqli_fetch_assoc($result)){
            echo "
            <div class='main-content'>
            <div class='article-container'>
            <img src='{$row['post_image']}' alt=''>
            <h3>{$row['post_date']} | MUSIK | <span style='font-family: 'Indie Flower', cursive;'>{$row['post_author']}</span></h3>
            <h2>{$row['post_title']}</h2>
            <p style='white-space: pre-wrap;'>{$row['post_content_article']}</p>      
            </div>";

            echo "
                <div class='related-articles'>
                    <h4 class='title-related'>ANDRA ARTIKLAR</h4>
                    <ul class='row'>
                ";

                while($rowRelated = mysqli_fetch_assoc($resultRelated)){
                    echo "
                    <a href='article.php?title=".$rowRelated['title']."&date=".$rowRelated['date_post']."' class='col-12 related-article-title'><li><img src='{$rowRelated['image_small']}' alt=''><h5>{$rowRelated['date_post']}</h5><h4 class='title-article'>{$rowRelated['title']}</h4></li></a>";
                }

                echo "</ul>
                </div>
                </div>";
         }
        }

        if($queryResultsUsers > 0){
            $sqlRelated = "SELECT * FROM posts ORDER BY RAND() LIMIT 5";
            $resultRelated = mysqli_query($conn, $sqlRelated);
            $queryResultsRelated = mysqli_num_rows($resultRelated);
            
            while($rowUser = mysqli_fetch_assoc($resultUsers)){

                echo "
                <div class='main-content'>
                <div class='article-container'>
                <img src='{$rowUser['image']}' alt=''>
                <h3>{$rowUser['date_post']} | MUSIK | {$rowUser['author']}</h3>
                <h2>{$rowUser['title']}</h2>
                <p style='white-space: pre-wrap;'>{$rowUser['article_content']}</p>      
                </div>";

                echo"
                <div class='related-articles'>
                    <h4 class='title-related'>ANDRA ARTIKLAR</h4>
                    <ul class='row'>
                ";

                while($rowRelated = mysqli_fetch_assoc($resultRelated)){
                    echo "
                    <a href='article.php?title=".$rowRelated['title']."&date=".$rowRelated['date_post']."' class='col-12 related-article-title'><li><img src='{$rowRelated['image_small']}' alt=''><h5>{$rowRelated['date_post']}</h5><h4 class='title-article'>{$rowRelated['title']}</h4></li></a>";
                }

                echo "</ul>
                </div>
                </div>";
                }
            }
            
            if($queryResultsTrend > 0){
              $sqlRelated = "SELECT * FROM posts ORDER BY RAND() LIMIT 5";
              $resultRelated = mysqli_query($conn, $sqlRelated);
              $queryResultsRelated = mysqli_num_rows($resultRelated);
              
              while($rowTrend = mysqli_fetch_assoc($resultTrend)){
  
                  echo "
                  <div class='main-content'>
                  <div class='article-container'>
                  <img src='{$rowTrend['trend_image']}' alt=''>
                  <h3>{$rowTrend['trend_date']} | MUSIK | {$rowTrend['trend_author']}</h3>
                  <h2>{$rowTrend['trend_title']}</h2>
                  <p style='white-space: pre-wrap;'>{$rowTrend['trend_content_article']}</p>      
                  </div>";
  
                  echo"
                  <div class='related-articles'>
                      <h4 class='title-related'>ANDRA ARTIKLAR</h4>
                      <ul class='row'>
                  ";
  
                  while($rowRelated = mysqli_fetch_assoc($resultRelated)){
                      echo "
                      <a href='article.php?title=".$rowRelated['title']."&date=".$rowRelated['date_post']."' class='col-12 related-article-title'><li><img src='{$rowRelated['image_small']}' alt=''><h5>{$rowRelated['date_post']}</h5><h4 class='title-article'>{$rowRelated['title']}</h4></li></a>";
                  }
  
                  echo "</ul>
                  </div>
                  </div>";
                  }
              }
        }
        else{
          echo "Inget resultat på sökningen.";
        }
        ?>

      <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
      <div class="container-fluid comments-container">

      <div class="comments-form-div">
      <h1 class="comment-title-section">KOMMENTARSFÄLT</h1>

        <div class="row">
          <div class="col-md-12">
            <form class="comment-publisher" action="./includes/comment.inc.php" method="post">
            <!-- <input type="text" name="comment" id="mainComment" placeholder="Kommentera som du känner och tänker..."> -->
            <textarea name="comment" id="mainComment" placeholder="Kommentera något som du tänker på..." cols="10" rows="1"></textarea>
            <br>
            <input class="submit-comment" value="Kommentera" type="submit" name="addComment">
            </form>
          </div>
        </div>
        </div>
        <?php
        $queryComments = "SELECT * FROM comments WHERE articleTitle='$title' ORDER BY createdOn ASC";
        $resultComment = mysqli_query($conn, $queryComments);
        $numComments = mysqli_num_rows($resultComment);

        echo "<div class='container-fluid chat-comment'>
        <div class='col-md-12'>
          <h2 class='count-comment'><b>$numComments Kommentarer</b></h2>
          <div class='userComments'>";

        if($numComments > 0){
          while($rowComment = mysqli_fetch_assoc($resultComment)){
           echo "<div class='comment'>
              <div class='user'><b>{$rowComment['usersUid']}</b> <span class='time'>{$rowComment['createdOn']}</span></div>";
              if(isset($_SESSION['useruid'])){
                if(($rowComment['usersUid'] == $_SESSION['useruid']) || ($_SESSION['useruid'] == 'admin')){
                  echo "<form action='./includes/removed-comment.inc.php' method='post' class='remove-comment'>
                  <input style='display:none;' name='idComment' value='{$rowComment['id']}'>
                  <button type='submit' name='removed' class='remove-button'>Ta bort</button>
                  </form>";
                }
              }
            echo "
              <div class='userComment' style='white-space: pre-wrap;'>{$rowComment['comment']}</div>
            </div>";
          }
        }
        else{
          echo "Inga kommentarer, bli den första med att kommentera!";
        }
          echo "</div>
          </div>
        </div>";
        ?>
      </div>
      </body>
</html>