<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>Patient Clinical Records</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style id="colStyle"></style>
<style>
/* ── Reset ───────────────────────────────────────────── */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:15px;-webkit-text-size-adjust:100%}
body{font-family:'Inter',system-ui,sans-serif;background:#f0f4f8;color:#1e2a3b;min-height:100vh}

/* ── Variables ───────────────────────────────────────── */
:root{
  --blue:#2563eb;--blue-d:#1d4ed8;--blue-l:#eff6ff;
  --red:#dc2626;--red-l:#fef2f2;
  --green:#16a34a;--green-l:#f0fdf4;
  --navy:#1e3a5f;
  --gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;
  --gray-300:#cbd5e1;--gray-400:#94a3b8;--gray-500:#64748b;
  --gray-600:#475569;--gray-700:#334155;--gray-800:#1e293b;
  --r:10px;
  --sh:0 1px 3px rgba(0,0,0,.08),0 1px 2px rgba(0,0,0,.05);
  --sh-md:0 4px 6px -1px rgba(0,0,0,.08),0 2px 4px -1px rgba(0,0,0,.05);
  --sh-lg:0 10px 25px -3px rgba(0,0,0,.12),0 4px 6px -2px rgba(0,0,0,.06);
}

/* ── Header ──────────────────────────────────────────── */
.app-header{
  background:linear-gradient(135deg,var(--navy) 0%,var(--blue) 100%);
  color:#fff;padding:0 1.5rem;height:64px;
  display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:100;
  box-shadow:0 2px 12px rgba(37,99,235,.4);
}
.app-header h1{font-size:1.1rem;font-weight:700;letter-spacing:-.2px;display:flex;align-items:center;gap:.5rem}
.hd-sub{font-weight:400;opacity:.6;font-size:.8rem}

/* ── Main ────────────────────────────────────────────── */
.main-wrap{max-width:1700px;margin:0 auto;padding:1.5rem 1rem 3rem}
.card{background:#fff;border-radius:var(--r);box-shadow:var(--sh-md);overflow:hidden}

/* ── Toolbar ─────────────────────────────────────────── */
.toolbar{
  display:flex;flex-wrap:wrap;gap:.65rem;align-items:center;
  padding:.9rem 1.1rem;border-bottom:1px solid var(--gray-200);background:var(--gray-50);
}
.search-wrap{position:relative;flex:1;min-width:200px}
.search-wrap svg{position:absolute;left:.7rem;top:50%;transform:translateY(-50%);color:var(--gray-400);pointer-events:none}
.search-input{
  width:100%;padding:.5rem .7rem .5rem 2.2rem;
  border:1px solid var(--gray-300);border-radius:8px;
  font-size:.85rem;font-family:inherit;background:#fff;
  transition:border-color .2s,box-shadow .2s;
}
.search-input:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px rgba(37,99,235,.12)}
.search-input::placeholder{color:var(--gray-400)}

.toolbar-right{display:flex;align-items:center;gap:.6rem;flex-wrap:wrap}
.per-page-wrap{display:flex;align-items:center;gap:.4rem;font-size:.8rem;color:var(--gray-600)}
.per-page-select{
  padding:.38rem .6rem;border:1px solid var(--gray-300);border-radius:7px;
  font-size:.8rem;font-family:inherit;background:#fff;cursor:pointer;
}
.per-page-select:focus{outline:none;border-color:var(--blue)}
.rec-count{font-size:.78rem;color:var(--gray-400);white-space:nowrap}

/* ── Buttons ─────────────────────────────────────────── */
.btn{
  display:inline-flex;align-items:center;gap:.4rem;
  padding:.48rem 1rem;border-radius:8px;font-size:.83rem;font-weight:600;
  font-family:inherit;cursor:pointer;border:none;transition:all .18s;white-space:nowrap;
}
.btn-primary{background:var(--blue);color:#fff}
.btn-primary:hover{background:var(--blue-d);box-shadow:var(--sh-md)}
.btn-danger{background:var(--red);color:#fff}
.btn-danger:hover{background:#b91c1c}
.btn-ghost{background:transparent;color:var(--gray-600);border:1px solid var(--gray-300)}
.btn-ghost:hover{background:var(--gray-100);color:var(--gray-800)}

/* ── Column visibility toggle ────────────────────────── */
.col-toggle-wrap{position:relative}
.col-btn{position:relative}
.col-hidden-badge{
  position:absolute;top:-5px;right:-5px;
  background:var(--red);color:#fff;
  width:17px;height:17px;border-radius:50%;
  font-size:.62rem;font-weight:700;
  display:none;align-items:center;justify-content:center;
  line-height:1;
}
.col-panel{
  position:absolute;top:calc(100% + 8px);right:0;
  width:310px;
  background:#fff;border:1px solid var(--gray-200);
  border-radius:12px;box-shadow:var(--sh-lg);
  z-index:200;display:none;
  animation:panelIn .15s ease;
}
@keyframes panelIn{from{opacity:0;transform:translateY(-6px)}to{opacity:1;transform:none}}
.col-panel.open{display:block}
.col-panel-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:.7rem 1rem;border-bottom:1px solid var(--gray-200);
  position:sticky;top:0;background:#fff;border-radius:12px 12px 0 0;z-index:1;
}
.col-panel-head span{font-size:.8rem;font-weight:700;color:var(--gray-700)}
.col-reset{
  font-size:.72rem;color:var(--blue);background:none;border:none;
  cursor:pointer;font-family:inherit;font-weight:600;padding:.2rem .4rem;
  border-radius:4px;transition:background .15s;
}
.col-reset:hover{background:var(--blue-l)}
.col-panel-scroll{
  max-height:270px;overflow-y:auto;
  scrollbar-width:thin;scrollbar-color:var(--gray-300) transparent;
}
.col-panel-scroll::-webkit-scrollbar{width:5px}
.col-panel-scroll::-webkit-scrollbar-track{background:transparent}
.col-panel-scroll::-webkit-scrollbar-thumb{background:var(--gray-300);border-radius:99px}
.col-panel-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:2px;padding:.5rem .6rem .7rem;
}
.col-item{
  display:flex;align-items:center;gap:.4rem;
  padding:.38rem .55rem;border-radius:6px;cursor:pointer;
  font-size:.78rem;color:var(--gray-700);user-select:none;transition:background .12s;
}
.col-item:hover{background:var(--gray-100)}
.col-item input[type=checkbox]{accent-color:var(--blue);cursor:pointer;width:13px;height:13px;flex-shrink:0}
.col-item.locked{opacity:.45;cursor:not-allowed;pointer-events:none}

/* ── Table ───────────────────────────────────────────── */
.table-wrap{
  overflow-x:auto;overflow-y:auto;
  max-height:calc(100vh - 240px);
  -webkit-overflow-scrolling:touch;
}
table{width:100%;border-collapse:collapse;font-size:.82rem}
thead th{
  background:var(--navy);color:#cfe0ff;
  font-weight:600;font-size:.72rem;letter-spacing:.4px;text-transform:uppercase;
  padding:.7rem .85rem;white-space:nowrap;text-align:left;
  border-right:1px solid rgba(255,255,255,.06);
  position:sticky;top:0;z-index:10;
}
thead th:last-child{border-right:none}
tbody tr{border-bottom:1px solid var(--gray-100);transition:background .1s}
tbody tr:hover{background:var(--blue-l)}
tbody td{
  padding:.65rem .85rem;vertical-align:middle;color:var(--gray-700);
  max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
}
tbody td.td-wide{max-width:220px}
tbody td.td-act{max-width:none;white-space:nowrap;padding:.5rem .7rem}

/* ── PDF Modal ───────────────────────────────────────── */
.pdf-modal{max-width:460px}
.pdf-modal .modal-body{padding:1.5rem}
.pdf-section{margin-bottom:1.2rem}
.pdf-section-label{
  font-size:.72rem;font-weight:700;text-transform:uppercase;letter-spacing:.5px;
  color:var(--gray-500);margin-bottom:.6rem;display:block;
}
.option-group{display:flex;gap:.5rem;flex-wrap:wrap}
.opt-btn{
  padding:.42rem .9rem;border-radius:7px;
  font-size:.82rem;font-weight:600;cursor:pointer;
  border:2px solid var(--gray-200);background:#fff;
  color:var(--gray-600);font-family:inherit;transition:all .15s;
}
.opt-btn:hover{border-color:var(--blue);color:var(--blue)}
.opt-btn.sel{border-color:var(--blue);background:var(--blue);color:#fff}
.uid-found{color:#16a34a;font-weight:600}
.uid-new{color:#64748b}
.uid-checking{color:#2563eb}
.uid-prefilled{
  background:#f0fdf4;border:1px solid #bbf7d0;border-radius:6px;
  padding:.45rem .75rem;margin-top:.5rem;font-size:.78rem;color:#15803d;
  display:flex;align-items:center;gap:.4rem;
  grid-column:1/-1;
}
.pdf-info{
  background:var(--blue-l);border:1px solid #bfdbfe;border-radius:8px;
  padding:.65rem 1rem;font-size:.8rem;color:var(--blue);
  display:flex;align-items:center;gap:.5rem;margin-top:.5rem;
}

/* Badges */
.uid-badge{
  display:inline-flex;align-items:center;
  background:var(--blue-l);color:var(--blue);
  font-weight:700;font-size:.78rem;padding:.18rem .55rem;border-radius:5px;letter-spacing:.5px;
}
.visit-badge{
  display:inline-flex;align-items:center;justify-content:center;
  width:24px;height:24px;background:var(--gray-100);
  color:var(--gray-600);font-weight:600;font-size:.72rem;border-radius:50%;
}
.g-badge{
  display:inline-block;padding:.18rem .5rem;border-radius:5px;
  font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.4px;
}
.g-m{background:#dbeafe;color:#1d4ed8}
.g-f{background:#fce7f3;color:#9d174d}
.g-o{background:#f3e8ff;color:#6b21a8}

/* Action buttons */
.act-btn{
  display:inline-flex;align-items:center;gap:.28rem;
  padding:.3rem .65rem;border-radius:6px;
  font-size:.74rem;font-weight:600;cursor:pointer;border:none;font-family:inherit;
  transition:all .14s;margin-right:.25rem;
}
.act-edit{background:#eff6ff;color:var(--blue)}
.act-edit:hover{background:var(--blue);color:#fff}
.act-del{background:var(--red-l);color:var(--red)}
.act-del:hover{background:var(--red);color:#fff}

/* ── Empty / Loading ─────────────────────────────────── */
.tbl-empty{text-align:center;padding:3.5rem 1rem;color:var(--gray-400)}
.tbl-empty svg{display:block;margin:0 auto .75rem;opacity:.3}
.spinner{
  display:inline-block;width:24px;height:24px;
  border:3px solid var(--gray-200);border-top-color:var(--blue);
  border-radius:50%;animation:spin .55s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}

/* ── Footer ──────────────────────────────────────────── */
.tbl-footer{
  display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.7rem;
  padding:.8rem 1.1rem;border-top:1px solid var(--gray-200);background:var(--gray-50);
  font-size:.79rem;color:var(--gray-500);
}
.pagination{display:flex;gap:.3rem;flex-wrap:wrap}
.pg-btn{
  min-width:32px;height:32px;padding:0 .5rem;
  display:flex;align-items:center;justify-content:center;
  border:1px solid var(--gray-200);border-radius:7px;background:#fff;
  color:var(--gray-600);font-size:.78rem;font-weight:500;cursor:pointer;transition:all .14s;
}
.pg-btn:hover:not(:disabled){border-color:var(--blue);color:var(--blue);background:var(--blue-l)}
.pg-btn.active{background:var(--blue);color:#fff;border-color:var(--blue)}
.pg-btn:disabled{opacity:.35;cursor:not-allowed}

/* ── Modal ───────────────────────────────────────────── */
.overlay{
  position:fixed;inset:0;z-index:300;
  background:rgba(15,23,42,.55);
  display:flex;align-items:flex-start;justify-content:center;
  padding:1.5rem 1rem 2rem;overflow-y:auto;
  opacity:0;pointer-events:none;transition:opacity .2s;
}
.overlay.open{opacity:1;pointer-events:all}
.modal{
  background:#fff;border-radius:14px;box-shadow:var(--sh-lg);
  width:100%;max-width:880px;
  transform:translateY(18px);transition:transform .22s;
}
.overlay.open .modal{transform:translateY(0)}
.modal-hdr{
  display:flex;align-items:center;justify-content:space-between;
  padding:1rem 1.4rem;border-bottom:1px solid var(--gray-200);
  background:linear-gradient(135deg,var(--navy) 0%,var(--blue) 100%);
  border-radius:14px 14px 0 0;
}
.modal-hdr h2{color:#fff;font-size:.95rem;font-weight:700;display:flex;align-items:center;gap:.45rem}
.modal-x{
  background:rgba(255,255,255,.2);border:none;color:#fff;
  width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;
  cursor:pointer;font-size:.95rem;transition:background .14s;
}
.modal-x:hover{background:rgba(255,255,255,.35)}
.modal-body{padding:1.4rem}
.modal-foot{
  display:flex;justify-content:flex-end;gap:.65rem;
  padding:.9rem 1.4rem;border-top:1px solid var(--gray-200);
  background:var(--gray-50);border-radius:0 0 14px 14px;
}

/* ── Form ────────────────────────────────────────────── */
.fsec{margin-bottom:1.2rem}
.fsec-title{
  font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.6px;
  color:var(--blue);margin-bottom:.7rem;padding-bottom:.35rem;
  border-bottom:2px solid var(--blue-l);
}
.fgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(175px,1fr));gap:.75rem}
.fgrid-2{grid-template-columns:1fr 1fr}
.fg{display:flex;flex-direction:column;gap:.3rem}
.fg label{font-size:.74rem;font-weight:600;color:var(--gray-600)}
.fg label .req{color:var(--red);margin-left:2px}
.fc{
  padding:.48rem .65rem;border:1px solid var(--gray-300);border-radius:7px;
  font-size:.84rem;font-family:inherit;background:#fff;width:100%;
  transition:border-color .2s,box-shadow .2s;
}
.fc:focus{outline:none;border-color:var(--blue);box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.fc.invalid{border-color:var(--red)!important;box-shadow:0 0 0 3px rgba(220,38,38,.1)}
textarea.fc{resize:vertical;min-height:68px}

/* ── Confirm modal ───────────────────────────────────── */
.conf-modal{max-width:400px}
.conf-modal .modal-body{text-align:center;padding:2rem 1.5rem}
.conf-modal .modal-body svg{color:var(--red);margin:0 auto .75rem;display:block}
.conf-modal h3{font-size:1rem;font-weight:700;margin-bottom:.4rem}
.conf-modal p{font-size:.84rem;color:var(--gray-500)}

/* ── Toast ───────────────────────────────────────────── */
#toasts{position:fixed;bottom:1.5rem;right:1.5rem;display:flex;flex-direction:column;gap:.45rem;z-index:500}
.toast{
  display:flex;align-items:center;gap:.55rem;
  padding:.7rem 1rem;border-radius:9px;box-shadow:var(--sh-lg);
  font-size:.82rem;font-weight:500;min-width:230px;max-width:320px;color:#fff;
  animation:toastIn .22s ease;
}
.toast.success{background:var(--green)}
.toast.error{background:var(--red)}
.toast.info{background:var(--blue)}
@keyframes toastIn{from{opacity:0;transform:translateX(50px)}to{opacity:1;transform:none}}

/* ── Responsive ──────────────────────────────────────── */
@media(max-width:640px){
  .hd-sub{display:none}
  .toolbar{flex-direction:column;align-items:stretch}
  .toolbar-right{justify-content:space-between}
  .fgrid{grid-template-columns:1fr 1fr}
  .fgrid-2{grid-template-columns:1fr}
  .modal-body{padding:.9rem}
  .col-panel{right:-60px;width:270px}
}
@media(max-width:380px){
  .fgrid{grid-template-columns:1fr}
  .btn span{display:none}
}
</style>
</head>
<body>

<!-- ── Header ───────────────────────────────────────────────── -->
<header class="app-header">
  <h1>
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
    Patient Clinical Records
    <span class="hd-sub">| Management System</span>
  </h1>
  <button class="btn btn-primary" onclick="openAddModal()">
    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
    <span>Add Record</span>
  </button>
</header>

<!-- ── Main ─────────────────────────────────────────────────── -->
<main class="main-wrap">
<div class="card">

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="search-wrap">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input class="search-input" id="searchInput" type="search"
        placeholder="Search name, unique ID (shows all visits), phone, symptoms…" autocomplete="off">
    </div>
    <div class="toolbar-right">
      <!-- Column visibility -->
      <div class="col-toggle-wrap" id="colToggleWrap">
        <button class="btn btn-ghost col-btn" id="colsBtn" onclick="toggleColPanel()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
          <span>Columns</span>
          <span class="col-hidden-badge" id="colHiddenBadge"></span>
        </button>
        <div class="col-panel" id="colPanel">
          <div class="col-panel-head">
            <span>Show / Hide Columns</span>
            <button class="col-reset" onclick="resetCols()">Reset All</button>
          </div>
          <div class="col-panel-scroll">
            <div class="col-panel-grid" id="colPanelGrid"></div>
          </div>
        </div>
      </div>

      <div class="per-page-wrap">
        <label for="perPage">Show:</label>
        <select class="per-page-select" id="perPage">
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="0">All</option>
        </select>
      </div>
      <span class="rec-count" id="recCount"></span>

      <!-- Download PDF -->
      <button class="btn btn-ghost" onclick="openPdfModal()" style="color:#dc2626;border-color:#fca5a5">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
        <span>Download PDF</span>
      </button>
    </div>
  </div>

  <!-- Table -->
  <div class="table-wrap">
    <table id="mainTable">
      <thead>
        <tr>
          <th class="col-num">#</th>
          <th class="col-uid">Unique ID</th>
          <th class="col-date">Date</th>
          <th class="col-time">Time</th>
          <th class="col-visit">Visit</th>
          <th class="col-name">Name</th>
          <th class="col-parentage">Parentage</th>
          <th class="col-age">Age</th>
          <th class="col-gender">Gender</th>
          <th class="col-weight">Weight</th>
          <th class="col-phone">Phone</th>
          <th class="col-address">Address</th>
          <th class="col-allergy">Allergy</th>
          <th class="col-symptoms">Symptoms / History</th>
          <th class="col-findings">Findings</th>
          <th class="col-treatment">Treatment</th>
          <th class="col-actions">Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody">
        <tr><td colspan="17" class="tbl-empty"><div class="spinner"></div></td></tr>
      </tbody>
    </table>
  </div>

  <!-- Footer -->
  <div class="tbl-footer">
    <div id="pageInfo">Loading…</div>
    <div class="pagination" id="pagination"></div>
  </div>
</div>
</main>

<!-- ════════════════════════════════════════════════════
     ADD / EDIT MODAL
════════════════════════════════════════════════════ -->
<div class="overlay" id="formOverlay">
<div class="modal">
  <div class="modal-hdr">
    <h2 id="modalTitle">
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      Add New Record
    </h2>
    <button class="modal-x" onclick="closeModal('formOverlay')">✕</button>
  </div>
  <div class="modal-body">
    <form id="recordForm" novalidate>
      <input type="hidden" id="fId">

      <div class="fsec">
        <div class="fsec-title">Patient Identity</div>
        <div class="fgrid">
          <div class="fg">
            <label>Unique ID <span class="req">*</span></label>
            <input class="fc" id="fUid" placeholder="Auto…" maxlength="10" autocomplete="off">
            <span id="uidStatus" style="font-size:.72rem;margin-top:2px;display:none"></span>
          </div>
          <div class="fg">
            <label>Name <span class="req">*</span></label>
            <input class="fc" id="fName" placeholder="Full name">
          </div>
          <div class="fg">
            <label>Parentage / Guardian</label>
            <input class="fc" id="fParentage" placeholder="Father / guardian name">
          </div>
          <div class="fg">
            <label>Age</label>
            <input class="fc" id="fAge" type="number" min="0" max="150" placeholder="Years">
          </div>
          <div class="fg">
            <label>Gender</label>
            <select class="fc" id="fGender">
              <option value="">— Select —</option>
              <option>Male</option><option>Female</option><option>Other</option>
            </select>
          </div>
          <div class="fg">
            <label>Weight (kg)</label>
            <input class="fc" id="fWeight" type="number" step="0.1" min="0" placeholder="e.g. 65.5">
          </div>
        </div>
      </div>

      <div class="fsec">
        <div class="fsec-title">Contact</div>
        <div class="fgrid fgrid-2">
          <div class="fg">
            <label>Phone</label>
            <input class="fc" id="fPhone" placeholder="+92 300 0000000">
          </div>
          <div class="fg">
            <label>Address</label>
            <input class="fc" id="fAddress" placeholder="Street, city">
          </div>
        </div>
      </div>

      <div class="fsec">
        <div class="fsec-title">Visit Details</div>
        <div class="fgrid">
          <div class="fg">
            <label>Date <span class="req">*</span></label>
            <input class="fc" id="fDate" type="date">
          </div>
          <div class="fg">
            <label>Time</label>
            <input class="fc" id="fTime" type="time">
          </div>
          <div class="fg">
            <label>Visit #</label>
            <input class="fc" id="fVisit" type="number" min="1" placeholder="Auto">
          </div>
          <div class="fg">
            <label>Allergy</label>
            <input class="fc" id="fAllergy" placeholder="Known allergies">
          </div>
        </div>
      </div>

      <div class="fsec">
        <div class="fsec-title">Clinical Notes</div>
        <div class="fgrid fgrid-2">
          <div class="fg">
            <label>Symptoms / History / Condition</label>
            <textarea class="fc" id="fSymptoms" rows="3" placeholder="Describe symptoms…"></textarea>
          </div>
          <div class="fg">
            <label>Findings</label>
            <textarea class="fc" id="fFindings" rows="3" placeholder="Clinical findings…"></textarea>
          </div>
          <div class="fg" style="grid-column:1/-1">
            <label>Treatment</label>
            <textarea class="fc" id="fTreatment" rows="3" placeholder="Prescribed treatment / medication…"></textarea>
          </div>
        </div>
      </div>
    </form>
  </div>
  <div class="modal-foot">
    <button class="btn btn-ghost" onclick="closeModal('formOverlay')">Cancel</button>
    <button class="btn btn-primary" id="saveBtn" onclick="submitForm()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
      Save Record
    </button>
  </div>
</div>
</div>

<!-- ════════════════════════════════════════════════════
     DELETE CONFIRM MODAL
════════════════════════════════════════════════════ -->
<div class="overlay" id="delOverlay">
<div class="modal conf-modal">
  <div class="modal-hdr">
    <h2>
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
      Delete Record
    </h2>
    <button class="modal-x" onclick="closeModal('delOverlay')">✕</button>
  </div>
  <div class="modal-body">
    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    <h3>Are you sure?</h3>
    <p>This will permanently delete the record for <strong id="delName"></strong>. This cannot be undone.</p>
  </div>
  <div class="modal-foot">
    <button class="btn btn-ghost" onclick="closeModal('delOverlay')">Cancel</button>
    <button class="btn btn-danger" onclick="confirmDelete()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
      Delete
    </button>
  </div>
</div>
</div>

<!-- ════════════════════════════════════════════════════
     PDF DOWNLOAD MODAL
════════════════════════════════════════════════════ -->
<div class="overlay" id="pdfOverlay">
<div class="modal pdf-modal">
  <div class="modal-hdr">
    <h2>
      <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
      Download PDF
    </h2>
    <button class="modal-x" onclick="closeModal('pdfOverlay')">✕</button>
  </div>
  <div class="modal-body">

    <div class="pdf-section">
      <span class="pdf-section-label">Orientation</span>
      <div class="option-group">
        <button class="opt-btn sel" id="opt-portrait" onclick="setPdfOpt('orient','portrait',this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-right:4px"><rect x="5" y="2" width="14" height="20" rx="2"/></svg>
          Portrait
        </button>
        <button class="opt-btn" id="opt-landscape" onclick="setPdfOpt('orient','landscape',this)">
          <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline;vertical-align:middle;margin-right:4px"><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
          Landscape
        </button>
      </div>
    </div>

    <div class="pdf-section">
      <span class="pdf-section-label">Scale / Zoom</span>
      <div class="option-group">
        <button class="opt-btn" onclick="setPdfOpt('scale','70',this)">70%</button>
        <button class="opt-btn" onclick="setPdfOpt('scale','80',this)">80%</button>
        <button class="opt-btn" onclick="setPdfOpt('scale','90',this)">90%</button>
        <button class="opt-btn sel" onclick="setPdfOpt('scale','100',this)">100%</button>
      </div>
    </div>

    <div class="pdf-info">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
      <span id="pdfInfoText">Will export the currently visible records in the table.</span>
    </div>
  </div>
  <div class="modal-foot">
    <button class="btn btn-ghost" onclick="closeModal('pdfOverlay')">Cancel</button>
    <button class="btn btn-primary" onclick="generatePDF()" style="background:#dc2626">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      Download PDF
    </button>
  </div>
</div>
</div>

<div id="toasts"></div>

<!-- ════════════════════════════════════════════════════
     JAVASCRIPT
════════════════════════════════════════════════════ -->
<script>
// ── Column Config ────────────────────────────────────────
const COLS = [
  {key:'num',       label:'#',               lock:true},
  {key:'uid',       label:'Unique ID'},
  {key:'date',      label:'Date'},
  {key:'time',      label:'Time'},
  {key:'visit',     label:'Visit #'},
  {key:'name',      label:'Name',            lock:true},
  {key:'parentage', label:'Parentage'},
  {key:'age',       label:'Age'},
  {key:'gender',    label:'Gender'},
  {key:'weight',    label:'Weight'},
  {key:'phone',     label:'Phone'},
  {key:'address',   label:'Address'},
  {key:'allergy',   label:'Allergy'},
  {key:'symptoms',  label:'Symptoms/History'},
  {key:'findings',  label:'Findings'},
  {key:'treatment', label:'Treatment'},
  {key:'actions',   label:'Actions',         lock:true},
];

// ── State ────────────────────────────────────────────────
let state = {page:1, limit:25, search:'', total:0, totalPages:1};
let deleteTarget = null;
let currentRows  = [];
let pdfOpts      = { orient: 'portrait', scale: '100' };
let searchTimer  = null;
let uidTimer     = null;
let hiddenCols   = new Set(JSON.parse(localStorage.getItem('pr_hidden_cols') || '[]'));

// ── Init ─────────────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
  applyColVisibility();
  renderColPanel();
  loadRecords();

  document.getElementById('searchInput').addEventListener('input', e => {
    clearTimeout(searchTimer);
    searchTimer = setTimeout(() => {
      state.search = e.target.value.trim();
      state.page = 1;
      loadRecords();
    }, 320);
  });

  document.getElementById('perPage').addEventListener('change', e => {
    state.limit = parseInt(e.target.value);
    state.page = 1;
    loadRecords();
  });

  ['formOverlay','delOverlay','pdfOverlay'].forEach(id => {
    document.getElementById(id).addEventListener('click', e => {
      if (e.target.id === id) closeModal(id);
    });
  });

  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') { closeModal('formOverlay'); closeModal('delOverlay'); closeModal('pdfOverlay'); closeColPanel(); }
  });

  // Close column panel on outside click
  document.addEventListener('click', e => {
    const wrap = document.getElementById('colToggleWrap');
    if (!wrap.contains(e.target)) closeColPanel();
  });

  document.getElementById('fUid').addEventListener('input', onUidInput);
});

// ── Column Visibility ────────────────────────────────────
function applyColVisibility() {
  let css = '';
  hiddenCols.forEach(k => { css += `.col-${k}{display:none !important}\n`; });
  document.getElementById('colStyle').textContent = css;
  const count = hiddenCols.size;
  const badge = document.getElementById('colHiddenBadge');
  badge.textContent = count || '';
  badge.style.display = count > 0 ? 'flex' : 'none';
}

function renderColPanel() {
  document.getElementById('colPanelGrid').innerHTML = COLS.map(c => `
    <label class="col-item${c.lock ? ' locked' : ''}">
      <input type="checkbox" ${!hiddenCols.has(c.key) ? 'checked' : ''}
        ${c.lock ? 'disabled' : `onchange="toggleCol('${c.key}',this.checked)"`}>
      ${c.label}
    </label>`).join('');
}

function toggleColPanel() {
  const panel = document.getElementById('colPanel');
  panel.classList.toggle('open');
}
function closeColPanel() {
  document.getElementById('colPanel').classList.remove('open');
}
function toggleCol(key, visible) {
  visible ? hiddenCols.delete(key) : hiddenCols.add(key);
  localStorage.setItem('pr_hidden_cols', JSON.stringify([...hiddenCols]));
  applyColVisibility();
  renderColPanel();
}
function resetCols() {
  hiddenCols.clear();
  localStorage.setItem('pr_hidden_cols', '[]');
  applyColVisibility();
  renderColPanel();
}

// ── API ──────────────────────────────────────────────────
async function api(params, method = 'GET', body = null) {
  try {
    const url  = 'api.php?' + new URLSearchParams(params);
    const opts = {method};
    if (body) { opts.headers = {'Content-Type':'application/json'}; opts.body = JSON.stringify(body); }
    const res  = await fetch(url, opts);
    if (!res.ok) throw new Error(`HTTP ${res.status}`);
    return await res.json();
  } catch(e) {
    return {error: e.message || 'Request failed'};
  }
}

// ── Load Records ─────────────────────────────────────────
async function loadRecords() {
  document.getElementById('tableBody').innerHTML =
    '<tr><td colspan="17" class="tbl-empty"><div class="spinner"></div></td></tr>';

  const data = await api({action:'get_records', search:state.search, limit:state.limit, page:state.page});

  if (data.error) {
    document.getElementById('tableBody').innerHTML =
      `<tr><td colspan="17" class="tbl-empty" style="color:#dc2626">
        <svg width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        Error: ${esc(data.error)}</td></tr>`;
    document.getElementById('pageInfo').textContent = 'Error loading records';
    return;
  }

  console.log('[PCR] API records:', data.records, '| total:', data.total);
  state.total      = data.total;
  state.totalPages = data.total_pages;
  renderTable(data.records);
  renderFooter();
}

function renderTable(rows) {
  currentRows = Array.isArray(rows) ? rows : [];
  const tbody  = document.getElementById('tableBody');
  const offset = state.limit > 0 ? (state.page - 1) * state.limit : 0;

  if (!currentRows.length) {
    tbody.innerHTML = `<tr><td colspan="17" class="tbl-empty">
      <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <div>${state.search ? 'No records match your search' : 'No records yet — click Add Record to start'}</div>
    </td></tr>`;
    return;
  }

  tbody.innerHTML = rows.map((r, i) => {
    const gc = r.gender==='Male'?'m':r.gender==='Female'?'f':'o';
    return `<tr>
      <td class="col-num" style="color:var(--gray-400);font-size:.73rem">${offset+i+1}</td>
      <td class="col-uid"><span class="uid-badge">${esc(r.unique_id)}</span></td>
      <td class="col-date">${fmtDate(r.date)}</td>
      <td class="col-time">${fmtTime(r.time)}</td>
      <td class="col-visit"><span class="visit-badge">${esc(r.visit_number)}</span></td>
      <td class="col-name" style="font-weight:600;color:var(--gray-800)">${esc(r.name)}</td>
      <td class="col-parentage">${esc(r.parentage)||'—'}</td>
      <td class="col-age">${r.age||'—'}</td>
      <td class="col-gender">${r.gender?`<span class="g-badge g-${gc}">${esc(r.gender)}</span>`:'—'}</td>
      <td class="col-weight">${r.weight?r.weight+' kg':'—'}</td>
      <td class="col-phone">${esc(r.phone)||'—'}</td>
      <td class="col-address td-wide" title="${esc(r.address)}">${esc(r.address)||'—'}</td>
      <td class="col-allergy" title="${esc(r.allergy)}">${esc(r.allergy)||'—'}</td>
      <td class="col-symptoms td-wide" title="${esc(r.symptoms)}">${esc(r.symptoms)||'—'}</td>
      <td class="col-findings td-wide" title="${esc(r.findings)}">${esc(r.findings)||'—'}</td>
      <td class="col-treatment td-wide" title="${esc(r.treatment)}">${esc(r.treatment)||'—'}</td>
      <td class="col-actions td-act">
        <button class="act-btn act-edit" onclick="openEditModal(${r.id})">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
          Edit
        </button>
        <button class="act-btn act-del" onclick="openDelModal(${r.id},'${esc(r.name).replace(/'/g,"\\'")}')">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
          Delete
        </button>
      </td>
    </tr>`;
  }).join('');
}

function renderFooter() {
  const from = state.total === 0 ? 0 : (state.page-1)*(state.limit||state.total)+1;
  const to   = state.limit > 0 ? Math.min(state.page*state.limit, state.total) : state.total;
  document.getElementById('pageInfo').textContent =
    state.total ? `Showing ${from}–${to} of ${state.total} record${state.total!==1?'s':''}` : 'No records';
  document.getElementById('recCount').textContent = state.total ? `${state.total} total` : '';

  const pg = document.getElementById('pagination');
  if (state.limit === 0 || state.totalPages <= 1) { pg.innerHTML = ''; return; }

  let html = `<button class="pg-btn" onclick="goPage(${state.page-1})" ${state.page===1?'disabled':''}>‹</button>`;
  pageRange(state.page, state.totalPages).forEach(p => {
    html += p === '…'
      ? `<span class="pg-btn" style="cursor:default">…</span>`
      : `<button class="pg-btn ${p===state.page?'active':''}" onclick="goPage(${p})">${p}</button>`;
  });
  html += `<button class="pg-btn" onclick="goPage(${state.page+1})" ${state.page===state.totalPages?'disabled':''}>›</button>`;
  pg.innerHTML = html;
}

function pageRange(cur, total) {
  if (total <= 7) return Array.from({length:total},(_,i)=>i+1);
  const p = [1];
  if (cur > 3) p.push('…');
  for (let i = Math.max(2,cur-1); i <= Math.min(total-1,cur+1); i++) p.push(i);
  if (cur < total-2) p.push('…');
  p.push(total);
  return p;
}

function goPage(p) {
  if (p < 1 || p > state.totalPages) return;
  state.page = p;
  loadRecords();
  window.scrollTo({top:0,behavior:'smooth'});
}

// ── Add Modal ────────────────────────────────────────────
async function openAddModal() {
  document.getElementById('recordForm').reset();
  document.getElementById('fId').value = '';
  document.querySelectorAll('.fc.invalid').forEach(el => el.classList.remove('invalid'));

  // Reset UID status + clear any prefill highlights
  const uidStatusEl = document.getElementById('uidStatus');
  uidStatusEl.style.display = 'none';
  uidStatusEl.className = '';
  uidStatusEl.textContent = '';
  ['fName','fParentage','fAge','fGender','fPhone','fAddress','fAllergy']
    .forEach(id => { document.getElementById(id).style.background = ''; });

  // Set defaults
  const now = new Date();
  const pad = n => String(n).padStart(2,'0');
  document.getElementById('fDate').value = `${now.getFullYear()}-${pad(now.getMonth()+1)}-${pad(now.getDate())}`;
  document.getElementById('fTime').value = `${pad(now.getHours())}:${pad(now.getMinutes())}`;
  document.getElementById('fUid').value  = '…';
  document.getElementById('fVisit').value = '';

  document.getElementById('modalTitle').innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    Add New Record`;

  // Open modal IMMEDIATELY — don't wait for API
  openModal('formOverlay');
  setTimeout(() => document.getElementById('fName').focus(), 250);

  // Fetch next ID in background
  const res = await api({action:'next_unique_id'});
  document.getElementById('fUid').value = (res && !res.error) ? (res.next_id || '0001') : '0001';
}

async function openEditModal(id) {
  const r = await api({action:'get_record', id});
  if (r.error) { showToast(r.error, 'error'); return; }

  document.getElementById('fId').value       = r.id;
  document.getElementById('fUid').value      = r.unique_id;
  document.getElementById('fDate').value     = r.date;
  document.getElementById('fTime').value     = r.time ? r.time.slice(0,5) : '';
  document.getElementById('fVisit').value    = r.visit_number;
  document.getElementById('fName').value     = r.name;
  document.getElementById('fParentage').value= r.parentage || '';
  document.getElementById('fAge').value      = r.age || '';
  document.getElementById('fGender').value   = r.gender || '';
  document.getElementById('fWeight').value   = r.weight || '';
  document.getElementById('fPhone').value    = r.phone || '';
  document.getElementById('fAddress').value  = r.address || '';
  document.getElementById('fAllergy').value  = r.allergy || '';
  document.getElementById('fSymptoms').value = r.symptoms || '';
  document.getElementById('fFindings').value = r.findings || '';
  document.getElementById('fTreatment').value= r.treatment || '';
  document.querySelectorAll('.fc.invalid').forEach(el => el.classList.remove('invalid'));

  document.getElementById('modalTitle').innerHTML = `
    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    Edit Record`;

  const uidSt = document.getElementById('uidStatus');
  uidSt.style.display = 'none';
  uidSt.className = '';
  openModal('formOverlay');
}

async function submitForm() {
  let valid = true;
  ['fUid','fName','fDate'].forEach(id => {
    const el = document.getElementById(id);
    const ok = el.value.trim() !== '';
    el.classList.toggle('invalid', !ok);
    if (!ok) valid = false;
  });
  if (!valid) { showToast('Please fill in required fields', 'error'); return; }

  const id = document.getElementById('fId').value;
  const payload = {
    id,
    unique_id:    document.getElementById('fUid').value.trim(),
    date:         document.getElementById('fDate').value,
    time:         document.getElementById('fTime').value || '00:00',
    visit_number: document.getElementById('fVisit').value || null,
    name:         document.getElementById('fName').value.trim(),
    parentage:    document.getElementById('fParentage').value,
    age:          document.getElementById('fAge').value,
    gender:       document.getElementById('fGender').value,
    weight:       document.getElementById('fWeight').value,
    phone:        document.getElementById('fPhone').value,
    address:      document.getElementById('fAddress').value,
    allergy:      document.getElementById('fAllergy').value,
    symptoms:     document.getElementById('fSymptoms').value,
    findings:     document.getElementById('fFindings').value,
    treatment:    document.getElementById('fTreatment').value,
  };

  const btn = document.getElementById('saveBtn');
  btn.disabled = true;
  btn.innerHTML = '<div class="spinner" style="width:14px;height:14px;border-width:2px;border-color:rgba(255,255,255,.4);border-top-color:#fff"></div> Saving…';

  const action = id ? 'update_record' : 'add_record';
  const res    = await api({action}, 'POST', payload);

  btn.disabled = false;
  btn.innerHTML = '<svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Save Record';

  if (res.error) { showToast(res.error, 'error'); return; }

  showToast(id ? 'Record updated successfully' : 'Record added successfully', 'success');
  closeModal('formOverlay');
  loadRecords();
}

// ── Delete ───────────────────────────────────────────────
function openDelModal(id, name) {
  deleteTarget = id;
  document.getElementById('delName').textContent = name;
  openModal('delOverlay');
}

async function confirmDelete() {
  if (!deleteTarget) return;
  const res = await api({action:'delete_record'}, 'POST', {id: deleteTarget});
  if (res.error) { showToast(res.error, 'error'); return; }
  showToast('Record deleted', 'info');
  deleteTarget = null;
  closeModal('delOverlay');
  if (state.total % (state.limit || state.total) === 1 && state.page > 1) state.page--;
  loadRecords();
}

// ── Helpers ──────────────────────────────────────────────
function openModal(id)  { document.getElementById(id).classList.add('open');    document.body.style.overflow = 'hidden'; }
function closeModal(id) { document.getElementById(id).classList.remove('open'); document.body.style.overflow = '';       }

function esc(s) {
  if (s == null) return '';
  return String(s).replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
}
function fmtDate(d) {
  if (!d) return '—';
  const [y,m,day] = d.split('-');
  return `${day}/${m}/${y}`;
}
function fmtTime(t) {
  if (!t) return '—';
  const [h,m] = t.split(':');
  const hr = parseInt(h), ampm = hr >= 12 ? 'PM' : 'AM';
  return `${hr%12||12}:${m} ${ampm}`;
}

// ── PDF ──────────────────────────────────────────────────
function openPdfModal() {
  const n = currentRows.length;
  document.getElementById('pdfInfoText').textContent =
    n ? `Will export ${n} record${n!==1?'s':''} currently visible in the table.`
      : 'No records currently visible.';
  openModal('pdfOverlay');
}

function setPdfOpt(type, val, btn) {
  pdfOpts[type] = val;
  const group = btn.closest('.option-group');
  group.querySelectorAll('.opt-btn').forEach(b => b.classList.remove('sel'));
  btn.classList.add('sel');
}

function generatePDF() {
  if (!currentRows.length) { showToast('No records to export', 'error'); return; }

  const orient = pdfOpts.orient;
  const scale  = parseInt(pdfOpts.scale);

  // Build visible column list (exclude actions)
  const visibleCols = COLS.filter(c => c.key !== 'actions' && !hiddenCols.has(c.key));

  const cellMap = {
    num:       (r,i) => i+1,
    uid:       r => r.unique_id || '',
    date:      r => fmtDate(r.date),
    time:      r => fmtTime(r.time),
    visit:     r => r.visit_number || '',
    name:      r => r.name || '',
    parentage: r => r.parentage || '—',
    age:       r => r.age || '—',
    gender:    r => r.gender || '—',
    weight:    r => r.weight ? r.weight + ' kg' : '—',
    phone:     r => r.phone || '—',
    address:   r => r.address || '—',
    allergy:   r => r.allergy || '—',
    symptoms:  r => r.symptoms || '—',
    findings:  r => r.findings || '—',
    treatment: r => r.treatment || '—',
  };

  const thead = visibleCols.map(c => `<th>${c.label}</th>`).join('');
  const tbody = currentRows.map((r, i) =>
    '<tr>' + visibleCols.map(c => `<td>${cellMap[c.key]?.(r,i) ?? ''}</td>`).join('') + '</tr>'
  ).join('');

  const now    = new Date();
  const stamp  = now.toLocaleDateString('en-GB') + ' ' + now.toLocaleTimeString('en-GB',{hour:'2-digit',minute:'2-digit'});
  const search = state.search ? ` — Search: "${state.search}"` : '';

  const html = `<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Patient Clinical Records</title>
<style>
  @page { size: A4 ${orient}; margin: 1.2cm; }
  * { box-sizing:border-box; margin:0; padding:0 }
  body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: ${Math.round(9 * scale / 100)}pt;
    zoom: ${scale/100};
    color: #1e293b;
  }
  .pdf-header {
    display:flex; justify-content:space-between; align-items:flex-end;
    border-bottom: 2px solid #1e3a5f; padding-bottom: 8px; margin-bottom: 12px;
  }
  .pdf-header h1 { font-size: 15pt; color: #1e3a5f; }
  .pdf-header .meta { font-size: 7.5pt; color: #64748b; text-align:right; line-height:1.6 }
  table { width: 100%; border-collapse: collapse; }
  thead th {
    background: #1e3a5f; color: #cfe0ff;
    padding: 5px 6px; font-size: 6.5pt; text-transform: uppercase;
    letter-spacing: .3px; text-align: left; white-space: nowrap;
  }
  tbody tr:nth-child(even) td { background: #f8fafc; }
  tbody td {
    padding: 4.5px 6px; border-bottom: 1px solid #e2e8f0;
    font-size: 7.5pt; vertical-align: top; word-break: break-word;
  }
  .pdf-footer { margin-top: 12px; font-size: 7pt; color: #94a3b8; text-align:center }
  @media print { body { -webkit-print-color-adjust: exact; print-color-adjust: exact; } }
</style>
</head>
<body>
<div class="pdf-header">
  <div>
    <h1>Patient Clinical Records</h1>
    <div style="font-size:8pt;color:#64748b;margin-top:3px">Management System${search}</div>
  </div>
  <div class="meta">
    <div>Printed: ${stamp}</div>
    <div>Records: ${currentRows.length} &nbsp;|&nbsp; ${orient.charAt(0).toUpperCase()+orient.slice(1)} &nbsp;|&nbsp; ${scale}%</div>
  </div>
</div>
<table>
  <thead><tr>${thead}</tr></thead>
  <tbody>${tbody}</tbody>
</table>
<div class="pdf-footer">Patient Clinical Records — Confidential</div>
</body>
</html>`;

  const win = window.open('', '_blank');
  if (!win) { showToast('Please allow pop-ups to download PDF', 'error'); return; }
  win.document.write(html);
  win.document.close();
  win.focus();
  setTimeout(() => { win.print(); }, 600);
  closeModal('pdfOverlay');
}

// ── UID Auto-Fill ────────────────────────────────────────
function onUidInput() {
  if (document.getElementById('fId').value !== '') return; // Edit mode — skip
  clearTimeout(uidTimer);
  const uid = document.getElementById('fUid').value.trim();
  const st  = document.getElementById('uidStatus');
  if (!uid) { st.style.display = 'none'; return; }
  st.className = 'uid-checking';
  st.style.display = 'block';
  st.textContent = 'Checking…';
  uidTimer = setTimeout(() => lookupUID(uid), 420);
}

async function lookupUID(uid) {
  const st  = document.getElementById('uidStatus');
  const res = await api({action:'get_patient_by_uid', uid});
  if (document.getElementById('fUid').value.trim() !== uid) return; // stale result

  const identityFields = {fName:'name', fParentage:'parentage', fAge:'age',
                          fGender:'gender', fPhone:'phone', fAddress:'address', fAllergy:'allergy'};

  if (res.error || !res.found) {
    st.className = 'uid-new';
    st.style.display = 'block';
    st.textContent = '✦ New patient';
    Object.keys(identityFields).forEach(id => { document.getElementById(id).style.background = ''; });
    document.getElementById('fVisit').value = '';
    return;
  }

  // Prefill identity + contact fields
  Object.entries(identityFields).forEach(([elId, key]) => {
    const el = document.getElementById(elId);
    if (elId === 'fGender') {
      el.value = res[key] || '';
    } else {
      el.value = res[key] != null ? res[key] : '';
    }
    el.style.background = res[key] ? '#f0fdf4' : '';
  });
  document.getElementById('fVisit').value = res.next_visit;

  st.className = 'uid-found';
  st.style.display = 'block';
  st.textContent = `✓ Existing patient — Visit #${res.next_visit} pre-set`;
}

function showToast(msg, type = 'info') {
  const icons = {
    success: '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>',
    error:   '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    info:    '<svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
  };
  const t = document.createElement('div');
  t.className = `toast ${type}`;
  t.innerHTML = (icons[type] || '') + esc(msg);
  document.getElementById('toasts').appendChild(t);
  setTimeout(() => t.remove(), 3500);
}
</script>
</body>
</html>
