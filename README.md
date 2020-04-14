# Companion SFA

#### Uruchomienie projektu
1. zainstaluj docker https://docs.docker.com/install/
2. zainstaluj docker-compose https://docs.docker.com/compose/install/
3. odblokuj port 80
4. uruchom skrypt /docker/start.sh
5. uruchom skrypt /docker/first-run-commands.sh

#### Propozycja struktura modułu
    /src
        /ExampleModule
            /Api (public) 
                ExampleModuleApiController.php
                ...
                - lista endpointów może być więcej klas controllerów
            /Aggregate (public)
                - https://medium.com/ingeniouslysimple/aggregates-in-domain-driven-design-5aab3ef9901d
                - tutaj można wykorzysytawać klasy pomocnicze z katalogu /Infrastructure
                /Command
                    User.php
                    Group.php
                    ...
                    - przykładowo User::changePasssword('newpass'), User::addRole('ADMIN') 
                /Query
                    User.php
                    Group.php
                    ...
                    - metody pobierające dane z bazy, łączenie, przetwarzanie danych
            /Domain (private)
                /Entity
                    ExampleEntity.php
                    Example2Entity.php
                    ...
                    - lista encji modułu
                /Repository
                    ExampleRepository.php
                    Example2Repository.php
                    ...
                    - lista klas z zapytaniami do tabel
                /ValueObject
                    Currency.php
                    FirstName.php
                    ...
                    - FirstName.php przykładowo może przyjąć tylko string składający się z samych liter bez liczb lub znaków specjalnych inaczej rzucamy wyjątek
                    - https://codete.com/blog/value-objects/
            /Infrastructure (private)
                /EventListener
                    StatisticListener.php
                    ...
                    - przykładowo klasa która automatycznie zapisuje log uruchomienia każdego endpointu
                /Resources
                    /config
                        services.yml
                        ...
                        - pliki konfiguracyjne modułu
                /Migrations
                    - wersji migracji z sqlkami do tworzenia, modyfikacji tabel modułu
                /Util
                    - dowolne klasy, interfejsy wspomagające pobieranie danych czy wykonywania akcji
            /Tests (private)
                - testy modulu
                    
public - pliki/katalogi są dostępne dla innych modułów

private - pliki/katalogi mogą być używane tylko w obrębie modułu

Wzorowałem się na przykładzie z https://www.fabian-keller.de/blog/domain-driven-design-with-symfony-a-folder-structure/

#### Xdebug
Tutorial do konfiguracji phpstorm https://dev.to/brpaz/docker-phpstorm-and-xdebug-the-definitive-guide-14og

Port: **9003**

IDE-KEY(session id): **xdebug**

Ścieżka do projektu w kontenerze: **/var/www/html**

Wymagana jest jedna z najnowszych wersji phpstorm z php7.3 na starszych wersjach może nie działać