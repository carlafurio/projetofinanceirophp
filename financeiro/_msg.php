<?php
if (isset($_GET['ret'])) {
    $ret = $_GET['ret'];
}


if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
                    Preencher o(s) campo(s) obrigatório(s)
                </div>';

            break;

        case 1:
            echo '<div class="alert alert-success">
                Dados gravados com sucesso!
            </div>';

            break;
        case 2:
            echo '<div class="alert alert-success">
                Cadastro realizado com sucesso! Faça seu Login:
            </div>';

            break;
        case 4:
            echo '<div class="alert alert-success">
                Senha alterada com sucesso!
            </div>';

            break;

        case -1:
            echo '<div class="alert alert-danger">
            Ocorreu um erro, tente mais tarde.
        </div>';

            break;

        case -2:
            echo '<div class="alert alert-danger">
           Campo senha deve conter no mínimo 6 caracteres.
        </div>';
            break;

        case -3:
            echo '<div class="alert alert-danger">
           As senhas não conferem.
        </div>';
            break;
        case -4:
            echo '<div class="alert alert-danger">
           E-mail invalido.
        </div>';
            break;
        case -5:
            echo '<div class="alert alert-danger">
           O registro não poderá ser excluído, pois está em uso!
        </div>';
            break;
        case -6:
            echo '<div class="alert alert-danger">
               E-mail já cadastrado!
            </div>';
            break;
        case -7:
            echo '<div class="alert alert-danger">
               Usuário não encontrado!
            </div>';
            break;
        case -8:
            echo '<div class="alert alert-danger">
              A senha não atende os requisitos, deve contar uma letra minúscula, uma maiúscula e um número!
            </div>';
            break;
        case -9:
            echo '<div class="alert alert-danger">
            Senha incorreta!
          </div>';
    
        
    }
}
