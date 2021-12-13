let profRes = "#profRes";

let showPatProfBtn = "#showPatProfBtn";
let showPatAppointBtn = "#showPatAppointBtn";
let showPatDocBtn ="#showPatDocBtn";
let showPatPresBtn = "#showPatPresBtn";
let profResAppCont = "#profResAppCont";

let AccSetBtn = "#AccSetBtn";
let ProfDetBtn = "#ProfDetBtn";

let profResUnApp = "#profResUnApp";
let profResFinApp = "#profResFinApp";
let appIdArr = [];

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
//              DOCTORS
//       INSERT CODE LIKE generateAppointment for Doctor
//              DOCTORS

//              PATIENTS
function generateAppointment({ID, Day, Month, Time, Year, Type, firstname, lastname, middle_initial, contact, specialization}, action, cont) {
    let type = Type == "f2f" ? "Face-to-face" : "Online"
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let buttonHtml = generateBtnHtmlApp(action);
    let time = formatTime(Time);
    let html = `
    <div data-id="${ID}" class="doc__app">
        <span class="fa-stack fa-3x">
            <i class="fa fa-circle fa-stack-2x"></i>
            <i class="fa fa-stack-1x fa-user" aria-hidden="true"></i>
        </span>
        <h4>Dr. ${firstname} ${middle_initial}. ${lastname}</h4>
        <h5 class="doc__app--contact">${contact}</h5>
        <h6>${specialization}</h6>
        <h5 class="doc__app--type">${type}</h5>
        <h5 class="doc__app--time">
            <i class="fa fa-clock-o" aria-hidden="true"></i>
            ${time} &nbsp &nbsp ${month}/${day}/${Year}
        </h5>
        ${buttonHtml}
    </div>
    `;
    $(cont).append(html);
}
function generateBtnHtmlApp(type) {
    if(type === "Cancel") {
        return `
            <button class="doc__app--cancel">Cancel</button>
        `
    } else {
        return `
            <button class="doc__app--remove doc__app--blue">View</button>
        `
    }
}
function addFocusClassToAppBtn(button) {
    $(".doc__app-btns").children().removeClass("doc__app-btn--focus");
    $(button).addClass("doc__app-btn--focus");
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


//              DOCTORS
// addEventGlobalListener('click', showDocProfBtn, (e) => {
//     let html = `
//         <h1>
//             REPLACE THIS DOCTOR PROFILE DUMMY CODE WITH THE CORRECT ONE.
//         </h1>
//     `;
//     // $(profRes).children().remove();
//     $(profRes).append(html);

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
    console.log(arr['email']);
    
    document.getElementById("patient_id").value=arr['userID'];
   document.getElementById("Accpatient_id").value=arr['userID'];
   document.getElementById("email").value = arr['email'];
    // document.getElementById("password").value = arr['password'];
  
    document.getElementById("contact").value=arr['contact'];

}

function showAccData(arr){
    console.log("hello");
}

var acc = document.getElementById("AccSetBtn");
var prof = document.getElementById("ProfDetBtn");
var accInfo = document.getElementById("acc-info");
var profInfo = document.getElementById("prof-info");
var ProfProfBtn = document.getElementById("showPatProfBtn");
var PatAppointBtn = document.getElementById("showPatAppointBtn");
var PatPresBtn = document.getElementById("showPatPresBtn");
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
    PatPresBtn.style.backgroundColor = "#5f7de0";
    $(profPatPresCont).addClass("hide");
    $(profResAppCont).addClass("hide");
    $(profPatDocCont).addClass("hide");
    $(profPatCont).removeClass("hide");
})

addEventGlobalListener('click', showPatDocBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatDocBtn.style.backgroundColor = "#2240aa";
    PatAppointBtn.style.backgroundColor = "#5f7de0";
    PatPresBtn.style.backgroundColor = "#5f7de0";
    $(profPatPresCont).addClass("hide");
    $(profResAppCont).addClass("hide");
    $(profPatCont).addClass("hide");
    $(profPatDocCont).removeClass("hide");
})

addEventGlobalListener('click', showPatAppointBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatDocBtn.style.backgroundColor = "#5f7de0";
    PatAppointBtn.style.backgroundColor = "#2240aa";
    PatPresBtn.style.backgroundColor = "#5f7de0";
    isolateResultCont(profResAppCont)
    $("#showUnAppBtn").trigger("click");
    $.ajax({
        type: "GET",
        data: "appIdArr=" + JSON.stringify(appIdArr),
        url: "../src/php/get-appoints-pat_act.php",
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
                if(success) {
                    alert(message);
                    index = appIdArr.indexOf(id);
                    if(index != -1)
                        appIdArr.splice(index, 1)
                    app.remove();
                }
            },
            error: err => {
                console.log(err);
            }
        })
    }
})
addEventGlobalListener('click', "#showFinAppBtn", e => {
    $("#profResUnApp").addClass("hide");
    $("#profResFinApp").removeClass("hide");
    addFocusClassToAppBtn("#showFinAppBtn");
})
addEventGlobalListener('click', "#showUnAppBtn", e => {
    $("#profResUnApp").removeClass("hide");
    $("#profResFinApp").addClass("hide");
    addFocusClassToAppBtn("#showUnAppBtn");
})

//              PATIENTS

$(window).on("load", (evt) => {
    $(showPatProfBtn).trigger('click');
    $(showPatProfBtn).trigger('focus');
})

addEventGlobalListener('click', showPatPresBtn, (e) => {
    ProfProfBtn.style.backgroundColor = "#5f7de0";
    PatDocBtn.style.backgroundColor = "#5f7de0";
    PatAppointBtn.style.backgroundColor = "#5f7de0";
    PatPresBtn.style.backgroundColor = "#2240aa";
    $(profPatPresCont).removeClass("hide");
    $(profPatCont).addClass("hide");
    $(profPatDocCont).addClass("hide");
    $(profResAppCont).addClass("hide");

    // $.ajax({
    //     type: "GET",
    //     data: "appIdArr=" + JSON.stringify(appIdArr),
    //     url: "../src/php/get-appoints_act.php",
    //     success: (resp) => {
    //         let {finished, unfinished} = JSON.parse(resp);
    //         for(var i of finished) {
    //             generateAppointment(i, "Delete", profResFinApp);
    //             if(!appIdArr.includes(i.ID)) 
    //                 appIdArr.push(i.ID);
    //         } 
    //         for(var i of unfinished){
    //             generateAppointment(i, "Cancel", profResUnApp);
    //             if(!appIdArr.includes(i.ID))
    //                 appIdArr.push(i.ID);
    //         }
    //     }
    // })
})