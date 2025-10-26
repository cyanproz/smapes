var langData = {};
var bodyScripts = ["scripts/script-main.js"];
const ENABLE_SERVICE_WORKER = true;

try {
    fetch("./frontend/lang.json"/*, {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },s
        body: "get_json"
    }*/)
    .then(response => {
        // if (!response.ok) throw new Error('Network response was not ok');
        // return CommonLib.ajaxJsonPhpErrorHandler(response);
        return response.json();
    })
    .then(data => {
        // let template = Handlebars.compile(document.getElementById("handlebars-page-template").innerHTML);
        langData = data[document.documentElement.lang];
    })
    .catch(error => {
        console.error(error);
    });
} catch {}

if ("serviceWorker" in navigator) {
    window.addEventListener("load", () => {
        navigator.serviceWorker
            .register("/service-worker.js")
            .then(reg => console.log("✅ Service Worker registered:", reg.scope))
            .catch(err => console.error("❌ Service Worker registration failed:", err));
    });
}

