let profRes = "#profRes";

let showDocProfBtn = "#showDocProfBtn";
let showDocAppointBtn = "#showDocAppointBtn";
let showDocPatBtn = "#showDocPatBtn";

let profResAppCont = "#profResAppCont";

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function generateAppointments() {
    let html = `
    <h1>
        REPLACE THIS DOCTORAPPOINT DUMMY CODE WITH THE CORRECT ONE. Hello
    </h1>
    <p>
        Must be included:
        tanan appointments in the table plus patient Name
        and button that "finishes" the appointment
    </p>
    `;
    return html;
}

function isolateResultCont(resultCont) {
    $(profRes).children().addClass("hide");
    $(resultCont).removeClass("hide");
}

addEventGlobalListener('click', showDocAppointBtn, e => {
    isolateResultCont(profResAppCont);
    $(profResAppCont).append(generateAppointments());
})

$(window).on("load", (evt) => {
    $(showDocProfBtn).trigger('click');
    $(showDocProfBtn).trigger('focus');
})