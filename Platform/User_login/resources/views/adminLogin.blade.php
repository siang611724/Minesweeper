<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">

    <style>
        /* * {
            border: 1px solid black;
        } */
        .container {
            position: relative;
        }

        .form-horizontal {
            position: absolute;
            top: 100px;
            left: 50%;
            transform: translateX(-50%);
            width: 500px;
            border: 1px solid #353a40;
            border-radius: 5px;
        }

        legend {
            background-color: #353a40;
            color: white;
            font-weight: bold;
            padding: 5px;
        }

        .form-group {
            padding: 10px;
        }
    </style>

    <title>Minesweeper Online</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <b><a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{URL::asset('/image/icon.svg')}}" alt="profile Pic" width="30" height="30" class="d-inline-block align-top">
                Minesweeper Online</a></b>
    </nav>
    <div class="container">
        <div class="form-horizontal">
            <!-- @csrf -->
        <!-- <fieldset> -->
        <!-- Form Name -->
        <legend>管理員登入</legend>
        <!-- Text input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="account">Account</label>
            <div class="col-md-10">
                <input id="account" name="account" type="text" placeholder="請輸入帳號" class="form-control input-md">  
                <!-- @error('account')
                <span style="color: red; font-size: 14px">{{ $errors->messages()['account'][0] }}</span>
                @enderror -->
                <div id="accountText">
                </div>
            </div>
        </div>
        <!-- Password input-->
        <div class="form-group">
            <label class="col-md-4 control-label" for="password">Password</label>
            <div class="col-md-10">
                <input id="password" name="password" type="password" placeholder="請輸入密碼" class="form-control input-md">
                <!-- <p id="passwordText"></p> -->
                @if($errors->has('password') && !$errors->has('account'))
                <span style="color: red; font-size: 14px">{{ $errors->messages()['password'][0] }}</span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-4">
                <button id="adminLogin" type="" class="btn btn-primary">Sign in</button>
            </div>
        </div>
        <!-- </fieldset> -->
        </div>
    </div>

    <script>
        $('#adminLogin').on('click', function() {
            var accountInput = $('#account').val();
            var passwordInput = $('#password').val();
            // $('#accountText').append("<p>123</p>");
            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/api/adminLogin',
                dataType: 'json',
                data: {
                    'account': accountInput,
                    'password': passwordInput,
                },
                success: function(result) {
                    if (result.message == 'ok') {
                        window.location.href = "/admin";
                    } else if (result.message == 'failed') {
                        alert('帳戶或密碼輸入錯誤');
                        location.reload();
                        // console.log(result.message);
                        // $('#accountText').append("<p>123</p>");
                    }
                }
            })
        }
        )
        
    </script>

</body>

</html>