<?php
class Api {
    private $conexao;
    private function Connection() {
        $this->conexao = new mysqli("localhost", "root", "", "news");
    }
    public function Get() {
        $this->Connection();
        $result = $this->conexao->query('SELECT posts.id as pid, category.CategoryName as category, posts.PostTitle as posttitle, posts.CategoryId as cid,  posts.UpdationDate, CONCAT("admin/postimages/", posts.PostImage) as postimage FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.Is_Active = 1');
        $itens = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode($itens, JSON_UNESCAPED_SLASHES);
    }
}
$api = new Api();
$api->Get();
?>