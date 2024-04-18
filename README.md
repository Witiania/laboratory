Первый шаг: composer i
База PSQL используется в контейнере, поэтому перед проверкой сделует поднять контейнер
Второй шаг: docker compose up -d --build
Третий шаг: bin/console make:migration 
Четвертый шаг: bin/console doctrine:migrations:migrate 

Релизован CRUD + авторизация
При передачи данных в БД используется валидация (DTO)

1) Добавить пользователя http://localhost/api/user [POST] {string "email", string "name", string "sex", int "age"}
2) Показать пользователя http://localhost/api/user/{id} [GET] int $id
3) Редактировать пользователя http://localhost/api/user/{id} [PUT] int $id {string "email", string "name", string "sex", int "age"}
4) Удаление пользователя http://localhost/api/user/{id} [DELETE] int $id
5) Авторизация пользователя http://localhost/api/user/login [POST] {string "email", string "token"}
