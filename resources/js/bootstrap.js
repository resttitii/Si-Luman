//fix

import 'bootstrap'; //Library Bootstrap adalah sebuah framework CSS yang populer untuk membangun antarmuka pengguna yang responsif

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios'; //library JavaScript yang memungkinkan kita untuk melakukan permintaan HTTP ke backend Laravel dengan mudah
window.axios = axios; // instance Axios akan diassign ke window.axios sehingga dapat digunakan di seluruh aplikasi

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'; //igunakan untuk mengatur header X-Requested-With pada setiap permintaan yang dibuat menggunakan Axios. Header ini digunakan oleh Laravel untuk mengenali permintaan sebagai permintaan AJAX

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

//library yang digunakan untuk membangun aplikasi web real-time dengan Laravel, yang memungkinkan Anda untuk berlangganan ke channel dan mendengarkan peristiwa yang disiarkan oleh Laravel
// import Echo from 'laravel-echo';

// import Pusher from 'pusher-js';
// window.Pusher = Pusher;

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: import.meta.env.VITE_PUSHER_APP_KEY,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ?? `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
// });
