require('./bootstrap');

// convert the mysql date to milisecond
// Date.parse(mySQLDate.replace(/-/g, '/'))

// function call
dateParse();

function dateParse() {
    let sqlDate = document.querySelectorAll('#SQL-date');
    console.log(sqlDate);
    sqlDate.forEach(element => {
        let date = element.innerHTML
        // console.log('date :', date);
        date = Date.parse(date.replace(/-/g, '/'));
        // console.log('parsed date :', date);
        element.innerHTML = timeSince(date);
    });
}
function timeSince(date) {

    var seconds = Math.floor((new Date() - date) / 1000);

    var interval = seconds / 31536000;

    if (interval > 1) {
        return Math.floor(interval) + " years ago";
    }
    interval = seconds / 2592000;
    if (interval > 1) {
        return Math.floor(interval) + " months ago";
    }
    interval = seconds / 86400;
    if (interval > 1) {
        return Math.floor(interval) + " days ago";
    }
    interval = seconds / 3600;
    if (interval > 1) {
        return Math.floor(interval) + " hours ago";
    }
    interval = seconds / 60;
    if (interval > 1) {
        return Math.floor(interval) + " minutes ago";
    }
    return Math.floor(seconds) + " seconds ago";
}