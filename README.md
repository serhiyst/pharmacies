
Это приложения было создано для фарм отдела компании Эльфа Лаборатория с целью формирования и управления базой аптек с которыми налажено сотрудничество

Пользователями приложения являются 4 торговых представителя и их руководитель

- Торговые представители могут просматривать, редактировать и удалять только свои торговые точки, также есть возможность передать аптеку изменив имя торгового представителя
- Руководитель может совершать любые действия с любыми торговыми точками
- Добавление и удаление аптеки считается важным событием поэтому руководителю отправляется email с уведомлением. Также при редактировании опционально можно уведомить руководителя об изменениях
- Для удобства работы доступна панель быстрой навигации по аптечным сетям или рознице
- Есть возможность быстрого поиска по юр. лицам через верхнюю панель, а также есть расширенный поиск по одному или комбинации параметров

Для демонстрации работы приложения и наполнения базы данных был подготовлен DatabaseSeeder, а также фабрика модели для данных по аптекам. Некоторые колонки (названия юр. лиц, адреса и ФИО заведующих) будут заполнены данными на украинском языке, остальные на русском (так же как и в реальности).
Все имена и фамилии, в том числе пользователей ненастоящие, сгенерированы генератором имен.

Установка и использование

- Клонируйте репозиторий с помощью git clone
- Скопируйте данные из .env.example в .env и отредактируйте в нем данные подключениия к бд (и по желанию mailtrap)
- Далее composer install
- Далее php artisan key:generate
- Далее php artisan migrate --seed

Данные для входа:
admin@example.com - password
user1@example.com - password
user2@example.com - password
user3@example.com - password
user4@example.com - password
