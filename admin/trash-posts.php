<?php 
//recebe dados
include('includes/config.php');
//RESTAURAR O POST
$pid = intval($_GET['pid']);
$update = 'UPDATE posts SET Is_Active = 1 WHERE id = '. $pid .'';
if($_GET['action'] == 'restore' && $pid >= 1)
{
   $query = mysqli_query($mysqli,$update);
   if($query){
      $msg = "Post restaurado com sucesso ";
   }
   else{
      $error = "Algo deu erado, tente novamente";
   } 
}

//DELETAR O POST
$presid = intval($_GET['presid']);
$delete = 'DELETE FROM posts WHERE id = '.$presid.'';
if($_GET['action'] == 'perdel' && $presid >= 1){
   $query = mysqli_query($mysqli,$delete);
   if($query){
      $msg = "Post deletado com sucesso ";
   }
   else{
      $error = "Algo deu erado, tente novamente";
   } 

}

?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="Portal de notícias do Senac">
      <meta name="author" content="Senac">
      <!-- App favicon -->
      <link rel="shortcut icon" href="assets/images/favicon.ico">
      <!-- App title -->
      <title>Portal Notícias | Notícias apagadas</title>
      <!--Morris Chart CSS -->
      <link rel="stylesheet" href="../plugins/morris/morris.css">
      <!-- jvectormap -->
      <link href="../plugins/jvectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
      <!-- App css -->
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
      <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
      <script src="assets/js/modernizr.min.js"></script>
   </head>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">
      <!-- Top Bar Start -->
      <?php include('includes/topheader.php');?>
      <!-- ========== Left Sidebar Start ========== -->
      <?php include('includes/leftsidebar.php');?>
      <!-- ============================================================== -->
      <!-- Start right Content here -->
      <!-- ============================================================== -->
      <div class="content-page">
         <!-- Start content -->
         <div class="content">
            <div class="container">
               <div class="row">
                  <div class="col-xs-12">
                     <div class="page-title-box">
                        <h4 class="page-title">Notícias apagadas </h4>
                        <ol class="breadcrumb p-0 m-0">
                           <li>
                              <a href="#">Admin</a>
                           </li>
                           <li>
                              <a href="#">Notícias</a>
                           </li>
                           <li class="active">
                              Notícias apagadas 
                           </li>
                        </ol>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <!-- end row -->
               <div class="row">
                  <div class="col-sm-6">
                     <?php if($delmsg){ ?>
                     <div class="alert alert-danger" role="alert">
                        <strong>Oh snap!</strong> <?php echo $delmsg;?>
                     </div>
                     <?php } ?>
                  </div>
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card-box">
                           <div class="table-responsive">
                              <table class="table table-colored table-centered table-inverse m-0">
                                 <thead>
                                    <tr>
                                       <th>Manchete</th>
                                       <th>Editoria</th>
                                       <th>Ação</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php
                                       //noticia
                                       $select = 'SELECT posts.id as postid, posts.PostTitle as title, category.CategoryName as category FROM posts LEFT JOIN category ON posts.categoryId = category.id WHERE posts.Is_Active = 0';
                                       $query = mysqli_query($mysqli, $select);
                                       if(mysqli_num_rows($query) == 0)
                                       {
                                       ?>
                                    <tr>
                                       <td colspan="4" align="center">
                                          <h3 style="color:red">Nenhum registro encontrado</h3>
                                       </td>
                                    <tr>
                                       <?php } else { while($row = mysqli_fetch_array($query)){  ?>
                                    <tr>
                                       <td><b><?php echo $row['title'];?></b></td>
                                       <td><?php echo $row['category']?></td>
                                       <td>
                                          <a href="trash-posts.php?pid=<?php echo $row['postid'];?>&&action=restore" onclick="return confirm('Você quer realmente restaurar?')"> <i class="ion-arrow-return-right" title="Restore this Post"></i></a>
                                          &nbsp;
                                          <a href="trash-posts.php?presid=<?php echo $row['postid'];?>&&action=perdel" onclick="return confirm('Você quer realmente apagar?')"><i class="fa fa-trash-o" style="color: #f05050" title="Permanently delete this post"></i></a> 
                                       </td>
                                    </tr>
                                    <?php }} ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- container -->
            </div>
            <!-- content -->
            <?php include('includes/footer.php');?>
         </div>
         <!-- ============================================================== -->
         <!-- End Right content here -->
         <!-- ============================================================== -->
      </div>
      <!-- END wrapper -->
      <script>
         var resizefunc = [];
      </script>
      <!-- jQuery  -->
      <script src="assets/js/jquery.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="assets/js/detect.js"></script>
      <script src="assets/js/fastclick.js"></script>
      <script src="assets/js/jquery.blockUI.js"></script>
      <script src="assets/js/waves.js"></script>
      <script src="assets/js/jquery.slimscroll.js"></script>
      <script src="assets/js/jquery.scrollTo.min.js"></script>
      <script src="../plugins/switchery/switchery.min.js"></script>
      <!-- CounterUp  -->
      <script src="../plugins/waypoints/jquery.waypoints.min.js"></script>
      <script src="../plugins/counterup/jquery.counterup.min.js"></script>
      <!--Morris Chart-->
      <script src="../plugins/morris/morris.min.js"></script>
      <script src="../plugins/raphael/raphael-min.js"></script>
      <!-- Load page level scripts-->
      <script src="../plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
      <script src="../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
      <script src="../plugins/jvectormap/gdp-data.js"></script>
      <script src="../plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
      <!-- Dashboard Init js -->
      <script src="assets/pages/jquery.blog-dashboard.js"></script>
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
   </body>
</html>
<?php //} ?>