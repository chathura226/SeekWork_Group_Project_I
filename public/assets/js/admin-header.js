
// Example path
var path = window.location.pathname;

//user role
var role=document.querySelector('label[for="role"]').textContent;
// console.log("role",role);

var roleUrl='/'+role+'/';
// console.log("roleUrl",roleUrl);
// Find the position of '/student/' in the path
var roleIndex = path.indexOf(roleUrl);
correctTab="";
// Check if '/student/' is present in the path
if (roleIndex !== -1) {
    // Find the position of the next '/' after '/student/'
    var nextSlashIndex = path.indexOf('/', roleIndex + roleUrl.length);
    if (nextSlashIndex !== -1) {
        // Extract the substring between '/student/' and the next '/'
        var betweenRoleAndNextSlash = path.substring(roleIndex + roleUrl.length, nextSlashIndex);

        // Display the result
        // console.log("What comes after roleUrl and before the next '/': " + betweenRoleAndNextSlash);
        correctTab=betweenRoleAndNextSlash;
    } else {
        var afterRole = path.substring(roleIndex + roleUrl.length);
        // console.log("What comes after roleUrl and before the next '/': " + afterRole);
        correctTab=afterRole;
        
    }
} else {
    var roleUrlForDashboard='/'+role;
    var roleIndexForDashboard = path.indexOf(roleUrlForDashboard);

    if (roleIndexForDashboard !== -1) {
        correctTab="dashboard";
    }else{
        // console.log("roleUrl not found in the path");
        correctTab=-1;
    }

}

if(correctTab!==-1){
    var tab=document.getElementById(correctTab);
    console.log(correctTab);
    if(tab==null){//stuff related to profile (eg: change pass, update profile etc)
        tab=document.getElementById('profile');
    }
    tab.classList.add("active");
}
