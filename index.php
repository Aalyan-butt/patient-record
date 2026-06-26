<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<title>ClinicalRecord — Patient Management</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,300;0,14..32,400;0,14..32,500;0,14..32,600;0,14..32,700;0,14..32,800&display=swap" rel="stylesheet">
<style id="colStyle"></style>
<style>
/* ════════════════════════════════════════════════════════
   RESET + BASE
════════════════════════════════════════════════════════ */
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{font-size:15px;-webkit-text-size-adjust:100%}
body{
  font-family:'Inter',system-ui,sans-serif;
  background:#EAEef5;
  color:#0F172A;
  min-height:100vh;
  -webkit-font-smoothing:antialiased;
  -moz-osx-font-smoothing:grayscale;
  font-feature-settings:'cv02','cv03','cv04';
}

/* ════════════════════════════════════════════════════════
   DESIGN TOKENS
════════════════════════════════════════════════════════ */
:root{
  /* Brand */
  --brand:       #1D4ED8;
  --brand-dark:  #1239B0;
  --brand-mid:   #2563EB;
  --brand-light: #EFF6FF;
  --brand-glow:  rgba(37,99,235,.22);

  /* Semantic */
  --red:      #DC2626; --red-l:   #FEF2F2; --red-m:   #FECACA;
  --green:    #059669; --green-l: #ECFDF5; --green-m: #A7F3D0;
  --amber:    #D97706; --amber-l: #FFFBEB;
  --indigo:   #4F46E5; --indigo-l:#EEF2FF;
  --teal:     #0891B2; --teal-l:  #ECFEFF;
  --violet:   #7C3AED; --violet-l:#F5F3FF;
  --pink:     #DB2777; --pink-l:  #FDF2F8;

  /* Neutrals */
  --navy:      #060D1F;
  --navy-mid:  #0A1628;
  --s900:      #0F172A;
  --s800:      #1E293B;
  --s700:      #334155;
  --s600:      #475569;
  --s500:      #64748B;
  --s400:      #94A3B8;
  --s300:      #CBD5E1;
  --s200:      #E2E8F0;
  --s100:      #F1F5F9;
  --s50:       #F8FAFC;
  --white:     #FFFFFF;

  /* Geometry */
  --r-xs: 5px;
  --r-sm: 8px;
  --r:    12px;
  --r-md: 14px;
  --r-lg: 18px;

  /* Elevation */
  --el-1: 0 1px 2px rgba(15,23,42,.05);
  --el-2: 0 1px 3px rgba(15,23,42,.08), 0 1px 2px rgba(15,23,42,.04);
  --el-3: 0 4px 12px rgba(15,23,42,.09), 0 2px 4px rgba(15,23,42,.05);
  --el-4: 0 8px 24px rgba(15,23,42,.11), 0 4px 8px rgba(15,23,42,.06);
  --el-5: 0 20px 48px rgba(15,23,42,.14), 0 8px 16px rgba(15,23,42,.07);
}

