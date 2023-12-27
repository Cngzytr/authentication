import { route } from "./routes.js";

window.route = route;

window.http = {
    token: document.querySelector('meta[name="csrf-token"]').content,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'multipart/form-data',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    imgHeaders: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    specheaders: {
        'X-Requested-With': 'XMLHttpRequest',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    
    header: (key, value) => {
        return new Headers();
    },
    get: (url = '', data = {}) => {
        let $data = new URLSearchParams(data);
        const $request = new Request(url + '?' + $data, {
            method: 'GET',
            headers: window.http.headers,
            mode: 'cors',
            cache: 'no-cache',
        });

        return fetch($request);
    },
    post: (url = '', data = {}) => {
        return fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: window.http.headers,
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });
    },
    put: (url = '', data = {}) => {
        return fetch(url, {
            method: 'PUT',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: window.http.headers,
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: JSON.stringify(data)
        });
    },
    image: (url = '', data) => {
        return fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: window.http.imgHeaders,
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: data
        });
    },
    spec: (url = '', data = {}) => {
        return fetch(url, {
            method: 'POST',
            mode: 'cors',
            cache: 'no-cache',
            credentials: 'same-origin',
            headers: window.http.specheaders,
            redirect: 'follow',
            referrerPolicy: 'no-referrer',
            body: data
        });
    }
};

window.setAttr = function(e, a) {
    Object.keys(a).forEach(key => e.setAttribute(key, a[key]));
}

window.has = function(accessor) {
    try {
        return document.querySelectorAll(accessor) !== undefined && document.querySelectorAll(accessor) !== null && document.querySelectorAll(accessor).length > 0
    } catch (e) {
        return false
    }
}

window.counter = function($e, n, url) {
    (function loop() {
        $e.innerHTML = n;
        if (n--) {
            setTimeout(loop, 1000);
        } else if (n <= 0) {
            window.location.replace(url);
        }
    })();
}

window.toascii = function(str) {
    return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
}

window.toscroll = function($e) {
    const $leftElement = $e.offsetLeft + $e.offsetWidth;
    const $leftParentElement = $e.parentNode.offsetLeft + $e.parentNode.offsetWidth - $e.parentNode.offsetWidth + $e.offsetWidth;

    if ($leftElement >= $leftParentElement + $e.parentNode.scrollLeft) {
        $e.parentNode.scrollLeft = $leftElement - $leftParentElement;
    } else if ($leftElement <= $e.parentNode.offsetLeft + $e.parentNode.scrollLeft) {
        $e.parentNode.scrollLeft = $e.offsetLeft - $e.parentNode.offsetLeft;
    }
}

window.topscroll = function($e) {
    let $position = {
        left: $e.querySelector('.active').offsetLeft,
        top: $e.querySelector('.active').offsetTop
    };

    $e.scrollBy({
        top: $position.top,
        behavior: 'smooth'
    });
}

window.getHeight = function($e) {
    return parseFloat(window.getComputedStyle($e, null).height.replace('px', ''));
}