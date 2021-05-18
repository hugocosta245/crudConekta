# Desafio FullStack Jr.

Este é um projeto base para alinhamento técnico de desenvolvedor fullstack jr. O mesmo foi montado em cima de imagens docker (apache e mysql), não utilizamos nenhum framework para criação do mesmo, a arquitetura utilizada é o MVC e foi utilizado o composer para a geração do arquivo de autoload.

As tecnologias utilizadas para o desenvolvimento da aplicação base foram:
	
	* HTML
	* CSS
	* Bootsrap
	* Javascript
	* Jquery/Ajax
	* PHP
	* MYSQ


## Configuração rápida
 ### Requisitos
 * Tenha o Docker e Docker-Compose instalado em sua maquina;
 
 link_ref.: https://hub.docker.com/editions/community/docker-ce-desktop-windows
 ps.: para validar a instalação execute em um terminal:
		* ```docker --version``` (deverá aparecer a versão instalada)
		* ```docker-compose --version``` (deverá aparecer a versão instalada)
 * Tenha o Composer instalado na sua maquina.
    link_ref.: https://getcomposer.org/download/
    ps.: para validar a instalação execute em um terminal 
		* ```composer --version``` (deverá aparecer a versão instalada)
 
 ### Subindo os containers

 Apos atender os requistos, vamos começar a configurar seu ambiente.
 
 * Acesse através de um terminal a pasta raiz do projeto
 * Execute no terminal -> ```composer install```
    ps.: será criado uma pasta vendor e um arquivo composer.lock na raiz do seu projeto
 * Agora vamos subir os containers, para isso acesse o terminal na pasta raiz e execute:
    -> ```docker-compose up -d```
 ps.: para validar se os containers estão executando corretamente, 
    execute -> ```docker ps```
 deverá aparecer dois container, um do apache e outro do mysql.

 Para validar se a aplicação base está configurada corretamente, 
 acesse seu navegador e insira a url -> http://127.0.0.1:8027/home

 ### Banco de dados

 Ao subir o container, já será criado uma tabela 'usuarios' e será inserido 4 registros na mesma, para mais detalhes da mesma, analisar arquivo myDb.sql que se encontra na raiz do projeto.


## Objetivos
 * Criar mascara para a coluna CPF;
 * Criar estrutura para poder inserir novo usuario;
		ps.: utilizar o botão <Novo Usuario> para exibir a view para criar novo usuario,
		pode fazer na rota /home não há necessidade de criar outra, mas fica a seu critério.
 * Adicionar botão em todas as linhas da tabela para poder excluir usuario do banco;
 * Adicionar botão em todas as linhas da tabela para editar os dados dos usuarios;
 * Adicionar view para editar os dados do usuario.
		ps.: pode fazer na rota /home não há necessidade de criar outra, mas fica a seu critério.

## Analisaremos
 * Logica de programação;
 * Organização do código;
 * Boas praticas de programação;
 * Tratamento de erros.