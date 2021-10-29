var reloading;
var countdownTimer;
var refreshTime = 30; // seconds

function checkReloading() {
    if (window.location.hash=="#autoreload") {
        (function countdown(remaining) {
            document.getElementById('countdown-info').style.display = "inline";
            document.getElementById('countdown').innerHTML = remaining;
            countdownTimer=setTimeout(function(){ countdown(remaining - 1); }, 1000);
        })(refreshTime);
        reloading=setTimeout("window.location.reload();", refreshTime * 1000);
        document.getElementById("reloadCB").checked=true;
    }
}

function toggleAutoRefresh(cb) {
    if (cb.checked) {
        window.location.replace("#autoreload");
        (function countdown(remaining) {
            document.getElementById('countdown-info').style.display = "inline";
            document.getElementById('countdown').innerHTML = remaining;
            countdownTimer=setTimeout(function(){ countdown(remaining - 1); }, 1000);
        })(refreshTime);
        reloading=setTimeout("window.location.reload();", refreshTime * 1000);
    } else {
        window.location.replace("#");
        clearTimeout(reloading);
        clearTimeout(countdownTimer);
        document.getElementById('countdown').innerHTML = "";
        document.getElementById('countdown-info').style.display = "none";
    }
}

window.onload=checkReloading;