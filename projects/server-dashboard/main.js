/* Server Dashboard — main.js */
'use strict';

// ── Canvas setup ──────────────────────────────────────────────────────
const cpuCanvas = document.getElementById('cpuChart');
const netCanvas = document.getElementById('netChart');
const cpuCtx    = cpuCanvas.getContext('2d');
const netCtx    = netCanvas.getContext('2d');

let cpuHistory = Array.from({ length: 50 }, () => 30 + Math.random() * 30);
let netHistory = Array.from({ length: 30 }, () => 1 + Math.random() * 2);

function resizeAll() {
  [cpuCanvas, netCanvas].forEach(c => {
    c.width  = c.parentElement.clientWidth;
    c.height = c.parentElement.clientHeight;
  });
  drawCpuChart();
  drawNetChart();
}
resizeAll();
window.addEventListener('resize', resizeAll);

// ── CPU chart ─────────────────────────────────────────────────────────
function drawCpuChart() {
  const w = cpuCanvas.width, h = cpuCanvas.height;
  cpuCtx.clearRect(0, 0, w, h);
  const step = w / (cpuHistory.length - 1);

  const grad = cpuCtx.createLinearGradient(0, 0, 0, h);
  grad.addColorStop(0, 'rgba(245,158,11,0.35)');
  grad.addColorStop(1, 'rgba(245,158,11,0)');

  cpuCtx.beginPath();
  cpuCtx.moveTo(0, h);
  cpuHistory.forEach((v, i) => cpuCtx.lineTo(i * step, h - (v / 100) * h * 0.9));
  cpuCtx.lineTo(w, h);
  cpuCtx.closePath();
  cpuCtx.fillStyle = grad;
  cpuCtx.fill();

  cpuCtx.beginPath();
  cpuCtx.strokeStyle = '#f59e0b';
  cpuCtx.lineWidth   = 2;
  cpuHistory.forEach((v, i) => {
    const x = i * step, y = h - (v / 100) * h * 0.9;
    i === 0 ? cpuCtx.moveTo(x, y) : cpuCtx.lineTo(x, y);
  });
  cpuCtx.stroke();
}

// ── Network chart ─────────────────────────────────────────────────────
function drawNetChart() {
  const w = netCanvas.width, h = netCanvas.height;
  netCtx.clearRect(0, 0, w, h);
  const step = w / (netHistory.length - 1);
  const max  = Math.max(...netHistory, 1);

  const grad = netCtx.createLinearGradient(0, 0, 0, h);
  grad.addColorStop(0, 'rgba(14,165,233,0.35)');
  grad.addColorStop(1, 'rgba(14,165,233,0)');

  netCtx.beginPath();
  netCtx.moveTo(0, h);
  netHistory.forEach((v, i) => netCtx.lineTo(i * step, h - (v / max) * h * 0.85));
  netCtx.lineTo(w, h);
  netCtx.closePath();
  netCtx.fillStyle = grad;
  netCtx.fill();

  netCtx.beginPath();
  netCtx.strokeStyle = '#0ea5e9';
  netCtx.lineWidth   = 2;
  netHistory.forEach((v, i) => {
    const x = i * step, y = h - (v / max) * h * 0.85;
    i === 0 ? netCtx.moveTo(x, y) : netCtx.lineTo(x, y);
  });
  netCtx.stroke();
}

// ── Live data update ──────────────────────────────────────────────────
function updateData() {
  // CPU
  const cpu = Math.floor(25 + Math.random() * 50);
  cpuHistory.shift(); cpuHistory.push(cpu);
  document.getElementById('cpuValue').textContent = cpu + '%';
  const cpuBar = document.getElementById('cpuBar');
  cpuBar.style.width = cpu + '%';
  cpuBar.className   = 'progress-fill ' + (cpu > 75 ? 'red' : cpu > 50 ? 'orange' : 'green');
  document.getElementById('cpuValue').className =
    'card-value ' + (cpu > 75 ? 'danger' : cpu > 50 ? 'warning' : 'success');

  // Memory
  const mem = (5 + Math.random() * 4).toFixed(1);
  document.getElementById('memValue').textContent = mem + ' GB';
  document.getElementById('memBar').style.width   = ((+mem / 16) * 100).toFixed(0) + '%';

  // Network
  const net = (0.5 + Math.random() * 4).toFixed(1);
  document.getElementById('netValue').textContent = net + ' MB/s';
  netHistory.shift(); netHistory.push(+net);

  drawCpuChart();
  drawNetChart();
}

setInterval(updateData, 1000);
