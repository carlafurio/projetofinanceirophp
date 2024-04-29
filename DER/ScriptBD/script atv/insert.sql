insert into tb_acesso
(login, senha, status)
values
('CFURIO', '1234', 1);

insert into tb_empresa
(nome, acesso_id)
values
('Furio Empreendimentos', 1);

insert into tb_funcionario
(nome, data_admissao, empresa_id, acesso_id)
values
('Jose Silva', '2023-01-01', 1, 1);
insert into tb_funcionario
(nome, data_admissao, empresa_id, acesso_id)
values
('Maria Santos', '2023-01-30', 1, 1);
insert into tb_funcionario
(nome, data_admissao, empresa_id, acesso_id)
values
('Fulano Beltrano', '2023-10-01', 1, 1);

insert into tb_cargo (nome_cargo) values ('Auxiliar Administrativo');
insert into tb_cargo (nome_cargo) values ('Analista Financeiro');
insert into tb_cargo (nome_cargo) value ('Gerente');

insert into tb_cargo_funcionario
(id_cargo, id_funcionario, data_inicio)
values
(1, 1, '2023-01-01');
insert into tb_cargo_funcionario
(id_cargo, id_funcionario, data_inicio)
values
(2, 2, '2023-01-30');
insert into tb_cargo_funcionario
(id_cargo, id_funcionario, data_inicio)
values 
(3, 3, '2023-10-01');

insert into tb_pais (nome_pais) values ('Brasil');
insert into tb_estado (nome_estado, sigla_estado, id_pais) values ('Paraná', 'PR', 1);
insert into tb_cidade (nome_cidade, id_estado) values ('Douradina', 1); 
insert into tb_cidade (nome_cidade, id_estado) values ('Londrina', 1);
insert into tb_cidade (nome_cidade, id_estado) values ('Umuarama', 1);

insert into tb_endereco 
(rua, bairro, cep, complemento, id_funcionario, id_cidade)
values
('Rua das Flores', 'Centro', '86025410', 'Apto 101', 1, 1);

insert into tb_endereco
(rua, bairro, cep, complemento, id_funcionario, id_cidade)
values
('Rua Nova', 'Centro', '87485000', 'Casa', 1, 2);

insert into tb_endereco
(rua, bairro, cep, complemento, id_funcionario, id_cidade)
values
('Avenida Parana', 'Centro', '89557520', 'Sala 01', 3, 3);

insert into tb_cliente
(nome, data_nascimento, id_funcionario)
values
('Julia Furio', '2009-03-10', 1);

insert into tb_endereco
(rua, bairro, cep, id_cliente, id_cidade)
values
('Rua Sossai', 'Ana Laura', '87485000', 1, 1);

insert into tb_cliente
(nome, data_nascimento, id_funcionario)
values
('Livia Furio', '2011-06-15', 2);

insert into tb_endereco
(rua, bairro, cep, id_cliente, id_cidade)
values
('Rua Gigante', 'Centro', '87558000', 2, 2);

insert into tb_cliente 
(nome, data_nascimento, id_funcionario)
values
('Lucas Furio', '2013-07-26', 3);

insert into tb_endereco
(rua, bairro, cep, id_cliente, id_cidade)
values 
('Rua Volpato', 'Ana  Laura', '87545000', 3, 3);


insert into tb_acesso
(login, senha, status)
values
('JOSESILVA', '1234', 1);

insert into tb_acesso
(login, senha, status)
values
('MARIASANTOS', '1234', 1);

insert into tb_acesso
(login, senha, status)
values
('FULANOBELTRANO', '1234', 1);







