let logout = document.getElementById("logout");
let anyErrors = document.getElementById("anyErrors");

if (logout) {
    logout.addEventListener("click", (e) => {
        if (confirm("Êtes-vous sûr de vouloir vous déconnecter ?  ")) {
            e.target.type = "submit";
            e.target.value = "true";
        }
    })
}

if (anyErrors.value.trim().length > 0) {
    alert(anyErrors.value);
}

