let users = document.getElementsByName("users");
let input = document.getElementById("searchUser");
let ul = document.getElementById("userList");
let li = document.getElementsByClassName("list-group-item");
let listPlayers = document.getElementById("listPlayers");
let usersHidden = document.getElementById("usersHidden");
let color = ["red", "blue", "green", "yellow", "orange", "pink"]
input.addEventListener("keyup", (e) => {
    for (let i = 0; i < users.length; i++) {
        if (input.value !== "") {
            if (users[i].value.toLowerCase().indexOf(input.value) !== -1) {
                if (controlIfUserExist(users[i].value)) {
                    let li = document.createElement("li");
                    li.innerText = users[i].value;
                    li.setAttribute("class", "list-group-item");
                    li.addEventListener("click", () => {
                        input.value = li.innerText
                        removeAllLi();
                    })
                    ul.appendChild(li);
                }
            }
        }
    }

})

input.addEventListener("keydown", (e) => {
    if (e.key === "Backspace" || e.key === "Delete") {
        removeAllLi();
    }
})

document.getElementById("selectColor").addEventListener("change", (e) => {
    e.target.style.backgroundColor = e.target.value;
})

document.getElementById("addUser").addEventListener("click", () => {
    let select = document.getElementById("selectColor");
    let listPlayers = document.getElementById("listPlayers");
    let li = document.createElement("li");
    let inputHidden = document.createElement("input");
    if (color.includes(select.value) && isUserEverSelected(input.value)) {
        li.innerText = input.value;
        li.style.color = select.value
        listPlayers.appendChild(li);

        inputHidden.setAttribute("type", "hidden");
        inputHidden.setAttribute("name", "players[]");
        inputHidden.value = input.value + "," + select.value
        usersHidden.appendChild(inputHidden);

        removeColorInSelect(select.value);
        input.value = "";


    } else {
        alert("Couleur ou User déjà pris(e)")
    }
})

document.getElementById("createTheGame").addEventListener("click", (e) => {
    if (usersHidden.children.length > 1) {
        e.target.type = "submit";
    } else {
        alert("Il n'y a pas assez de joueur");
    }
})

function controlIfUserExist(username) {
    let ulArray = [];
    for (let i = 0; i < ul.children.length; i++) {
        if (!ulArray.includes(ul.children[i].innerText.toLowerCase())) {
            ulArray.push(ul.children[i].innerText.toLowerCase())
        }
    }
    if (ulArray.includes(username.toLowerCase())) {
        return false
    } else {
        return true;
    }

}

function removeAllLi() {
    while (ul.children.length > 0) {
        ul.removeChild(ul.firstChild)
    }
}

function removeColorInSelect(color) {
    let select = document.getElementById("selectColor");
    for (let i = 0; i < select.children.length; i++) {
        if (select.children[i].value === color) {
            select.removeChild(select.children[i]);
            select.value = "default";
            select.style.backgroundColor = "white";
        }
    }
}

function isUserEverSelected(username) {
    let ulArray = [];
    for (let i = 0; i < listPlayers.children.length; i++) {
        if (!ulArray.includes(listPlayers.children[i].innerText.toLowerCase())) {
            ulArray.push(listPlayers.children[i].innerText.toLowerCase())
        }
    }

    if (ulArray.includes(username)) {
        return false;
    } else {
        return true;
    }
}
