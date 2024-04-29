-- comando para inserir
-- insert into nome_da tabela (colunas) values (valores)
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Ana Maria','ana@gmail.com','123456','2023-10-16');
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Maria Jose', 'maria@jose.com.br', '1234', '2023-10-16');
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Fulano', 'fulano@jose.com.br', '1234', '2023-10-16');

insert into tb_categoria
(nome_categoria, id_usuario)
values
('Alimentacao', 1);
insert into tb_empresas
(nome_empresa, tel_empresa, endereco_empresa, id_usuario)
values
('BK', '44 9999', 'Rua Rosa', 1);

insert into tb_conta
(nome_banco, num_conta, num_agencia, valor_saldo, id_usuario)
values
('Sicredi', '37906', '0718', '10000', 1);

insert into tb_mov
(tipo_mov, data_mov, valor_mov, obs_mov, id_usuario, id_empresa, id_categoria, id_conta)
values
('1', '2023-10-10', '30', 'lugar fav', 1, 1, 1, 1)