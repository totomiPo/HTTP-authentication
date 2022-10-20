HTTP аутентификация
========================

Задание
------------------------

Спроектировать и разработать систему авторизации пользователей на протоколе HTTP.

Ход работы
------------------------

- Спроектировать пользовательский интерфейс
- Описать пользовательские сценарии работы
- Описать API сервера и хореографию
- Описать структуру базы данных
- Описать алгоритмы

#### [1. Пользовательский интерфейс](https://www.figma.com/proto/gyvgKWgWAz8zX9DbhoBr8f/Lab-1?node-id=0%3A3&scaling=min-zoom&page-id=0%3A1&starting-point-node-id=0%3A3)

![Интерфейс](https://github.com/totomiPo/HTTP-authentication/blob/main/Пользовательский%20интерфейс.png)

#### 2. Пользовательский сценарий работы
Первоначально пользователь попадает на форму входа **index.php**.  
Если ранее была произведена регистрация, то он вводит логин, пароль, нажимает на кнопку "Log in" и входит в свой профиль. В случае корректного ввода пользователь перенаправляется на главную страницу **profile.php**.  
Если же введены какие-то данные неверно, то происходит возврат на страницу входа, вверху формы будет написано сообщение об ошибке.  
Если же изначально пользователь не имеет профиля, то он может перейти по ссылке “Sign up” и зарегистрироваться. В данном случае пользователь перенаправляется на страницу регистрации **signup.php**, где необходимо ввести логин, почту, пароль и подтверждение пароля и нажать на кнопку “Sign up”. В случае корректного ввода он перенаправляется на страницу **index.php**, где нужно совершить вход в свой профиль. Если же пользователь ввел какие-то данные неверно, то происходит возврат на страницу **index.php**, вверху будет написано сообщение об ошибке.  
Если пользователь случайно перешел по ссылке регистрации, то он может нажать на ссылку “Have account - *log in*”, которая вернет его обратно на форму входа.  
Если пользователь забыл пароль от существующего профиля и не может войти, то он может перейти по ссылке “Forgot your password? *Recover it*!” на странице входа, тем самым создать новый пароль. В данном случае пользователь перенаправляется на страницу изменения пароля **recovery.php**, где необходимо ввести логин, пароль и подтверждение пароля и нажать на кнопку “Recovery”. В случае корректного ввода пользователь перенаправляется на страницу **index.php**. Если же он ввел что-то неправильно, то происходит возврат на страницу восстановления пароля, вверху будет написано сообщение об ошибке.  
Когда пользователь попадает на главную страницу, то у него есть две ссылки: “Log out” и “Update password”. Первая ссылка перенаправляет пользователя на форму входа, при этом он выходит из аккаунта.  
Вторая ссылка перенаправляет на страницу смены пароля **update.php**. На этой странице нужно ввести старый, новый пароль и подтверждение нового пароля и нажать на кнопку “Update”. В случае корректного ввода пользователь перенаправляется на главную страницу **profile.php** и на ней вверху отображается сообщение об успешной смене пароля. Если же он ввел какие-то данные неверно, то происходит возврат на страницу обновления пароля, вверху будет написано сообщение об ошибке. 

#### 3. API сервера и хореография
![Хореография](https://github.com/totomiPo/HTTP-authentication/blob/main/Хореография.png)

#### 4. Структура базы данных

| Название | Тип | Длина | NULL | Описание |
| :------: | :------: | :------: | :------: | :------: |
| **id** | INT  |  | NO | Автоматический идентификатор пользователя |
| **login** | VARCHAR | 100 | NO | Логин пользователя |
| **email** | VARCHAR | 255 | NO | Почта пользователя |
| **password** | VARCHAR | 61 | NO | Хешированный пароль |


#### 5. Алгоритм

_Вход_  
![Вход](https://github.com/totomiPo/HTTP-authentication/blob/main/Вход.png)  
  
_Регистрация_  
![Регистрация](https://github.com/totomiPo/HTTP-authentication/blob/main/Авторизация.png)  
  
_Восстановление пароля_  
![Восстановление пароля](https://github.com/totomiPo/HTTP-authentication/blob/main/Восстановление%20пароля.png)  
  
_Обновление пароля_  
![Обновление пароля](https://github.com/totomiPo/HTTP-authentication/blob/main/Обновление%20пароля.png)  
#### 6. HTTP запрос/ответ
**Запрос**  
GET /register.php HTTP/1.1  
Host: test  
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9  
Upgrade-Insecure-Requests: 1  
User-Agent: Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko)   Chrome/104.0.5112.124 YaBrowser/22.9.3.893 Yowser/2.5 Safari/537.36  

**Ответ**  
HTTP/1.1 200 OK  
Cache-Control: no-store, no-cache, must-revalidate  
Connection: Keep-Alive  
Content-Length: 1016  
Content-Type: text/html; charset=UTF-8  
Date: Fri, 14 Oct 2022 20:47:24 GMT  
Expires: Thu, 19 Nov 1981 08:52:00 GMT  
Keep-Alive: timeout=120, max=1000  
Pragma: no-cache  
Server: Apache  

#### 7. Значимые фрагменты кода
```php
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($check_user) === 1) {
        $user = mysqli_fetch_assoc($check_user);
        if(password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                "id" => $user['id'],
                "email" => $user['email'],
                "login" => $user['login']
            ];
            header('Location: ../profile.php');
        } else {
            $_SESSION['message'] = 'Invalid password';
            header('Location: ../index.php');
        }
    } else {
        $_SESSION['message'] = 'Invalid username';
        header('Location: ../index.php');
    }
```
 _Вход в профиль_
```php
$check_user = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` = '$login'");
    if (mysqli_num_rows($check_user) === 0) {
        if ($password === $password_confirm) {
            if (!empty($login) || !empty($email) || !empty($password) || !empty($password_confirm)) {
                if (check_pass($password)){
                    if (check_email($email)){
                        $password_h = password_hash($password, PASSWORD_BCRYPT);
                        mysqli_query($connect, "INSERT INTO `users` (`id`, `login`, `email`, `password`) VALUES (NULL, '$login', '$email', '$password_h')");
                        header('Location: ../profile.php');
                    } else {
                        header('Location: ../register.php');
                    }
                } else {
                    header('Location: ../register.php');
                }
            } else {
                $_SESSION['message'] = "Empty field, repeat enter";
                header('Location: ../register.php');
            }

        } else {
            $_SESSION['message'] = "Passwords don't match";
            header('Location: ../register.php');
        }
    } else {
        $_SESSION['message'] = "Username already exists";
        header('Location: ../register.php');
    }
```
_Регистрация пользователя_
```php
$login = mysqli_real_escape_string($connect,$_POST['login']);
    $sql = mysqli_query($connect,"SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");
    if ($password === $password_confirm) {
        if (mysqli_num_rows($sql) === 1){
            if(check_pass($password)){
                $user = mysqli_fetch_assoc($sql);
                if(password_verify($password_old, $user['password'])) {
                    $new_password = password_hash($password, PASSWORD_BCRYPT);
                    $update = mysqli_query($connect,"UPDATE `users` SET  `password` = '$new_password' WHERE `login` = '$login' LIMIT 1");
                    if($update){
                        $_SESSION['message'] = 'Password changed successfully';
                        header('Location: ../profile.php');
                    } else {
                        $_SESSION['message'] = 'Error in data base';
                        header('Location: ../update.php');
                    }
```
_Обновление пароля_
```php
$login = mysqli_real_escape_string($connect,$_POST['login']);
    $sql = mysqli_query($connect,"SELECT * FROM `users` WHERE `login`='$login' LIMIT 1");
    if ($password === $password_confirm) {
        if (mysqli_num_rows($sql) === 1){
            if (check_pass($password)){
                $new_password = password_hash($password, PASSWORD_BCRYPT);
                $update = mysqli_query($connect,"UPDATE `users` SET  `password` = '$new_password' WHERE `login` = '$login' LIMIT 1");
                if($update){
                    $_SESSION['message'] = 'Password changed successfully';
                    header('Location: ../index.php');
                } else {
                    $_SESSION['message'] = 'Error in data base';
                    header('Location: ../recovery.php');
```
_Восстановление пароля_

Вывод
------------------------
В ходе выполнения лабораторной работы спроектировали и разработали систему авторизации пользователей.
