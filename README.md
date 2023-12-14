## Sobre o projeto

Este projeto foi desenvolvido em Laravel, desde o backend ao frontend com o uso dos blades templates. Para rodar o projeto em seu computador é necessário possuir a versão mais atualizada do Docker Engine. Com ele instalado, siga os seguintes passos.

- Acesse a pasta do projeto e renomeie o arquivo .env.example para .env
- Ainda na pasta do projeto rode o comando "./vendor/bin/sail up -d"
- Rode o comando para gerar a chave da aplicação "./vendor/bin/sail artisan key:generate"
- Rode o comando para gerar o banco de dados "./vendor/bin/sail artisan migrate"
- Rode o comando para gerar o usuário administrador "./vendor/bin/sail artisan db:seed --class=CreateAdminUser"
- No navegador basta acessar a url "localhost" e o sistema estará disponível
- O usuário administrador possui as seguintes credenciais: administrator@example.com | password
- Para parar a ferramenta basta rodar o comando "./vendor/bin/sail stop"
