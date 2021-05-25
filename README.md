# Olá.

comprir todos os requido abaixo 
ass
Hugo Costa

# Desafio FullStack Jr.

Este é um projeto base para alinhamento técnico de desenvolvedor fullstack jr. O mesmo foi construido apartir de imagens docker (apache e mysql), não utilizamos nenhum framework para criação do mesmo, utilizamos arquitetura MVC e o composer para a geração do arquivo de autoload.

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
 * Instale o Docker e o Docker-Compose em sua maquina;
 
    link_ref.: https://hub.docker.com/editions/community/docker-ce-desktop-windows
 
    Para validar a instalação execute em um terminal:
    * ```docker --version``` (deverá aparecer a versão instalada)
    * ```docker-compose --version``` (deverá aparecer a versão instalada)
 * Instale o Composer em sua maquina.
    
    link_ref.: https://getcomposer.org/download/
    
    Para validar a instalação execute em um terminal 
    * ```composer --version``` (deverá aparecer a versão instalada)
 
 ### Subindo os containers

 Após atender os requistos, vamos começar a configurar seu ambiente.
 
 * Acesse através de um terminal a pasta raiz do projeto
 * Execute no terminal ```composer install```
   
    ps.: será criado uma pasta ```vendor``` e um arquivo ```composer.lock``` na raiz do seu projeto
 
 * Agora vamos subir os containers, para isso acesse o terminal na pasta raiz e execute:```docker-compose up -d```
 * Para validar se os containers estão executando corretamente, 
    execute ```docker ps``` deverá aparecer dois container, um do apache e outro do mysql.

 * Para validar se a aplicação base está configurada corretamente, acesse pelo seu navegador:
    http://127.0.0.1:8027/home

 ### Banco de dados

 Ao subir o container, será criado uma tabela ```usuarios``` e será inserido 4 registros na mesma, para mais detalhes, analisar arquivo ```myDb.sql``` que se encontra na raiz do projeto.


## Objetivos
 * Criar mascara para a coluna CPF;
 * Criar estrutura para poder inserir novo usuario;
 * Adicionar botão em todas as linhas da tabela para excluir usuario do banco;
 * Adicionar botão em todas as linhas da tabela para editar os dados dos usuarios e criar estrutura para editar os usuarios;


## Analisaremos
 * Logica de programação;
 * Organização do código;
 * Boas praticas de programação;
 * Tratamento de erros.
