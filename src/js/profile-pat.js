let profRes = "#profRes";

let showPatProfBtn = "#showPatProfBtn";
let showPatAppointBtn = "#showPatAppointBtn";
let profResAppCont = "#profResAppCont";
let profPat = "#profPat";

let AccSetBtn = "#AccSetBtn";
let ProfDetBtn = "#ProfDetBtn";

let profResUnApp = "#profResUnApp";
let profResFinApp = "#profResFinApp";
let appIdArr = [];

var acc = document.getElementById("AccSetBtn");
var prof = document.getElementById("ProfDetBtn");
var accInfo = document.getElementById("acc-info");
var profInfo = document.getElementById("prof-info");
var ProfProfBtn = document.getElementById("showPatProfBtn");
var PatAppointBtn = document.getElementById("showPatAppointBtn");
var lineA = document.getElementById("line-selected-a");
var lineB = document.getElementById("line-selected-b");

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}
function isolateResultCont(resultCont) {
    $(profRes).children().addClass("hide");
    $(resultCont).removeClass("hide");
}
function isolateAppointmentCont(appcont) {
    $(profResAppCont).children(".prof-res__appoint-cont").addClass("hide");
    $(appcont).removeClass("hide");
}
function generateAppointment({image_profile, ID, Day, Month, Time, Year, Type, firstname, lastname, middle_initial, contact, specialization}, action, cont) {
    let type = Type == "f2f" ? "Face-to-face" : "Online"
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let buttonHtml = generateBtnHtmlApp(action);
    let time = Time.split("-");
    let timeS = formatTime(time[0]);
    let timeE = formatTime(time[1]);
    let html = `
    <div data-id="${ID}" class="doc__app">
        <img class="doc__app--img a" src="../src/img/profiles/${image_profile}" alt="Profile Image" />
        <h6 class="doc__app--name b">Dr. ${firstname} ${middle_initial}. ${lastname}</h6>
        <h6 class="doc__app--contact c">${contact}</h6>
        <h6 class="d">${specialization}</h6>
        <h6 class="doc__app--type e">${type}</h6>
        <h6 class="doc__app--time f">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            ${timeS} - ${timeE} 
        </h6>
        <h6 class="g">
            ${month}/${day}/${Year}
        </h6>
        ${buttonHtml}
    </div>
    `;
    $(cont).append(html);
}
function generateBtnHtmlApp(type) {
    if(type === "un") {
        return `
            <button class="doc__app--cancel h">Cancel</button>
        `
    }
    if(type === "fin") {
        return `
            <button class="doc__app--view h">View</button>
        `
    }
    if(type === "not") {
        return `
            <button class="doc__app--discard h">Discard</button>
        `
    } 
}
function addFocusClassToAppBtn(button) {
    $(".doc__app-btns").children().removeClass("doc__app-btn--focus");
    $(button).addClass("doc__app-btn--focus");
}
function isolateElemCont(cont , elem) {
    $(cont).children(":not(.hide)").addClass("hide");
    $(elem).removeClass("hide");
}
function isAppContEmpty(cont) {
    let total = $(cont).children(".doc__app");
    let emptyMsg = $(cont).find(".doc__empty-msg");
    emptyMsg.addClass("hide")
    if(total.length == 0) {
        emptyMsg.removeClass("hide");
    }
}
function showResultFromAppointBtn(cont ,appBtn) {
    isolateAppointmentCont(cont);
    isAppContEmpty(cont);
    addFocusClassToAppBtn(appBtn, "doc__app-btn--focus");
}
function formatTime(time) {
    let timeStart = time.split(":");
    let tsampm;

    if(timeStart[0] >= 12) {
        tsampm = "PM"
        timeStart[0] -= 12;
        timeStart[0] = timeStart[0] === 0 ? 12 : timeStart[0];
        timeStart[0] = timeStart[0].toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    } else {
        tsampm = "AM"
    }
    return timeStart[0] + ":" + timeStart[1] + " " + tsampm;
}
//              PATIENTS

//              PATIENTS
addEventGlobalListener('click', showPatProfBtn, (e) => {
    let html = `
        <h1>
            REPLACE THIS PATIENT PROFILE DUMMY CODE WITH THE CORRECT ONE.
        </h1>
    `;
    // $(profRes).children().remove();
    // $(profRes).append(html);
})

