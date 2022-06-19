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
- PHP 7.3
- Postgres
- CakePHP 4 (Framework)
- PgAdmin 4



