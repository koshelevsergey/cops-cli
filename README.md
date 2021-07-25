# Система обработки клиентских заявок

<p>
  <a aria-label="Version">
    <img alt="" src="https://img.shields.io/badge/version-1.0.0-green?style=for-the-badge&logo=appveyor&labelColor=000000">
  </a>
  <a aria-label="Php">
    <img alt="" src="https://img.shields.io/badge/php-%207.4-blue?style=for-the-badge&logo=php&labelColor=000000">
  </a>
  <a aria-label="RabbitMQ">
    <img alt="" src="https://img.shields.io/badge/rabbitmq-%203.8-blue?style=for-the-badge&logo=rabbitmq&labelColor=000000">
  </a>
  <a aria-label="License">
    <img alt="" src="https://img.shields.io/npm/l/next.svg?style=for-the-badge&labelColor=000000">
  </a>
</p>

Простая система обработки клиентских заявок.

В системе присутствуют два пользовательских сценария (**UseCase**):
- Получение клиентских заявок с оправкой на шину сообщений;
- Получение клиентских заявок с шины сообщений и их обработка.

_**P.S.** В качестве обработки представим например формирования отчета._

**Требования системы:**
* Обработка 10 000 заявок занимает не дольше 10 минут;
* Если заявку обработать не удалось, остальные будут обрабатываться беспрепятственно;
* При успешной или не успешной обработки заявки, производится запись в **log**.

**Технические требования:**
* Объектно-ориентированный подход;
* Использование **php framework** запрещено;
* Использование **php library** разрешено;
* PHP Standards Recommendations и Type Hinting;
* Использование **docker** для работы с проектом.

**Используемые инструменты и библиотеки:**
* **vladimir163/lead-generator** - библиотека для генерации заявок;
* **monolog/monolog** - библиотека для работы с логами;
* **php-amqplib/php-amqplib** - библиотека для работы с инструментом **RabbitMQ**;
* **symfony/console** - библиотека для написания элегантных консольных команд;
* **symfony/config** и **symfony/yaml** - библиотеки для конфигурации приложения;
* **symfony/dependency-injection** - библиотека для внедрения зависимостей;
* **rabbit mq** - инструмент для работы с очередями (она же шина сообщений);
* **supervisord** - инструмент для запуска нескольких слушателей **worker**;
* **makefile** - скрипт утилиты от **make**, инструмент для удобной работы с консольными командами.

## Установка

Склонируйте проект любым удобным для себя способом.  
Используйте **docker** для разворачивания проекта.

Перейдите в проект и используйте один из вариатнов установки:

```sh
make install

# or

docker-compose build && docker-compose up -d && docker-compose exec php-fpm composer install && docker-compose exec php-fpm supervisorctl start all
```

## Использование

Используйте консоль для работы с приложением.  
Находясь в корне проекта запустите обработку клиентских заявок одним из вариантов:

```sh
make client-order-receipt

# or

docker-compose exec php-fpm php bin/console client:order:receipt
```

Подождите около 10 минут и просмотрите записи в логах по пути `var/log/*`.

## Поддержка

При возникновении проблем вы можете обращаться в раздел [issue](https://github.com/koshelevsergey/cops-cli/issues).
Для быстрого ответа укажите «ярлык».


## Содействие

Если вы хотите внести свой вклад в проект, прочтите **README.md** или **CONTRIBUTING.md** на [главной странице](https://github.com/koshelevsergey/cops-cli) репозитория.

## Лицензия

Этот проект находится под лицензией [licensed as MIT](https://github.com/koshelevsergey/cops-cli/LICENSE.md).
