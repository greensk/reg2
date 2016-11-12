Тестовое приложение на Yii2: регистрация участников конференции
===============================

## Инструкции по установке

1. Выполнить клонированрие репозитория командой `git clone`, либо с использованием SmartGit. Проследите за тем, чтобы имя директории не содержало в себе `.git`.
2. Настроить веб сервер: создать два витуальных домена, один для публичной части проекта, соответствующий директории `frontend/web`, другой для администраторской части, соответствующий директории `backend/web`.
3. Открыть командную строку (консоль), перейти в директорию проекта, выполнить `composer install`
4. Выполнить в командной строке `init`.
5. Создать базу данных MySQL и пользователя MySQL.
6. Указать параметры подключения к базе данных MySQL (имя базы данных, имя пользователя, пароль) в файле `common/config/main-local.php`.
7. В командной строке выполнить `yii migrate/up`. Если выполнение завершилось ошибкой, значит неверно указаны параметры подключение к базе данных MySQL.
8. Приложение должно работать. В администраторской части по-молчанию имя пользователя `admin`, пароль `admin`.

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
tests                    contains various tests for the advanced application
    codeception/         contains tests developed with Codeception PHP Testing Framework
```
