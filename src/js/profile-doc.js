let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";
let showDocPatBtn = "#showDocPatBtn";

let showUnAppBtn = "#showUnAppBtn";
let showFinAppBtn = "#showFinAppBtn";

let docAppResCont = "#docAppResCont";
let docAppUnResCont = "#docAppUnResCont";
let docAppFinResCont = "#docAppFinResCont";

let appIdArr = [];

var AccSetBtn = "#AccSetBtn";
var ProfDetBtn = "#ProfDetBtn";
var acc = document.getElementById("AccSetBtn");
var prof = document.getElementById("ProfDetBtn");
var accInfo = document.getElementById("acc-info");
var profInfo = document.getElementById("prof-info");
var ProfProfBtn = document.getElementById("showDocProfBtn");
var DocAppointBtn = document.getElementById("showDocAppointBtn");
var DocPatBtn = document.getElementById("showDocPatBtn");
var lineA = document.getElementById("line-selected-a");
var lineB = document.getElementById("line-selected-b");

let today = new Date();
let tday = today.getDate()
let tmon = today.getMonth() + 1
let tyear = today.getFullYear()

lineA.style.display = "block";
lineB.style.display = "none";
accInfo.style.display = "block";
profInfo.style.display = "none";
ProfProfBtn.style.backgroundColor = " #2240aa";
acc.style.color = "black";
isolateResultCont("#profPat");

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function generateAppointment({ID, Day, Month, Time, Year, userMon, userYear, userDay, Type, firstname, lastname, middle_initial, contact}, appType, cont) {
    let age = tyear - userYear;
    if(tmon < userMon) {
        age--;
    } else if(tmon == userMon) {
        if(tday < userDay) {
            age--;
        }
    }

    let type = Type == "f2f" ? "Face-to-face" : "Online"
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let buttonHtml = generateBtnHtmlApp(appType);
    let time = formatTime(Time);

    let html = `
    <div data-id="${ID}" class="doc__app">
        <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-stack-1x fa-user" aria-hidden="true"></i>
        </span>
        <h4>${firstname} ${middle_initial}. ${lastname}</h4>
        <h5 class="doc__app--contact">${contact}</h5>
        <h6>Age: ${age}</h6>
        <h5 class="doc__app--type">${type}</h5>
        <h5 class="doc__app--time">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            ${time} &nbsp ${month}/${day}/${Year}
        </h5>
        ${buttonHtml}
    </div>
    `;
    $(cont).append(html);
}
function generateBtnHtmlApp(type) {
    if(type === "un") {
        return `
        <div class="doc__unapp-btns">
            <button class="doc__app--done">Done</button>
            <button class="doc__app--cancel">Cancel</button>
        </div>
        `
    } 
    if(type === "fin") {
        return `
            <button class="doc__app--remove">Remove</button>
        `
    }
    if(type === "not") {
        return `
            <button class="doc__app--discard">Discard</button>
        `
    }
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

function isolateResultCont(resultCont) {
    $(profRes).children().addClass("hide");
    $(resultCont).removeClass("hide");
}
function isolateAppointmentCont(appcont) {
    $(docAppResCont).children().addClass("hide");
    $(appcont).removeClass("hide");
}
function addFocusClassToAppBtn(button) {
    $(".doc__app-btns").children().removeClass("doc__app-btn--focus");
    $(button).addClass("doc__app-btn--focus");
}

addEventGlobalListener('click', AccSetBtn, (e) => {
    console.log("im here again profacc");
    lineA.style.display = "block";
    lineB.style.display = "none";
    accInfo.style.display = "block";
    profInfo.style.display = "none";
    acc.style.color = "black";
    prof.style.color = "grey";
})
function isAppContEmpty(cont) {
    let total = $(cont).children(".doc__app");
    if(total.length == 0) {
        $(cont).find(".doc__empty-msg").removeClass("hide");
    }
}
function removeAppIdFromArr(id) {
    let index = appIdArr.indexOf(id);
    appIdArr.splice(index, 1);
}

addEventGlobalListener('click', ProfDetBtn, (e) => {
    console.log("im here profdet");
    lineA.style.display = "none";
    lineB.style.display = "block";
    accInfo.style.display = "none";
    profInfo.style.display = "block";
    acc.style.color = "grey";
    prof.style.color = "black";
})

addEventGlobalListener('click', showDocProfBtn, (e) => {
    console.log("im here docprof");
    ProfProfBtn.style.backgroundColor = "#2240aa";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    isolateResultCont("#profPat");
})

addEventGlobalListener('click', showDocPatBtn, (e) => {
    console.log("im here docpat");
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#2240aa";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    isolateResultCont("#profDocPat");
})

addEventGlobalListener('click', showDocAppointBtn, e => {
    console.log("im here docappoint");
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#2240aa";
    isolateResultCont("#docAppCont");
    $.ajax({
        type: "GET",
        data: "appIdArr=" + JSON.stringify(appIdArr),
        url: "../src/php/get-appoints-doc_act.php",
        success: resp => {
            let {finished, unfinished, notifications} = JSON.parse(resp);
            for(var i of finished) {
                generateAppointment(i, "fin", docAppFinResCont);
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
            for(var i of unfinished){
                generateAppointment(i, "un", docAppUnResCont);
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
            for(var i of notifications) {
                generateAppointment(i, "not", "#docNotifsCont");
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
            $("#showUnAppBtn").trigger("click");
        }
    })
})
addEventGlobalListener("click", showUnAppBtn, e=> {
    isolateAppointmentCont(docAppUnResCont);
    isAppContEmpty(docAppUnResCont)
    addFocusClassToAppBtn(showUnAppBtn);
})
addEventGlobalListener("click", showFinAppBtn, e=> {
    isolateAppointmentCont(docAppFinResCont);
    isAppContEmpty(docAppFinResCont)
    addFocusClassToAppBtn(showFinAppBtn);
})
addEventGlobalListener("click", "#showNotifsBtn", e => {
    isolateAppointmentCont("#docNotifsCont");
    isAppContEmpty("#docNotifsCont");
    addFocusClassToAppBtn("#showNotifsBtn");
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
                }
            }
        })
    }
})
addEventGlobalListener("click", ".doc__app--done", e=> {
    if(confirm("Do you want to mark this as finished?")) {
        let app = $(e.target).parents(".doc__app");
        let id = $(app).attr("data-id");
        $.ajax({
            type: "POST",
            url: "../src/php/finish-app_act.php",
            data: `id=${id}`,
            success: res => {
                let {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    // $(docAppFinResCont).append(app.prop("outerHTML"));
                    app.remove();
                    removeAppIdFromArr(id);
                    // $(showUnAppBtn).trigger("click");
                    $(showDocAppointBtn).trigger("click");
                }
            }
        })
    }
})
addEventGlobalListener("click", ".doc__app--cancel", e => {
    if(confirm("Do you want to cancel this appointment?")) {
        let app = $(e.target).parents(".doc__app");
        let id = $(app).attr("data-id");
        $.ajax({
            type: "POST",
            url: "../src/php/cancel-app_act.php",
            data: `id=${id}`,
            success: res => {
                let {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    $(app).remove();
                    $(showUnAppBtn).trigger("click");
                }
            }
        })
    }
})

$(window).on("load", (evt) => {
    // $(showDocProfBtn).trigger('click');
    // $(showDocProfBtn).trigger('focus');
})
// $("#Docprof").css("display", "none");
// $("#DocPatients").css("display", "none");