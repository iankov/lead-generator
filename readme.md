# Процесс
1. Запускаем 100 воркеров скриптом `./run-workers.sh`
2. Запускаем генератор лидов (10000 штук) командой `php generator.php`
3. Результаты смотрим в `logs.txt`

Так как на обработку одного лида уходит 2 секунды, то при запуске 100 воркеров за 2 секунды успевает обработаться 100 лидов.
10000 лидов обработается примерно за 200 секунд + время на запись в файл итд.