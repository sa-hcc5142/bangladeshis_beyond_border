/* Bangladeshis Beyond Borders — Frontend JS */

/* -------- View switching -------- */
function switchView(e){
  if(e){ e.preventDefault(); }
  const id = (e?.target?.dataset?.view) || 'home';
  const container = document.getElementById('appContainer');
  const landing = document.getElementById('landing');
  if(id === 'landing'){
    container.style.display = 'none';
    landing.classList.add('active');
  } else {
    container.style.display = '';
    landing.classList.remove('active');
  }
  document.querySelectorAll('.view').forEach(v=>v.classList.remove('active'));
  document.getElementById(id)?.classList.add('active');
  document.querySelectorAll('nav.main a, .navlist a').forEach(a=>{
    if(a.dataset.view===id){ a.classList.add('active'); } else { a.classList.remove('active'); }
  });
  window.scrollTo({top:0, behavior:'smooth'});
}

/* -------- Theme / modals / toasts -------- */
function toggleTheme(){
  const html = document.documentElement;
  const dark = html.classList.toggle('theme-dark');
  localStorage.setItem('bbb-theme', dark ? 'dark' : 'light');
  toast('Theme: ' + (dark ? 'Dark' : 'Light'));
}
(function(){ const saved = localStorage.getItem('bbb-theme');
  if(saved==='light') document.documentElement.classList.remove('theme-dark');
  if(saved==='dark')  document.documentElement.classList.add('theme-dark');
})();
function openModal(id){ document.getElementById(id).style.display='flex'; }
function closeModal(id){ document.getElementById(id).style.display='none'; }
function toast(msg){
  const host=document.getElementById('toasts');
  const el=document.createElement('div'); el.className='card-solid';
  el.style.padding='10px 14px'; el.style.borderRadius='12px';
  el.style.border='var(--border)'; el.style.boxShadow='var(--shadow)'; el.textContent=msg;
  host.appendChild(el); setTimeout(()=>{ el.style.opacity='0'; el.style.transform='translateY(8px)'; },2600);
  setTimeout(()=>{ host.removeChild(el); },3200);
}

/* -------- “See more” clamp (word-based) -------- */
function clampParagraph(p){
  const max=parseInt(p.dataset.clamp||'0',10); if(!max) return;
  const words=p.textContent.trim().split(/\s+/); if(words.length<=max) return;
  const short=words.slice(0,max).join(' ')+'… '; const rest=words.slice(max).join(' ');
  const restSpan=document.createElement('span'); restSpan.style.display='none'; restSpan.textContent=rest;
  const more=document.createElement('span'); more.className='see-more'; more.textContent='See more';
  more.addEventListener('click', ()=>{ restSpan.style.display='inline'; more.remove(); p.textContent=short; p.appendChild(restSpan); });
  p.textContent=short; p.appendChild(more);
}
document.addEventListener('DOMContentLoaded', ()=>{ document.querySelectorAll('[data-clamp]').forEach(clampParagraph); });

/* -------- Flags & saved colleges -------- */
const FLAG_MAP = { 'united states':'🇺🇸','united kingdom':'🇬🇧','england':'🇬🇧','scotland':'🏴','wales':'🏴','northern ireland':'🇬🇧','canada':'🇨🇦','australia':'🇦🇺','germany':'🇩🇪','switzerland':'🇨🇭','singapore':'🇸🇬','china':'🇨🇳','hong kong':'🇭🇰' };
function _saved(){ try{return new Set(JSON.parse(localStorage.getItem('bbb-saved')||'[]'));}catch(_){return new Set();} }
function _persist(S){ localStorage.setItem('bbb-saved', JSON.stringify(Array.from(S))); }
function isSaved(item){ return _saved().has(item.key); }
function toggleSaved(item,btn){ const S=_saved(); if(S.has(item.key)){ S.delete(item.key); btn.setAttribute('aria-pressed','false'); } else { S.add(item.key); btn.setAttribute('aria-pressed','true'); } _persist(S); toast(btn.getAttribute('aria-pressed')==='true'?'Saved':'Removed'); }

