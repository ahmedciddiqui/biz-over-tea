/*
    
$(function () {
    document.getElementById("year").textContent = new Date().getFullYear();

    const form = document.getElementById("inviteForm");
    const result = document.getElementById("formResult");

    function validateRequired(id) {
    const el = document.getElementById(id);
    if (!el) return true;
    const ok = (el.value || "").trim().length > 0;
    if (!ok) el.focus();
    return ok;
    }

    form.addEventListener("submit", function (e) {
    e.preventDefault();

    const requiredIds = ["name", "email", "location", "company", "role", "industry", "decision", "challenge", "note"];
    for (const id of requiredIds) {
        if (!validateRequired(id)) {
        result.style.display = "block";
        result.textContent = "Please complete the highlighted field(s) and submit again.";
        return;
        }
    }

    const data = new FormData(form);
    const name = (data.get("name") || "").toString().trim();
    const company = (data.get("company") || "").toString().trim();

    result.style.display = "block";
    result.textContent =
        `Thank you${name ? ", " + name : ""}. Your request has been received and will be reviewed. ` +
        `If aligned, you will be contacted personally${company ? " regarding " + company : ""}.`;

    form.reset();
    window.location.hash = "#request";
    });
});
*/