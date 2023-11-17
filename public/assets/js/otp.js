
const countdownElement = document.getElementById('countdown');

var updatedAtLabel=document.querySelector('label[for="updatedAt"]');
//if it is null => havent sent an otp before
if(updatedAtLabel!=null){
    document.getElementById('sent-cont').textContent='An OTP code has been sent to your email account. Please enter the OTP to proceed with registration!';
    const unixTimestamp = Number(updatedAtLabel.textContent)+120; //add 120 second time to the last updated time
    console.log(unixTimestamp);

    function updateCountdown() {
        const currentLocaltime=new Date();
        const currentLocaltimeinGMT=currentLocaltime.toGMTString();//GMT to match server time
        
        const currentTime = Math.floor( new Date(currentLocaltimeinGMT).getTime()/1000); // Current Unix timestamp in seconds 
        const timeDifference = unixTimestamp - currentTime;
    console.log(currentTime);
        
        if (timeDifference <= 0) {
            clearInterval(countdownInterval);
            countdownElement.textContent = ''; // Remove countdown display
        } else {
            countdownElement.textContent = `Din't recieve the OTP? You can retry in ${timeDifference} seconds`;
        }
    }

    // Update the countdown every second
    const countdownInterval=setInterval(updateCountdown, 1000);
    updateCountdown(); // Run immediately to avoid initial delay
    
    
}

