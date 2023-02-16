<?php

    class Api {
        private $conexao;
        private function Connection() {

            $this->conexao = new mysqli("localhost", "root", "", "news");

        }
        public function Get($id) {
            $this->Connection();
            $result = $this->conexao->query('SELECT posts.id as pid, category.CategoryName as category, posts.PostTitle as posttitle, posts.CategoryId as cid,  posts.UpdationDate, CONCAT("admin/postimages/", posts.PostImage) as postimage FROM posts LEFT JOIN category ON category.id = posts.CategoryId WHERE posts.id = ' .  $id . ' AND posts.Is_Active = 1');
            if($result->num_rows < 1) return json_encode(['error' => 'Noticia não existente']);
            $itens = $result->fetch_all(MYSQLI_ASSOC);
            if(count($itens) > 0) return json_encode($itens[0], JSON_UNESCAPED_SLASHES);
            var_dump($itens);
        }
    }
    $api = new Api();
    echo isset($_GET['pid']) && $intval($_GET['pid']) > 0 ? $api->Get($_GET['pid']) : json_encode(['error' => 'noticia não existente']);
    
    $ch = curl_init("http://localhost/aula/news/api/api.php");
    var_dump(json_decode(curl_exec($ch), true));    
    $ch = curl_init("http://localhost/aula/news/get.php?pid=7");
    var_dump(json_decode(curl_exec($ch), true));    

?>