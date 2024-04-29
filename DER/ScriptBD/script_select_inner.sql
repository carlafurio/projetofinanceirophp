select nome_categoria, nome_usuario
	from tb_categoria
inner join tb_usuario
	on tb_categoria.id_usuario = tb_usuario.id_usuario;
    
select * from tb_conta;


select * from tb_mov;

select tipo_mov, data_mov, valor_mov, nome_usuario, nome_categoria, nome_empresa, nome_banco
	from tb_mov
    inner join tb_usuario
		on  tb_usuario.id_usuario = tb_mov.id_usuario 
	inner join tb_categoria
		on tb_categoria.id_categoria = tb_mov.id_categoria
	inner join tb_empresas
		on tb_empresas.id_empresa = tb_mov.id_empresa
	inner join tb_conta
		on tb_conta.id_conta = tb_mov.id_conta
    