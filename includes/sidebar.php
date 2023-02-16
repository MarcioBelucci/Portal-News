  <div class="col-md-4">
    <!-- Search Widget -->
    <div class="card mb-4">
      <h5 class="card-header">Busca</h5>
      <div class="card-body">
        <form name="search" action="index.php" method="post">
        <div class="input-group">
          <input type="text" name="searchtitle" class="form-control" placeholder="Procure por..." required>
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Ok</button>
          </span>
        </form>
        </div>
      </div>
    </div>
    <!-- Categories Widget -->
    <div class="card my-4">
      <h5 class="card-header">Editorias</h5>
      <div class="card-body">
        <div class="row">
          <div class="col-lg-6">
            <ul class="list-unstyled mb-0">
<?php 
//editoria
$query = "SELECT category.CategoryName, category.id as cid FROM category WHERE category.Is_Active = 1";
$result = mysqli_query ($mysqli, $query );
while ($row = mysqli_fetch_array($result)) 
  {
?>
              <li>
                  <a href="index.php?catid=<?php echo $row['cid']?>"><?php echo  $row['CategoryName'];?></a>
              </li>
<?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- Side Widget -->
    <div class="card my-4">
      <h5 class="card-header">Notícias recentes</h5>
      <div class="card-body">
        <ul class="mb-0">
<?php
//notícias
$query = "SELECT posts.id as pid, posts.PostTitle as posttitle FROM posts WHERE posts.Is_Active = 1  ORDER BY posts.id DESC LIMIT 3";
$result = mysqli_query ($mysqli, $query );
while ($row = mysqli_fetch_array($result)) 
  {
?>
          <li>
            <a href="news-details.php?nid=<?php echo $row['pid']?>"><?php echo $row['posttitle'];?></a>
          </li>
<?php } ?>
        </ul>
      </div>
    </div>
  </div>