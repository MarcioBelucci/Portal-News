<?php
require_once('../admin/includes/library.php');
function valida_minusculo() {
    assert(category_validation('Teste', 'teste123456789') == true);
    assert(category_validation('Testes1234', 'teste9784653212') == true);
    assert(category_validation() == false);
    assert(category_validation('teste', 'teste') == false);
    assert(category_validation('', 'teste') == false);
    assert(category_validation('T', 'testeadssdfdagdfgagfdgsa') == false);
    assert(category_validation(1, 'teste123456789123') == false);
    assert(category_validation('Teste', '123456789') == true);
}
valida_minusculo();
?>