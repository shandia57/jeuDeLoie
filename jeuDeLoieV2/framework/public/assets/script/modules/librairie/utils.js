export function filterFromSelectInput(event, idParent, positionChild1, positionChild2) {
    const parent = document.getElementById(idParent);
    let itemsArray = Array.prototype.slice.call(parent.children);


    if (event.target.value === "ascendant") {
        itemsArray.sort(function (a, b) {
            if (parseInt(a.children[positionChild1].innerText) < parseInt(b.children[positionChild1].innerText)) return -1;
            if (parseInt(a.children[positionChild1].innerText) > parseInt(b.children[positionChild1].innerText)) return 1;
            return 0;
        });
    } else if (event.target.value === "descendant") {
        itemsArray.sort(function (a, b) {
            if (parseInt(a.children[positionChild1].innerText) > parseInt(b.children[positionChild1].innerText)) return -1;
            if (parseInt(a.children[positionChild1].innerText) < parseInt(b.children[positionChild1].innerText)) return 1;
            return 0;
        });
    } else if (event.target.value === "az") {
        itemsArray.sort(function (a, b) {
            if (a.children[positionChild2].innerText.toLowerCase() < b.children[positionChild2].innerText.toLowerCase()) return -1;
            if (a.children[positionChild2].innerText.toLowerCase() > b.children[positionChild2].innerText.toLowerCase()) return 1;
            return 0;
        });
    } else if (event.target.value === "za") {
        itemsArray.sort(function (a, b) {
            if (a.children[positionChild2].innerText.toLowerCase() > b.children[positionChild2].innerText.toLowerCase()) return -1;
            if (a.children[positionChild2].innerText.toLowerCase() < b.children[positionChild2].innerText.toLowerCase()) return 1;
            return 0;
        });
    } else if (event.target.value === "levelAsc") {
        itemsArray.sort(function (a, b) {
            if (parseInt(a.children[positionChild2].dataset.value) < parseInt(b.children[positionChild2].dataset.value)) return -1;
            if (parseInt(a.children[positionChild2].dataset.value) > parseInt(b.children[positionChild1].dataset.value)) return 1;
            return 0;
        });

    } else if (event.target.value === "levelDesc") {
        itemsArray.sort(function (a, b) {
            if (parseInt(a.children[positionChild2].dataset.value) > parseInt(b.children[positionChild2].dataset.value)) return -1;
            if (parseInt(a.children[positionChild2].dataset.value) < parseInt(b.children[positionChild2].dataset.value)) return 1;
            return 0;
        });

    }
    itemsArray.forEach(function (item) {
        parent.appendChild(item);
    });
    console.log(parent);

}

export function searchValueFromSearchbar(event, idTable) {
    const tableRowData = document.getElementsByClassName(idTable);
    if (event.target.value.trim().length === 0) {
        for (let i = 0; i < tableRowData.length; i++) {
            tableRowData[i].style.display = "";
        }
    } else {
        for (let i = 0; i < tableRowData.length; i++) {
            let tableData = tableRowData[i].getElementsByTagName("td");
            for (let j = 0; j < tableData.length; j++) {
                if (event.target.value.toLowerCase().trim() === tableData[j].innerText.toLocaleLowerCase().trim()) {
                    tableRowData[i].style.display = "";
                    break;
                } else {
                    tableRowData[i].style.display = "none";
                }
            }
        }
    }

}