// import { CommonLib } from "../../common-script-lib";

const aboutPageCarousel = document.getElementById("about-page-carousel");


$(document).ready(async function() {
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        // margin: 10,
        nav: true,
        dots: true,
        navigation: true,
        slideSpeed: 40,
        paginationSpeed: 1000,
        navText: [
            "<span class=\"icon material-symbols-outlined\">arrow_back_ios_new</span>",
            "<span class=\"icon material-symbols-outlined\">arrow_forward_ios</span>"
        ],
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        freeDrag: false,
    });

    // Function to calculate and set the max height & width
    function resizeToFitAll() {
        let maxWidth = 0;
        let maxHeight = 0;

        owl.find(".owl-item").each(function () {
            const $item = $(this);
            const w = $item.outerWidth(true);
            const h = $item.outerHeight(true);
            if (w > maxWidth) maxWidth = w;
            if (h > maxHeight) maxHeight = h;
        });

        // Apply the calculated size to the container
        owl.find(".owl-stage-outer, .owl-stage").css({
            width: maxWidth + "px",
            height: maxHeight + "px",
        });

        // Force all items to the same height
        owl.find(".owl-item").css({
            height: maxHeight + "px",
        });
    }

    // Run on initialization, slide change, and window resize
    owl.on("initialized.owl.carousel translated.owl.carousel resized.owl.carousel", resizeToFitAll);

    $(window).on("resize", function () {
        clearTimeout(window._resizeTimeout);
        window._resizeTimeout = setTimeout(resizeToFitAll, 200);
    });

    // Initial call
    resizeToFitAll();
});

function calculateValue() {
    const paperWeight = document.getElementById("paper-weight-input").value;

    let total = 0;
    if (paperWeight >= 2000) {
        total = Math.floor(paperWeight * 50 / 2000);
    }

    if (paperWeight > 0) {
        document.getElementById("smapes-coins-result-text").innerText =
            `${paperWeight} gr paper(s) = ${total} SMAPES Coin(s)`;
    } else if (document.getElementById("paper-weight-input").value == "") {
        document.getElementById("smapes-coins-result-text").innerText = "";
    } else {
        document.getElementById("smapes-coins-result-text").innerText = "Masukkan berat limbah kertas dengan benar!";
    }
}

try {
    document.getElementById("paper-weight-input").addEventListener("keydown", function(e) {
        if (e.key === "e") e.preventDefault();
        if (e.key === "Enter") calculateValue();
    });
    document.getElementById("paper-weight-input").addEventListener("input", function(e) {
        calculateValue(false);
    });
} catch {}

// === From script-floating.js ===
const profileBtn = document.getElementById("profileBtn");
const floatingBar = document.getElementById("floatingBar");
// const openProfilePopup = document.getElementById("openProfilePopup");
const profilePopup = document.getElementById("profilePopup");
// const closeProfilePopup = document.getElementById("closeProfilePopup");

// Toggle floating bar
try {
    profileBtn.addEventListener("click", (e) => {
        e.stopPropagation();
        if (floatingBar.classList.contains("hidden")) {
            floatingBar.classList.remove("hidden");
        } else {
            floatingBar.classList.add("hidden");
        }
    });
    
    // Close floating bar if click outside
    document.addEventListener("click", () => {
        floatingBar.classList.add("hidden");
    });
    
    // Prevent close when clicking inside floating bar
    floatingBar.addEventListener("click", (e) => {
        e.stopPropagation();
    });
} catch {}
// === End Section ===

// === Chatbot ===
const chatbotBox = document.getElementById("chatbotBox");
const chatbotUserInput = document.getElementById("chatbotUserInput");
const chatbotSendButton = document.getElementById("chatbotSendButton");
const chatbotContainer = document.getElementById("chatbotContainer");
const chatbotToggleButton = document.getElementById("chatbotToggleButton");
const chatbotCloseButton = document.getElementById("chatbotCloseButton");

function appendChatbotMessage(text, cls) {
    const d = document.createElement("div");
    d.className = "message " + cls;
    d.innerText = text;
    chatbotBox.appendChild(d);
    chatbotBox.scrollTop = chatbotBox.scrollHeight;
    return d;
}

