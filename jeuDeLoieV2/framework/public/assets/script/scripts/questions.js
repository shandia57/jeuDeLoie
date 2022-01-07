let btn = document.getElementById("btnCreateAnswer").addEventListener("click", (e) => {

    let listAnswer = document.createElement("div");
    let labelAnswer = document.createElement("div");
    let label = document.createElement("label");
    let numberOfAnswer = document.getElementsByClassName("answer").length + 1;
    let div = document.createElement("div");
    let input2 = document.createElement('input');
    let label2 = document.createElement("label");
    let input = document.createElement("input");

    listAnswer.setAttribute("class", "listAnswer");
    labelAnswer.setAttribute("class", "labelAnswer");
    input.setAttribute("class", "form-control");
    input.setAttribute("type", "text");
    input.setAttribute("name", "answer[]");

    label.setAttribute("class", "form-label answer");
    label.innerText = "Réponse" + numberOfAnswer;
    div.setAttribute("class", "form-check form-switch");
    input2.setAttribute("class", "form-check-input");
    input2.setAttribute("type", "checkbox");
    input2.setAttribute("name", "validAnswer" + numberOfAnswer);
    label2.setAttribute("class", "form-check-label");
    label2.innerText = "Réponse valide";

    listAnswer.appendChild(labelAnswer);
    listAnswer.appendChild(input);

    labelAnswer.appendChild(label);
    labelAnswer.appendChild(div);
    div.appendChild(input2);
    div.appendChild(label2);

    e.target.parentNode.insertBefore(listAnswer, e.target)

});

function updateQuestion(data) {

    let level = document.getElementById("level");
    let dataValueOfLevel = data.parentNode.parentNode.children[2].innerText;

    for (let i = 0; i < level.children.length; i++) {
        if (level.children[i].value === dataValueOfLevel) {
            level.children[i].selected = true;
        }
    }

    document.getElementsByClassName("idQuestions")[0].value = data.parentNode.parentNode.children[0].innerText;
    document.getElementsByClassName("labelUpdate")[0].value = data.parentNode.parentNode.children[1].innerText;
    document.getElementsByClassName("questionUpdate")[0].value = data.parentNode.parentNode.children[3].innerText;
}


function colorLevelQuestions() {
    let level = document.getElementsByClassName("colorLevel");
    for (let i = 0; i < level.length; i++) {
        level[i].style.backgroundColor = switchColor(level[i].dataset.colorvalue)[0];
        level[i].dataset.value = switchColor(level[i].dataset.colorvalue)[1];
    }
}

function switchColor(color) {
    switch (color) {
        case "Vert":
            return ["#44bd32", 1];

        case "Jaune":
            return ["#fbc531", 2];

        case "Bleu":
            return ["#3867d6", 3];

        case "Orange":
            return ["#EE5A24", 4];

        case "Rouge":
            return ["#EA2027", 5];
        case "Noir":
            return ["#3d3d3d", 6];
    }
}

colorLevelQuestions();
