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
var showSchedBtn = "#showSchedBtn";
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
let weekday = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

lineA.style.display = "block";
lineB.style.display = "none";
accInfo.style.display = "block";
profInfo.style.display = "none";
ProfProfBtn.style.backgroundColor = " #2240aa";
acc.style.color = "black";
isolateProfileTab("#profPat");

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}
function isolateElemCont(cont , elem) {
    $(cont).children(":not(.hide)").addClass("hide");
    $(elem).removeClass("hide");
}
function addEffectToClickedProfBtn(btnId) {
    $("#profBtns").children(`button:not(${btnId})`).css("background-color", "#5f7de0");
    $("#profBtns").children(btnId).css("background-color", "#2240aa");
}
function addFocusClassToBtn(button, focus) {
    $(`.${focus}`).removeClass(focus);
    $(button).addClass(focus);
}
function hideInputFilterAppointments(cont) {
    if($(cont).children(".doc__app").length === 0) {
        $("#inputFilterAppointments").addClass("hide");
    } else {
        $("#inputFilterAppointments").removeClass("hide");
    }
}
function generateAppointment({image_profile, ID, Day, Month, Time, Year, userMon, userYear, userDay, Type, firstname, lastname, middle_initial, contact}, appType, cont) {
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
    let time = Time.split("-");
    let timeS = formatTime(time[0]);
    let timeE = formatTime(time[1]);

    let html = `
    <div data-id="${ID}" class="doc__app">
        <img class="doc__app--img a" src="../src/img/profiles/${image_profile}" alt="Profile Image" />
        <h6 class="doc__app--name b">${lastname}, ${firstname} ${middle_initial}.</h6>
        <h6 class="doc__app--contact c">${contact}</h6>
        <h6 class="d">Age: ${age}</h6>
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
function generateSchedule({id, time_start, time_end}, day) {
    timeS = formatTime(time_start);
    timeE = formatTime(time_end);
    let html = `
        <div data-id="${id}" class="doc__time">
            <h3>${timeS} - ${timeE}</h3>
            <i class="fa fa-2x fa-trash" aria-hidden="true"></i>
        </div>
    `;
    // <i class="fa fa-2x fa-pencil" aria-hidden="true"></i>
    $(`#${day}`).append(html);
}
function generateBtnHtmlApp(type) {
    if(type === "un") {
        return `
            <button class="doc__app--done h">Done</button>
            <button class="doc__app--cancel h">Cancel</button>
        `
    } 
    if(type === "fin") {
        return `
            <button class="doc__app--presc h">Prescription</button>
            <button class="doc__app--labt h">Lab Test</button>
        `
    }
    if(type === "not") {
        return `
            <button class="doc__app--discard h">Discard</button>
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
function isolateProfileTab(tab) {
    isolateElemCont(profRes, tab);
}
function showResultFromAppointBtn(cont, appBtn) {
    isolateElemCont(docAppResCont, cont);
    isAppContEmpty(cont)
    addFocusClassToBtn(appBtn, "doc__app-btn--focus");
    hideInputFilterAppointments(cont);
    $("#inputFilterAppointments").val("");
    $(cont).children(".doc__app.hide").removeClass("hide");
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
    let length = $(cont).children(".doc__app").length;
    let emptyMsg = $(cont).find(".doc__empty-msg");
    if(length === 0) {
        emptyMsg.removeClass("hide");
    } else {
        emptyMsg.addClass("hide")
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
    addEffectToClickedProfBtn(showDocProfBtn);
    isolateProfileTab("#profPat");
})

addEventGlobalListener('click', showDocPatBtn, (e) => {
    console.log("im here docpat");
    addEffectToClickedProfBtn(showDocPatBtn);
    isolateProfileTab("#profDocPat");
})

addEventGlobalListener('click', showDocAppointBtn, e => {
    addEffectToClickedProfBtn(showDocAppointBtn);
    isolateProfileTab("#docAppCont");
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
                if(i.Canceller === "patient")
                    generateAppointment(i, "not", "#docNotifsCont");
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
        }
    })
})
addEventGlobalListener("click", showUnAppBtn, e=> {
    showResultFromAppointBtn(docAppUnResCont, showUnAppBtn);
})
addEventGlobalListener("click", showFinAppBtn, e=> {
    showResultFromAppointBtn(docAppFinResCont, showFinAppBtn);
})
addEventGlobalListener("click", "#showNotifsBtn", e => {
    showResultFromAppointBtn("#docNotifsCont", "#showNotifsBtn");
})
addEventGlobalListener("click", "#showSchedBtn", e => {
    addEffectToClickedProfBtn("#showSchedBtn");
    isolateProfileTab("#docSchedCont");
    $.ajax({
        type: "GET",
        url: "../src/php/get-schedules_act.php",
        data: "",
        success: res => {
            let {data} = JSON.parse(res);
            $("#timeCont").find(".doc__time").remove();
            data.sort((a, b) => {
                if(a.time_start < b.time_start) {
                    return -1;
                } else if(a.time_start > b.time_start) {
                    return 1;
                } else {
                    return 0;
                }
            })
            for(var i of data) {
                generateSchedule(i, i.day)
            }
        }
    })
})
addEventGlobalListener("submit", "#addSchedForm", e => {
    e.preventDefault();
    let weekday = $("#weekdayInput").attr("value");
    let timeStart = $("#timeStart").val();
    let timeEnd = $("#timeEnd").val();
    if(weekday === "") {
        alert("Choose a weekday.");
        return;
    }
    if(timeStart === "" || timeEnd === "") {
        alert("Input a time for both.");
        return;
    }
    if(timeStart >= timeEnd) {
        alert("Appointment cannot end before it starts or when it starts. Time start must be earlier than time end.")
        return;
    }
    if(confirm("Do you want to add this schedule?")) {
        let data = $("#addSchedForm").serialize();
        $.ajax({
            type: "POST",
            url: "../src/php/add-schedule_act.php",
            data: data,
            success: res => {
                let {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    $(`#${weekday}`).children("h1").remove();
                    $("#showSchedBtn").trigger("click");
                }
            }
        })
    }
})
addEventGlobalListener("keyup", "#inputFilterAppointments", e => {
    let filter = e.target.value.toLowerCase();
    let currAppCont = $($(docAppResCont).children(":not(.hide)")[0]);
    if(currAppCont.length !== 0 && filter.length === 0) {
        currAppCont.children(".doc__empty-msg").addClass("hide")
        currAppCont.children(".doc__app").removeClass("hide");
    } else {
        for(let i of currAppCont.children(".doc__app")) {
            let name = $(i).children(".doc__app--name").text();
            if(name.toLowerCase().includes(filter)) {
                $(i).removeClass("hide");
                // console.log("removing")
            } else {
                $(i).addClass("hide");
                // console.log("adding")
            }
        }
        if(currAppCont.children(":not(.doc__app.hide)").length === 1) {
            currAppCont.children(".doc__empty-msg").removeClass("hide")
        } else {
            currAppCont.children(".doc__empty-msg").addClass("hide")
        }
    }
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
                    isAppContEmpty("#docNotifsCont");
                    hideInputFilterAppointments("#docNotifsCont");
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
                    $(showDocAppointBtn).trigger("click");
                    isAppContEmpty(docAppUnResCont);
                    hideInputFilterAppointments(docAppUnResCont);
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
                    removeAppIdFromArr(id);
                    isAppContEmpty(docAppUnResCont)
                    hideInputFilterAppointments(docAppUnResCont);
                }
            }
        })
    }
})
addEventGlobalListener("click", ".doc__weekday-btn", e => {
    let weekday = `#${$(e.target).attr("data-weekday")}`;
    let html = `<h1>No time set on this day.</h1>`;

    isolateElemCont("#timeCont", weekday);
    addFocusClassToBtn(e.target, "doc__weekday-btn--focus");

    if($(weekday).children().length === 0) {
        $(weekday).append(html);
    }

    $("#weekdayInput").text(weekday.substring(1))
    $("#weekdayInput").attr("value", weekday.substring(1))
})
addEventGlobalListener("click", ".fa-trash", e => {
    if(confirm("Do you want to delete this schedule?")) {
        let parent = $(e.target).parent();
        let weekday = parent.parent().attr("id");
        $.ajax({
            type: "POST",
            url: "../src/php/delete-sched_act.php",
            data: "id=" + $(parent).attr("data-id"),
            success: res => {
                let {message, success} = JSON.parse(res);
                alert(message);
                if(success) {
                    $(parent).remove();
                    $(`.doc__weekday-btn[data-weekday="${weekday}"]`).trigger("click");
                }
            }
        })
    }
})