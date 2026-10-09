<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'PawTalaan' }}</title>
    <style>
        :root{--cream:#fff9f0;--teal:#286f6c;--warm:#3f8f8b;--line:#bcd5d2;--gold:#e4b85c;--ink:#303638;--muted:#727c7c}
        *{box-sizing:border-box}body{margin:0;background:var(--cream);color:var(--ink);font:16px/1.5 system-ui,-apple-system,sans-serif}a{color:var(--teal)}
        .shell{max-width:1080px;margin:auto;padding:24px}.topbar{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:34px}.brand{font-size:1.55rem;font-weight:800;text-decoration:none}.brand span{color:var(--gold)}
        .nav{display:flex;align-items:center;gap:14px}.card{background:#fff;border:1px solid var(--line);border-radius:20px;padding:24px;box-shadow:0 8px 28px #286f6c12}.narrow{max-width:520px;margin:5vh auto}
        h1,h2{color:var(--teal);line-height:1.2}label{font-weight:700;display:block;margin:16px 0 6px}input,select{width:100%;padding:12px 14px;border:1px solid var(--line);border-radius:10px;background:#fff;font:inherit}
        button,.button{border:0;border-radius:10px;padding:11px 17px;background:var(--teal);color:#fff;font-weight:750;text-decoration:none;cursor:pointer}.button.secondary{background:#fff;color:var(--teal);border:1px solid var(--line)}
        .error{color:#9c3535;font-size:.9rem}.notice{padding:12px 16px;background:#edf8f6;border:1px solid var(--line);border-radius:10px;margin-bottom:18px}.muted{color:var(--muted)}.grid{display:grid;grid-template-columns:repeat(3,1fr);gap:18px}.tile{min-height:150px}.inline{display:inline}.settings{display:grid;gap:14px}.setting{display:grid;grid-template-columns:1fr minmax(180px,280px) auto;align-items:end;gap:12px}
        .desktop-warning{display:none}@media(max-width:700px){.shell{padding:16px}.grid{grid-template-columns:1fr}.topbar{align-items:flex-start}.setting{grid-template-columns:1fr}.admin-page>*:not(.desktop-warning){display:none}.admin-page .desktop-warning{display:block}.nav{flex-wrap:wrap;justify-content:flex-end}}
    </style>
</head>
<body><main class="shell">
    <header class="topbar"><a class="brand" href="{{ route('home') }}">Paw<span>Talaan</span></a>
        @auth <nav class="nav"><span class="muted">Hi, {{ auth()->user()->name }}</span>@if(auth()->user()->isAdministrator())<a href="{{ route('admin.index') }}">Site settings</a>@endif<form class="inline" method="post" action="{{ route('logout') }}">@csrf<button type="submit">Log out</button></form></nav>@endauth
    </header>
    @if(session('status'))<div class="notice">{{ session('status') }}</div>@endif
    {{ $slot }}
</main></body></html>
