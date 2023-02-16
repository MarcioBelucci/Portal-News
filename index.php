<?php 
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
  if (isset($_GET['pageno']))
  {
    $pageno = $_GET['pageno'];
  }
  else
  {
    $pageno = 1;
  }

  //carrega págima
  include('includes/config.php');

  $no_of_records_per_page = 2;
  $offset = ($pageno-1) * $no_of_records_per_page;
  $total_pages_sql = "SELECT COUNT(*) as contador FROM posts WHERE posts.Is_Active = 1";
  $result = mysqli_query($mysqli,$total_pages_sql);
  $total_rows = mysqli_fetch_array($result)['contador'];
  $total_pages = ceil($total_rows / $no_of_records_per_page);
  $catid = mysqli_real_escape_string($mysqli, $_GET['catid']);
  $search = mysqli_real_escape_string($mysqli, $_POST['searchtitle']);
  $query = 'SELECT posts.id as pid, posts.PostTitle as posttitle, posts.CategoryId as categoryid, posts.PostDetails as postdetails, posts.PostingDate as postingdate, posts.UpdationDate as updationdate, posts.PostUrl as posturl, posts.PostImage as postimage, category.CategoryName as category, category.id as cid FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.Is_Active = 1 '. (isset($_GET['catid']) ? 'AND category.Id = ' . $catid : '' ) . (isset($_POST['searchtitle']) ? 'AND (posts.PostTitle LIKE  "%'. $search .'%" OR posts.PostDetails LIKE "%'. $search . '%")': '') . ' ORDER BY posts.id DESC LIMIT ' . $offset . ',  '. $no_of_records_per_page ;
  $result = mysqli_query ($mysqli, $query );
  if (!$result) echo'Deu erro: '. mysqli_error($mysqli);
  if (!mysqli_num_rows($result)){
    echo 'não tem notícias';
  }
  while ($row = mysqli_fetch_array($result)) 
  {
    
?>
          <div class="card mb-4">
<?php if (!$search) {?>
            <img class="card-img-top" src="admin/postimages/<?php echo $row['postimage'];?>" alt="<?php echo htmlentities($row['posttitle']);?>">
<?php } ?>
            <div class="card-body"> 
              <h2 class="card-title"><?php echo htmlentities($row['posttitle']);?></h2>
              <p><b>Editoria : </b> <a href="index.php?catid=<?php echo $row['cid']?>"><?php echo htmlentities($row['category']);?></a> </p>
              <a href="news-details.php?nid=<?php echo $row['pid']?>" class="btn btn-primary">Leia mais &rarr;</a>
            </div>
            <div class="card-footer text-muted">
            Postado em <?php echo date_format(date_create($row['postingdate']) , 'd-m-Y H:i');?>
          </div>
        </div>
<?php } ?>
          <!-- Pagination -->
          <ul class="pagination justify-content-center mb-4">
            <li class="page-item"><a href="?pageno=1"  class="page-link">Primeira</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
              <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Anterior</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
              <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Próxima</a>
            </li>
            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Última</a></li>
          </ul>
        </div>
        <!-- Sidebar Widgets Column -->
        <?php include('includes/sidebar.php');?>
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container -->
    <!-- Footer -->
    <?php include('includes/footer.php');?>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  </body>
</html>