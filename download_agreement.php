<?php
// Конфиденциальное соглашение
$agreement_content = "Конфиденциальное соглашение:\n\n1. Пункт 1\n2. Пункт 2\n3. Пункт 3\n\nДанное соглашение является обязательным для исполнения.";

// Устанавливаем заголовки для скачивания файла
header('Content-Type: text/plain');
header('Content-Disposition: attachment; filename="confidential_agreement.txt"');
header('Content-Length: ' . strlen($agreement_content));

// Отправляем содержимое файла
echo $agreement_content;
exit;
?>
