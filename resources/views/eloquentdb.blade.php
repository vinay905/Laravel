<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body><H1>INSERT</H1>
    <form action="{{route('submitdata')}}" method="post">
        @csrf
        
        <input type="text" name="course" id="">
        @if($errors->has('course'))
        <div class="error">{{ $errors->first('course') }}</div>
        @endif
        
        <input type="text" name="section" id="">
        @if($errors->has('section'))
        <div class="error">{{ $errors->first('section') }}</div>
        @endif
        
        <input type="text" name="fees" id="">
        @if($errors->has('fees'))
        <div class="error">{{ $errors->first('fees') }}</div>
        @endif
        <input type="submit" value="INSERT">
    </form> 
<H1>UPDATE</H1>
    <form action="{{route('updatedata')}}" method="post">
        @csrf
        <label for="id">ID</label>
        <input type="number" name="id" id=""><BR>
        @if($errors->has('id'))
        <div class="error">{{ $errors->first('id') }}</div>
        @endif
        
        <LABEL>ENTER SECTION</LABEL>
        <input type="text" name="section" id=""><BR>
        @if($errors->has('section'))
        <div class="error">{{ $errors->first('section') }}</div>
        @endif
        
        <LABEl>ENTER COURSE</LABEl>
        <input type="text" name="course" id=""><BR>
        @if($errors->has('course'))
        <div class="error">{{ $errors->first('course') }}</div>
        @endif
        <input type="submit" value="UPDATE">
</form> 

<H1>DELETE</H1>
    <form action="{{route('deletecoursedata')}}" method="post">
        @csrf
        <label for="id">ID</label>
        <input type="number" name="id" id=""><BR>
        @if($errors->has('id'))
        <div class="error">{{ $errors->first('id') }}</div>
        @endif
        <input type="submit" value="DELETE">
</form>

<h2>Join</h2>
<form action="{{route('joindata')}}" method="post">
        @csrf
        <label for="id">ID</label>
        <input type="number" name="id" id=""><BR>
        @if($errors->has('id'))
        <div class="error">{{ $errors->first('id') }}</div>
        @endif
        <input type="submit" value="JOIN-SHOW">
</form>
</body>

</html>