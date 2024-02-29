<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Input Field to Another Div</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f4f4f4;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }

    form {
        margin-bottom: 20px;
    }

    input[type="file"] {
        margin-bottom: 10px;
    }

    input,
    textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    button {
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }

    #outputtitle,
    #outputDiv {
        margin-bottom: 10px;
    }

    #img {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
        display: none;
    }
</style>
</head>
<body>
    <div class="container">
        <form id="blogForm" action="{{ route('blogdata') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="file" name="image" id="image" onchange="readURL(this)">
            @if($errors->has('image'))
                <div class="error">{{ $errors->first('image') }}</div>
                @endif
            <input type="text" name="title" id="blogtitle" placeholder="Enter Title" required>
            @if($errors->has('title'))
                <div class="error">{{ $errors->first('title') }}</div>
                @endif
            <textarea name="content" id="textInput" cols="6" rows="3" placeholder="Enter Description" required></textarea>
            @if($errors->has('description'))
                <div class="error">{{ $errors->first('description') }}</div>
                @endif
            
            <button class="ms-3">{{ __('Upload ') }}</button>
        </form>

       
        <img src="" alt="No Image" id="img">
        <h1 id="outputtitle"></h1>
        <p id="outputDiv"></p>
    </div>

    <script>
        const textInput = document.getElementById('textInput');
        const blogtitle = document.getElementById('blogtitle');
        const outputtitle = document.getElementById('outputtitle');
        const outputDiv = document.getElementById('outputDiv');

        textInput.addEventListener('keyup', function() {
            outputDiv.textContent = textInput.value;
            outputtitle.textContent = blogtitle.value;
        });

        blogtitle.addEventListener('keyup', function() {
            outputtitle.textContent = blogtitle.value;
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    document.querySelector("#img").setAttribute("src", e.target.result);
                    document.getElementById("img").style.display = "block";
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
