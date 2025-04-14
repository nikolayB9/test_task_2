# Описание

<details>
<summary>В данном проекте реализуется Тестовое задание на позицию Backend-разработчика (Junior)</summary>

![Test task](docs/img/test_task.png)
</details>


# Использованные технологии

🔹 **Laravel** — фреймворк, версия 12.0  
🔹 **PHP** — версия 8.2  
🔹 **SQLite** — база данных  
🔹 **Blade** — шаблонизатор Laravel  
🔹 **AdminLTE** — панель администратора, версия 3.2.0  
🔹 **Summernote** — WYSIWYG-редактор  
🔹 **Bootstrap 4 Toggle** — плагин-переключатель  
🔹 **Sortable** — плагин сортировки


# Структура базы данных

![Database](docs/img/database.png)


# Методы API

### 🔹 Получение всех категорий
**GET** `/api/v1/categories`

---

### 🔹 Получение всех статей с пагинацией
**GET** `/api/v1/articles`  

Параметры запроса:
- `page` — номер страницы (по умолчанию = 1)
- `per_page` — количество элементов на страницу (по умолчанию = 15)

---

### 🔹 Получение статей по ID категории с пагинацией
**GET** `/api/v1/articles/category/{category}`  

Параметры запроса:
- `page` — номер страницы (по умолчанию = 1)
- `per_page` — количество элементов на страницу (по умолчанию = 15)

---

### 🔹 Получение статьи по slug
**GET** `/api/v1/articles/{slug}`


# Обзор наполнения

### 🔹 Главная

- Авторизация, главная страница:
![Main](docs/img/main.gif)

---

### 🔹 Пользователи

- Основная таблица: 
![User.index](docs/img/user.index.gif)  
  <br>
- Добавление пользователя:
![User.create](docs/img/user.create.gif)  
  <br>
- Редактирование пользователя:
![User.edit](docs/img/user.edit.gif)

---

### 🔹 Категории

- Основная таблица:
  ![Category.index](docs/img/category.index.gif)  
<br>
- Добавление, редактирование категорий:
  ![Category.create](docs/img/category.create.gif)

---

### 🔹 Статьи

- Основная таблица:
![Article.index](docs/img/article.index.gif)   
<br>
- Добавление статьи:
![Article.create](docs/img/article.create.gif)           
<br>
- Редактирование статьи:
![Article.edit](docs/img/article.edit.gif)


# Инструкция по установке

Клонируйте проект в директорию с сервером:

`git clone git@github.com:nikolayB9/test_task_2.git`

Затем, открыв из папки проекта консоль, введите команду для установки пакетов Laravel:

`composer update`

Создайте базу данных на сервере и заполните поля файла .env, находящийся в папке проекта по примеру:

`DB_CONNECTION=mysql`

`DB_HOST=127.0.0.1`

`DB_PORT=3306`

`DB_DATABASE=MAMP`

`DB_USERNAME=root`

`DB_PASSWORD=`

В открытой консоли директории проекта введите команду для генерации таблиц базы данных:

`php artisan migrate`

В открытой консоли директории проекта введите команду для генерации фейковых записей в базе данных:

`php artisan migrate --seed`

В той же консоли для запуска сайта по адресу `http://127.0.0.1:8000` введите команду:

`php artisan serve`

В новой консоли для запуска NodeJS и корректной работы введите команду:

`npm install`
`npm run dev`

В новой консоли для запуска и корректного отображения изображений введите команду:

`php artisan storage:link`

Откройте сайт в браузере по адресу  `http://localhost:8000`




