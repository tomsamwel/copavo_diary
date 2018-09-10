<?php 

//get user diaries
$diaries = $diary->getDiaries($_SESSION['id_user']);
//get user information
$userinfo = $user->get_user_info($_SESSION['id_user']);
//generate full name string
$userFullName = $userinfo['voornaam'] . " " . $userinfo['tussenvoegsels'] . " " . $userinfo['achternaam'];

//last id_diary is stored in the session to open the last opened diary
if (isset($_SESSION['id_diary'])) {
  $id_diary = $_SESSION['id_diary'];
  $diaryName = $diary->getDiaryName($_SESSION['id_diary']);
  $diaryPosts = $diary->getPosts($_SESSION['id_diary']);
}elseif (isset($diaries['0']['id_dagboek'])) {
  $_SESSION['id_diary'] = $diaries['0']['id_dagboek']; 
  $diaryName = $diary->getDiaryName($_SESSION['id_diary']);
  $diaryPosts = $diary->getPosts($_SESSION['id_diary']); 
}else {
  echo '<h1>You have no Diaries yet</h1>';
}
?>

<div class="container">
  <div class="row">
    <div class="col-lg-8">
    <?php
    if (isset($_SESSION['id_diary'])) { ?>

      <!-- Title -->
      <h1 class="mt-4"><?php echo $diaryName['naam']; ?></h1>

      <!-- Author -->
      <p class="lead">
        by <a href="/register.php"><?php echo $userFullName; ?></a>
      </p>
      <hr>

      <!-- Post form -->
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
      
      <!-- date filter -->
      <input id="datefilter" class="datepicker" type="" name="date" placeholder="Search by date" />
      <hr>

      <!-- Posts  -->
      <ul id="posts" class="posts">
      <?php foreach ($diaryPosts as $post) {?>
        <li class="post">
          <form id="postForm" method="POST" action="forms/diaryhandler.php">
            <button name="deletePost" value="<?php echo $post['id_post']; ?>" type="submit" class="btn btn-sm btn-outline-danger float-right">Delete Post</button>
            <span class="postDate blockquote-footer"><?php echo $post['datum']; ?></span>
            <p class="lead"><?php echo $post['post']; ?></p>
            <hr>
          </form>
        </li>
      <?php } ?>
      </ul>
    <?php } ?>
    </div>

    <!-- Sidebar diaries -->
    <div class="col-md-4">

      <!-- new diary Widget -->
      <div class="card my-4">
        <form class="form-group" id="register" method="POST" action="forms/diaryhandler.php">
          <div class="card-header"><input class="wide" type="text" name="diaryName" placeholder="My diary name" required></div>
          <div class="card-body">
            <button class="btn btn-primary btn-lg">Create a new Diary</button>
          </div>
        </form>
      </div>

    <?php 
      //for each diary create a widget
      foreach ($diaries as $diary) { ?>
      <div class="card my-4 diary">
        <form method="POST" id="diaryForm" action="forms/diaryhandler.php">
          <h5 class="card-header text-center"><?php echo $diary['naam'] ;?>
            <input type="hidden" name="id_diary" value="<?php echo $diary['id_dagboek']; ?>" />
          </h5>
          <div class="card-body">
            <button name="deleteDiary" value="deleteDiary" type="submit" class="btn btn-lg btn-outline-danger float-right">Delete</button>
            <button name="openDiary" value="openDiary" type="submit" class="btn btn-lg btn-outline-info">Open</button>
          </div>
        </form>
      </div>
      <?php } ?>
    </div>
  </div>
</div>