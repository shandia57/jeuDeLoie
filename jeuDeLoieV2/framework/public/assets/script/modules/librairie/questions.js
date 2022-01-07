export function getBlackQuestions(colorName) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
            localStorage.setItem(colorName, this.responseText);
        }
    };
    xmlhttp.open("GET", "assets/Data/Questions/get" + colorName + "Questions.php?", false);
    xmlhttp.send();
}