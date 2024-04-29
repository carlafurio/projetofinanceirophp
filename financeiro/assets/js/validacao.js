

///////////////VALIDACOES LOGIN E CADASTRO/////////////
function validarLogin() {
    var email = $("#email").val();
    var senha = $("#senha").val();

    var verificador = true;
    var campos = "";

    if (email.trim() == '') {
        campos = "- SEU E-MAIL\n";
        $("#divEMAIL").addClass("has-error");
        $("#email").focus();
        verificador = false;
    } else {
        $("#divEMAIL").removeClass("has-error").addClass("has-success");
    }
    if (senha.trim() == '') {
        campos += "- SUA SENHA"
        $("#divSENHA").addClass("has-error");
        $("#senha").focus();
        verificador = false;
    } else {
        $("#divSENHA").removeClass("has-error").addClass("has-success");
    }

    if (!verificador) {
        alert("Preencher os campos: \n" + campos);
    }

    return verificador;
}
function validarCad() {
    var nome = $("#nome").val();
    var email = $("#email").val();
    var senha = $("#senha").val();
    var repsenha = $("#repsenha").val();

    var verificador = true;
    var campos = "";

    if (nome.trim() == '') {
        campos = "- SEU NOME\n";
        $("#divNOME").addClass("has-error");
        $("#nome").focus();
        verificador = false;
    } else {
        $("#divNOME").removeClass("has-error").addClass("has-success");
    }
    if (email.trim() == '') {
        campos += "- SEU E-MAIL\n";
        $("#divEMAIL").addClass("has-error");
        $("#email").focus();
        verificador = false;
    } else {
        $("#divEMAIL").removeClass("has-error").addClass("has-success");
    }
    if (senha.trim() == '') {
        campos += "- CRIE SUA SENHA\n"
        $("#divSENHA").addClass("has-error");
        $("#senha").focus();
        verificador = false;
    } else {
        $("#divSENHA").removeClass("has-error").addClass("has-success");
    }
    if (repsenha.trim() == '') {
        campos += "- REPITA SUA SENHA"
        $("#divREPSENHA").addClass("has-error");
        $("#repsenha").focus();
        verificador = false;
    } else {
        $("#divREPSENHA").removeClass("has-error").addClass("has-success");
    }

    if (!verificador) {
        alert("Preencher os campos: \n" + campos);
    }

    return verificador;
}
///////////////VALIDACOES MEUS DADOS/////////////
function validarMeusDados() {
    var email = $("#email").val();
    var nome = $("#nome").val();

    var verificador = true;
    var campos = "";

    if (nome.trim() == '') {
        campos = "- NOME\n";
        $("#divNOME").addClass("has-error");
        $("#nome").focus();
        verificador = false;
    } else {
        $("#divNOME").removeClass("has-error").addClass("has-success");
    }
    if (email.trim() == '') {
        campos += "- E-MAIL"
        $("#divEMAIL").addClass("has-error");
        $("#email").focus();
        verificador = false;
    } else {
        $("#divEMAIL").removeClass("has-error").addClass("has-success");
    }

    if (!verificador) {
        alert("Preencher os campos: \n" + campos);
    }

    return verificador;

}
function validarSenhaAlt() {
    var senha = $("#novasenha").val();
    var repsenha = $("#repsenha").val();

    var verificador = true;
    var campos = "";

    if (senha.trim() == '') {
        campos = "- NOVA SENHA\n";
        $("#divNSENHA").addClass("has-error");
        $("#novasenha").focus();
        verificador = false;
    } else {
        $("#divNSENHA").removeClass("has-error").addClass("has-success");
    }
    if (repsenha.trim() == '') {
        campos += "- REPITA NOVA SENHA"
        $("#divREPSENHA").addClass("has-error");
        $("#repsenha").focus();
        verificador = false;
    } else {
        $("#divREPSENHA").removeClass("has-error").addClass("has-success");
    }

    if (!verificador) {
        alert("Preencher os campos: \n" + campos);
    }

    return verificador;
}
function validarSenha() {
    var senha = $("#senha").val();
    var verificador = true;
    var campos = "";

    if (senha.trim() == '') {
        campos = "- SENHA ATUAL\n";
        $("#divSENHA").addClass("has-error");
        $("#senha").focus();
        verificador = false;
    } else {
        $("#divSENHA").removeClass("has-error").addClass("has-success");
    }
    if (!verificador) {
        alert("Preencher os campos: \n" + campos);
    }

    return verificador;
}
/////////VALIDACOES CATEGORIA//////////////
function validarCategoria() {
    var verificadorcateg = true;

    if ($("#categoria").val().trim() == '') {
        alert("Preencher o campo: \n- NOME DA CATEGORIA");
        $("#divCATEGORIA").addClass("has-error");
        $("#categoria").focus();
        verificadorcateg = false;
    } else {
        $("#divCATEGORIA").removeClass("has-error").addClass("has-success");
    }
    return verificadorcateg;
}
///////////////VALIDACOES CONTA/////////////
function validarConta() {
    var verificadorconta = true;
    var camposconta = "";


    if ($("#banco").val().trim() == '') {
        camposconta = "- BANCO\n";
        $("#divBANCO").addClass("has-error");
        $("#banco").focus();
        verificadorconta = false;
    } else {
        $("#divBANCO").removeClass("has-error").addClass("has-success");
    }

    if ($("#conta").val().trim() == '') {
        camposconta += "- CONTA\n";
        $("#divCONTA").addClass("has-error");
        $("#conta").focus();
        verificadorconta = false;
    } else {
        $("#divCONTA").removeClass("has-error").addClass("has-success");
    }

    if ($("#agencia").val().trim() == '') {
        camposconta += "- AGÊNCIA\n";
        $("#divAGENCIA").addClass("has-error");
        $("#agencia").focus();
        verificadorconta = false;
    } else {
        $("#divAGENCIA").removeClass("has-error").addClass("has-success");
    }

    if ($("#saldo").val().trim() == '') {
        camposconta += "- SALDO\n";
        $("#divSALDO").addClass("has-error");
        $("#saldo").focus();
        verificadorconta = false;
    } else {
        $("#divSALDO").removeClass("has-error").addClass("has-success");
    }

    if (!verificadorconta) {
        alert("Preencher os campos: \n" + camposconta)
    }
    return verificadorconta;
}
////////////////////VALIDACOES EMPRESA/////////////////
function validarEmpresa() {
    var verificadorempresa = true;

    if ($("#nomeempresa").val().trim() == '') {
        camposempresa = "- NOME\n";
        $("#divEMPRESA").addClass("has-error");
        $("#nomeempresa").focus();
        verificadorempresa = false;
    } else {
        $("#divEMPRESA").removeClass("has-error").addClass("has-success");
    }


    if (!verificadorempresa) {
        alert("Preencher os campos: \n" + camposempresa);
    }
    return verificadorempresa;
}
////////////////////VALIDACOES MOVIMENTO///////////////
function validarMovimentoNew() {
    
        var verificadormov = true;
        var camposmovimento = "";
    
        if($("#tipo").val() == ''){
            camposmovimento = "- TIPO DE MOVIMENTO\n";
            $("#divTIPO").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divTIPO").removeClass("has-error").addClass("has-success");
        }

        if($("#data").val().trim() == ''){
            camposmovimento += "- DATA\n";
            $("#divDATA").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divDATA").removeClass("has-error").addClass("has-success");
        }

        if($("#valor").val().trim() == ''){
            camposmovimento += "- VALOR\n";
            $("#divVALOR").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divVALOR").removeClass("has-error").addClass("has-success");
        }

        if($("#categoria").val() == ''){
            camposmovimento += "- CATEGORIA\n";
            $("#divCATEGORIA").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divCATEGORIA").removeClass("has-error").addClass("has-success");
        }

        if($("#empresa").val() == ''){
            camposmovimento += "- EMPRESA\n";
            $("#divEMPRESA").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divEMPRESA").removeClass("has-error").addClass("has-success");
        }
        if($("#conta").val() == ''){
            camposmovimento += "- CONTA\n";
            $("#divCONTA").addClass("has-error");
            verificadormov = false;
        } else {
            $("#divCONTA").removeClass("has-error").addClass("has-success");
        }

        if (!verificadormov) {
            alert("Preencher os campos: \n" + camposmovimento);
    
        }
        return verificadormov;
    
}

function validarConsultaMov() {
    var verificadorconsmov = true;
    var camposdata = "";

    if ($("#dt_inicial").val().trim() == '') {
        camposdata = "Data Inicial\n";
        $("#divDt_inicial").addClass("has-error");
        verificadorconsmov = false;
    } else {
        $("#divDt_inicial").removeClass("has-error").addClass("has-success");
    }
    if ($("#dt_final").val().trim() == '') {
        camposdata += "Data Final";
        $("#divDt_final").addClass("has-error");
        verificadorconsmov = false;
    } else {
        $("#divDt_final").removeClass("has-error").addClass("has-success");
    }
    
    if(!verificadorconsmov) {
        alert("Preencher os campos: \n" + camposdata);
    }
    return verificadorconsmov;
}