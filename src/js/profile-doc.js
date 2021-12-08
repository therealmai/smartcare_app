let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";
let showDocPatBtn = "#showDocPatBtn";

let profResAppCont = "#profResAppCont";
let profResUnApp = "#profResUnApp";
let profResFinApp = "#profResFinApp";

let appIdArr = [];

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function generateAppointment({ID, Day, Month, Time, Year, Type, firstname, lastname, middle_initial, specialization}, action, cont) {
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let html = `
    <div data-id=${ID} class="prof-res__appoint">
        <h3>${firstname} ${middle_initial}. ${lastname}</h3>
        <h3>${specialization}</h3>
        <h3>${Type}</h3>
        <h3>${Year}-${month}-${day}</h3>
        <h3>${Time}</h3>
        <button>${action}</button>
    </div>
    `;
    $(cont).append(html);
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
                generateAppointment(i, "Delete", profResFinApp);
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
            for(var i of unfinished){
                generateAppointment(i, "Cancel", profResUnApp);
                if(!appIdArr.includes(i.ID))
                    appIdArr.push(i.ID);
            }
        }
    })
})

$(window).on("load", (evt) => {
    $(showDocProfBtn).trigger('click');
    $(showDocProfBtn).trigger('focus');
})