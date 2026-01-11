<?php
// ================= MeTube API =================
if (isset($_GET['api']) && isset($_GET['q'])) {
    header("Content-Type: application/json; charset=utf-8");

    $q = urlencode($_GET['q']);
    $html = @file_get_contents("https://www.youtube.com/results?search_query=$q");

    if (!$html) {
        echo json_encode(["error" => "fetch failed"]);
        exit;
    }

    preg_match_all(
        '/"videoId":"(.*?)".*?"title":\{"runs":\{"text":"(.*?)"\}\}.*?"longBylineText":\{"runs":\{"text":"(.*?)"\}/s',
        $html,
        $matches,
        PREG_SET_ORDER
    );

    $results = [];
    $used = [];

    foreach ($matches as $m) {
        if (count($results) >= 40) break;
        if (isset($used[$m[1]])) continue;

        $used[$m[1]] = true;
        $vid = $m[1];

        $results[] = [
            "videoId" => $vid,
            "title" => html_entity_decode($m[2]),
            "channel" => html_entity_decode($m[3]),
            "thumbnail" => "https://i.ytimg.com/vi/$vid/hqdefault.jpg"
        ];
    }

    echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    exit;
}
?><!DOCTYPE html><html lang="en">
<head>
<meta charset="UTF-8">
<title>MeTube</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body{margin:0;font-family:system-ui;background:#0f0f0f;color:#fff}
header{display:flex;gap:15px;align-items:center;padding:12px;background:#121212;position:sticky;top:0}
.logo{font-size:20px;font-weight:800}
.logo span{color:#ff0000}
input{flex:1;padding:10px;border-radius:6px;border:none}
button{padding:10px 14px;border:none;border-radius:6px;background:#ff0000;color:#fff;cursor:pointer}
main{display:grid;grid-template-columns:1fr 360px}
iframe{width:100%;aspect-ratio:16/9;border:none;border-radius:12px}
.player{padding:16px}
.list{padding:16px;border-left:1px solid #222;height:calc(100vh - 60px);overflow:auto}
.item{display:flex;gap:10px;margin-bottom:12px;cursor:pointer}
.item img{width:160px;border-radius:8px}
.item b{font-size:14px}
.item span{font-size:13px;color:#aaa}
@media(max-width:900px){main{grid-template-columns:1fr}.list{border:none;height:auto}}
</style>
</head>
<body>
<header>
  <div class="logo">Me<span>Tube</span></div>
  <input id="q" placeholder="Search video">
  <button onclick="search()">Search</button>
</header><main>
  <div class="player">
    <iframe id="player" allow="autoplay; encrypted-media"></iframe>
  </div>
  <div class="list" id="list"></div>
</main><script>
// ===== WEB WORKER VIA BLOB =====
const workerCode = `
self.onmessage = async e => {
  const q = e.data;
  const res = await fetch('?api=1&q=' + encodeURIComponent(q));
  const data = await res.json();
  postMessage(data);
}
`;

const worker = new Worker(URL.createObjectURL(new Blob([workerCode])));
worker.onmessage = e => render(e.data);

function search(){
  const q=document.getElementById('q').value;
  if(!q)return;
  document.getElementById('list').innerHTML='Loading…';
  worker.postMessage(q);
}

function render(data){
  const list=document.getElementById('list');
  list.innerHTML='';

  data.forEach((v,i)=>{
    const d=document.createElement('div');
    d.className='item';
    d.innerHTML=`<img src="${v.thumbnail}"><div><b>${v.title}</b><br><span>${v.channel}</span></div>`;
    d.onclick=()=>{
      document.getElementById('player').src='https://www.youtube.com/embed/'+v.videoId+'?autoplay=1';
    };
    list.appendChild(d);

    if(i===0){
      document.getElementById('player').src='https://www.youtube.com/embed/'+v.videoId+'?autoplay=1';
    }
  });
}
</script></body>
</html>
