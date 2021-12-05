let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";

let showPatProfBtn = "#showPatProfBtn";
let showPatAppointBtn = "#showPatAppointBtn";
let showPatDocBtn ="#showPatDocBtn";

let AccSetBtn = "#AccSetBtn";
let ProfDetBtn = "#ProfDetBtn";


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
//              DOCTORS
//       INSERT CODE LIKE generateAppointment for Doctor
//              DOCTORS

//              PATIENTS
function generateAppointment({ID, Day, Month, Time, Year, Type, firstname, lastname, middle_initial, specialization}, action, cont) {
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let html = `
        <div data-id=${ID} class="prof-res__appoint">
            <h3>Dr. ${firstname} ${middle_initial}. ${lastname}</h3>
            <h3>${specialization}</h3>
            <h3>${Type}</h3>
            <h3>${Year}-${month}-${day}</h3>
            <h3>${Time}</h3>
            <button>${action}</button>
        </div>
    `;
    $(cont).append(html);
}
//              PATIENTS


//              DOCTORS
// addEventGlobalListener('click', showDocProfBtn, (e) => {
//     let html = `
//         <h1>
//             REPLACE THIS DOCTOR PROFILE DUMMY CODE WITH THE CORRECT ONE.
//         </h1>
//     `;
//     // $(profRes).children().remove();
//     $(profRes).append(html);
var x = document.getElementById("Docprof");
var y = document.getElementById("DocAppoint");

//              DOCTORS
addEventGlobalListener('click', showDocProfBtn, (e) => {
    x.style.display = "block";
    y.style.display = "none";
})
addEventGlobalListener('click', showDocAppointBtn, (e) => {
    x.style.display = "none";
    y.style.display = "block";
})
//              DOCTORS


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

var acc = document.getElementById("AccSetBtn");
var prof = document.getElementById("ProfDetBtn");
var accInfo = document.getElementById("acc-info");
var profInfo = document.getElementById("prof-info");
var ProfProfBtn = document.getElementById("showPatProfBtn");
var PatAppointBtn = document.getElementById("showPatAppointBtn");
var PatDocBtn = document.getElementById("showPatDocBtn");
var lineA = document.getElementById("line-selected-a");
var lineB = document.getElementById("line-selected-b");

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
    lineA.style.display = "none";
    lineB.style.display = "block";
    accInfo.style.display = "none";
    profInfo.style.display = "block";
    acc.style.color = "grey";
    prof.style.color = "black";
})

addEventGlobalListener('click', showPatProfBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#2240aa";
    PatDocBtn.style.backgroundColor = "#5f7de0";
    PatAppointBtn.style.backgroundColor = "#5f7de0";
    $(profResAppCont).addClass("hide");
    $(profPatDocCont).addClass("hide");
    $(profPatCont).removeClass("hide");
})

addEventGlobalListener('click', showPatDocBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatDocBtn.style.backgroundColor = "#2240aa";
    PatAppointBtn.style.backgroundColor = "#5f7de0";
    $(profResAppCont).addClass("hide");
    $(profPatCont).addClass("hide");
    $(profPatDocCont).removeClass("hide");
})

addEventGlobalListener('click', showPatAppointBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatDocBtn.style.backgroundColor = "#5f7de0";
    PatAppointBtn.style.backgroundColor = "#2240aa";
    $(profPatCont).addClass("hide");
    $(profPatDocCont).addClass("hide");
    $(profResAppCont).removeClass("hide");
    $.ajax({
        type: "GET",
        data: "appIdArr=" + JSON.stringify(appIdArr),
        url: "../src/php/get-appoints_act.php",
        success: (resp) => {
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

//              PATIENTS

$(window).on("load", (evt) => {
    $(showDocProfBtn).trigger('click');
    $(showDocProfBtn).trigger('focus');
    $(showPatProfBtn).trigger('click');
    $(showPatProfBtn).trigger('focus');
})