/* ════════════════════════════════════════════════════════
   APP HEADER
════════════════════════════════════════════════════════ */
.app-header{
  background:var(--navy);
  background-image:
    radial-gradient(ellipse 90% 100% at 50% -10%, rgba(37,99,235,.16) 0%, transparent 65%),
    linear-gradient(180deg, #060D1F 0%, #091424 100%);
  color:#fff;height:68px;padding:0 2rem;
  display:flex;align-items:center;justify-content:space-between;
  position:sticky;top:0;z-index:100;
  box-shadow:0 1px 0 rgba(255,255,255,.05), 0 8px 32px rgba(0,0,0,.35);
}

/* Brand mark */
.hd-brand{display:flex;align-items:center;gap:.9rem}
.hd-logo{
  width:40px;height:40px;flex-shrink:0;
  background:linear-gradient(135deg,#3B82F6 0%,#6366F1 100%);
  border-radius:11px;
  display:flex;align-items:center;justify-content:center;
  box-shadow:0 0 0 1px rgba(255,255,255,.14) inset,
             0 4px 14px rgba(99,102,241,.5);
}
.hd-title{
  font-size:.98rem;font-weight:700;letter-spacing:-.25px;
  color:#fff;line-height:1.15;
}
.hd-sub{
  font-size:.68rem;font-weight:400;letter-spacing:.35px;
  text-transform:uppercase;color:rgba(255,255,255,.32);margin-top:2px;
}

/* Header right */
.hd-right{display:flex;align-items:center;gap:.9rem}
.hd-date{
  font-size:.74rem;font-weight:500;color:rgba(255,255,255,.4);
  letter-spacing:.15px;white-space:nowrap;
  padding:.3rem .75rem;
  border:1px solid rgba(255,255,255,.08);
  border-radius:99px;
  background:rgba(255,255,255,.04);
}

/* Premium Add Record button */
.btn-add{
  display:inline-flex;align-items:center;gap:.5rem;
  padding:.58rem 1.2rem;
  background:linear-gradient(135deg,#3B82F6 0%,#2563EB 50%,#1D4ED8 100%);
  color:#fff;font-weight:600;font-size:.83rem;font-family:inherit;
  border:none;border-radius:9px;cursor:pointer;white-space:nowrap;
  letter-spacing:-.1px;
  box-shadow:0 0 0 1px rgba(255,255,255,.16) inset,
             0 4px 14px rgba(37,99,235,.45),
             0 1px 3px rgba(0,0,0,.2);
  transition:all .2s cubic-bezier(.4,0,.2,1);
}
.btn-add:hover{
  background:linear-gradient(135deg,#60A5FA 0%,#3B82F6 50%,#2563EB 100%);
  box-shadow:0 0 0 1px rgba(255,255,255,.22) inset,
             0 6px 24px rgba(37,99,235,.5),
             0 2px 6px rgba(0,0,0,.2);
  transform:translateY(-1px);
}
.btn-add:active{transform:translateY(0);transition-duration:.08s}
.btn-add svg{opacity:.92;flex-shrink:0}

/* ════════════════════════════════════════════════════════
   PAGE LAYOUT
════════════════════════════════════════════════════════ */
.main-wrap{max-width:1840px;margin:0 auto;padding:1.8rem 1.5rem 3rem}
.main-card{
  background:var(--white);
  border-radius:var(--r-md);
  border:1px solid rgba(15,23,42,.065);
  box-shadow:var(--el-4);
  overflow:hidden;
}

/* ════════════════════════════════════════════════════════
   TOOLBAR
════════════════════════════════════════════════════════ */
.toolbar{
  display:flex;flex-wrap:wrap;gap:.7rem;align-items:center;
  padding:1rem 1.25rem;
  background:var(--white);
  border-bottom:1px solid var(--s100);
}

/* Search */
.search-wrap{position:relative;flex:1;min-width:220px;max-width:540px}
.search-icon{
  position:absolute;left:.9rem;top:50%;transform:translateY(-50%);
  color:var(--s400);pointer-events:none;
}
.search-input{
  width:100%;
  padding:.6rem .9rem .6rem 2.55rem;
  border:1.5px solid var(--s200);border-radius:9px;
  font-size:.84rem;font-family:inherit;font-weight:500;
  background:var(--s50);color:var(--s800);
  transition:all .18s;
}
.search-input:focus{
  outline:none;border-color:var(--brand-mid);background:#fff;
  box-shadow:0 0 0 3px rgba(37,99,235,.10);
}
.search-input::placeholder{color:var(--s400);font-weight:400}

/* Right controls */
.toolbar-right{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap}
.per-page-wrap{display:flex;align-items:center;gap:.4rem}
.per-page-label{font-size:.78rem;color:var(--s500);font-weight:500}
.per-page-sel{
  padding:.42rem .7rem;border:1.5px solid var(--s200);border-radius:7px;
  font-size:.8rem;font-family:inherit;font-weight:600;
  background:var(--s50);color:var(--s700);cursor:pointer;
  transition:all .15s;
}
.per-page-sel:focus{outline:none;border-color:var(--brand-mid)}

.rec-pill{
  display:inline-flex;align-items:center;
  background:var(--brand-light);color:var(--brand);
  font-size:.72rem;font-weight:700;
  padding:.28rem .75rem;border-radius:99px;
  letter-spacing:.1px;white-space:nowrap;
  border:1px solid rgba(37,99,235,.15);
}

/* ════════════════════════════════════════════════════════
   BUTTONS (general)
════════════════════════════════════════════════════════ */
.btn{
  display:inline-flex;align-items:center;gap:.42rem;
  padding:.5rem 1rem;border-radius:8px;
  font-size:.82rem;font-weight:600;font-family:inherit;
  cursor:pointer;border:none;transition:all .18s;
  white-space:nowrap;letter-spacing:-.1px;
}
.btn-primary{
  background:linear-gradient(135deg,#3B82F6,var(--brand));color:#fff;
  box-shadow:0 2px 8px var(--brand-glow),0 1px 2px rgba(0,0,0,.1);
}
.btn-primary:hover{
  background:linear-gradient(135deg,#60A5FA,#3B82F6);
  transform:translateY(-1px);box-shadow:0 4px 18px var(--brand-glow);
}
.btn-danger{
  background:linear-gradient(135deg,#EF4444,#DC2626);color:#fff;
  box-shadow:0 2px 8px rgba(220,38,38,.22);
}
.btn-danger:hover{
  background:linear-gradient(135deg,#F87171,#EF4444);
  transform:translateY(-1px);box-shadow:0 4px 16px rgba(220,38,38,.32);
}
.btn-ghost{
  background:var(--s50);color:var(--s600);
  border:1.5px solid var(--s200);
}
.btn-ghost:hover{background:var(--s100);color:var(--s800);border-color:var(--s300)}
.btn svg{flex-shrink:0}

/* ════════════════════════════════════════════════════════
   COLUMN VISIBILITY PANEL
════════════════════════════════════════════════════════ */
.col-toggle-wrap{position:relative}
.col-btn{position:relative}
.col-hidden-badge{
  position:absolute;top:-5px;right:-5px;
  background:var(--red);color:#fff;
  width:17px;height:17px;border-radius:50%;
  font-size:.6rem;font-weight:700;
  display:none;align-items:center;justify-content:center;
}
.col-panel{
  position:absolute;top:calc(100% + 10px);right:0;width:330px;
  background:#fff;border:1px solid var(--s200);border-radius:var(--r-md);
  box-shadow:var(--el-5);z-index:200;display:none;
  animation:panelDrop .18s cubic-bezier(.4,0,.2,1);
}
@keyframes panelDrop{from{opacity:0;transform:translateY(-10px) scale(.96)}to{opacity:1;transform:none}}
.col-panel.open{display:block}
.col-panel-head{
  display:flex;align-items:center;justify-content:space-between;
  padding:.75rem 1.05rem;border-bottom:1px solid var(--s100);
  background:var(--s50);border-radius:var(--r-md) var(--r-md) 0 0;
}
.col-panel-head span{font-size:.8rem;font-weight:700;color:var(--s700)}
.col-reset{
  font-size:.72rem;color:var(--brand);background:none;border:none;
  cursor:pointer;font-family:inherit;font-weight:600;
  padding:.2rem .5rem;border-radius:5px;transition:background .15s;
}
.col-reset:hover{background:var(--brand-light)}
.col-panel-scroll{
  max-height:280px;overflow-y:auto;
  scrollbar-width:thin;scrollbar-color:var(--s300) transparent;
}
.col-panel-scroll::-webkit-scrollbar{width:4px}
.col-panel-scroll::-webkit-scrollbar-thumb{background:var(--s300);border-radius:99px}
.col-panel-grid{
  display:grid;grid-template-columns:1fr 1fr;gap:2px;padding:.6rem .65rem .75rem;
}
.col-item{
  display:flex;align-items:center;gap:.42rem;
  padding:.42rem .65rem;border-radius:7px;cursor:pointer;
  font-size:.78rem;color:var(--s600);user-select:none;
  transition:background .12s,color .12s;font-weight:500;
}
.col-item:hover{background:var(--brand-light);color:var(--brand)}
.col-item input[type=checkbox]{accent-color:var(--brand-mid);cursor:pointer;width:13px;height:13px;flex-shrink:0}
.col-item.locked{opacity:.38;cursor:not-allowed;pointer-events:none}

/* ════════════════════════════════════════════════════════
   DATA TABLE
════════════════════════════════════════════════════════ */
.table-wrap{
  overflow-x:auto;overflow-y:auto;
  max-height:calc(100vh - 252px);
  -webkit-overflow-scrolling:touch;
  scrollbar-width:thin;scrollbar-color:var(--s300) transparent;
}
.table-wrap::-webkit-scrollbar{height:5px;width:5px}
.table-wrap::-webkit-scrollbar-thumb{background:var(--s300);border-radius:99px}
table{width:100%;border-collapse:collapse;font-size:.83rem}

/* Header */
thead th{
  background:#0C1629;
  color:rgba(203,213,225,.82);
  font-weight:600;font-size:.67rem;letter-spacing:.65px;
  text-transform:uppercase;
  padding:.85rem 1.05rem;
  white-space:nowrap;text-align:left;
  border-right:1px solid rgba(255,255,255,.04);
  position:sticky;top:0;z-index:10;
}
thead th:last-child{border-right:none;text-align:center}
thead th:first-child{padding-left:1.3rem}

/* Body rows */
tbody tr{
  border-bottom:1px solid var(--s100);
  transition:background .13s, box-shadow .13s;
}
tbody tr:nth-child(even){background:#FAFBFD}
tbody tr:hover{
  background:#EFF6FF;
  box-shadow:inset 3px 0 0 var(--brand-mid);
}
tbody td{
  padding:.75rem 1.05rem;
  vertical-align:middle;color:var(--s700);
  max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;
  font-size:.82rem;
}
tbody td.td-wide{max-width:220px}
tbody td.td-act{max-width:none;white-space:nowrap;padding:.5rem .85rem;text-align:center}
tbody td:first-child{padding-left:1.3rem;color:var(--s400);font-size:.72rem;font-weight:600}

/* ════════════════════════════════════════════════════════
   BADGES
════════════════════════════════════════════════════════ */
.uid-badge{
  display:inline-flex;align-items:center;
  background:linear-gradient(135deg,#EFF6FF,#DBEAFE);
  color:var(--brand);
  font-weight:700;font-size:.73rem;
  padding:.24rem .7rem;border-radius:6px;
  letter-spacing:.55px;
  border:1px solid rgba(37,99,235,.18);
  font-variant-numeric:tabular-nums;
}
.visit-badge{
  display:inline-flex;align-items:center;justify-content:center;
  min-width:28px;height:28px;
  background:var(--s100);color:var(--s600);
  font-weight:700;font-size:.72rem;
  border-radius:50%;border:2px solid var(--s200);
  padding:0 .3rem;
}
.g-badge{
  display:inline-flex;align-items:center;
  padding:.24rem .65rem;border-radius:99px;
  font-size:.68rem;font-weight:700;
  letter-spacing:.3px;text-transform:uppercase;white-space:nowrap;
}
.g-m{background:#DBEAFE;color:#1D4ED8;border:1px solid #BFDBFE}
.g-f{background:#FCE7F3;color:#9D174D;border:1px solid #FBCFE8}
.g-o{background:#EDE9FE;color:#5B21B6;border:1px solid #DDD6FE}

.name-cell{font-weight:600;color:var(--s800)}

/* ════════════════════════════════════════════════════════
   ACTION BUTTONS
════════════════════════════════════════════════════════ */
.act-btn{
  display:inline-flex;align-items:center;gap:.3rem;
  padding:.34rem .8rem;border-radius:7px;
  font-size:.73rem;font-weight:600;
  cursor:pointer;font-family:inherit;
  transition:all .16s cubic-bezier(.4,0,.2,1);
}
.act-edit{
  background:var(--brand-light);color:var(--brand);
  border:1.5px solid rgba(37,99,235,.18);
}
.act-edit:hover{
  background:var(--brand-mid);color:#fff;border-color:var(--brand-mid);
  transform:translateY(-1px);box-shadow:0 3px 12px var(--brand-glow);
}
.act-del{
  background:var(--red-l);color:var(--red);
  border:1.5px solid rgba(220,38,38,.18);margin-left:.35rem;
}
.act-del:hover{
  background:var(--red);color:#fff;border-color:var(--red);
  transform:translateY(-1px);box-shadow:0 3px 12px rgba(220,38,38,.28);
}

/* ════════════════════════════════════════════════════════
   EMPTY / LOADING STATES
════════════════════════════════════════════════════════ */
.tbl-empty{text-align:center;padding:4.5rem 1rem;color:var(--s400)}
.tbl-empty svg{display:block;margin:0 auto 1rem;opacity:.22}
.tbl-empty p{font-size:.88rem;font-weight:500;margin-top:.4rem;color:var(--s400)}
.spinner{
  display:inline-block;width:28px;height:28px;
  border:3px solid var(--s200);border-top-color:var(--brand-mid);
  border-radius:50%;animation:spin .6s linear infinite;
}
@keyframes spin{to{transform:rotate(360deg)}}

/* ════════════════════════════════════════════════════════
   TABLE FOOTER + PAGINATION
════════════════════════════════════════════════════════ */
.tbl-footer{
  display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:.7rem;
  padding:.9rem 1.25rem;border-top:1px solid var(--s100);
  background:var(--s50);
  font-size:.78rem;color:var(--s500);font-weight:500;
}
.pagination{display:flex;gap:.3rem;flex-wrap:wrap}
.pg-btn{
  min-width:34px;height:34px;padding:0 .5rem;
  display:flex;align-items:center;justify-content:center;
  border:1.5px solid var(--s200);border-radius:8px;
  background:#fff;color:var(--s600);
  font-size:.78rem;font-weight:600;cursor:pointer;
  transition:all .15s;font-family:inherit;
}
.pg-btn:hover:not(:disabled){
  border-color:var(--brand-mid);color:var(--brand-mid);background:var(--brand-light);
  transform:translateY(-1px);box-shadow:0 2px 8px var(--brand-glow);
}
.pg-btn.active{
  background:linear-gradient(135deg,#3B82F6,var(--brand));
  color:#fff;border-color:transparent;
  box-shadow:0 2px 10px var(--brand-glow);
}
.pg-btn:disabled{opacity:.3;cursor:not-allowed}

/* ════════════════════════════════════════════════════════
   OVERLAY + MODAL
════════════════════════════════════════════════════════ */
.overlay{
  position:fixed;inset:0;z-index:300;
  background:rgba(5,10,20,.7);
  backdrop-filter:blur(5px);-webkit-backdrop-filter:blur(5px);
  display:flex;align-items:flex-start;justify-content:center;
  padding:1.5rem 1rem 2rem;overflow-y:auto;
  opacity:0;pointer-events:none;transition:opacity .22s;
}
.overlay.open{opacity:1;pointer-events:all}
.modal{
  background:#fff;border-radius:var(--r-lg);
  box-shadow:var(--el-5),0 0 0 1px rgba(15,23,42,.06);
  width:100%;max-width:920px;
  transform:translateY(28px) scale(.965);
  transition:transform .28s cubic-bezier(.34,1.08,.64,1);
  overflow:hidden;
}
.overlay.open .modal{transform:translateY(0) scale(1)}

/* Modal header */
.modal-hdr{
  display:flex;align-items:center;justify-content:space-between;
  padding:1.1rem 1.55rem;
  background:linear-gradient(135deg,#060D1F 0%,#0C1832 60%,#0A1428 100%);
  position:relative;overflow:hidden;
}
.modal-hdr::before{
  content:'';position:absolute;inset:0;
  background:radial-gradient(ellipse 70% 120% at 20% 50%,rgba(37,99,235,.12) 0%,transparent 70%);
  pointer-events:none;
}
.modal-hdr::after{
  content:'';position:absolute;bottom:0;left:0;right:0;height:2px;
  background:linear-gradient(90deg,#3B82F6,#6366F1,#06B6D4);
}
.modal-hdr h2{
  color:#fff;font-size:.95rem;font-weight:700;
  display:flex;align-items:center;gap:.6rem;letter-spacing:-.1px;
}
.hdr-icon-wrap{
  width:32px;height:32px;flex-shrink:0;
  background:rgba(255,255,255,.1);border:1px solid rgba(255,255,255,.1);
  border-radius:8px;display:flex;align-items:center;justify-content:center;
}
.modal-x{
  background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.1);
  color:rgba(255,255,255,.65);
  width:32px;height:32px;border-radius:50%;
  display:flex;align-items:center;justify-content:center;
  cursor:pointer;font-size:.9rem;flex-shrink:0;
  transition:all .15s;
}
.modal-x:hover{background:rgba(255,255,255,.18);color:#fff;border-color:rgba(255,255,255,.22)}

.modal-body{
  padding:1.5rem;
  max-height:calc(100vh - 210px);overflow-y:auto;
  scrollbar-width:thin;scrollbar-color:var(--s300) transparent;
}
.modal-body::-webkit-scrollbar{width:4px}
.modal-body::-webkit-scrollbar-thumb{background:var(--s300);border-radius:99px}
.modal-foot{
  display:flex;justify-content:flex-end;align-items:center;gap:.7rem;
  padding:.95rem 1.55rem;
  border-top:1px solid var(--s100);
  background:var(--s50);border-radius:0 0 var(--r-lg) var(--r-lg);
}

/* ════════════════════════════════════════════════════════
   FORM
════════════════════════════════════════════════════════ */
.fsec{
  margin-bottom:1.1rem;
  border:1px solid var(--s200);border-radius:var(--r);
  overflow:hidden;background:#fff;
}
.fsec:last-child{margin-bottom:0}
.fsec-title{
  font-size:.69rem;font-weight:700;text-transform:uppercase;letter-spacing:.7px;
  color:var(--brand);
  padding:.56rem 1rem;
  background:linear-gradient(90deg,rgba(239,246,255,.9),rgba(239,246,255,.3),transparent);
  border-bottom:1px solid rgba(37,99,235,.09);
  display:flex;align-items:center;gap:.45rem;
}
.fsec-title svg{opacity:.65;flex-shrink:0}
.fsec-body{padding:1rem}
.fgrid{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:.85rem}
.fgrid-2{grid-template-columns:1fr 1fr}
.fg{display:flex;flex-direction:column;gap:.34rem}
.fg label{
  font-size:.73rem;font-weight:600;color:var(--s600);
  display:flex;align-items:center;gap:.3rem;
  letter-spacing:.08px;
}
.fg label .req{color:var(--red);margin-left:1px;font-size:.8rem}
.fc{
  padding:.54rem .78rem;
  border:1.5px solid var(--s200);border-radius:var(--r-sm);
  font-size:.84rem;font-family:inherit;font-weight:500;
  background:var(--s50);color:var(--s800);width:100%;
  transition:all .18s;
}
.fc:focus{
  outline:none;border-color:var(--brand-mid);background:#fff;
  box-shadow:0 0 0 3px rgba(37,99,235,.10);
}
.fc.invalid{border-color:var(--red)!important;box-shadow:0 0 0 3px rgba(220,38,38,.10)!important}
textarea.fc{resize:vertical;min-height:74px;line-height:1.55}
select.fc{cursor:pointer}

/* UID auto-fill status */
.uid-found   {color:var(--green);font-weight:600;display:flex;align-items:center;gap:.3rem}
.uid-new     {color:var(--s500);font-weight:500;display:flex;align-items:center;gap:.3rem}
.uid-checking{color:var(--brand-mid);font-weight:500;display:flex;align-items:center;gap:.3rem;animation:pulse .9s ease infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.55}}
.uid-prefilled{
  background:var(--green-l);border:1px solid var(--green-m);
  border-radius:7px;padding:.48rem .9rem;margin-top:.35rem;
  font-size:.76rem;color:var(--green);
  display:flex;align-items:center;gap:.4rem;
  grid-column:1/-1;font-weight:500;
}

/* ════════════════════════════════════════════════════════
   CONFIRM + PDF MODALS
════════════════════════════════════════════════════════ */
.pdf-modal{max-width:490px}
.pdf-modal .modal-body{padding:1.5rem}
.pdf-section{margin-bottom:1.35rem}
.pdf-section-label{
  font-size:.7rem;font-weight:700;text-transform:uppercase;letter-spacing:.65px;
  color:var(--s500);margin-bottom:.7rem;display:block;
}
.option-group{display:flex;gap:.5rem;flex-wrap:wrap}
.opt-btn{
  padding:.48rem 1.05rem;border-radius:8px;
  font-size:.82rem;font-weight:600;cursor:pointer;
  border:1.5px solid var(--s200);background:var(--s50);
  color:var(--s600);font-family:inherit;
  transition:all .15s;
  display:inline-flex;align-items:center;gap:.38rem;
}
.opt-btn:hover{border-color:var(--brand-mid);color:var(--brand-mid);background:var(--brand-light)}
.opt-btn.sel{
  border-color:transparent;
  background:linear-gradient(135deg,#3B82F6,var(--brand));
  color:#fff;box-shadow:0 2px 10px var(--brand-glow);
}
.pdf-info{
  background:var(--brand-light);border:1px solid #BFDBFE;border-radius:9px;
  padding:.72rem 1rem;font-size:.8rem;color:var(--brand);
  display:flex;align-items:center;gap:.55rem;font-weight:500;
}

.conf-modal{max-width:430px}
.conf-modal .modal-body{text-align:center;padding:2.2rem 1.75rem 1.75rem}
.conf-icon-ring{
  width:68px;height:68px;border-radius:50%;
  background:var(--red-l);border:2px solid var(--red-m);
  display:flex;align-items:center;justify-content:center;
  margin:0 auto 1.2rem;
}
.conf-modal h3{font-size:1.05rem;font-weight:700;margin-bottom:.5rem;color:var(--s900)}
.conf-modal p{font-size:.84rem;color:var(--s500);line-height:1.65}

/* ════════════════════════════════════════════════════════
   TOAST NOTIFICATIONS
════════════════════════════════════════════════════════ */
#toasts{
  position:fixed;top:1.25rem;right:1.5rem;
  display:flex;flex-direction:column;gap:.5rem;z-index:500;
}
.toast{
  display:flex;align-items:center;gap:.65rem;
  padding:.78rem 1.1rem;border-radius:11px;
  box-shadow:var(--el-5),0 0 0 1px rgba(255,255,255,.12) inset;
  font-size:.82rem;font-weight:600;
  min-width:240px;max-width:340px;color:#fff;
  animation:toastIn .26s cubic-bezier(.34,1.08,.64,1);
}
.toast.success{background:linear-gradient(135deg,#10B981,#059669)}
.toast.error  {background:linear-gradient(135deg,#EF4444,#DC2626)}
.toast.info   {background:linear-gradient(135deg,#3B82F6,#1D4ED8)}
@keyframes toastIn{from{opacity:0;transform:translateX(60px) scale(.92)}to{opacity:1;transform:none}}

/* ════════════════════════════════════════════════════════
   RESPONSIVE
════════════════════════════════════════════════════════ */
@media(max-width:768px){
  .app-header{padding:0 1rem;height:60px}
  .hd-date{display:none}
  .main-wrap{padding:1rem .75rem 2.5rem}
  .toolbar{flex-direction:column;align-items:stretch;padding:.85rem}
  .toolbar-right{flex-wrap:wrap;gap:.4rem}
  .search-wrap{max-width:none}
  .fgrid{grid-template-columns:1fr 1fr}
  .fgrid-2{grid-template-columns:1fr}
  .modal-body{padding:1rem;max-height:calc(100vh - 180px)}
  .col-panel{width:288px;right:-44px}
  .btn-add span{display:none}
}
@media(max-width:440px){
  .fgrid{grid-template-columns:1fr}
  .hd-sub{display:none}
  .rec-pill{display:none}
  .modal-foot{padding:.8rem 1rem}
}
</style>
</head>
<body>

<!-- ══════════════════════════════════════════════════════
     HEADER
══════════════════════════════════════════════════════ -->
<header class="app-header">
  <div class="hd-brand">
    <div class="hd-logo">
      <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
    </div>
    <div>
      <div class="hd-title">Clinical Records</div>
      <div class="hd-sub">Patient Management System</div>
    </div>
  </div>
  <div class="hd-right">
    <span class="hd-date" id="hdDate"></span>
    <button class="btn-add" onclick="openAddModal()">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      <span>Add Record</span>
    </button>
  </div>
</header>

<!-- ══════════════════════════════════════════════════════
     MAIN CONTENT
══════════════════════════════════════════════════════ -->
<main class="main-wrap">
<div class="main-card">

  <!-- Toolbar -->
  <div class="toolbar">
    <div class="search-wrap">
      <svg class="search-icon" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
      <input class="search-input" id="searchInput" type="search"
        placeholder="Search by name, ID, phone, symptoms, findings…" autocomplete="off">
    </div>
    <div class="toolbar-right">

      <!-- Columns toggle -->
      <div class="col-toggle-wrap" id="colToggleWrap">
        <button class="btn btn-ghost col-btn" id="colsBtn" onclick="toggleColPanel()">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/></svg>
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
        <span class="per-page-label">Show</span>
        <select class="per-page-sel" id="perPage">
          <option value="25">25</option>
          <option value="50">50</option>
          <option value="100">100</option>
          <option value="0">All</option>
        </select>
      </div>

      <span class="rec-pill" id="recCount"></span>

      <button class="btn btn-ghost" onclick="openPdfModal()"
        style="color:var(--red);border-color:rgba(220,38,38,.22);background:#FEF2F2">
        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
        <span>Export PDF</span>
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
          <th class="col-name">Patient Name</th>
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

<!-- ══════════════════════════════════════════════════════
     ADD / EDIT MODAL
══════════════════════════════════════════════════════ -->
<div class="overlay" id="formOverlay">
<div class="modal">
  <div class="modal-hdr">
    <h2 id="modalTitle">
      <span class="hdr-icon-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93C5FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      </span>
      Add New Record
    </h2>
    <button class="modal-x" onclick="closeModal('formOverlay')">✕</button>
  </div>

  <div class="modal-body">
    <form id="recordForm" novalidate>
      <input type="hidden" id="fId">

      <!-- Patient Identity -->
      <div class="fsec">
        <div class="fsec-title">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          Patient Identity
        </div>
        <div class="fsec-body">
          <div class="fgrid">
            <div class="fg">
              <label>Unique ID <span class="req">*</span></label>
              <input class="fc" id="fUid" placeholder="Auto…" maxlength="10" autocomplete="off">
              <span id="uidStatus" style="font-size:.72rem;margin-top:3px;display:none"></span>
            </div>
            <div class="fg">
              <label>Patient Name <span class="req">*</span></label>
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
      </div>

      <!-- Contact -->
      <div class="fsec">
        <div class="fsec-title">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.88 14.2 19.79 19.79 0 0 1 1.81 5.5 2 2 0 0 1 3.8 3.4h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 10.9a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.34 1.85.574 2.81.7A2 2 0 0 1 22 17.92z"/></svg>
          Contact
        </div>
        <div class="fsec-body">
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
      </div>

      <!-- Visit Details -->
      <div class="fsec">
        <div class="fsec-title">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
          Visit Details
        </div>
        <div class="fsec-body">
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
      </div>

      <!-- Clinical Notes -->
      <div class="fsec" style="margin-bottom:0">
        <div class="fsec-title">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>
          Clinical Notes
        </div>
        <div class="fsec-body">
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

<!-- ══════════════════════════════════════════════════════
     DELETE CONFIRM MODAL
══════════════════════════════════════════════════════ -->
<div class="overlay" id="delOverlay">
<div class="modal conf-modal">
  <div class="modal-hdr">
    <h2>
      <span class="hdr-icon-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#FCA5A5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
      </span>
      Confirm Deletion
    </h2>
    <button class="modal-x" onclick="closeModal('delOverlay')">✕</button>
  </div>
  <div class="modal-body">
    <div class="conf-icon-ring">
      <svg width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="var(--red)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
    </div>
    <h3>Delete this record?</h3>
    <p>The record for <strong id="delName"></strong> will be permanently removed and cannot be recovered.</p>
  </div>
  <div class="modal-foot">
    <button class="btn btn-ghost" onclick="closeModal('delOverlay')">Cancel</button>
    <button class="btn btn-danger" onclick="confirmDelete()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
      Delete Record
    </button>
  </div>
</div>
</div>

<!-- ══════════════════════════════════════════════════════
     PDF EXPORT MODAL
══════════════════════════════════════════════════════ -->
<div class="overlay" id="pdfOverlay">
<div class="modal pdf-modal">
  <div class="modal-hdr">
    <h2>
      <span class="hdr-icon-wrap">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93C5FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
      </span>
      Export PDF
    </h2>
    <button class="modal-x" onclick="closeModal('pdfOverlay')">✕</button>
  </div>
  <div class="modal-body">
    <div class="pdf-section">
      <span class="pdf-section-label">Page Orientation</span>
      <div class="option-group">
        <button class="opt-btn sel" id="opt-portrait" onclick="setPdfOpt('orient','portrait',this)">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="5" y="2" width="14" height="20" rx="2"/></svg>
          Portrait
        </button>
        <button class="opt-btn" id="opt-landscape" onclick="setPdfOpt('orient','landscape',this)">
          <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="5" width="20" height="14" rx="2"/></svg>
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
    <button class="btn btn-danger" onclick="generatePDF()">
      <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
      Export PDF
    </button>
  </div>
</div>
</div>

<div id="toasts"></div>

<!-- Live date in header -->
<script>
(function(){
  const el = document.getElementById('hdDate');
  if(el){
    el.textContent = new Date().toLocaleDateString('en-US',
      {weekday:'short',month:'short',day:'numeric',year:'numeric'});
  }
})();
</script>

<!-- ══════════════════════════════════════════════════════
     JAVASCRIPT
══════════════════════════════════════════════════════ -->
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
      <td class="col-num">${offset+i+1}</td>
      <td class="col-uid"><span class="uid-badge">${esc(r.unique_id)}</span></td>
      <td class="col-date">${fmtDate(r.date)}</td>
      <td class="col-time">${fmtTime(r.time)}</td>
      <td class="col-visit"><span class="visit-badge">${esc(r.visit_number)}</span></td>
      <td class="col-name"><span class="name-cell">${esc(r.name)}</span></td>
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
    <span class="hdr-icon-wrap">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93C5FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
    </span>
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
    <span class="hdr-icon-wrap">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93C5FD" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
    </span>
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
