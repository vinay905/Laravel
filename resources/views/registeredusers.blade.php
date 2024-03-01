<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"crossorigin="anonymous">
</head>

<body>
    <h1 class="text-center">{{ session('completed') }}</h1>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Registered User DATA</h4>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>FirstName</th>
                                    <th>LastName</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($student as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->first_name }}</td>
                                        <td>{{ $item->last_name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->gender }}</td>
                                        <td>
                                            <a href="{{ route('edit', $item->id) }}"
                                                class="btn btn-primary btn-sm">Edit</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('deletedata', $item->id) }}"
                                                class="btn btn-danger btn-sm">Delete</a>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <h2 class="text-center text-danger">{{ session('Completed') }}</h2>
    <h2 class="text-center text-danger">{{ session('Failed') }}</h2>
    <div class="text-center">
        <a class="m-auto btn btn-danger btn-sm" href="{{ route('logout') }}">Logout</a>
    </div>
    <button onclick="startFCM()" class="btn btn-danger btn-flat">Allow
    </button>
    <form action="{{ route('pushnotification') }}" method="POST">@csrf
        <input type="text" value="Vinay SINGH" name="body">
        <input type="text" value="VINAYSINGHWORKSPACE@GMAIL.COM" name="title">
        <input type="submit" value="Send Notification">
    </form>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" crossorigin="anonymous"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js"></script>
<script>

navigator.serviceWorker.register('firebase-messaging-sw.js');
    var firebaseConfig = {
        apiKey: "AIzaSyB9FzIUo3bBKunVLVqi1o0M9gVqeX_VoHo",
        authDomain: "laravelpushnotification-78b76.firebaseapp.com",
        projectId: "laravelpushnotification-78b76",
        storageBucket: "laravelpushnotification-78b76.appspot.com",
        messagingSenderId: "724240981380",
        appId: "1:724240981380:web:e5272851af03d4c37e51d1",
        measurementId: "G-TSQ5CB26NT"
    };
    firebase.initializeApp(firebaseConfig);
    const messaging = firebase.messaging();

    function startFCM() {
        messaging
            .requestPermission()
            .then(function() {
                return messaging.getToken()
            })
            .then(function(response) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                });
                $.ajax({
                    url: '{{ route('saveToken') }}',
                    type: 'POST',
                    data: {
                        notify_token: response
                    },
                    dataType: 'JSON',
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(error) {
                        console.log(error);
                    },
                });
            }).catch(function(error) {
                alert(error);
            });
    }

    messaging.onMessage(function(payload) {
        console.log(payload);
        console.log(payload.notification.body);
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            image: payload.notification.image,
            actions:payload.notification.actions,
        };
        new Notification(title, options);
});
self.addEventListener('notificationclick', function(event) {
    const notification = event.notification;
    const action = event.action;
    if (action === 'open_url') {
        const url = event.notification.data.url;
        event.waitUntil(
            clients.openWindow(url)
        );
    }
    notification.close();
});

</script>
