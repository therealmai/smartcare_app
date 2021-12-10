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
            <button class="doc__app--remove">Discard</button>
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


$(profDocCont).removeClass("hide");

lineA.style.display = "block";
lineB.style.display = "none";
accInfo.style.display = "block";
profInfo.style.display = "none";
ProfProfBtn.style.backgroundColor = " #2240aa";
acc.style.color = "black";



// addEventGlobalListener('click', acc, (e) => {
//     console.log("im here again");
//     lineA.style.display = "block";
//     lineB.style.display = "none";
//     accInfo.style.display = "block";
//     profInfo.style.display = "none";
//     acc.style.color = "black";
//     prof.style.color = "grey";
// })

// addEventGlobalListener('click', prof, (e) => {
//     console.log("im here");
//     lineA.style.display = "none";
//     lineB.style.display = "block";
//     accInfo.style.display = "none";
//     profInfo.style.display = "block";
//     acc.style.color = "grey";
//     prof.style.color = "black";
// })

addEventGlobalListener('click', showDocProfBtn, (e) => {
    console.log("im here");
    ProfProfBtn.style.backgroundColor = "#2240aa";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    $(profDocPatCont).addClass("hide");
    $(profDocCont).removeClass("hide");
})

addEventGlobalListener('click', showDocPatBtn, (e) => {
    console.log("im here");
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#2240aa";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    $(profDocCont).addClass("hide");
    $(profDocPatCont).removeClass("hide");
})

addEventGlobalListener('click', showDocAppointBtn, e => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#2240aa";
    isolateResultCont("#docAppCont");
    $("#showUnAppBtn").trigger("click");
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
        }
    })
})
addEventGlobalListener("click", showUnAppBtn, e=> {
    isolateAppointmentCont(docAppUnResCont);
    addFocusClassToAppBtn(showUnAppBtn);
})
addEventGlobalListener("click", showFinAppBtn, e=> {
    isolateAppointmentCont(docAppFinResCont);
    addFocusClassToAppBtn(showFinAppBtn);
})
addEventGlobalListener("click", "#showNotifsBtn", e => {
    isolateAppointmentCont("#docNotifsCont");
    addFocusClassToAppBtn("#showNotifsBtn");
})

$(window).on("load", (evt) => {
    // $(showDocProfBtn).trigger('click');
    // $(showDocProfBtn).trigger('focus');
})
// $("#Docprof").css("display", "none");
// $("#DocPatients").css("display", "none");