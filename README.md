## Loja Virtual
Este é um pequeno exemplo de loja virtual, criado para fins de aprendizado utilizando as seguintes téncnologias:
- [Laravel](https://laravel.com/)
- [Livewire](https://livewire.laravel.com/)
- [Pest PHP](https://pestphp.com/) (Testes Unitários)
- [MySQL](https://www.mysql.com/)
- [MaryUI](https://mary-ui.com/) (Biblioteca de componentes Blade)
- [TailwindCSS](https://v3.tailwindcss.com/)

## Instalação
Após baixar o projeto é necessário seguir alguns passos:  

Criar o arquivo .env:

```bash
cp .env.example .env
```

Alterar as variáveis do banco de dados:
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=loja_virtual
DB_USERNAME=root
DB_PASSWORD=
```

Instalar o composer na aplicação:
```bash
composer install
```

Gerar a chave da aplicação:
```bash
./vendor/bin/sail artisan key:generate
```

Subir os containers da aplicação:
```bash
./vendor/bin/sail up -d
```

Criar o banco de dados e popular o banco das tabelas de Usuários, Estados e Endereços:
```bash
./vendor/bin/sail artisan migrate --seed
```

Popular o banco com os produtos vindos da [FakeStoreAPI](https://fakestoreapi.com/) usando filas e jobs.   
rodar a fila:
```bash
./vendor/bin/sail artisan queue:work
```

rodar os commands para popular o banco de dados com produtos:
```bash
./vendor/bin/sail artisan app:categories-command
```

```bash
./vendor/bin/sail artisan app:products-command
```
