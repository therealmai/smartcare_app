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
    console.log(age);
    document.getElementById("patient_id").value=arr['id'];
    document.getElementById("firstname").value=arr['firstname'];
    document.getElementById("lastname").value=arr['lastname'];
    document.getElementById("middle_initial").value=arr['middle_initial'];
    document.getElementById("age").value=age
    document.getElementById("contact").value=arr['contact'];
    document.getElementById("height").value=arr['height'];
    document.getElementById("weight").value=arr['weight'];
    document.getElementById("blood_pressure").value=arr['blood_pressure'];
    document.getElementById("heartRate").value=arr['heart_rate'];
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
    $(profPatPresCont).addClass("hide");
    $(profPatCont).addClass("hide");
    $(profPatDocCont).addClass("hide");
    $(profResAppCont).removeClass("hide");
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