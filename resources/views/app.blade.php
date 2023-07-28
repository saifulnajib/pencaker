<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" />
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            .select2-container .select2-selection--single {
                height: 42px;
                line-height: 42px;
                --tw-border-opacity: 1;
                border-color: rgb(209 213 219 / var(--tw-border-opacity));
            }
            .select2-container .select2-selection--single .select2-selection__rendered {
                line-height: 42px;
            }
            .select2-container--default .select2-selection--single .select2-selection__arrow {
                height: 42px;
            }
        </style>
    </head>

    <body class="font-sans antialiased h-screen">
        <header class="fixed top-0 w-full bg-white z-50 border-b">

        </header>
        <div class="flex flex-row min-h-screen w-full bg-gray-100 text-gray-800 pt-16">
            <main class="main w-full -ml-64 md:ml-0 transition-all duration-150 ease-in flex flex-col">
                <div class="main-content flex flex-col flex-grow p-4">
                </div>
                <footer class="footer p-6">
                    <div class="footer-content">
                        <p class="text-sm text-gray-600 text-right">©
                            <?php echo date('Y');?> Pemerintah Kota Tanjungpinang. All rights reserved.
                        </p>
                    </div>
                </footer>
            </main>
        </div>
    </body>

</html>
