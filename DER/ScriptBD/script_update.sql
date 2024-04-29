-- comando para atualizar
-- update nome_da_tabela
		-- set coluna = '' ;
        
update tb_usuario
	set email_usuario = 'ana@hotmail.com',
     senha_usuario = 'ana123'
-- dizer onde
where id_usuario = 1;

update tb_mov
	set tipo_mov = 2
where id_mov = 1
