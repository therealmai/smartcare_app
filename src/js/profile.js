let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";

let showPatProfBtn = "#showPatProfBtn";
let showPatAppointBtn = "#showPatAppointBtn";

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

//              DOCTORS
addEventGlobalListener('click', showDocProfBtn, (e) => {
    let html = `
        <h1>
            REPLACE THIS DOCTOR PROFILE DUMMY CODE WITH THE CORRECT ONE.
        </h1>
    `;
    $(profRes).children().remove();
    $(profRes).append(html);
})
addEventGlobalListener('click', showDocAppointBtn, (e) => {
    let html = `
        <h1>
            REPLACE THIS DOCTORAPPOINT DUMMY CODE WITH THE CORRECT ONE.
        </h1>
    `;
    $(profRes).children().remove();
    $(profRes).append(html);
})
//              DOCTORS


//              PATIENTS
addEventGlobalListener('click', showPatProfBtn, (e) => {
    let html = `
        <h1>
            REPLACE THIS PATIENT PROFILE DUMMY CODE WITH THE CORRECT ONE.
        </h1>
    `;
    $(profRes).children().remove();
    $(profRes).append(html);
})
addEventGlobalListener('click', showPatAppointBtn, (e) => {
    let html = `
        <h1>
            REPLACE THIS PATIENT APPOINTMENTS DUMMY CODE WITH THE CORRECT ONE.
        </h1>
    `;
    $(profRes).children().remove();
    $(profRes).append(html);
})
//              PATIENTS

$(window).on("load", (evt) => {
    $(showDocProfBtn).trigger('click');
    $(showDocProfBtn).trigger('focus');
    $(showPatProfBtn).trigger('click');
    $(showPatProfBtn).trigger('focus');
});