/* -------- College card builders + actions -------- */
const LOGO_MAP = {
  'Massachusetts_Institute_of_Technology':'https://upload.wikimedia.org/wikipedia/commons/0/0c/MIT_logo.svg',
  'Harvard_University':'https://upload.wikimedia.org/wikipedia/en/2/29/Harvard_shield_wreath.svg',
  'Stanford_University':'https://upload.wikimedia.org/wikipedia/en/b/b7/Stanford_University_seal_2003.svg',
  'California_Institute_of_Technology':'https://upload.wikimedia.org/wikipedia/en/8/8a/Seal_of_the_California_Institute_of_Technology.svg'
};

function makeCollegeCard(item){
  const card=document.createElement('div'); card.className='college-card'; card.tabIndex=0;
  const countryText=(item.country||item.line||'').toLowerCase();
  const flagKey=Object.keys(FLAG_MAP).find(k=>countryText.includes(k)); const flag=flagKey?FLAG_MAP[flagKey]:'🎓';
  const logoHTML = LOGO_MAP[item.key]
    ? `<img alt="${item.name}" src="${LOGO_MAP[item.key]}">`
    : `<div class="logo-fallback">${String(item.name||'').split(/\s+/).slice(0,3).map(w=>w[0]).join('').toUpperCase()}</div>`;
  card.innerHTML = `
    <div class="college-logo">${logoHTML}</div>
    <div class="college">
      <h4><span class="flag">${flag}</span><a href="#">${item.rank?('#'+item.rank+' '):''}${item.name}</a></h4>
      <div class="meta">${item.country||item.line||''} <span class="tag">${item.tag||''}</span></div>
    </div>
    <button class="pill save-btn" title="Save" aria-pressed="false">★</button>`;
  // mouse+keyboard
  card.addEventListener('click', ev=>{ if(ev.target.classList.contains('save-btn')) return; toggleCollege(card); });
  card.addEventListener('keydown', ev=>{
    const k=(ev.key||'').toLowerCase();
    if(k==='enter'){ ev.preventDefault(); toggleCollege(card); }
    if(k==='escape'){ ev.preventDefault(); collapseAll(); }
    if(k==='arrowdown'){ ev.preventDefault(); const next=card.nextElementSibling&&card.nextElementSibling.nextElementSibling; (next||card).scrollIntoView({block:'nearest'}); if(next&&next.classList.contains('college-card')) next.focus(); }
    if(k==='arrowup'){ ev.preventDefault(); const prev=card.previousElementSibling&&card.previousElementSibling.previousElementSibling; if(prev){ prev.scrollIntoView({block:'nearest'}); prev.focus(); } }
  });
  const star=card.querySelector('.save-btn'); star.addEventListener('click', ev=>{ ev.stopPropagation(); toggleSaved(item,star); });
  if(isSaved(item)) star.setAttribute('aria-pressed','true');
  return card;
}
function makeActions(key){
  const wrap=document.createElement('div'); wrap.className='college-actions';
  const slug=key.toLowerCase();
  wrap.innerHTML = `
    <div class="action-links">
      <a target="_blank" href="#">Admission Procedure — Undergraduate <span>↗</span></a>
      <a target="_blank" href="#">Admission Procedure — Postgraduate <span>↗</span></a>
      <a target="_blank" href="#">Application Timeline <span>↗</span></a>
      <a target="_blank" href="#">Scholarship Opportunity — Full ride <span>↗</span></a>
      <a target="_blank" href="#">Scholarship Opportunity — Partial <span>↗</span></a>
      <a data-view="alumni-${slug}" class="btn" href="#" onclick="switchView(event)">Notable Alumni / Faculty →</a>
      <a data-view="research-${slug}" class="btn" href="#" onclick="switchView(event)">Research Opportunities →</a>
      <a data-view="residential-${slug}" class="btn" href="#" onclick="switchView(event)">Residential Facility & Security →</a>
      <a data-view="jobs-${slug}" class="btn" href="#" onclick="switchView(event)">Part-time Job Opportunities →</a>
    </div>`;
  return wrap;
}
function collapseAll(){
  document.querySelectorAll('.college-card').forEach(c=>c.classList.remove('open'));
  document.querySelectorAll('.college-actions').forEach(a=>a.style.display='none');
}
function toggleCollege(card){
  const next=card.nextElementSibling;
  document.querySelectorAll('.college-card').forEach(c=>{ if(c!==card) c.classList.remove('open'); });
  document.querySelectorAll('.college-actions').forEach(a=>{ if(a.previousElementSibling!==card) a.style.display='none'; });
  card.classList.toggle('open');
  if(next && next.classList.contains('college-actions')){
    next.style.display = (next.style.display==='block') ? 'none' : 'block';
  }
}

