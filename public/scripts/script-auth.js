const showPasswordButton = document.getElementById("show-password-button");
const passwordInput = document.getElementById("password-input");

showPasswordButton.addEventListener("mouseenter", function(e) {
    CommonLib.showTooltip(e,
        showPasswordButton.querySelector(":scope > .icon").textContent == "lock" ? "Tampilkan Password" : "Sembunyikan Password");
});

showPasswordButton.addEventListener("click", function () {
    if (showPasswordButton.querySelector(":scope > .icon").textContent == "lock") {
        showPasswordButton.querySelector(":scope > .icon").textContent = "lock_open_right";
        passwordInput.type = "text";
    } else if (showPasswordButton.querySelector(":scope > .icon").textContent == "lock_open_right") {
        showPasswordButton.querySelector(":scope > .icon").textContent = "lock";
        passwordInput.type = "password";
    }
});



// ========== CHECK AVAILABILITY FUNCTIONS ==========
async function checkUsername(username) {
    const res = await fetch("backend/auth-api.php", {
        method: "POST",
        body: new URLSearchParams({ "check-username": "1", username })
    });

    const data = await CommonLib.ajaxJsonPhpErrorHandler(res);
    console.log("Check Username:", data);

    if (data.success) {
        console.log(data.exists ? "❌ Username already taken" : "✅ Username available");
        return data;
    }

    return null;
}

async function checkFullname(fullname) {
    const res = await fetch("backend/auth-api.php", {
        method: "POST",
        body: new URLSearchParams({ "check-fullname": "1", fullname })
    });

    const data = await CommonLib.ajaxJsonPhpErrorHandler(res);
    console.log("Check Fullname:", data);

    if (data.success) {
        console.log(data.exists ? "❌ Full name already used" : "✅ Full name available");
        return data;
    }

    return null;
}

async function checkEmail(email) {
    const res = await fetch("backend/auth-api.php", {
        method: "POST",
        body: new URLSearchParams({ "check-email": "1", email })
    });

    const data = await CommonLib.ajaxJsonPhpErrorHandler(res);
    console.log("Check Email:", data);

    if (data.success) {
        console.log(data.exists ? "❌ Email already used" : "✅ Email available");
        return data;
    }

    return null;
}


try {
    document.getElementById("input-username").addEventListener("input", function() {
        // console.log(this.value);
        checkUsername(this.value)
        .then(data => {
            if (data !== null) document.getElementById("username-verification-message").textContent =
                data.exists ? "Uername sudah digunakan." : "";
        });
    });
} catch {}


// ========== LOGIN / REGISTER HANDLER ==========
const authForm = document.getElementById("auth-form");
const errorMessage = document.getElementById("auth-form-error-message");

if (authForm) {
    let lastClickedButton = null;

    // Detect which button (login/register) was clicked
    authForm.querySelectorAll("button[type=submit]").forEach(btn => {
        btn.addEventListener("click", () => {
            lastClickedButton = btn.name; // "login" or "register"
        });
    });

    authForm.addEventListener("submit", async (e) => {
        e.preventDefault();

        const formData = new FormData(authForm);

        // Add the clicked button name so PHP knows what action
        if (lastClickedButton) {
            formData.append(lastClickedButton, "1");
        }

        try {
            const response = await fetch("backend/auth-api.php", {
                method: "POST",
                body: formData
            });

            const data = await CommonLib.ajaxJsonPhpErrorHandler(response);

            if (data.success) {
                // If register: show success message
                if (lastClickedButton === "register") {
                    alert("✅ Registration successful!");
                    location.href = "./"; // optional redirect
                } 
                // If login: go to home
                else if (lastClickedButton === "login") {
                    location.href = "./";
                }
            } else {
                errorMessage.textContent = data.message;
            }

        } catch (error) {
            console.error("Fetch error:", error);
            errorMessage.textContent = error.message;
        }
    });
}
