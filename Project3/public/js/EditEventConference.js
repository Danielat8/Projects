document
    .getElementById("event_or_conference")
    .addEventListener("change", function () {
        var selection = this.value;
        var eventInput = document.getElementById("event_input");
        var conferenceInput = document.getElementById("conference_input");

        document.getElementById("event_id").value = "";
        document.getElementById("conference_id").value = "";

        if (selection === "event") {
            eventInput.style.display = "block";
            conferenceInput.style.display = "none";
        } else if (selection === "conference") {
            eventInput.style.display = "none";
            conferenceInput.style.display = "block";
        } else {
            eventInput.style.display = "none";
            conferenceInput.style.display = "none";
        }
    });
document
    .getElementById("event_or_conference")
    .dispatchEvent(new Event("change"));
