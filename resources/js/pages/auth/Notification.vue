<template>
    <h1>Vue FCM</h1>
</template>

<script>
import {onMessage} from "firebase/messaging";
import messaging from "../../src/firebase";

export default {
    created() {
    },
    mounted() {
        console.log('Notification set')
        onMessage(messaging, (payload) => {
            console.log(payload)
            alert("receive notif");
        });
    }
};
</script>
