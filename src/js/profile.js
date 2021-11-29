let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";

let showPatProfBtn = "#showPatProfBtn";
let showPatAppointBtn = "#showPatAppointBtn";

let profResAppCont = "#profResAppCont";
let profResUnApp = "#profResUnApp";
let profResFinApp = "#profResFinApp";

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
function generateAppointment({Day, Month, Time, Year, Type, firstname, lastname, middle_initial, specialization}, action, cont) {
    let month = (Month).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let day = (Day).toLocaleString('en-US', {minimumIntegerDigits: 2, useGrouping: false});
    let html = `
        <div class="prof-res__appoint">
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
addEventGlobalListener('click', showPatAppointBtn, (e) => {
    $(profResAppCont).removeClass("hide");
    $.ajax({
        type: "GET",
        url: "../src/php/get-appoints_act.php",
        success: (resp) => {
            let {finished, unfinished} = JSON.parse(resp);
            console.log(finished);
            console.log(unfinished);
            for(var i of finished)
                generateAppointment(i, "Delete", profResFinApp);
            for(var i of unfinished)
                generateAppointment(i, "Cancel", profResUnApp);
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