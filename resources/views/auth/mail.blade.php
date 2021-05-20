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
            @if (isset($user))
                <strong>Bonjour {{ $user->name }},</strong><br>
                <p style="text-align: center;">Vous avez 5 minutes pour vous connecter</p>
                <a class="btnSend" href="{{ ENV('VUE_APP_URL') . '/getToken/' . $url . '/' . $user->id }}">Se
                    connecter</a>
            @else
                <strong>Bonjour Administrateur : {{ $admin->firstname }},</strong><br>
                <p style="text-align: center;">Vous avez 5 minutes pour vous connecter</p>
                <a id="btnAdmin" class="btnSend" href="{{ ENV('VUE_APP_URL') . '/getTokenAdmin/' . $url . '/' . $admin->id }}">Se
                    connecter</a>
            @endif

            <br><br><br>

            <a style="text-decoration:none;text-align:right; font-style: italic; color : #274062; font-size : 13px"
                href="https://www.frenchtechcotedazur.fr/">L'équipe French Tech</a>

        </div>
    </div>
</body>

</html>
