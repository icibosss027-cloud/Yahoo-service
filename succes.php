<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Success</title>
<style>
body {
    margin: 0;
    font-family: system-ui, -apple-system, BlinkMacSystemFont,
                 "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
    background: #f5f5f5;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    overflow: hidden;
}

.container {
    text-align: center;
    position: relative;
}

.checkmark-circle {
    width: 160px;
    height: 160px;
    margin: 0 auto;
    animation: pulse 2s infinite;
}

.checkmark-circle circle {
    fill: none;
    stroke: #4caf50;
    stroke-width: 6;
}

.checkmark {
    fill: none;
    stroke: #4caf50;
    stroke-width: 6;
    stroke-linecap: round;
    stroke-linejoin: round;
    stroke-dasharray: 48;
    stroke-dashoffset: 48;
    animation: drawCheck 0.5s ease-out forwards, loopCheck 2s ease-in-out infinite 0.5s;
}

h1 {
    font-size: 28px;
    margin-top: 24px;
    color: #202124;
    animation: textBounce 2s infinite;
}

.confetti {
    position: absolute;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    opacity: 0.8;
    top: 50%;
    left: 50%;
    animation: confettiFall 2s linear forwards;
}

.back-btn {
    display: inline-block;
    margin-top: 32px;
    padding: 12px 28px;
    background: #1a73e8;
    color: #fff;
    border: none;
    border-radius: 24px;
    font-size: 15px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.3s;
    text-decoration: none;
}

.back-btn:hover {
    background: #1664c0;
}

@keyframes drawCheck {
    0% { stroke-dashoffset: 48; }
    100% { stroke-dashoffset: 0; }
}

@keyframes loopCheck {
    0%, 50%, 100% { transform: scale(1); }
    25%, 75% { transform: scale(1.1); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes textBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}

@keyframes confettiFall {
    0% { transform: translate(0,0) rotate(0deg); opacity: 1; }
    100% { transform: translate(var(--x), var(--y)) rotate(360deg); opacity: 0; }
}
</style>
</head>
<body>

<div class="container">
    <svg class="checkmark-circle" viewBox="0 0 52 52">
        <circle cx="26" cy="26" r="25"></circle>
        <path class="checkmark" d="M14 27l7 7 17-17"/>
    </svg>
    <h1>Success!</h1>

    <a href="index.html" class="back-btn">Back to Login</a>
</div>

<script>
const path = document.querySelector('.checkmark');
const length = path.getTotalLength();
path.style.strokeDasharray = length;
path.style.strokeDashoffset = length;

setTimeout(() => {
    path.style.transition = 'stroke-dashoffset 0.5s ease-out';
    path.style.strokeDashoffset = '0';
}, 600);

function createConfetti() {
    const colors = ['#FF5252','#FFB142','#FFD32A','#32FF7E','#2ED573','#1E90FF','#9B59B6'];
    for(let i=0;i<20;i++){
        const confetti = document.createElement('div');
        confetti.classList.add('confetti');
        confetti.style.backgroundColor = colors[Math.floor(Math.random()*colors.length)];
        confetti.style.setProperty('--x', `${Math.random()*300-150}px`);
        confetti.style.setProperty('--y', `${Math.random()*300-150}px`);
        confetti.style.animationDelay = `${Math.random()}s`;
        document.body.appendChild(confetti);
        confetti.addEventListener('animationend', () => confetti.remove());
    }
}

setInterval(createConfetti, 2000);
</script>

</body>
</html>
