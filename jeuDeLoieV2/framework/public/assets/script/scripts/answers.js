function updateAnswer(data) {
    let answerUpdate = document.getElementById("answerUpdate");
    let validAnswer = document.getElementById("validAnswerUpdate");
    let idAnswer = document.getElementById("idAnswerUpdate");
    if (data.dataset.value == 1) {
        validAnswer.checked = true;
    } else {
        validAnswer.checked = false;
    }
    idAnswer.value = data.dataset.id;
    answerUpdate.value = data.innerText;

}


document.getElementById("btnDelete").addEventListener("click", (e) => {
    if (confirm("Baise ta mère la pute vous sûr de vouloir supprimer cette question ? ")) {
        e.target.value = true;
        e.target.type = "submit";
    }
})