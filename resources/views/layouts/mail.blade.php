<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>БРИКС</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
        }

        tr {
            background: #FFFFFF;
        }

        tr:nth-child(even) {
            background: #F9F9F9;
        }

        td,
        th {
            padding: 15px;
            border-right: 1px solid #EAEAEA;
            font-size: 14px;
            text-align: start;
        }

        td:last-child,
        th:last-child {
            border-right: none;
        }

        .email-content {
            margin-left: 10px;
        }
    </style>
</head>

<body>
    <main>
        @yield('content')
    </main>
</body>

</html>
