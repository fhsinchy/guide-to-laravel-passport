<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Passport Client</title>

        <!-- Bulma -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    </head>
    <body>
        @include('partials._navbar')

        <div class="container">
        @isset($user)
        <div v-if="isLoggedIn" class="card">
            <div class="card-content">
                <div class="content">
                    Welcome back <strong>{{ $user['name'] }}!</strong>
                </div>
            </div>
        </div>
        @else
            <div class="notification is-danger">
                You're not logged in!
            </div>
        @endisset
        </div>
    </body>
</html>
