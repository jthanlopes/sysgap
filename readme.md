# SysGap

Sistema para gerenciar agências, produtoras e freelancers.<br>
A aplicação contará com filtros detalhados de pesquisa, sistema de avaliação diferenciado, perfil gerenciável de usuário. 
Possibilidade de criar e gerenciar grupos de freelancers e jobs. Rankings por pontuação. Geração de relatórios e gráficos, 
sistema para pagamentos dos jobs e troca de mensagens entre os usuários.

### Pré-requisitos

Quais tecnologias são necessárias para rodar o projeto:
<ul>
  <li>PHP (https://secure.php.net/);</li>
  <li>Composer (https://getcomposer.org/);</li>
  <li>Laravel 5.4 => (https://laravel.com/);</li>
  <li>MariaDB => (https://mariadb.org/);</li>
  <li>NodeJS e NPM (https://nodejs.org/en/);</li>
</ul>

## Começando

As instruções a seguir mostrarão como instalar e configurar o ambiente para rodar o projeto.

### Instalação

O primeiro passo é baixar e instalar o <a href="https://www.apachefriends.org/pt_br/index.html">Xampp</a> (pode-se optar pelo <a href="http://www.wampserver.com/en/">Wampp</a> ou <a href="http://www.easyphp.org/">EasyPHP</a>) que é o ambiente de desenvolvimento PHP mais popular atualmente.
O Xampp já faz a instalação e configuração do Apache PHP e do MariaDB, além de outras ferramentas.

O segundo passo é instalar o Composer PHP.<br>
Faça o download no link a seguir e após o instale:
```
https://getcomposer.org/Composer-Setup.exe
```

Após a instalação do Composer devemos instalar o Laravel, abra o terminal e digite o seguinte comando:
```
composer global require "laravel/installer"
```

Para finalizar devemos instalar o NodeJS/NPM, faça o download no link a seguir e após o download faça a instação:
```
https://nodejs.org/en/
```

Pronto, o ambiente de desenvolvimento está instalado.

## Download e configuração do projeto

Agora será necessário fazer o download do projeto ou clonar o repositório.

Para fazer download do projeto, acesse o seguinte link:
```
https://github.com/jthanlopes/SysGAP/archive/master.zip
```
E pra clonar o repositório acesse este outro link:
```
https://github.com/jthanlopes/SysGAP.git
```

Após fazer o download do projeto ou clonar o repositório é necessário configurar o projeto na máquina, conforme as etapas a seguir:

1º Estartar o Xampp (Wampp ou EasyPHP) acessar o phpMyAdmin e criar uma base de dados (utilize agrupamento utf8_general_ci), para mais informações acesse:
```
https://docs.phpmyadmin.net/pt_BR/latest/
```

2º Abra o terminal dentro da raíz do projeto e rode o seguinte comando para baixar as dependências do projeto:
```
composer install
```

3º Depois rode o seguinte comando pra criar o .env do projeto:
```
composer run post-root-package-install
```

4º Abra o arquivo .env que foi criado na raíz do projeto e faça as seguintes alterações:

Configurar a base de dados:

```
DB_DATABASE=sysgap_db   =>  Nome do banco criado na primeira etapa.
DB_USERNAME=root        =>  Nome do usuário do banco, padrão => root.
DB_PASSWORD=            =>  Senha do usuário do banco, no meu caso é vazia.
```

Configurar o mailtrap, acesse https://mailtrap.io/ e crie uma conta.

```
MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=user      =>  Nome de usuário gerado no mailtrap.io
MAIL_PASSWORD=pass      =>  Senha de usuário gerado no mailtrap.io
MAIL_ENCRYPTION=null
```

Configurar o reCAPTCHA no projeto, acesse https://www.google.com/recaptcha/admin e gere um reCAPTCHA

```
RECAPTCHA_SECRET=secret =>  Secret key gerada no Google reCAPCHA.
RECAPTCHA_PUBLIC=public =>  Site key gerada no Google reCAPTCHA.
```

5º Agora digite esse comando para gerar a _key_ da aplicação:

```
composer run post-create-project-cmd
```

6º Para criar as tabelas do banco rode o seguinte comando:

```
php artisan migrate
```

7º Para instalar os componentes do Bower, execute:

```
bower install
```

8º Por fim, rode no terminal:

```
php artisan serve
```
Esse comando serve para "levantar" o servidor, para acessar o site entre no seu navegador e acesse http://127.0.0.1:8000/ (esse endereço pode variar de máquina para máquina, consulte o terminal para ver qual endereço você deve acessar).

## Licença

[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg)](https://opensource.org/licenses/MIT) <br>
Este projeto está licenciado sob a licença MIT - veja o arquivo <a href="https://github.com/jthanlopes/SysGAP/blob/master/LICENSE">LICENSE.md</a> para obter detalhes.
