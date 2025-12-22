import './bootstrap';

// Mengambil elemen-elemen dari HTML
const minutesEl = document.getElementById('minutes');
const secondsEl = document.getElementById('seconds');
const startBtn = document.getElementById('start-btn');
const pauseBtn = document.getElementById('pause-btn');
const resetBtn = document.getElementById('reset-btn');

// Variabel-variabel untuk logika timer
let intervalId = null;
let totalSeconds = 25 * 60; // Default: 25 menit kerja
let isPaused = true;

// Fungsi untuk memperbarui tampilan waktu
function updateTimerDisplay() {
    const minutes = Math.floor(totalSeconds / 60);
    const seconds = totalSeconds % 60;
    minutesEl.textContent = String(minutes).padStart(2, '0');
    secondsEl.textContent = String(seconds).padStart(2, '0');
}

// Fungsi untuk memulai timer
function startTimer() {
    // Jika timer sedang berjalan, abaikan
    if (!isPaused) return; 
    isPaused = false;
    
    intervalId = setInterval(() => {
        if (totalSeconds > 0) {
            totalSeconds--;
            updateTimerDisplay();
        } else {
            clearInterval(intervalId);
            alert("Waktu kerja selesai! Saatnya istirahat.");
            // Di sini kamu bisa tambahkan logika untuk masuk ke mode istirahat
        }
    }, 1000); // 1000 milidetik = 1 detik
}

// Fungsi untuk menjeda timer
function pauseTimer() {
    if (isPaused) return;
    isPaused = true;
    clearInterval(intervalId);
}

// Fungsi untuk mereset timer
function resetTimer() {
    pauseTimer(); // Berhenti dulu jika sedang berjalan
    totalSeconds = 25 * 60;
    updateTimerDisplay();
}

// Menambahkan event listener ke tombol-tombol
startBtn.addEventListener('click', startTimer);
pauseBtn.addEventListener('click', pauseTimer);
resetBtn.addEventListener('click', resetTimer);

// Memanggil fungsi ini pertama kali untuk menampilkan waktu awal
updateTimerDisplay();