## Requisitos do projeto
- docker
- docker-compose

## Iniciando o projeto
- Ir na raiz do projeto onde se encontra o arquivo `docker-compose.yml` e rodar o seguinte comando: `docker-compose build app`
- Após o término do build, iniciar todos os containers necessários com: `docker-compose up -d`
- Para acessar o container da aplicação com o bash rode: `docker-compose exec app bash`

## Estrutura do Sistema
- Docker
- Nginx
- Mysql
- PHP 7.3
- CakePHP 4 (Framework)

# Premissas
- O projeto a ser desenvolvido se trata de um sistema de CRUD e classificação para corrida, seguindo as diretrizes do arquivo `projeto.md`.
- Como se trata de um sistema para disponibilização de Rest API e o navegador (usando os meios normais) só disponibiliza GET e POST, estaremos utilizando o `Postman` para realizar a comunicação. Uma JSON com os serviços está sendo disponibilizada na raiz na pasta `Postman`.

# Sobre o Projeto
- Mesmo se tratando de uma aplicação simples, foi utilizado o CakePHP como framework proposto, ele já possui diversos recursos para disponibilização de recursos RestFul.
- O Cake ainda fornece um recurso que agiliza a criação de Controllers, Model, View e Test.  
  O `bake`, basta ter a conexão com o banco de dados e informar a tabela que deseja referenciar.  
  O `bake` cria toda uma estrutura para trabalhar com a tabela criando ainda um CRUD simples com todos os campos da tabela.