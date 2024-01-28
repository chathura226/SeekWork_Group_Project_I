// var rootURL = "<?=ROOT?>";
//above root url must be defined in the header js inline
var data;//to store notifications
var preNotificationsIds = [];//to store notifications that are currently here
var newNotificationCount = 0;
var newNotifyIcon = document.getElementById("notificationCount");
notificationContent = document.getElementById("notificationContent");
notifyBttn = document.getElementById("notifyBttn");
var isNotificationOpen = false;

//to open notification drop
function notificationClick(e) {
    e.preventDefault();
    if (isNotificationOpen) {
        notificationContent.style.display = "none";
        isNotificationOpen = false;

    } else {
        notificationContent.style.display = "block";
        isNotificationOpen = true;


        //marking unseen notifications as seen
        setNotificationsSeen()

    }
    displayNewCount();
}

//to track other clicks to close notification drop
// document.addEventListener('click', (event) => {
//     if (!notificationContent.contains(event.target) && !notifyBttn.contains(event.target)) {
//         console.log("erd");
//         notificationClick(event);
//     }
// });


// Set up the interval to run the getAll notification every 10 seconds
const intervalId = setInterval(getAllNotifications, 10000);


//get all notifications
function getAllNotifications() {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            data = JSON.parse(xhr.responseText);

            if (data.length > 0) {
                // adding the notifications to the drop down
                data.forEach(obj => {
                    if (!preNotificationsIds.includes(obj.notificationID)) {
                        if (!obj.seen) {
                            newNotificationCount++;
                        }
                        var anchorTag = document.createElement('a');

                        // Set the href attribute of the anchor tag
                        anchorTag.href = rootURL + "/" + obj.url;

                        // Set the text content of the anchor tag and append on top of first child
                        anchorTag.textContent = obj.msg;
                        var firstChild = notificationContent.firstChild;
                        notificationContent.insertBefore(anchorTag, firstChild);

                        //adding id of notification to the list
                        preNotificationsIds.push(obj.notificationID);
                    }

                })
                displayNewCount();
            }

        }


    };

    // Specify the type of request and the URL
    xhr.open('GET', rootURL+'/notifications/getALl', true);

    // Send the request
    xhr.send();
}

getAllNotifications();
displayNewCount();

//to display where theres a new notification
function displayNewCount() {
    if (!newNotificationCount) {//no new notifications
        newNotifyIcon.style.display = 'none';
    } else {//there are new notifications
        newNotifyIcon.style.display = 'flex';
    }
}


//marking unseen notifications as seen
function setNotificationsSeen() {
    unseen = [];
    if (data.length) {
        data.forEach(element => {
            if (!element.seen) {
                //apending notificationIDs of unseen notifications
                unseen.push(element.notificationID);
            }
        })
        if (unseen.length > 0) {
            //sending post request
            // Create a form dynamically
            send_ids(unseen);
            newNotificationCount = 0;
            displayNewCount();
        }
    }
}


function send_ids(idList) {
    let xml = new XMLHttpRequest();

    xml.onload = function () {
        if (xml.readyState == 4 || xml.status == 200) {
            console.log(xml.responseText);
        }
    }

    let data = {};
    data.ids = idList;
    data = JSON.stringify(data)
    xml.open("POST", rootURL+"/notifications/markseen", true);
    xml.send(data);
}

