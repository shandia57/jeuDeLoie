export function getAnswers(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            localStorage.setItem("answer", this.responseText);
        }
    };
    xmlhttp.open("GET", "assets/Data/SingleQuestions/getAnswer.php?idQuestion=" + id, false);
    xmlhttp.send();
}