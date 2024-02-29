// Give the service worker access to Firebase Messaging.
// Note that you can only use Firebase Messaging here. Other Firebase libraries
// are not available in the service worker.importScripts('https://www.gstatic.com/firebasejs/7.23.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');
/*
Initialize the Firebase app in the service worker by passing in the messagingSenderId.
*/
firebase.initializeApp({
    apiKey: "AIzaSyB9FzIUo3bBKunVLVqi1o0M9gVqeX_VoHo",
  authDomain: "laravelpushnotification-78b76.firebaseapp.com",
  projectId: "laravelpushnotification-78b76",
  storageBucket: "laravelpushnotification-78b76.appspot.com",
  messagingSenderId: "724240981380",
  appId: "1:724240981380:web:e5272851af03d4c37e51d1",
  measurementId: "G-TSQ5CB26NT"
});
 
// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
    console.log("Message received.", payload);
    const title = "Hello world is awesome";
    const options = {
        body: "Your notificaiton message .",
        icon: "/firebase-logo.png",
    };
    return self.registration.showNotification(
        title,
        options,
    );
});
