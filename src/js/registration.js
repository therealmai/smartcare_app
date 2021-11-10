let userFormCont = $("#userFormCont");
let patientFormCont= $("#patientFormCont");
let doctorFormCont= $("#doctorFormCont");
let secretaryFormCont = $("#secretaryFormCont");
let choicesCont = $("#choicesCont");

let nextBtn = $("#nextBtn");
let backBtn = $(".backBtn");
let regBtnPatient = $("#regBtnPatient");
let regBtnDoc = $("#regBtnDoc");
let regBtnSec = $("#regBtnSec");
let choosePatientBtn = $("#choosePatientBtn");
let chooseDocBtn = $("#chooseDocBtn");
let chooseSecBtn = $("#chooseSecBtn");

let leftSection = $("#leftSection");

let currentForm = userFormCont;

function addEventGlobalListener(action, selector, callback) {
    document.addEventListener(action, (e) => {
        e.preventDefault();
        if(e.target.matches(selector)) 
            callback(e);
    })
}

function isolateChoices() {
    leftSection.animate({
        "opacity": 0,
    }, 1000)

    choicesCont.animate({
        "right": "50%",
        "margin-right": "-250px"
    }, 1000)
}

function changeForm(form1, form2) {
    form1.toggleClass("hide");
    form2.toggleClass("hide");
}
function goToChoices(e) {
    changeForm(currentForm, choicesCont);
    isolateChoices();
}
function goToDoctorForm(e) {
    changeForm(doctorFormCont, choicesCont);
    currentForm = doctorFormCont;
}
function goToPatientForm(e) {
    changeForm(patientFormCont, choicesCont);
    currentForm = patientFormCont;
}
function goToSecretaryForm(e) {
    changeForm(secretaryFormCont, choicesCont);
    currentForm = secretaryFormCont;
}

addEventGlobalListener("click", "#nextBtn", goToChoices);
addEventGlobalListener("click", "#choosePatientBtn", goToPatientForm);
addEventGlobalListener("click", "#chooseDocBtn", goToDoctorForm);
addEventGlobalListener("click", "#chooseSecBtn", goToSecretaryForm);
addEventGlobalListener("click", ".backBtn", goToChoices);