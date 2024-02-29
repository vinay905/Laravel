<html>
<head>
    <title>Laravel Phone Number Authentication using Firebase - LaravelAmit</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
    <style>
        #otp{
            display: none;
        }
    </style>
<body>
  
<div class="container">
    <h1>Laravel Phone Number Authentication using Firebase - LaravelAmit</h1>
  
    <div class="alert alert-danger" id="error" style="display: none;"></div>
  
    <div class="card">
      <div class="card-header">
        Enter Phone Number
      </div>
      <div class="card-body">
  
        <div class="alert alert-success" id="sentSuccess" style="display: none;"></div>
  
        <form id="number2">
            <label>Phone Number:</label>
            <input type="number" id="number" class="form-control" value="{{$number}}">
            <div id="recaptcha-container"></div>
            <button type="button" class="btn btn-success" onclick="phoneSendAuth();">SendCode</button>
        </form>
      </div>
    </div>
      
    <div class="card" style="margin-top: 10px">
      <div class="card-header">
        Enter Verification code
      </div>
      <div class="card-body">
  
        <div class="alert alert-success" id="successRegsiter" style="display: none;"></div>
  
        <form id="otp" >
            <input type="text" id="verificationCode" class="form-control" placeholder="Enter verification code">
            <button type="button" class="btn btn-success" onclick="codeverify();">Verify code</button>
  
        </form>
      </div>
    </div>
  
</div>
  
<script src="https://www.gstatic.com/firebasejs/6.0.2/firebase.js"></script>
  
<script>
      
      const firebaseConfig = {
  apiKey: "AIzaSyBRcKx1VOj8vtyUijo1jo89HnGt0bKCVDQ",
  authDomain: "newuser-f7c6f.firebaseapp.com",
  projectId: "newuser-f7c6f",
  storageBucket: "newuser-f7c6f.appspot.com",
  messagingSenderId: "1094988871827",
  appId: "1:1094988871827:web:2a8c0ea870d7b496c93566",
  measurementId: "G-QZ5G4GRFRB"
};
    
  firebase.initializeApp(firebaseConfig);
</script>
  
<script type="text/javascript">
  
    // function render() {
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container',{
            'size':'invisble',
        });
    // }
  
    function phoneSendAuth() {
           
        const phoneNumber = '+91'+$('#number').val();
        console.log(phoneNumber);
        firebase.auth().signInWithPhoneNumber(phoneNumber, window.recaptchaVerifier).then((confirmationResult) => {
        window.confirmationResult = confirmationResult;
        coderesult=confirmationResult;
        // $('#number2').hide();
        $('#otp').show();
        }).catch((error) => {
            console.log(error);
        });

    }
  
    function codeverify() {
  
        var code = $("#verificationCode").val();
  
        coderesult.confirm(code).then(function (result) {
            var user=result.user;
            console.log(user);
  
            $("#successRegsiter").text("you are register Successfully.");
            $("#successRegsiter").show();
            window.location = "{{route('registeruser')}}";
  
        }).catch(function (error) {
            $("#error").text(error.message);
            $("#error").show();
        });
    }
  
</script>
  
</body>
</html>