function showData(arr,age){
   document.getElementById("patient_id").value=arr['userID'];
   document.getElementById("Accpatient_id").value=arr['userID'];
   document.getElementById("prof_id").value=arr['userID'];
   console.log(arr['userID']);
   document.getElementById("email").value = arr['email'];
    // document.getElementById("password").value = arr['password'];
    document.getElementById("contact").value=arr['contact'];
}

function showAccData(arr){
    console.log("hello");
}

lineA.style.display = "block";
lineB.style.display = "none";
accInfo.style.display = "block";
profInfo.style.display = "none";
ProfProfBtn.style.backgroundColor = " #2240aa";
acc.style.color = "black";

addEventGlobalListener('click', AccSetBtn, (e) => {
    lineA.style.display = "block";
    lineB.style.display = "none";
    accInfo.style.display = "block";
    profInfo.style.display = "none";
    acc.style.color = "black";
    prof.style.color = "grey";
})

addEventGlobalListener('click', ProfDetBtn, (e) => {
    console.log("im here profdet");
    lineA.style.display = "none";
    lineB.style.display = "block";
    accInfo.style.display = "none";
    profInfo.style.display = "block";
    acc.style.color = "grey";
    prof.style.color = "black";
})

addEventGlobalListener('click', showPatProfBtn, (e) => {
    console.log("im here patprof");
    ProfProfBtn.style.backgroundColor = "#2240aa";
    PatAppointBtn.style.backgroundColor = "#5f7de0";
    isolateResultCont(profPat);
})

addEventGlobalListener('click', showPatAppointBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatAppointBtn.style.backgroundColor = "#2240aa";
    isolateResultCont(profResAppCont)
    $.ajax({
        type: "GET",
        data: "appIdArr=" + JSON.stringify(appIdArr),
        url: "../src/php/get-appoints-pat_act.php",
        success: (resp) => {
            let {finished, unfinished, cancelled} = JSON.parse(resp);
            for(var i of finished) {
                generateAppointment(i, "fin", profResFinApp);
                if(!appIdArr.includes(i.ID)) 
                    appIdArr.push(i.ID);
            } 
            for(var i of unfinished){
                generateAppointment(i, "un", profResUnApp);
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
            for(var i of cancelled){
                if(i.Canceller === "doctor")
                    generateAppointment(i, "not", "#appNotifsCont")
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
        }
    })
})
addEventGlobalListener("click", ".doc__app--discard", e => {
    if(confirm("Do you want to discard this notification?")) {
        let app = $(e.target).parent();
        let id = $(app).attr("data-id");
        $.ajax({
            type: "POST",
            url: "../src/php/discard-app_act.php",
            data: `id=${id}`,
            success: res => {
                let {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    $(app).remove();
                    $(showPatAppointBtn).trigger("click");
                    console.log("notfis")
                    $("#showNotifsBtn").trigger("click");
                }
            }
        })
    }
})
addEventGlobalListener('click', ".doc__app--cancel", e => {
    if(confirm("Do you really want to cancel this appointment?")) {
        let app = $(e.target).parent();
        let id = app.attr("data-id");
        $.ajax({
            type: "POST",
            url: "../src/php/cancel-app_act.php",
            data: `id=${id}`,
            success: res => {
                let index, {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    index = appIdArr.indexOf(id);
                    appIdArr.splice(index, 1)
                    app.remove();
                    isAppContEmpty(profResUnApp)
                }
            },
            error: err => {
                console.log(err);
            }
        })
    }
})
addEventGlobalListener('click', "#showFinAppBtn", e => {
    showResultFromAppointBtn(profResFinApp, "#showFinAppBtn");
})
addEventGlobalListener('click', "#showUnAppBtn", e => {
    showResultFromAppointBtn(profResUnApp, "#showUnAppBtn");
})
addEventGlobalListener("click", "#showNotifsBtn", e=> {
    showResultFromAppointBtn("#appNotifsCont", "#showNotifsBtn");
})

//              PATIENTS

$(window).on("load", (evt) => {
    $(showPatProfBtn).trigger('click');
    $(showPatProfBtn).trigger('focus');
})