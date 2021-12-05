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

addEventGlobalListener('click', showDocAppointBtn, e => {
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