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
- `page` — номер страницы
- `per_page` — количество элементов на страницу

---

### 🔹 Получение статей по категории с пагинацией
**GET** `/api/v1/articles/category/{category}`  

Параметры запроса:
- `page` — номер страницы
- `per_page` — количество элементов на страницу

---

### 🔹 Получение статьи по slug
**GET** `/api/v1/articles/{slug}`


# Обзор наполнения

### 🔹 Главная
![Main](docs/img/main.gif)

### 🔹 Пользователи
![User.index](docs/img/user.index.gif)
![User.create](docs/img/user.create.gif)
![User.edit](docs/img/user.edit.gif)

### 🔹 Категории
![Category.index](docs/img/category.index.gif)
![Category.create](docs/img/category.create.gif)

### 🔹 Статьи
![Article.index](docs/img/article.index.gif)
![Article.create](docs/img/article.create.gif)
![Article.edit](docs/img/article.edit.gif)


# Инструкция по установке