/* -------- Initial render (seed; Excel will replace) -------- */
const TOP100_SEED = [
  {rank:1, key:'Massachusetts_Institute_of_Technology', name:'Massachusetts Institute of Technology', country:'United States'},
  {rank:2, key:'Harvard_University', name:'Harvard University', country:'United States'},
  {rank:3, key:'Stanford_University', name:'Stanford University', country:'United States'},
  {rank:4, key:'California_Institute_of_Technology', name:'California Institute of Technology', country:'United States'}
];
function initialRender(){
  const host=document.getElementById('top100'); host.innerHTML='';
  TOP100_SEED.forEach(item=>{ host.appendChild(makeCollegeCard(item)); host.appendChild(makeActions(item.key.toLowerCase())); });
}
document.addEventListener('DOMContentLoaded', initialRender);

/* -------- Excel parsing (Top-100 global + Top-10 country tabs) -------- */
function renderSkeleton(host, n){ host.innerHTML=''; for(let i=0;i<n;i++){ const s=document.createElement('div'); s.className='college-card shimmer'; s.style.height='72px'; host.appendChild(s);} }
function loadRankingsFromExcel(){
  const input=document.getElementById('qsFile');
  if(!input.files || !input.files[0]){ toast('Please choose the .xlsx file first'); return; }
  const reader=new FileReader();
  reader.onload=function(e){
    try{
      const wb=XLSX.read(new Uint8Array(e.target.result), {type:'array'});
      const rowsFrom = n => { const sh=wb.Sheets[n]; return sh ? XLSX.utils.sheet_to_json(sh,{defval:''}) : []; };
      const normalize = rows => {
        if(!rows.length) return [];
        const keys=Object.keys(rows[0]);
        const nameKey=keys.find(k=>/name|institution|univ/i.test(k))||keys[0];
        const countryKey=keys.find(k=>/country/i.test(k))||'Country';
        const rankKey=keys.find(k=>/2026|rank/i.test(k))||keys[0];
        return rows.map(r=>{
          const name=String(r[nameKey]).trim(); if(!name) return null;
          const rank=parseInt(String(r[rankKey]).toString().replace(/[^0-9]/g,''),10)||9999;
          const country=String(r[countryKey]||'').trim();
          const key=name.replace(/[^A-Za-z0-9]+/g,'_');
          return {rank,key,name,country,line:country,tag:''};
        }).filter(Boolean).sort((a,b)=>a.rank-b.rank);
      };

      // Global
      const host = document.getElementById('top100'); renderSkeleton(host, 10);
      let global=normalize(rowsFrom('Top 100 (Global)'));
      if(!global.length){ const first=wb.Sheets[wb.SheetNames[0]]; global=normalize(XLSX.utils.sheet_to_json(first,{defval:''})); }
      host.innerHTML=''; global.slice(0,100).forEach(it=>{ host.appendChild(makeCollegeCard(it)); host.appendChild(makeActions((it.key||'').toLowerCase())); });

      // Countries
      const map = {
        usa: normalize(rowsFrom('Top 10 (USA)')).slice(0,10),
        canada: normalize(rowsFrom('Top 10 (Canada)')).slice(0,10),
        aus: normalize(rowsFrom('Top 10 (Australia)')).slice(0,10),
        germany: normalize(rowsFrom('Top 10 (Germany)')).slice(0,10),
        uk: normalize(rowsFrom('Top 10 (UK)')).slice(0,10),
      };
      function renderTop(list, id){
        const h=document.getElementById(id); h.innerHTML='';
        list.forEach(it=>{ h.appendChild(makeCollegeCard(it)); h.appendChild(makeActions((it.key||'').toLowerCase())); });
        if(list.length<10){ const warn=document.createElement('div'); warn.className='card pad-16'; warn.innerHTML='<span class="muted">Only '+list.length+' entries found in sheet.</span>'; h.appendChild(warn); }
      }
      renderTop(map.usa,'usaTop10'); renderTop(map.canada,'canadaTop10'); renderTop(map.aus,'ausTop10'); renderTop(map.germany,'germanyTop10'); renderTop(map.uk,'ukTop10');

      toast('Rankings loaded from Excel');
    }catch(err){ console.error(err); toast('Could not parse the Excel file'); }
  };
  reader.readAsArrayBuffer(input.files[0]);
}

