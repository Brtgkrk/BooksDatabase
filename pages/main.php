    <header class="container-fluid">
        <div class="row">
            <div class="col"><img src="images/booksDatabase.svg" alt="booksDatabaseLogo"></div>
            <nav class="col">
                <button class="b-transparent" id="btn-login" data-toggle="modal"
                    data-target="#loginModal">Zaloguj</button>
                <button class="b-transparent" id="btn-register" data-toggle="modal"
                    data-target="#registerModal">Zarejestruj</button>
            </nav>
        </div>
    </header>
    <div id="content" class="container">

        <!--Login Canvas-->
        <div id="loginModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Proszę się zalogować</h3>
                    </div>
                    <div class="modal-body">
                        <form action="pages/login.php" id="login-form" method="post">
                            <label for="username">Nazwa użytkownika:</label>
                            <input class="form-control" id="log-username" name="username"
                                placeholder="Podaj swoją nazwę użytkownika" type="text" />

                            <label for="password">Hasło:</label>
                            <input class="form-control" id="log-password" name="password"
                                placeholder="Podaj swoje hasło" type="password" />

                            <button class="btn btn-success" form="login-form" name="loginButton" type="submit"
                                value="Submit" id="lgn-button">Zaloguj się</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    </div>
                </div>

            </div>
        </div>

        <!--Register Canvas-->
        <div id="registerModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3>Proszę się zarejestrować</h3>
                    </div>
                    <div class="modal-body">
                        <form action="pages/register.php" id="register-form" method="post">
                            <label for="username">Nazwa użytkownika:</label>
                            <input class="form-control" id="reg-username" name="username"
                                placeholder="Wpisz nazwę użytkownika tutaj" type="text" />
                            <div id="user-feedback" class="alert-danger"></div>

                            <label for="password">Hasło:</label>
                            <input class="form-control" id="password" name="password" placeholder="Podaj nowe hasło"
                                type="password" />
                            <input class="form-control" id="password_confirm" name="password_confirm"
                                placeholder="Powtórz hasło" type="password" />
                            <div id="pass-feedback" class="alert-danger"></div>
                            <div id="pass-repeat-feedback" class="alert-danger"></div>

                            <input class="form-control" id="email" name="email" placeholder="Podaj Email"
                                type="email" />

                            <input type="checkbox" class="custom-control-input" name="reg" id="customCheck"
                                name="example1">
                            <label class="custom-control-label" for="customCheck" id="customCheckL">Akceptuje warunki
                                regulaminu</label>

                            <div class="g-recaptcha" data-sitekey="6LfQ9dMUAAAAAMU88oc82ZCGnG1LjzxL_ZQ5j3Lv"></div>

                            <input class="b-green" id="reg-button" type="submit" value="Zarejestruj się" />
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Anuluj</button>
                    </div>
                </div>

            </div>
        </div>

        <div id="description" class="col">
            <h1>Witaj na stronie BooksDatabase</h1>
            <p>Serwis udostępnia możliwość katalogowania prywatnych zbiorów swoich książek. Użytkownik może dodawać
                książki, autorów, gatunki oraz inne podstawowe informacje. Technologie użyte do stworzenia serwisu:
                HTML, SASS/CSS, Bootstrap, JS, JQuery, Ajax, PHP. Twórca serwisu Jakub Krok. Kod źródłowy: <a
                    href="https://github.com/Brtgkrk/BooksDatabase"
                    target="_blank">https://github.com/Brtgkrk/BooksDatabase</a> </p>
        </div>
        <div id="reg" class="col">
            <h2>Regulamin</h2>
            <p>Strona stworzona do użytku własnego, jeżeli chcesz możesz z niej korzystać, aczkolwiek nie odpowiadam
                za
                zabezpieczanie twoich danych i w przypadku jakiejkolwiek ich utraty (np. przy usuwaniu bazy danych)
                nie
                gwarantuje ich dalszej archiwizacji. Nie ponoszę też odpowiedzialności za dane umieszczane przez
                użytkowników. Dane które łamią polskie prawo będą usuwane. W razie jakichkolwiek problemów pisz do
                mnie
                na email: <a href="mailto:pomoc@krok.pl">pomoc@jkrok.pl</a>.</p>
        </div>
    </div>

    <!--3rdPartScripts-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script src="styles/bootstrap/js/bootstrap.min.js"></script>
    <!--<script src="scripts/jquery/jquery-3.5.1.min.js"></script>-->
    <!--userScripts-->
    <script src="scripts/javaScript/userRegister.js"></script>
    <script src="scripts/javaScript/userLogin.js"></script>
    <script src="scripts/javaScript/checkSession.js"></script>
    <!--<script src="scripts/javaScript/reglogButtons.js"></script>-->
    