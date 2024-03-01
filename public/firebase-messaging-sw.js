
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

firebase.initializeApp({
    apiKey: "AIzaSyB9FzIUo3bBKunVLVqi1o0M9gVqeX_VoHo",
  authDomain: "laravelpushnotification-78b76.firebaseapp.com",
  projectId: "laravelpushnotification-78b76",
  storageBucket: "laravelpushnotification-78b76.appspot.com",
  messagingSenderId: "724240981380",
  appId: "1:724240981380:web:e5272851af03d4c37e51d1",
  measurementId: "G-TSQ5CB26NT"
});
 
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "You have a notification";
    const options = {
        body: "Please check notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
    });
    self.addEventListener('notificationclick', function(event) {
        // console.log('jknjnjknkj');
        const notification = event.notification;
        const action = event.action;
        if (action === 'open_url') {
            // const url =notification.data.url;
            const url='https://google.com';
            event.waitUntil(
                clients.openWindow(event)
            );
        }
        notification.close();
    });
    