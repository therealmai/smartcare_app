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
// SEARCH PAGE
var password = document.getElementById("password"), confirm_password = document.getElementById("confirm_password");
function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

// UTILITY FUNCTIONS
function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
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
            <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
            <div class="search-results__profile">
                <h4>Dr. ${firstname} ${middle_initial}. ${lastname}, MD</h4>
                <a href="" target="">View Profile</a>
            </div>
            <div class="search-results__addi-info">
                <p>
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    ${specialization}
                </p>
                <p>
                    <i class="fa fa-phone" aria-hidden="true"></i>
                    ${contact}
                </p>
                <p>
                    <i class="fa fa-user" aria-hidden="true"></i>
                    F2F Consultation - P500.00
                </p>
                <p>
                    <i class="fa fa-video-camera" aria-hidden="true"></i>
                    Virtual  Consultation - P500.00
                </p>
            </div>
            <button class="search-results__book-btn">
                Book Now
                <i class="fa fa-angle-right" aria-hidden="true"></i>
            </button>
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
// SEARCH PAGE FUNCTIONS


addEventGlobalListener('click', closeBtn, (e) => {
    $(appointmentForm).addClass('hide');
})
addEventGlobalListener('click', bookNowBtns, (e) => {
    $(appointmentForm).removeClass("hide");
    let profile = $(e.target).siblings(".search-results__profile");
    let addInfo = $(e.target).siblings(".search-results__addi-info")
    let name = $(profile).find("h4").text();
    let spec = $(addInfo).children("p:nth-child(1)").text();
    let cont = $(addInfo).children("p:nth-child(2)").text();

    $(docName).text(name);
    $(docSpec).text(spec);
    $(docCont).text(`+63 ${cont}`);

    docId = $(e.target).parent().attr("data-doc-id");
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