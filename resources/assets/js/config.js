export const BASE_URL = document.location.protocol + '//' + document.location.host + '/cms/';

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.csrfToken = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}



export function fetch(type, uri, callback, param) {

    // If we get an invalid data type we ignore it
    if (['GET', 'POST', 'PUT', 'DELETE'].indexOf(type) == -1) {
        console.log(`Request Type not valid`);
        return;
    }

    //check if it is a valid function
    if (typeof callback !== "function") {
        console.log(`You need to give a callback function`);
        return;
    }

    // START MAGIC

    // create XHR
    var xhr = new XMLHttpRequest();

    //prep Request
    xhr.open(type, BASE_URL + uri);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.setRequestHeader('X-CSRF-TOKEN', window.csrfToken);

    xhr.onload = function() {

        if (xhr.status === 200) {

            // if all went well trigger callback
            callback(JSON.parse(xhr.responseText));
        } else {

            //dang error
            console.log(`Errorcode: ${xhr.status}`);
        }
    };

    // init request
    if (type == 'GET' || type == 'DELETE') {
        xhr.send()
    } else {
        xhr.send(JSON.stringify(param));
    }
}
