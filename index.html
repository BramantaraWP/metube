<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>MeTube</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>
*{box-sizing:border-box}
body{
  margin:0;
  font-family:system-ui;
  background:#0f0f0f;
  color:#fff;
}
header{
  display:flex;
  gap:10px;
  padding:12px 16px;
  background:#121212;
  position:sticky;
  top:0;
}
.logo{
  font-weight:900;
  font-size:22px;
}
.logo span{color:#ff0000}
input{
  flex:1;
  padding:10px;
  border:none;
  border-radius:6px;
}
button{
  background:#ff0000;
  color:#fff;
  border:none;
  padding:10px 16px;
  border-radius:6px;
  cursor:pointer;
}
main{
  display:grid;
  grid-template-columns:1fr 380px;
}
.player{
  padding:16px;
}
iframe{
  width:100%;
  aspect-ratio:16/9;
  border:none;
  border-radius:12px;
  background:#000;
}
.list{
  padding:16px;
  overflow:auto;
  border-left:1px solid #222;
  height:calc(100vh - 64px);
}
.item{
  display:flex;
  gap:10px;
  margin-bottom:14px;
  cursor:pointer;
}
.item img{
  width:160px;
  border-radius:8px;
}
.item b{font-size:14px}
.item span{font-size:13px;color:#aaa}

@media(max-width:900px){
  main{grid-template-columns:1fr}
  .list{height:auto;border:none}
}
</style>
</head>

<body>

<header>
  <div class="logo">Me<span>Tube</span></div>
  <input id="q" placeholder="Cari lagu / video...">
  <button onclick="search()">Search</button>
</header>

<main>
  <div class="player">
    <iframe id="player" allow="autoplay; encrypted-media"></iframe>
  </div>
  <div class="list" id="list">Ketik sesuatu 🗿</div>
</main>

<script>
// ================= API CONFIG =================
const API_URL = 'api.php?api=1&q=';

// ================ SEARCH =====================
async function search(){
  const q = document.getElementById('q').value.trim();
  if(!q) return;

  const list = document.getElementById('list');
  list.innerHTML = 'Loading...';

  try{
    const res = await fetch(API_URL + encodeURIComponent(q));
    const data = await res.json();
    render(data);
  }catch(e){
    list.innerHTML = 'Error jir 💀';
  }
}

// ================ RENDER =====================
function render(data){
  const list = document.getElementById('list');
  list.innerHTML = '';

  if(!data || !data.length){
    list.innerHTML = 'Ga ketemu 😭';
    return;
  }

  data.forEach((v,i)=>{
    const div = document.createElement('div');
    div.className = 'item';
    div.innerHTML = `
      <img src="${v.thumbnail}">
      <div>
        <b>${v.title}</b><br>
        <span>${v.channel}</span>
      </div>
    `;
    div.onclick = ()=>{
      document.getElementById('player').src =
        'https://www.youtube.com/embed/' + v.videoId + '?autoplay=1';
    };
    list.appendChild(div);

    // autoplay first
    if(i===0){
      document.getElementById('player').src =
        'https://www.youtube.com/embed/' + v.videoId + '?autoplay=1';
    }
  });
}

// enter = search
document.getElementById('q').addEventListener('keydown', e=>{
  if(e.key === 'Enter') search();
});
</script>

</body>
</html>
