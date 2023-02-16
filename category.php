2<?php 
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Senac">
    <meta name="author" content="Senac">
    <title>Portal Notícias | Página de Editorias</title>
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
//carrega editoria
?>
<h1><?php echo $row['category'];?> Notícias</h1>
          <div class="card mb-4">
            <img class="card-img-top" src="admin/postimages/<?php echo $row['PostImage'];?>" alt="<?php echo $row['posttitle'];?>">
            <div class="card-body">
              <h2 class="card-title"><?php echo $row['posttitle'];?></h2>
              <a href="news-details.php?nid=<?php echo $row['pid']?>" class="btn btn-primary">leia mais &rarr;</a>
            </div>
            <div class="card-footer text-muted">
              Postado em <?php echo $row['postingdate'];?>
            </div>
          </div>
<?php //} ?>
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
<?php //} ?>
    <!-- Pagination -->
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
