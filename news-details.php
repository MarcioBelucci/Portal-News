<?php 
//token
  session_start();
  include('includes/config.php');
  //Genrating CSRF Token
  if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
  }
  if(isset($_POST['submit'])) {
      //Verifying CSRF Token
      if (!empty($_POST['csrftoken'])) {
          if (hash_equals($_SESSION['token'], $_POST['csrftoken'])) {
              $name = mysqli_real_escape_string($mysqli,$_POST['name']);
              $email = mysqli_real_escape_string($mysqli,$_POST['email']);
              $comment = mysqli_real_escape_string($mysqli,$_POST['comment']);
              $postid = intval($_GET['nid']);
              $query = mysqli_query($mysqli,'INSERT INTO comments(postId,name,email,comment,status) VALUES("'.$postid.'","'.$name.'","'.$email.'","'.$comment.'",0)');
              echo  $query;
              if ($query) {
                  echo "<script>alert('Comentário enviado com sucesso. Ele será mostrado depois de rivisão dos administradores ');</script>";
                  unset($_SESSION['token']);
              } else {
              echo "<script>alert('Aconteceu algo errado, tente novamente.');</script>";  
              }
          }
      }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Senac">
    <meta name="author" content="Senac">
    <title>Portal Notícias | Home Page</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/modern-business.css" rel="stylesheet">
  </head>
  <body>
    <!-- Navigation -->
   <?php include('includes/header.php');?>
    <!-- Page Content -->
    <div class="container">
      <div class="row" style="margin-top: 4%">
        <!-- Blog Entries Column -->
        <div class="col-md-8">
          <!-- Blog Post -->
<?php
  //carrega págima

  $pid = intval($_GET['nid']);
  $query = 'SELECT posts.id as pid, posts.PostTitle as posttitle, posts.CategoryId as categoryid, posts.PostDetails as postdetails, posts.PostingDate as postingdate, posts.UpdationDate as updationdate, posts.PostUrl as posturl, posts.PostImage, category.CategoryName as category, category.id as cid FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.id = '. (isset($_GET['nid']) ? ' '. $pid : '' );
  $result = mysqli_query ($mysqli, $query );
  if (!$result) echo'Deu erro: '. mysqli_error($mysqli);
  if (!mysqli_num_rows($result)){
    echo 'não tem notícias';
  }
  while ($row = mysqli_fetch_array($result)) 
  {
//pega notícia
?>
          <div class="card mb-4">
            <div class="card-body">
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
              <p><b>Editoria : </b> <a href="category.php?catid=<?php echo $row['cid']?>"><?php echo htmlentities($row['category']);?></a> |
                <hr />
                <img class="img-fluid rounded" src="admin/postimages/<?php echo $row['PostImage'];?>" alt="<?php echo htmlentities($row['posttitle']);?>">
              <p class="card-text"><?php echo (substr($row['postdetails'], 0));?></p>
            </div>
            <div class="card-footer text-muted">
            </div>
          </div>
<?php } ?>
        </div>
        <!-- Sidebar Widgets Column -->
      <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
      <!---Comment Section ---> 
      <div class="row" style="margin-top: -8%">
        <div class="col-md-8">
          <div class="card my-4">
            <h5 class="card-header">Comente aqui:</h5>
            <div class="card-body">
              <form name="Comment" method="post">
                <input type="hidden" name="csrftoken" value="<?php echo htmlentities($_SESSION['token']); ?>" />
                <div class="form-group">
                  <input type="text" name="name" class="form-control" placeholder="Entre seu nome completo" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Entre um e-mail válido" required>
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="comment" rows="3" placeholder="Comentário" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Enviar</button>
              </form>
            </div>
          </div>
  <!---Comment Display Section --->
<?php 
//comentários
$query = 'SELECT comments.name, comments.comment, comments.postingDate FROM comments WHERE comments.status = 1 AND comments.postId =' . (isset($_GET['nid']) ? ' '. $pid : '' );
$result = mysqli_query ($mysqli, $query );
  if (!$result) echo'Deu erro: '. mysqli_error($mysqli);
  if (!mysqli_num_rows($result)){
    echo 'não tem comentário';
  }
  while ($row = mysqli_fetch_array($result)) 
  {
?>
          <div class="media mb-4">
            <img class="d-flex mr-3 rounded-circle" src="images/usericon.png" alt="">
            <div class="media-body">
              <h5 class="mt-0"><?php echo htmlentities($row['name']);?> <br/>
                  <span style="font-size:11px;"><b>em</b> <?php echo date_format(date_create($row['postingDate']), 'd-m-Y H:i');?></span>
              </h5>
              <?php echo htmlentities($row['comment']);?>
            </div>
          </div>
<?php } ?>
        </div>
      </div>
    </div>
    <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>