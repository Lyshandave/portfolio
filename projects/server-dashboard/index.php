<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="description" content="Real-time Server Monitoring Dashboard">
  <meta name="robots" content="noindex">
  <title>Server Monitor | Lyshan Dave</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <h1><i class="fas fa-server" aria-hidden="true"></i> Server Monitor Dashboard</h1>
    <a href="../../#projects" class="back-btn"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back</a>
  </header>

  <main class="dashboard">
    <!-- CPU -->
    <div class="card">
      <div class="card-header">
        <div>
          <p class="card-title">CPU Usage</p>
          <p class="card-value warning" id="cpuValue">42%</p>
        </div>
        <div class="card-icon orange" aria-hidden="true"><i class="fas fa-microchip"></i></div>
      </div>
      <div class="progress-bar" role="progressbar" aria-valuenow="42" aria-valuemin="0" aria-valuemax="100" aria-label="CPU Usage">
        <div class="progress-fill orange" id="cpuBar" style="width:42%"></div>
      </div>
      <div class="stats-row">
        <div class="stat-box"><h5>Cores</h5><p>8</p></div>
        <div class="stat-box"><h5>Threads</h5><p>16</p></div>
        <div class="stat-box"><h5>Temp</h5><p style="color:#22c55e">45°C</p></div>
      </div>
    </div>

    <!-- Memory -->
    <div class="card">
      <div class="card-header">
        <div>
          <p class="card-title">Memory Usage</p>
          <p class="card-value success" id="memValue">6.2 GB</p>
        </div>
        <div class="card-icon green" aria-hidden="true"><i class="fas fa-memory"></i></div>
      </div>
      <div class="progress-bar" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100" aria-label="Memory Usage">
        <div class="progress-fill green" id="memBar" style="width:38%"></div>
      </div>
      <p style="margin-top:10px;color:#94a3b8;font-size:0.88rem">of 16 GB Total</p>
      <div class="stats-row">
        <div class="stat-box"><h5>Cached</h5><p>2.1 GB</p></div>
        <div class="stat-box"><h5>Free</h5><p>9.8 GB</p></div>
      </div>
    </div>

    <!-- Disk -->
    <div class="card">
      <div class="card-header">
        <div>
          <p class="card-title">Disk Usage</p>
          <p class="card-value danger">78%</p>
        </div>
        <div class="card-icon red" aria-hidden="true"><i class="fas fa-hdd"></i></div>
      </div>
      <div class="progress-bar" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" aria-label="Disk Usage">
        <div class="progress-fill red" style="width:78%"></div>
      </div>
      <p style="margin-top:10px;color:#94a3b8;font-size:0.88rem">390 GB of 500 GB Used</p>
      <div class="stats-row">
        <div class="stat-box"><h5>Read</h5><p>125 MB/s</p></div>
        <div class="stat-box"><h5>Write</h5><p>89 MB/s</p></div>
      </div>
    </div>

    <!-- Network -->
    <div class="card">
      <div class="card-header">
        <div>
          <p class="card-title">Network Traffic</p>
          <p class="card-value success" id="netValue">2.4 MB/s</p>
        </div>
        <div class="card-icon blue" aria-hidden="true"><i class="fas fa-network-wired"></i></div>
      </div>
      <div class="chart-container"><canvas id="netChart" aria-label="Network traffic chart"></canvas></div>
      <div class="stats-row">
        <div class="stat-box"><h5>Download</h5><p style="color:#22c55e">&#8595; 1.8 MB/s</p></div>
        <div class="stat-box"><h5>Upload</h5><p style="color:#0ea5e9">&#8593; 0.6 MB/s</p></div>
      </div>
    </div>

    <!-- CPU History chart -->
    <div class="card full-width">
      <div class="card-header">
        <p class="card-title"><i class="fas fa-chart-line" aria-hidden="true"></i> CPU Usage History</p>
      </div>
      <div class="chart-container" style="height:240px"><canvas id="cpuChart" aria-label="CPU usage history chart"></canvas></div>
    </div>

    <!-- Services -->
    <div class="card">
      <div class="card-header">
        <p class="card-title"><i class="fas fa-cogs" aria-hidden="true"></i> Services</p>
      </div>
      <div class="services-grid">
        <?php
        $services = [
          ['Apache','Running &bull; PID: 1245'],
          ['MySQL', 'Running &bull; PID: 1289'],
          ['SSH',   'Running &bull; PID: 1102'],
          ['Docker','Running &bull; 4 containers'],
          ['Nginx', 'Running &bull; PID: 1356'],
          ['Redis', 'Running &bull; PID: 1423'],
        ];
        foreach ($services as [$name, $info]):
        ?>
        <div class="service-item">
          <div class="service-status online" aria-label="Online"></div>
          <div class="service-info">
            <h4><?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8') ?></h4>
            <p><?= $info ?></p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <!-- Uptime -->
    <div class="card">
      <div class="card-header">
        <p class="card-title"><i class="fas fa-clock" aria-hidden="true"></i> Uptime</p>
      </div>
      <p class="uptime-value">45</p>
      <p class="uptime-label">days &mdash; Last reboot: March 1, 2024</p>
      <div class="stats-row">
        <div class="stat-box"><h5>Load Avg</h5><p>0.45</p></div>
        <div class="stat-box"><h5>Processes</h5><p>142</p></div>
        <div class="stat-box"><h5>Users</h5><p>3</p></div>
      </div>
    </div>
  </main>

  <script src="main.js"></script>
</body>
</html>
