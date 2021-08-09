// allowing the given element to be dropped
function allowDrop(event) {
    event.preventDefault();
}
// method to drag the given element with its data
function drag(event) {
    event.dataTransfer.setData("text", event.target.id);
}

// method to drop the given element
function drop(event) {
    event.preventDefault();
    var data = event.dataTransfer.getData("text");
    event.target.appendChild(document.getElementById(data));
}