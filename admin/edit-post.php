<?php 
//recebe dados
include_once('includes/config.php');

if(isset($_POST['update']))
{
   $title= mysqli_real_escape_string($mysqli,$_POST['posttitle']);
   $catid= mysqli_real_escape_string($mysqli,$_POST['category']);
   $postdetails= mysqli_real_escape_string($mysqli,$_POST['postdescription']);
   $update= 'UPDATE posts SET PostTitle = "'.$title.'", CategoryId = "'.$catid.'", PostDetails = "'.$postdetails.'", UpdationDate = now() WHERE id = '.$_GET['pid'].'';
   $query = mysqli_query($mysqli,$update);
   
   if($query){
      $msg = 'Post Editada com Sucesso!';
   } else {
      $error = 'Algo deu errado, Tente Novamente!';
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
      <title>Portal Notícias | Editar Notícia</title>
      <!-- Summernote css -->
      <link href="../plugins/summernote/summernote.css" rel="stylesheet" />
      <!-- Select2 -->
      <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
      <!-- Jquery filer css -->
      <link href="../plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" />
      <link href="../plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" />
      <!-- App css -->
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
                           <h4 class="page-title">Editar Notícia </h4>
                           <ol class="breadcrumb p-0 m-0">
                              <li>
                                 <a href="#">Admin</a>
                              </li>
                              <li>
                                 <a href="#"> Notícias </a>
                              </li>
                              <li class="active">
                                 Editar Notícia
                              </li>
                           </ol>
                           <div class="clearfix"></div>
                        </div>
                     </div>
                  </div>
                  <!-- end row -->
                  <div class="row">
                     <div class="col-sm-6">
                        <!---Success Message--->  
                        <?php if($msg){ ?>
                        <div class="alert alert-success" role="alert">
                           <strong>Feito!</strong> <?php echo $msg;?>
                        </div>
                        <?php } ?>
                        <!---Error Message--->
                        <?php if($error){ ?>
                        <div class="alert alert-danger" role="alert">
                           <strong>Deu erro!</strong> <?php echo $error;?>
                        </div>
                        <?php } ?>
                     </div>
                  </div>
                  <?php
                     //noticias
                     $pid = mysqli_real_escape_string($mysqli,$_GET['pid']);
                     $selectnot = 'SELECT posts.id as postid, posts.PostTitle as title, posts.PostDetails, posts.PostImage as PostImage, category.id as catid, category.CategoryName as category FROM posts JOIN category ON posts.CategoryId = category.id WHERE posts.id = '.$pid.'';
                     $querynot = mysqli_query($mysqli, $selectnot);
                     while($row = mysqli_fetch_array($querynot))
                     {
                        
                     ?>
                  <div class="row">
                     <div class="col-md-10 col-md-offset-1">
                        <div class="p-6">
                           <div class="">
                              <form name="addpost" method="post">
                              <div class="form-group m-b-20">
                                 <label for="exampleInputEmail1">Manchete</label>
                                 <input type="text" class="form-control" id="posttitle" value="<?php echo $row['title'];?>" name="posttitle" placeholder="Coloque o título" required>
                              </div>
                              <div class="form-group m-b-20">
                                 <label for="exampleInputEmail1">Editoria</label>
                                 <select class="form-control" name="category" id="category" required>
                                    <option value="<?php echo $row['catid'];?>"><?php echo $row['category'];?></option>
                                    <?php
                                       //editorias
                                       $selectcat = 'SELECT id, CategoryName FROM category WHERE Is_Active = 1';
                                       $querycat = mysqli_query($mysqli, $selectcat);
                                       while($rowcat = mysqli_fetch_array($querycat))
                                       {
                                       ?>
                                    <option value="<?php echo $rowcat['id'];?>"><?php echo $rowcat['CategoryName'];?></option>
                                    <?php } ?>
                                 </select>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="card-box">
                                       <h4 class="m-b-30 m-t-0 header-title"><b>Notícia</b></h4>
                                       <textarea class="summernote" name="postdescription" required><?php echo htmlentities($row['PostDetails']);?></textarea>
                                    </div>
                                 </div>
                              </div>
                              <div class="row">
                                 <div class="col-sm-12">
                                    <div class="card-box">
                                       <h4 class="m-b-30 m-t-0 header-title"><b>Imagem</b></h4>
                                       <img src="postimages/<?php echo $row['PostImage'];?>" width="300"/>
                                       <br />
                                       <a href="change-image.php?pid=<?php echo $row['postid'];?>">Atualizar Imagem</a>
                                    </div>
                                 </div>
                              </div>
                              <?php } ?>
                              <button type="submit" name="update" class="btn btn-success waves-effect waves-light">Atualizar </button>
                           </div>
                        </div>
                        <!-- end p-20 -->
                     </div>
                     <!-- end col -->
                  </div>
                  <!-- end row -->
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
      <!--Summernote js-->
      <script src="../plugins/summernote/summernote.min.js"></script>
      <!-- Select 2 -->
      <script src="../plugins/select2/js/select2.min.js"></script>
      <!-- Jquery filer js -->
      <script src="../plugins/jquery.filer/js/jquery.filer.min.js"></script>
      <!-- page specific js -->
      <script src="assets/pages/jquery.blog-add.init.js"></script>
      <!-- App js -->
      <script src="assets/js/jquery.core.js"></script>
      <script src="assets/js/jquery.app.js"></script>
      <script>
         jQuery(document).ready(function(){
         
             $('.summernote').summernote({
                 height: 240,                 // set editor height
                 minHeight: null,             // set minimum height of editor
                 maxHeight: null,             // set maximum height of editor
                 focus: false                 // set focus to editable area after initializing summernote
             });
             // Select2
             $(".select2").select2();
         
             $(".select2-limiting").select2({
                 maximumSelectionLength: 2
             });
         });
      </script>
      <script src="../plugins/switchery/switchery.min.js"></script>
      <!--Summernote js-->
      <script src="../plugins/summernote/summernote.min.js"></script>
   </body>
</html>
<?php //} ?>