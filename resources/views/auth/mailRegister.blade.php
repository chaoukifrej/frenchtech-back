<!DOCTYPE html>
<html>

<head>
    <style>
        .email {
            width: 100%;
            max-width: 570px;
            margin: auto;
            box-shadow: 0 2px 0 rgb(0 0 150 / 3%), 2px 4px 0 rgb(0 0 150 / 2%);
            background: #fff;
            padding: 30px;
        }

        .content-mail {
            text-align: center
        }

        .text-blue-color {
            color: #244062;
        }

        pre code {
            display: none;
            font-family: inherit;
            white-space: pre-wrap;
        }

        .btnSend {
            background: #274062;
            color: #FFF;
            padding: 12px 30px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            vertical-align: middle;
            width: auto;
            min-width: 110px;
            text-align: center;
            margin-top: 10px;
            border: 0;
        }
#btnAdmin{
    background-color: red;
}
        .btnSend:hover {
            transform: scale(1.03);
        }

        .logo {
            margin-bottom: 50px;
            text-align: center;
            width: 180px;
        }

    </style>
</head>

<body style="background-color: #edf2f7; margin: 50px auto;">
    <div class="email">
        <div class="content-mail">
            <div class="img">
                <img class="logo" src="{{ asset('img/logo2.png') }}" alt="Logo">
            </div>
            <div style="text-align: center;" class="text-blue-color">
            </div>


            <strong>Bonjour, {{ $user->name }}</strong><br>
                <p style="text-align: center">Votre demande d'enregistrement a bien était pris en compte. <br>
                Veuillez attendre la confirmation d'un Administrateur.</p>

<br><br>
Cdt, French Tech


    </div>
    </div>

</body>

</html>
