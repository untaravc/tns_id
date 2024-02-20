import {initializeApp} from "firebase/app";
import "firebase/compat/messaging";
import {getMessaging, getToken, onMessage} from "firebase/messaging";
import useAxios from "./service";

const appConfig = {
    apiKey: "AIzaSyDV085R5T6hTybaDKFG7qyri8nCAj40Kzw",
    authDomain: "unt-dev.firebaseapp.com",
    databaseURL: "https://unt-dev-default-rtdb.asia-southeast1.firebasedatabase.app",
    projectId: "unt-dev",
    storageBucket: "unt-dev.appspot.com",
    messagingSenderId: "456969061841",
    appId: "1:456969061841:web:1fbdf4256e99c6dff6ccf0",
    measurementId: "G-KJJ6VMPDZF"
};

const app = initializeApp(appConfig)
const messaging = getMessaging(app);
const {patchData} = new useAxios()

function requestPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === 'granted') {
            console.log('Notification permission granted.');
        } else {
            alert("Please give permission")
        }
    })
}

getToken(messaging, {vapidKey: "BOIS_ErvXIvg06dLcteef-MnoSrwhr_w_6aGlu3vVUqfkpWp8BquUPZNZ882GZXRilfszqIl1XpnwaLy7Uxgzus"})
    .then((currentToken) => {
        if (currentToken) {
            console.log('fcm_token: ', currentToken)
            patchData('set-fcm-token', {
                token : currentToken
            })
        } else {
            requestPermission()
            console.log('No registration token available. Request permission to generate one.');
        }
    }).catch((err) => {
    console.log('Eror disini', err);
})

onMessage(messaging, (payload) => {
    console.log('Message received. ', payload);
});

export default messaging;
