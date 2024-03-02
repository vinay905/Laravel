<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>

    <h1 class="text-center">Register</h1>
    <div class="d-flex justify-content-center">
    <form method="post" action="{{route('store')}}" class=" col">
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputEmail4">First-Name</label>
                <input type="text" class="form-control" name="first_name" id="fname" required>
                @if($errors->has('first_name'))
                <div class="error">{{ $errors->first('first_name') }}</div>
                @endif
            </div>
            <div class="form-group col-md-2">
                <label for="inputPassword4">Last-Name</label>
                <input type="text" class="form-control" name="last_name" id="lname" required>
                @if($errors->has('last_name'))
                <div class="error">{{ $errors->first('last_name') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Email</label>
                <input type="email" class="form-control" name="email" id="email" required>
                @if($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label for="inputEmail4">Mobile-No</label>
                <input type="number" class="form-control" name="phone" id="contact" required>
                @if($errors->has('phone'))
                <div class="error">{{ $errors->first('phone') }}</div>
                @endif
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-2">
                <label for="inputpassword">Password</label>
                <input type="text" class="form-control" name="password" id="inputpassword" placeholder="Enter Password"
                    required>
                @if($errors->has('password'))
                <div class="error">{{ $errors->first('password') }}</div>
                @endif
            </div>
            <div class="form-group col-md-2">
                <label for="inputpassword2">Confirm Password</label>
                <input type="text" class="form-control" name="password_confirmation" id="inputpassword2"
                    placeholder="Re-enter Password" required>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label for="inputCity">Gender</label>
                <input type="radio" class="form-control" name="gender" value="Male" id="inputCity">Male
                <input type="radio" class="form-control" name="gender" value="Female" id="inputCity">Female
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button> 
    </form>
   
    </div>
    <h1 class="text-center">{{session('Exit')}}</h1>
    <h1 class="text-center">{{session('status')}}</h1>
</body>

</html>