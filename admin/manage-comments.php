<?php 
//recebe dados
include_once('../includes/config.php');
include_once('includes/library.php');

if ($_GET['appid']) {

   $id=intval($_GET['appid']);
   $query = mysqli_query($mysqli, "UPDATE comments SET status = '0' WHERE id='$id'");

   if($insert){
      $msg = "Editoria apagada com sucesso";
   } else{
      $error = "Algo deu errado, tente novamente";
   }
  
}
if($_GET['action'] == 'del' && $_GET ['rid']){
   $id=intval($_GET['rid']);
   $query= mysqli_query($mysqli, "delete from comments  where id='$id'");
   $msg="Comentário excluido permanentemente";

}
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <title>Portal Notícias | Comentários não aprovados</title>
      <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
      <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="../plugins/switchery/switchery.min.css">
      <script src="assets/js/modernizr.min.js"></script>
   </head>
   <body class="fixed-left">
      <!-- Begin page -->
      <div id="wrapper">
      <!-- Top Bar Start -->
      <?php include('includes/topheader.php');?>
      <!-- ========== Left Sidebar Start ========== -->
      <?php include('includes/leftsidebar.php');?>
      <!-- Left Sidebar End -->
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
                        <h4 class="page-title">Comentários aprovados</h4>
                        <ol class="breadcrumb p-0 m-0">
                           <li>
                              <a href="#">Admin</a>
                           </li>
                           <li>
                              <a href="#">Comentários </a>
                           </li>
                           <li class="active">
                              Comentários aprovados
                           </li>
                        </ol>
                        <div class="clearfix"></div>
                     </div>
                  </div>
               </div>
               <!-- end row -->
               <div class="row">
                  <div class="col-sm-6">
                     <?php if($msg){ ?>
                     <div class="alert alert-success" role="alert">
                        <strong>Feito!</strong> <?php echo $msg;?>
                     </div>
                     <?php } ?>
                     <?php if($delmsg){ ?>
                     <div class="alert alert-danger" role="alert">
                        <strong>Deu erro!</strong> <?php echo $delmsg;?>
                     </div>
                     <?php } ?>
                  </div>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="demo-box m-t-20">
                           <div class="table-responsive">
                              <table class="table m-0 table-colored-bordered table-bordered-primary">
                                 <thead>
                                    <tr>
                                       <th>#</th>
                                       <th>Nome</th>
                                       <th>Email</th>
                                       <th width="300">Comentário</th>
                                       <th>Status</th>
                                       <th>Notícia</th>
                                       <th>Data da postagem</th>
                                       <th>Ação</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <?php 
                                       //notícia
                                          $select = mysqli_query($mysqli,"SELECT comments.id, comments.name, comments.email, comments.postingDate, comments.comment, posts.id as postid,posts.PostTitle FROM comments JOIN posts on posts.id = comments.postId WHERE comments.status = 1");
                                          $cnt=1;

                                
                                          while ($row = mysqli_fetch_array($select))
                                       {
                                          ?>
                                          <tr>
                                             <th scope="row"><?php echo $cnt;?></th>
                                             <td><?php echo $row['name'];?></td>
                                             <td><?php echo $row['email'];?></td>
                                             <td><?php echo $row['comment'];?></td>
                                             <td><?php $st=$row['status'];

                                                echo "Aprovado";

                                                ?></td>
                                             <td><a href="edit-post.php?pid=<?php echo $row['postid'];?>"><?php echo $row['PostTitle'];?></a> </td>
                                             <td><?php echo $row['postingDate'];?></td>
                                             <td>
                                             
                                             
                                             
                                                <a href="manage-comments.php?appid=<?php echo $row['id'];?>" title="Reprovar este comentário"><i class="ion-arrow-return-right" style="color: #29b6f6;"></i></a> 
                                            
                                                &nbsp;<a href="manage-comments.php?rid=<?php echo $row['id'];?>&&action=del"> <i class="fa fa-trash-o" style="color: #f05050"></i></a> 
                                             </td>
                                          </tr>
                                          <?php
                                             $cnt++;
                                       } ?>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!--- end row -->
                  <div class="row">
                     <div class="col-md-12">
                        <div class="demo-box m-t-20">
                           <div class="m-b-30">
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
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
   </body>
</html>
<?php //} ?>