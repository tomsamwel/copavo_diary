<?php 
  
  //get user diaries
  $diaries = $diary->getDiaries($_SESSION['id_user']);
  $userinfo = $user->get_user_info($_SESSION['id_user']);
  $userFullName = $userinfo['voornaam'] . " " . $userinfo['tussenvoegsels'] . " " . $userinfo['achternaam'];

  if (isset($_SESSION['id_diary'])) {
    $id_diary = $_SESSION['id_diary'];
    $diaryName = $diary->getDiaryName($_SESSION['id_diary']);
    $diaryPosts = $diary->getPosts($_SESSION['id_diary']);
  }elseif (isset($diaries['0']['id_dagboek'])) {
    $_SESSION['id_diary'] = $diaries['0']['id_dagboek']; 
    $diaryName = $diary->getDiaryName($_SESSION['id_diary']);
    $diaryPosts = $diary->getPosts($_SESSION['id_diary']); 
  }else {
    echo '<h1 class="mt-4">You have no diaries yet </h1>';
  }
  
  //get diary name and posts
  
  
?>

<div class="container">

      <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

          <?php
          if (isset($_SESSION['id_diary'])) { ?>
            <!-- Title -->
            <h1 class="mt-4"><?php echo $diaryName['naam']; ?></h1>
            <input type="date" name="" value="" />

            <!-- Author -->
            <p class="lead">
              by
              <a href="/register.php"><?php echo $userFullName; ?></a>
            </p>
            <hr>
              <?php foreach ($diaryPosts as $post) {?>
                <form id="postForm" method="POST" action="forms/diaryhandler.php">
                  <button name="deletePost" value="<?php echo $post['id_post']; ?>" type="submit" class="btn btn-sm btn-outline-danger float-right">Delete Post</button>
                  <p class="blockquote-footer">Posted on <?php echo $post['datum']; ?></p>
                  <p class="lead"><?php echo $post['post']; ?></p>
                  <hr>
                </form>
              <?php
              }
          }?>
          
          
          
          <?php if (isset($_SESSION['id_diary'])) { ?>
            <!-- post form -->
            <div class="card my-4">
              <h5 class="card-header">Write to your diary:</h5>
              <div class="card-body">
                <form method="POST" action="forms/diaryhandler.php">
                  <div class="form-group">
                    <textarea class="form-control" rows="3" name="diarypost"  placeholder="My beautiful story"></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Submit</button>
                </form>
              </div>
            </div>
          <?php } ?>
          
        </div>

        <!-- Sidebar diaries -->
        <div class="col-md-4">
          <?php 
            foreach ($diaries as $diary) {
              ?>
              <form method="POST" id="diaryForm" action="forms/diaryhandler.php">
                <div class="card my-4">
                  <h5 class="card-header text-center"><?php echo $diary['naam'] ;?>
                    <input type="hidden" name="id_diary" value="<?php echo $diary['id_dagboek']; ?>" />
                    
                  </h5>
                  <div class="card-body">
                    <button name="deleteDiary" value="deleteDiary" type="submit" class="btn btn-lg btn-outline-danger float-right">Delete</button>
                    <button name="openDiary" value="openDiary" type="submit" class="btn btn-lg btn-outline-info">Open</button>
                  </div>
                </div>
              </form>
              <?php
            }
          ?>

          <!-- new diary Widget -->
          <div class="card my-4">
            <form class="form-group" id="register" method="POST" action="forms/diaryhandler.php">
              <div class="card-header"><input type="text" name="diaryName" placeholder="My diary name"></div>
              <div class="card-body">
                <button class="btn btn-primary btn-lg">Create a new Diary</button>
              </div>
            </form>
          </div>

        </div>

      </div>
      <!-- /.row -->

</div>