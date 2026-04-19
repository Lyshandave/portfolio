<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
  <meta name="description" content="IT Support Ticket Management System">
  <meta name="robots" content="noindex">
  <title>IT Ticket System | Lyshan Dave</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="header">
    <h1><i class="fas fa-headset" aria-hidden="true"></i> IT Support Ticket System</h1>
    <a href="../../#projects" class="back-btn"><i class="fas fa-arrow-left" aria-hidden="true"></i> Back</a>
  </header>

  <div class="container">

    <!-- Stats -->
    <div class="stats-bar" role="region" aria-label="Ticket Statistics">
      <div class="stat-card open">
        <h3><i class="fas fa-folder-open" aria-hidden="true"></i> Open</h3>
        <p class="number" id="openCount">0</p>
      </div>
      <div class="stat-card pending">
        <h3><i class="fas fa-clock" aria-hidden="true"></i> In Progress</h3>
        <p class="number" id="progressCount">0</p>
      </div>
      <div class="stat-card resolved">
        <h3><i class="fas fa-check-circle" aria-hidden="true"></i> Resolved</h3>
        <p class="number" id="resolvedCount">0</p>
      </div>
      <div class="stat-card high">
        <h3><i class="fas fa-exclamation-triangle" aria-hidden="true"></i> High Priority</h3>
        <p class="number" id="highCount">0</p>
      </div>
    </div>

    <!-- Actions -->
    <div class="actions">
      <button class="btn btn-primary" onclick="openModal()">
        <i class="fas fa-plus" aria-hidden="true"></i> New Ticket
      </button>
      <button class="btn btn-secondary filter-btn" data-filter="all" onclick="applyFilter('all')">All</button>
      <button class="btn btn-secondary filter-btn" data-filter="open" onclick="applyFilter('open')">Open</button>
      <button class="btn btn-secondary filter-btn" data-filter="in-progress" onclick="applyFilter('in-progress')">In Progress</button>
      <button class="btn btn-secondary filter-btn" data-filter="high" onclick="applyFilter('high')">High Priority</button>
      <select class="btn btn-secondary" onchange="applySort(this.value)" aria-label="Sort tickets" style="cursor:pointer">
        <option value="id-desc">Newest First</option>
        <option value="id-asc">Oldest First</option>
        <option value="priority">By Priority</option>
      </select>
    </div>

    <!-- Ticket table -->
    <div class="ticket-list" role="table" aria-label="Tickets">
      <div class="ticket-header" role="row">
        <div>ID</div>
        <div>Title</div>
        <div>Requester</div>
        <div>Priority</div>
        <div>Status</div>
        <div>Assigned</div>
      </div>
      <div id="ticketContainer" role="rowgroup"></div>
    </div>
  </div>

  <!-- New Ticket Modal -->
  <div class="modal" id="newTicketModal" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="modal-content">
      <div class="modal-header">
        <h2 id="modalTitle"><i class="fas fa-ticket-alt" aria-hidden="true"></i> New Ticket</h2>
        <button class="close-btn" onclick="closeModal()" aria-label="Close">&times;</button>
      </div>
      <form id="ticketForm" onsubmit="createTicket(event)">
        <div class="form-group">
          <label for="ticketTitle">Title <span aria-hidden="true">*</span></label>
          <input type="text" id="ticketTitle" name="title" placeholder="Brief description of the issue" required maxlength="120">
        </div>
        <div class="form-group">
          <label for="ticketDesc">Description <span aria-hidden="true">*</span></label>
          <textarea id="ticketDesc" name="description" placeholder="Detailed description…" required maxlength="500"></textarea>
        </div>
        <div class="form-group">
          <label for="ticketPriority">Priority</label>
          <select id="ticketPriority" name="priority">
            <option value="low">Low</option>
            <option value="medium" selected>Medium</option>
            <option value="high">High</option>
          </select>
        </div>
        <div class="form-group">
          <label for="ticketCategory">Category</label>
          <select id="ticketCategory" name="category">
            <option value="hardware">Hardware</option>
            <option value="software">Software</option>
            <option value="network">Network</option>
            <option value="other">Other</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center">
          <i class="fas fa-paper-plane" aria-hidden="true"></i> Create Ticket
        </button>
      </form>
    </div>
  </div>

  <script src="main.js"></script>
</body>
</html>
