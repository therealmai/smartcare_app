let searchForm = "#searchForm";
let searchResults = "#searchResults";

let searchName = "#searchName";
let searchOrder = "#searchOrder";
let searchSpecialty = "#searchSpecialty";
let searchNoResMsg = "#searchNoResMsg";

let specialties = {
    "cardio" : "Cardiologist",
    "pedia" : "Pediatrician",
    "radio" : "Radiologist"
}

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function pushToArr(selector, arr, dataId) {
    $(selector).each((index, elem) => {
        arr.push($(elem).attr(dataId));
    })
}

function stringify(name, arr) {
    return `${name}=${JSON.stringify(arr)}`;
}



function createSearchResultHtml(name, specialty, contact, id) {
    return `
        <div data-doc-id=${id} class="search-results__result">
            <i class="fa fa-user-md fa-2x" aria-hidden="true"></i>
            <div class="search-results__profile">
                <h4>Dr. ${name}, MD</h4>
                <a href="" target="">View Profile</a>
            </div>
            <div class="search-results__addi-info">
                <p>
                    <i class="fa fa-stethoscope" aria-hidden="true"></i>
                    ${specialty}
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
        $(searchResults).append(createSearchResultHtml(elem["name"], elem["specialization"], elem["contact"], elem["id"]));
    })
}

function checkSearchInput() {
    let specLen, nameLen;
    specLen = $(searchSpecialty).val().length;
    nameLen = $(searchName).val().length;
    return specLen > 0 || nameLen > 0 ? 1 : 0;
}

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
                if(res["isFound"] > 0) {
                    doctors = res["data"];
                    $(searchResults).children().remove();
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