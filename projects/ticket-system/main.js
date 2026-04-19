/* IT Ticket System — main.js */
'use strict';

// ── Data ──────────────────────────────────────────────────────────────
const ASSIGNEES = {
  LT: 'Lyshan T.',
  MT: 'Mike T.',
  AJ: 'Alex J.',
};

let tickets = [
  { id: '#2045', title: 'VPN Connection Failed',       desc: 'Cannot connect to company VPN from home office',     requester: 'john.doe',    priority: 'high',   status: 'open',        assigned: 'LT' },
  { id: '#2044', title: 'Printer Not Responding',      desc: 'HP LaserJet 4050 showing offline status',            requester: 'sarah.smith', priority: 'medium', status: 'in-progress', assigned: 'MT' },
  { id: '#2043', title: 'Email Sync Issues',           desc: 'Outlook not syncing with Exchange server',           requester: 'mike.jones',  priority: 'medium', status: 'open',        assigned: 'LT' },
  { id: '#2042', title: 'Software Installation',       desc: 'Need Adobe Creative Suite installed',                requester: 'emma.wilson', priority: 'low',    status: 'in-progress', assigned: 'AJ' },
  { id: '#2041', title: 'Laptop Screen Flickering',    desc: 'Dell Latitude screen flickers intermittently',       requester: 'david.brown', priority: 'high',   status: 'open',        assigned: 'LT' },
  { id: '#2040', title: 'Password Reset',              desc: 'Forgot Windows domain password',                     requester: 'lisa.davis',  priority: 'low',    status: 'resolved',    assigned: 'MT' },
  { id: '#2039', title: 'Network Drive Access',        desc: 'Cannot access shared network drive S:',              requester: 'tom.miller',  priority: 'medium', status: 'in-progress', assigned: 'AJ' },
  { id: '#2038', title: 'Slow Computer Performance',   desc: 'System running very slow, needs optimisation',       requester: 'amy.taylor',  priority: 'low',    status: 'open',        assigned: 'MT' },
];

let nextId = 2046;

// ── Render ────────────────────────────────────────────────────────────
function renderTickets(list) {
  list = list || tickets;
  const container = document.getElementById('ticketContainer');
  if (!list.length) {
    container.innerHTML = '<div style="padding:30px;text-align:center;color:#64748b">No tickets found.</div>';
    return;
  }
  container.innerHTML = list.map(t => `
    <div class="ticket-item">
      <div class="ticket-id">${t.id}</div>
      <div>
        <div class="ticket-title">${escHtml(t.title)}</div>
        <div class="ticket-desc">${escHtml(t.desc)}</div>
      </div>
      <div>${escHtml(t.requester)}</div>
      <div><span class="priority ${t.priority}">${t.priority}</span></div>
      <div><span class="status ${t.status}">${t.status.replace('-', ' ')}</span></div>
      <div class="assignee">
        <div class="avatar">${t.assigned}</div>
        <span>${ASSIGNEES[t.assigned] || t.assigned}</span>
      </div>
    </div>
  `).join('');
}

function updateStats() {
  document.getElementById('openCount').textContent     = tickets.filter(t => t.status === 'open').length;
  document.getElementById('progressCount').textContent = tickets.filter(t => t.status === 'in-progress').length;
  document.getElementById('resolvedCount').textContent = tickets.filter(t => t.status === 'resolved').length;
  document.getElementById('highCount').textContent     = tickets.filter(t => t.priority === 'high').length;
}

// ── Filter / Sort ─────────────────────────────────────────────────────
let activeFilter = 'all';
let activeSort   = 'id-desc';

function applyFilter(filter) {
  activeFilter = filter;
  // Update button states
  document.querySelectorAll('.filter-btn').forEach(b => {
    b.classList.toggle('btn-primary',   b.dataset.filter === filter);
    b.classList.toggle('btn-secondary', b.dataset.filter !== filter);
  });
  applyAll();
}

function applySort(sort) {
  activeSort = sort;
  applyAll();
}

function applyAll() {
  let list = [...tickets];
  if (activeFilter !== 'all') {
    list = list.filter(t =>
      t.status   === activeFilter ||
      t.priority === activeFilter
    );
  }
  if (activeSort === 'id-asc')        list.sort((a,b) => a.id.localeCompare(b.id));
  else if (activeSort === 'id-desc')  list.sort((a,b) => b.id.localeCompare(a.id));
  else if (activeSort === 'priority') {
    const order = { high: 0, medium: 1, low: 2 };
    list.sort((a,b) => (order[a.priority]||3) - (order[b.priority]||3));
  }
  renderTickets(list);
}

// ── Modal ─────────────────────────────────────────────────────────────
function openModal() {
  document.getElementById('newTicketModal').classList.add('active');
  document.getElementById('ticketTitle').focus();
}
function closeModal() {
  document.getElementById('newTicketModal').classList.remove('active');
  document.getElementById('ticketForm').reset();
}

function createTicket(e) {
  e.preventDefault();
  const form = e.target;
  tickets.unshift({
    id:       '#' + nextId++,
    title:    form.title.value.trim(),
    desc:     form.description.value.trim(),
    requester:'guest',
    priority: form.priority.value,
    status:   'open',
    assigned: 'LT',
  });
  updateStats();
  applyAll();
  closeModal();
}

// Click-outside to close modal
document.getElementById('newTicketModal').addEventListener('click', e => {
  if (e.target === e.currentTarget) closeModal();
});
// Escape key
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModal(); });

// ── Utility ───────────────────────────────────────────────────────────
function escHtml(str) {
  return String(str)
    .replace(/&/g,'&amp;').replace(/</g,'&lt;')
    .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}

// ── Init ──────────────────────────────────────────────────────────────
updateStats();
applyAll();