/* -------- Deep-dive pages (generated on demand) -------- */
function ensureDeepDivePage(kind, slug){
  const id=`${kind}-${slug}`; if(document.getElementById(id)) return id;
  const container=document.createElement('section'); container.id=id; container.className='view';
  const titleMap={alumni:'Notable Alumni / Faculty', research:'Research Opportunities', residential:'Residential Facility & Security', jobs:'Part-time Job Opportunities'};
  const name=slug.split('_').join(' ').toUpperCase();
  container.innerHTML = `
    <div class="container">
      <div class="breadcrumbs">Home ▸ QS Top 100 ▸ ${name} ▸ ${titleMap[kind]}</div>
      <div class="panel-gradient pad-16">
        <div class="card pad-24">
          <h2>${name} — ${titleMap[kind]}</h2>
          <p data-clamp="220">This page is a placeholder. Replace with scraped/curated content from the university’s official site (alumni bios, research centers, housing info, student jobs, etc.).</p>
        </div>
        <div class="grid grid-3" style="margin-top:12px">
          <article class="post-card"><img class="media" src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1200&auto=format&fit=crop"/><div class="content"><h4>Item 1</h4><p data-clamp="80">Short, verifiable description with an external link. <a href="#" target="_blank">Open ↗</a></p></div></article>
          <article class="post-card"><img class="media" src="https://images.unsplash.com/photo-1556157382-97eda2d62296?q=80&w=1200&auto=format&fit=crop"/><div class="content"><h4>Item 2</h4><p data-clamp="80">Short, verifiable description with an external link. <a href="#" target="_blank">Open ↗</a></p></div></article>
          <article class="post-card"><img class="media" src="https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?q=80&w=1200&auto=format&fit=crop"/><div class="content"><h4>Item 3</h4><p data-clamp="80">Short, verifiable description with an external link. <a href="#" target="_blank">Open ↗</a></p></div></article>
        </div>
        <div class="flex" style="margin-top:14px"><a class="btn" data-view="colleges" onclick="switchView(event)">← Back to list</a></div>
      </div>
    </div>`;
  document.querySelector('main').appendChild(container);
  container.querySelectorAll('[data-clamp]').forEach(clampParagraph);
  return id;
}
document.addEventListener('click', function(ev){
  const a=ev.target.closest('a[data-view]'); if(!a) return;
  const dv=a.dataset.view; if(!/^((alumni)|(research)|(residential)|(jobs))\-/.test(dv)) return;
  ev.preventDefault(); const [kind, ...rest]=dv.split('-'); const slug=rest.join('-');
  const id=ensureDeepDivePage(kind, slug);
  switchView({ preventDefault: ()=>{}, target:{ dataset:{ view: id } } });
});

/* -------- Scrollspy for sidebar + Back-to-top -------- */
(function(){
  if(!('IntersectionObserver' in window)) return;
  const obs=new IntersectionObserver(entries=>{
    entries.forEach(e=>{
      if(!e.isIntersecting) return;
      const id=e.target.closest('section')?.id; if(!id) return;
      document.querySelectorAll('.navlist a').forEach(a=>{ if(a.dataset.view===id){ a.classList.add('active'); } else { a.classList.remove('active'); } });
    });
  },{rootMargin:'-40% 0px -55% 0px', threshold:0});
  document.querySelectorAll('#country-usa article, #country-canada article, #country-aus article, #country-germany article, #country-uk article').forEach(el=>obs.observe(el));
})();
(function(){
  const btn=document.getElementById('backToTop'); if(!btn) return;
  window.addEventListener('scroll', ()=>{ btn.style.display=(window.scrollY>600)?'block':'none'; });
  btn.addEventListener('click', ()=>{ window.scrollTo({top:0, behavior:'smooth'}); });
})();
