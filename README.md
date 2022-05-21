# technologie-internetowe-gazeta
Projekt "gazetki szkolnej" (InfoKiosku) na potrzeby przedmiotu Technologie internetowe w AHNS w Radomiu.
***
**Możliwości**

InfoKiosk jest kompaktową aplikacją, umożliwiającą wyświetlanie uprzednio przygotowanych artykułów na dużym ekranie LCD (wystawionym np. na holu budynku), bądź też na urządzeniach mobilnych.

Aplikacja jest zgodna ze standardem RWD, dzięki czemu dopasuje się zarówno do dużego wyświetlacza, jak i małego ekranu smartfona, dzięki czemu gazetka będzie czytelna również dla uczniów/studentów.

Administrator ma możliwość stworzenia nowego artykułu (z opcjonalną, dodatkową grafiką), edycji, bądź usunięcia już istniejącego artykułu, zmiany nazwy uczelni, koloru górnej belki, bądź też dodania dodatkowego komunikatu, wyświetlającego się w dodatkowej, czerwonej belce.

Użytkownik ma również możliwość przeglądania archiwalnych artykułów. Lista artykułów dostępna jest spod zakładki **Archiwum**. Artykuły są sortowane w kolejności chronologicznej.
***
**Przykładowy wygląd strony głównej**

![Alt]( https://i.imgur.com/g5Aq7Qq.png "Przykładowy wygląd strony głównej")
***
**Panel administracyjny**

![Alt]( https://i.imgur.com/bq8bX1G.png "Panel administracyjny")
***
**Edycja artykułu**

![Alt]( https://i.imgur.com/zSYX62W.png "Panel administracyjny")

***
**Wymagania**
- Serwer WWW,
- PHP (zalecana wersja **8**),
- MySQL
***
**Instalacja**

* Umieść zawartość repozytorium do głównego katalogu na serwerze WWW,
* Zaimportuj bazę danych z pliku **kiosk.sql** do swojego serwera MySQL (np. za pomocą **phpMyAdmin**),
* Edytuj plik **/includes/mysql.php**, wprowadzając dane dotyczące Twojej bazy danych (adres IP, nazwa użytkownika, hasło, nazwa bazy danych),
* (**opcjonalnie**) Edytuj dane logowania do panelu administracyjnego. (plik **/includes/admin.php**, domyślnie login **admin**, hasło **admin4321**)
