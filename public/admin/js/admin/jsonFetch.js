const jsonFetch = (url, options) => {

fetch(url, options)
    .then(res=> {
        res.json();
        if (res.ok) {
            alert('save');
        } else {
            throw new Error(res.status);
        }
    })
}

export default jsonFetch;
