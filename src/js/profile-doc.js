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
            ${Time} &nbsp &nbsp ${month}/${day}/${Year}
        </h5>
        ${buttonHtml}
    </div>
    `;
    $(cont).append(html);
}
function generateBtnHtmlApp(type) {
    if(type === "un") {
        return `
            <button class="doc__app--done">Done</button>
            <button class="doc__app--cancel">Cancel</button>
        `
    } else {
        return `
            <button class="doc__app--remove">Remove</button>
        `
    }
}

function isolateResultCont(resultCont) {
    $(profRes).children().addClass("hide");
    $(resultCont).removeClass("hide");
}

var acc = document.getElementById("AccSetBtn");
var prof = document.getElementById("ProfDetBtn");
var accInfo = document.getElementById("acc-info");
var profInfo = document.getElementById("prof-info");
var ProfProfBtn = document.getElementById("showDocProfBtn");
var DocAppointBtn = document.getElementById("showDocAppointBtn");
var DocPatBtn = document.getElementById("showDocPatBtn");
var lineA = document.getElementById("line-selected-a");
var lineB = document.getElementById("line-selected-b");


$(profDocCont).removeClass("hide");

lineA.style.display = "block";
lineB.style.display = "none";
accInfo.style.display = "block";
profInfo.style.display = "none";
ProfProfBtn.style.backgroundColor = " #2240aa";
acc.style.color = "black";



addEventGlobalListener('click', AccSetBtn, (e) => {
    console.log("im here again");
    lineA.style.display = "block";
    lineB.style.display = "none";
    accInfo.style.display = "block";
    profInfo.style.display = "none";
    acc.style.color = "black";
    prof.style.color = "grey";
})

addEventGlobalListener('click', ProfDetBtn, (e) => {
    console.log("im here");
    lineA.style.display = "none";
    lineB.style.display = "block";
    accInfo.style.display = "none";
    profInfo.style.display = "block";
    acc.style.color = "grey";
    prof.style.color = "black";
})

addEventGlobalListener('click', showDocProfBtn, (e) => {
    console.log("im here");
    ProfProfBtn.style.backgroundColor = "#2240aa";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    $(profResAppCont).addClass("hide");
    $(profDocPatCont).addClass("hide");
    $(profDocCont).removeClass("hide");
})

addEventGlobalListener('click', showDocPatBtn, (e) => {
    console.log("im here");
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#2240aa";
    DocAppointBtn.style.backgroundColor = "#5f7de0";
    $(profResAppCont).addClass("hide");
    $(profDocCont).addClass("hide");
    $(profDocPatCont).removeClass("hide");
})

addEventGlobalListener('click', showDocAppointBtn, e => {
    console.log("im here");
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    DocPatBtn.style.backgroundColor = "#5f7de0";
    DocAppointBtn.style.backgroundColor = "#2240aa";
    $(profResAppCont).removeClass("hide");
    $(profDocCont).addClass("hide");
    $(profDocPatCont).addClass("hide");
    isolateResultCont(profResAppCont);
    $.ajax({
        type: "GET",
        data: "appIdArr=" + JSON.stringify(appIdArr),
        url: "../src/php/get-appoints-doc_act.php",
        success: resp => {
            let {finished, unfinished} = JSON.parse(resp);
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
        }
    })
})
addEventGlobalListener("click", showUnAppBtn, e=> {
    $(docAppFinResCont).addClass("hide");
    $(docAppUnResCont).removeClass("hide");
})
addEventGlobalListener("click", showFinAppBtn, e=> {
    $(docAppFinResCont).removeClass("hide");
    $(docAppUnResCont).addClass("hide");
})

$(window).on("load", (evt) => {
    // $(showDocProfBtn).trigger('click');
    // $(showDocProfBtn).trigger('focus');
})
// $("#Docprof").css("display", "none");
// $("#DocPatients").css("display", "none");