async function sendChatbotMessage(message) {
    if (!message) return;
    
    removeQuickReplies();
    appendChatbotMessage(message, "user");

    const loading = appendChatbotMessage("SMAPES Bot sedang mengetik...", "message bot");

    try {
        const resp = await fetch("/api/chat", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ message: message })
        });
        const data = await resp.json();
        loading.remove();
        appendChatbotMessage(data.reply, "bot");
    } catch (err) {
        console.error(err);
        loading.remove();
        appendChatbotMessage("Terjadi kesalahan.", "bot");
    }
}

function sendChatbotMessageFromInput() {
    const msg = chatbotUserInput.value.trim();
    chatbotUserInput.value = "";
    sendChatbotMessage(msg);
}

function removeQuickReplies() {
    document.querySelectorAll("#chatbotContainer .quick-replies").forEach(function(el) {
        el.remove();
    });
}

function showQuickReplies() {
    const quickReplies = document.createElement("ul");
    quickReplies.className = "quick-replies";
    
    [
        "Apa itu SMAPES?",
        "2000 gr limbah kertas sama dengan berapa SMAPES Coins?",
        "Bagaimana cara daftar/masuk ke SMAPES?",
        "SMAPES Corner ada dimana saja?",
    ].forEach(function(replyText) {
        const option = document.createElement("li");
        const optionButton = document.createElement("button");

        optionButton.textContent = replyText;
        optionButton.addEventListener("click", function() {
            sendChatbotMessage(replyText);
        });

        option.appendChild(optionButton);
        quickReplies.appendChild(option);
    })

    chatbotBox.appendChild(quickReplies);
    chatbotBox.scrollTop = chatbotBox.scrollHeight;
}

function logoutUser(redirect = true) {
    fetch("backend/auth-api.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: "logout=true"
    })
    .then(response => {
        return CommonLib.ajaxJsonPhpErrorHandler(response);
    })
    .then(data => {
        if (data.success) {
            location.href = "./";
        } else {
            new CommonLib.AlertDialog("Gagal untuk keluar akun.", "Error");
        }
    })
    .catch(error => {
        console.error("Fetch error:", error.message);
        new CommonLib.AlertDialog(error.message, "Error");
    });
}

// Example: Register a new account
async function registerUser(username, fullname, email, password) {
    const formData = new URLSearchParams({
        register: "1",
        username,
        fullname,
        email,
        password
    });

    const res = await fetch("backend/auth-api.php", {
        method: "POST",
        body: formData
    });

    const data = await res.json();
    console.log("Register:", data);

    if (data.success) {
        alert("✅ Registration successful!");
    } else {
        alert("❌ " + data.message);
    }
}

function randomThemeColor() {
    setInterval(() => {
        // Generate random number (0 to 16777215)
        const randomNum = Math.floor(Math.random() * 16777216);
    
        // Convert to hex and pad with zeros
        const hex = "#" + randomNum.toString(16).padStart(6, "0");
    
        document.querySelector("head meta[name=\"theme-color\"]").setAttribute("content", hex);
    }, 20);
}

function resizeFont(width, targetEl) {
    targetEl.style.fontSize = (width / 50) + "px"; // adjust divisor to control scale
}

function startupResizeEventActions() {
    if (aboutPageCarousel) {
        if (window.visualViewport.width < 1066) {
            aboutPageCarousel.classList.add("owl-carousel--transparent-nav");
        } else {
            aboutPageCarousel.classList.remove("owl-carousel--transparent-nav");
        }
    }
}

function resizeEventActions() {
    startupResizeEventActions();
}

// Event
try {
    startupResizeEventActions();

    // Resize dynamically if container changes
    window.addEventListener("resize", () => resizeEventActions());
    // new ResizeObserver(() => resizeEventActions()).observe(document.body);

    appendChatbotMessage("Halo! Ada yang bisa SMAPES-Bot bantu?", "bot");
    showQuickReplies();

    chatbotSendButton.addEventListener("click", sendChatbotMessageFromInput);
    chatbotUserInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") sendChatbotMessageFromInput();
    });
    
    // Toggle Chatbot
    chatbotToggleButton.addEventListener("click", () => {
        chatbotContainer.classList.toggle("hidden");
    });
    chatbotCloseButton.addEventListener("click", () => {
        chatbotContainer.classList.add("hidden");
    });
} catch (e) {
    console.error(e.message);
}
// === End Section ===

console.log("Successfully reach to the end of the code!");
