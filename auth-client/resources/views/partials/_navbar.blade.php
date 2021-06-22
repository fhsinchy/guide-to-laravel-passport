<nav class="navbar mb-5" role="navigation" aria-label="main navigation">
    <div class="navbar-brand">
        <a class="navbar-item" href="https://bulma.io">
        <img src="https://bulma.io/images/bulma-logo.png" width="112" height="28">
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-start">
        <a href="{{ route('home') }}" class="navbar-item">
            Home
        </a>
        </div>

        <div class="navbar-end">
        <div class="navbar-item">
            <div class="buttons">
                @if (isLoggedIn())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="{{ route('logout') }}" class="button is-dark"
                        onclick="event.preventDefault();
                        this.closest('form').submit();">
                            Log out
                        </a>
                    </form>
                @else
                    <a href="{{ route('redirect') }}" class="button is-light">
                        Log in
                    </a>
                @endif
            </div>
        </div>
        </div>
    </div>
</nav>
