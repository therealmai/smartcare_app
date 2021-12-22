// SEARCH PAGE
let searchForm = "#searchForm";
let searchResults = "#searchResults";

let searchName = "#searchName";
let searchOrder = "#searchOrder";
let searchSpecialty = "#searchSpecialty";
let searchNoResMsg = "#searchNoResMsg";

let appointForm = "#appointForm";

let docName = "#docName";
let docSpec = "#docSpec";
let docCont = "#docCont";

let bookNowBtns = ".search-results__book-btn";
let closeBtn = "#closeBtn";

let docId;

let specialties = {
    "cardio" : "Cardiologist",
    "pedia" : "Pediatrician",
    "radio" : "Radiologist"
}

const daysOfTheWeek = ["sun", "mon", 'tue', 'wed', 'thu', 'fri', 'sat'];
// SEARCH PAGE

// UTILITY FUNCTIONS
function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}
function isolateElemCont(cont , elem) {
    $(cont).children(":not([disabled])").addClass("hide");
    $(elem).removeClass("hide");
}
function stringify(name, arr) {
    return `${name}=${JSON.stringify(arr)}`;
}
// UTILITY FUNCTIONS

// SEARCH PAGE FUNCTIONS
function pushToArr(selector, arr, dataId) {
    $(selector).each((index, elem) => {
        arr.push($(elem).attr(dataId));
    })
}
function createSearchResultHtml({id, specialization, firstname, lastname, middle_initial, contact}) {
    return `
        <div data-doc-id=${id} class="search-results__result">
            <i class="fa fa-user-md fa-3x a" aria-hidden="true"></i>
            <h4 class="search-results__name b">Dr. ${lastname}, ${firstname} ${middle_initial}.</h4>
            <button class="search-results__book-btn c">
                Book Now
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </button>
            <a class="search-results__view d" href="" target="">View Profile</a> 
            <p class="search-results__spec e">
                <i class="fa fa-stethoscope" aria-hidden="true"></i>
                ${specialization}
            </p>
            <p class="search-results__contact f">
                <i class="fa fa-phone" aria-hidden="true"></i>
                ${contact}
            </p>
            <p class="search-results__f2f g">
                <i class="fa fa-user" aria-hidden="true"></i>
                F2F Fee - P500.00
            </p>
            <p class="search-results__virtual h">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
                Virtual  Fee - P500.00
            </p>
        </div>
    `;
}
function createSearchResult(arr) {
    arr.forEach((elem) => {
        $(searchResults).append(createSearchResultHtml(elem));
    })
}
function checkSearchInput() {
    let specLen, nameLen;
    specLen = $(searchSpecialty).val().length;
    nameLen = $(searchName).val().length;
    return specLen > 0 || nameLen > 0 ? 1 : 0;
}
function generateTime({time_start, time_end, day}) {
    let timeS = formatTime(time_start);
    let timeE = formatTime(time_end);
    let html = `
        <option value="${time_start}-${time_end}" class="hide ${day}">${timeS} - ${timeE}</option>
    `;
    $("#time").append(html);
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
function getDoctorSchedule() {
    $.ajax({
        type: "GET",
        url: "../src/php/get-doc-sched_act.php",
        data: "id="+docId,
        success: res => {
            let {data} = JSON.parse(res);
            for(var i of data) {
                generateTime(i);
            }
        }
    })
}
// SEARCH PAGE FUNCTIONS


addEventGlobalListener('click', closeBtn, (e) => {
    $(appointmentForm).addClass('hide');
})
addEventGlobalListener('click', bookNowBtns, (e) => {
    $(appointmentForm).removeClass("hide");
    let btn = $(e.target);
    let name = btn.siblings(".search-results__name").text();
    let spec = btn.siblings(".search-results__spec").text();
    let contact = btn.siblings(".search-results__contact").text();

    $(docName).text(name);
    $(docSpec).text(spec);
    $(docCont).text(`+63 ${contact}`);

    docId = $(e.target).parent().attr("data-doc-id");

    getDoctorSchedule();
})
addEventGlobalListener('submit', searchForm, (e) => {
    e.preventDefault();
    let data = $(searchForm).serialize();
    let url = "../src/php/search_act.php";
    let res, doctors, docIdsStr, docIds = [];

    pushToArr(".search-results__result", docIds, "data-doc-id");
    docIdsStr = stringify("docIds", docIds);
    data = `${data}&${docIdsStr}`;

    if(checkSearchInput()) {
        $.ajax({
            url: url,
            data: data,
            type: "Get",
            success: function(response) {
                res = JSON.parse(response);
                $(searchNoResMsg).addClass("hide");
                $(searchResults).children(".search-results__result").remove();
                if(res["isFound"]) {
                    doctors = res["data"];
                    createSearchResult(doctors);
                } else {
                    $(searchNoResMsg).removeClass("hide");
                }
            }
        })
    } else {
        alert("Please input a name or choose a filter!");
    }
})
addEventGlobalListener('submit', appointForm, (e) => {
    e.preventDefault();
    let data = $(appointForm).serialize();
    let url = "../src/php/appoint_act.php";
    $.ajax({
        type: "POST",
        url: url,
        data: data + `&docId=${docId}`,
        success: (resp) => {
            let {msg, success} = JSON.parse(resp);
            if(success) {
                $(appointForm)[0].reset();
            }
            alert(msg);
        }
    })
})
addEventGlobalListener('change', "#date", e => {
    let a = new Date($("#date").val());
    let day = daysOfTheWeek[a.getDay()];
    isolateElemCont("#time", `.${day}`);
})